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

    public function add()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
    
            $id = $decoded['id'] ?? null;
            $nama = $decoded['nama'] ?? null;
            $jumlah = $decoded['jumlah'] ?? null;
            $alamat = $decoded['alamat'] ?? null;
            $rincian = $decoded['rincian'] ?? null;
            $keterangan = $decoded['keterangan'] ?? null;
            $kode_ms = $decoded['kode_ms'] ?? null;
        } else {
            $id = $_POST['id'] ?? null;
            $nama = $_POST['nama'] ?? null;
            $jumlah = $_POST['jumlah'] ?? null;
            $alamat = $_POST['alamat'] ?? null;
            $rincian = $_POST['rincian'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;
            $kode_ms = $_POST['kode_ms'] ?? null;
        }
    
        if ($id && $nama && $jumlah && $alamat && $rincian && $keterangan && $kode_ms) {
            $data = $this->ZakatService->addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Zakat added successfully']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        }
    }    

    // public function add($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    // {
    //     $Data = $this->ZakatService->addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
    // }
}

// $data = new ZakatController();
// echo $data->index();
// header('Content-Type: application/json');
