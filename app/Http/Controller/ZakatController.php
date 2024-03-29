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
    }

    public function add($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    {
        $Data = $this->ZakatService->addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
    }
}

// $data = new ZakatController();
// echo $data->index();
// header('Content-Type: application/json');
