<?php
/**
 * Easeapp PHP Framework - A Simple MVC based Procedural Framework in PHP 
 *
 * @package  Easeapp
 * @author   Raghu Veer Dendukuri <raghuveer.d@easeapp.org>
 * @website  http://www.easeapp.org
 * @license  The Easeapp PHP framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 * @copyright Copyright (c) 2014-2018 Raghu Veer Dendukuri, excluding any third party code / libraries, those that are copyrighted to / owned by it's Authors and / or               * Contributors and is licensed as per their Open Source License choices.
 */

$data = array('email'=>'raghuveer.dendukuri@gmail.com','password'=>'1234567890','mobile'=>'919440888799','ip_address'=>'207.7.92.145');
$data = array('email'=>'webmaster@securitywonks.org','password'=>'12345690','mobile'=>'919100765934','ip_address'=>'207.7.92.145');
//$data = array('');
//$data = "";
$data_json = json_encode($data);

$url = "https://dev-v36.easeapp.org/rest/login";
//POST to Request Body
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
if(!curl_errno($ch))
{
	$info = curl_getinfo($ch);
	echo "<pre>";
	print_r($info);
	echo "</pre>";
	if ($info['http_code'] == 200)
		$errmsg = "Request Successful";
}
else
{
	$errmsg = curl_error($ch);
}
if (isset($errmsg)) {
	echo "errmsg: " . $errmsg . "<br>";
}
curl_close($ch);


?>