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
} elseif ((stripos($file_directory_path, $cli_live_account_ref)) !== false) {
  $dbconnection_active = "live";
  $var = "live";
  $siteroot_basedir_cli = $siteroot_basedir_command_line;
}


include(dirname(dirname(__FILE__)) . "/class/PDOEx.php");
include(dirname(dirname(__FILE__)) . "/core/db-connect-main.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/validate-sanitize-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/date-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/db-functions.php");
include(dirname(dirname(dirname(__FILE__))) . "/app/includes/other-functions.php");


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

?>
