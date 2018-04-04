<?php
  defined('START') or die;
?> 
<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
  <!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if IE 9 ]><html class="ie ie9" lang="en"> 
  <![endif]-->

<!--[if (gte IE 10)|!(IE)]&gt;
<!-->
<html lang="en">

  <!--<![endif]-->
  <head>
<!--Clickjacking prevention-->
<style id="antiClickjack">body{display:none !important;}</style>
<script type="text/javascript">
   if (self === top) {
       var antiClickjack = document.getElementById("antiClickjack");
       antiClickjack.parentNode.removeChild(antiClickjack);
   } else {
       top.location = self.location;
   }
</script>
<!--Clickjacking prevention-->
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" sizes="57x57" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo html_escaped_output($site_url_project_main); ?>apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo html_escaped_output($site_url_project_main); ?>android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo html_escaped_output($site_url_project_main); ?>favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo html_escaped_output($site_url_project_main); ?>favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo html_escaped_output($site_url_project_main); ?>favicon-16x16.png">
<link rel="manifest" href="<?php echo html_escaped_output($site_url_project_main); ?>manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo html_escaped_output($site_url_project_main); ?>ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">



</head>

