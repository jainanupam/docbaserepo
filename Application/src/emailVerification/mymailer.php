<?php
require($_SERVER['DOCUMENT_ROOT'].'emailVerification/class.phpmailer.php');
require($_SERVER['DOCUMENT_ROOT'].'emailVerification//class.smtp.php');
$mail  = new PHPMailer();
$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
$mail->IsSMTP();
$mail->SMTPAuth  = true;                 #enable SMTP authentication
$mail->SMTPSecure = "ssl";               #sets the prefix to the server
$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
$mail->Port       = 465;                 #set the SMTP port
$mail->Username   = "payamrastogi";                  #your gmail username
$mail->Password   = "deathrock";                  #Your gmail password
$mail->From       = "payamrastogi@gmail.com";                  #your gmail id
$mail->FromName   = "payam rastogi";                  #your name
$mail->Subject    = "Subject of the mail";
$mail->WordWrap   = 50;
$mail->AddAddress("payamrastogi@outlook.com","payam rastogi");
$mail->IsHTML(true); // send as HTML
$mail->MsgHTML($body);
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
?>