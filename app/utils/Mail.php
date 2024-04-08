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
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'islami.rawp.info;103.247.10.238';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@islami.rawp.info';
        $mail->Password = 'Wztmjqr66-v*';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('noreply@islami.rawp.info', 'RAWP APPS');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Email Anda';
        ob_start();
        include __DIR__ . '/../../storage/email.php';
        $emailBody = ob_get_clean();
    
        $mail->Body = $emailBody;
        $mail->send();
        return 'Pesan telah terkirim';
    } catch (Exception $e) {
        return "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
    }
}

// if(sendVerificationEmail("wpipit35@gmail.com", "code123")){
//     echo "berhasil";
// }else{
//     echo "gagal";
// }
