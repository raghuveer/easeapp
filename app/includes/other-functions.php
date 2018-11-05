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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or               * Contributors and is licensed as per their Open Source License choices.
 */

//Some Useful Functions

//random time in seconds / micro seconds to sleep
function sleep_at_random_intervals($min_time_interval_in_seconds, $max_time_interval_in_seconds, $outcome_interval_type){
	if ($outcome_interval_type == "both") {
		//sleep interval in either micro seconds or seconds randomly
		$interval_types_array = array(
			'seconds',
			'micro-seconds'
		);
		$chosen_interval = $interval_types_array[array_rand($interval_types_array)];
		if ($chosen_interval == "seconds") {
			$sleep_interval["time"] = mt_rand($min_time_interval_in_seconds, $max_time_interval_in_seconds);
			$sleep_interval["chosen_interval"] = "seconds";
		} else if ($chosen_interval == "micro-seconds") {
			$sleep_interval["time"] = mt_rand($min_time_interval_in_seconds, $max_time_interval_in_seconds);
			$sleep_interval["time"] = $sleep_interval["time"] * "1000000";
			$sleep_interval["chosen_interval"] = "micro-seconds";
		}
	} else if ($outcome_interval_type == "micro-seconds") {
		//sleep interval in micro seconds
		$sleep_interval["time"] = mt_rand($min_time_interval_in_seconds, $max_time_interval_in_seconds);
		$sleep_interval["time"] = $sleep_interval["time"] * "1000000";
		$sleep_interval["chosen_interval"] = "micro-seconds";
	} else {
		//sleep interval in seconds
		$sleep_interval["time"] = mt_rand($min_time_interval_in_seconds, $max_time_interval_in_seconds);
		$sleep_interval["chosen_interval"] = "seconds";
	}
	
	return $sleep_interval;
}
/*$received_sleep_interval = sleep_at_random_intervals("2", "4", "micro-seconds");
print_r($received_sleep_interval);
if ($received_sleep_interval['chosen_interval'] == "micro-seconds") {
	usleep($received_sleep_interval['time']);
} else {
	sleep($received_sleep_interval['time']);
}*/

?>
