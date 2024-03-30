<?php
require_once __DIR__ . '/../../../libs/php-jwt/src/JWT.php';
require_once __DIR__ . '/../../../libs/php-jwt/src/Key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate()
{
    // $headers = apache_request_headers();
    // $token = $headers['Authorization'] ?? '';
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1]; // Ini hanya token tanpa 'Bearer '
        echo $token;
        try {
            $decoded = JWT::decode($token, new Key('R4wP_R4nD0m', 'HS256'));
            return true;
        } catch (\Exception $e) {
            // echo $e;
            return false;
        }
    }
}
