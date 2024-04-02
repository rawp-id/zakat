<?php
namespace App\Http\Middleware;
require_once __DIR__ . '/../../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    static function authenticate()
    {
        $authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] : '');

        if (!$authHeader) {
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
                return false;
            }
        }

        return false;
    }
}
