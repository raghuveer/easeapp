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
//http://stackoverflow.com/questions/8102221/php-multidimensional-array-searching-find-key-by-specific-value?rq=1
//http://www.alistapart.com/articles/succeed/ strlen check of $_SERVER["REQUEST_URI"];

//Function that CHECKS the Routes while including the REQUEST METHOD CHECK
function match_route($routes_array, $request_uri_input, $ruri_var_count_input, $seo_route_length)
{  
   if (strlen(filter_var($request_uri_input, FILTER_SANITIZE_STRING))<$seo_route_length){
   foreach($routes_array as $key => $route_array)
   {  
      if ($key != "not-found") {
        if (($route_array['route_value'] === $request_uri_input) && ($route_array['route_var_count'] == $ruri_var_count_input)) {
        	
		   if ($route_array['request_method'] == "ANY") {
           	  //This means, there is no restriction about the METHOD that is used for this http / https request (GET / POST / PUT / DELETE all works), if the VALUE is ANY.
           	  return $key;			
           } elseif (($route_array['request_method'] == "GET") && ($_SERVER['REQUEST_METHOD'] === "GET")) {
           	  //This means, only requests that is initiated using GET METHOD are allowed, if the VALUE is GET.
           	  return $key;			
           } elseif (($route_array['request_method'] == "POST") && ($_SERVER['REQUEST_METHOD'] === "POST")) {
           	  //This means, only requests that is initiated using POST METHOD are allowed, if the VALUE is POST.
           	  return $key;			
           } elseif (($route_array['request_method'] == "PUT") && ($_SERVER['REQUEST_METHOD'] === "PUT")) {
           	  //This means, only requests that is initiated using PUT METHOD are allowed, if the VALUE is PUT.
           	  return $key;			
           } elseif (($route_array['request_method'] == "DELETE") && ($_SERVER['REQUEST_METHOD'] === "DELETE")) {
           	  //This means, only requests that is initiated using DELETE METHOD are allowed, if the VALUE is DELETE.
           	  return $key;			
           } else {
           	  //The value of request_method of $route_array['request_method'] is invalid, so, return, bad request in headers response only scenario.
           	  $_SESSION["allowed_http_method_request"] = $route_array['request_method'];
			  return "header-response-only-405-method-not-allowed";
           }	
           
        }
     }
   }
  } 
   
   return "header-response-only-404-not-found";
}

//Combine Core Defined Routes and User Defined Routes
$total_routes = array_merge($routes, $user_defined_routes);

//Match Route
$route_name_key = match_route($total_routes, $route_check_input, $r_e_var_count, $routing_rule_length);
//echo "route_name_key: " . $route_name_key . "<br>";
//echo $total_routes["$route_name_key"]["page_filename"] . "<br>";
//echo $total_routes["$route_name_key"]["is_ajax"] . "<br>";
$page_filename = $total_routes["$route_name_key"]["page_filename"];
$page_is_ajax = $total_routes["$route_name_key"]["is_ajax"];
$page_is_web_service_endpoint = $total_routes["$route_name_key"]["is_web_service_endpoint"];
$page_is_frontend = $total_routes["$route_name_key"]["is_frontend_page"];
$request_method = $total_routes["$route_name_key"]["request_method"];  
$route_filename = substr($page_filename, 0, -4);
//echo "page_filename: " . $page_filename . "<br>";
//echo "page_is_ajax: " . $page_is_ajax . "<br>";
//echo "page_is_web_service_endpoint: " . $page_is_web_service_endpoint . "<br>";
//echo "page_is_frontend: " . $page_is_frontend . "<br>";
//echo "request_method: " . $request_method . "<br>";
//echo "route_filename: " . $route_filename . "<br>";	   
global $route_filename;	 
?>