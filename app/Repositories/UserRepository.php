<?php

namespace App\Repositories;

require_once __DIR__ . '/../../database/mysql.php';
require_once __DIR__ . '/../Models/User.php';

use Database\Connection;
use App\Model\User;
use App\Utils\Uuid;
use SplDoublyLinkedList;

class UserRepository
{
    protected $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function fetchToLinkedList()
    {
        $data = new SplDoublyLinkedList();
        $result = $this->db->getDb()->query("SELECT * FROM user;");

        if ($result !== false) {
            while ($row = $result->fetch_assoc()) {
                $user = new User(
                    $row['id'],
                    $row['nama'],
                    $row['email'],
                    $row['password'],
                    ($row['verifikasi'] != null) ? $row['verifikasi'] : "-",
                    $row['role'],
                    $row['kode_ms'],
                );
                $data->push($user);
            }
        }

        return $data;
    }


    public function getUser()
    {
        $linkedList = $this->fetchToLinkedList();
        $DataArr = [];

        for ($linkedList->rewind(); $linkedList->valid(); $linkedList->next()) {
            $zakat = $linkedList->current();
            $DataArr[] = method_exists($zakat, 'toArray') ? $zakat->toArray() : [];
        }

        return $DataArr;
    }

    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = ?;";
        $stmt = $this->db->getDb()->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $user = new User(
                    $row['id'],
                    $row['nama'],
                    $row['email'],
                    $row['password'],
                    ($row['verifikasi'] != null) ? $row['verifikasi'] : "-",
                    $row['role'],
                    $row['kode_ms']
                );
                return $user->toArray();
            }
            $stmt->close();
        }

        return null;
    }

    function isValidPassword($password)
    {
        return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/', $password);
    }

    function containsDisallowedCharacters($input)
    {
        return strpbrk($input, "\"'`") !== false;
    }



    public function add($nama, $email, $password, $k_verif, $role, $kode_ms): bool
    {
        $sql = "INSERT INTO `user` (`id`, `nama`, `email`, `password`, `kode_verifikasi`, `role`, `kode_ms`) VALUES (UUID(), ?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->getDb()->prepare($sql);

        $stmt->bind_param("ssssss", $nama, $email, $password, $k_verif, $role, $kode_ms);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }
}

// $obj = new UserRepository();
// // echo json_encode($obj->findUserByEmail('admin@admin'));
// // echo json_encode($obj->getUser());
// header('Content-Type: application/json');
