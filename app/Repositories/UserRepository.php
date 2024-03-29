<?php

namespace App\Repositories;

require_once __DIR__ . '/../../database/mysql.php';
require_once __DIR__ . '/../Model/User.php';

use Database\Connection;
use App\Model\User;
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

}

