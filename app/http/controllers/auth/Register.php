<?php
namespace App\Http\Controller;

require_once __DIR__ . '/../../../Services/AuthService.php';
require_once __DIR__ . '/../../../Utils/ResponseHandler.php';
require_once __DIR__ . '/../../../Services/UserService.php';

use App\Services\AuthService;
use App\Services\UserService;
use App\Utils\ResponseHandler;

class RegisterController
{
    private $authService;
    private $userService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->userService = new UserService();
    }

    public function register()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
    
            $nama = $decoded['nama'] ?? null;
            $email = $decoded['email'] ?? null;
            $password = $decoded['password'] ?? null;
        } else {
            $nama = $_POST['nama'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
        }

        $k_verif = bin2hex(random_bytes(16));

        $result = $this->userService->register($nama, $email, $password, $k_verif);

        if (isset($result['success'])) {
            $this->authService->sendVerificationEmail($email, $k_verif);
            header('Content-Type: application/json');
            echo ResponseHandler::success(['message' => 'User registered successfully. Verification email sent.']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo ResponseHandler::error($result['error'] ?? 'Registration failed.');
        }
    }
}
