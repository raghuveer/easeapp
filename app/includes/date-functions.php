<?php
if(defined('STDIN') ){
  //echo("Running from CLI");
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
/* This page contains date functions that will be used to show event date for site visitor (in site default time zone) as well as logged in user (in user chosen timezone). */


/* date function for site visitor*/
function dateandtime_visitor($eventtime_recorded){
      $readable_date_sitevisitor = date("d-m-Y, h:i A", $eventtime_recorded)." GMT";
      return $readable_date_sitevisitor;
}

/* date function for without time*/
function dateandtime_visitor_notime($eventtime_recorded){
      $readable_date_sitevisitor = date("d-m-Y", $eventtime_recorded);
      return $readable_date_sitevisitor;
}
/* date function for without time (using three lettered month)*/
function dateandtime_visitor_notime_three_let_month($eventtime_recorded){
      $readable_date_sitevisitor = date("d-M-Y", $eventtime_recorded);
      return $readable_date_sitevisitor;
}
/* date function for day (tw lettered) and month (three lettered) representation*/
function dateandtime_visitor_2lett_date_3lett_month($eventtime_recorded){
      $readable_date_sitevisitor = date("d M", $eventtime_recorded);
      return $readable_date_sitevisitor;
}
/* date function for day (tw lettered) and month (three lettered) and year (four characters) representation*/
function dateandtime_visitor_2lett_date_3lett_month_4lett_year_time($eventtime_recorded){
      $readable_date_sitevisitor = date("d M Y", $eventtime_recorded) . " at " . date("G : i", $eventtime_recorded) . " Hrs";
      return $readable_date_sitevisitor;
}
/* date function for logged in user */
function dateandtime_loggedinuser($eventtime_recorded_logged, $usertimezone_recorded){
    
      $usertimezone_symbol_loggedinuser = substr($usertimezone_recorded, 0, 1);  // abcd
	  $usertimezone_without_symbol_loggedinuser = substr($usertimezone_recorded, 1, 6);  // abcd
                 
				 if($usertimezone_symbol_loggedinuser == "+")
						{ 
					      $epochtime_loggedinuser = $eventtime_recorded_logged+$usertimezone_without_symbol_loggedinuser;
					    }
						elseif($usertimezone_symbol_loggedinuser == "-")
						{
						  $epochtime_loggedinuser = $eventtime_recorded_logged-$usertimezone_without_symbol_loggedinuser;
						}
				 
                 $readable_date_loggedinuser =date("d-m-Y, h:i A", $epochtime_loggedinuser);
                 return $readable_date_loggedinuser;
}

function friendly_date_month_in_words($date_program_released_input){
      $date_program_released_input_exploded = explode("-", $date_program_released_input);
	  $friendly_date_day_number = $date_program_released_input_exploded[0];
	  $friendly_date_month_number = $date_program_released_input_exploded[1];
	  $friendly_date_year_number = $date_program_released_input_exploded[2];
	  
	  if($friendly_date_month_number == "01")
	  {
	  	$friendly_date_month_name = "January";
	  }
	  elseif($friendly_date_month_number == "02")
	  {
	  	$friendly_date_month_name = "February";
	  }
	  elseif($friendly_date_month_number == "03")
	  {
	  	$friendly_date_month_name = "March";
	  }
	  elseif($friendly_date_month_number == "04")
	  {
	  	$friendly_date_month_name = "April";
	  }
	  elseif($friendly_date_month_number == "05")
	  {
	  	$friendly_date_month_name = "May";
	  }
	  elseif($friendly_date_month_number == "06")
	  {
	  	$friendly_date_month_name = "June";
	  }
	  elseif($friendly_date_month_number == "07")
	  {
	  	$friendly_date_month_name = "July";
	  }
	  elseif($friendly_date_month_number == "08")
	  {
	  	$friendly_date_month_name = "August";
	  }
	  elseif($friendly_date_month_number == "09")
	  {
	  	$friendly_date_month_name = "September";
	  }
	  elseif($friendly_date_month_number == "10")
	  {
	  	$friendly_date_month_name = "October";
	  }
	  elseif($friendly_date_month_number == "11")
	  {
	  	$friendly_date_month_name = "November";
	  }
	  elseif($friendly_date_month_number == "12")
	  {
	  	$friendly_date_month_name = "December";
	  }
	  $friendly_date_form = $friendly_date_month_name . " " . $friendly_date_day_number . ", " . $friendly_date_year_number;
      return $friendly_date_form;
}

function friendly_date_month_seq_in_words($date_program_released_input){
      $date_program_released_input_exploded = explode("-", $date_program_released_input);
	  $friendly_date_day_number = $date_program_released_input_exploded[0];
	  $friendly_date_month_number = $date_program_released_input_exploded[1];
	  $friendly_date_year_number = $date_program_released_input_exploded[2];
	  
	  if($friendly_date_month_number == "01")
	  {
	  	$friendly_date_month_name = "January";
	  }
	  elseif($friendly_date_month_number == "02")
	  {
	  	$friendly_date_month_name = "February";
	  }
	  elseif($friendly_date_month_number == "03")
	  {
	  	$friendly_date_month_name = "March";
	  }
	  elseif($friendly_date_month_number == "04")
	  {
	  	$friendly_date_month_name = "April";
	  }
	  elseif($friendly_date_month_number == "05")
	  {
	  	$friendly_date_month_name = "May";
	  }
	  elseif($friendly_date_month_number == "06")
	  {
	  	$friendly_date_month_name = "June";
	  }
	  elseif($friendly_date_month_number == "07")
	  {
	  	$friendly_date_month_name = "July";
	  }
	  elseif($friendly_date_month_number == "08")
	  {
	  	$friendly_date_month_name = "August";
	  }
	  elseif($friendly_date_month_number == "09")
	  {
	  	$friendly_date_month_name = "September";
	  }
	  elseif($friendly_date_month_number == "10")
	  {
	  	$friendly_date_month_name = "October";
	  }
	  elseif($friendly_date_month_number == "11")
	  {
	  	$friendly_date_month_name = "November";
	  }
	  elseif($friendly_date_month_number == "12")
	  {
	  	$friendly_date_month_name = "December";
	  }
	  $friendly_date_form = $friendly_date_day_number . " " . $friendly_date_month_name . " " . $friendly_date_year_number;
      return $friendly_date_form;
}

function friendly_date_3lettered_month_in_words($date_program_released_input){
      $date_program_released_input_exploded = explode("-", $date_program_released_input);
	  $friendly_date_day_number = $date_program_released_input_exploded[0];
	  $friendly_date_month_number = $date_program_released_input_exploded[1];
	  $friendly_date_year_number = $date_program_released_input_exploded[2];
	  $friendly_date_year_number = substr($friendly_date_year_number, -2, 2); // returns "d"
	  if($friendly_date_month_number == "01")
	  {
	  	$friendly_date_month_name = "Jan";
	  }
	  elseif($friendly_date_month_number == "02")
	  {
	  	$friendly_date_month_name = "Feb";
	  }
	  elseif($friendly_date_month_number == "03")
	  {
	  	$friendly_date_month_name = "Mar";
	  }
	  elseif($friendly_date_month_number == "04")
	  {
	  	$friendly_date_month_name = "Apr";
	  }
	  elseif($friendly_date_month_number == "05")
	  {
	  	$friendly_date_month_name = "May";
	  }
	  elseif($friendly_date_month_number == "06")
	  {
	  	$friendly_date_month_name = "Jun";
	  }
	  elseif($friendly_date_month_number == "07")
	  {
	  	$friendly_date_month_name = "Jul";
	  }
	  elseif($friendly_date_month_number == "08")
	  {
	  	$friendly_date_month_name = "Aug";
	  }
	  elseif($friendly_date_month_number == "09")
	  {
	  	$friendly_date_month_name = "Sep";
	  }
	  elseif($friendly_date_month_number == "10")
	  {
	  	$friendly_date_month_name = "Oct";
	  }
	  elseif($friendly_date_month_number == "11")
	  {
	  	$friendly_date_month_name = "Nov";
	  }
	  elseif($friendly_date_month_number == "12")
	  {
	  	$friendly_date_month_name = "Dec";
	  }
	  $friendly_date_form = $friendly_date_day_number . " " . $friendly_date_month_name . " " . $friendly_date_year_number;
      return $friendly_date_form;
}

/* date function for dates above year 2038 to get unix timestamp on php v5.2 and above*/
//learnt from http://www.php.net/manual/en/datetime.gettimestamp.php#98374

function df_convert_date_to_unix_timestamp($date_inputted){
      $date_input = new DateTime($date_inputted);
      $timestamp_outcome = $date_input->format("U");
      return $timestamp_outcome;
}

/* date function to convert date with custom defined timezone to it's corresponding unix timestamp */

function df_convert_date_custom_timezone_to_unix_timestamp($date_inputted, $timezone_inputted){
      $date_input = new DateTime($date_inputted, new DateTimeZone($timezone_inputted) );
	  //print_r($date_input) . "<br>";
	  $timestamp_outcome = $date_input->format("U");
	  //echo $timestamp_outcome;
      return $timestamp_outcome;
}

//find difference between two dates (in international format) in seconds
function df_diff_two_dates_seconds($date_inputted1, $date_inputted2){
      $date_input1 = new DateTime($date_inputted1);
      $timestamp_outcome1 = $date_input1->format("U");
	  $date_input2 = new DateTime($date_inputted2);
      $timestamp_outcome2 = $date_input2->format("U");
	  $diff_seconds = $timestamp_outcome2 - $timestamp_outcome1;
      return $diff_seconds;
}

/* 24 hour to 12 hour time conversion*/
//learnt from http://psoug.org/snippet/Convert_12_to_24_hour_time_and_vice_versa_241.htm
function convert_24_hour_12_hour($time_inputted_24_hour_format){
      $time_in_12_hour_format  = DATE("g:i a", STRTOTIME($time_inputted_24_hour_format));
      return $time_in_12_hour_format;
}

/* 12 hour to 24 hour time conversion*/
//learnt from http://psoug.org/snippet/Convert_12_to_24_hour_time_and_vice_versa_241.htm

function convert_12_hour_24_hour($time_inputted_12_hour_format){
      $time_in_24_hour_format  = DATE("H:i", STRTOTIME($time_inputted_12_hour_format));
      return $time_in_24_hour_format;
}

/* function which converts 24 hour time (time only and without any date) into seconds */
//thought by Gayathri

function df_convert_24hour_time_into_seconds($time_inputted){
      $time_in_seconds_format_exploded = explode(":",$time_inputted);
      $hours_in_seconds = $time_in_seconds_format_exploded[0]*3600;
      $minutes_in_seconds = $time_in_seconds_format_exploded[1]*60;
      $whole_time_in_seconds = $hours_in_seconds + $minutes_in_seconds; 
      return $whole_time_in_seconds;
}

/* function which converts epoch value or unix timestamp (outcome of time() or date("U") ) into ISO8601 format outcome for UTC or GMT Timezone */

function df_convert_epoch_time_to_iso8601($time_inputted){
      $time_in_iso8601_format = date("D, j M o G:i:s +0000", $time_inputted); 
      return $time_in_iso8601_format;
} 

function epoch_to_datepicker_date($eventtime_recorded){
      $readable_datepicker_date = date("d-m-Y", $eventtime_recorded);
      return $readable_datepicker_date;
} 

function epoch_to_datepicker_date_with_time($eventtime_recorded){
      $readable_datepicker_date = date("d-m-Y H:i:s", $eventtime_recorded);
      return $readable_datepicker_date;
}

/* date function for getting Date time based on given timezone*/
//http://stackoverflow.com/questions/8006692/get-current-date-given-a-timezone-in-php
//http://stackoverflow.com/a/24394179
function date_time_custom_timezone($date_input, $timezone_name_input){
      $current_date_time = new DateTime($date_input, new DateTimeZone($timezone_name_input) );
      //echo $current_date_time->format('Y-m-d H:i:s');   
      $current_date_time_generated = $current_date_time->format('Y-m-d H:i:s');
      return $current_date_time_generated;
}

function current_date_time_custom_timezone($epoch_input, $timezone_name_input){
	  $dtfunction = new DateTime("@$epoch_input");
      $total_date_and_time = $dtfunction->format('Y-m-d H:i:s');
      
      $current_date_time_chosen_timezone = new DateTime($total_date_and_time, new DateTimeZone($timezone_name_input) );
      //echo $current_date_time_chosen_timezone->format('Y-m-d H:i:s');   
      $current_date_time_generated = $current_date_time_chosen_timezone->format('Y-m-d H:i:s');
      return $current_date_time_generated;
}
/* 
 * This function takes current epoch value, a custom timezone and if Daylight Saving Time is required or not. By Default, Daylight Saving Time is not applied on the generated date
 * http://www.epochconverter.com/epoch/timezones.php
 */
function epoch_to_date_time_custom_timezone($epoch_input, $timezone_name_input, $dst_input = "no"){
      if($dst_input == "yes") {
        //Daylight Saving Time is applied
        $epoch_input = $epoch_input + "3600";
      }
      $current_epoch_considering_dst_chosen_timezone = new DateTime($epoch_input, new DateTimeZone($timezone_name_input) );
      //echo $current_epoch_considering_dst_chosen_timezone->format('Y-m-d H:i:s');   
      $current_date_time_generated = $current_epoch_considering_dst_chosen_timezone->format('Y-m-d H:i:s');
      return $current_date_time_generated;
}

function current_day_uk_date_custom_timezone($timezone_name_input){
      $current_date_time = new DateTime("now", new DateTimeZone($timezone_name_input) );
      //echo $current_date_time->format('Y-m-d H:i:s');   
      $current_date_generated = $current_date_time->format('d-m-Y');
      return $current_date_generated;
}

function prev_day_uk_date_custom_timezone($timezone_name_input){
      $prev_date_time = new DateTime("-1 day", new DateTimeZone($timezone_name_input) );
      //echo $current_date_time->format('Y-m-d H:i:s');   
      $prev_date_generated = $prev_date_time->format('d-m-Y');
      return $prev_date_generated;
}

function next_day_uk_date_custom_timezone($timezone_name_input){
      $prev_date_time = new DateTime("+1 day", new DateTimeZone($timezone_name_input) );
      //echo $current_date_time->format('Y-m-d H:i:s');   
      $prev_date_generated = $prev_date_time->format('d-m-Y');
      return $prev_date_generated;
}

//function to find date in UK Date Format, when a date time and a timezone is inputed
function ukdate_custom_datetime_timezone($datetime_input, $timezone_name_input){
      $current_date_time = new DateTime($datetime_input, new DateTimeZone($timezone_name_input) );
      //echo $current_date_time->format('Y-m-d H:i:s');   
      $current_date_timestamp_generated = $current_date_time->format('d-m-Y');
      return $current_date_timestamp_generated;
}

//function to find next date in UK Date Format, when a date time and a timezone is inputed
//http://php.net/manual/en/datetime.modify.php
function next_day_ukdate_custom_datetime_timezone($datetime_input, $timezone_name_input){
      $current_date_time = new DateTime($datetime_input, new DateTimeZone($timezone_name_input) );
      $next_date_generated = $current_date_time->modify('+1 day');
	  $next_date_generated_uk_format = $next_date_generated->format('d-m-Y');
      return $next_date_generated_uk_format;
}    

/* function to find individual dates between two given dates including the given dates */
//http://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
//http://stackoverflow.com/a/9225875 (modified version of this function below)
function date_range_between_two_uk_dates_custom_timezone($starting_date, $ending_date, $interval, $date_format){
    $dates = array();
    $current = strtotime($starting_date);
	//echo  $current . "<br>";
    $last = strtotime($ending_date);
	//echo $last . "<br>";

    while( $current <= $last ) {

        $dates[] = date($date_format, $current);
        $current = strtotime($interval, $current);
    }

    return $dates;
}

/* function to find individual dates between two given dates including the given dates */
//http://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
//http://stackoverflow.com/a/9225875 (modified version of this function below)
function date_range_between_two_international_dates_custom_timezone($starting_date, $ending_date, $interval, $date_format){
	echo $starting_date;
	echo "----" +$ending_date;
	//exit;
    $dates = array();
    $current = strtotime($starting_date);
	//echo  $current . "<br>";
    $last = strtotime($ending_date);
	//echo $last . "<br>";

    while( $current <= $last ) {

        $dates[] = date($date_format, $current);
        $current = strtotime($interval, $current);
    }

    return $dates;
}
/*INCOMPLETE FUNCTION*/
function date_range_between_two_uk_dates_custom_timezone1($starting_date, $ending_date, $chosen_timezone, $interval, $date_format){
    $dates = array();
    
    $current = new DateTime($starting_date, new DateTimeZone($chosen_timezone) );
	$current_final = $current->format("U");
	$current_final_date = $current->format('Y-m-d H:i:s');
    //echo $current_final . "<br>";
	//echo $current_final_date . "<br>";
    $last = new DateTime($ending_date, new DateTimeZone($chosen_timezone) );
    $last_final = $last->format("U");
	$last_final_date = $last->format('Y-m-d H:i:s');
	//echo $last_final . "<br>";
	//echo $last_final_date . "<br>";
    
	
	$diff = $current->diff($last);
	
	//print_r($diff);
/*	//$dates[] = $starting_date;
    while( $current_final <= $last_final ) {

        $dates[] = date($date_format, $current_final);
        $current_final = strtotime($interval, $current_final);
    }
	//$dates[] = $ending_date; */

    return $dates;
}

//http://stackoverflow.com/a/4312491
function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

//Validate date
//http://php.net/manual/en/function.checkdate.php#113205

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//var_dump(validateDate('2012-02-28 12:12:12')); # true
//var_dump(validateDate('2012-02-30 12:12:12')); # false
//var_dump(validateDate('2012-02-28', 'Y-m-d')); # true

//input epoch and timezone name to get datetime of chosen timezone
function df_convert_unix_timestamp_custom_timezone($epoch_inputted, $timezone_name_inputted){
      if ($timezone_name_inputted == "Asia/Kolkata") {
      	$epoch_final = $epoch_inputted+19800;
		
      } else {
      	
		//use GMT
		$epoch_final = $epoch_inputted;
		
      }	
      return $epoch_final;
}

//input epoch and timezone name to get datetime of chosen timezone
function df_convert_unix_timestamp_to_datetime_custom_timezone($epoch_inputted, $timezone_name_inputted){
      if ($timezone_name_inputted == "Asia/Kolkata") {
      	$epoch_final = $epoch_inputted+19800;
		$converted_datetime = new DateTime("@$epoch_final");  // convert UNIX timestamp to PHP DateTime
        $datetime_outcome = $converted_datetime->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00   
		
      } else {
      	
		//use GMT
		$epoch_final = $epoch_inputted;
		$converted_datetime = new DateTime("@$epoch_final");  // convert UNIX timestamp to PHP DateTime
        $datetime_outcome = $converted_datetime->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00
      }	
      return $datetime_outcome;
}

//input epoch and timezone name to get datetime of chosen timezone
function df_convert_unix_timestamp_to_date_custom_timezone($epoch_inputted, $timezone_name_inputted, $date_format_inputted){
      if ($timezone_name_inputted == "Asia/Kolkata") {
      	//Indian Time zone (GMT+5:30 Hrs)
      	$epoch_final = $epoch_inputted+19800;
	  } else {
     	//use GMT
		$epoch_final = $epoch_inputted;
		//$converted_datetime = new DateTime("@$epoch_final");  // convert UNIX timestamp to PHP DateTime
        //$datetime_outcome = $converted_datetime->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00
        
      }
     $converted_datetime = new DateTime("@$epoch_final");  // convert UNIX timestamp to PHP DateTime
     $datetime_outcome = $converted_datetime->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00
     //echo "datetime_outcome: " . $datetime_outcome . "\n";
     $date_separated_space_exploded = explode(" ", $datetime_outcome);
  	 $date_separated_international_format = $date_separated_space_exploded[0];	
     if ($date_format_inputted == "d-m-Y") {
    	//UK Format
		$date_separated_international_format_exploded = explode("-", $date_separated_international_format);
		$date_outcome = $date_separated_international_format_exploded[2] . "-" . $date_separated_international_format_exploded[1] . "-" . $date_separated_international_format_exploded[0];
		
     } elseif ($date_format_inputted == "Y-m-d") {
    	//international format	
    	$date_outcome = $date_separated_international_format;
		
     }  elseif ($date_format_inputted == "m/d/Y") {
    	//US Format
		$date_separated_international_format_exploded = explode("-", $date_separated_international_format);
		$date_outcome = $date_separated_international_format_exploded[1] . "/" . $date_separated_international_format_exploded[2] . "/" . $date_separated_international_format_exploded[0];
     }	
      return $date_outcome;
}

/*
 * example for df_convert_unix_timestamp_to_date_custom_timezone($epoch_inputted, $timezone_name_inputted, $date_format_inputted)
 * $epoch_input = "1453142105";//1453141505
$test_date_gmt = df_convert_unix_timestamp_to_date_custom_timezone($epoch_input, 'Europe/London', 'd-m-Y');
$test_date_asia_kolkata_uk = df_convert_unix_timestamp_to_date_custom_timezone($epoch_input, 'Asia/Kolkata', 'd-m-Y');
$test_date_asia_kolkata_int = df_convert_unix_timestamp_to_date_custom_timezone($epoch_input, 'Asia/Kolkata', 'Y-m-d');
$test_date_asia_kolkata_us = df_convert_unix_timestamp_to_date_custom_timezone($epoch_input, 'Asia/Kolkata', 'm/d/Y');

echo "test_date (Europe/London - GMT): " . $test_date_gmt . "\n";
echo "test_date (Asia/Kolkata - UK): " . $test_date_asia_kolkata_uk . "\n";
echo "test_date (Asia/Kolkata - INT): " . $test_date_asia_kolkata_int . "\n";
echo "test_date (Asia/Kolkata - US): " . $test_date_asia_kolkata_us . "\n";*/
/*
 *  
	 function datesCheck($startDateTime, $endDateTime){
		global $min_difference_tran_init_time_info_accumulating_time_seconds;
		if($startDateTime != 0) {
			$startDate1 = DateTime::createFromFormat("Y-m-d\TH:i:s", $startDateTime);
			$startDate2 = DateTime::createFromFormat("Y-m-d H:i:s", $startDateTime);
			if(!$startDate1 && !$startDate2){
				echo "Could not parse the digest from date";
			}
		}
		if($endDateTime != 0) {
			$endDate1 = DateTime::createFromFormat("Y-m-d\TH:i:s", $endDateTime);
			$endDate2 = DateTime::createFromFormat("Y-m-d H:i:s", $endDateTime);
			if(!$endDate1 && !$endDate2){
				echo "Could not parse the digest from date";			
			}
		}
		$startDate3 = (!$startDate1) ? $startDate2 : $startDate1;
		$endDate3 = (!$endDate1) ? $endDate2 : $endDate1;
		$startDateTimeStamp = $startDate3->getTimestamp();
		$endDateTimeStamp = $endDate3->getTimestamp();
		if($endDateTimeStamp == $startDateTimeStamp){
			
			echo "End date (" . $endDateTime .")  Start date (" . $startDateTime . ") are equal";
		}elseif($endDateTimeStamp < $startDateTimeStamp){
			
			echo "End date (" . $endDateTime .") should be greater than Start date (" . $startDateTime . ")";
			
		}else{
			echo "dates allowed \n";
		}	
			$datediff = $endDateTimeStamp - $startDateTimeStamp;
			if($min_difference_tran_init_time_info_accumulating_time_seconds <= $datediff){
				echo "difference is there, we can continue ...\n";
				return true;
			}
			return false;
			//$days = floor($datediff/(60*60*24));//this is to calculate no of days 
		//echo "diff days = ".$datediff." \n";
	}
	
	$datesCheckResult = datesCheck($last_transaction_pymt_initiated_on_datetime,$current_datetime_pymt_initiated_date_to);
	if($datesCheckResult){
		}else{
	   echo "waiting for initialization time to complete " . $min_difference_tran_init_time_info_accumulating_time_seconds . "to later collect data once again";	
	}
 */

?>
