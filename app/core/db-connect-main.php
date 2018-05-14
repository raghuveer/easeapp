<?php
  if(defined('STDIN') ){
  //echo("dbdetails: Running from CLI");
}else{
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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */
    if($dbconnection_active == "live")
    {
   
    $dbhost_site = "";
    $dbusername_site = "";
    $dbpassword_site = "";
    $dbname_site = "";
	
    
    }
    elseif($dbconnection_active == "dev")
    {
   
    $dbhost_site = "";
    $dbusername_site = "";
    $dbpassword_site = "";
    $dbname_site = "";	
    
    }
	

    //http://forums.devshed.com/php-faqs-stickies-167/properly-access-mysql-database-php-954131.html        
    if(($dbconnection_active != "") && (($dbconnection_active == "dev") || ($dbconnection_active == "live")))
    {
       try {
         if (($dbhost_site != "") && ($dbusername_site != "") && ($dbpassword_site != "") && ($dbname_site != "")) {
              $dbcon = new PDOEx("mysql:host=$dbhost_site;dbname=$dbname_site;charset=utf8", $dbusername_site, $dbpassword_site);
              // throw exceptions in case of errors (default: stay silent)
              $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              // fetch associative arrays (default: mixed arrays)
              $dbcon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
         

        }
        catch (PDOException $e) {
        
          if($debug_mode == "ON")
            {
            	print "Error!: " . $e->getMessage() . "<br>";
              //var_dump($e);
              die();
            }
            elseif($debug_mode == "OFF")
            {
            	echo "db related error!!!";
              die();
            }
          //print "Error!: " . $e->getMessage() . "<br>";
          //var_dump($e);
          //die();
        }
    } //dbconnection active close tag
    
?>
