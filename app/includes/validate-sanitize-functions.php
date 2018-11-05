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
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or              * Contributors and is licensed as per their Open Source License choices.
 */

/*function html_purified_output($purified_input_value)
{
	$config = HTMLPurifier_Config::createDefault();
	$config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
	$config->set('HTML.Doctype', 'XHTML 1.1'); // replace with your doctype

	$purifier = new HTMLPurifier($config);

	$html_purifier_applied = $purifier->purify($purified_input_value);
	$html_special_chars_applied = html_entity_decode($html_purifier_applied);
	return $html_special_chars_applied;

}*/

function byte_convert($bytes)
  {
    $symbol = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

    $exp = 0;
    $converted_value = 0;
    if( $bytes > 0 )
    {
      $exp = floor( log($bytes)/log(1024) );
      $converted_value = ( $bytes/pow(1024,floor($exp)) );
    }
    return sprintf( '%.2f '.$symbol[$exp], $converted_value );
  }

function check_field($fvalid,$fvalue)
{
  if(preg_match("/".$fvalid."/",$fvalue))
  return TRUE;
  else
  return FALSE;
}

/*
  function progress($clientp,$dltotal,$dlnow,$ultotal,$ulnow){
  echo "$clientp, $dltotal, $dlnow, $ultotal, $ulnow";
  return(0);
  }
*/

function getFileExtension($filename){
  return substr($filename, strrpos($filename, '.'));
}


//$string = 'C:\My Documents\My Name\filename.ext';
    //$string = 'http://php.net/manual/add-note.php?&redirect=http://php.net/function.basename.php';
    //$string = 'http://new.securitywonks.net/filename.exe?file=rama.zip';
   
    //echo ShowFileName($string) . "<br>";
    //echo ShowFileExtension($string) . "<br>"; 
//echo basename($string) . "<br>";
//echo getFileExtension($string);	 
//akniep at linklift dot net http://in.php.net/manual/en/function.mb-strtolower.php#105753

//the numbers in the in-line-comments display the characters' Unicode code-points (CP).
function strtolower_utf8_extended( $utf8_string )
{
    $additional_replacements    = array
        ( "ǅ"    => "ǆ"        //   453 ->   454
        , "ǈ"    => "ǉ"        //   456 ->   457
        , "ǋ"    => "ǌ"        //   459 ->   460
        , "ǲ"    => "ǳ"        //   498 ->   499
        , "Ϸ"    => "ϸ"        //  1015 ->  1016
        , "Ϲ"    => "ϲ"        //  1017 ->  1010
        , "Ϻ"    => "ϻ"        //  1018 ->  1019
        , "ᾈ"    => "ᾀ"        //  8072 ->  8064
        , "ᾉ"    => "ᾁ"        //  8073 ->  8065
        , "ᾊ"    => "ᾂ"        //  8074 ->  8066
        , "ᾋ"    => "ᾃ"        //  8075 ->  8067
        , "ᾌ"    => "ᾄ"        //  8076 ->  8068
        , "ᾍ"    => "ᾅ"        //  8077 ->  8069
        , "ᾎ"    => "ᾆ"        //  8078 ->  8070
        , "ᾏ"    => "ᾇ"        //  8079 ->  8071
        , "ᾘ"    => "ᾐ"        //  8088 ->  8080
        , "ᾙ"    => "ᾑ"        //  8089 ->  8081
        , "ᾚ"    => "ᾒ"        //  8090 ->  8082
        , "ᾛ"    => "ᾓ"        //  8091 ->  8083
        , "ᾜ"    => "ᾔ"        //  8092 ->  8084
        , "ᾝ"    => "ᾕ"        //  8093 ->  8085
        , "ᾞ"    => "ᾖ"        //  8094 ->  8086
        , "ᾟ"    => "ᾗ"        //  8095 ->  8087
        , "ᾨ"    => "ᾠ"        //  8104 ->  8096
        , "ᾩ"    => "ᾡ"        //  8105 ->  8097
        , "ᾪ"    => "ᾢ"        //  8106 ->  8098
        , "ᾫ"    => "ᾣ"        //  8107 ->  8099
        , "ᾬ"    => "ᾤ"        //  8108 ->  8100
        , "ᾭ"    => "ᾥ"        //  8109 ->  8101
        , "ᾮ"    => "ᾦ"        //  8110 ->  8102
        , "ᾯ"    => "ᾧ"        //  8111 ->  8103
        , "ᾼ"    => "ᾳ"        //  8124 ->  8115
        , "ῌ"    => "ῃ"        //  8140 ->  8131
        , "ῼ"    => "ῳ"        //  8188 ->  8179
        , "Ⅰ"    => "ⅰ"        //  8544 ->  8560
        , "Ⅱ"    => "ⅱ"        //  8545 ->  8561
        , "Ⅲ"    => "ⅲ"        //  8546 ->  8562
        , "Ⅳ"    => "ⅳ"        //  8547 ->  8563
        , "Ⅴ"    => "ⅴ"        //  8548 ->  8564
        , "Ⅵ"    => "ⅵ"        //  8549 ->  8565
        , "Ⅶ"    => "ⅶ"        //  8550 ->  8566
        , "Ⅷ"    => "ⅷ"        //  8551 ->  8567
        , "Ⅸ"    => "ⅸ"        //  8552 ->  8568
        , "Ⅹ"    => "ⅹ"        //  8553 ->  8569
        , "Ⅺ"    => "ⅺ"        //  8554 ->  8570
        , "Ⅻ"    => "ⅻ"        //  8555 ->  8571
        , "Ⅼ"    => "ⅼ"        //  8556 ->  8572
        , "Ⅽ"    => "ⅽ"        //  8557 ->  8573
        , "Ⅾ"    => "ⅾ"        //  8558 ->  8574
        , "Ⅿ"    => "ⅿ"        //  8559 ->  8575
        , "Ⓐ"    => "ⓐ"        //  9398 ->  9424
        , "Ⓑ"    => "ⓑ"        //  9399 ->  9425
        , "Ⓒ"    => "ⓒ"        //  9400 ->  9426
        , "Ⓓ"    => "ⓓ"        //  9401 ->  9427
        , "Ⓔ"    => "ⓔ"        //  9402 ->  9428
        , "Ⓕ"    => "ⓕ"        //  9403 ->  9429
        , "Ⓖ"    => "ⓖ"        //  9404 ->  9430
        , "Ⓗ"    => "ⓗ"        //  9405 ->  9431
        , "Ⓘ"    => "ⓘ"        //  9406 ->  9432
        , "Ⓙ"    => "ⓙ"        //  9407 ->  9433
        , "Ⓚ"    => "ⓚ"        //  9408 ->  9434
        , "Ⓛ"    => "ⓛ"        //  9409 ->  9435
        , "Ⓜ"    => "ⓜ"        //  9410 ->  9436
        , "Ⓝ"    => "ⓝ"        //  9411 ->  9437
        , "Ⓞ"    => "ⓞ"        //  9412 ->  9438
        , "Ⓟ"    => "ⓟ"        //  9413 ->  9439
        , "Ⓠ"    => "ⓠ"        //  9414 ->  9440
        , "Ⓡ"    => "ⓡ"        //  9415 ->  9441
        , "Ⓢ"    => "ⓢ"        //  9416 ->  9442
        , "Ⓣ"    => "ⓣ"        //  9417 ->  9443
        , "Ⓤ"    => "ⓤ"        //  9418 ->  9444
        , "Ⓥ"    => "ⓥ"        //  9419 ->  9445
        , "Ⓦ"    => "ⓦ"        //  9420 ->  9446
        , "Ⓧ"    => "ⓧ"        //  9421 ->  9447
        , "Ⓨ"    => "ⓨ"        //  9422 ->  9448
        , "Ⓩ"    => "ⓩ"        //  9423 ->  9449
        , "𐐦"    => "𐑎"        // 66598 -> 66638
        , "𐐧"    => "𐑏"        // 66599 -> 66639
        );
   
    $utf8_string    = mb_strtolower( $utf8_string, "UTF-8");
   
    $utf8_string    = strtr( $utf8_string, $additional_replacements );
   
    return $utf8_string;
} //strtolower_utf8_extended() 

function create_seo_name($normal_name)
	{
	 
		 $symbol_tobe_converted1  = str_ireplace("'", "", $normal_name);
		 $symbol_tobe_converted2  = str_ireplace("@", "", $symbol_tobe_converted1);
		 $symbol_tobe_converted3  = str_ireplace("(", "-", $symbol_tobe_converted2);
		 $symbol_tobe_converted4  = str_ireplace(")", "", $symbol_tobe_converted3);
         $symbol_tobe_converted5  = str_ireplace("&", "", $symbol_tobe_converted4);
         $symbol_tobe_converted6  = str_ireplace("  ", "-", $symbol_tobe_converted5);
         $symbol_tobe_converted7  = str_ireplace("/", "", $symbol_tobe_converted6);
         $symbol_tobe_converted8  = str_ireplace(" ", "-", $symbol_tobe_converted7);
         $symbol_tobe_converted9  = str_ireplace("+", "", $symbol_tobe_converted8);
         $symbol_tobe_converted10 = str_ireplace("#", "", $symbol_tobe_converted9);
         $symbol_tobe_converted11 = str_ireplace(",", "", $symbol_tobe_converted10);
         $symbol_tobe_converted12 = str_ireplace("---", "-", $symbol_tobe_converted11);
		 $symbol_tobe_converted13 = str_ireplace("--", "-", $symbol_tobe_converted12);
		 $symbol_tobe_converted14 = str_ireplace("!", "", $symbol_tobe_converted13);
		 $symbol_tobe_converted15 = str_ireplace("$", "", $symbol_tobe_converted14);
		 $symbol_tobe_converted16 = str_ireplace("^", "", $symbol_tobe_converted15);
		 $symbol_tobe_converted17 = str_ireplace(":", "", $symbol_tobe_converted16);
		 $symbol_tobe_converted18 = str_ireplace(";", "", $symbol_tobe_converted17);
		 $symbol_tobe_converted19 = str_ireplace("[", "-", $symbol_tobe_converted18);
		 $symbol_tobe_converted20 = str_ireplace("]", "", $symbol_tobe_converted19);
		 $symbol_tobe_converted21 = str_ireplace("{", "-", $symbol_tobe_converted20);
		 $symbol_tobe_converted22 = str_ireplace("}", "", $symbol_tobe_converted21);
		 $symbol_tobe_converted23 = str_ireplace("|", "-", $symbol_tobe_converted22);
		 $symbol_tobe_converted24 = str_ireplace("=", "-", $symbol_tobe_converted23);
		 $symbol_tobe_converted25 = str_ireplace("*", "-", $symbol_tobe_converted24);
		 $symbol_tobe_converted26 = str_ireplace("%", "-", $symbol_tobe_converted25);
		 $symbol_tobe_converted27 = str_ireplace("~", "", $symbol_tobe_converted26);
		 $symbol_tobe_converted28 = str_ireplace("`", "", $symbol_tobe_converted27);
		 $symbol_tobe_converted29 = str_ireplace(".", "", $symbol_tobe_converted28);
     $symbol_tobe_converted30 = str_ireplace("_", "-", $symbol_tobe_converted29);

	 
			return $symbol_tobe_converted30;
    }

function create_seo_name_with_dots($normal_name)
	{
	 
		 $symbol_tobe_converted1  = str_ireplace("'", "", $normal_name);
		 $symbol_tobe_converted2  = str_ireplace("@", "", $symbol_tobe_converted1);
		 $symbol_tobe_converted3  = str_ireplace("(", "-", $symbol_tobe_converted2);
		 $symbol_tobe_converted4  = str_ireplace(")", "", $symbol_tobe_converted3);
         $symbol_tobe_converted5  = str_ireplace("&", "", $symbol_tobe_converted4);
         $symbol_tobe_converted6  = str_ireplace("  ", "-", $symbol_tobe_converted5);
         $symbol_tobe_converted7  = str_ireplace("/", "", $symbol_tobe_converted6);
         $symbol_tobe_converted8  = str_ireplace(" ", "-", $symbol_tobe_converted7);
         $symbol_tobe_converted9  = str_ireplace("+", "", $symbol_tobe_converted8);
         $symbol_tobe_converted10 = str_ireplace("#", "", $symbol_tobe_converted9);
         $symbol_tobe_converted11 = str_ireplace(",", "", $symbol_tobe_converted10);
         $symbol_tobe_converted12 = str_ireplace("---", "-", $symbol_tobe_converted11);
		 $symbol_tobe_converted13 = str_ireplace("--", "-", $symbol_tobe_converted12);
		 $symbol_tobe_converted14 = str_ireplace("!", "", $symbol_tobe_converted13);
		 $symbol_tobe_converted15 = str_ireplace("$", "", $symbol_tobe_converted14);
		 $symbol_tobe_converted16 = str_ireplace("^", "", $symbol_tobe_converted15);
		 $symbol_tobe_converted17 = str_ireplace(":", "", $symbol_tobe_converted16);
		 $symbol_tobe_converted18 = str_ireplace(";", "", $symbol_tobe_converted17);
		 $symbol_tobe_converted19 = str_ireplace("[", "-", $symbol_tobe_converted18);
		 $symbol_tobe_converted20 = str_ireplace("]", "", $symbol_tobe_converted19);
		 $symbol_tobe_converted21 = str_ireplace("{", "-", $symbol_tobe_converted20);
		 $symbol_tobe_converted22 = str_ireplace("}", "", $symbol_tobe_converted21);
		 $symbol_tobe_converted23 = str_ireplace("|", "-", $symbol_tobe_converted22);
		 $symbol_tobe_converted24 = str_ireplace("=", "-", $symbol_tobe_converted23);
		 $symbol_tobe_converted25 = str_ireplace("*", "-", $symbol_tobe_converted24);
		 $symbol_tobe_converted26 = str_ireplace("%", "-", $symbol_tobe_converted25);
		 $symbol_tobe_converted27 = str_ireplace("~", "", $symbol_tobe_converted26);
		 $symbol_tobe_converted28 = str_ireplace("`", "", $symbol_tobe_converted27);

	 
			return $symbol_tobe_converted28;
    }

function ampersand_to_and($normal_name)
	{
	 
		 $symbol_tobe_converted1  = str_ireplace("&", "and", $normal_name);

	 
			return $symbol_tobe_converted1;
    }
        
function html_escaped_output($output_value)
{
	$escaped_output = htmlspecialchars($output_value, ENT_QUOTES, "UTF-8");
	
	return $escaped_output;

}

//functions written by Mr.Martin of Bulgaria
function isValidIP($ip) {
  $ip = explode('.',$ip);
  if (count($ip) != 4) return false;
  foreach ($ip as $node) {
    if (($node > 255) || ($node < 0) || !is_numeric($node))
      return false;
    }
  return true;
}
function isValidURL($url)
{
return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function create_password_hash($hashalgorithm, $password_input, $password_salt_length)
{
       	$password_salt = "";
        
       if (!$password_salt||strlen($password_salt)<$password_salt_length)
        {
            $password_salt=uniqid(rand(), TRUE);     // get unique string (length==23)
            
        }
        $password_salt_short=substr($password_salt, 0, $password_salt_length);
        $hashed_password_creation = hash($hashalgorithm, $password_salt_short.$password_input);
        $hashed_password_salt = $hashed_password_creation . ":" . $password_salt_short;
        	 
        return $hashed_password_salt;
 }

function create_csrf_nonce($hashalgorithm, $nonce_salt_length)
{
       	$nonce_salt = "";
        
       if (!$nonce_salt||strlen($nonce_salt)<$nonce_salt_length)
        {
            $nonce_salt=uniqid(rand(), TRUE);     // get unique string (length==23)
            
        }
        $nonce_salt_short=substr($nonce_salt, 0, $nonce_salt_length);
        $hashed_nonce_creation = hash($hashalgorithm, $nonce_salt_short);
        	 
        return $hashed_nonce_creation;
 }
  
function create_email_act_code($hashalgorithm, $date, $password_salt_length)
{
       	$email_act_salt = "";
        
       if (!$email_act_salt||strlen($email_act_salt)<$password_salt_length)
        {
            $email_act_salt=uniqid(rand(), TRUE);     // get unique string (length==23)
            
        }
        $email_act_salt_short=substr($email_act_salt, 0, $password_salt_length);
        $email_act_code_creation = hash($hashalgorithm, $email_act_salt_short.$date);
        $email_act_code_short = substr($email_act_code_creation, 0, $password_salt_length);
        	 
        return $email_act_code_short;
 } 
 
function encrypted_filename($actualfilename, $date, $hashalgorithm, $encfilename_salt_length, $encfilename_length)
{
       	$enc_filename_salt = "";
        
       if (!$enc_filename_salt||strlen($enc_filename_salt)<$encfilename_salt_length)
        {
            $enc_filename_salt=uniqid(rand(), TRUE);     // get unique string (length==23)
            
        }
        $enc_filename_salt_short=substr($enc_filename_salt, 0, $encfilename_salt_length);
        $hashed_enc_filename_creation = hash($hashalgorithm, $enc_filename_salt_short.$actualfilename.$date);
        $hashed_enc_filename_short=substr($hashed_enc_filename_creation, 0, $encfilename_length);
        	 
        return $hashed_enc_filename_short;
 }

function download_link_hash($actualfilename, $date, $hashalgorithm, $encfilename_salt_length, $encfilename_length)
{
       	$enc_filename_salt = "";
        
       if (!$enc_filename_salt||strlen($enc_filename_salt)<$encfilename_salt_length)
        {
            $enc_filename_salt=uniqid(rand(), TRUE);     // get unique string (length==23)
            
        }
        $enc_filename_salt_short=substr($enc_filename_salt, 0, $encfilename_salt_length);
        $hashed_enc_filename_creation = hash($hashalgorithm, $enc_filename_salt_short.$actualfilename.$date);
        $hashed_enc_filename_short=substr($hashed_enc_filename_creation, 0, $encfilename_length);
        	 
        return $hashed_enc_filename_short;
 }

 //Sabrina http://in1.php.net/manual/en/function.in-array.php#101132
 function in_arrayi_for($needle, $haystack)
{
    for($h = 0 ; $h < count($haystack) ; $h++)
    {
        $haystack[$h] = strtolower($haystack[$h]);
    }
    return in_array(strtolower($needle),$haystack);
}
//Kelvin J http://in1.php.net/manual/en/function.in-array.php#89256
    function in_arrayi($needle, $haystack) {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
//soxred93 at gmail dot com http://in1.php.net/manual/en/function.in-array.php#88554
    function in_arrayi_foreach( $needle, $haystack ) {
        $found = false;
        foreach( $haystack as $value ) {
            if( strtolower( $value ) == strtolower( $needle ) ) {
                $found = true;
            }
        }   
        return $found;
    }
//robin at robinnixon dot com http://in1.php.net/manual/en/function.in-array.php#92460 
//This function is five times faster than in_array(). It uses a binary search and should be able to be used as a direct replacement:     
    function fast_in_array($elem, $array)
{
   $top = sizeof($array) -1;
   $bot = 0;

   while($top >= $bot)
   {
      $p = floor(($top + $bot) / 2);
      if ($array[$p] < $elem) $bot = $p + 1;
      elseif ($array[$p] > $elem) $top = $p - 1;
      else return TRUE;
   }
    
   return FALSE;
}  

//ratings images function
function show_ratings_image($average_rating_summary_count)
{
       	
        
       if ($average_rating_summary_count == "0")
        {
            $ratings_image_filename = "stars0.png";
            
        }
        elseif ($average_rating_summary_count == "0.5")
        {
            $ratings_image_filename = "stars0.5.png";
            
        }
        elseif ($average_rating_summary_count == "1")
        {
            $ratings_image_filename = "stars1.png";
            
        }
        elseif ($average_rating_summary_count == "1.5")
        {
            $ratings_image_filename = "stars1.5.png";
            
        }
        elseif ($average_rating_summary_count == "2")
        {
            $ratings_image_filename = "stars2.png";
            
        }
        elseif ($average_rating_summary_count == "2.5")
        {
            $ratings_image_filename = "stars2.5.png";
            
        }
        elseif ($average_rating_summary_count == "3")
        {
            $ratings_image_filename = "stars3.png";
            
        }
        elseif ($average_rating_summary_count == "3.5")
        {
            $ratings_image_filename = "stars3.5.png";
            
        }
        elseif ($average_rating_summary_count == "4")
        {
            $ratings_image_filename = "stars4.png";
            
        }
        elseif ($average_rating_summary_count == "4.5")
        {
            $ratings_image_filename = "stars4.5.png";
            
        }
        elseif ($average_rating_summary_count == "5")
        {
            $ratings_image_filename = "stars5.png";
            
        }
        
        return $ratings_image_filename;
 }
 
 //company website verification file related function
    function comp_site_verify_file_create($company_website_verify_file_dir_input, $filename_prefix_input, $generated_site_verify_string_input, $verification_file_content_prefix_input)
    {
         $verification_comp_site_filename = $filename_prefix_input . $generated_site_verify_string_input . ".html";
 //echo $verification_comp_site_filename . "<br>";
 
 //contents of file
 //google-site-verification: google8f50de2f00595417.html
 
 $contents_of_verify_filename = $verification_file_content_prefix_input;
 //echo $contents_of_verify_filename . "<br>";
 $contents_of_verify_filename .= $verification_comp_site_filename;
 //echo $contents_of_verify_filename . "<br>";
 file_put_contents($company_website_verify_file_dir_input . $verification_comp_site_filename, $contents_of_verify_filename);   
         
    
    
        return $contents_of_verify_filename;   
    }
    
    //curl based http header check code
    function curl_http_header_check($url_input, $useragent_input)
    {
        $ch_m_file_header_check = curl_init($url_input);
            		   
                  curl_setopt($ch_m_file_header_check, CURLOPT_HEADER, 1);    
                  curl_setopt($ch_m_file_header_check, CURLOPT_NOBODY, 1);    
                  //curl_setopt($ch_m_file_header_check, CURLOPT_USERAGENT, $userAgent_m);
                  curl_setopt($ch_m_file_header_check, CURLOPT_USERAGENT, $useragent_input);
                  curl_setopt($ch_m_file_header_check, CURLOPT_FOLLOWLOCATION, true);
            	  curl_setopt($ch_m_file_header_check, CURLOPT_MAXREDIRS, 10);
            	  curl_setopt($ch_m_file_header_check, CURLOPT_AUTOREFERER, true);
            	  curl_setopt($ch_m_file_header_check, CURLOPT_RETURNTRANSFER, 1);
            	  curl_setopt($ch_m_file_header_check,CURLOPT_CONNECTTIMEOUT,60);
            	  curl_setopt($ch_m_file_header_check, CURLOPT_FAILONERROR, 1);    
                  $execute_m_file = curl_exec($ch_m_file_header_check);
            
             
             
            	
            	
            	if(!curl_errno($ch_m_file_header_check))
            	{
            		
            		 $status_m_file =  curl_getinfo($ch_m_file_header_check, CURLINFO_HTTP_CODE);
            		$bytes_m_file = curl_getinfo($ch_m_file_header_check, CURLINFO_CONTENT_LENGTH_DOWNLOAD);		
            		$url1_file_size_m = byte_convert($bytes_m_file);
            		$average_download_speed1 = curl_getinfo($ch_m_file_header_check, CURLINFO_SPEED_DOWNLOAD);
            		$average_download_speed_converted1 = byte_convert($average_download_speed1);
            		$total_time = curl_getinfo($ch_m_file_header_check, CURLINFO_TOTAL_TIME);
            		
            				
            	}
            	
            
            	/* if ( $status_m_file == '200')
            	 
            	{
            		 echo "The html file is in place and the company url succeeded to stay verified";
            
             }*/ 
        clearstatcache();
	
    curl_close($ch_m_file_header_check);
        return $status_m_file;   
    }
    
    //curl based http page content extractor code
    function curl_http_page_content_extractor($url_input, $useragent_input)
    {
        // create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url_input);
curl_setopt($ch, CURLOPT_HEADER, 0);
                  curl_setopt($ch, CURLOPT_USERAGENT, $useragent_input);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            	  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            	  curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            	  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
            	  curl_setopt($ch, CURLOPT_FAILONERROR, 1);

// grab URL and pass it to the browser
$execute_m_file1 = curl_exec($ch);

if(!curl_errno($ch_m_file_header_check))
            	{
            		
            		 $status_m_file =  curl_getinfo($ch, CURLINFO_HTTP_CODE);
            		$bytes_m_file = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);		
                
            		$url1_file_size_m = byte_convert($bytes_m_file);
            		$average_download_speed1 = curl_getinfo($ch, CURLINFO_SPEED_DOWNLOAD);
            		$average_download_speed_converted1 = byte_convert($average_download_speed1);
            		$total_time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
            		
            				
            	} 
        clearstatcache();
	
    curl_close($ch);
        return $execute_m_file1;   
    }
    
      	              
/* mailto tag related email obfuscation function by http://www.melug-central.org/~ken/php/
// which is based on asp function of John haller http://johnhaller.com/useful-stuff/obfuscate-mailto/code-php */
function createMailto($strEmail){
  $strNewAddress = '';
  for($intCounter = 0; $intCounter < strlen($strEmail); $intCounter++){
    $strNewAddress .= "&#" . ord(substr($strEmail,$intCounter,1)) . ";";
  }
  $arrEmail = explode("&#64;", $strNewAddress);
  $strTag = "<script language="."Javascript"." type="."text/javascript".">\n";
  $strTag .= "<!--\n";
  $strTag .= "document.write('<a href=\"mai');\n";
  $strTag .= "document.write('lto');\n";
  $strTag .= "document.write(':" . $arrEmail[0] . "');\n";
  $strTag .= "document.write('@');\n";
  $strTag .= "document.write('" . $arrEmail[1] . "\">');\n";
  $strTag .= "document.write('<i class=\"fa fa-envelope-o\"></i> ');\n"; // added a template based email image using css, <i class="fa fa-envelope-o"></i> 
  $strTag .= "document.write('" . $arrEmail[0] . "');\n";
  $strTag .= "document.write('@');\n";
  $strTag .= "document.write('" . $arrEmail[1] . "<\/a>');\n";
  $strTag .= "// -->\n";
  $strTag .= "</script><noscript>" . $arrEmail[0] . " at \n";
  $strTag .= str_replace("&#46;"," dot ",$arrEmail[1]) . "</noscript>";
  return $strTag;
}


/*  hexadecimal color code validation using Regex that works with 3 to 6 characters with # as prefix in both scenarios
 *  http://stackoverflow.com/questions/12837942/regex-for-matching-css-hex-colors
 *  http://stackoverflow.com/a/12837990
 * 
 *  Alternative 6 character length regex https://code.hyperspatial.com/all-code/php-code/verify-hex-color-string/
 */
function hexadecimal_color_code_validate($hex_color_code) {
	//Check for a hex color string '#c1c2b4' and / or '#fff'
	if(preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $hex_color_code)) {
	  //Verified hex color
	  return true;
	} else {
	  //color code is invalid!!!
	  return false;
	}	
} 

/*  Random Number Generation for both PHP5 and PHP7 (cryptographically secure) between given min and max inputs
 *  This uses version comparision function by CHao http://php.net/manual/en/function.phpversion.php#112131
 *
 */  
function of_random_number_int_min_max_inputs($min_number_input, $max_number_input) {
	//Checks the version of php and choose a random number generator based on php version
        if (version_compare(phpversion(), '7.0.0', '<')) {
          // php version is 5.0 or above but less than PHP v7
          $generated_random_number = mt_rand($min_number_input, $max_number_input);
        } elseif (version_compare(phpversion(), '7.0.0', '>=')) {
          // php version is 7.0 or above
          $generated_random_number = random_int($min_number_input, $max_number_input);
        }
        return $generated_random_number;	
}             
?>
