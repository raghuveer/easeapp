<?php
  defined('START') or die;
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or                * Contributors and is licensed as per their Open Source License choices.
 */  
   if((isset($minify_javascript) && ctype_digit($minify_javascript) && $minify_javascript == "1"))
     {
     
     
   ?>
   
   <script src="<?php echo html_escaped_output($html_purified_js . $minified_combined_js_filename); ?>" type="text/javascript"></script>
   <?php
     }
    elseif((isset($minify_javascript) && ctype_digit($minify_javascript) && $minify_javascript == "0"))
      {
     $jsfiles_no_minify = list_jsfiles($jsdirectory); 
     foreach($jsfiles_no_minify as $jsfile_no_minify) {
          
          $basename_jsfile_no_minify = find_file_basename($jsfile_no_minify);
          if($basename_jsfile_no_minify != $minified_combined_js_filename)
            {
            
            
          ?>
          
          <script src="<?php echo html_escaped_output($html_purified_js . $basename_jsfile_no_minify); ?>" type="text/javascript"></script>
          <?php
            }
          
      }
      ?>
      

      <?php
    }
?>