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
  * This is to host the core framework related routing engine rules
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
  * a) "is_web_service_endpoint" => "0"
  * This means, http request is an ajax request and this represents, pure ajax call
  * b) "is_web_service_endpoint" => "1"
  * This means, http request is an ajax request and this represents, web service endpoint
  * c) "is_web_service_endpoint" => "2"
  * This means, http request is an ajax request and this represents, either ajax call or web service endpoint
  * d) "is_web_service_endpoint" => "3"
  * This means, http request is basically not an ajax request
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
 $routes = array();  
 

 
 $routes["not-found"] = array("page_filename" => "not-found.php",
                              "is_ajax" => "0",
                              "is_frontend_page" => "2",
                              "request_method" => "ANY"                                    
                             );  

 $routes["default-home"] = array("route_value" => "/",
							  "route_var_count" => "2",
							  "page_filename" => "default-home.php",
                              "is_ajax" => "0",
							  "is_web_service_endpoint" => "3",
                              "is_frontend_page" => "1",
                              "request_method" => "ANY"                                    
                             );

 $routes["default-home1"] = array("route_value" => "/index.php",
							  "route_var_count" => "2",
							  "page_filename" => "default-home.php",
                              "is_ajax" => "0",
							  "is_web_service_endpoint" => "3",
                              "is_frontend_page" => "1",
                              "request_method" => "ANY"                                    
                             ); 							 
							 
							 
//Header Response Only for API Service Responses - 400 Bad Request
 $routes["header-response-only-400-bad-request"] = array("route_value" => "/header-response-only/400-bad-request",
							 "route_var_count" => "3",
							 "page_filename" => "header-response-only-400-bad-request.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "2",
							 "is_frontend_page" => "3",
                             "request_method" => "ANY"                                    
							);
							
//Header Response Only for API Service Responses - 401 Unauthorized
 $routes["header-response-only-401-unauthorized"] = array("route_value" => "/header-response-only/401-unauthorized",
							 "route_var_count" => "3",
							 "page_filename" => "header-response-only-401-unauthorized.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "2",
							 "is_frontend_page" => "3",
                             "request_method" => "ANY"                                    
							);							
							
//Header Response Only for API Service Responses - 403 Forbidden
 $routes["header-response-only-403-forbidden"] = array("route_value" => "/header-response-only/403-forbidden",
							 "route_var_count" => "3",
							 "page_filename" => "header-response-only-403-forbidden.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "2",
							 "is_frontend_page" => "3",
                             "request_method" => "ANY"                                    
							);
							
//Header Response Only for API Service Responses - 404 Not Found
 $routes["header-response-only-404-not-found"] = array("route_value" => "/header-response-only/404-not-found",
							 "route_var_count" => "3",
							 "page_filename" => "header-response-only-404-not-found.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "2",
							 "is_frontend_page" => "3",
                             "request_method" => "ANY"                                    
							);							
							
//Header Response Only for API Service Responses - 405 Method Not Allowed
 $routes["header-response-only-405-method-not-allowed"] = array("route_value" => "/header-response-only/400-method-not-allowed",
							 "route_var_count" => "3",
							 "page_filename" => "header-response-only-405-method-not-allowed.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "2",
							 "is_frontend_page" => "3",
                             "request_method" => "ANY"                                    
							);
							
//API for Login (REST Service with Token Authentication based on JSON Web Tokens)
 $routes["rest-login"] = array("route_value" => "/rest/login",
							 "route_var_count" => "3",
							 "page_filename" => "rest-login.php",
							 "is_ajax" => "1",
							 "is_web_service_endpoint" => "1",
							 "is_frontend_page" => "3",
                             "request_method" => "POST"                                    
							);
	
?>