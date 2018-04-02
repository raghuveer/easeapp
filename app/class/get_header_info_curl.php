<?php
  defined('START') or die;
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri and other contributors
 */
    //http://ontodevelopment.blogspot.in/2011/04/curloptheaderfunction-tutorial-with.html
    //some of the oop related suggestions were helpful to better understanding, http://stackoverflow.com/questions/4335618/php-calling-a-user-defined-function-inside-constructor
    class get_header_info_curl {
    public $input_url;
    public $check_http_header_response_message;
    private $header_response;
    private $headers;
    private $sim_obj_arr_converted;
    private $nested_obj_arr_converted;
    private $php_header_values_array;
    private $http_status_number;
    private $http_file_basename;
    private $extension_file_basename;
    //function get_header_info_curl() is a constructor, and in php5, we need to use "public" keyword before user function when defining it as constructor, also, usage of function __construct() instead of user function is recommended
    //http://stackoverflow.com/a/4335652/811207
    public function __construct($url){
        //require filter function in php, which is supported from PHP v5.0. PHP Filter based URL Sanitation is too flexible, need to find a better alternative in this situation.
        $url_sanitized = filter_var($url, FILTER_SANITIZE_URL);
        if(!filter_var($url_sanitized, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED))
        {
        $this->check_http_header_response_message = "Inputed URL is not valid";
        }
        $this->input_url = $url_sanitized;
        // initialize curl with given url
        $ch = curl_init($url_sanitized);
        // make sure we get the header
        curl_setopt($ch, CURLOPT_HEADER, 1);
        // make it a http HEAD request
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        //Tell curl to write the response to a variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->header_response = curl_exec($ch);
        curl_close($ch);
    }
    
    /*public function check_http_header_response(){
          if($this->header_response == "Inputed URL is not valid"){
          $this->check_http_header_response_message = "Inputed URL is not valid";
          }else{
               $this->check_http_header_response_message = "Inputed URL is valid";
             }
          return $this->check_http_header_response_message;        
    }*/
    
    public function seperate_http_header_values(){
          $this->headers = $this->nested_object_array_convert($this->header_response);
          $this->headers = $this->convert_php_header_values_array($this->headers);
          return $this->headers;        
    }
    
    function nested_object_array_convert($object){
        //http://stackoverflow.com/a/16111687/811207
        //http://stackoverflow.com/questions/4345554/convert-php-object-to-associative-array
        $this->nested_obj_arr_converted =  json_decode(json_encode($object), true);
        return $this->nested_obj_arr_converted;
    }

    function convert_php_header_values_array($header_array_input){
        //http://stackoverflow.com/a/10372461/2889735
        //http://stackoverflow.com/a/19422894/811207
        //http://stackoverflow.com/questions/10372298/split-curl-header-info-into-array
        $header_values_array=array();
        //$data=explode("\n",$header_array_input["headers_response"]);        
        $data=explode("\n",$header_array_input);
        $header_values_array['status']=$data[0];        
        array_shift($data);
        foreach($data as $part){
        $middle=explode(": ",$part,2);
        /* http://stackoverflow.com/questions/17456325/php-notice-undefined-offset-1-with-array-when-reading-data
        http://stackoverflow.com/a/17456614
        $data[$parts[0]] = isset($parts[1]) ? $parts[1] : null;*/
        //$header_values_array[trim($middle[0])] = trim($middle[1]);
        $header_values_array[trim($middle[0])] = isset($middle[1]) ? trim($middle[1]) : null;
        }
        /*echo "<pre>";
        print_r($header_values_array);
        echo "</pre>";*/
        $this->php_header_values_array =  $header_values_array;
        return $this->php_header_values_array;
    }
    
    function http_status_str_to_num($http_status_string){
        //http://us2.php.net/manual/en/function.get-headers.php#112652
        $this->http_status_number = intval(substr($http_status_string, 9, 3));        
        return $this->http_status_number;
    }
    
    function http_basename($http_headers_array_input, $http_status_num_input){
        if(($http_status_num_input == "302") || ($http_status_num_input == "301"))
        {
          if($http_headers_array_input['Location'] !="")
          {
            //need to verify the url to ensure status is 200 and to ensure then extension is related to .exe, .zip, .tar.gz etc
            $this->http_file_basename = basename($http_headers_array_input['Location']);
            return $this->http_file_basename;
          }
        }
        else if($http_status_num_input == "200")
        {
          if($http_headers_array_input['Content-Disposition'] != "")
          {
            $content_disposition_pieces = explode("=", $http_headers_array_input['Content-Disposition']);
            $this->http_file_basename = str_ireplace("'", "", $content_disposition_pieces[1]);
            $this->http_file_basename = str_ireplace('"', "", $this->http_file_basename);
            $this->http_file_basename = str_ireplace(';', "", $this->http_file_basename);
            return $this->http_file_basename;
          }else if($http_headers_array_input['Content-Disposition'] == "")
          {
            //need to verify the url to ensure status is 200 and to ensure then extension is related to .exe, .zip, .tar.gz etc
            $this->http_file_basename = basename($this->input_url);
            return $this->http_file_basename;
          }
        }       
    }
    
    function get_extension_file_basename($file_basename){
        
        $file_basename_pieces = explode(".", $file_basename);
        $file_basename_pieces_count = count($file_basename_pieces);
        if($file_basename_pieces_count > 0 )
        {
          $file_basename_pieces_last_piece = $file_basename_pieces_count - 1;
          $this->extension_file_basename = $file_basename_pieces[$file_basename_pieces_last_piece];
              if($this->extension_file_basename == "gz"){
                $file_basename_pieces_last_before_piece = $file_basename_pieces_count - 2;
                $this->extension_file_basename = $file_basename_pieces[$file_basename_pieces_last_before_piece] . "." . $file_basename_pieces[$file_basename_pieces_last_piece];
              }
        }else{
               $this->extension_file_basename = $file_basename_pieces[0];
             }        
        return $this->extension_file_basename;
    }
    
}

  
?>