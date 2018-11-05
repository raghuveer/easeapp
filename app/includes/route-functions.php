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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 *
 * This page contains route specific functions that will support with application routes.
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

/*incomplete attempt, to put MODEL in a FUNCTION. This will have to be worked in a later time.
function pass_request_data_models($page_filename_input) {
	global $dbcon;
	//Include Model file (when the loading page is valid) or, include not-found page (when the loading page is not valid)
    if($page_filename_input != "not-found.php") {
	  include "../app/modal/" . $page_filename_input;
    }
}*/
?>