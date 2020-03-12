<?php
include 'PHPMailer_5.2.0/class.phpmailer.php';
require 'PHPMailer_5.2.0/class.smtp.php';
$mail = new PHPMailer;
$mail->setFrom('support@aarogyahomecare.com');
#$mail->addAddress('pritam307aec@gmail.com');
#$mail->Subject = 'Message sent by Sewa';
#$mail->Body = 'Hello! use PHPMailer to send email using PHP';
$mail->IsSMTP();
$mail->SMTPSecure='ssl';
$mail->IsHTML(true);
$mail->Host = 'mail.aarogyahomecare.com';
$mail->SMTPAuth = true;
$mail->Port = 465;

//Set your existing gmail address as user name
$mail->Username = 'support@aarogyahomecare.com';

//Set the password of your gmail address here
$mail->Password = '^_Vpa6?HoUoz';

?>
