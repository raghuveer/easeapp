<?php 
defined('START') or die; 

/**
 *
 * This REST API Endpoint is used to get List of Admin User Groups, in the response.
 *
 */

$eventLogFileName = $route_filename . "-log";
$eventLog = new Logger($eventLogFileName, true);
$eventLog->logNewSeperator();
$eventLog->log("Content-type => " . $ea_received_rest_ws_content_type);
$eventLog->log("Server protocol => " . $_SERVER['SERVER_PROTOCOL']);
//$eventLog->log("Request Headers => " . $ea_received_request_headers_json_encoded);
//$eventLog->log("JWT Token => " . $ea_auth_token);

if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "3")) {
	
	//Process, only if the Maintenance Mode is turned off
	if ($ea_maintenance_mode == false) {
		
		//Do Verify, if the JWT Auth Token Verification Status is Valid
		if ($ea_auth_token_validation_status) {
			$eventLog->log("JWT Auth Token is Verified and Valid, for this User");
			
			//Filter Inputs	
			$user_type_input = trim(isset($ea_received_rest_ws_raw_array_input['user_type']) ? filter_var($ea_received_rest_ws_raw_array_input['user_type'], FILTER_SANITIZE_STRING) : '');
			
			$user_group_status_input = trim(isset($ea_received_rest_ws_raw_array_input['status']) ? filter_var($ea_received_rest_ws_raw_array_input['user_group_status'], FILTER_SANITIZE_NUMBER_INT) : '');
			
			//Check if the IP Address Input is a Valid IPv4 Address
			if (filter_var($ea_received_rest_ws_raw_array_input['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				//$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - A valid IPv4 address");
				$ip_address_input = trim($ea_received_rest_ws_raw_array_input['ip_address']);
			} else {
				$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - not a valid IPv4 address");
				$ip_address_input = '';
			}//close of else of if (filter_var($_POST['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
		
			$eventLog->log("user_type_input -> " . $user_type_input);
			$eventLog->log("user_group_status_input -> " . $user_group_status_input);
			$eventLog->log("ip_address_input -> " . $ip_address_input);
			
			//Check if all inputs are received correctly from the REST Web Service
			if (($user_type_input != "member") && ($user_type_input != "admin")) {
				//Invalid User Type scenario
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "invalid-user-type";
				$response['status-description'] = "Invalid User Type info submitted, please check and try again.";
				
				$eventLog->log("Please provide a valid User Type info.");
				
			} else if (($user_group_status_input != "0") && ($user_group_status_input != "1") && ($user_group_status_input != "")) {
				//Invalid User Group Status scenario
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "invalid-user-group-status";
				$response['status-description'] = "Invalid User Group Status info submitted, please check and try again.";
				
				$eventLog->log("Please provide a valid User Group Status info.");
				
			} else if ($ip_address_input == "") {
				//One or More Inputs are Missing!!!
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "missing-additional-information";
				$response['status-description'] = "Some Additional Information like IP Address (IPv4) is missing, please check and try again.";
				
				$eventLog->log("Please provide all information.");
						  
			} else {
				//All inputs are Valid
			
				$eventLog->log("All inputs are valid.");
			
				try { 
				
					//Do Get User Groups List, from sm_site_member_classification_details db table
					$user_group_list_result = ea_get_user_groups_list($user_type_input, $user_group_status_input);
					$user_group_list_result_count = count($user_group_list_result);
					
					$eventLog->log("Count -> " . $user_group_list_result_count); 
					
					if ($user_group_list_result_count > "0") {
						//One or More User Groups Exist and Active
						
						$response['data'] = $user_group_list_result;
						
						//Construct Content, that will be sent in Response body, of the REST Web Service
						$response['status'] = "user-groups-details-received";
						$response['status-description'] = "User Group Details Successfully Received";
						
						$user_group_list_result_json_encoded = json_encode($user_group_list_result);
					
						$eventLog->log("User Group List -> " . $user_group_list_result_json_encoded); 
						
					} else {
						
						//Construct Content, that will be sent in Response body, of the REST Web Service
						$response['data'] = array();
						$response['status'] = "active-user-groups-doesnot-exist";
						$response['status-description'] = "User Groups List -> No Active User Groups Exist, please check and try again.";
						
						//No Active User Groups Exist
						$eventLog->log("User Groups List -> No Active User Groups Exist, please check and try again."); 
					}//close of else of if ($user_group_list_result_count > "0") {
					
				} catch (Exception $e){
					$eventLog->log("Exception -> " . html_escaped_output($e->getMessage())); 
					//addLog($logFile, "Exception -> ".$e->getMessage());	
				}//close of  catch (Exception $e){
				
			
			}//close of else of if (($user_type_input != "member") || ($user_type_input != "admin")) {
				
			
		} else {
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['data'] = array();
			$response['status'] = "access-forbidden";
			$response['status-description'] = "Resources that require a different set of access permissions are requested, please contact admin, if access to these resources are required.";
			
			//Define Response Header, with 403 Forbidden HTTP Response Code, back to the Client Application. This is specific to Invalid JWT Token Submission by Client Applications.
			header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 403 Forbidden');
			
		}//close of else of if ($ea_auth_token_validation_status) {
	
	}//close of if ($ea_maintenance_mode == false) {
	
} else {

	//Construct Content, that will be sent in Response body, of the REST Web Service
	$response['data'] = array();
	$response['status'] = "invalid-input";
	$response['status-description'] = "Invalid Input, Please check and provide all information.";
	
	//Define Response Header, with 400 Bad Request HTTP Response Code, back to the Client Application
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 400 Bad Request');
}//close of else of if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "3")) {




//Check if Maintenance Mode is Turned On
if ($ea_maintenance_mode) {	
	
	//Define Response Header, that sends Maintenance Status and corresponding Wait time information, back to the Client Application
	header('Maintenance-Progress: true', false);
	header('Maintenance-Time: '.html_escaped_output($ea_maintanance_mode_time), false);	
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 503 Service Unavailable');
	
} else {	

	//Define Response Header, that conveys the info that, the response will be issued in JSON Format and with Content-Type: application/json, back to the Client Application
	header('Content-Type: application/json');
	echo json_encode($response,JSON_PRETTY_PRINT);
	
}//close of else of if ($ea_maintenance_mode){

exit;
?>