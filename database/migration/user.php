<?php

namespace Database\Migration;

use Database\Connection;

class UserDb
{
    protected $db;

    public function __construct(Connection $connection)
    {
        // Assuming the Connection class exposes the database connection
        // or a method to execute SQL directly.
        $this->db = $connection->getDb();
    }

    /**
     * Executes the migration.
     */
    public function migrate()
    {
        $this->createRoleTable();
        $this->createUserTable();
    }

    /**
     * Creates the 'role' table.
     */
    protected function createRoleTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS role (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                role_name TEXT NOT NULL
            );
        ";

        if (!$this->db->exec($sql)) {
            echo "Could not create 'role' table: " . $this->db->lastErrorMsg();
        } else {
            echo "'role' table created successfully.\n";
        }
    }

    /**
     * Creates the 'user' table.
     */
    protected function createUserTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS user (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nama TEXT,
                email TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                role_id INTEGER,
                FOREIGN KEY (role_id) REFERENCES role(id)
            );
        ";

        if (!$this->db->exec($sql)) {
            echo "Could not create 'user' table: " . $this->db->lastErrorMsg();
        } else {
            echo "'user' table created successfully.\n";
        }
    }
}

// Usage example:
// Assuming $connection is an instance of your Connection class.
//$connection = new Connection();
//$migration = new UserDbMigration($connection);
//$migration->migrate();
