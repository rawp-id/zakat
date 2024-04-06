<?php

namespace App\Repositories;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Masjid;
use Database\Connection;
use SplDoublyLinkedList;

class MasjidRepository
{
    protected $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function fetchToLinkedList()
    {
        $data = new SplDoublyLinkedList();
        $result = $this->db->getDb()->query("SELECT * FROM masjid;");

        if ($result !== false) {
            while ($row = $result->fetch_assoc()) {
                $masjid = new Masjid(
                    $row['id'],
                    $row['nama'],
                    $row['kode_ms'],
                );
                $data->push($masjid);
            }
        }

        return $data;
    }

    public function get()
    {
        $linkedList = $this->fetchToLinkedList();
        $DataArr = [];

        for ($linkedList->rewind(); $linkedList->valid(); $linkedList->next()) {
            $zakat = $linkedList->current();
            $DataArr[] = method_exists($zakat, 'toArray') ? $zakat->toArray() : [];
        }

        return $DataArr;
    }

    public function getMasjidByKode($kode)
    {
        $query = "SELECT * FROM masjid WHERE kode_ms = ?;";
        $stmt = $this->db->getDb()->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $kode);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $masjid = new Masjid(
                    $row['id'],
                    $row['nama'],
                    $row['kode_ms'] != null ? $row['kode_ms'] : "",
                );
                return $masjid->toArray();
            }
            $stmt->close();
        }
        return null;
    }
}

// $obj = new MasjidRepository;
// echo json_encode($obj->getMasjidByKode("dm"));