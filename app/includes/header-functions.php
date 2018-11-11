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
 * This page contains header specific functions that will support with issuing application headers.
 */

/**
 *  An example CORS-compliant method.  It will allow any GET, POST, or OPTIONS requests from any
 *  origin.
 *
 *  In a production environment, you probably want to be more restrictive, but this gives you
 *  the general idea of what is involved.  For the nitty-gritty low-down, read:
 *
 *  - https://developer.mozilla.org/en/HTTP_access_control
 *  - http://www.w3.org/TR/cors/
 *  - https://stackoverflow.com/a/9866124
 */ 
function ea_cors_headers() {
	
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        //header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		//The * allows any web application / mobile app, to connect to this server
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
		header("Access-Control-Expose-Headers: authorization");
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    //echo "You have CORS!";
}

/**
 *  This is to issue Security Headers, in the application
 *  origin.
 *
 */ 
function ea_application_security_headers() {
	
    //Prevent Mimetype Sniffing
	header('x-content-type-options: nosniff');
	
	//XSS Protection
	header('X-XSS-Protection: 1; mode=block');
	
	//Clickjacking Prevention, while allowing to iframe the page from sameorigin in php
	//header('X-Frame-Options', 'SAMEORIGIN', false);
	
	//Clickjacking Prevention overall without allowing sameorigin or a different origin from iframing the page in php
	header('X-Frame-Options: DENY');
	
	//Remove PHP Information (Version) Header
	header_remove('x-powered-by');
	
	//This Header is to allow flash to share client side data between its applications in PHP
	header('X-Permitted-Cross-Domain-Policies: master-only');

}

/**
 *  This is to issue Caching Headers, in the application
 *  origin.
 *
 */ 
function ea_application_browser_cache_headers() {
	
    /* for php websites
	header('Content-Type:text/html; charset=UTF-8');
	header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );*/
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: pre-check=0', false ); //post-check=0 is removed, as per guidelines of Fiddler
	//header( 'Pragma: no-cache' ); //this Pragma header is commented, as this will be useful only on IE Browser, as suggested in Fiddler.

}

?>