<?php
  defined('START') or die;
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or                 * Contributors and is licensed as per their Open Source License choices.
 */
//Include Modal file (when the loading page is valid) or, include not-found page (when the loading page is not valid)

   if($page_filename != "not-found.php") {
	  include "../app/models/" . $page_filename;
   }

?>