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
                    $row['status'],
                    $row['tanggal'] != null ? $row['tanggal'] : "",
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
        $sql = "INSERT INTO `zakat` (`id`, `nama`, `jumlah`, `alamat`, `rincian`, `keterangan`, `kode_ms`, `tanggal`) VALUES (UUID(), ?, ?, ?, ?, ?, ?, NOW());";
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

        $stmt->bind_param("sisssss", $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }


    public function delete($id): bool
    {
        $sql = "DELETE FROM `zakat` WHERE `id` = ?;";
        $stmt = $this->db->getDb()->prepare($sql);

        $stmt->bind_param("s", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }

    public function acc_zakat($id)
    {
        $sql = "UPDATE `zakat` SET `status`= 1 WHERE `id`=?;";
        $stmt = $this->db->getDb()->prepare($sql);

        $stmt->bind_param("s", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result > 0;
    }
    public function getDailyZakatData()
    {
        $query = "SELECT DATE(tanggal) as tanggal, SUM(jumlah) as total_zakat FROM zakat GROUP BY DATE(tanggal) ORDER BY tanggal ASC";

        $result = $this->db->getDb()->query($query);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'tanggal' => $row['tanggal'],
                'total' => $row['total_zakat']
            ];
        }

        return $data;
    }


    public function getTotal()
    {
        $query = "SELECT SUM(jumlah) as total_zakat FROM zakat";

        $result = $this->db->getDb()->query($query);

        if ($row = $result->fetch_assoc()) {
            return $row['total_zakat'];
        } else {
            return 0; // Mengembalikan 0 jika tidak ada data
        }
    }
    public function getTotalSah()
    {
        $query = "SELECT SUM(jumlah) as total_zakat FROM zakat WHERE status=1";

        $result = $this->db->getDb()->query($query);

        if ($row = $result->fetch_assoc()) {
            return $row['total_zakat'];
        } else {
            return 0; // Mengembalikan 0 jika tidak ada data
        }
    }

    public function getTotalTdkSah()
    {
        $query = "SELECT SUM(jumlah) as total_zakat FROM zakat WHERE status=0";

        $result = $this->db->getDb()->query($query);

        if ($row = $result->fetch_assoc()) {
            return $row['total_zakat'];
        } else {
            return 0; // Mengembalikan 0 jika tidak ada data
        }
    }
}
