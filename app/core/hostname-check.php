<?php
  defined('START') or die;
 /**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */ 
//This is to verify the host name where the scipt is executed 

    /* protocol & hostname start */

 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
   $site_protocol_name = "https://";
 } else {
   $site_protocol_name = "http://";
 }
 

   if(isset($_SERVER['HTTP_HOST']) && strstr($_SERVER['HTTP_HOST'], $live_url)) {
  $site_hostname_value = $live_url; //you're on online prod
  
  $html_purified_css_path_initial = $site_hostname_value . $project_main_folder . "/" . "templates/" . $chosen_template . "/css/";
  $html_purified_css = $site_protocol_name . $html_purified_css_path_initial;
  
  $html_purified_js_path_initial = $site_hostname_value . $project_main_folder . "/" . "templates/" . $chosen_template . "/js/";
  $html_purified_js = $site_protocol_name . $html_purified_js_path_initial;
         
  $dbconnection_active = "live";

  $site_basedir_path = $siteroot_basedir_command_line;
   
  $site_home_path = $site_home_path_full;
          
  } elseif(isset($_SERVER['HTTP_HOST']) && strstr($_SERVER['HTTP_HOST'], $dev_url)) {
  $site_hostname_value = $dev_url; //you're on online dev
  
  $html_purified_css_path_initial = $site_hostname_value . $project_main_folder . "/" . "templates/" . $chosen_template . "/css/";
  $html_purified_css = $site_protocol_name . $html_purified_css_path_initial;
  
  $html_purified_js_path_initial = $site_hostname_value . $project_main_folder . "/" . "templates/" . $chosen_template . "/js/";
  $html_purified_js = $site_protocol_name . $html_purified_js_path_initial;
         
  $dbconnection_active = "dev";

  $site_basedir_path = $siteroot_basedir_command_line_dev;
  
  $site_home_path = $site_home_path_full_dev;

  } else {
    header('Location: ' . html_escaped_output($site_protocol_name . $live_url) . "/");
    exit;
  }
  //echo $dbconnection_active;
  
  $site_url_hostname = $site_protocol_name . $site_hostname_value;
  
  $site_url_project_main = $site_protocol_name . $site_hostname_value . $project_main_folder . "/";
  $site_url_project_main_prefix = $site_protocol_name . $site_hostname_value . $project_main_folder;

  $site_url_login = $site_protocol_name . $site_hostname_value . $project_main_folder . "/login";
  
  $site_url_logout = $site_protocol_name . $site_hostname_value . $project_main_folder . "/logout";
  
  $site_url_forgot_password = $site_protocol_name . $site_hostname_value . $project_main_folder . "/forgot-password";
  
  $site_url_register = $site_protocol_name . $site_hostname_value . $project_main_folder . "/register";
  
  $site_url_main_admin_dashboard = $site_protocol_name . $site_hostname_value . $project_main_folder . "/admin/dashboard";
  
  $site_url_main_member_dashboard = $site_protocol_name . $site_hostname_value . $project_main_folder . "/member/dashboard";
  
      /* protocol & hostname end */

?>
