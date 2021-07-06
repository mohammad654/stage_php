<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require_once'/email/mailer/autoload.php';
require_once'mail/autoload.php';

// Load Composer's autoloader

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();

//Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'mohammad.ali.shikhi.55@gmail.com';                     // SMTP username
$mail->Password   = 'Mohammad.55@';                               // SMTP password
$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 465;
// Content
$mail->isHTML(true);
$mail->CharSet="UFT-8";
?>
