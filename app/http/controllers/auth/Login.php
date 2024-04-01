<?php
namespace App\Http\Controller\Auth;

require_once __DIR__ . '/../../../Services/AuthService.php';
require_once __DIR__ . '/../../../Utils/Response.php';

use App\Services\AuthService;
use App\Utils\Response;

class LoginController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
    
            $email = $decoded['email'] ?? null;
            $password = $decoded['password'] ?? null;
        } else {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
        }

        $jwt = $this->authService->authenticate($email, md5($password));

        if ($jwt) {
            header('Content-Type: application/json');
            echo Response::success(['token' => $jwt]);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo Response::error("Login failed.");
        }
    }
}
