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
 
 
//Send Email using Sendmail through PHPMailer
function send_email_using_sendmail_thr_phpmailer($from_email_input, $sender_name_input, $reply_to_email_input, $to_email_input, $receiver_name_input, $subject_input, $plaintext_input, $html_message_input){
	    global $phpmailer_sendmail;
		// Set PHPMailer to use the sendmail transport
		//$phpmailer_sendmail->isSendmail();
		
		$phpmailer_sendmail->ClearAllRecipients();
		$phpmailer_sendmail->ClearAddresses();
		
		//Set who the message is to be sent from
		$phpmailer_sendmail->setFrom($from_email_input, $sender_name_input);
		//Set an alternative reply-to address
		$phpmailer_sendmail->addReplyTo($reply_to_email_input, $sender_name_input);
		//Sender for receiving mail server
		$phpmailer_sendmail->Sender=$from_email_input;
		//Set who the message is to be sent to
		$phpmailer_sendmail->addAddress($to_email_input, $receiver_name_input);
		//Set the subject line
		$phpmailer_sendmail->Subject = $subject_input;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$phpmailer_sendmail->msgHTML($html_message_input);
		//Replace the plain text body with one created manually
		$phpmailer_sendmail->AltBody = $plaintext_input;
		//send the message, check for errors
		if (!$phpmailer_sendmail->send()) {
			//echo $phpmailer_sendmail->ErrorInfo;
			return "message-sending-error:::::" . $phpmailer_sendmail->ErrorInfo;
		} else {
			//echo "Message sent";
			return "message-sent:::::1";
		}
}

//http://php.net/manual/en/function.array-unique.php#116302
function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
} 
//$details = unique_multidim_array($details,'id');
//where $details is the multi-dimensional array 

function clean_excel_file_row_content($excel_file_row_content_input){
	$excel_file_row_content_input_count = count($excel_file_row_content_input);
	$excel_file_row_content_output = array();
	for ($row = 0; $row <= $excel_file_row_content_input_count; $row++) {
		if ($excel_file_row_content_input[$row] != "") {
			$excel_file_row_content_output[$row] = trim(strip_tags($excel_file_row_content_input[$row]));
		} else {
			$excel_file_row_content_output[$row] = null;
		}
		
	}
	return $excel_file_row_content_output;
}

function ea_create_array_from_http_raw_json_data(){
	
	$received_content = array();
	if ($_SERVER["CONTENT_TYPE"] == "application/json") {
		
		$received_content["received_data_array"] = json_decode(file_get_contents('php://input'), true);
		$received_content["received_content_type"] = "application/json";
		
	} else {
		$received_content["received_data_array"] = array();
		$received_content["received_content_type"] = $_SERVER["CONTENT_TYPE"];
		
	}//close of else of if ($_SERVER["CONTENT_TYPE"] == "application/json") {
	return $received_content;
	
}

function sendPushNotification($notification, $imps_sender_phone){
	 
	global $push_notification_realtime_co_app_key, $push_notification_realtime_co_app_private_key, $push_notification_realtime_co_channelname;
 
	$URL = 'http://ortc-developers.realtime.co/server/2.1';
	$AK = $push_notification_realtime_co_app_key; 
	$PK = $push_notification_realtime_co_app_private_key;
	/*$TK = 'wc_drona_app_'.$imps_sender_phone;   // token can be randomly generated
	$CH = 'wc_drona_app_'.$imps_sender_phone;*/
	$TK = 'drona_app_'.$imps_sender_phone;   // token can be randomly generated
	$CH = 'drona_app_'.$imps_sender_phone;
	 
	// Authenticating a token with write (w) permissions on myChannel
	 
	//if( ! array_key_exists('ortc_token', $_SESSION) ){
		//$_SESSION['ortc_token'] = $TK;
		$rt = new Realtime( $URL, $AK, $PK, $TK );
		$ttl = 180000;
		$result = $rt->auth(
			array(
				$CH => 'w'
			),
			0,
			$ttl
		);
		//print '<!-- auth status '.( $result ? 'ok' : 'fail' ).' -->\n';
	//}
	 
	// Send Hello World message
	$result = $rt->send($CH, $notification, $response);
	//print '<!-- send status '.( $result ? 'ok' : 'fail' ).' -->\n';
		
	if($result){
		return $response['errcode']." - ".$response['content'];
	}else{
		return $response['errcode']." - ".$response['response'][1];
	}	
}

function getMaintananceInfo(){
	
	global $dbcon,$current_epoch; $maintananceModeTime = "";
	
	$settings_sql = "SELECT `time_to_go_live` FROM `settings` WHERE `deployment_status` = :deployment_status";	
	$settings_q = $dbcon->prepare($settings_sql);	
	$settings_q->bindValue(":deployment_status","maintenance");
	if($settings_q->execute()) {												
		
		if($settings_q->rowCount() > 0){													
			$maintananceInfo = $settings_q->fetch();
			$maintananceTime = $maintananceInfo['time_to_go_live'];
			if($current_epoch < $maintananceTime){				
				
				$seconds = $maintananceTime - $current_epoch;

				$days    = floor($seconds / 86400);
				$hours   = floor(($seconds - ($days * 86400)) / 3600);
				$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
				$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));

				$maintananceModeTime = "Systems are in maintenance. Please come back after ";
				if($days > 0)
					$maintananceModeTime .= $days." days, ";
				if($hours > 0)
					$maintananceModeTime .= $hours." hours, ";
				if($minutes > 0)
					$maintananceModeTime .= $minutes." minutes and ";
				if($seconds > 0)
					$maintananceModeTime .= $seconds." seconds";
			}
			
		}												
	}	
	return $maintananceModeTime;
}

?>