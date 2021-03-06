<?php
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or                 * Contributors and is licensed as per their Open Source License choices.
 */
 
//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library Start
//echo "constant time encoding included in commandline start\n";


include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/EncoderInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base32.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base32Hex.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base64.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base64DotSlash.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base64DotSlashOrdered.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Base64UrlSafe.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Binary.php");

include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Encoding.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/Hex.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/constant-time-encoding-v20/src/RFC4648.php");

//echo "constant time encoding included in commandline end\n";

//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library End
?>