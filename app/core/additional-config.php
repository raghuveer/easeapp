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
?>
<script type="text/javascript" >

  var site_url_project_main = "<?php echo html_escaped_output($site_url_project_main); ?>";

</script> 
<?php
$html_snippets_directory_path = "static-content/";

if ($page_filename == "static-content-page.php") {
 
 $page_content_html_snip_path = $site_url_project_main . $html_snippets_directory_path . $routing_eng_var_2 . "-" . $routing_eng_var_3 . "-content.json";
 
} elseif ($page_filename == "chapter-static-content-page.php") {
  
  $page_content_html_snip_path = $site_url_project_main . $html_snippets_directory_path . $routing_eng_var_2 . "-" .$routing_eng_var_4 . "-" . $routing_eng_var_5 . "-content.json";
  
}

//$page_content_html_snip_path = $site_url_project_main . $html_snippets_directory_path . $routing_eng_var_2 . "-content.json";
//$page_content_html_snip_rel_path = $html_snippets_directory_path . $routing_eng_var_2 . "-content.json";

//json file storage paths for article page
$article_directory_path = "article/";
if ($page_filename == "article-page.php") {
 
 $article_html_snip_path = $site_url_project_main . $article_directory_path . $routing_eng_var_2 . "-content.json";
 
} elseif ($page_filename == "chapter-article-page.php") {
  
  $article_html_snip_path = $site_url_project_main . $article_directory_path . $routing_eng_var_2 . "-" .$routing_eng_var_4."-content.json";
  
}

//$article_html_snip_path = $site_url_project_main . $article_directory_path . $routing_eng_var_2 . "-content.json";
//$article_html_snip_rel_path = $article_directory_path . $routing_eng_var_2 . "-content.json";


?>
