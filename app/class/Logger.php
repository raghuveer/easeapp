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
 *
 *
 *
 * Logger Class
 * @author   Pradeep Ganapathy <bu.pradeep@gmail.com>
 * This class is used to log chosen events, in a file based log.
 */ 
class Logger{

    private $logfile; 
    private $dbUsername;
    private $dbPassword;
    private $dbName;

    public function __construct($filename, $dailylog = false){	
        global $current_epoch, $siteLogPath;
        if($dailylog){        
            $logDir = $siteLogPath.df_convert_unix_timestamp_to_date_custom_timezone($current_epoch, "Asia/Kolkata", "d-m-Y");
            if(!is_dir($logDir)) mkdir($logDir,0755);
            $logFile = $logDir."/".$filename.".txt";	
        }else{         
            $logFile = $logDir."/".$filename.".txt";	
        }        
        $logFile = $logDir."/".$filename.".txt";	
        $this->logfile = $logFile;
    }
           
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function log($msg, $severity = 0){ 
        global $current_epoch;
        $datetime = df_convert_unix_timestamp_to_datetime_custom_timezone($current_epoch);		        
        $logMsg = "\n".$severity. ":: ".$datetime ." :: " . $msg;		
        file_put_contents($this->logfile , $logMsg, FILE_APPEND);
    }
    
    public function logNewSeperator(){ 
        global $current_epoch;
        $datetime = df_convert_unix_timestamp_to_datetime_custom_timezone($current_epoch);		        
        $logMsg = "\n0:: ".$datetime ." :: ------------------------- ";		
        file_put_contents($this->logfile , $logMsg, FILE_APPEND);
    }
}