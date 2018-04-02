<?php
require_once('class.phpmailer.php');

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
$bodyHtml = "<html><head></head>";
	
		
    $bodyhtml1 = file_get_contents('sample-test.eml');
    
try {
//echo $bodyhtml1;
  $mail->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");
  $mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");
  $mail->AddAddress("gayathridec5@gmail.com", "Gayathri Dendukuri");
  //$mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");
  //$mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");  
  $mail->SetFrom('webmaster@securitywonks.net', 'webmaster swnet');
  $mail->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");
  $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
  $mail->msgHTML($bodyhtml1);
 // $mail->PreSend();
 // $eml_content = $mail->GetSentMIMEMessage(); 
  //$mail->AddAttachment("sample-test.eml","sample-test-a.eml","quoted-printable","message/rfc822");
  $mail->AddStringAttachment($bodyhtml1,"sample-test-a.eml","quoted-printable","message/rfc822");
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Message Sent OK<p></p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
    
?>    