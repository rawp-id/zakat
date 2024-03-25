<?php

namespace App\Http\Controller;

require_once __DIR__ . '/../../Services/ZakatService.php';

use App\Services\ZakatService;

class ZakatController
{
    protected $ZakatService;

    function __construct()
    {
        $this->ZakatService = new ZakatService();
    }
    public function index()
    {
        $data = $this->ZakatService->getZakat();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
        // return "hello";
    }
    public function helo()
    {
        $Data = $this->ZakatService->getZakat();
        header('Content-Type: application/json');
        echo "helo";
        // return "hello";
    }
}

// $data = new ZakatController();
// echo $data->index();
// header('Content-Type: application/json');
