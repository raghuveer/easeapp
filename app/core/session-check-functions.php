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
 */
 
	 /**
	 *  This is to issue Caching Headers, in the application
	 *  origin.
	 *
	 */ 
	function ea_application_session_settings() {
		global $session_max_lifetime_bef_cleanup, $site_protocol_name, $active_session_backend, $files_based_session_storage_location_choice, $files_based_session_storage_custom_path;
		
		// **PREVENTING SESSION HIJACKING**
		// Prevents javascript XSS attacks aimed to steal the session ID
		ini_set('session.cookie_httponly', 1);
		// Uses a secure connection (HTTPS) to send cookies on https. (This has to be defined when ssl certificate is installed on the domain name and https is enabled for the hostname, otherwise, session variables will be cleared and made empty after the redirect).

		if ($site_protocol_name == "https://") {
			ini_set('session.cookie_secure', 1);//this has to be enabled only on HTTPS
		} else {
			ini_set('session.cookie_secure', 0);//this has to be enabled only on HTTPS
		}//close of else of if ($site_protocol_name == "https://") {

		ini_set('session.cookie_lifetime', 0); 
		//ini_set('session.entropy_file', '/dev/urandom'); //Removed in PHP 7.1.0.
		//ini_set('session.entropy_length', 512); //Removed in PHP 7.1.0
		//ini_set('session.hash_function', 'whirlpool'); //whirlpool as hash function to generate session ids. This setting was introduced in PHP 5. Removed in PHP 7.1.0. 
		// **PREVENTING SESSION FIXATION**
		// Session ID cannot be passed through URLs
		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.use_trans_sid', 0);
		//ini_set('session.hash_bits_per_character', 5); //Removed in PHP 7.1.0.

		//Session Handler and Storage Path Checks
		if ($active_session_backend == "files") {
			if ($files_based_session_storage_location_choice == "custom-location") {
				//http://in3.php.net/manual/en/function.mkdir.php
				//some observations: 0711 or 0755 or may be 0777 for folders work better, in this scenario.
				if (!is_dir($files_based_session_storage_custom_path)) {
				
					mkdir($files_based_session_storage_custom_path, 0755);
					chmod($files_based_session_storage_custom_path, 0755);
					clearstatcache();		
				
				} else if (!is_writable($files_based_session_storage_custom_path)) {
				
					chmod($files_based_session_storage_custom_path, 0755);
					clearstatcache();		
				
				}//close of else if of if (!is_dir($files_based_session_storage_custom_path)) {
				
				//sessions to be stored in "sessions" folder that will be located outside "public_html" folder ($files_based_session_storage_custom_path, as defined in /app/core/main-config.php)
				ini_set('session.save_path',$files_based_session_storage_custom_path);

			}//Close of if ($files_based_session_storage_location_choice == "custom-location") {
				
		} else if ($active_session_backend == "redis") {
			//sessions to be stored in Redis
			ini_set('session.save_handler', 'redis');

			//sessions to be stored in Redis Path
			ini_set('session.save_path', $single_redis_server_session_backend_host); // as per /app/core/main-config.php
		}//close of else if of if ($active_session_backend == "files") {
			

		//sessions to be stored in "sessions" folder that will be located outside "public_html" folder
		//ini_set('session.save_path',dirname($_SERVER['DOCUMENT_ROOT']) . "/sessions");

		//sessions to be stored in Redis
		//ini_set('session.save_handler', 'redis');

		//sessions to be stored in Redis Path
		//ini_set('session.save_path', "tcp://localhost:6379");
		ini_set('session.gc_maxlifetime', $session_max_lifetime_bef_cleanup);
		//ini_set('session.gc_maxlifetime', 86400);
		//enable garbage collection for sessions which will be stored in custom chosen folder that will be placed outside public_html folder
		ini_set('session.gc_probability', 1);
		ini_set('session.gc_divisor ', 100);


		//ini_set('session.referer_check', 0); // Checks for HTTP Referer, and if the defined sub string do not match, then the session id will be marked as invalid. This potentially may not allow to have an established session, in above defined scenario.

	}
	
	
	//check to know if there is an active session and redirect them accordingly (page which works before login).
	//function if_session_is_valid($valid_session_keyword, $login_function_project_main_filename, $to_be_loaded_filename)
	function if_session_is_valid($valid_session_keyword, $to_be_loaded_filename, $login_function_project_main_filename)
	{
	  if( (!isset($valid_session_keyword)) )
	  {
			$valid_session_keyword = "no";
			//echo "you are not authorised to access this page";
			return $to_be_loaded_filename;
	  }
	  elseif( (isset($valid_session_keyword)) && ($valid_session_keyword != 'yes') )
		{
			$valid_session_keyword = "no";
			return $to_be_loaded_filename; 
		}
	  elseif( (isset($valid_session_keyword)) && ($valid_session_keyword == 'yes') )
		{
			return $login_function_project_main_filename;
		}
				
	}

	//check to know if there is an active session and route the request to pages (which open only to logged in users)
	function is_session_valid($valid_session_keyword, $to_be_loaded_filename){
	  if( (!isset($valid_session_keyword)) )
	  {
			$valid_session_keyword = "no";
			//echo "you are not authorised to access this page";
			return "need-authentication.php";
	  }
	  elseif( (isset($valid_session_keyword)) && ($valid_session_keyword != 'yes') )
		{
			$valid_session_keyword = "no";
			//echo "you are not authorised to access this page";
			return "need-authentication.php"; 
		}
	  elseif( (isset($valid_session_keyword)) && ($valid_session_keyword == 'yes') )
		{
			return $to_be_loaded_filename;
		}
				
	}
?>