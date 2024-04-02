<?php

namespace App\Repositories;

require_once __DIR__ . '/../../vendor/autoload.php';

use Database\Connection;
use App\Models\Zakat;
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

    // public function get()
    // {
    //     $data = [];
    //     $result = $this->db->getDb()->query("SELECT * FROM zakat;");

    //     if ($result !== false) {
    //         while ($row = $result->fetch_assoc()) {
    //             $zakat = new Zakat(
    //                 $row['id'],
    //                 $row['nama'],
    //                 $row['jumlah'],
    //                 $row['alamat'],
    //                 ($row['rincian'] != null) ? $row['rincian'] : "-",
    //                 ($row['keterangan'] != null) ? $row['keterangan'] : "-",
    //                 $row['kode_ms'],
    //             );
    //             $data[]=$zakat->toArray();;
    //         }
    //     }

    //     return $data;
    // }


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

    public function add($nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms): bool
    {
        $sql = "INSERT INTO `zakat` (`id`, `nama`, `jumlah`, `alamat`, `rincian`, `keterangan`, `kode_ms`) VALUES (UUID(), ?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->getDb()->prepare($sql);
    
        $stmt->bind_param("sissss", $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
    
        $result = $stmt->execute();
    
        $stmt->close();
    
        return $result > 0;
    }

    public function update($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms): bool
    {
        $sql = "UPDATE `zakat` SET `nama`=?, `jumlah`=?, `alamat`=?, `rincian`=?, `keterangan`=?, `kode_ms`=? WHERE `id`=?;";
        $stmt = $this->db->getDb()->prepare($sql);

        $stmt->bind_param("sissssi", $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }


    public function delete($id): bool
    {
        $sql = "DELETE FROM `zakat` WHERE `id` = ?;";
        $stmt = $this->db->getDb()->prepare($sql);

        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }
}
