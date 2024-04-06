<?php

namespace App\Services;

use App\Repositories\MasjidRepository;

class MasjidService
{

    protected $masjidRepository;


    public function __construct()
    {
        $this->masjidRepository = new MasjidRepository();
    }


    public function find($kode)
    {
        return $this->masjidRepository->getMasjidByKode($kode);
    }

}
