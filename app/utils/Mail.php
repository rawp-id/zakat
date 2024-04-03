<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// require_once __DIR__ . '/../../libs/phpmailer/src/PHPMailer.php';
// require_once __DIR__ . '/../../libs/phpmailer/src/SMTP.php';
// require_once __DIR__ . '/../../libs/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($email, $verificationCode)
{
    $mail = new PHPMailer(true);

    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'dffb502387dfa3';
        $mail->Password = 'f0d0aa80ffdf9b';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        $mail->setFrom('noreply@example.com', 'Mailer');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Email Anda';
        $mail->Body    = 'Silakan klik link ini untuk verifikasi akun Anda: <a href="http://yourdomain.com/verify.php?code=' . $verificationCode . '">Verifikasi</a>';

        $mail->send();
        return 'Pesan telah terkirim';
    } catch (Exception $e) {
        return "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
    }
}