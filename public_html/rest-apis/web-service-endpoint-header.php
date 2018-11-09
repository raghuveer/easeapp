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
 * REST API Service, and Common header for both pre-login and post-login scenarios.
 *
 */
 
$ea_auth_token_validation_status = false;
$ea_auth_token = "";
$ea_maintenance_mode = false; 
$response = array();

//Get Maintenance State Details of REST Services
$ea_maintanance_mode_time = getMaintananceInfo();

//Check maintenance mode
if ($ea_maintanance_mode_time != "") {
	$ea_maintenance_mode = true;	
	//echo "Maintenance mode (true): " . $ea_maintenance_mode . "\n";
}//close of if ($ea_maintanance_mode_time != "") {

//Process received Raw PHP Input, at the REST Web Service Endpoint. $_GET / $_POST Superglobals do not work, when Data is received with Content-type: application/json.
$ea_received_rest_web_service_data = ea_create_array_from_http_raw_json_data();

//Collect JSON Decoded Result of the received Raw PHP Input.
$ea_received_rest_ws_raw_array_input = $ea_received_rest_web_service_data["received_data_array"];

//Collect received Content Type		
$ea_received_rest_ws_content_type = $ea_received_rest_web_service_data["received_content_type"];

//Check if received content type is not application/json and send appropriate response headers.
if ($ea_received_rest_ws_content_type != "application/json") {
	
	//Define Response Header, with 406 Unacceptable HTTP Response Code, back to the Client Application
	header(html_escaped_output($_SERVER['SERVER_PROTOCOL']) . ' 406 Unacceptable');
	
}//close of if ($ea_received_rest_ws_content_type != "application/json") {

// Auth token validation 
//apache_request_headers() is not available in FastCGI with PHP-FPM Setups. A workaround is to use alternative functions or in conjunction with .htaccess based directives.
//$ea_received_request_headers = apache_request_headers();

//getRequestHeaders() is used to collect Request Headers w.r.t. REST API, when apache_request_headers() function is unavailable.
$ea_received_request_headers = getRequestHeaders();

//JSON Encode the Request Headers, to show them in the Log.
$ea_received_request_headers_json_encoded = json_encode($ea_received_request_headers);

foreach ($ea_received_request_headers as $ea_received_request_header => $ea_received_request_header_value) {
	if (strtolower($ea_received_request_header) == "authorization") {
		list($ea_auth_token) = sscanf(trim($ea_received_request_header_value), 'Bearer %s');
	}//close of if (strtolower($ea_received_request_header) == "authorization") {
		
}//close of foreach ($ea_received_request_headers as $ea_received_request_header => $ea_received_request_header_value) {

if ($ea_auth_token != "") {		
	
	//$ea_auth_token_validation_status = validateAuthToken($ea_auth_token);
	$ea_auth_token_validation_status = ea_validate_hs256_alg_jwt_token($ea_auth_token);
}//close of if ($ea_auth_token != "") {

?>