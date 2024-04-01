<?php
// AuthController.php

require_once '../services/AuthService.php';
require_once '../services/GoogleAuthService.php';
require_once '../utils/ResponseHandler.php';

use App\Services\AuthService;
use App\Services\GoogleAuthService;

class AuthController {
    private $googleAuthService;
    private $authService;

    public function __construct() {
        $this->googleAuthService = new GoogleAuthService();
        $this->authService = new AuthService();
    }

    // Redirect ke Google OAuth page
    public function redirectToGoogle() {
        $authUrl = $this->googleAuthService->createAuthUrl();
        header('Location: ' . $authUrl);
    }

    // Handle Google callback
    public function handleGoogleCallback() {
        $this->googleAuthService->handleCallback();
        // Anda bisa generate JWT di sini dan mengirimkannya ke klien
    }
}
