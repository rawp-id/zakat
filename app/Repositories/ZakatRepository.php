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

    public function add($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    {
        $sql = "INSERT INTO `zakat` (`id`, `nama`, `jumlah`, `alamat`, `rincian`, `keterangan`, `kode_ms`) VALUES (:id, :nama, :jumlah, :alamat, :rincian, :keterangan, :kode_ms);";
        $stmt = $this->db->getDb()->prepare($sql);
        $result = $stmt->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':jumlah' => $jumlah,
            ':alamat' => $alamat,
            ':rincian' => $rincian,
            ':keterangan' => $keterangan,
            ':kode_ms' => $kode_ms
        ]);

        return $result;
    }

    public function update($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    {
        $sql = "UPDATE `zakat` SET `nama`=:nama, `jumlah`=:jumlah, `alamat`=:alamat, `rincian`=:rincian, `keterangan`=:keterangan, `kode_ms`=:kode_ms WHERE `id`=:id;";
        $stmt = $this->db->getDb()->prepare($sql);

        $result = $stmt->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':jumlah' => $jumlah,
            ':alamat' => $alamat,
            ':rincian' => $rincian,
            ':keterangan' => $keterangan,
            ':kode_ms' => $kode_ms
        ]);

        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `zakat` WHERE `id` = :id;";
        $stmt = $this->db->getDb()->prepare($sql);

        $result = $stmt->execute([':id' => $id]);

        return $result;
    }
}
