<?php
require_once('class.phpmailer.php');

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
$mail->CharSet="utf-8";
//$mail->Encoding = 'quoted-printable';

    //$bodyhtml1 = file_get_contents('sample-test.eml');
    $bodyhtml1 = file_get_contents('contents.html');
    $bodytext = "PHPMailer is a PHP class for sending email. It has far more funtionality compared to the regular mail() function, including attachments and inline images. It is very usefull for actions like Contactus forms, not allowing header injection and spamming. Supports SMTP.\r\n\r\n PHPMailer is a PHP class for sending email. It has far more funtionality compared to the regular mail() function, including attachments and inline images. It is very usefull for actions like Contactus forms, not allowing header injection and spamming. Supports SMTP.";
    

  //echo $bodyhtml1;
  //$mail->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");
  $mail->SetFrom('webmaster@securitywonks.net', 'webmaster swnet');
  $mail->Sender="webmaster@securitywonks.net";
  $mail->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");
  $mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");
  $mail->AddCC("venkat.con@ideabytes.com", "venkat con");
  $mail->AddCC("srinivas.katta@ideabytes.com", "Srinivas Reddy Katta");
  $mail->AddCC("gayathri.dendukuri@ideabytes.com", "Gayathri Dendukuri");
  // PHPMailer class sets Return-path automatically to "From" or "Sender":  
  
  //$mail->AddCC("raghuveer.dendukuri@gmail.com", "Raghu Veer Dendukuri");
  //$mail->AddBCC("mail1@domain.com", "Recepient 1");
  //$mail->AddAddress("gayathridec5@gmail.com", "Gayathri Dendukuri");
  //$mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");
  //$mail->AddAddress("webmaster@securitywonks.org", "webmaster sworg");  
  $mail->WordWrap = 50;                                 // set word wrap to 50 characters
  $mail->IsHTML(true);
  $mail->Subject = 'PHPMailer Test Subject via sendmail';
  $mail->Body    = "This is the HTML message body <b>in bold!</b>";
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
  //$mail->msgHTML($bodyhtml1);
 // $mail->PreSend();
 // $eml_content = $mail->GetSentMIMEMessage(); 
  $mail->AddAttachment("sample-test.eml","eml-file-content-disk.txt","8bit","message/rfc822");
  $mail->AddStringAttachment($bodyhtml1,"sample-test-html-content-on-the-fly.eml","8bit","message/rfc822");
  $mail->AddStringAttachment($bodytext,"sample-test-text-content-on-the-fly.eml","8bit","message/rfc822");
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  if (!$mail->Send()) {
     echo "Error sending: " . $mail->ErrorInfo;;
  } else {
     echo "Letter is sent";
  }

    
?>    