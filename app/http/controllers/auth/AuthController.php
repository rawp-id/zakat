<?php
// AuthController.php
namespace App\Http\Controllers\Auth;

require_once __DIR__ . '/../../../../vendor/autoload.php';
// require_once '../Services/AuthService.php';
// require_once __DIR__ . '/../../../Services/GoogleAuthService.php';
// require_once __DIR__ . '/../../../Utils/Mail.php';

// use App\Services\AuthService;
use App\Services\GoogleAuthService;

class AuthController
{
    private $googleAuthService;
    // private $authService;

    public function __construct()
    {
        $this->googleAuthService = new GoogleAuthService();
        // $this->authService = new AuthService();
    }

    // Redirect ke Google OAuth page
    public function redirectToGoogle()
    {
        $authUrl = $this->googleAuthService->createAuthUrl();
        header('Location: ' . $authUrl);
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            // header('Content-Type: application/json');
            // echo $code;
            $this->googleAuthService->handleCallback($code);
        }
        // Anda bisa generate JWT di sini dan mengirimkannya ke klien
    }

    public function logout()
    {
        $this->googleAuthService->logout();
    }
}
