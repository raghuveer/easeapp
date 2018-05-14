<?php
//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library Start
//echo "halite included in commandline\n";

//Symmetric
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Contract/KeyInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Contract/SymmetricKeyCryptoInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Key.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Util.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Config.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Symmetric/Crypto.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Symmetric/SecretKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Symmetric/EncryptionKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Symmetric/Config.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Halite.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/KeyFactory.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/KeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/EncryptionKeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/SignatureKeyPair.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Symmetric/AuthenticationKey.php");

//Alerts
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Alerts/HaliteAlert.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Alerts/CannotPerformOperation.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Alerts/InvalidType.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Alerts/InvalidKey.php");


//Asymmetric
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Contract/AsymmetricKeyCryptoInterface.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/Crypto.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/PublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/EncryptionPublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/SecretKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/EncryptionSecretKey.php");

//Asymmetric Signature
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/SignaturePublicKey.php");
include(dirname(dirname(dirname(dirname(__FILE__)))) . "/app/includes/halite-v150/src/Asymmetric/SignatureSecretKey.php");


//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library End
?>