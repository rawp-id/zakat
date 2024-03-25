<?php
// namespace Database;
// use SQLite3;

// class Connection {
//     private $db;

//     public function __construct() {
//         $this->db=new SQLite3(__DIR__ . '/mydb.db');
//     }

//     // private function connect() {
//     //     $this->db = new SQLite3(__DIR__ . '/mydb.db');
        
//     //     if(!$this->db) {
//     //         echo $this->db->lastErrorMsg();
//     //     } 
//     //     else {
//     //         echo "Open database success...\n";
//     //     }
//     // }

//     public function getDb() {
//         return $this->db;
//     }

//     public function close() {
//         $this->db->close();
//     }

//     /**
//      * Executes a SQL query on the database and returns the result.
//      *
//      * @param string $query The SQL query to execute.
//      * @return mixed The result of the query. For SELECT statements, this will be an array of results. For other statements, it will be TRUE on success or FALSE on failure.
//      */
//     public function query($query) {
//         $result = $this->db->query($query);
        
//         if (!$result) {
//             echo $this->db->lastErrorMsg();
//             return false;
//         }
        
//         if (preg_match('/^(\s)*(SELECT|PRAGMA)/i', $query)) {
//             $data = [];
//             while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
//                 $data[] = $row;
//             }
//             return $data;
//         } else {
//             return true;
//         }
//     }
// }
 
// // $connection = new Connection(); 
// // $db = $connection->getDb();

// // $connection->close();
