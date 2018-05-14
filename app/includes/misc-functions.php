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
?>