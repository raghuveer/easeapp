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
  $mail->addCustomHeader("X-Priority: 3"); 
  $mail->addCustomHeader("X-Mailer: PHPMailer 5.2.7 (https://github.com/PHPMailer/PHPMailer/) info modified");
  $mail->ConfirmReadingTo = "webmaster@securitywonks.net";
  /*Message-ID:	<20f951705c0d3bd7a9dba10dbba7871c@www.grailit.com>
  X-Priority:	3
  X-Mailer:	PHPMailer 5.2.7 (https://github.com/PHPMailer/PHPMailer/)*/
        $mail_attach = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
        $mail_attach->CharSet="utf-8";
        $mail_attach->SetFrom('webmaster@securitywonks.net', 'webmaster swnet');
        $mail_attach->Sender="webmaster@securitywonks.net";
        $mail_attach->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");
        $mail_attach->AddAddress("webmaster@securitywonks.org", "webmaster sworg");
        $mail_attach->AddCC("venkat.con@ideabytes.com", "venkat con");
        $mail_attach->AddCC("srinivas.katta@ideabytes.com", "Srinivas Reddy Katta");
        $mail_attach->AddCC("gayathri.dendukuri@ideabytes.com", "Gayathri Dendukuri");
        // PHPMailer class sets Return-path automatically to "From" or "Sender":  
         
        $mail_attach->WordWrap = 50;                                 // set word wrap to 50 characters
        $mail_attach->IsHTML(true);
        $mail_attach->Subject = 'email message that will be attached';
        $mail_attach->Body    = "<p>This is the HTML message body <i>in italic!</i>. PHPMailer is a PHP class for PHP (www.php.net) that provides a package of functions to send email. The two primary features are sending HTML Email and e-mails with attachments. <strong>PHPMailer supports nearly all possiblities to send email: mail(), Sendmail, qmail & direct to SMTP server. You can use any feature of SMTP-based e-mail, multiple recepients via to, CC, BCC, etc. In short: PHPMailer is an efficient way to send e-mail within PHP.\r\n</strong></p><br><br>

<p>As you may know, it is simply to send mails with the PHP mail() function. So why use PHPMailer? Isn't it slower? Yes that's true, but PHPMailer makes it easy to send e-mail, makes it possible to attach files, send HTML e-mail, etc. With PHPMailer you can even use your own SMTP server and avoid Sendmail routines used by the mail() function on Unix platforms.</p><br><br>

<p>This tutorial explains how to implement the class into your script or website and how to build an e-mail application. If you just want to send simple e-mail and you have no problems with the mail() function, it's suggested that you continue to use mail(), instead of this class. </p><br><br>";
        $mail_attach->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        $mail_attach->PreSend();
        $eml_content = $mail_attach->GetSentMIMEMessage(); 
  //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
  //$mail->msgHTML($bodyhtml1);
 // $mail->PreSend();
 // $eml_content = $mail->GetSentMIMEMessage(); 
  $mail->AddAttachment("sample-test.eml","eml-file-content-disk.txt","8bit","message/rfc822");
  $mail->AddStringAttachment($eml_content,"sample-test-html-content-on-the-fly.eml","8bit","message/rfc822");
  $mail->AddStringAttachment($eml_content,"sample-test-html-content-on-the-fly.eml2","8bit","message/rfc822");
  $mail->AddStringAttachment($eml_content,"sample-test-html-content-on-the-fly.eml3","8bit","message/rfc822");
  $mail->AddStringAttachment($eml_content,"sample-test-html-content-on-the-fly.eml4","8bit","message/rfc822");
  $mail->AddStringAttachment($eml_content,"sample-test-html-content-on-the-fly.eml5","8bit","message/rfc822");
  $mail->AddStringAttachment($bodytext,"sample-test-text-content-on-the-fly.eml","8bit","message/rfc822");
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  if (!$mail->Send()) {
     echo "Error sending: " . $mail->ErrorInfo;;
  } else {
     echo "Letter is sent";
  }

    
?>    