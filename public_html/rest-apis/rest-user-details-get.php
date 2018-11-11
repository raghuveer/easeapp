<?php 
defined('START') or die; 

/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 *
 * REST API Service, that consumes JSON Web Token (w.r.t. JWS) Specification. This is used to send User's Quick Info, in the response.
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
			$email_input = trim(isset($ea_received_rest_ws_raw_array_input['email']) ? filter_var($ea_received_rest_ws_raw_array_input['email'], FILTER_SANITIZE_EMAIL) : '');
			$mobile_input = trim(isset($ea_received_rest_ws_raw_array_input['mobile']) ? filter_var($ea_received_rest_ws_raw_array_input['mobile'], FILTER_SANITIZE_NUMBER_INT) : '');
			
			//Identify the Unique Identifier Setting of User Account
			if ($user_unique_identifier_string_setting == "email-address") {
				// Validate e-mail
				if (!filter_var($email_input, FILTER_VALIDATE_EMAIL) == true) {
					$eventLog->log($email_input . " - Not a Valid Email Address");
					$email_input = "";
				}//close of if (!filter_var($email_input, FILTER_VALIDATE_EMAIL) === true) {
					
			} else if ($user_unique_identifier_string_setting == "mobile-number") {
				// Validate mobile number
				if (($mobile_input == '0') || (!ctype_digit($mobile_input))) {
					$eventLog->log($mobile_input . " - Not a Valid Mobile Number");
					$mobile_input = "";
				}//close of if (($mobile_input == '0') || (!ctype_digit($mobile_input))) {
				
			}//close of else if of if ($unique_identifier_setting_input == "email-address") {
			
			//Check if the IP Address Input is a Valid IPv4 Address
			if (filter_var($ea_received_rest_ws_raw_array_input['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				//$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - A valid IPv4 address");
				$ip_address_input = trim($ea_received_rest_ws_raw_array_input['ip_address']);
			} else {
				$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - not a valid IPv4 address");
				$ip_address_input = '';
			}//close of else of if (filter_var($_POST['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
		
			
			//Check if all inputs are received correctly from the REST Web Service
			if ($user_unique_identifier_string_setting == "") {
				//Invalid Unique Identifier setting scenario
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "invalid-user-identifier-setting";
				$response['status-description'] = "Invalid User Identifier Configuration Setting, please notify the Webmaster.";
				$response['jwt-audience'] = array();
				
				//Define Response Header, with 500 Internal Server Error HTTP Response Code, back to the Client Application
				header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 500 Internal Server Error');
				
				$eventLog->log("Please provide a valid unique identifier setting.");
				
			} else if (($user_unique_identifier_string_setting == "email-address") && ($email_input == "")) {
				//Invalid Email Address scenario
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "missing-email-address";
				$response['status-description'] = "Email Address is expected as User Identifier, please check and try again.";
				
				$eventLog->log("Please provide a valid Email Address.");
				
			} else if (($user_unique_identifier_string_setting == "mobile-number") && ($mobile_input == "")) {
				//Invalid Mobile Number scenario
				
				//Construct Content, that will be sent in Response body, of the REST Web Service
				$response['data'] = array();
				$response['status'] = "missing-mobile-number";
				$response['status-description'] = "Mobile Number is expected as User Identifier, please check and try again.";
				
				$eventLog->log("Please provide a valid Mobile Number.");
						  
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
				
					//Do Get Quick User Info, from site_members db table
					$quick_user_info_result = ea_get_quick_user_info_based_on_email_or_mobile($email_input, $mobile_input, $user_unique_identifier_string_setting, $ip_address_input);
					$quick_user_info_result_count = count($quick_user_info_result);
					
					$eventLog->log("Count -> " . $quick_user_info_result_count); 
					
					if ($quick_user_info_result_count > "0") {
						//Valid User Exists!!!
						
						$response['data'] = $quick_user_info_result;
						
						//Construct Content, that will be sent in Response body, of the REST Web Service
						$response['status'] = "user-details-received";
						$response['status-description'] = "User Details Successfully Received";
						
						$quick_user_info_result_json_encoded = json_encode($quick_user_info_result);
					
						$eventLog->log("Quick User Info -> " . $quick_user_info_result_json_encoded); 
						
					} else {
						
						//Construct Content, that will be sent in Response body, of the REST Web Service
						$response['data'] = array();
						$response['status'] = "invalid-user-references";
						$response['status-description'] = "Invalid User References.";
						
						$eventLog->log("User Info -> Invalid User ID Submitted, please check and try again."); 
					}//close of else of if ($quick_user_info_result_count > "0") {
					
				} catch (Exception $e){
					$eventLog->log("Exception -> " . html_escaped_output($e->getMessage())); 
					//addLog($logFile, "Exception -> ".$e->getMessage());	
				}//close of  catch (Exception $e){
				
					
			}//close of else of if ($user_unique_identifier_string_setting == "") {
			
			
			
		} else {
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['data'] = array();
			$response['status'] = "access-forbidden";
			$response['status-description'] = "Resources that requires a different set of access permissions are requested, please contact admin, if access to these resources are required.";
			
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