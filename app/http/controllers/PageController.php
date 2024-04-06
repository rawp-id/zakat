<?php

namespace App\Http\Controllers;

use App\Services\MasjidService;
use App\Services\UserService;
use App\Utils\Api;
use App\Utils\Response;

require_once __DIR__ . '/../../../vendor/autoload.php';


class PageController
{
    function __construct()
    {
        session_start();
        ob_start(); 
    }

    public function dashboard()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            echo $token;
        } else {
            header('Location: /login');
            exit;
        }
        $type = "";
        $title = "dashboard";
        $content = __DIR__ . '/../../../views/content/dashboard.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }
    public function kodeMs()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            echo $token;
        } else {
            header('Location: /login');
            exit;
        }
        $masjid = new MasjidService;
        $masjidData = "empty";
        $kode = $_POST['kode'] ?? null;
        if (isset($_POST['cek'])) {
            $masjidData = $masjid->find($_POST['kode']);
        }
        $url = Api::getUrl("/api/user/kode");
        $response = null;
        if (isset($_POST['submit'])) {
            $data = [
                'id' => $_SESSION['id'],
                'kode' => $_POST['kode']
            ];

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ],
            ];

            $context  = stream_context_create($options);

            $response = file_get_contents($url, false, $context);

            if ($response === FALSE) {
                die('Terjadi kesalahan saat mengirim data');
            }
        }
        $msg = $response ? json_decode($response) : '';
        $type = "";
        $title = "kode-ms";
        require __DIR__ . '/../../../views/content/kode-ms.php';
    }

    public function login()
    {
        $url = Api::getUrl("/api/login");
        // $response = null;
        $msg = "";

        if (isset($_POST['submit'])) {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ],
            ];

            $context  = stream_context_create($options);

            $response = @file_get_contents($url, false, $context);

            if ($response === FALSE) {
                $error = error_get_last();
                echo "HTTP request failed! Error was: " . $error['message'];
                if (isset($http_response_header)) {
                    echo "\nResponse Header: ";
                    print_r($http_response_header);
                }
                exit;
            }

            $responseData = json_decode($response, true);
            // echo json_encode($responseData);
            if ($responseData && $responseData['status'] === true) {
                $_SESSION['token'] = $responseData['data']['token'];
                $user = new UserService;
                $dataUser = $user->getUserByEmail($_POST['email']);
                if ($dataUser['verifikasi'] != null && $dataUser['verifikasi'] != "-") {
                    $_SESSION['id'] = $dataUser['id'];
                    $_SESSION['email'] = $dataUser['email'];

                    if ($dataUser['kode_ms'] != null || $dataUser['kode_ms'] == "-") {
                        header('Location: /dashboard');
                        exit;
                    } else {
                        header('Location: /kode-masjid');
                        exit;
                    }
                } else {
                    $msg = json_decode(Response::error("Alamat Email Anda Belum Diverifikasi, <br>Cek Email Anda Untuk Verifikasi"));
                    // echo $msg;
                }
            } else {
                // Tangani gagal login
                $msg = Response::error("Gagal Login");
                echo 'Login failed. Please check your credentials.';
            }

            // if ($response === FALSE) {
            //     die('Terjadi kesalahan saat mengirim data');
            // }
        }

        $type = "auth";
        $title = "login";
        $content = __DIR__ . '/../../../views/content/login.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }

    public function register()
    {
        $type = "auth";
        $title = "register";
        $content = __DIR__ . '/../../../views/content/register.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }

    public function verifikasi()
    {
        $url = Api::getUrl("/api/verifikasi");
        $response = null;
        if (isset($_POST['submit'])) {
            $data = [
                'email' => $_POST['email'],
                'code' => $_POST['code'],
            ];

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ],
            ];

            $context  = stream_context_create($options);

            $response = file_get_contents($url, false, $context);

            if ($response === FALSE) {
                die('Terjadi kesalahan saat mengirim data');
            }
        }

        $msg = $response ? json_decode($response) : '';
        $title = "verifikasi";
        require __DIR__ . '/../../../views/content/verifikasi.php';
    }

    public function form()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            echo $token;
        } else {
            header('Location: /login');
            exit;
        }
        $type = "";
        $url = Api::getUrl("/api/zakat");
        $response = null;
        if (isset($_POST['submit'])) {
            $data = [
                'nama' => $_POST['nama'],
                'jumlah' => $_POST['jumlah'],
                'alamat' => $_POST['alamat'],
                'rincian' => isset($_POST['rincian']) ? $_POST['rincian'] : "-",
                'keterangan' => isset($_POST['keterangan']) ? $_POST['keterangan'] : "-",
                'kode_ms' => 'dm',
            ];

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ],
            ];

            $context  = stream_context_create($options);

            $response = file_get_contents($url, false, $context);

            if ($response === FALSE) {
                die('Terjadi kesalahan saat mengirim data');
            }
        }

        $msg = $response ? json_decode($response) : '';
        $title = "form";
        $content = __DIR__ . '/../../../views/content/form.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }

    public function table()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            echo $token;
        } else {
            header('Location: /login');
            exit;
        }
        $type = "";
        $apiUrl = Api::getUrl("/api/zakat");
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        $title = "table";
        $content = __DIR__ . '/../../../views/content/table.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }

    public function table_verif()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            echo $token;
        } else {
            header('Location: /login');
            exit;
        }
        $type = "";
        $url = Api::getUrl("/api/zakat/verif");
        $response = null;
        if (isset($_POST['submit'])) {
            // Data yang ingin dikirim
            $data = [
                'id' => $_POST['id']
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
            }
        }

        $msg = $response ? json_decode($response) : '';
        $apiUrl = Api::getUrl("/api/zakat");
        $respon = file_get_contents($apiUrl);
        $data = json_decode($respon, true);
        $title = "verif-zakat";
        $content = __DIR__ . '/../../../views/content/verif.php';
        require __DIR__ . '/../../../views/layout/index.php';
    }

    public function logout()
    {
        // Hapus informasi pengguna dari session
        unset($_SESSION['token']);

        // Opsional: Hancurkan seluruh session
        session_destroy();

        // Redirect ke halaman login
        header('Location: /login');
        exit();
    }
}
