<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Repositories\ZakatRepository;
use App\Services\MasjidService;
use App\Services\UserService;
use App\Services\ZakatService;
use App\Utils\Api;
use App\Utils\Response;

class PageController
{
    function __construct()
    {
        session_start();
        ob_start();
    }

    private function performCurlPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return false; // Or handle error as appropriate
        }
        curl_close($ch);
        return $response;
    }

    private function performCurlGetRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return false; // Or handle error as appropriate
        }
        curl_close($ch);
        return $response;
    }


    public function dashboard()
    {
        if (!isset($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        $zakat = new ZakatRepository;
        $daily = $zakat->getDailyZakatData();
        $sah = $zakat->getTotalSah();
        $tdkSah = $zakat->getTotalTdkSah();
        $total = $zakat->getTotal();
        $type = "";
        $title = "dashboard";
        $content = __DIR__ . '/../../../views/content/dashboard.php';
        require __DIR__ . '/../../../views/layout/main.php';
    }
    public function kodeMs()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
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
            } else {
                $_SESSION['kode_ms'] = $_POST['kode'];
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
        $email = $_POST['email'] ?? null;
        if (isset($_POST['submitBtn'])) {
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
                // $error = error_get_last();
                // echo "HTTP request failed! Error was: " . $error['message'];
                // if (isset($http_response_header)) {
                //     echo "\nResponse Header: ";
                //     print_r($http_response_header);
                // }
                $msg = json_decode(Response::error("Email Dan Password Tidak Valid, <br>Cek Kembali Email Dan Password Anda"));
            } else {
                $responseData = json_decode($response, true);
                // echo json_encode($responseData);
                if ($responseData && $responseData['status'] === true) {
                    $_SESSION['token'] = $responseData['data']['token'];
                    $user = new UserService;
                    $dataUser = $user->getUserByEmail($_POST['email']);
                    if ($dataUser['verifikasi'] != null && $dataUser['verifikasi'] != "-") {
                        $_SESSION['id'] = $dataUser['id'];
                        $_SESSION['nama'] = $dataUser['nama'];
                        $_SESSION['email'] = $dataUser['email'];
                        $_SESSION['kode_ms'] = $dataUser['kode_ms'];

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
                    // echo 'Login failed. Please check your credentials.';
                }
            }

            // if ($response === FALSE) {
            //     die('Terjadi kesalahan saat mengirim data');
            // }
        }

        $type = "auth";
        $title = "login";
        $content = __DIR__ . '/../../../views/content/login.php';
        require __DIR__ . '/../../../views/layout/main.php';
    }

    public function register()
    {
        $url = Api::getUrl("/api/register");
        $response = null;
        if (isset($_POST['submitBtn'])) {
            $data = [
                'nama' => $_POST['nama'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'repassword' => $_POST['repassword'],
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
                // die('Terjadi kesalahan saat mengirim data');
                $msg = json_decode(Response::error("Email Dan Password Tidak Valid, <br>Cek Kembali Email Dan Password Anda"));
            }
        }

        $msg = $response ? json_decode($response) : '';
        $type = "auth";
        $title = "register";
        $content = __DIR__ . '/../../../views/content/register.php';
        require __DIR__ . '/../../../views/layout/main.php';
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
        } else {
            header('Location: /login');
            exit;
        }
        $type = "";
        // $url = Api::getUrl("/api/zakat");
        // $response = null;
        // if (isset($_POST['submit'])) {
        //     $data = [
        //         'nama' => $_POST['nama'],
        //         'jumlah' => $_POST['jumlah'],
        //         'alamat' => $_POST['alamat'],
        //         'rincian' => isset($_POST['rincian']) ? $_POST['rincian'] : "-",
        //         'keterangan' => isset($_POST['keterangan']) ? $_POST['keterangan'] : "-",
        //         'kode_ms' => $_SESSION['kode_ms'],
        //     ];

        //     $options = [
        //         'http' => [
        //             'header'  => "Content-Type: application/json\r\n",
        //             'method'  => 'POST',
        //             'content' => json_encode($data),
        //         ],
        //     ];

        //     $context  = stream_context_create($options);

        //     $response = file_get_contents($url, false, $context);

        //     if ($response === FALSE) {
        //         $error = error_get_last();
        //         echo "HTTP request failed! Error was: " . $error['message'];
        //         if (isset($http_response_header)) {
        //             echo "\nResponse Header: ";
        //             print_r($http_response_header);
        //         }
        //         die('Terjadi kesalahan saat mengirim data');
        //     }
        // }

        $url = Api::getUrl("/api/zakat");
        $response = null;
        if (isset($_POST['submit'])) {
            // Menangani input `rincian` dan `keterangan` yang bisa dalam bentuk string atau array
            $rincian = "-";
            if (isset($_POST['rincian'])) {
                if (is_array($_POST['rincian'])) {
                    $rincian = json_encode($_POST['rincian']);
                } else {
                    $rincian = json_encode(explode(",", $_POST['rincian']));
                }
            }

            $keterangan = "-";
            if (isset($_POST['keterangan'])) {
                if (is_array($_POST['keterangan'])) {
                    $keterangan = json_encode($_POST['keterangan']);
                } else {
                    $keterangan = json_encode(explode(",", $_POST['keterangan']));
                }
            }

            $data = [
                'nama' => $_POST['nama'],
                'jumlah' => $_POST['jumlah'],
                'alamat' => $_POST['alamat'],
                'rincian' => $rincian,
                'keterangan' => $keterangan,
                'kode_ms' => $_SESSION['kode_ms'],
            ];

            $response = $this->performCurlPostRequest($url, $data);
            if ($response === FALSE) {
                die('Terjadi kesalahan saat mengirim data');
            }
            // echo json_encode($rincian);
            // echo json_encode($keterangan);
        }

        // echo $_SESSION['kode_ms'];
        $msg = $response ? json_decode(Response::msg(true, "Menyimpan Data")) : '';
        $title = "form";
        $content = __DIR__ . '/../../../views/content/form.php';
        require __DIR__ . '/../../../views/layout/main.php';
    }

    public function table()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            header('Location: /login');
            exit;
        }

        $response = null;
        if (isset($_POST['delete'])) {
            $zakat = new ZakatService;
            $result = $zakat->delete($_POST['id']);
            if ($result) {
                $response = json_decode(Response::msg(true, "Menghapus Data"));
            } else {
                $response = json_decode(Response::msg(false, "Gagal MEnghapus Data"));
            }
        }

        $msg = $response ? $response : '';

        $type = "";
        $apiUrl = Api::getUrl("/api/zakat"); // Assuming this is your endpoint for fetching the table data
        $responseData = $this->performCurlGetRequest($apiUrl);

        if ($responseData === FALSE) {
            die('Terjadi kesalahan saat mengakses data');
        }

        $data = json_decode($responseData, true);
        $title = "table";
        $content = __DIR__ . '/../../../views/content/table.php';
        require __DIR__ . '/../../../views/layout/main.php';
    }

    public function dataZakatByMs()
    {
        $type = "";
        $apiUrl = Api::getUrl("/api/zakat");
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        $title = "data-zakat-ms";
        require __DIR__ . '/../../../views/content/data-zakat.php';
    }

    public function table_verif()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
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
                // $error = error_get_last();
                // echo "HTTP request failed! Error was: " . $error['message'];
                // if (isset($http_response_header)) {
                //     echo "\nResponse Header: ";
                //     print_r($http_response_header);
                // }
                die('Terjadi kesalahan saat mengirim data');
            } else {
                $response = json_decode(Response::msg(true, "Menyimpan Data"));
            }
        }

        if (isset($_POST['delete'])) {
            $zakat = new ZakatService;
            $result = $zakat->delete($_POST['id']);
            if ($result) {
                $response = json_decode(Response::msg(true, "Menghapus Data"));
            } else {
                $response = json_decode(Response::msg(false, "Gagal MEnghapus Data"));
            }
        }

        $msg = $response ? $response : '';
        $apiUrl = Api::getUrl("/api/zakat"); // Assuming this is your endpoint for fetching the table data
        $responseData = $this->performCurlGetRequest($apiUrl);

        if ($responseData === FALSE) {
            die('Terjadi kesalahan saat mengakses data');
        }

        $data = json_decode($responseData, true);
        $title = "verif-zakat";
        $content = __DIR__ . '/../../../views/content/verif.php';
        require __DIR__ . '/../../../views/layout/main.php';
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
