<?php

namespace App\Services;

require_once __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../../libs/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libs/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../libs/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getUser()
    {
        return $this->userRepository->getUser();
    }
    public function register($nama, $email, $password, $k_verif)
    {
        if ($this->userRepository->findUserByEmail($email) !== null) {
            return ['error' => 'Email already exists.'];
        }

        if (!$this->userRepository->isValidPassword($password)) {
            return ['error' => 'Password does not meet complexity requirements.'];
        }

        if ($this->userRepository->containsDisallowedCharacters($email) || $this->userRepository->containsDisallowedCharacters($password)) {
            return ['error' => 'Input contains disallowed characters.'];
        }

        return $this->userRepository->add($nama, $email, $password, $k_verif, 2, null);
    }
}

// $obj = new UserService();
// echo $obj->sendVerificationEmail("wpipit35@gmail.com","123");
