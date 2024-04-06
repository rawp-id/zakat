<?php

namespace App\Services;

require_once __DIR__ . '/../../vendor/autoload.php';

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
        if ($user !== null && ($user['password'] != "" || $user['password'] != null) && password_verify($password, $user['password'])) {
            $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

            $payload = [
                "iss" => $domain,
                "aud" => $domain,
                "iat" => time(),
                "exp" => time() + (60 * 60),
                "data" => [
                    "id" => $user['id'],
                    "email" => $user['email'],
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
    
    public function verifikasi($email, $kode)
    {
        return $this->userRepository->verifikasi($email, $kode);
    }
}
// $obj = new AuthService();
// echo $obj->authenticate("admin@admin.com", md5("Admin_123"));

// echo "<br>".md5('admin');