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

    public function getTotal()
    {
        return $this->ZakatRepository->getTotal();
    }

    public function getTotalZakatSah()
    {
        return $this->ZakatRepository->getTotalSah();
    }

    public function getTotalZakatTdkSah()
    {
        return $this->ZakatRepository->getTotalTdkSah();
    }

    public function getDailyZakatData(): array
    {
        return $this->ZakatRepository->getDailyZakatData();
    }

    public function addZakat(string $nama, $jumlah, string $alamat, ?string $rincian, ?string $keterangan, string $kode_ms): bool
    {
        try {
            return $this->ZakatRepository->add($nama, $jumlah, $alamat, $rincian, $keterangan, $kode_ms);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function acc_zakat($id): bool
    {
        try {
            return $this->ZakatRepository->acc_zakat($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($id): bool
    {
        try {
            return $this->ZakatRepository->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
