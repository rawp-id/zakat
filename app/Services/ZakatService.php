<?php

namespace App\Services;


use App\Repositories\ZakatRepository;

class ZakatService
{

    protected $ZakatRepository;


    public function __construct()
    {
        $this->ZakatRepository = new ZakatRepository();
    }


    public function getZakat(): array
    {
        return $this->ZakatRepository->get();
    }

    public function addZakat(string $nama, $jumlah, string $alamat, ?string $rincian, ?string $keterangan, string $kode_ms): bool
    {
        try {
            return $this->ZakatRepository->add($nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function acc_zakat($id){
        try {
            return $this->ZakatRepository->acc_zakat($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
