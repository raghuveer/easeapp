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
 * REST API Login based on JSON Web Token (w.r.t. JWS) Specification
 *
 */

$eventLogFileName = $route_filename . "-log";
$eventLog = new Logger($eventLogFileName, true);
$eventLog->logNewSeperator();
$eventLog->log("Content-type => " . $ea_received_rest_ws_content_type);
$eventLog->log("Server protocol => " . $_SERVER['SERVER_PROTOCOL']);
 
if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "4")) {
				
	//Process, only if the Maintenance Mode is turned off
	if ($ea_maintenance_mode == false) {
		if (is_array($ea_received_rest_ws_raw_array_input)) {
			$content = "";
			
			if (isset($ea_received_rest_ws_raw_array_input['email'])) {
				$content .= $ea_received_rest_ws_raw_array_input['email'] . ":::::";
			}//close of if (isset($ea_received_rest_ws_raw_array_input['email'])) {
			
			if (isset($ea_received_rest_ws_raw_array_input['password'])) {
				$content .= $ea_received_rest_ws_raw_array_input['password'] . ":::::";
			}//close of if (isset($ea_received_rest_ws_raw_array_input['password'])) {
			
			if (isset($ea_received_rest_ws_raw_array_input['mobile'])) {
				$content .= $ea_received_rest_ws_raw_array_input['mobile'] . ":::::";
			}//close of if (isset($ea_received_rest_ws_raw_array_input['mobile'])) {
				
			if (isset($ea_received_rest_ws_raw_array_input['ip_address'])) {
				$content .= $ea_received_rest_ws_raw_array_input['ip_address'] . "\r\n";
			}//close of if (isset($ea_received_rest_ws_raw_array_input['ip_address'])) {

			$eventLog->log("Received Inputs => ".$content);
			
			//DO WRITE REST WEB SERVICE AUTHORIZATION CHECK, for ALL REST WEB SERVICES, IN HERE.
			
		}//close of if ($ea_received_rest_ws_raw_array_input != "") {
			
		//Filter Inputs	
		$email_input = trim(isset($ea_received_rest_ws_raw_array_input['email']) ? filter_var($ea_received_rest_ws_raw_array_input['email'], FILTER_SANITIZE_EMAIL) : '');
		$password_input = trim(isset($ea_received_rest_ws_raw_array_input['password']) ? filter_var($ea_received_rest_ws_raw_array_input['password'], FILTER_SANITIZE_STRING) : '');
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
			
		}//close of else if of if ($user_unique_identifier_string_setting == "email-address") {
		
		//Check if the IP Address Input is a Valid IPv4 Address
		if (filter_var($ea_received_rest_ws_raw_array_input['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			//$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - A valid IPv4 address");
			$ip_address_input = trim($ea_received_rest_ws_raw_array_input['ip_address']);
		} else {
			$eventLog->log($ea_received_rest_ws_raw_array_input['ip_address'] . " - not a valid IPv4 address");
			$ip_address_input = '';
		}//close of else of if (filter_var($_POST['ip_address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
	
	
		//Check if all inputs are received correctly from the REST Web Service
		if (($user_unique_identifier_string_setting != "email-address") && ($user_unique_identifier_string_setting != "mobile-number")) {
			//Invalid Unique Identifier setting scenario
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['status'] = "invalid-user-identifier-setting";
			$response['status-description'] = "Invalid User Identifier Configuration Setting, please notify the Webmaster.";
			$response['jwt-audience'] = array();
			
			//Define Response Header, with 500 Internal Server Error HTTP Response Code, back to the Client Application
			header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 500 Internal Server Error');
			
			$eventLog->log("Please provide a valid unique identifier setting.");
			
		} else if (($user_unique_identifier_string_setting == "email-address") && ($email_input == "")) {
			//Invalid Email Address scenario
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['status'] = "missing-email-address";
			$response['status-description'] = "Email Address is expected as User Identifier, please check and try again.";
			$response['jwt-audience'] = array();
			
			//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
			header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
			
			$eventLog->log("Please provide a valid Email Address.");
			
		} else if (($user_unique_identifier_string_setting == "mobile-number") && ($mobile_input == "")) {
			//Invalid Mobile Number scenario
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['status'] = "missing-mobile-number";
			$response['status-description'] = "Mobile Number is expected as User Identifier, please check and try again.";
			$response['jwt-audience'] = array();
			
			//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
			header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
			
			$eventLog->log("Please provide a valid Mobile Number.");
					  
		} else if (($password_input == "") || ($ip_address_input == "")) {
			//One or More Inputs are Missing!!!
			
			//Construct Content, that will be sent in Response body, of the REST Web Service
			$response['status'] = "missing-additional-information";
			$response['status-description'] = "Some Additional Information like Password and / or IP Address (IPv4) is missing, please check and try again.";
			$response['jwt-audience'] = array();
			
			//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
			header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
			
			$eventLog->log("Please provide all information.");
					  
		} else {	
		    //All inputs are Valid
			
			$eventLog->log("All inputs are valid.");
			//$eventLog->log("Received Inputs - " . $content);
			try {
				
				//Initiate User Login function, based on User's Unique Identifier Setting, as in /app/core/main-config.php
				if ($user_unique_identifier_string_setting == "email-address") {
					//If the Unique User's Identifier is Email Address
					
					$login_request_response_array = ea_check_user_login_with_email_address($email_input, $password_input);
					$eventLog->log("Email Address based User Login function is executed.");
					
				} else if ($user_unique_identifier_string_setting == "mobile-number") {
					//If the Unique User's Identifier is Mobile Number
					
					$login_request_response_array = ea_check_user_login_with_mobile_number($mobile_input, $password_input);
					$eventLog->log("Mobile Number based User Login function is executed.");
					
				}//close of else if of if ($user_unique_identifier_string_setting == "email-address") {
				
				//Check the User's Account Status, and handle subsequent actions
				if ((isset($login_request_response_array["user_status"])) && ($login_request_response_array["user_status"] == "1")) {
					//If User's Status = 1, then the User's Account is Active.
					$eventLog->log("Active Email Address / Mobile Number.");
					
					if ((isset($login_request_response_array["login_request_auth_status"])) && ($login_request_response_array["login_request_auth_status"] == "1")) {
						$eventLog->log("Successful Login Attempt.");
						
						$user_id = "";
						$user_salutation = "";
						$user_firstname = "";
						$user_middlename = "";
						$user_lastname = "";
						$user_type = "";
						$user_privileges_list = "";
						
						//Collecting parameters, for JWT Token Creation
						if (isset($login_request_response_array['user_id'])) {
							$user_id = $login_request_response_array['user_id'];
						}//close of if (isset($login_request_response_array['user_id'])) {
						
						if (isset($login_request_response_array['user_salutation'])) {
							$user_salutation = $login_request_response_array['user_salutation'];
						}//close of if (isset($login_request_response_array['user_salutation'])) {
							
						if (isset($login_request_response_array['user_firstname'])) {
							$user_firstname = $login_request_response_array['user_firstname'];
						}//close of if (isset($login_request_response_array['user_firstname'])) {

						if (isset($login_request_response_array['user_middlename'])) {
							$user_middlename = $login_request_response_array['user_middlename'];
						}//close of if (isset($login_request_response_array['user_middlename'])) {
							
						if (isset($login_request_response_array['user_lastname'])) {
							$user_lastname = $login_request_response_array['user_lastname'];
						}//close of if (isset($login_request_response_array['user_lastname'])) {

						if (isset($login_request_response_array['user_type'])) {
							$user_type = $login_request_response_array['user_type'];
						}//close of if (isset($login_request_response_array['user_type'])) {
							
						if (isset($login_request_response_array['user_privileges_list'])) {
							$user_privileges_list = $login_request_response_array['user_privileges_list'];
						}//close of if (isset($login_request_response_array['user_privileges_list'])) {
						
						$eventLog->log("User information - " . $user_id . ":::::" . $user_salutation . ":::::" . $user_firstname . ":::::" . $user_middlename . ":::::" . $user_lastname . ":::::" . $user_type . ":::::" . $user_privileges_list . "\r\n");
						
						//Token generation Time and Expiry Time Definition
						$current_datetime = df_convert_unix_timestamp_to_datetime_custom_timezone($current_epoch, "Asia/Kolkata");
						$token_created_time_epoch = $current_epoch+"19800";
						$token_expiry_epoch = $current_epoch+"19800"+$jwtTokenlifeTime;
						
						//If received user_id is Valid
						if ($user_id != "") {
							
							//Do Query for the JWT Token Details, w.r.t. the particular User
							$user_active_token_details_result = ea_get_user_rel_active_jwt_token_details($user_id);
							
							//Do Get the Token Count 
							$user_active_token_details_result_count = count($user_active_token_details_result);
							
							$user_active_token_details_result_json_encoded = json_encode($user_active_token_details_result);
								
							$eventLog->log("Previously Active JWT Token Details - " . $user_active_token_details_result_json_encoded . "::::: count - " . $user_active_token_details_result_count . "\r\n");
							
							
							//Extract user_auth_token_id, for the JWT Token w.r.t. is_active_status = 1, of the User
							foreach ($user_active_token_details_result as $user_active_token_details_result_row) {
								$user_auth_token_id = $user_active_token_details_result_row["user_auth_token_id"];
								
								//Check if there is a JWT Token, that is active w.r.t. the User, at this moment
								if ($user_active_token_details_result_count > 0) {
									//Do Update Query, to mark the active JWT Token referencing record w.r.t. the User, as In-active.
									ea_update_user_rel_active_jwt_token_status($user_auth_token_id);
									
								}//close of if ($user_active_token_details_result_count > 0) {
								
							}//close of foreach ($user_active_token_details_result as $user_active_token_details_result_row) {
							
							//Create JSON Encoded version of JWT Token Audience
							$jwt_token_audience_json_encoded = json_encode($jwtTokenAudience);
							
							//Do Insert Query, to insert new JWT Token referencing information, w.r.t. the User.
							$last_inserted_user_rel_active_jwt_token_id = ea_insert_user_rel_active_jwt_token_refs($user_id, $current_datetime, $jwtTokenIssuer, $user_id, $jwt_token_audience_json_encoded, $token_created_time_epoch, $token_created_time_epoch, $token_expiry_epoch, "HS256", "1", "1");
							
							//Define JTI Claim of JWT Token, by assigning the received reference of recent token info insertion
							$jwt_token_rel_unique_jti = $last_inserted_user_rel_active_jwt_token_id;
							
							
							$eventLog->log("User Token related information - Token Created Time Epoch: " . $token_created_time_epoch . "::::: Token Expiry Time Epoch: " . $token_expiry_epoch . "::::: Recently Active JWT Token Details: " . "::::: JTI: " . $jwt_token_rel_unique_jti . "\r\n");
							
							//Generate JWT Token, based on HS256 / HMAC of SHA256 algorithm
							$jwt_token_created = ea_generate_hs256_alg_jwt_token($user_type, $user_privileges_list, $jwtTokenIssuer, $user_id, $jwt_token_audience_json_encoded, $token_created_time_epoch, $token_created_time_epoch, $token_expiry_epoch, $jwt_token_rel_unique_jti);
							
							//$jwt_token_created = "ugfyiftgfiyyhjgdygjbgfkufhighkfhghigkj";
							
							//Define Response Header, with 200 Ok HTTP Response Code and the JWT Token, back to the Client Application
							header('Authorization: '. 'Bearer ' . html_escaped_output($jwt_token_created));
							
							//Construct Content, that will be sent in Response body, of the REST Web Service
							$response['status'] = "login-success";
							$response['status-description'] = "Login Successful.";
							$response['jwt-audience'] = $jwtTokenAudience;
							
						}//close of if ($user_id != "") {
						$eventLog->log("token details are posted above.");
						
								
						
					} else if ((isset($login_request_response_array["login_request_auth_status"])) && ($login_request_response_array["login_request_auth_status"] == "0")) {
						$eventLog->log("Failed Login Attempt.");
						
						//Construct Content, that will be sent in Response body, of the REST Web Service
						$response['status'] = "login-failure";
						$response['status-description'] = "Invalid User Credentials. Please check and try again.";
						$response['jwt-audience'] = array();
						
						//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
						header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
						
					}//close of else if of if ((isset($login_request_response_array["login_request_auth_status"])) && ($login_request_response_array["login_request_auth_status"] == "1")) {
					
				} else if ((isset($login_request_response_array["user_status"])) && ($login_request_response_array["user_status"] == "0")) {
					$eventLog->log("In-Active Email Address / Mobile Number.");
					
					//Construct Content, that will be sent in Response body, of the REST Web Service
					$response['status'] = "inactive-user";
					$response['status-description'] = "This User Account is In-active at this moment. Please click on the Email Activation Link, to activate this Account.";
					$response['jwt-audience'] = array();
					
					//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
					header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
					
				} else if ((isset($login_request_response_array["user_status"])) && ($login_request_response_array["user_status"] == "2")) {
					$eventLog->log("Suspended Email Address / Mobile Number.");
					
					//Construct Content, that will be sent in Response body, of the REST Web Service
					$response['status'] = "suspended-user";
					$response['status-description'] = "This User Account is Suspended at this moment. Please reachout to the Site Admin, for further queries.";
					$response['jwt-audience'] = array();
					
					//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
					header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
					
				} else if ((isset($login_request_response_array["user_status"])) && ($login_request_response_array["user_status"] == "3")) {
					$eventLog->log("Banned Email Address / Mobile Number.");
					
					//Construct Content, that will be sent in Response body, of the REST Web Service
					$response['status'] = "banned-user";
					$response['status-description'] = "This User Account is Banned at this moment. Please reachout to the Site Admin, for further queries.";
					$response['jwt-audience'] = array();
					
					//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
					header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
					
				} else {
					$eventLog->log("Invalid Email Address / Mobile Number.");
					
					//Construct Content, that will be sent in Response body, of the REST Web Service
					$response['status'] = "invalid-user-account";
					$response['status-description'] = "Invalid User Account.";
					$response['jwt-audience'] = array();

					//Define Response Header, with 401 Unauthorized HTTP Response Code, back to the Client Application
					header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 401 Unauthorized');
					
				}//close of else of if ((isset($login_request_response_array["user_status"])) && ($login_request_response_array["user_status"] = "1")) {
				
			} catch (Exception $e) {
				$eventLog->log("Exception -> " . html_escaped_output($e->getMessage())); 
				//addLog($logFile, "Exception -> ".$e->getMessage());		
			}//close of catch (Exception $e) { 
			
			$eventLog->logNewSeperator();			
		}//close of else of if ($user_unique_identifier_string_setting == "") {
	}//close of if ($ea_maintenance_mode == false) {
	
} else {
	
	//Construct Content, that will be sent in Response body, of the REST Web Service
	$response['status'] = "invalid-input";
	$response['status-description'] = "Invalid Input, Please check and provide all information.";
	$response['jwt-audience'] = array();
	
	//Define Response Header, with 400 Bad Request HTTP Response Code, back to the Client Application
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 400 Bad Request');
}//close of else of if ((isset($ea_received_rest_ws_raw_array_input)) && (is_array($ea_received_rest_ws_raw_array_input)) && (count($ea_received_rest_ws_raw_array_input) == "4")) {

//Check if Maintenance Mode is Turned On
if ($ea_maintenance_mode) {	
	
	//Define Response Header, with Maintenance Status and corresponding Wait time information, back to the Client Application
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