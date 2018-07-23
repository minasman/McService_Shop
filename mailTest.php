<?php
$storeEmail = filter_input(INPUT_POST,'storeEmail');
$supEmail = filter_input(INPUT_POST,'supEmail');
$omEmail = filter_input(INPUT_POST,'omEmail');
$store = filter_input(INPUT_POST,'thestore');
$message = $store." was shopped!!";
//echo $message;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
    //Server settings
   	 	$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    	$mail->Host = 'localhost';  // Specify main and backup SMTP servers
    	$mail->SMTPAuth = false;                               // Enable SMTP authentication
    	$mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
    	$mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    	$mail->setFrom('daniel@dhernandezmcd.com', 'You Were Shopped!');
    	$mail->addAddress('dhernandez@staggrp.com', 'Daniel Hernandez');
		$mail->addAddress('nstagg@staggrp.com', 'Ned Stagg'); // Add a recipient
    	$mail->addAddress($supEmail);               // sup email
		if ($omEmail) {
    		$mail->addAddress($omEmail);   
		}											// om email
    	$mail->addAddress($storeEmail);               // store email

    	//Attachments
    	$mail->addAttachment("Shop.html");         // Add shopform
    	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    	//Content
    	$mail->isHTML(true);                                  // Set email format to HTML
    	$mail->Subject = $message;
    	$mail->Body    = 'Please review the shop with your team';
    	$mail->AltBody = 'Please review the shop with your team';
    	$mail->send();
		header("Location: http://dhernandezmcd.com");
		} catch (Exception $e) {
    		echo 'Message could not be sent.';
    		echo 'Mailer Error: ' . $mail->ErrorInfo;
		}



?>