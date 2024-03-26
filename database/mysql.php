<?php

namespace Database;

use mysqli;

class Connection
{
    private $db;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->db = new mysqli("localhost", "root", "rawp14", "zakat");

        if (!$this->db) {
            echo $this->db->lastErrorMsg();
        } 
        // else {
        //     echo "Open database success...\n";
        // }
    }

    public function getDb()
    {
        return $this->db;
    }

    public function close()
    {
        $this->db->close();
    }

}
 
// $connection = new Connection(); 
// $db = $connection->getDb();

// $connection->close();
