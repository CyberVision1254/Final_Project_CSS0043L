<?php
require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';
require_once __DIR__ . '/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($toEmail, $toName, $token)
{
    $verifyLink = "http://localhost/projects/CyberVision/verify.php?token=" .
        urlencode($token) . "&email=" . urlencode($toEmail);

    $subject = "Confirm your CyberVision account";

    $message = "
    <html>
    <body>
        <p>Hi " . htmlspecialchars($toName, ENT_QUOTES, 'UTF-8') . ",</p>
        <p>Thanks for registering with CyberVision. Please confirm your email address:</p>
        <p><a href=\"" . htmlspecialchars($verifyLink, ENT_QUOTES, 'UTF-8') . "\">Verify my account</a></p>
        <p>If you didn't create this account, you can ignore this email.</p>
    </body>
    </html>
    ";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = MAIL_PORT;

        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        return $mail->send();

    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}