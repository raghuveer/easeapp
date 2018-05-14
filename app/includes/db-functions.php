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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 *
 * These are set of functions. to handle DB Queries.
 */

//Basic DB Functions
function insert_query_get_last_insert_id($sql, $values_array){
	    global $dbcon;
		$insert_query = $dbcon->prepare($sql);
		//$search_keyword_query->execute($values_array);
		//if($insert_domain_name_query->execute()) {
		if($insert_query->execute($values_array)) {
			//insert success
			$lastId = $dbcon->lastInsertId();
		   return $lastId;
		}
		return "";
}
//$last_insert_id = insert_query_get_last_insert_id($sql, $values_array);



function update_query_based_on_id($sql, $values_array){
	global $dbcon;
	
	$update_query = $dbcon->prepare($sql);
	if($update_query->execute($values_array)) {
	   return "success";
	}
	return "failure";
}
//$update_status = update_query_based_on_id($sql, $update_values_array);


function delete_query_based_on_id($sql, $values_array){
	global $dbcon;
	
	$delete_query = $dbcon->prepare($sql);
	if($delete_query->execute($values_array)) {
	   return true;
	}
	return false;
}
//$delete_status = delete_query_based_on_id($sql, $delete_values_array);

?>