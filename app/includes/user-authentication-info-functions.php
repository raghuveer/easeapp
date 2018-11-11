<?php
defined('START') or die;

/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 *
 * This page contains user authentication and info functions.
 */
 
function ea_check_user_login_with_email_address($email_address_input, $password_input) {
	
	global $dbcon;
	
	$constructed_array = array();
		
	$user_details_get_sql = "SELECT * FROM `site_members` WHERE `sm_email`=:sm_email";	
	$user_details_get_select_query = $dbcon->prepare($user_details_get_sql);		
	$user_details_get_select_query->bindValue(":sm_email",$email_address_input);
	$user_details_get_select_query->execute();
	if($user_details_get_select_query->rowCount() > 0) {
		$user_details_get_select_query_result = $user_details_get_select_query->fetch();
		
		$sm_memb_id = $user_details_get_select_query_result["sm_memb_id"];
		$sm_email = $user_details_get_select_query_result["sm_email"];
		$sm_password = $user_details_get_select_query_result["sm_password"];
		$sm_mobile = $user_details_get_select_query_result["sm_mobile"];
		$sm_salutation = $user_details_get_select_query_result["sm_salutation"];
		$sm_firstname = $user_details_get_select_query_result["sm_firstname"];
		$sm_middlename = $user_details_get_select_query_result["sm_middlename"];
		$sm_lastname = $user_details_get_select_query_result["sm_lastname"];
		$sm_user_type = $user_details_get_select_query_result["sm_user_type"];
		$sm_user_status = $user_details_get_select_query_result["sm_user_status"];
		
		$constructed_array["user_status"] = null;
		$constructed_array["login_request_auth_status"] = null;
	
		if ($sm_user_status == "1") {
			$constructed_array["user_status"] = "1";
			//verification of password in login process based on BCRYPT Hashing Algorithm using Password hashing API, that is supported from PHP v5.5 and beyond
			if (password_verify($password_input, $sm_password)) {
				$constructed_array["login_request_auth_status"] = "1"; // Login Successful
				
				//User Details, that will be passed, as part of JWT Token Content
				$constructed_array["user_id"] = $sm_memb_id;
				$constructed_array["user_salutation"] = $sm_salutation;
				$constructed_array["user_firstname"] = $sm_firstname;
				$constructed_array["user_middlename"] = $sm_middlename;
				$constructed_array["user_lastname"] = $sm_lastname;
				$constructed_array["user_type"] = $sm_user_type;
				
				$user_classification_details_result = ea_get_user_classication_details($sm_memb_id);
				
				$user_classification_name_association_ups_array = array();
				foreach($user_classification_details_result as $user_classification_details_result_row) {
					$sm_site_member_classification_detail_id = $user_classification_details_result_row["sm_site_member_classification_detail_id"];
					$sm_user_role = $user_classification_details_result_row["sm_user_role"];
					$user_privilege_summary = $user_classification_details_result_row["user_privilege_summary"];
					
					$user_classification_name_association_ups_array[] = $user_privilege_summary;
					
				}//close of foreach($user_classification_details_result as $user_classification_details_result_row) {
				
				$constructed_array["user_privileges_list"] = implode(", ", $user_classification_name_association_ups_array);
				
			} else {
				$constructed_array["login_request_auth_status"] = "0"; // Login Failure
			}
		} else if ($sm_user_status == "2") {
			$constructed_array["user_status"] = "2";
		} else if ($sm_user_status == "3") {
			$constructed_array["user_status"] = "3";
		} else {
			$constructed_array["user_status"] = "0";
		}//close of else of if ($sm_user_status == "1") {
		return $constructed_array;
	}//close of if($user_details_get_select_query->rowCount() > 0) {
	return $constructed_array;
}

function ea_check_user_login_with_mobile_number($mobile_number_input, $password_input) {
	
	global $dbcon;
	
	$constructed_array = array();
		
	$user_details_get_sql = "SELECT * FROM `site_members` WHERE `sm_mobile`=:sm_mobile";	
	$user_details_get_select_query = $dbcon->prepare($user_details_get_sql);		
	$user_details_get_select_query->bindValue(":sm_mobile",$mobile_number_input);
	$user_details_get_select_query->execute();
	if($user_details_get_select_query->rowCount() > 0) {
		$user_details_get_select_query_result = $user_details_get_select_query->fetch();
		
		$sm_memb_id = $user_details_get_select_query_result["sm_memb_id"];
		$sm_email = $user_details_get_select_query_result["sm_email"];
		$sm_password = $user_details_get_select_query_result["sm_password"];
		$sm_mobile = $user_details_get_select_query_result["sm_mobile"];
		$sm_salutation = $user_details_get_select_query_result["sm_salutation"];
		$sm_firstname = $user_details_get_select_query_result["sm_firstname"];
		$sm_middlename = $user_details_get_select_query_result["sm_middlename"];
		$sm_lastname = $user_details_get_select_query_result["sm_lastname"];
		$sm_user_type = $user_details_get_select_query_result["sm_user_type"];
		$sm_user_status = $user_details_get_select_query_result["sm_user_status"];
		
		$constructed_array["user_status"] = null;
		$constructed_array["login_request_auth_status"] = null;
	
		if ($sm_user_status == "1") {
			$constructed_array["user_status"] = "1";
			//verification of password in login process based on BCRYPT Hashing Algorithm using Password hashing API, that is supported from PHP v5.5 and beyond
			if (password_verify($password_input, $sm_password)) {
				$constructed_array["login_request_auth_status"] = "1"; // Login Successful
				
				//User Details, that will be passed, as part of JWT Token Content
				$constructed_array["user_id"] = $sm_memb_id;
				$constructed_array["user_salutation"] = $sm_salutation;
				$constructed_array["user_firstname"] = $sm_firstname;
				$constructed_array["user_middlename"] = $sm_middlename;
				$constructed_array["user_lastname"] = $sm_lastname;
				$constructed_array["user_type"] = $sm_user_type;
				
				$user_classification_details_result = ea_get_user_classication_details($sm_memb_id);
				
				$user_classification_name_association_ups_array = array();
				foreach($user_classification_details_result as $user_classification_details_result_row) {
					$sm_site_member_classification_detail_id = $user_classification_details_result_row["sm_site_member_classification_detail_id"];
					$sm_user_role = $user_classification_details_result_row["sm_user_role"];
					$user_privilege_summary = $user_classification_details_result_row["user_privilege_summary"];
					
					$$user_classification_name_association_ups_array[] = $user_privilege_summary;
					
				}//close of foreach($user_classification_details_result as $user_classification_details_result_row) {
				
				$constructed_array["user_privileges_list"] = implode(", ", $user_classification_name_association_ups_array);
				
				
			} else {
				$constructed_array["login_request_auth_status"] = "0"; // Login Failure
			}
		} else if ($sm_user_status == "2") {
			$constructed_array["user_status"] = "2";
		} else if ($sm_user_status == "3") {
			$constructed_array["user_status"] = "3";
		} else {
			$constructed_array["user_status"] = "0";
		}//close of else of if ($sm_user_status == "1") {
		return $constructed_array;
	}//close of if($user_details_get_select_query->rowCount() > 0) {
	return $constructed_array;
}

function ea_get_user_classication_details($sm_memb_id_input) {
	
	global $dbcon;
	
	$constructed_array = array();
		
	$valid_to_date_input = '%'.'present'.'%';
	$is_active_status_input = '1';

	//Check in site_members db table
	$user_classification_details_get_sql = "SELECT * FROM `sm_site_member_classification_associations` ssmca LEFT JOIN sm_site_member_classification_details ssmcd ON ssmca.sm_site_member_classification_detail_id = ssmcd.sm_site_member_classification_detail_id WHERE ssmca.is_active_status =:ssmca_is_active_status AND ssmcd.is_active_status =:ssmcd_is_active_status AND ssmca.valid_to_date LIKE :ssmca_valid_to_date AND ssmca.sm_memb_id =:ssmca_sm_memb_id";
	
	$user_classification_details_get_select_query = $dbcon->prepare($user_classification_details_get_sql);
	$user_classification_details_get_select_query->bindValue(":ssmca_is_active_status",$is_active_status_input);
	$user_classification_details_get_select_query->bindValue(":ssmcd_is_active_status",$is_active_status_input);
	$user_classification_details_get_select_query->bindValue(":ssmca_valid_to_date",$valid_to_date_input);
	$user_classification_details_get_select_query->bindValue(":ssmca_sm_memb_id",$sm_memb_id_input);
	$user_classification_details_get_select_query->execute();
	
	if($user_classification_details_get_select_query->rowCount() > 0) {
	   $user_classification_details_get_select_query_result = $user_classification_details_get_select_query->fetchAll();
	   //print_r($user_classification_details_get_select_query_result);
	   return $user_classification_details_get_select_query_result;
	}
	return $constructed_array;
	
}

function ea_get_user_groups_list($sm_user_type_input, $user_group_status_input) {
	
	global $dbcon;
	
	$constructed_array = array();
	
	$sm_user_role_input = '%'.'super-admin'.'%';

	
	if ($user_group_status_input == "0") {
		//Check in sm_site_member_classification_details db table
		$user_classification_details_get_sql = "SELECT * FROM `sm_site_member_classification_details` WHERE `sm_user_type`=:sm_user_type AND `sm_user_role` NOT LIKE :sm_user_role AND `is_active_status`=:is_active_status ORDER BY `sm_user_level` ASC";
		
		$user_classification_details_get_select_query = $dbcon->prepare($user_classification_details_get_sql);
		$user_classification_details_get_select_query->bindValue(":sm_user_type",$sm_user_type_input);
		$user_classification_details_get_select_query->bindValue(":sm_user_role",$sm_user_role_input);
		$user_classification_details_get_select_query->bindValue(":is_active_status","0");
		$user_classification_details_get_select_query->execute();
		
	} else if ($user_group_status_input == "1") {
		//Check in sm_site_member_classification_details db table
		$user_classification_details_get_sql = "SELECT * FROM `sm_site_member_classification_details` WHERE `sm_user_type`=:sm_user_type AND `sm_user_role` NOT LIKE :sm_user_role AND `is_active_status`=:is_active_status ORDER BY `sm_user_level` ASC";
		
		$user_classification_details_get_select_query = $dbcon->prepare($user_classification_details_get_sql);
		$user_classification_details_get_select_query->bindValue(":sm_user_type",$sm_user_type_input);
		$user_classification_details_get_select_query->bindValue(":sm_user_role",$sm_user_role_input);
		$user_classification_details_get_select_query->bindValue(":is_active_status","1");
		$user_classification_details_get_select_query->execute();
		
	} else {
		//Check in sm_site_member_classification_details db table
		$user_classification_details_get_sql = "SELECT * FROM `sm_site_member_classification_details` WHERE `sm_user_type`=:sm_user_type AND `sm_user_role` NOT LIKE :sm_user_role ORDER BY `sm_user_level` ASC";
		
		$user_classification_details_get_select_query = $dbcon->prepare($user_classification_details_get_sql);
		$user_classification_details_get_select_query->bindValue(":sm_user_type",$sm_user_type_input);
		$user_classification_details_get_select_query->bindValue(":sm_user_role",$sm_user_role_input);
		$user_classification_details_get_select_query->execute();
	}//close of else of if ($user_group_status_input == "0") {
	
	if($user_classification_details_get_select_query->rowCount() > 0) {
	    $user_classification_details_get_select_query_result = $user_classification_details_get_select_query->fetchAll();
	    //print_r($user_classification_details_get_select_query_result);
	    
		foreach ($user_classification_details_get_select_query_result as $user_classification_details_get_select_query_result_row) {
			
			$temp_row_array = array();
		    $temp_row_array["user_classification_details_id"] = $user_classification_details_get_select_query_result_row["sm_site_member_classification_detail_id"];
		    $temp_row_array["user_type"] = $user_classification_details_get_select_query_result_row["sm_user_type"];
		    $temp_row_array["user_level"] = $user_classification_details_get_select_query_result_row["sm_user_level"];
		    $temp_row_array["user_role"] = $user_classification_details_get_select_query_result_row["sm_user_role"];
		    $temp_row_array["user_department"] = $user_classification_details_get_select_query_result_row["department"];
		    $temp_row_array["user_privilege_summary"] = $user_classification_details_get_select_query_result_row["user_privilege_summary"];
		    $constructed_array[] = $temp_row_array;
	    }//close of foreach ($user_classification_details_get_select_query_result as $user_classification_details_get_select_query_result_row) {
			
		return $constructed_array;
	}
	return $constructed_array;
	
}

function ea_get_quick_user_info($sm_memb_id_input) {
	
	global $dbcon;
	
	$constructed_array = array();
		
	$quick_user_info_get_sql = "SELECT * FROM `site_members` WHERE `sm_memb_id`=:sm_memb_id";	
	$quick_user_info_get_select_query = $dbcon->prepare($quick_user_info_get_sql);		
	$quick_user_info_get_select_query->bindValue(":sm_memb_id",$sm_memb_id_input);
	$quick_user_info_get_select_query->execute();
	if($quick_user_info_get_select_query->rowCount() > 0) {
		$quick_user_info_get_select_query_result = $quick_user_info_get_select_query->fetch();
		
		$constructed_array[$sm_memb_id_input]["user_id"] = $quick_user_info_get_select_query_result["sm_memb_id"];
		$constructed_array[$sm_memb_id_input]["user_email"] = $quick_user_info_get_select_query_result["sm_email"];
		$constructed_array[$sm_memb_id_input]["user_mobile"] = $quick_user_info_get_select_query_result["sm_mobile"];
		$constructed_array[$sm_memb_id_input]["user_phone"] = $quick_user_info_get_select_query_result["sm_phone"];
		$constructed_array[$sm_memb_id_input]["user_salutation"] = $quick_user_info_get_select_query_result["sm_salutation"];
		$constructed_array[$sm_memb_id_input]["user_firstname"] = $quick_user_info_get_select_query_result["sm_firstname"];
		$constructed_array[$sm_memb_id_input]["user_middlename"] = $quick_user_info_get_select_query_result["sm_middlename"];
		$constructed_array[$sm_memb_id_input]["user_lastname"] = $quick_user_info_get_select_query_result["sm_lastname"];
		$constructed_array[$sm_memb_id_input]["user_type"] = $quick_user_info_get_select_query_result["sm_user_type"];
		$constructed_array[$sm_memb_id_input]["user_status"] = $quick_user_info_get_select_query_result["sm_user_status"];
		
		$user_classification_details_result = ea_get_user_classication_details($sm_memb_id_input);
		
		$user_classification_name_association_ups_array = array();
		foreach($user_classification_details_result as $user_classification_details_result_row) {
			$sm_site_member_classification_detail_id = $user_classification_details_result_row["sm_site_member_classification_detail_id"];
			$sm_user_role = $user_classification_details_result_row["sm_user_role"];
			$user_privilege_summary = $user_classification_details_result_row["user_privilege_summary"];
			
			$user_classification_name_association_ups_array[] = $user_privilege_summary;
			
		}//close of foreach($user_classification_details_result as $user_classification_details_result_row) {
		
		$constructed_array[$sm_memb_id_input]["user_privileges_list"] = implode(", ", $user_classification_name_association_ups_array);
		
		return $constructed_array;
	}//close of if($quick_user_info_get_select_query->rowCount() > 0) {
	return $constructed_array;
	
}

function ea_get_quick_user_info_based_on_email_or_mobile($email_input, $mobile_input, $user_unique_identifier_setting_input, $ip_address_input) {
	
	global $dbcon;
	
	$constructed_array = array();
	
	$quick_user_info_get_select_query = array();
	
	//Identify the Unique Identifier Setting of User Account
	if ($user_unique_identifier_setting_input == "email-address") {
		//Do Select Query based on Email Address as User Identifier
		$quick_user_info_get_sql = "SELECT * FROM `site_members` WHERE `sm_email`=:sm_email";	
		$quick_user_info_get_select_query = $dbcon->prepare($quick_user_info_get_sql);		
		$quick_user_info_get_select_query->bindValue(":sm_email",$email_input);
		$quick_user_info_get_select_query->execute();
			
	} else if ($user_unique_identifier_setting_input == "mobile-number") {
		//Do Select Query based on Mobile Number as User Identifier
		$quick_user_info_get_sql = "SELECT * FROM `site_members` WHERE `sm_mobile`:sm_mobile";	
		$quick_user_info_get_select_query = $dbcon->prepare($quick_user_info_get_sql);		
		$quick_user_info_get_select_query->bindValue(":sm_mobile",$mobile_input);
		$quick_user_info_get_select_query->execute();
		
	}//close of else if of if ($user_unique_identifier_setting_input == "email-address") {
	
	if($quick_user_info_get_select_query->rowCount() > 0) {
		$quick_user_info_get_select_query_result = $quick_user_info_get_select_query->fetch();
		
		$sm_memb_id_input = $quick_user_info_get_select_query_result["sm_memb_id"];
		
		$constructed_array["user_id"] = $quick_user_info_get_select_query_result["sm_memb_id"];
		$constructed_array["user_email"] = $quick_user_info_get_select_query_result["sm_email"];
		$constructed_array["user_mobile"] = $quick_user_info_get_select_query_result["sm_mobile"];
		$constructed_array["user_phone"] = $quick_user_info_get_select_query_result["sm_phone"];
		$constructed_array["user_salutation"] = $quick_user_info_get_select_query_result["sm_salutation"];
		$constructed_array["user_firstname"] = $quick_user_info_get_select_query_result["sm_firstname"];
		$constructed_array["user_middlename"] = $quick_user_info_get_select_query_result["sm_middlename"];
		$constructed_array["user_lastname"] = $quick_user_info_get_select_query_result["sm_lastname"];
		$constructed_array["user_type"] = $quick_user_info_get_select_query_result["sm_user_type"];
		$constructed_array["user_status"] = $quick_user_info_get_select_query_result["sm_user_status"];
		
		$user_classification_details_result = ea_get_user_classication_details($sm_memb_id_input);
		
		$user_classification_name_association_ups_array = array();
		foreach($user_classification_details_result as $user_classification_details_result_row) {
			$sm_site_member_classification_detail_id = $user_classification_details_result_row["sm_site_member_classification_detail_id"];
			$sm_user_role = $user_classification_details_result_row["sm_user_role"];
			$user_privilege_summary = $user_classification_details_result_row["user_privilege_summary"];
			
			$user_classification_name_association_ups_array[] = $user_privilege_summary;
			
		}//close of foreach($user_classification_details_result as $user_classification_details_result_row) {
		
		$constructed_array["user_privileges_list"] = implode(",", $user_classification_name_association_ups_array);
		
		return $constructed_array;
	}//close of if($quick_user_info_get_select_query->rowCount() > 0) {
	return $constructed_array;
	
}


?>