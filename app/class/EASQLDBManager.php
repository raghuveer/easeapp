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
 * DB Class
 * @author   Pradeep Ganapathy <bu.pradeep@gmail.com>
 * This class is used for database related operations like Connect, Insert, Update, and Delete. Currently, this is targeted to MySQL and MariaDB Databases.
 */ 

 
class DB{

    private $dbcon; 
    private $objDBLog; 
    
    public function __construct(){		
        global $dbhost_site, $dbusername_site, $dbpassword_site, $dbname_site; 
        $this->objDBLog = new Logger("db_error", true);        
        $this->connect($dbhost_site, $dbname_site, $dbusername_site, $dbpassword_site);
    }
    
    /*
    * Connect Database    
    * @param array dbHost, $dbName, dbUsername, dbPassword	 
    */
    public function connect($dbHost, $dbName, $dbUsername, $dbPassword){
		
        try{	            
            // Connect to the database            
            $conn = new PDOEx("mysql:host=".$dbHost.";dbname=".$dbName.";port=3306;charset=utf8mb4", $dbUsername, $dbPassword);                
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // fetch associative arrays (default: mixed arrays)
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->dbcon = $conn;
        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 3);
            $this->objDBLog->log("mysql:host=".$dbHost.":".$dbName.":".$dbUsername.":".$dbPassword);
            $this->objDBLog->logNewSeperator();
        }  
    }
    
    /*
    * Returns rows from the database based on the conditions
    * @param string name of the table
    * @param array select, where, order_by, limit and return_type conditions
    *
    * For getting count or number for rows,
    *				single row - return_type => single
    *				count     - return_type => count	

    * For specifing select fields, or will return all rows
    *				select => array('field1','filed2');	 
    */
    public function getAll($table, $conditions = array()){
		
        try{	
            $data = array();
            $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions) ? implode(",", $conditions['select']) : '*';
            $sql .= ' FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = :".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key)."";
                    $i++;
                }
            }
            if(array_key_exists("order_by",$conditions)){
                $sql .= ' ORDER BY '.$conditions['order_by']; 
            }

            if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
            }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['limit']; 
            }

            $query = $this->dbcon->prepare($sql);
            if(is_array(@$conditions['where']) && (count(@$conditions['where']) > 0)){           
                foreach($conditions['where'] as $key => $value){					
                    $query->bindValue(':'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key), $value);
                }
            }
            $query->execute();
            $data = $query->fetchAll();
            return $data;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 1);
            $this->objDBLog->log("Query : ".$sql."=== Condition : ".json_encode($conditions));
            $this->objDBLog->logNewSeperator();
        }  
    }
    
    /*
    * Returns rows from the database based on the conditions
    * @param string name of the table
    * @param array select, where, order_by, limit and return_type conditions
    
    * For specifing select fields, or will return all rows
    *				select => array('field1','filed2');	 
    */
    public function getSingle($table, $conditions = array()){		
        try{			
            $data = array();
            $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions) ? implode(",", $conditions['select']) : '*';
            $sql .= ' FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = :".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key)."";
                    $i++;
                }
            }
            if(array_key_exists("order_by",$conditions)){
                $sql .= ' ORDER BY '.$conditions['order_by']; 
            }  
            $query = $this->dbcon->prepare($sql);
            if(is_array(@$conditions['where']) && (count(@$conditions['where']) > 0)){           
                foreach($conditions['where'] as $key => $value){					                    
                    $query->bindValue(':'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key), $value);
                }
            }
            $query->execute();
            $data = $query->fetch();
            return $data;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 1);
            $this->objDBLog->log("Query : ".$sql."=== Condition : ".json_encode($conditions));
            $this->objDBLog->logNewSeperator();
        }  
    }
    
    /*
    * Returns count of the affected rows
    * @param string name of the table
    * @param array where condition on getting count
    */
    public function getCount($table, $conditions = array()){
		
        try{			
            $sql = 'SELECT count(*) as count FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = :".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key)."";
                    $i++;
                }
            }

            $query = $this->dbcon->prepare($sql);
            if(is_array(@$conditions['where']) && (count(@$conditions['where']) > 0)){           
                foreach($conditions['where'] as $key => $value){					
                    $query->bindValue(':'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key), $value);
                }
            }
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);            
            return (count($data) > 0) ? $data['count'] : 0;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 1);
            $this->objDBLog->log("Query : ".$sql."=== Condition : ".json_encode($conditions));
            $this->objDBLog->logNewSeperator();
        }  
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table, $data){
		
        if(is_null(trim($table)))
                return false;
		
        if(empty($data) || !is_array($data) || count($data) == 0)
            return false;	

        try{			
            $columns = '';  $values  = '';  $i = 0;
            $columnString = implode(',', array_keys($data));
            $valueString = ":i_".implode(',:i_', array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";                
            $sth = $this->dbcon->prepare($sql);
            foreach($data as $key=>$val){                   
                $sth->bindValue(':i_'.$key, $val);
            }		
            $insert = $sth->execute();
            return ($insert) ? true:false;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 2);
            $this->objDBLog->log("Query : ".$sql."=== Data : ".json_encode($data));
            $this->objDBLog->logNewSeperator();
        }           
    }
    
    /*
    * Returns rows from the database based on the conditions and lock that row if it is innoDB
    * @param string name of the table
    * @param array select, where and return_type conditions
    
    * For specifing select fields, or will return all rows
    *				select => array('field1','filed2');	 
    */
    public function getSingleForLock($table, $conditions = array()){		
        try{			
            $data = array();
            $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions) ? implode(",", $conditions['select']) : '*';
            $sql .= ' FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = :".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key)."";
                    $i++;
                }
            }
            $sql .= ' FOR UPDATE';
            $query = $this->dbcon->prepare($sql);
            if(is_array(@$conditions['where']) && (count(@$conditions['where']) > 0)){           
                foreach($conditions['where'] as $key => $value){					                    
                    $query->bindValue(':'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key), $value);
                }
            }
            $query->execute();
            $data = $query->fetch();
            return $data;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 1);
            $this->objDBLog->log("Query : ".$sql."=== Condition : ".json_encode($conditions));
            $this->objDBLog->logNewSeperator();
        }  
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function lastInsertId(){	
        return $this->dbcon->lastInsertId();
    }
    
    public function beginTransaction(){	
        return $this->dbcon->beginTransaction();
    }
    
    public function commit(){	
        return $this->dbcon->commit();
    }
    
    public function rollBack(){	
        return $this->dbcon->rollBack();
    }
    
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table, $data, $conditions){
        if(is_null(trim($table)))
            return false;

        if(empty($data) || !is_array($data) || count($data) == 0)
            return false;	

        try{			
            $colvalSet = ''; $whereSql = ''; $i = 0;			
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."=:u_".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key);
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = :c_".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key);
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $sth = $this->dbcon->prepare($sql);			
            foreach($data as $key1=>$val1){                    
                $sth->bindValue(':u_'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key1), $val1);
            }			
            if(!empty($conditions)&& is_array($conditions)){           
                foreach($conditions as $key2 => $value2){                        
                    $sth->bindValue(':c_'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key2), $value2);
                }
            }		
            $update = $sth->execute();
            return ($update) ? true : false;

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 2);
            $this->objDBLog->log("Query : ".$sql."=== Data : ".json_encode($data));
            $this->objDBLog->logNewSeperator();
        }
    }
    
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table, $conditions){
        if(is_null(trim($table)))
            return false;

        try{
            $whereSql = '';
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = :c_".preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key);
                    $i++;
                }
            }
            $sql = "DELETE FROM ".$table.$whereSql;
            $sth = $this->dbcon->prepare($sql);
            if(!empty($conditions)&& is_array($conditions)){           
                foreach($conditions as $key => $value){
                    $sth->bindValue(':c_'.preg_replace('/\(([^()]*+|(?R))*\)\s*/', '', $key), $value);
                }
            }		
            return $sth->execute();

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 2);
            $this->objDBLog->log("Query : ".$sql."=== Data : ".json_encode($data));
            $this->objDBLog->logNewSeperator();
        }
    }
    
    /*
     * Query data from the database
     * @param string name of the table
     * @param string select query
     */
    public function selectQuery($query, $bindParams = array()){
        if(is_null(trim($query)))
            return false;   
        
        try{            
            $sth = $this->dbcon->prepare($query);
            if(is_array($bindParams) && count($bindParams) > 0){
                foreach($bindParams as $bindParamsKey => $bindParamsValue){
                    $sth->bindValue($bindParamsKey, $bindParamsValue);
                }
            }
            $sth->execute();
            return $sth->fetchAll();

        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 2);
            $this->objDBLog->log("Query : ".$sql."=== Data : ".json_encode($data));
            $this->objDBLog->logNewSeperator();
        }
    }    
    
    /*
     * Query data from the database
     * @param string name of the table
     * @param string select query
     */
    public function query($query, $bindParams = array()){
        if(is_null(trim($query)))
            return false;   
        
        try{            
            $sth = $this->dbcon->prepare($query);
            if(is_array($bindParams) && count($bindParams) > 0){
                foreach($bindParams as $bindParamsKey => $bindParamsValue){
                    $sth->bindValue($bindParamsKey, $bindParamsValue);
                }
            }
            $sth->execute();
        }catch(PDOException $e){
            $this->objDBLog->logNewSeperator();
            $this->objDBLog->log($e->getMessage(), 2);
            $this->objDBLog->log("Query : ".$sql."=== Data : ".json_encode($data));
            $this->objDBLog->logNewSeperator();
        }
    }
}