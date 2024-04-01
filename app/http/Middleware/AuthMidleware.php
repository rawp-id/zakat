<?php
require_once __DIR__ . '/../../../libs/php-jwt/src/JWT.php';
require_once __DIR__ . '/../../../libs/php-jwt/src/Key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate() {
    // Coba mendapatkan token dari header Authorization
    $authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] : '');

    if (!$authHeader) {
        // Untuk server atau konfigurasi yang tidak menyertakan header Authorization di $_SERVER secara default
        foreach (getallheaders() as $name => $value) {
            if (strcasecmp($name, 'Authorization') == 0) {
                $authHeader = $value;
                break;
            }
        }
    }

    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];

        try {
            JWT::decode($token, new Key('123', 'HS256'));
            return true;
        } catch (\Exception $e) {
            // Log error atau handle sesuai kebutuhan
            return false;
        }
    }

    // Jika tidak ada token atau format salah
    return false;
}
