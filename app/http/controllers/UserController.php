<?php

namespace App\Http\Controller;

require_once __DIR__ . '/../../Services/UserService.php';

use App\Services\UserService;

class UserController
{
    protected $ZakatService;

    function __construct()
    {
        $this->ZakatService = new UserService();
    }

    public function index()
    {
        $data = $this->ZakatService->getUser();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
    }


}

