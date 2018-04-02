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
 * This file will be in the response when only Headers are to be provided in the response.
 * This is for 405 Method Not Allowed Header Response
 */
header('HTTP/1.1 405 Not Allowed');
exit;
?>