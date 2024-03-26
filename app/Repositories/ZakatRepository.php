<?php

namespace App\Repositories;

require_once __DIR__ . '/../../database/mysql.php';
require_once __DIR__ . '/../Model/Zakat.php';

use Database\Connection;
use App\Model\Zakat;
use SplDoublyLinkedList;

class ZakatRepository
{
    protected $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function fetchToLinkedList()
    {
        $data = new SplDoublyLinkedList();
        $result = $this->db->getDb()->query("SELECT * FROM zakat;");

        if ($result !== false) {
            while ($row = $result->fetch_assoc()) {
                $zakat = new Zakat(
                    $row['id'],
                    $row['nama'],
                    $row['jumlah'],
                    $row['alamat'],
                    ($row['rincian'] != null) ? $row['rincian'] : "-",
                    ($row['keterangan'] != null) ? $row['keterangan'] : "-",
                    $row['kode_ms'],
                );
                $data->push($zakat);
            }
        }

        return $data;
    }


    public function getZakat()
    {
        $linkedList = $this->fetchToLinkedList();
        $DataArr = [];

        for ($linkedList->rewind(); $linkedList->valid(); $linkedList->next()) {
            $zakat = $linkedList->current();
            $DataArr[] = method_exists($zakat, 'toArray') ? $zakat->toArray() : [];
        }

        return $DataArr;
    }

    public function addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    {
        $result = $this->db->getDb()->query("INSERT INTO `zakat` (`id`, `nama`, `jumlah`, `alamat`, `rincian`, `keterangan`, `kode_ms`) VALUES ($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);");
        if($result>0){
            return true;
        }
        return false;
    }
}
