<?php

namespace App\Services;

require_once __DIR__ . '/../Repositories/ZakatRepository.php';

use App\Repositories\ZakatRepository;

class ZakatService
{
    protected $ZakatRepository;

    function __construct()
    {
        $this->ZakatRepository = new ZakatRepository();
    }

    public function getZakat()
    {
        return $this->ZakatRepository->getZakat();
    }
    public function addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms)
    {
        return $this->ZakatRepository->addZakat($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
    }
}
