<?php

namespace App\Services;

require_once __DIR__ . '/../Repositories/UserRepository.php';

use App\Repositories\UserRepository;

class UserService
{
    protected $ZakatRepository;

    function __construct()
    {
        $this->ZakatRepository = new UserRepository();
    }

    public function getUser()
    {
        return $this->ZakatRepository->getUser();
    }
}
