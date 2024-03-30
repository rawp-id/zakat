<?php
namespace App\Services;

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../../libs/php-jwt/src/JWT.php';
require_once __DIR__ . '/../../libs/php-jwt/src/Key.php';

use App\Repositories\UserRepository;
use Firebase\JWT\JWT;

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
        if ($user!==null && $password===$user['password']) {
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

            $jwt = JWT::encode($payload, 'R4wP_R4nD0m', 'HS256');
            return $jwt;
        } else {
            return null;
        }
    }
}
// $obj = new AuthService();
// echo $obj->authenticate("admin@admin", md5("admin"));

// echo "<br>".md5('admin');