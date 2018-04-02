<?php
require_once('class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSendmail(); // telling the class to use SendMail transport

$body = "<p>Free Feature-rich PHP Mailer. Swift Mailer integrates into any web app written in PHP 5, offering a flexible and elegant object-oriented approach to sending emails with a multitude of features.</p><ul><li>Send emails using SMTP, sendmail, postfix or a custom Transport implementation of your own Support servers that require username & password and/or encryption.</li><li>Protect from header injection attacks without stripping request data content.</li> <li>Send MIME compliant HTML/multipart emails.</li><li> Use event-driven plugins to customize the library.</li><li> Handle large attachments and inline/embedded images with low memory use.</li></ul>";
//$body             = file_get_contents('sample.txt');
$body             = eregi_replace("[\]",'',$body);

//$mail->AddReplyTo("name@yourdomain.com","First Last");

$mail->SetFrom('webmaster@securitywonks.net', 'webmaster swnet');

$mail->AddReplyTo("webmaster@securitywonks.net","webmaster swnet");

$address = "webmaster@securitywonks.org";
$mail->AddAddress($address, "webmaster sworg");

$mail->Subject    = "PHPMailer Test Subject via Sendmail, basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

//$mail->AddAttachment("sample-test.eml");      // attachment
$mail->AddAttachment("sample-test.eml","sample-test-a.eml","quoted-printable","message/rfc822");
$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>    