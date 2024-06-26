<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Services\ZakatService;
use App\Http\Middleware\Auth;

class ZakatController
{
    protected $ZakatService;

    function __construct()
    {
        $this->ZakatService = new ZakatService();
    }

    public function index()
    {
        // if (!Auth::authenticate()) {
        //     header('HTTP/1.1 401 Unauthorized');
        //     header('Content-Type: application/json');
        //     echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        //     exit;
        // }

        $data = $this->ZakatService->getZakat();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function getDailyZakatData()
    {
        $data = $this->ZakatService->getDailyZakatData();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function add()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $nama = $decoded['nama'] ?? null;
            $jumlah = $decoded['jumlah'] ?? null;
            $alamat = $decoded['alamat'] ?? null;
            $rincian = isset($decoded['rincian']) ? $decoded['rincian'] : "-";
            $keterangan = isset($decoded['keterangan']) ? $decoded['keterangan'] : "-";
            $kode_ms = $decoded['kode_ms'] ?? null;
        } else {
            $nama = $_POST['nama'] ?? null;
            $jumlah = $_POST['jumlah'] ?? null;
            $alamat = $_POST['alamat'] ?? null;
            $rincian = isset($_POST['rincian']) ? $_POST['rincian'] : "-";
            $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : "-";
            $kode_ms = $_POST['kode_ms'] ?? null;
        }

        if ($nama && $jumlah && $alamat && $rincian && $keterangan && $kode_ms) {
            $data = $this->ZakatService->addZakat($nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Zakat added successfully']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        }
    }

    public function accZakat()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $id = $decoded['id'] ?? null;
        } else {
            $id = $_POST['id'] ?? null;
        }

        if ($id) {
            $data = $this->ZakatService->acc_zakat($id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Zakat Telah Berhasil Diverifikasi']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Gagal VErifikasi']);
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
// header('Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vemFrYXQudGVzdCIsImF1ZCI6Imh0dHA6Ly96YWthdC50ZXN0IiwiaWF0IjoxNzExODE2MjYxLCJleHAiOjE3MTE4MTk4NjEsImRhdGEiOnsiaWQiOiIxIiwiZW1haWwiOiJhZG1pbkBhZG1pbiJ9fQ.vkPNVGgjEQZ4cWJfJItMcOe3mKyCu_iu5X4dU2LObJ0');
