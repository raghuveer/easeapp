<?php
if (defined('STDIN') ) {
  //echo("Running from CLI");
} else {
  //echo("Not Running from CLI");
  defined('START') or die;
}//close of else of if (defined('STDIN') ) {

/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or               * Contributors and is licensed as per their Open Source License choices.
 *
 * These are set of functions to handle JSON Web Tokens using HS256.
 */

//Generate JWT Auth Token using HS256 (SHA256 using HMAC) Algorithm
function ea_generate_hs256_alg_jwt_token($user_id_input, $user_type_input, $user_privileges_list_input, $jwt_iss_input, $jwt_sub_input, $jwt_aud_input, $jwt_iat_input, $jwt_nbf_input, $jwt_exp_input, $jwt_token_rel_unique_jti_input) {
	
	global $jwtAuthTokenSecretKey,$jwtTokenHashAlgorithm;
	
	$hs256_alg_jwt_token = "";
		
	$jwt_header = array();
	$jwt_payload = array();
	
	//Inject typ and alg inputs as per JSON Web Tokens Specification in to $jwt_header array
	$jwt_header["typ"] = "JWT";
	$jwt_header["alg"] = "HS256";
	//print_r($jwt_header);
	
	//JSON Encode the JWT Header
	$jwt_header_json_encoded = json_encode($jwt_header);
	
	//Base64 Encode the JSON Encoded JWT Header String
	$jwt_header_json_encoded_base64_encoded = base64_encode($jwt_header_json_encoded);
	
	//Inject Registered Claims like iat, nbf, exp, iss along with other private claim inputs as per JSON Web Tokens Specification in to $jwt_payload array
	
	//need to create a function to get latest EPOCH as per chosen TIMEZONE,
	//since, $current_epoch gives epoch at GMT< we had added 19800 seconds manually.
	
	//Inject both Registered Claims and Public Claims to Payload
	$jwt_payload["iss"] = $jwt_iss_input;
	$jwt_payload["sub"] = strval($jwt_sub_input);
	$jwt_payload["aud"] = $jwt_aud_input;
	$jwt_payload["iat"] = $jwt_iat_input;
	$jwt_payload["nbf"] = $jwt_nbf_input;
	$jwt_payload["exp"] = $jwt_exp_input;
	$jwt_payload["user-type"] = $user_type_input;
	$jwt_payload["user-privileges-list"] = $user_privileges_list_input;
	$jwt_payload["jti"] = $jwt_token_rel_unique_jti_input;
	//print_r($jwt_payload);
	
	//JSON Encode the JWT Payload
	$jwt_payload_json_encoded = json_encode($jwt_payload);
	
	//Base64 Encode the JSON Encoded JWT Payload String
	$jwt_payload_json_encoded_base64_encoded = base64_encode($jwt_payload_json_encoded);
	
	
	//Base64 Decode the Base64 Encoded JWT Secret Key
	$jwt_secret_base64_encoded = $jwtAuthTokenSecretKey;
	$jwt_secret_base64_decoded = base64_decode($jwt_secret_base64_encoded);
	
	//Create Token Signature using HS256
	$created_token_signature = hash_hmac($jwtTokenHashAlgorithm, $jwt_header_json_encoded_base64_encoded.".".$jwt_payload_json_encoded_base64_encoded, $jwt_secret_base64_decoded, true);
	
	//Base64 URL Encode the Created Token Signature
	$created_token_signature_base64_urlencoded = base64url_encode($created_token_signature); //from /app/includes/other-functions-api.php
	
	//remove padding (=), from Base64 URL Encoded Token Signature
	$created_token_signature_base64_urlencoded_after_removing_padding = str_replace("=", "", $created_token_signature_base64_urlencoded);
	
	//Create JWT Token, using HS256
	$jwt_token_created = $jwt_header_json_encoded_base64_encoded.".".$jwt_payload_json_encoded_base64_encoded.".".$created_token_signature_base64_urlencoded_after_removing_padding;
	//echo $jwt_token_created;
	
	return $jwt_token_created;
	
}

//Verify JWT Auth Token using HS256 (SHA256 using HMAC) Algorithm
function ea_verify_user_hs256_alg_jwt_auth_token_mapping($user_auth_token_id_input, $user_id_input, $is_active_status_input) {
	
	global $dbcon;
	$jwt_auth_token_details_check_sql = "SELECT * FROM `user_auth_tokens` WHERE `user_auth_token_id` =:user_auth_token_id AND `user_id` =:user_id AND `is_active_status` =:is_active_status";	
	$jwt_auth_token_details_check_select_query = $dbcon->prepare($jwt_auth_token_details_check_sql);	
	$jwt_auth_token_details_check_select_query->bindValue(":user_auth_token_id", $user_auth_token_id_input);
	$jwt_auth_token_details_check_select_query->bindValue(":user_id", $user_id_input);
	$jwt_auth_token_details_check_select_query->bindValue(":is_active_status", $is_active_status_input);
	$jwt_auth_token_details_check_select_query->execute();
	
	if($jwt_auth_token_details_check_select_query->rowCount() > 0) {
	   
	    return true;
	   
	}//close of if($jwt_auth_token_details_check_select_query->rowCount() > 0) {
	return false;	
}

//Validate received JWT Authentication Token
/*function validateAuthToken($received_jwt_token){*/
function ea_validate_hs256_alg_jwt_token($received_jwt_auth_token) {
	
	global $current_epoch;
	global $jwtTokenIssuer,$jwtAuthTokenSecretKey,$jwtTokenHashAlgorithm;
	
	//Collect the Base64 Decoded version of the JWT Auth Token's Secret Key (SHA256, in the scope of HS256)
	$jwt_secret_base64_decoded = base64_decode($jwtAuthTokenSecretKey);
	
	//Explode the received JWT Auth Token, to split that in to 3 parts
	$received_jwt_auth_token_exploded = explode(".", $received_jwt_auth_token);
	
	//Do Count the Number of Parts, of the JWT Auth Token
	$received_jwt_auth_token_exploded_count = count($received_jwt_auth_token_exploded);
	
	//Do Verify if the Number of Parts Count = 3
	if ($received_jwt_auth_token_exploded_count == "3") {

	    //Collect the JWT Auth Token Header
		$received_jwt_auth_token_header = $received_jwt_auth_token_exploded[0];
		//echo "received_jwt_auth_token_header: " . $received_jwt_auth_token_header . "<br><br>";
		
		//Collect the JWT Auth Token Payload
		$received_jwt_auth_token_payload = $received_jwt_auth_token_exploded[1];
		//echo "received_jwt_auth_token_payload: " . $received_jwt_auth_token_payload . "<br><br>";

		//Collect the JWT Auth Token Signature
		$received_jwt_auth_token_signature = $received_jwt_auth_token_exploded[2];
		//echo "received_jwt_auth_token_signature: " . $received_jwt_auth_token_signature . "<br><br>";

		//Create Associate Array from JSON Object
		//http://stackoverflow.com/a/2484751
		//Collect JSON Decoded JWT Auth Token's Header
		$received_jwt_auth_token_header_json_decoded = json_decode(base64_decode($received_jwt_auth_token_header), true);

		//Collect JSON Decoded JWT Auth Token's Payload
		$received_jwt_auth_token_payload_json_decoded = json_decode(base64_decode($received_jwt_auth_token_payload), true);
		
		/*
		echo "<pre>";
		print_r($received_jwt_auth_token_header_json_decoded);
		echo "<br><br><br>";
		print_r($received_jwt_auth_token_payload_json_decoded);
		echo "</pre>";
		*/

		//Re-Create Signature, using the extracted Header and Payload of the received JWT Auth Token
		$created_hash_for_verification = hash_hmac($jwtTokenHashAlgorithm, $received_jwt_auth_token_header.".".$received_jwt_auth_token_payload, $jwt_secret_base64_decoded, true);
		
		//Base64 Encode the Created Hash, using the extracted Header and Payload of the received JWT Auth Token
		$created_hash_for_verification_base64_encoded = base64_encode($created_hash_for_verification);


		//As per Base64 URL Encoding Concept that is described in https://tools.ietf.org/html/rfc4648#page-7
		//http://stackoverflow.com/a/11449627
		
		//Base64 URL Encode the Created Hash, using the extracted Header and Payload of the received JWT Auth Token
		$created_hash_for_verification_base64_urlencoded = base64url_encode($created_hash_for_verification);

		//Do Remove padding (=), from the Base64 URL Encoded Hash
		$created_hash_for_verification_base64_urlencoded_after_removing_padding = str_replace("=", "", $created_hash_for_verification_base64_urlencoded);
		
		/*
		echo "Received Signature (base64 decoded): " . base64_decode("T_qDr0_gYt9FZVm1yplQLVCdreCNAVAspVqjQaXvTB4") . "<br>";
		//echo "Received Signature (base64 encoded): " . "T_qDr0_gYt9FZVm1yplQLVCdreCNAVAspVqjQaXvTB4" . "<br>";
		echo "Received Signature (base64 encoded): " . $received_jwt_auth_token_signature . "<br>";
		echo "Created Signature: " . $created_hash_for_verification . "<br>";
		echo "Created Signature (base64 encoded): " . $created_hash_for_verification_base64_encoded . "<br>";
		echo "Created Signature (base64 urlencoded): " . $created_hash_for_verification_base64_urlencoded . "<br>";
		echo "Created Signature (base64 urlencoded after removing padding): " . $created_hash_for_verification_base64_urlencoded_after_removing_padding . "<br>";
		*/
		
		//Do Compare if the Created Hash equals received JWT Auth Token's Signature, in a timing safe comparison approach
		/*if ($created_hash_for_verification_base64_urlencoded_after_removing_padding === $received_jwt_auth_token_signature) {*/
		if ((function_exists('hash_equals')) && (hash_equals($received_jwt_auth_token_signature, $created_hash_for_verification_base64_urlencoded_after_removing_padding))) {
			//Valid Signature Scenario
			
			//Do Check the JWT Auth Token Issuer
			if ($received_jwt_auth_token_payload_json_decoded["iss"] == $jwtTokenIssuer) {

				//echo 'received_jwt_auth_token_payload_json_decoded["exp"]: ' . $received_jwt_auth_token_payload_json_decoded["exp"] . "<br>";          
				//echo 'current_epoch: ' . $current_epoch . "<br>";  
				//Do Compare JWT Auth Token's Values, Token Created Date Time Epoch < Token Expiry Data Time Epoch; Current Date Time Epoch < Token Expiry Date Time Epoch
				if (($received_jwt_auth_token_payload_json_decoded["iat"] < $received_jwt_auth_token_payload_json_decoded["exp"]) && ($current_epoch < $received_jwt_auth_token_payload_json_decoded["exp"])) {
					//Valid Token information 
					
					//Do Collect values of SUB & JTI Registered Claims, from the received JWT Auth Token Payload
					$user_id = $received_jwt_auth_token_payload_json_decoded['sub'];
					$jwt_auth_token_jti = $received_jwt_auth_token_payload_json_decoded['jti'];
					
					//Do Check User's Association with the Unique JWT Auth Token Reference (i.e. by using values of SUB & JTI Registered Claims)
					//$verification = verifyCustomerToken($user_id, $received_jwt_auth_token);
					$verification = ea_verify_user_hs256_alg_jwt_auth_token_mapping($jwt_auth_token_jti, $user_id, "1");
					if ($verification) {
						
						return true;
						
					} else {
						//Token got Expired In database as Status as '0' or Not found the token in table
						//echo "Token not found in table or Status is '0'";
					}//close of else of if ($verification) {
					
				} else {
					//Token got Expired
					//echo "Token got Expired";					
				}//close of else of if (($received_jwt_auth_token_payload_json_decoded["iat"] < $received_jwt_auth_token_payload_json_decoded["exp"]) && ($current_epoch < $received_jwt_auth_token_payload_json_decoded["exp"])) {

			} else {
				//Invalid issuer
				//echo "Invalid Issuer";				
			}//close of else of if ($received_jwt_auth_token_payload_json_decoded["iss"] == $jwtTokenIssuer) {
			
		} else {
			//Invalid Signature
			//echo "Invalid Signature";
		}//close of else of if ((function_exists('hash_equals')) && (hash_equals($received_jwt_auth_token_signature, $created_hash_for_verification_base64_urlencoded_after_removing_padding))) {
	
	} else {
		//reject the JWT Token Input, as it is not Valid.
		//echo "Invalid JWT Token.";
	}//close of else of if ($received_jwt_auth_token_exploded_count == "3") {
	return false;	
}


function ea_get_user_rel_active_jwt_token_details($sm_memb_id_input) {
	
	global $dbcon;
	
	$constructed_array = array();
		
	$user_active_token_details_get_sql = "SELECT * FROM `user_auth_tokens` WHERE `user_id`=:user_id AND `is_active_status`=:is_active_status";	
	$user_active_token_details_get_select_query = $dbcon->prepare($user_active_token_details_get_sql);	
	$user_active_token_details_get_select_query->bindValue(":user_id", $sm_memb_id_input);
	$user_active_token_details_get_select_query->bindValue(":is_active_status", "1");
	$user_active_token_details_get_select_query->execute();
	
	if($user_active_token_details_get_select_query->rowCount() > 0) {
	    $user_active_token_details_get_select_query_result = $user_active_token_details_get_select_query->fetch();
	    //print_r($user_active_token_details_get_select_query_result);
		$user_auth_token_id = $user_active_token_details_get_select_query_result["user_auth_token_id"];
		$constructed_array[$user_auth_token_id] = $user_active_token_details_get_select_query_result;
	    return $constructed_array;
	   
	}//close of if($user_active_token_details_get_select_query->rowCount() > 0) {
	return $constructed_array;
	
}

function ea_update_user_rel_active_jwt_token_status($user_auth_token_id_input) {
	
	global $dbcon;
	
	$user_rel_active_token_update_sql = "UPDATE `user_auth_tokens` SET `is_active_status`=:is_active_status WHERE `user_auth_token_id`=:user_auth_token_id";
	$user_rel_active_token_update_query = $dbcon->prepare($user_rel_active_token_update_sql);
	$user_rel_active_token_update_query->bindValue(":is_active_status", "0");
	$user_rel_active_token_update_query->bindValue(":user_auth_token_id",$user_auth_token_id_input);
	$user_rel_active_token_update_query->execute(); 		
	
}

function ea_insert_user_rel_active_jwt_token_refs($user_id_input, $date_time_token_creation_input, $jwt_iss_input, $jwt_sub_input, $jwt_aud_input, $jwt_iat_input, $jwt_nbf_input, $jwt_exp_input, $is_reusable_input, $is_active_status_input) {
	
	global $dbcon;
	
	$new_user_auth_token_insert_sql = "INSERT INTO `user_auth_tokens`(`user_id`, `date_time_token_creation`, `jwt_iss`, `jwt_sub`, `jwt_aud`, `jwt_iat`, `jwt_nbf`, `jwt_exp`, `is_reusable`, `is_active_status`) VALUES (:user_id,:date_time_token_creation,:jwt_iss,:jwt_sub,:jwt_aud,:jwt_iat,:jwt_nbf,:jwt_exp,:is_reusable,:is_active_status)";
	$new_user_auth_token_insert_query = $dbcon->prepare($new_user_auth_token_insert_sql);						
	$new_user_auth_token_insert_query->bindValue(":user_id",$user_id_input);
	$new_user_auth_token_insert_query->bindValue(":date_time_token_creation",$date_time_token_creation_input);
	$new_user_auth_token_insert_query->bindValue(":jwt_iss",$jwt_iss_input);
	$new_user_auth_token_insert_query->bindValue(":jwt_sub",$jwt_sub_input);
	$new_user_auth_token_insert_query->bindValue(":jwt_aud",$jwt_aud_input);	
	$new_user_auth_token_insert_query->bindValue(":jwt_iat",$jwt_iat_input);	
	$new_user_auth_token_insert_query->bindValue(":jwt_nbf",$jwt_nbf_input);	
	$new_user_auth_token_insert_query->bindValue(":jwt_exp",$jwt_exp_input);	
	$new_user_auth_token_insert_query->bindValue(":is_reusable",$is_reusable_input);	
	$new_user_auth_token_insert_query->bindValue(":is_active_status",$is_active_status_input);	
	if($new_user_auth_token_insert_query->execute()){
		
		$jti = $dbcon->lastInsertId();
		return $jti;
		
	}//close of if($new_user_auth_token_insert_query->execute()){
	return "";	
	
}

function base64url_encode($s) {
	return str_replace(array('+', '/'), array('-', '_'), base64_encode($s));
}


function base64url_decode($s) {
	return base64_decode(str_replace(array('-', '_'), array('+', '/'), $s));
}

//Collect Request Headers w.r.t. REST API, when apache_request_headers() function is unavailable
//https://stackoverflow.com/a/541463
function getRequestHeaders() {
	$headers = array();
	foreach($_SERVER as $key => $value) {
		if (substr($key, 0, 5) <> 'HTTP_') {
			continue;
		}
		$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
		$headers[$header] = $value;
	}
	return $headers;
}

?>