<?php
  if(defined('STDIN') ){
  //echo("Running from CLI");
}else{
  //echo("Not Running from CLI");
  defined('START') or die;
  }
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or Contributors * and is licensed as per their Open Source License choices.
 *
 * This Class is obtained by sources like StackOverFlow, with little customizations by me.
 * http://stackoverflow.com/a/12850992
 * http://stackoverflow.com/questions/1290867/count-number-of-mysql-queries-executed-on-page
 * http://stackoverflow.com/questions/12850886/count-number-of-queries-each-page-load-with-pdo
 * https://github.com/geoloqi/PHP-PDO-Improved/issues/1#issuecomment-18292492
 */

    class PDOEx extends PDO
      {
          private $queryCount = 0;
      
       /*   public function connect($dsn, $user, $pass)
          {
            $options = array(
                PDO::ATTR_STATEMENT_CLASS => array('MyPDOStatement'),
            );
            parent::__construct($dsn, $user, $pass, $options);
          } 
          
          function __construct($connect_str, $username, $password)
           {
             parent::__construct($connect_str, $username, $password);
           }  */

          public function query($query)
          {
          // Increment the counter.
              ++$this->queryCount;
      
          // Run the query.
              return parent::query($query);
          }
      
          public function exec($statement)
          {
          // Increment the counter.
              ++$this->queryCount;
      
          // Execute the statement.
              return parent::exec($statement);
          }
          
          public function prepare($statement, $driver_options = array())
          {
          // Increment the counter.
              ++$this->queryCount;
      
          // Execute the statement.
              return parent::prepare($statement, $driver_options);
          }
      
          public function GetCount()
          {
              return $this->queryCount;
          }
      }
?>