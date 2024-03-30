<?php
namespace App\Http\Controller;

require_once __DIR__ . '/../../../Services/AuthService.php';
require_once __DIR__ . '/../../../utils/ResponsHandler.php';

use App\Services\AuthService;
use App\Utils\ResponseHandler;

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
            echo ResponseHandler::success(['token' => $jwt]);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo ResponseHandler::error("Login failed.");
        }
    }
}
