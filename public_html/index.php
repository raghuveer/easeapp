<?php
ob_start();
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */
//headers to enable cors in php for one or more websites
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: http://www.remotewebsite.com');
header('Content-Type:text/html; charset=UTF-8');
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: pre-check=0', false ); //post-check=0 is removed, as per guidelines of Fiddler
//header( 'Pragma: no-cache' ); //this Pragma header is commented, as this will be useful only on IE Browser, as suggested in Fiddler.
//prevent mimetype sniffing
header('x-content-type-options: nosniff');
//Clickjacking Prevention, while allowing to iframe the page from sameorigin in php
//header('X-Frame-Options', 'SAMEORIGIN', false);
//Clickjacking Prevention overall without allowing sameorigin or a different origin from iframing the page in php
header('X-Frame-Options: DENY');
//remove php version information header (when installed php is < v5.3), Note: it worked in php 5.5 as well
//header('x-powered-by:');
//remove php version information header (when installed php is => v5.3), this is better as it removes the header instead of replacing the info with something else
header_remove('x-powered-by');
//to allow flash to share client side data between its applications in php
header('X-Permitted-Cross-Domain-Policies: master-only');
// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);
// Uses a secure connection (HTTPS) to send cookies on https. (This has to be defined when ssl certificate is installed on the domain name and https is enabled for the hostname, otherwise, session variables will be cleared and made empty after the redirect).
//ini_set('session.cookie_secure', 1);
ini_set('session.cookie_lifetime', 0); 
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', 512);
ini_set('session.hash_function', 'whirlpool'); //is whirlpool that necessary?
// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid', 0);
ini_set('session.hash_bits_per_character', 5);
//sessions to be stored in "sessions" folder that will be located outside "public_html" folder
ini_set('session.save_path',dirname($_SERVER['DOCUMENT_ROOT']) . "/sessions");
ini_set('session.gc_maxlifetime', 7200);
//enable garbage collection for sessions which will be stored in custom chosen folder that will be placed outside public_html folder
ini_set('session.gc_probability', 1);

//ini_set('session.referer_check', 0); // not allowing to have an established session
session_start();
if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] != "yes")) {
   $_SESSION['loggedin'] = "no";
   $_SESSION['sm_user_type'] = "";
} elseif ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] != "yes")) {
   $_SESSION['loggedin'] = "no";
   $_SESSION['sm_user_type'] = "";
}
//To prevent direct access to a file inside public root or public_html or www folder, 
define("START", "No Direct Access", true);

//include timer class file and create object
include "../app/class/Timer.php";
$load_time1 = new Timer();
 
if ($page_is_ajax != "1") {
  // calculate the time it takes to run page load time using timer #1 start
  $load_time1->start();
}

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
include "../app/core/server-var-info.php";
include "../app/core/main-config.php";

if ($app_site_status == "construction") {
  echo "<center>This website is under rapid construction sessions, please visit us again, thank you</center>";
  exit;
} elseif ($app_site_status == "maintenance") {
  echo "<center>This website is taken down for maintenance, please visit us again, thank you</center>";
  exit;
}
 
if($debug_mode == "ON")
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  //ini_set('display_errors', true);
  //echo "debug mode on";
}
elseif($debug_mode == "OFF")
{
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  error_reporting(0);
  //echo "debug mode off";
}
if(function_exists("date_default_timezone_set"))
{
//Define the Default timezone.	
date_default_timezone_set($date_default_timezone_set); // $date_default_timezone_set from /app/core/main-config.php
}
//PHPExcel Library to process excel files (both read / write excel files in php)
include "../app/includes/Classes/PHPExcel.php";
include "../app/includes/Classes/PHPExcel/IOFactory.php";

//HTMLawed Library to purify and filter HTML (http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/)
include "../app/includes/htmLawed.php"; 
include "../app/includes/validate-sanitize-functions.php";

// This token is used by forms to prevent cross site forgery attempts
if (!isset($_SESSION['nonce'])) {
$_SESSION['nonce'] = create_csrf_nonce($hash_algorithm, "20"); //$hash_algorithm from /app/core/main-config.php
}

//This does the pre-defined host name, thus observing the host of the script, if it is Dev / Live Environment
include "../app/core/hostname-check.php";

//This holds all Session Checking Functions
include "../app/core/session-check-functions.php";

//This holds all User Authorization Functions that ensures if a particular access level is allowed on the particular route or not
include "../app/core/user-authorization-functions.php";

//PHPMailer Library: This is to send Email through SMTP / Sendmail in PHP Scripts
include "../app/includes/phpmailer/class.phpmailer.php";
$phpmailer_sendmail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$phpmailer_sendmail->IsSendmail(); // telling the class to use SendMail transport
$phpmailer_sendmail->CharSet="utf-8";

//This is to define a finite list of variables (http://stackoverflow.com/a/2922688)
for($i = 0; $i <= 20; $i++)
{
    $routing_eng_var = 'routing_eng_var_' . $i;
    //echo $routing_eng_var . "<br>";
    $$routing_eng_var = ""; //make column stuff, first time this will be xm0, then xm1, etc.
}

//This is the simple routing engine of Easeapp Framework that is based on $_SERVER["REQUEST_URI"]
include "../app/core/routing-engine.php";

//This is where the core routing engine rules are defined
include "../app/core/routing-engine-rules.php";

//This is where the user defined routing engine rules are defined
include "../app/core/routing-engine-user-rules.php";

//This is where the controller lies, that routes the request for the particular virtual resource
include "../app/core/controller.php";

//This is a compilation of date related custom functions
include "../app/includes/date-functions.php";

//This is a wrapper to count number of SQL Queries
include "../app/class/PDOEx.php";

//This hosts the actual Database details of both dev and production environments along with corresponding db connections
include "../app/core/db-connect-main.php";

//This contains some of the basic PDO Prepared Statements based DB Functions
include "../app/includes/db-functions.php";

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


//This hosts user defined REST Web Service API Functions, when and if REST Web Services are offered
include "../app/includes/other-functions-api.php";

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
	  include "ajax-pages/" . $page_filename;
	}
}
//$k_te = new krupa($template_config);

//$k_te->start();

//Web Applications: This does the loading of the Modal Aspect (logic with db interaction) respective resource for regular web application requests 
if ($page_is_ajax != "1") {
include "../app/core/modal-body.php";
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