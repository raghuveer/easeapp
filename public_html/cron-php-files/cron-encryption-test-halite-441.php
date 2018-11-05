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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or               * Contributors and is licensed as per their Open Source License choices.
 */
 
echo "before command line include\n";
//if the directory is one directory above the current file's parent directory http://stackoverflow.com/a/2100763/811207
include(dirname(dirname(dirname(__FILE__))) . "/app/core/command-line-include.php");
echo "command line included\n";
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
		
		
//Message to be Encrypted
$message_to_be_encrypted = "Your message here. Any string content will do just fine. Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :)Sri Rama anta Bagundali :)  Sri Rama anta Bagundali :) Sri Rama anta Bagundali :) Sri Rama anta Bagundali :)";

echo "message_to_be_encrypted: <br>" . $message_to_be_encrypted . "<br><hr><br>\n\n";


/*
//Encrypt the input using Symmetric Encryption to receive hexadecimal encoded string as default outcome. If in case, raw binary encrypted data is expected then, true has to be passed as a third argument.
$ciphertext = \ParagonIE\Halite\Symmetric\Crypto::encrypt(
    $message_to_be_encrypted,
    $pg_symmetric_encryption_key
);
echo "ciphertext: <br>" . $ciphertext . "<br><hr><br>";

//Signing an Encrypted message (that is encrypted using Symmetric Encryption key) with an Asymmetric Authentication Secret key:
$asymmetric_key_sign_message_signature = \ParagonIE\Halite\Asymmetric\Crypto::sign(
    $ciphertext,
    $pg_asymmetric_authentication_secret_key
);

echo "asymmetric_key_sign_message_signature: " . $asymmetric_key_sign_message_signature . "<br><hr><br>\n\n";



//Verifying the signature of a message with its corresponding public key:

$asymmetric_key_authentication_valid = \ParagonIE\Halite\Asymmetric\Crypto::verify(
    $ciphertext,
    $pg_asymmetric_authentication_public_key,
    $asymmetric_key_sign_message_signature
);

echo "asymmetric_key_sign_message_signature_verification: " . $asymmetric_key_authentication_valid . "<br><hr><br>\n\n";

*/


//Asymmetric Anonymous Encryption of a message
$sealed = \ParagonIE\Halite\Asymmetric\Crypto::seal(
    new ParagonIE\Halite\HiddenString(
        $message_to_be_encrypted
    ),
    $pg_asymmetric_anonymous_encryption_public_key
);
echo "sealed: <br>" . $sealed . "<br><hr><br>";

//Signing an Encrypted message (that is sealed using Asymmetric Anonymous Encryption key) with an Asymmetric Authentication Secret key:
$asymmetric_key_sign_sealed_message_signature = \ParagonIE\Halite\Asymmetric\Crypto::sign(
    $sealed,
    $pg_asymmetric_authentication_secret_key
);

echo "asymmetric_key_sign_sealed_message_signature: " . $asymmetric_key_sign_sealed_message_signature . "<br><hr><br>\n\n";


//Signing a Plaintext message with an Asymmetric Authentication Secret key:
$asymmetric_key_sign_plaintext_message_signature = \ParagonIE\Halite\Asymmetric\Crypto::sign(
    $message_to_be_encrypted,
    $pg_asymmetric_authentication_secret_key
);

echo "asymmetric_key_sign_plaintext_message_signature: " . $asymmetric_key_sign_plaintext_message_signature . "<br><hr><br>\n\n";

echo "\n<br>====================================================================================<br>\n";


//Verifying the signature of the plaintext message with its corresponding public key:

if (\ParagonIE\Halite\Asymmetric\Crypto::verify($message_to_be_encrypted, $pg_asymmetric_authentication_public_key,
    $asymmetric_key_sign_plaintext_message_signature) === true) {
	echo "asymmetric_key_authentication_plaintext_message_valid_verification is successful<br><hr><br>\n\n";
	//Verifying the signature of Asymmetric Anonymous Encrypted message with its corresponding public key:

	if (\ParagonIE\Halite\Asymmetric\Crypto::verify($sealed, $pg_asymmetric_authentication_public_key, 
		$asymmetric_key_sign_sealed_message_signature
	) === true) {
		echo "asymmetric_key_authentication_sealed_message_valid_verification is successful<br><hr><br>\n\n";
				
		//Decrypting an Asymmetric Anonymous Encrypted message

		$opened = \ParagonIE\Halite\Asymmetric\Crypto::unseal(
			$sealed,
			$pg_asymmetric_anonymous_encryption_secret_key
		);
		echo "opened: <br>\n" . $opened . "<br><hr><br>\n\n"; 

	} else {
		echo "asymmetric_key_authentication_sealed_message_valid_verification is unsuccessful<br><hr><br>\n\n";
	}
} else {
	echo "asymmetric_key_authentication_plaintext_message_valid_verification is unsuccessful<br><hr><br>\n\n";
}

echo "\n\n===================XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX==============================\n\n";
exit;
//Message to be Sealed
$logs_message_to_be_sealed = "Your message here. Any string content will do just fine.";
//Encrypting an anonymous message
$sealed_logs = \ParagonIE\Halite\Asymmetric\Crypto::seal(
    $logs_message_to_be_sealed,
    $pg_asymmetric_anonymous_encryption_logs_public_key
);

//Note: Once again, this defaults to hexadecimal encoded output. If you desire raw binary, you can pass an optional true as the fourth argument to Crypto::seal().
echo "<br>logs_message_to_be_sealed: <br>" . $logs_message_to_be_sealed . "<br><hr><br>"; 
echo "sealed_logs: <br>" . $sealed_logs . "<br><hr><br>"; 

//Decrypting an anonymous message

$opened_logs = \ParagonIE\Halite\Asymmetric\Crypto::unseal(
    $sealed_logs,
    $pg_asymmetric_anonymous_encryption_logs_secret_key
);
echo "opened_logs: <br>" . $opened_logs . "<br><hr><br>"; 


		
	}//close of for ( $i = 1; $i <=$res_loop; $i++ ) {
		
}//close of if ( $res_state == "ON" ) {
echo "\n<br>Message before clearing memory: \n<br>" . $message_to_be_encrypted;	
\Sodium\memzero($message_to_be_encrypted);
echo "\n<br>Message after clearing memory: \n<br>" . $message_to_be_encrypted;
//\Sodium\memzero($key);

?>