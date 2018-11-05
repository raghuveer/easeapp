<?php
  //Filter Server Variables and some user defined variables
  //Check if this file is being executed from CLI or Web Browser or a HTTP Client
  if (defined('STDIN') ){
    //echo("Running from CLI");
  } else {
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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 */
  
  $_SERVER['unfiltered'] = $_SERVER;
  $_SERVER['SERVER_ADDR'] = isset($_SERVER['SERVER_ADDR']) ? filter_var($_SERVER['SERVER_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) : '';
  $_SERVER['REMOTE_ADDR'] = isset($_SERVER['REMOTE_ADDR']) ? filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) : '';
  $_SERVER['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT']) ? filter_var($_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRING) : '';
  $_SERVER['HTTP_REFERER'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
  $http_referer = $_SERVER['HTTP_REFERER'];
  $http_referer_hostname = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
  $_SERVER['REMOTE_HOST'] = isset($_SERVER['REMOTE_HOST']) ? filter_var($_SERVER['REMOTE_HOST'], FILTER_SANITIZE_STRING) : '';
  $_SERVER['PHP_SELF'] = isset($_SERVER['PHP_SELF']) ? filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING) : '';
  $_SERVER['DOCUMENT_ROOT'] = isset($_SERVER['DOCUMENT_ROOT']) ? filter_var($_SERVER['DOCUMENT_ROOT'], FILTER_SANITIZE_STRING) : '';
  $_SERVER['REQUEST_METHOD'] = isset($_SERVER['REQUEST_METHOD']) ? filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRING) : '';
  $_SERVER["CONTENT_TYPE"] = isset($_SERVER["CONTENT_TYPE"]) ? filter_var($_SERVER["CONTENT_TYPE"], FILTER_SANITIZE_STRING) : '';
  $curl_useragent_array = array(
    'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)',
    'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)',
    'Mozilla/6.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)',
    'Mozilla/7.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)'
  );

  /* 
   * http://forums.digitalpoint.com/showthread.php?t=289952&s=66b59dade545a64a6bcb05188fed74e8&p=2738335#post2738335
    http://blog.ryanrampersad.com/2009/02/11/random-element-from-array-in-php/ */

  $curl_useragent = $curl_useragent_array[array_rand($curl_useragent_array)];

  $current_epoch = date("U"); // this is based on default time zone that is set for the application

  $dtmain = new DateTime("@$current_epoch");
  $total_date_and_time = $dtmain->format('Y-m-d, H:i:s') . " GMT";
  $full_date_exploded = explode('::::', $dtmain->format('Y-m-d::::H:i:s'));
  $date_seperated = $full_date_exploded[0];
  $date_reformatted_uk_format_input = explode('-', $date_seperated);
  $date_reformatted_uk_format = $date_reformatted_uk_format_input[2] . "-" . $date_reformatted_uk_format_input[1] . "-" . $date_reformatted_uk_format_input[0]; 
  $time_seperated = $full_date_exploded[1];
?>