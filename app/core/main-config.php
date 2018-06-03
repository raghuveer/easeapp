<?php
  if(defined('STDIN') ){
  //echo("Running from CLI");
}else{
  //echo("Not Running from CLI");
  defined('START') or die;
  }
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */
//Config
$main_config = array();  
$main_config["site_config_site_name"] = "Easeapp PHP Framework v3";
$main_config["site_config_site_caption"] = "";
$main_config["project_main_folder"] = "";
$main_config["dev_url"] = "dev-framework-v3.easeapp.org";
$main_config["live_url"] = "www.easeapp.org";
$main_config["live_url_main_domain_name"] = "www.easeapp.org";
$main_config["cli_dev_account_ref"] = "devfrv3";
$main_config["cli_live_account_ref"] = "easeapp";
$main_config["organisation_name"] = "Raghuveer Dendukuri";
$main_config["organisation_name_full"] = "Raghuveer Dendukuri and Contributors";
$main_config["siteroot_basedir"] = $_SERVER['DOCUMENT_ROOT'] . "/";
$main_config["siteroot_basedir_command_line"] = "/home/easeapp/public_html/";
$main_config["siteroot_basedir_command_line_dev"] = "/home/devfrv3/public_html/";
$main_config["site_home_path_full"] = "/home/prodapi/";
$main_config["site_home_path_full_dev"] = "/home/uatpgsw/";
$main_config["routing_rule_length"] = "500";
$main_config["encr_filename_salt_length"] = "20";
$main_config["encr_filename_length"] = "45";
$main_config["hash_algorithm"] = "whirlpool";
$main_config["password_min_length"] = "8";
$main_config["username_min_length"] = "5";
$main_config["username_max_length"] = "20";
$main_config["debug_mode"] = "ON"; //OFF or ON
$main_config["app_site_status"] = "live"; // construction / live / maintenance 
$main_config["date_default_timezone_set"] = "Europe/London";
$main_config["contact_page_email"] = "raghuveer.dendukuri@gmail.com";
$main_config["contact_phone_primary"] = "+91-234-1234567";
$main_config["currency_symbol"] = "Rs.";
$main_config["chosen_template"] = "default-admin";
$main_config["chosen_frontend_template"] = "default-frontend";
$main_config["log_lifetime_settings_seconds"] = "32140800";
$main_config["minify_javascript_setting"] = "1"; // 0:disabled; 1:enabled;
$main_config["minify_css_setting"] = "1"; // 0:disabled; 1:enabled;
$main_config["show_page_load_db_query_info"] = "1"; // 0:No , 1:Yes
$main_config["check_email_activation_login"] = // yes:check email activation status during login, no:donot check email activation status during login
$main_config["pg-generated-enc-keys-folder-name"] = "generated-enc-keys/";
//$main_config["pg-symmetric-encryption-key-filename"] = "pg-xsalsa20-symmetric-encryption.key";
$main_config["pg-asymmetric-anonymous-encryption-keypair-filename"] = "pg-curve25519-asymmetric-anonymous-encryption-keypair.key";
$main_config["pg-asymmetric-anonymous-encryption-logs-keypair-filename"] = "pg-curve25519-asymmetric-anonymous-encryption-logs-keypair.key";
$main_config["pg-asymmetric-authentication-keypair-filename"] = "pg-ed25519-asymmetric-authentication-keypair.key";
$main_config["pg-asymmetric-authentication-logs-keypair-filename"] = "pg-ed25519-asymmetric-authentication-logs-keypair.key";
//$main_config["pg-symmetric-encryption-key-signature-filename"] = "pg-xsalsa20-symmetric-encryption-key-signature.key";
$main_config["active_session_backend"] = "files"; // files: File system based sessions, redis: Single Redis Server, default value: file
$main_config["files_based_session_storage_location_choice"] = "custom-location"; // default-location: Default File System based Session Storage Location, as per PHP Settings, custom-location: User Chosen File System based Session Storage Location, default value: custom-location
$main_config["files_based_session_storage_custom_path"] = dirname($_SERVER['DOCUMENT_ROOT']) . "/sessions"; // User Chosen File System based Custom Session Storage Location
$main_config["single_redis_server_session_backend_host"] = "tcp://localhost:6379"; // Details of single redis server related session storage host details
$main_config["session_max_lifetime_bef_cleanup"] = "86400"; // value of session.gc_maxlifetime php setting
 
//variables
$site_config_site_name = $main_config["site_config_site_name"];
$site_config_site_caption = $main_config["site_config_site_caption"];
$project_main_folder = $main_config["project_main_folder"];
$dev_url = $main_config["dev_url"];
$live_url = $main_config["live_url"];
$live_url_main_domain_name = $main_config["live_url_main_domain_name"];
$cli_dev_account_ref = $main_config["cli_dev_account_ref"];
$cli_live_account_ref = $main_config["cli_live_account_ref"];


$organisation_name = $main_config["organisation_name"];
$organisation_name_full = $main_config["organisation_name_full"];
//$ts_present_year = date("Y");
//document root for browser:
$siteroot_basedir = $main_config["siteroot_basedir"];

//document root for command line:
$siteroot_basedir_command_line = $main_config["siteroot_basedir_command_line"];
$siteroot_basedir_command_line_dev = $main_config["siteroot_basedir_command_line_dev"];

//site home path
$site_home_path_full = $main_config["site_home_path_full"];
$site_home_path_full_dev = $main_config["site_home_path_full_dev"];

//route/request_uri length
$routing_rule_length = $main_config["routing_rule_length"];

//duplicate file name settings
$encr_filename_salt_length = $main_config["encr_filename_salt_length"];
$encr_filename_length = $main_config["encr_filename_length"];
$hash_algorithm = $main_config["hash_algorithm"];

//password related
$password_min_length = $main_config["password_min_length"];
$username_min_length = $main_config["username_min_length"];
$username_max_length = $main_config["username_max_length"];

//Debug (error reporting enabled (all errors))
$debug_mode = $main_config["debug_mode"]; //OFF or ON

//Site Status
$app_site_status = $main_config["app_site_status"]; // construction / live / maintenance 

//timezone setting
$date_default_timezone_set = $main_config["date_default_timezone_set"];

$contact_page_email = $main_config["contact_page_email"];
$contact_phone_primary = $main_config["contact_phone_primary"];
$currency_symbol = $main_config["currency_symbol"];

//template_settings
$chosen_template = $main_config["chosen_template"];
//$chosen_template = "default-admin";

global $chosen_template;

$chosen_frontend_template = $main_config["chosen_frontend_template"];

global $chosen_frontend_template;

//reports related logging settings
$log_lifetime_settings_seconds = $main_config["log_lifetime_settings_seconds"];

//includes folder path
$includes_folder_path = "../app/includes/";

//phpmailer folder path
$phpmailer_folder_path = "../app/includes/phpmailer/";

//ckeditor folder path
$ckeditor_directory_path = "frontend-includes/ckeditor/";

//jquery-colorpicker-by-vanderlee folder path
$jquery_colorpicker_vanderlee_directory_path = "frontend-includes/jquery-colorpicker-vanderlee/";

//fancybox directory config
//$fancybox_directory_path = "includes/fancybox/source/";
//$fancybox_directory_path = "../app/includes/fancybox/source/";


//ajax pages directory config
$ajax_pages_directory_path = "ajax-pages/";

//minifier settings
$minify_javascript_setting = $main_config["minify_javascript_setting"]; // 0:disabled; 1:enabled;
$minify_css_setting = $main_config["minify_css_setting"]; // 0:disabled; 1:enabled;

//page load time and db queries count display settings
$show_page_load_db_query_info = $main_config["show_page_load_db_query_info"]; // 0:No , 1:Yes

//E-Mail Activation Check during Login
$check_email_activation_login = $main_config["check_email_activation_login"]; // yes:check email activation status during login, no:donot check email activation status during login


//Encryption Keys config
$pg_generated_enc_keys_folder_name = $main_config["pg-generated-enc-keys-folder-name"];
//$pg_symmetric_encryption_key_filename = $main_config["pg-symmetric-encryption-key-filename"];
$pg_asymmetric_anonymous_encryption_keypair_filename = $main_config["pg-asymmetric-anonymous-encryption-keypair-filename"];
$pg_asymmetric_anonymous_encryption_logs_keypair_filename = $main_config["pg-asymmetric-anonymous-encryption-logs-keypair-filename"];
$pg_asymmetric_authentication_keypair_filename = $main_config["pg-asymmetric-authentication-keypair-filename"];
//$pg_symmetric_encryption_key_signature_filename = $main_config["pg-symmetric-encryption-key-signature-filename"];
$pg_asymmetric_authentication_logs_keypair_filename = $main_config["pg-asymmetric-authentication-logs-keypair-filename"];

//session Backend Options
$active_session_backend = $main_config["active_session_backend"];
$files_based_session_storage_location_choice = $main_config["files_based_session_storage_location_choice"];
$files_based_session_storage_custom_path = $main_config["files_based_session_storage_custom_path"];
$single_redis_server_session_backend_host = $main_config["single_redis_server_session_backend_host"];
$session_max_lifetime_bef_cleanup = (int) $main_config["session_max_lifetime_bef_cleanup"];

//activation email sender info
$activation_email_sender_name = $live_url_main_domain_name . " User Registration";
$activation_email_sender_email = "register-notification@" . $live_url_main_domain_name;
$activation_email_subject = $live_url_main_domain_name . " e-mail address confirmation";
$resend_activation_email_subject = "Re-sending " . $live_url_main_domain_name . " e-mail address confirmation";

//password resetting email sender info
$password_resetting_email_sender_name = $live_url_main_domain_name . " Account Management";
$password_resetting_email_sender_email = "account-management-notification@" . $live_url_main_domain_name;
$password_resetting_email_subject = $live_url_main_domain_name . " Password Resetting link";
$password_resetting_link_expiry_period = "28800";//in seconds, hours = 8

//reset password email sender info
$admin_password_resetting_email_sender_name = $live_url_main_domain_name . " Account Management";
$admin_password_resetting_email_sender_email = "account-management-notification@" . $live_url_main_domain_name;
$admin_password_resetting_email_subject = $live_url_main_domain_name . " Account New Password (Admin Initiated Password Reset)";


         //footer notices
$footer_copyright_notices = "2016 " . $organisation_name_full . ".,";

//htmlawed config (allowed html tags)
$page_content_file_config = array(
                                  'safe'=>1, // Dangerous elements and attributes thus not allowed
                                  'elements'=>'p, a, b, strong, i, em, li, ol, ul, table, tr, td, img, h1, h2, h3, h4, h5, h6, hr, br, section, div', // only the indicated HTML tags get through
                                  'deny_attribute'=>'class, id, style' // None of the allowed elements can have these attributes
                                  );

// Configuration for ea-logger library
$loggerConfig = array(
                "email-receivers" => array("raghuveer@easeapp.org", "pradeep@easeapp.org"), //Add Email IDs of Webmaster / Developers
                "sms-receivers" => array("9999999999", "8888888888"), //Add Mobile Numbers of Webmaster / Developers
                "severity" => array());

$siteLogPath = "../easeapp-logs/";

?>