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
  //This file has a function to authorize the User Access

	function matchUserAccess($sm_user_roles_list_array_from_session, $allowed_user_roles_for_page)
	{
			if((count($sm_user_roles_list_array_from_session) >0) && (count($allowed_user_roles_for_page) > 0)){
				foreach($sm_user_roles_list_array_from_session as $sessionKey => $sessionArray)
				{
					foreach($allowed_user_roles_for_page as $allowed_user_roles_for_page_single_key => $allowed_user_roles_for_page_single){
									
						if(($sessionArray['sm_user_type'] == $allowed_user_roles_for_page_single['sm_user_type']) && ($sessionArray['sm_user_level'] == $allowed_user_roles_for_page_single['sm_user_level']) && ($sessionArray['sm_user_role'] == $allowed_user_roles_for_page_single['sm_user_role']) && ($sessionArray['department'] == $allowed_user_roles_for_page_single['department']) ){
							return "user_allowed";
						}
					}
				}
			}
			return "user_not_allowed";
	}
?>