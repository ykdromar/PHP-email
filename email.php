<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\MMTP;

require_once "vendor/autoload.php";

//parameters from the html
$toEmail=$_POST['toEmail'];
$subject=$_POST['subject'];
$body=$_POST['message'];

$fromEmail=$_POST['fromEmail'];
$password=$_POST['password'];
// $server=$_POST['server'];



$mail = new PHPMailer(true);
//Enable SMTP debugging.
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host ="smtp.office365.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = $fromEmail;                 
$mail->Password = $password;                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port =587;                                   

$mail->From =$fromEmail;
// $mail->FromName = "Yash Kumar Dromar";

$mail->addAddress($toEmail);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $body;
// $mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo file_get_contents("sent.html");
} catch (Exception $e) {
    echo file_get_contents("failed.html");
}
?>