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
 * REST API Service, that consumes JSON Web Token (w.r.t. JWS) Specification
 *
 */

$eventLogFileName = $route_filename . "-log";
$eventLog = new Logger($eventLogFileName, true);
$eventLog->logNewSeperator();
$eventLog->log("Content-type => " . $ea_received_rest_ws_content_type);
$eventLog->log("Server protocol => " . $_SERVER['SERVER_PROTOCOL']);


if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "1")) {
	
	//Process, only if the Maintenance Mode is turned off
	if ($ea_maintenance_mode == false) {
		
		//Do Verify, if the JWT Auth Token Verification Status is Valid
		if ($ea_auth_token_validation_status) {
			$eventLog->log("JWT Auth Token is Verified and Valid, for this User");
			
			//Filter Inputs	
			$user_id_input = trim(isset($ea_received_rest_ws_raw_array_input['user_id']) ? filter_var($ea_received_rest_ws_raw_array_input['user_id'], FILTER_SANITIZE_NUMBER_INT) : '');
			
			if ($user_id_input != "0") {
				//Do Check and Fetch User specific quick information
				try { 
				
					//Do Get Quick User Info, from site_members db table
					$quick_user_info_result = ea_get_quick_user_info($user_id_input);
					$quick_user_info_result_count = count($quick_user_info_result);
					
					$eventLog->log("Count -> " . $quick_user_info_result_count); 
					
					if ($quick_user_info_result_count > "0") {
						//Valid User Exists!!!
						
						$response[] = $quick_user_info_result;
						
						$quick_user_info_result_json_encoded = json_encode($quick_user_info_result);
					
						$eventLog->log("Quick User Info -> " . $quick_user_info_result_json_encoded); 
						
					} else {
						$eventLog->log("User Info -> Invalid User ID Submitted, please check and try again."); 
					}//close of else of if ($quick_user_info_result_count > "0") {
					
				} catch (Exception $e){
					$eventLog->log("Exception -> " . $e->getMessage()); 
					//addLog($logFile, "Exception -> ".$e->getMessage());	
				}//close of  catch (Exception $e){
				
			} else {
				$eventLog->log("Invalid User ID Submitted, please check and try again.");
			}//close of if ($user_id_input != "0") {
			
		}//close of if ($ea_auth_token_validation_status) {
	
	}//close of if ($ea_maintenance_mode == false) {
	
} else {	
	//Define Response Header, with 400 Bad Request HTTP Response Code, back to the Client Application
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 400 Bad Request');
	exit;
}//close of else of if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "1")) {



//Check if Maintenance Mode is Turned On
if ($ea_maintenance_mode) {	
	
	//Define Response Header, that sends Maintenance Status and corresponding Wait time information, back to the Client Application
	header('Maintenance-Progress: true', false);
	header('Maintenance-Time: '.html_escaped_output($ea_maintanance_mode_time), false);	
	
} else if (!$ea_auth_token_validation_status) {	
	
	//Define Response Header, with 403 Forbidden HTTP Response Code, back to the Client Application. This is specific to Invalid JWT Token Submission by Client Applications.
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 403 Forbidden');
	
} else {	

	//Define Response Header, that conveys the info that, the response will be issued in JSON Format and with Content-Type: application/json, back to the Client Application
	header('Content-Type: application/json');
	echo json_encode($response,JSON_PRETTY_PRINT);
	
}//close of else of if ($ea_maintenance_mode){

exit;
?>