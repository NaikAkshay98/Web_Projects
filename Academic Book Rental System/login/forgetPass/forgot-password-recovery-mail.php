<?php
if(!class_exists('PHPMailer')) {
    require('phpmailer/src/PHPMailer.php');
	require('phpmailer/src/SMTP.php');
	require("phpmailer/src/Exception.php");
}

require_once("mail_configuration.php");

//$mail = new PHPMailer();
$mail = new PHPMailer\PHPMailer\PHPMailer();
$emailBody = "<div>" . $user["name"] . ",<br><br><p>Click this link to recover your password<br><a href='" . PROJECT_HOME . "reset_password.php?name=" . $user["name"] . "'>" . PROJECT_HOME . "reset_password.php?name=" . $user["name"] . "</a><br><br></p>Regards,<br> Admin.</div>";

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "Bookstore400095@gmail.com";
$mail->Password = "Bookstore@11";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";

$mail->SetFrom("Bookstore400095@gmail.com", "Mr.Book");
$mail->AddReplyTo("Bookstore400095@gmail.com", "Mr.Book");
$mail->ReturnPath="Bookstore400095@gmail.com";	
$mail->AddAddress($user["email"]);
$mail->Subject = "Forgot Password Recovery";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	$error_message = '<h6 class="text-dark font-italic font-weight-bold">Problem in Sending Password Recovery Email</h6>';
} else {
	$success_message = '<h6 class="text-dark font-italic font-weight-bold">Please check your email to reset password</h6>';
}

?>
