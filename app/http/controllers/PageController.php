<?php

namespace App\Http\Controllers;

use App\Utils\Api;

require_once __DIR__ . '/../../../vendor/autoload.php';


class PageController
{
    function __construct()
    {
        //
    }

    public function dashboard()
    {
        $title = "dashboard";
        $content = __DIR__ . '/../../../views/content/dashboard.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }
    public function form()
    {
        $url = Api::getUrl("/api/zakat"); // Ganti dengan URL API kamu
        $response = null;
        if(isset($_POST['submit'])){
        // Data yang ingin dikirim
        $data = [
            'nama' => $_POST['nama'],
            'jumlah' => $_POST['jumlah'],
            'alamat' => $_POST['alamat'],
            'rincian' => explode(", ",$_POST['rincian']),
            'keterangan' => explode(", ",$_POST['keterangan']),
            'kode_ms' => 'dm',
        ];

        // Konfigurasi opsi untuk HTTP POST
        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data), // Encode array data ke JSON
            ],
        ];

        // Buat context stream dengan opsi yang telah didefinisikan
        $context  = stream_context_create($options);

        // Gunakan file_get_contents() untuk melakukan request dan menangkap responsenya
        $response = file_get_contents($url, false, $context);

        // Periksa apakah request berhasil
        if ($response === FALSE) {
            die('Terjadi kesalahan saat mengirim data');
        }}

        $msg = $response;
        $title = "form";
        $content = __DIR__ . '/../../../views/content/form.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }
    public function table()
    {
        $apiUrl = Api::getUrl("/api/zakat");
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        $title = "table";
        $content = __DIR__ . '/../../../views/content/table.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }
}
