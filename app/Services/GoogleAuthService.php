<?php

namespace App\Services;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Google\Service\Oauth2 as Google_Service_Oauth2;
use Firebase\JWT\Key;
use Google_Client;

class GoogleAuthService
{
    private $client;
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->client = new Google_Client();
        $this->client->setClientId('738051197222-p8j2h35hqvgqar8n39k3t7cai62un4od.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setRedirectUri('http://localhost/zakat/api/callback-google');
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.email");
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.profile");
    }

    public function createAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function handleCallback($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
        $this->client->setAccessToken($token);

        $oauth2 = new Google_Service_Oauth2($this->client);
        $userInfo = $oauth2->userinfo->get();
        // echo $userInfo->email;
        // Coba temukan user berdasarkan email terlebih dahulu
        $user = $this->userRepository->findUserByEmail($userInfo->email);

        // Jika user tidak ditemukan atau google_id tidak cocok, tambahkan user baru
        if ($user === null || $userInfo->id !== $user['google_id']) {
            $k_verif = bin2hex(random_bytes(16));
            $addResult = $this->userRepository->add_google($userInfo->id, $userInfo->name, $userInfo->email, $k_verif, 2, $userInfo->picture);

            // Asumsikan metode add mengembalikan boolean atau user baru yang ditambahkan
            if ($addResult) {
                sendVerificationEmail($userInfo->email, $k_verif); // Pastikan metode ini ada
                // Jika berhasil, ulangi pencarian user untuk mendapatkan data yang baru ditambahkan
                $user = $this->userRepository->findUserByEmail($userInfo->email);
            }
        }

        // Pada titik ini, $user harusnya bukan null jika pengguna baru berhasil ditambahkan atau sudah ada
        if ($user !== null && $userInfo->id === $user['google_id']) {
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

            $jwt = JWT::encode($payload, 'your_secret_key_here', 'HS256'); // Ganti '123' dengan kunci rahasia yang aman
            return $jwt;
        }

        return null;
    }

    public function logout()
    {
        // Cek apakah token akses tersedia
        if ($this->client->getAccessToken()) {
            // Opsi untuk mencabut token akses, membuatnya tidak valid lagi
            $this->client->revokeToken();
        }

        // Bersihkan sesi pengguna
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['access_token']); // Asumsikan Anda menyimpan token akses di sesi dengan kunci ini
        session_destroy(); // Opsi untuk menghapus semua data sesi

        // Arahkan pengguna ke halaman atau tampilkan pesan sukses log out
        header('Location: login-google'); // Ganti 'login.php' dengan halaman login atau beranda aplikasi Anda
        exit;
    }
}
