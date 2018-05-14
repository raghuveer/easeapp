<?php
if(defined('STDIN') ){
  //echo("Running from CLI");
}else{
  echo("Not Running from CLI");
  exit();
}

//if the directory is one directory above the current file's parent directory http://stackoverflow.com/a/2100763/811207
//include("/home/swnet/public_html/core/server-var-info.php");
include dirname(dirname(__FILE__)) . "/app/core/server-var-info.php";
include dirname(dirname(__FILE__)) . "/app/core/main-config.php";


//http://stackoverflow.com/questions/18738225/how-to-get-the-actual-current-working-dir-for-a-php-cli-script?rq=1
//http://stackoverflow.com/a/18738438
$file_directory_path = __DIR__; //this is your directory path
//echo "file_directory_path: " . $file_directory_path . "\n\n";
//http://in3.php.net/manual/en/function.stripos.php
if ((stripos($file_directory_path, $cli_dev_account_ref)) !== false) {
  $dbconnection_active = "dev";
  $var = "dev";
  $site_basedir_path = $siteroot_basedir_command_line_dev;
  
  $site_home_path = $site_home_path_full_dev;
} elseif ((stripos($file_directory_path, $cli_live_account_ref)) !== false) {
  $dbconnection_active = "live";
  $var = "live";
  $site_basedir_path = $siteroot_basedir_command_line;
  
  $site_home_path = $site_home_path_full;
}
//echo dirname(dirname(__FILE__)) . "/app/includes/uuid.php\n";
//exit;
include dirname(dirname(__FILE__)) . "/app/includes/uuid.php";
//include dirname(dirname(__FILE__)) . "/app/includes/halite-v150/halite-v150-includes-commandline.php";

//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library Start
//echo "halite included in commandline\n";

//echo"halite library to be included\n";
if ((version_compare(PHP_VERSION, '5.6.0') >= 0) && (version_compare(PHP_VERSION, '7.0.0') == -1)) {
	//echo "5.6.0 to 7.0.0\n";
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/halite-v150/halite-v150-includes-commandline.php");
} else if ((version_compare(PHP_VERSION, '7.0.0') >= 0) && (version_compare(PHP_VERSION, '7.2.0') == -1)) {	
	//echo "7.0.0 to 7.2.0 \n";
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/halite-v320/halite-v320-includes-commandline.php");
} else if (version_compare(PHP_VERSION, '7.2.0') >= 0) {
	//echo "> = php 7.2.0 \n";
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/constant-time-encoding-v20/constant-time-encoding-v20-includes-commandline.php");
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/halite-v402/halite-v402-includes-commandline.php");
}	


//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library End

//echo "included\n";
//echo "site_home_path: " . $site_home_path . "\n";
//exit;
	//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library is used to create Keys Start
		
		/*//Generate Symmetric Encryption Key
		$pg_symmetric_encryption_key = \ParagonIE\Halite\KeyFactory::generateEncryptionKey();
		//Save the generated Symmetric Encryption key to a file
		\ParagonIE\Halite\KeyFactory::save($pg_symmetric_encryption_key, $site_home_path . $pg_generated_enc_keys_folder_name. $pg_symmetric_encryption_key_filename);*/
		
		/*//Generate Symmetric Authentication Key (Digital Signature)
		$pg_symmetric_authentication_key = \ParagonIE\Halite\KeyFactory::generateAuthenticationKey();
		//Save the generated Symmetric Key Authentication key to a file
		\ParagonIE\Halite\KeyFactory::save($pg_symmetric_authentication_key, $site_home_path . 'generated-enc-keys/pg-hmac-sha512-or-sha256-symmetric-authentication.key');*/
		
		/*//Generate Asymmetric Authenticated Encryption Key
		$pg_asymmetric_authenticated_encryption_keypair = \ParagonIE\Halite\KeyFactory::generateEncryptionKeyPair();
		//Save the generated Asymmetric Authenticated Encryption keypair to a file
		\ParagonIE\Halite\KeyFactory::save($pg_asymmetric_authenticated_encryption_keypair, $site_home_path . 'generated-enc-keys/pg-curve25519-asymmetric-authenticated-encryption-keypair.key');*/
		
		//Generate Asymmetric Anonymous Encryption Key
		$pg_asymmetric_anonymous_encryption_keypair = \ParagonIE\Halite\KeyFactory::generateEncryptionKeyPair();
		//Save the generated Asymmetric Anonymous Encryption keypair to a file
		\ParagonIE\Halite\KeyFactory::save($pg_asymmetric_anonymous_encryption_keypair, $site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_keypair_filename);
		
		//Generate Asymmetric Anonymous Encryption Key for Logs
		$pg_asymmetric_anonymous_encryption_logs_keypair = \ParagonIE\Halite\KeyFactory::generateEncryptionKeyPair();
		//Save the generated Asymmetric Anonymous Encryption keypair to a file
		\ParagonIE\Halite\KeyFactory::save($pg_asymmetric_anonymous_encryption_logs_keypair, $site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_logs_keypair_filename);
		                                    
		//Generate Asymmetric Authentication Key (Digital Signature)
		$pg_asymmetric_authentication_keypair = \ParagonIE\Halite\KeyFactory::generateSignatureKeyPair();
		//Save the generated Asymmetric Authentication keypair to a file
		\ParagonIE\Halite\KeyFactory::save($pg_asymmetric_authentication_keypair, $site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_keypair_filename);
		
		//Generate Asymmetric Authentication Key for Logs (Digital Signature)
		$pg_asymmetric_authentication_logs_keypair = \ParagonIE\Halite\KeyFactory::generateSignatureKeyPair();
		//Save the generated Asymmetric Authentication Logs keypair to a file
		\ParagonIE\Halite\KeyFactory::save($pg_asymmetric_authentication_logs_keypair, $site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_logs_keypair_filename);
		
		

		
	//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library is used to create Keys End		
		
?>