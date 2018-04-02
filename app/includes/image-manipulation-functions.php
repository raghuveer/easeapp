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
 */
/* This page contains image manipulation functions that will be used to manipulate images and save them. */

/* date function for site visitor*/
function create_thumbnail_one_image_using_cron($thumb_width, $thumb_height, $thumb_jpg_quality, $thumb_framewidth, $thumb_framecolor, $thumb_location, $thumb_saveas, $thumb_prefix, $thumb_source){
      //commercial version of easyphpthumbnailpro class http://www.mywebmymail.com/digitalshop/digitalshop.php?p=easyphpthumbnailpro.zip&sitemap=1&productdetails=5&screenwidth=1024

  include_once('easyphpthumbnail.class.php');
    // Create the thumbnail
    $thumb = new easyphpthumbnail;
    //$thumb -> Thumbsize = 300;
    if((isset($thumb_height)) && ($thumb_height != "0"))
    (
    // Set thumbsize to 200px height
    $thumb -> Thumbheight = $thumb_height;
    )
    

// Set thumbsize to 200px width
    //$thumb -> Thumbwidth = 180;
    $thumb -> Thumbwidth = $thumb_width;
   /* $thumb -> Copyrighttext = 'MYWEBMYMAIL.COM';
    $thumb -> Copyrightposition = '50% 90%';
    $thumb -> Copyrightfonttype = $dir . 'handwriting.ttf';
    $thumb -> Copyrightfontsize = 30;
    $thumb -> Copyrighttextcolor = '#FFFFFF';*/
    // Set JPG output quality 0 - 100%
    //$thumb -> Quality = 60;
    $thumb -> Quality = $thumb_jpg_quality;
    //$thumb -> Framewidth = 5;
    $thumb -> Framewidth = $thumb_framewidth;
    //$thumb -> Framecolor = '#dddeee';
    $thumb -> Framecolor = $thumb_framecolor;
    // Drop shadow around the thumbnail
    //$thumb -> Backgroundcolor = '#D0DEEE';
    //$thumb -> Shadow = true;
    // Create a square canvas
   // $thumb -> Square = true;
    // Crop the image to a square
    //$thumb -> Cropimage = array(3,0,0,0,0,0);
    $thumb -> Chmodlevel = '0644';
//$thumb -> Thumblocation = '/home/download/web/download-server.us.securitywonks.net/example/gfx/thumbs/';
$thumb -> Thumblocation = $thumb_location;
//$thumb -> Thumbsaveas = 'jpg';
$thumb -> Thumbsaveas = $thumb_saveas;
//$thumb -> Thumbprefix = 'thumb_border_';
$thumb -> Thumbprefix = $thumb_prefix;
    //$thumb -> Thumbfilename = 'mynewfilename.png';  
 /*// Output to file
        // You can add some custom changes for individual images here    
    $thumb -> Createthumb($dir . $file,'file');  */
    //$thumb -> Createthumb('gfx/image.jpg','file');
    $thumb -> Createthumb($thumb_source,'file');
    
       //to extract width and height attributes from image,
       
       //http://www.php.net/manual/en/function.getimagesize.php#102902
       //http://www.php.net/manual/en/function.getimagesize.php#103301
       //http://php.net/manual/en/function.getimagesize.php
       //useful http://www.php.net/manual/en/function.getimagesize.php#94933
       //useful http://www.php.net/manual/en/function.getimagesize.php#92451
       //http://www.php.net/manual/en/function.getimagesize.php#92248
       //useful http://www.php.net/manual/en/function.getimagesize.php#82343
        
list($width_border, $height_border, $type_border, $attr_border) = getimagesize("/home/download/web/download-server.us.securitywonks.net/example/gfx/thumbs/thumb_border_image.jpg");
echo "<img src=\"gfx/thumbs/thumb_border_image.jpg\" $attr_border alt=\"getimagesize() example\" />" . "<br>";
echo $width_border . "<br>";
echo $height_border . "<br>";
echo $type_border . "<br>";
echo $attr_border . "<br>";
$thumb_width_height = $width_border . "_" . $height_border;
      return $thumb_width_height;
}

      
?>