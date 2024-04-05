<?php
// AuthController.php
namespace App\Http\Controllers\Auth;

require_once __DIR__ . '/../../../../vendor/autoload.php';
// require_once '../Services/AuthService.php';
// require_once __DIR__ . '/../../../Services/GoogleAuthService.php';
// require_once __DIR__ . '/../../../Utils/Mail.php';

use App\Services\AuthService;
use App\Services\GoogleAuthService;

class AuthController
{
    private $googleAuthService;
    private $authService;

    public function __construct()
    {
        $this->googleAuthService = new GoogleAuthService();
        $this->authService = new AuthService();
    }

    public function verifikasi()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $email = $decoded['email'] ?? null;
            $code = $decoded['code'] ?? null;
        } else {
            $email = $_POST['email'] ?? null;
            $code = $_POST['code'] ?? null;
        }

        if ($email && $code) {
            $verifikasi = $this->authService->verifikasi($email, $code);
            if ($verifikasi) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Email Telah Berhasil Diverifikasi']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Email Gagal Diverifikasi']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Email Gagal Diverifikasi']);
        }
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
