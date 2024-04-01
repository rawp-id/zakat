<?php

namespace App\Services;

require_once __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../../libs/php-jwt/src/JWT.php';
require_once __DIR__ . '/../../libs/php-jwt/src/Key.php';
require_once __DIR__ . '/../../libs/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libs/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../libs/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticate($email, $password)
    {
        $user = $this->userRepository->findUserByEmail($email);
        if ($user !== null && $password === $user['password']) {
            $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

            $payload = [
                "iss" => $domain,
                "aud" => $domain,
                "iat" => time(),
                "exp" => time() + (60 * 60),
                "data" => [
                    "id" => $user['id'],
                    "email" => $user['email']
                ]
            ];

            $jwt = JWT::encode($payload, '123', 'HS256');
            return $jwt;
        } else {
            return null;
        }
    }
    
    public function verifyJWT($token)
    {
        try {
            $decoded = JWT::decode($token, new Key('123', 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function sendVerificationEmail($email, $verificationCode)
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
}
// $obj = new AuthService();
// echo $obj->authenticate("admin@admin", md5("admin"));

// echo "<br>".md5('admin');