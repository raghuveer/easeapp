<?php
  defined('START') or die;
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or                * Contributors and is licensed as per their Open Source License choices.
 */
/* 
 * This file will be in the response when only Headers are to be provided in the response.
 * This is for 405 Method Not Allowed Header Response, which is accompanied by the Allow header, as mandated by the RFC 2616.
 * https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
 */
header('HTTP/1.1 405 Not Allowed');
// html_escaped_output() is from /app/core/validate-sanitize-functions.php
// $_SESSION["allowed_http_method_request"] from //app/core/controller.php
header('Allow: ' . html_escaped_output($_SESSION["allowed_http_method_request"]));
//echo 'Request Method: ' . html_escaped_output($_SESSION["allowed_http_method_request"]);
exit;
?>