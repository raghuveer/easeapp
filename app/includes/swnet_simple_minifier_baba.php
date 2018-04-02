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
//This minifier minifies css and js files. It takes list of files in alphabetical order and combines them  while minifying each file and creates combined file.

//It checks for modifications and recreates the combined file when it observes  some latest change than the combined file creation time. It will still not create latest combined file if some file is deleted from file system while it will do if some new file is added in to the file system.

    $debug_mode = "OFF";
    //base dir (a relative path to the base directory)
    $siteroot_basedir = $_SERVER['DOCUMENT_ROOT'] . "/";
    
    //javascript and css (a relative path to the base directory)
    $jsdirectory = $siteroot_basedir . "templates" . "/" . $chosen_template . "/js";
    //$jsdirectory = "js";
    $cssdirectory = $siteroot_basedir . "templates" . "/" . $chosen_template . "/css";
    //$cssdirectory = "css";
    if($debug_mode == "ON")
      {
        echo $jsdirectory . "<br>";
    echo $cssdirectory . "<br><hr>";
      }
    //use this to set Minifier On or Off
    /*commenting these variables to connect inputs from core/main-config.php in here
    $minify_javascript = "0";
    $minify_css = "0";
    */
    $minify_javascript = $minify_javascript_setting;
    $minify_css = $minify_css_setting;
    
    //files that are to be excluded in minifying process
    //$files_minify_exceptions_javascript = "";
    //$files_minify_exceptions_css = "";
    $files_minify_exceptions_javascript = "";
    $files_minify_exceptions_css = "";
    

    //cache dir
    //$javascript_cachedir = $siteroot_basedir . "templates" . "/" . $chosen_template . "/js" . "/";
    $javascript_cachedir = $siteroot_basedir . "templates" . "/" . $chosen_template . "/js" . "/";
    $css_cachedir = $siteroot_basedir . "templates" . "/" . $chosen_template . "/css" . "/";
    
    //prefix for cache files
    $cache_prefix = "sa_";
    
    //use this to set Minified and Combined js and css filenames
    $minified_combined_js_filename = $cache_prefix . "combined_localjs.js";
    $minified_combined_css_filename = $cache_prefix . "combined_localcss.css";

    $combined_minified_cached_js_file = $jsdirectory . "/" . $minified_combined_js_filename;
                  
    $combined_minified_cached_css_file = $cssdirectory . "/" . $minified_combined_css_filename;
    

   //find list of js files in the directory and return them as an array
    function list_jsfiles($jsfiledirectory) {        
         $list_js_files = glob($jsfiledirectory . "/" . "*" . "js");
        return $list_js_files;
    }
    
    //find list of css files in the directory and return them as an array
    function list_cssfiles($cssfiledirectory) {        
         $list_css_files = glob($cssfiledirectory . "/" . "*" . "css");
        return $list_css_files;
    }
    
        
    //find basename of given file path
    function find_file_basename($path) {
         $file_path_basename = pathinfo($path);
        //Determine the basename
        $file_basename = $file_path_basename['basename'];
        return $file_basename;
    }
/**
	 * Get file extension
	 *
	**/	
    function find_file_extension($path) {
         $file_type = pathinfo($path);
        //Determine the extension/type and process file accordingly
        $file_extension = $file_type['extension'];
        return $file_extension;
    }
    
    
    //js minification function
    function minify_combine_js_files($jsfiles_list_input, $files_minify_exceptions_javascript_list_input, $minified_combined_js_filename_input, $javascript_cachedir_input)
    {
        //minifying js files     
            
          //$jsfiles = list_jsfiles($jsdirectory);
          $minifiedjs = "";
          //include jsmin library file
          include("jsmin-1.1.1.php");
          foreach($jsfiles_list_input as $jsfile_list_input) {
          
              $jsfile_list_input_basename = pathinfo($jsfile_list_input);
                            
              //Determine the basename
              $basename_jsfile = $jsfile_list_input_basename['basename'];
              if(file_exists($jsfile_list_input) && (($files_minify_exceptions_javascript_list_input != "" && stristr($files_minify_exceptions_javascript_list_input, $basename_jsfile) === FALSE) || $$files_minify_exceptions_javascript_list_input == "") && $basename_jsfile != $minified_combined_js_filename_input) 
               { 
               echo $jsfile_list_input . " is processed<hr>";              
                $minifiedjs .= JSMin::minify(file_get_contents($jsfile_list_input));
                //echo $minifiedjs;
               }
          }
            
          file_put_contents($javascript_cachedir_input . $minified_combined_js_filename_input, $minifiedjs);
             
         
    
    
        return $minifiedjs;   
    }
    
    //css minification function
    function minify_combine_css_files($cssfiles_list_input, $files_minify_exceptions_css_list_input, $minified_combined_css_filename_input, $css_cachedir_input)
    {    
    
        //minifying css files     
             
          //$cssfiles = list_cssfiles($cssdirectory);
          $minifiedcss = "";
          //include cssmin library file
          //include("cssmin_v.1.0.php");
          include("cssmin-v2.0.1.0064.php");
          foreach($cssfiles_list_input as $cssfile_list_input) {
          
              $cssfile_list_input_basename = pathinfo($cssfile_list_input);
                            
              //Determine the basename
              $basename_cssfile = $cssfile_list_input_basename['basename'];
              if(isset($cssfile_list_input) && (($files_minify_exceptions_css_list_input != "" && stristr($files_minify_exceptions_css_list_input, $basename_cssfile) === FALSE) || $$files_minify_exceptions_css_list_input == "") && $basename_cssfile != $minified_combined_css_filename_input) 
               { 
                echo $cssfile_list_input . " is processed<hr>";              
                //$minifiedcss .= cssmin::minify(file_get_contents($cssfile_list_input));                
                  $minifiedcss .= CssMin::minify(file_get_contents($cssfile_list_input));
                //echo $minifiedcss;
               }
          }
            
          file_put_contents($css_cachedir_input . $minified_combined_css_filename_input, $minifiedcss);
             
         
    
    
        return $minifiedcss;   
    }
   
   $jsfiles = list_jsfiles($jsdirectory);
   $cssfiles = list_cssfiles($cssdirectory);
    if($debug_mode == "ON")
      {
        if (is_writable($cssdirectory)) {
    echo 'The ' .$cssdirectory . ' is writable' . "<br>";
} else {
    echo 'The ' .$cssdirectory . ' is not writable<hr>';
    chmod($cssdirectory, 0755);
		clearstatcache();
}
echo $javascript_cachedir . "<br>";
   clearstatcache();
if (is_writable($jsdirectory)) {
    echo 'The ' .$jsdirectory . ' is writable <br>';
} else {
    echo 'The ' .$jsdirectory . ' is not writable';
    chmod($jsdirectory, 0755);
		clearstatcache();
}
clearstatcache();
    echo "<hr><pre>";
    print_r($jsfiles);
    echo  "</pre><br><hr><pre>";
    print_r($cssfiles);
    echo  "</pre><br><hr>";
      } 
    
   
   if(!is_file($combined_minified_cached_css_file))
   { 
   $css_minification_output_scc_early = minify_combine_css_files($cssfiles, $files_minify_exceptions_css, $minified_combined_css_filename, $css_cachedir);
   }
    
   if(is_file($combined_minified_cached_css_file))
   {
      //check for last modified time and then create minified version(if there is any change in the initial set of code or else simply include the file)
      $lastmodified_minified_combined_css_filename = filemtime($combined_minified_cached_css_file);
      $cssfiles_last_modified_time = list_cssfiles($cssdirectory);
                  //print_r($cssfiles_last_modified_time);
      //$lastmodified_css = 0;
      foreach($cssfiles_last_modified_time as $cssfile_last_modified_time) {
          
          $basename_cssfile_lmtime = find_file_basename($cssfile_last_modified_time);
          if (file_exists($cssfile_last_modified_time) && (($files_minify_exceptions_css != "" && stristr($files_minify_exceptions_css, $basename_cssfile_lmtime) === FALSE) || $files_minify_exceptions_css == "") && $basename_cssfile_lmtime != $minified_combined_css_filename) 
           {
             $lastmodified_css_file = filemtime($cssfile_last_modified_time);
             if($lastmodified_css_file > $lastmodified_minified_combined_css_filename)
             {
                      if((isset($minify_css) && ctype_digit($minify_css) && $minify_css == "1"))
                        {
                         $css_minification_output_scc = minify_combine_css_files($cssfiles, $files_minify_exceptions_css, $minified_combined_css_filename, $css_cachedir);
                        }
                                                     
                                                  
                           
             }
          }
          
      }            
                
                  
                  
      
   }
   if((isset($minify_css) && ctype_digit($minify_css) && $minify_css == "1"))
     {
      /* http://stackoverflow.com/a/7169135
          //$last_modified_time = filemtime($file);
          $lastmodified_minified_combined_css_filename = filemtime($combined_minified_cached_css_file); 
          //$etag = md5_file($file);
          $etag_lastmod_minif_comb_css_filename = md5_file($combined_minified_cached_css_file);
           
          header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT"); 
          header("Etag: $etag"); 
          if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time || 
              trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) { 
              header("HTTP/1.1 304 Not Modified"); 
              exit; 
          }
          */ 
   ?>
   
   
   <link rel="stylesheet" href="<?php echo html_escaped_output($html_purified_css . $minified_combined_css_filename); ?>" type="text/css">
   
   <?php
     }
   elseif((isset($minify_css) && ctype_digit($minify_css) && $minify_css == "0"))
    {
     $cssfiles_no_minify = list_cssfiles($cssdirectory); 
     foreach($cssfiles_no_minify as $cssfile_no_minify) {
          
          $basename_cssfile_no_minify = find_file_basename($cssfile_no_minify);
          
          if($basename_cssfile_no_minify != $minified_combined_css_filename && (($files_minify_exceptions_css != "" && stristr($files_minify_exceptions_css, $basename_cssfile_no_minify) === FALSE) || $files_minify_exceptions_css == ""))
            {
            
           ?> 
          
          <link rel="stylesheet" href="<?php echo html_escaped_output($html_purified_css . $basename_cssfile_no_minify); ?>" type="text/css">
           <?php
            }
          
          
      }
      ?>
      

      <?php
    }
                        
   if(!is_file($combined_minified_cached_js_file))
   { 
   $js_minification_output_scc_early = minify_combine_js_files($jsfiles, $files_minify_exceptions_javascript, $minified_combined_js_filename, $javascript_cachedir);
   }
    
   if(is_file($combined_minified_cached_js_file))
   {
      //check for last modified time and then create minified version(if there is any change in the initial set of code or else simply include the file)
      $lastmodified_minified_combined_js_filename = filemtime($combined_minified_cached_js_file);
      $jsfiles_last_modified_time = list_jsfiles($jsdirectory);
                  //print_r($jsfiles_last_modified_time);
      //$lastmodified_js = 0;
      foreach($jsfiles_last_modified_time as $jsfile_last_modified_time) {
          
          $basename_jsfile_lmtime = find_file_basename($jsfile_last_modified_time);
          if (file_exists($jsfile_last_modified_time) && (($files_minify_exceptions_javascript != "" && stristr($files_minify_exceptions_javascript, $basename_jsfile_lmtime) === FALSE) || $files_minify_exceptions_javascript == "") && $basename_jsfile_lmtime != $minified_combined_js_filename) 
            {
             $lastmodified_js_file = filemtime($jsfile_last_modified_time);
             if($lastmodified_js_file > $lastmodified_minified_combined_js_filename)
             {
                      if((isset($minify_javascript) && ctype_digit($minify_javascript) && $minify_javascript == "1"))
                        {
                         $js_minification_output_scc = minify_combine_js_files($jsfiles, $files_minify_exceptions_javascript, $minified_combined_js_filename, $javascript_cachedir);
                        }
                                                     
                                                  
                           
             }
          }
          
      }            
                  
                  
                  
      
   }
   ?>
