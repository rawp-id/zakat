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
}

