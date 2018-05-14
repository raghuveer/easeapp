<?php
//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library Start
//echo "halite included in commandline\n";

//Symmetric
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Contract/KeyInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Contract/SymmetricKeyCryptoInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Key.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Util.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Config.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Symmetric/Crypto.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Symmetric/SecretKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Symmetric/EncryptionKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Symmetric/Config.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Halite.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/KeyFactory.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/KeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/EncryptionKeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/SignatureKeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Symmetric/AuthenticationKey.php");

//Alerts
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Alerts/HaliteAlert.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Alerts/CannotPerformOperation.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Alerts/InvalidType.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Alerts/InvalidKey.php");


//Asymmetric
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Contract/AsymmetricKeyCryptoInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/Crypto.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/PublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/EncryptionPublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/SecretKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/EncryptionSecretKey.php");

//Asymmetric Signature
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/SignaturePublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v320/src/Asymmetric/SignatureSecretKey.php");


//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library End
?>