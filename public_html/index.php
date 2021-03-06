<?php
ob_start();
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 */
//headers to enable cors in php for one or more websites
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: http://www.remotewebsite.com');
 
//To prevent direct access to a file inside public root or public_html or www folder, 
define("START", "No Direct Access", true);

//Filtered $_SERVER Variables (required ones)
include "../app/core/server-var-info.php";

//Header Functions
include "../app/includes/header-functions.php";

//Issues CORS headers for the application
ea_cors_headers();

//Issues Security Headers for the application
ea_application_security_headers();

//Main Application Configuration File
include "../app/core/main-config.php";

//include timer class file and create object
include "../app/class/Timer.php";
$load_time1 = new Timer();

//For Web Applications, Timer Start, to know how much time, an application request consumed 
if ($page_is_ajax != "1") {
  // calculate the time it takes to run page load time using timer #1 start
  $load_time1->start();
}//close of if ($page_is_ajax != "1") {
	
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

if(function_exists("date_default_timezone_set")) {
//Define the Default timezone.	
date_default_timezone_set($date_default_timezone_set); // $date_default_timezone_set from /app/core/main-config.php
}//close of if(function_exists("date_default_timezone_set")) {
	

//HTMLawed Library to purify and filter HTML (http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/)
//include "../app/includes/htmLawed.php"; 
include "../app/includes/htmLawed-1241.php"; 

//Few Validation and Sanitizing Functions
include "../app/includes/validate-sanitize-functions.php";

//This holds all Session specific and Session Checking Functions
include "../app/core/session-check-functions.php";

//This does the pre-defined host name, thus observing the host of the script, if it is Dev / Live Environment
include "../app/core/hostname-check.php";

//This is to automatically define a finite list of Routing Engine Variables (20 will be created in this scenario) (http://stackoverflow.com/a/2922688)
for ($i = 0; $i <= 20; $i++) {
    $routing_eng_var = 'routing_eng_var_' . $i;
    //echo $routing_eng_var . "<br>";
    $$routing_eng_var = ""; //make column stuff, first time this will be xm0, then xm1, etc.
}//for ($i = 0; $i <= 20; $i++) {
	
//This is the simple routing engine of Easeapp Framework that is based on $_SERVER["REQUEST_URI"]
include "../app/core/routing-engine.php";


//This is where the core routing engine rules are defined
include "../app/core/routing-engine-rules.php";

//This is where the user defined routing engine rules are defined
include "../app/core/routing-engine-user-rules.php";

//This is where the route specific functions, that handles route parsing, pass request data to models, inject model data in to views and for finally generating the responses
include "../app/includes/route-functions.php";

//This is where the route parser lies, that routes the request for the particular virtual resource
include "../app/core/route-parser.php";

//Session Settings
ea_application_session_settings();

//Start Session
session_start();

//Define User Session with pre-login scenario and conventions
if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] != "yes")) {
   $_SESSION['loggedin'] = "no";
   $_SESSION['sm_user_type'] = "";
} else if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] != "yes")) {
   $_SESSION['loggedin'] = "no";
   $_SESSION['sm_user_type'] = "";
}//close of else if of if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] != "yes")) {

//Issues Browser Cache specific Headers for the Application	
ea_application_browser_cache_headers();

//Site Construction / Maintenance
if ($app_site_status == "construction") {
  //echo "<center>This website is under rapid construction sessions, please visit us again, thank you</center>";
  exit;
} else if ($app_site_status == "maintenance") {
  //echo "<center>This website is taken down for maintenance, please visit us again, thank you</center>";
  exit;
}//close of else if of if ($app_site_status == "construction") {
	

//Debug Settings 
if ($debug_mode == "ON") {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  //ini_set('display_errors', true);
  //echo "debug mode on";
} elseif($debug_mode == "OFF") {
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  error_reporting(0);
  //echo "debug mode off";
}//close of else if of if ($debug_mode == "ON") {
	
//This holds all User Authorization Functions that ensures if a particular access level is allowed on the particular route or not
include "../app/core/user-authorization-functions.php";

//PHPMailer Library: This is to send Email through SMTP / Sendmail in PHP Scripts
include "../app/includes/phpmailer-v605/src/PHPMailer.php";
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$phpmailer_sendmail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$phpmailer_sendmail->IsSendmail(); // telling the class to use SendMail transport
$phpmailer_sendmail->CharSet="utf-8";

//This is a compilation of date related custom functions
include "../app/includes/date-functions.php";

//This is a wrapper to count number of SQL Queries
include "../app/class/PDOEx.php";

//This hosts the actual Database details of both dev and production environments along with corresponding db connections
include "../app/core/db-connect-main.php";

//This contains some of the basic PDO Prepared Statements based DB Functions, for MySQL & MariaDB Databases.
include "../app/includes/mysql-mariadb-database-functions.php";

//Include a Logger
include "../app/class/EALogger.php";

//Include a DB Manager, for MySQL and MariaDB Databases
include "../app/class/EASQLDBManager.php";

//This hosts any generic application related functions for the application that uses this framework
include "../app/includes/other-functions.php";

//This is a generic class to get headers using curl
include "../app/class/get_header_info_curl.php";

//EasyPHPThumbnail: This is a fully functional image processing and thumbnail creating library
include "../app/includes/easyphpthumbnail.class.php";


//FQDN and Sub Domain Name Parsing by jeremykendall-php-domain-parser start https://github.com/jeremykendall/php-domain-parser
include "../app/includes/jeremykendall-php-domain-parser/src/Pdp/PublicSuffixListManager.php";
include "../app/includes/jeremykendall-php-domain-parser/src/Pdp/PublicSuffixList.php";
include "../app/includes/jeremykendall-php-domain-parser/src/Pdp/Parser.php";
include "../app/includes/jeremykendall-php-domain-parser/src/pdp-parse-url.php";
include "../app/includes/jeremykendall-php-domain-parser/src/Pdp/Uri/Url/Host.php";
include "../app/includes/jeremykendall-php-domain-parser/src/Pdp/Uri/Url.php";

use Pdp\PublicSuffixListManager;
use Pdp\Parser;
// Obtain an instance of the parser
$pslManager = new PublicSuffixListManager();
$parser = new Parser($pslManager->getList());
//FQDN and Sub Domain Name Parsing by jeremykendall-php-domain-parser end https://github.com/jeremykendall/php-domain-parser

//For UUID Generation
include "../app/includes/uuid.php";

//This hosts any miscellaneous set of functions that are useful and that do not fit elsewhere
include "../app/includes/misc-functions.php";

		
if (version_compare(PHP_VERSION, '7.2.0') >= 0) {
	//echo 'I am at least PHP version 7.2.0, my version: ' . PHP_VERSION . "\n<br><br>";
	//Include Constant Time Encoding Library v2.0 from Paragonie
	include "../app/includes/constant-time-encoding-v20/constant-time-encoding-v20-includes.php";
	//Include Halite Library from Paragonie
	include "../app/includes/halite-v441/halite-v441-includes.php";
	
	/*//Check if Libsodium is setup correctly, result will be bool(true), if all is good, https://stackoverflow.com/a/37687595
	//var_dump(ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly());
	//echo ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly(true);	
	//echo "<br><br>";
	//Check the installed versions of Libsodium
	echo "<br>var_dump result<br>";
	var_dump([
		SODIUM_LIBRARY_MAJOR_VERSION,
		SODIUM_LIBRARY_MINOR_VERSION,
		SODIUM_LIBRARY_VERSION
	]);
	echo "<br>print_r result<br>";
	print_r([
		SODIUM_LIBRARY_MAJOR_VERSION,
		SODIUM_LIBRARY_MINOR_VERSION,
		SODIUM_LIBRARY_VERSION
	]);
	echo "<br><hr><br><pre>";
	*/

	
	//Check, if Libsodium is setup correctly
	if (ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly() === true) {
		//echo "true<br>";
		/*//Retrieve the previous saved Symmetric Encryption key from the file
		$pg_symmetric_encryption_key = \ParagonIE\Halite\KeyFactory::loadEncryptionKey($site_home_path . $pg_generated_enc_keys_folder_name. $pg_symmetric_encryption_key_filename);*/

		//Retrieve the previous saved Asymmetric Anonymous Encryption key from the file
		$pg_asymmetric_anonymous_encryption_keypair = \ParagonIE\Halite\KeyFactory::loadEncryptionKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_keypair_filename);

		$pg_asymmetric_anonymous_encryption_secret_key = $pg_asymmetric_anonymous_encryption_keypair->getSecretKey();
		$pg_asymmetric_anonymous_encryption_public_key = $pg_asymmetric_anonymous_encryption_keypair->getPublicKey();
		
		//Retrieve the previous saved Asymmetric Anonymous Encryption key for Logs from the file
		$pg_asymmetric_anonymous_encryption_logs_keypair = \ParagonIE\Halite\KeyFactory::loadEncryptionKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_logs_keypair_filename);

		$pg_asymmetric_anonymous_encryption_logs_secret_key = $pg_asymmetric_anonymous_encryption_logs_keypair->getSecretKey();
		$pg_asymmetric_anonymous_encryption_logs_public_key = $pg_asymmetric_anonymous_encryption_logs_keypair->getPublicKey();

		//Retrieve the previous saved Asymmetric Authentication key from the file
		$pg_asymmetric_authentication_keypair = \ParagonIE\Halite\KeyFactory::loadSignatureKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_keypair_filename);

		$pg_asymmetric_authentication_secret_key = $pg_asymmetric_authentication_keypair->getSecretKey();
		$pg_asymmetric_authentication_public_key = $pg_asymmetric_authentication_keypair->getPublicKey();
		
		//Retrieve the previous saved Asymmetric Authentication key for Logs from the file
		$pg_asymmetric_authentication_logs_keypair = \ParagonIE\Halite\KeyFactory::loadSignatureKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_logs_keypair_filename);

		$pg_asymmetric_authentication_logs_secret_key = $pg_asymmetric_authentication_logs_keypair->getSecretKey();
		$pg_asymmetric_authentication_logs_public_key = $pg_asymmetric_authentication_logs_keypair->getPublicKey();
		
				
		/* sample codes start*/
		/*
		$message = "1 start";

		$sealed = \ParagonIE\Halite\Asymmetric\Crypto::seal(
			new ParagonIE\Halite\HiddenString(
				$message
			),
			$pg_asymmetric_anonymous_encryption_public_key
		);
		echo "sealed: <br>" . $sealed . "<br><hr><br>";


		$opened = \ParagonIE\Halite\Asymmetric\Crypto::unseal(
			$sealed,
			$pg_asymmetric_anonymous_encryption_secret_key
		);

		echo "opened: <br>" . $opened . "<br><hr><br>";

		$signature = \ParagonIE\Halite\Asymmetric\Crypto::sign(
			$sealed,
			$pg_asymmetric_authentication_secret_key
		);
		echo "signature: <br>" . $signature . "<br><hr><br>";

		$valid = \ParagonIE\Halite\Asymmetric\Crypto::verify(
			$sealed,
			$pg_asymmetric_authentication_public_key,
			$signature
		);
		echo "Signature Verification Status: <br>" . $valid . "<br><hr><br>";
		*/
		/*sample code end*/
		//exit;

		
		
	}//close of if (ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly() === true) {
		
		
	
}//close of if (version_compare(PHP_VERSION, '7.2.0') >= 0) {

//Include a Custome Halite Operation
include "../app/class/EAHalite.php";
$objEAHalite = new EAHalite();

$db = new DB();

//This hosts user defined REST Web Service API Functions, when and if REST Web Services are offered
include "../app/includes/other-functions-api.php";

//This hosts User Authentication and Info Functions
include "../app/includes/user-authentication-info-functions.php";

//This holds all JSON Web Token Creating / Checking Functions
include "../app/includes/json-web-token-functions.php";

/*
$eventLogFileName = "test-log";
$eventLog = new Logger($eventLogFileName, true);
$eventLog->logNewSeperator();
//$eventLog->log("Content-type => " . $_SERVER["CONTENT_TYPE"];
$eventLog->log("Server protocol => " . $_SERVER['SERVER_PROTOCOL']);
$eventLog->log("REQUEST URI => " . $_SERVER['REQUEST_URI']);
*/
//Include a Template Engine here, if integrating some template engine
// 1) Init
/* include '../app/template-library/krupa.php';

//Configure krupa:
$get_position_names = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/templates/' . $chosen_template . '/user-defined-positions.txt');
$get_position_names_arr = explode(",", $get_position_names);
print_r($get_position_names_arr);
$template_config = array(
	'templateDir' => $_SERVER['DOCUMENT_ROOT'].'/templates/' . $chosen_template . '/',
  'snippet_dir' => $_SERVER['DOCUMENT_ROOT'].'/templates/' . $chosen_template . '/snippets/',
  'user_defined_positions' => $get_position_names_arr,
	'useCache' => false,
	'cacheDir' => $_SERVER['DOCUMENT_ROOT'].'/templates/' . $chosen_template . '/cache/',
	'cacheTTL' => 3);
*/  
/*  $config = array(
                 //"tpl_dir"       => "templates/raintpl3/",
                 "tpl_dir"       => "templates/" . $chosen_template . "/",
                  "cache"        => "cache/",
                 "debug"         => true // set to false to improve the speed
); */

//Ajax Requests / REST Web Services: This does the loading of the respective resource for ajax / REST Web Service Requests
if (($page_is_ajax == "1") && ($page_is_frontend == "3")) {
    if ($page_filename != "not-found.php"){
	    if ($page_is_web_service_endpoint == "0"){
			//Pure Ajax Call Scenario
	        include "ajax-pages/" . $page_filename;
  	    } else if ($page_is_web_service_endpoint == "1"){
			//Web Service Endpoint Scenario
			include "rest-apis/" . "web-service-endpoint-header.php";
	        include "rest-apis/" . $page_filename;
  	    } else if ($page_is_web_service_endpoint == "2"){
			//Either Ajax Call or Web Service Endpoint Scenario (Common for BOTH)
	        include "ajax-common/" . $page_filename;
  	    } else if ($page_is_web_service_endpoint == "3"){
			//Is not an ajax request
	        include "ajax-common/" . "incorrect-route-ajax-settings.php";
  	    }
	  //include "ajax-pages/" . $page_filename;
  	}
}

//$k_te = new krupa($template_config);

//$k_te->start();

//Web Applications: This does the loading of the Modal Aspect (logic with db interaction) respective resource for regular web application requests 
if ($page_is_ajax != "1") {
include "../app/core/model-body.php";
}
// Step 5: Parse the Template

//$k_te->parseTemplate($route_filename);

// Step 6: Stop the Template Engine

//$k_te->stop();

//$t->draw($route_filename);
if ($page_is_ajax != "1") {
if (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "1")) {
   //frontend related page /template to be loaded
   include "templates/" . $chosen_frontend_template . "/header-top.php";
   
   include "../app/core/additional-config.php";
   include "templates/" . $chosen_frontend_template . "/header.php";     
 } elseif (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "0")) {
   //admin related pages / template to be loaded
   include "templates/" . $chosen_template . "/header-top.php";
   
   include "../app/core/additional-config.php";
   include "templates/" . $chosen_template . "/header.php";     
 } elseif (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "2")) {
   if (isset($_SESSION['sm_user_type']) && ($_SESSION['sm_user_type'] == "member")) {
   //frontend related page /template to be loaded
    include "templates/" . $chosen_frontend_template . "/header-top.php";
   
   include "../app/core/additional-config.php";
   include "templates/" . $chosen_frontend_template . "/header.php";
    //echo "member";
   } elseif (isset($_SESSION['sm_user_type']) && (($_SESSION['sm_user_type'] == "admin") || ($_SESSION['sm_user_type'] == "super_admin"))) {
   //admin related pages / template to be loaded 
    include "templates/" . $chosen_template . "/header-top.php";
   
   include "../app/core/additional-config.php";
   include "templates/" . $chosen_template . "/header.php";
    //echo "admin or super admin";
   } else {
   //show member related pages / template to be loaded 
    include "templates/" . $chosen_frontend_template . "/header-top.php";
   
   include "../app/core/additional-config.php";
   include "templates/" . $chosen_frontend_template . "/header.php";
    //echo "else condition";
   }     
 } elseif (($page_filename != "rss-feeds-view.php") && (($page_is_frontend != "0") || ($page_is_frontend != "1") || ($page_is_frontend != "2")) && ($page_is_frontend == "3")) {
   //inappropriate template settings reporting page
    //include "templates/incorrect-template-settings.php";
    echo "<h1>Wrong Template Settings</h1>";     
 }
 
include "../app/core/body.php";

if (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "1")) {
   //frontend related page /template to be loaded
   include "templates/" . $chosen_frontend_template . "/footer.php";     
 } elseif (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "0")) {
   //admin related pages / template to be loaded 
   include "templates/" . $chosen_template . "/footer.php";     
 } elseif (($page_filename != "rss-feeds-view.php") && ($page_is_frontend == "2")) {
   if (isset($_SESSION['sm_user_type']) && ($_SESSION['sm_user_type'] == "member")) {
   //frontend related page /template to be loaded
    include "templates/" . $chosen_frontend_template . "/footer.php";
    //echo "member";
   } elseif (isset($_SESSION['sm_user_type']) && (($_SESSION['sm_user_type'] == "admin") || ($_SESSION['sm_user_type'] == "super_admin"))) {
   //admin related pages / template to be loaded 
    include "templates/" . $chosen_template . "/footer.php";
    //echo "admin or super admin";
   } else {
   //show member related pages / template to be loaded 
    include "templates/" . $chosen_frontend_template . "/footer.php";
    //echo "else condition";
   }     
 } elseif (($page_filename != "rss-feeds-view.php") && (($page_is_frontend != "0") || ($page_is_frontend != "1") || ($page_is_frontend != "2")) && ($page_is_frontend == "3")) {
   //inappropriate template settings reporting page
    //include "templates/incorrect-template-settings.php";
    echo "<h4>Site Management</h4>";     
 }
}

ob_flush();
?>