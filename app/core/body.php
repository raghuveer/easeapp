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
//Include View file (when the loading page is valid) or, include not-found page (when the loading page is not valid)

 // include "templates/" . $chosen_template . "/" . $page_filename;
 
  if ($page_is_frontend == "1") {
   //frontend related page /template to be loaded
    include "templates/" . $chosen_frontend_template . "/" . $page_filename;     
 } elseif ($page_is_frontend == "0") {
   //admin related pages / template to be loaded 
    include "templates/" . $chosen_template . "/" . $page_filename;     
 } elseif ($page_is_frontend == "2") {
   if (isset($_SESSION['sm_user_type']) && ($_SESSION['sm_user_type'] == "member")) {
   //frontend related page /template to be loaded
    include "templates/" . $chosen_frontend_template . "/" . $page_filename;
    //echo "member";
   } elseif (isset($_SESSION['sm_user_type']) && ($_SESSION['sm_user_type'] == "admin") ) {
   //admin related pages / template to be loaded 
    include "templates/" . $chosen_template . "/" . $page_filename;
    //echo "admin or super admin";
   } else {
   //show member related pages / template to be loaded 
    include "templates/" . $chosen_frontend_template . "/" . $page_filename;
    //echo "else condition";
   }      
 } else {
   //inappropriate template settings reporting page
    include "templates/incorrect-template-settings.php";
 }

?>
