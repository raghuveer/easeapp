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