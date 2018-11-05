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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or Contributors * and is licensed as per their Open Source License choices.
 *
 *
 *
 * FHalite Class
 * @author   Pradeep Ganapathy <bu.pradeep@gmail.com>
 * This class is used for custom operations based on Halite
 */ 
 
 
class EAHalite{

    private $objHaliteLog;     
    
    public function __construct(){		
        global $pg_asymmetric_anonymous_encryption_secret_key, $pg_asymmetric_anonymous_encryption_public_key; 
        $this->encryptionSecretKey = $pg_asymmetric_anonymous_encryption_secret_key;    
        $this->encryptionPublicKey = $pg_asymmetric_anonymous_encryption_public_key;
        
        global $pg_asymmetric_anonymous_encryption_logs_secret_key, $pg_asymmetric_anonymous_encryption_logs_public_key;
        $this->encryptionLogsSecretKey = $pg_asymmetric_anonymous_encryption_logs_secret_key; 
        $this->encryptionLogsPublicKey = $pg_asymmetric_anonymous_encryption_logs_public_key;
        
        global $pg_asymmetric_authentication_secret_key, $pg_asymmetric_authentication_public_key;
        $this->authenticationSecretKey = $pg_asymmetric_authentication_secret_key; 
        $this->authenticationPublicKey = $pg_asymmetric_authentication_public_key;
        
        global $pg_asymmetric_authentication_logs_secret_key, $pg_asymmetric_authentication_logs_public_key;
        $this->authenticationLogsSecretKey = $pg_asymmetric_authentication_logs_secret_key; 
        $this->authenticationLogsPublicKey = $pg_asymmetric_authentication_logs_public_key;
        
        $this->objHaliteLog = new Logger("halite_error", true);    
    }
        
    /*
     * validate DOC Chash
     * @param string/array/int $data $docData    
     */
    public function validateDOCChash($data, $docData){
        try{            
            $hashedData = $this->createHash($data);
            return ($docData == $hashedData) ? true : false;
        }catch(PDOException $e){
            $this->objHaliteLog->logNewSeperator();
            $this->objHaliteLog->log($e->getMessage(), 2);
            $this->objHaliteLog->log("Data : ".json_encode($data));
            $this->objHaliteLog->logNewSeperator();
        }
    }
            
    /*
     * Create Hash content for given content
     * @param string/array/int $dataToBeDigitalSigned   
     */
    public function createHash($dataToBeDigitalSigned){        
        try{
            $dataToBeDigitalSigned = serialize($dataToBeDigitalSigned);
            $signature = \ParagonIE\Halite\Asymmetric\Crypto::sign(
                $dataToBeDigitalSigned,
                $this->authenticationSecretKey
            );
            return (string)$signature;
        }catch(PDOException $e){
            $this->objHaliteLog->logNewSeperator();
            $this->objHaliteLog->log($e->getMessage(), 2);
            $this->objHaliteLog->log("Data : ".$dataToBeDigitalSigned);
            $this->objHaliteLog->logNewSeperator();
        }
    }  
    
    /*
     * Create Hash content for given content
     * @param string/array/int $dataToBeSealed   
     */
    public function seal($dataToBeSealed){        
        try{
			if (version_compare(PHP_VERSION, '7.2.0') >= 0) {
				$sealedData = \ParagonIE\Halite\Asymmetric\Crypto::seal(
					new ParagonIE\Halite\HiddenString(
						$dataToBeSealed
					),
					$this->encryptionPublicKey
				);
			} else if ((version_compare(PHP_VERSION, '5.6.0') >= 0) && (version_compare(PHP_VERSION, '7.0.0') == -1)) {	
				$sealedData = \ParagonIE\Halite\Asymmetric\Crypto::seal(
					$dataToBeSealed,
					$this->encryptionPublicKey
				);
			}
            /*$sealedData = \ParagonIE\Halite\Asymmetric\Crypto::seal(
                $dataToBeSealed,
				$this->encryptionPublicKey
            );*/
            return (string)$sealedData;
        }catch(PDOException $e){
            $this->objHaliteLog->logNewSeperator();
            $this->objHaliteLog->log($e->getMessage(), 2);
            $this->objHaliteLog->log("Data : ".$dataToBeSealed);
            $this->objHaliteLog->logNewSeperator();
        }
    }  
    
    /*
     * Create Hash content for given content
     * @param string/array/int $dataToBeUnSealed   
     */
    public function unSeal($dataToBeUnSealed){        
        try{            
            $unSealedData = \ParagonIE\Halite\Asymmetric\Crypto::unseal(
                    $dataToBeUnSealed,
                    $this->encryptionSecretKey
            );
            return (string)$unSealedData;
        }catch(PDOException $e){
            $this->objHaliteLog->logNewSeperator();
            $this->objHaliteLog->log($e->getMessage(), 2);
            $this->objHaliteLog->log("Data : ".$dataToBeUnSealed);
            $this->objHaliteLog->logNewSeperator();
        }
    }
}