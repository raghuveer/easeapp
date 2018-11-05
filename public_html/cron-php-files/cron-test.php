<?php
if(defined('STDIN') ){
  //echo("Running from CLI");
}else{
  echo("Not Running from CLI");
  exit();
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
//if the directory is one directory above the current file's parent directory http://stackoverflow.com/a/2100763/811207
include(dirname(dirname(dirname(__FILE__))) . "/app/core/command-line-include.php");

$cron_number = "1";
$sel_cron_number_setting = $dbcon->prepare("SELECT * FROM `cron_file_details` WHERE `sno` = :sno");
$sel_cron_number_setting->bindParam(":sno",$cron_number);
$sel_cron_number_setting->execute(); 
$res_cron_number_setting = $sel_cron_number_setting->fetchAll(PDO::FETCH_ASSOC);
//print_r($res_cron_number_setting);
//exit;
foreach($res_cron_number_setting as $res_cron_number_setting_row)
{
	$res_state = $res_cron_number_setting_row["cron_file_status_setting"];
	$res_records = $res_cron_number_setting_row["cron_file_numb_record_limit"];
	$res_loop = $res_cron_number_setting_row["cron_file_numb_loop_count_limit"];
	$res_sleep_min = $res_cron_number_setting_row["cron_file_sleep_min_seconds_limit"];
	$res_sleep_max = $res_cron_number_setting_row["cron_file_sleep_max_seconds_limit"];
	$res_sleep_interval = $res_cron_number_setting_row["cron_file_sleep_interval"];
	
}


if ( $res_state == "ON" ) {

			
	for ( $i = 1; $i <=$res_loop; $i++ ) {
	echo "entered into loop\n";
			
		
	}//close of for ( $i = 1; $i <=$res_loop; $i++ ) {
		
}//close of if ( $res_state == "ON" ) {


?>