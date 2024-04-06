<?php

namespace App\Services;

require_once __DIR__ . '/../../vendor/autoload.php';

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
            return ['message' => 'Email already exists.'];
        }

        if (!$this->userRepository->isValidPassword($password)) {
            return ['message' => 'Password does not meet complexity requirements.'];
        }

        if ($this->userRepository->containsDisallowedCharacters($email) || $this->userRepository->containsDisallowedCharacters($password)) {
            return ['message' => 'Input contains disallowed characters.'];
        }

        return $this->userRepository->add($nama, $email, $password, $k_verif, 2);
    }

    public function setKodeMs($id, $kode_ms){
        return $this->userRepository->kodeMs($id, $kode_ms);
    }
    
    public function setPassword($id, $password){
        return $this->userRepository->setPassword($id, $password);
    }

    public function getUserByEmail($email){
        return $this->userRepository->findUserByEmail($email);
    }
}

// $obj = new UserService();
// echo $obj->sendVerificationEmail("wpipit35@gmail.com","123");
