<?php

namespace App\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=flight_manager;charset=utf8;port=3307', 'root', 'root');
        }

        return $this->database;
    }
}