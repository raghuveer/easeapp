<?php
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */
//if the directory is one directory above the current file's parent directory http://stackoverflow.com/a/2100763/811207
//include("/home/swnet/public_html/core/server-var-info.php");
include(dirname(dirname(__FILE__)) . "/core/server-var-info.php");
include(dirname(dirname(__FILE__)) . "/core/main-config.php");


//http://stackoverflow.com/questions/18738225/how-to-get-the-actual-current-working-dir-for-a-php-cli-script?rq=1
//http://stackoverflow.com/a/18738438
$file_directory_path = __DIR__; //this is your directory path
//echo $file_directory_path . "\n\n";
//http://in3.php.net/manual/en/function.stripos.php
if ((stripos($file_directory_path, $cli_dev_account_ref)) !== false) {
  $dbconnection_active = "dev";
  $var = "dev";
  $siteroot_basedir_cli = $siteroot_basedir_command_line_dev;
  
  $site_basedir_path = $siteroot_basedir_command_line_dev;
  
  $site_home_path = $site_home_path_full_dev;
  
} elseif ((stripos($file_directory_path, $cli_live_account_ref)) !== false) {
  $dbconnection_active = "live";
  $var = "live";
  $siteroot_basedir_cli = $siteroot_basedir_command_line;
  
  $site_basedir_path = $siteroot_basedir_command_line;
  
  $site_home_path = $site_home_path_full;
  
}


include(dirname(dirname(__FILE__)) . "/class/PDOEx.php");
include(dirname(dirname(__FILE__)) . "/core/db-connect-main.php");
include(dirname(dirname(__FILE__)) . "/class/Logger.php");
include(dirname(dirname(__FILE__)) . "/class/DBManager.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/validate-sanitize-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/date-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/db-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/other-functions.php");

include(dirname(dirname(dirname(__FILE__))) . "/app/includes/uuid.php");

//PHPMailer Library: This is to send Email through SMTP / Sendmail in PHP Scripts
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/phpmailer-v602/src/PHPMailer.php");
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$phpmailer_sendmail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$phpmailer_sendmail->IsSendmail(); // telling the class to use SendMail transport
$phpmailer_sendmail->CharSet="utf-8";

//This hosts any miscellaneous set of functions that are useful and that do not fit elsewhere
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/misc-functions.php");


if (version_compare(PHP_VERSION, '7.2.0') >= 0) {
	//echo 'I am at least PHP version 7.2.0, my version: ' . PHP_VERSION . "\n<br><br>";
	//Include Constant Time Encoding Library v2.0 from Paragonie
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/constant-time-encoding-v20/constant-time-encoding-v20-includes-commandline.php");
	//Include Halite Library from Paragonie
	//include(dirname(dirname(dirname(__FILE__))) . "/app/includes/halite-v402/halite-v402-includes-commandline.php");
	include(dirname(dirname(dirname(__FILE__))) . "/app/includes/halite-v441/halite-v441-includes-commandline.php");
	
	
	/*//Check if Libsodium is setup correctly, result will be bool(true), if all is good, https://stackoverflow.com/a/37687595
	//var_dump(ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly());
	//echo ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly(true);	
	//echo "<br><br>";
	//Check the installed versions of Libsodium
	echo "<br>var_dump result<br>";
	var_dump([
		SODIUM_LIBRARY_MAJOR_VERSION,
		SODIUM_LIBRARY_MINOR_VERSION,
		SODIUM_LIBRARY_VERSION
	]);
	echo "<br>print_r result<br>";
	print_r([
		SODIUM_LIBRARY_MAJOR_VERSION,
		SODIUM_LIBRARY_MINOR_VERSION,
		SODIUM_LIBRARY_VERSION
	]);
	echo "<br><hr><br><pre>";
	*/

	
	//Check, if Libsodium is setup correctly
	if (ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly() === true) {
		//echo "true<br>";
		/*//Retrieve the previous saved Symmetric Encryption key from the file
		$pg_symmetric_encryption_key = \ParagonIE\Halite\KeyFactory::loadEncryptionKey($site_home_path . $pg_generated_enc_keys_folder_name. $pg_symmetric_encryption_key_filename);*/

		//Retrieve the previous saved Asymmetric Anonymous Encryption key from the file
		$pg_asymmetric_anonymous_encryption_keypair = \ParagonIE\Halite\KeyFactory::loadEncryptionKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_keypair_filename);

		$pg_asymmetric_anonymous_encryption_secret_key = $pg_asymmetric_anonymous_encryption_keypair->getSecretKey();
		$pg_asymmetric_anonymous_encryption_public_key = $pg_asymmetric_anonymous_encryption_keypair->getPublicKey();
		
		//Retrieve the previous saved Asymmetric Anonymous Encryption key for Logs from the file
		$pg_asymmetric_anonymous_encryption_logs_keypair = \ParagonIE\Halite\KeyFactory::loadEncryptionKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_anonymous_encryption_logs_keypair_filename);

		$pg_asymmetric_anonymous_encryption_logs_secret_key = $pg_asymmetric_anonymous_encryption_logs_keypair->getSecretKey();
		$pg_asymmetric_anonymous_encryption_logs_public_key = $pg_asymmetric_anonymous_encryption_logs_keypair->getPublicKey();

		//Retrieve the previous saved Asymmetric Authentication key from the file
		$pg_asymmetric_authentication_keypair = \ParagonIE\Halite\KeyFactory::loadSignatureKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_keypair_filename);

		$pg_asymmetric_authentication_secret_key = $pg_asymmetric_authentication_keypair->getSecretKey();
		$pg_asymmetric_authentication_public_key = $pg_asymmetric_authentication_keypair->getPublicKey();
		
		//Retrieve the previous saved Asymmetric Authentication key for Logs from the file
		$pg_asymmetric_authentication_logs_keypair = \ParagonIE\Halite\KeyFactory::loadSignatureKeyPair($site_home_path . $pg_generated_enc_keys_folder_name. $pg_asymmetric_authentication_logs_keypair_filename);

		$pg_asymmetric_authentication_logs_secret_key = $pg_asymmetric_authentication_logs_keypair->getSecretKey();
		$pg_asymmetric_authentication_logs_public_key = $pg_asymmetric_authentication_logs_keypair->getPublicKey();
	}//close of if (ParagonIE\Halite\Halite::isLibsodiumSetupCorrectly() === true) {
	

}//close of if (version_compare(PHP_VERSION, '7.2.0') >= 0) {






include(dirname(dirname(dirname(__FILE__))) . "/app/includes/other-functions-api.php");

//jeremykendall-php-domain-parser start https://github.com/jeremykendall/php-domain-parser
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/Pdp/PublicSuffixListManager.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/Pdp/PublicSuffixList.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/Pdp/Parser.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/pdp-parse-url.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/Pdp/Uri/Url/Host.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/jeremykendall-php-domain-parser/src/Pdp/Uri/Url.php");

use Pdp\PublicSuffixListManager;
use Pdp\Parser;
// Obtain an instance of the parser
$pslManager = new PublicSuffixListManager();
$parser = new Parser($pslManager->getList());
//jeremykendall-php-domain-parser end https://github.com/jeremykendall/php-domain-parser
  //echo $var . "\n";
$starttime = time();
ini_set("max_execution_time","18000");
ignore_user_abort(2); 
//echo "\n dbconnection_active  = ".$dbconnection_active;
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


$siteLogPath = dirname(dirname(dirname(__FILE__))) . "/easeapp-logs/";

//Include a Custome Halite Operation
include(dirname(dirname(dirname(__FILE__))) . "/app/class/EAHalite.php");
$objEAHalite = new EAHalite();

$db = new DB();


?>
