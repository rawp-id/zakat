<?php

namespace Database\Migration;

use Database\Connection;

class ZakatDb
{
    protected $db;

    function __construct(Connection $connection)
    {
        $this->db = $connection;
    }
    
}
