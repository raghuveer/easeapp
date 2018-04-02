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
 /*
  * This is to host the user defined routing engine rules
  * 
  * I. some different combinations and related meanings (this is to differentiate whether the page is a frontend page or a admin panel page or related to Ajax / API Service):
  * 
  * 1) "is_ajax" => "0", "is_frontend_page" => "0"
  * This means, http request is normal (not ajax) and admin panel template has to be loaded
  *
  * 2) "is_ajax" => "0", "is_frontend_page" => "1"
  * This means, http request is normal (not ajax) and frontend template has to be loaded
  *
  * 3) "is_ajax" => "0", "is_frontend_page" => "2"
  * This means, http request is normal (not ajax) and based on logged in user type, either frontend template or admin panel template has to be loaded
  *
  * 4) "is_ajax" => "0", "is_frontend_page" => "3"
  * This means, http request is normal (not ajax) and this represents, inappropriate template settings
  *
  * 5) "is_ajax" => "1", "is_frontend_page" => "3"
  * This means, http request is an ajax request and this represents, pure ajax call/web service call
  *
  * 
  * 
  * II. This is to check the Request Method of the request
  * 
  * 1) "request_method" => "ANY"
  * This means, there is no restriction about the METHOD that is used for this http / https request (GET / POST / PUT / DELETE all works), if the VALUE is ANY.
  * 
  * 2) "request_method" => "GET"
  * This means, only requests that is initiated using GET METHOD are allowed, if the VALUE is GET.
  * 
  * 3) "request_method" => "POST"
  * This means, only requests that is initiated using POST METHOD are allowed, if the VALUE is POST.
  * 
  * 4) "request_method" => "PUT"
  * This means, only requests that is initiated using PUT METHOD are allowed, if the VALUE is PUT.
  * 
  * 5) "request_method" => "DELETE"
  * This means, only requests that is initiated using DELETE METHOD are allowed, if the VALUE is DELETE.
  * 
  * 6) "request_method" => "HEAD" (NOT COMPLETED)
  * This means, only requests that is initiated using HEAD METHOD are allowed, if the VALUE is HEAD. The Script will be terminated after outputting headers if output buffering is not enabled.
  *        
  */
//Different Routing Engine Rules
 $user_defined_routes = array();

//Show Email Ids for provided Domain Name
 $user_defined_routes["show-email-ids-for-domain-name"] = array("route_value" => "/show-email-ids/domain-name",
							 "route_var_count" => "3",
							 "page_filename" => "show-email-ids-for-domain-name.php",
							 "is_ajax" => "0",
							 "is_frontend_page" => "1",
                             "request_method" => "ANY"                                    
							);
//Show Email Ids for provided Domain Name REST Web Service
 $user_defined_routes["show-email-ids-for-domain-name-service"] = array("route_value" => "/rest/show-email-ids-for-domain-name/keyword/" . $routing_eng_var_4,
							 "route_var_count" => "5",
							 "page_filename" => "rest-show-email-ids-for-domain-name.php",
							 "is_ajax" => "1",
							 "is_frontend_page" => "3",
                             "request_method" => "GET"                                    
							); 
  
?>