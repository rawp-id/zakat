<?php

namespace App\Services;

require_once __DIR__ . '/../../libs/google-api-php-client/src/Google/Client.php';
require_once __DIR__ . '/../../libs/google-api-php-client/src/Google/Service/Oauth2.php';

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

class GoogleAuthService
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId('738051197222-p8j2h35hqvgqar8n39k3t7cai62un4od.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setRedirectUri('https://www.googleapis.com/oauth2/v1/certs');
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function createAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    // Handle Google callback
    public function handleCallback()
    {
        if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token);

            $oauth2 = new Google_Service_Oauth2($this->client);
            $userInfo = $oauth2->userinfo->get();

            // Process user info, e.g., register or login user
            // Anda perlu memproses informasi pengguna di sini
        }
    }
}
