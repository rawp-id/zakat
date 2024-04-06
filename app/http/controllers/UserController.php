<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Services\UserService;

class UserController
{
    protected $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $data = $this->userService->getUser();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function setKode()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $id = $decoded['id'] ?? null;
            $kode = $decoded['kode'] ?? null;
        } else {
            $id = $_POST['id'] ?? null;
            $kode = $_POST['kode'] ?? null;
        }
        $data = $this->userService->setKodeMs($id,$kode);
        if($data){
            echo json_encode(['status' => true, 'message' => 'Berhasil Menyimpan Data']);
        }else{
            echo json_encode(['status' => false, 'message' => 'Gagal Menyimpan Data']);
        }
    }
}
