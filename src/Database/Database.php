<?php

namespace App\Database;
use PDO;

class Database
{
    private $sName;
    private $uName;
    private $pass;
    private $db_name;
    private $charset;

    public function connect()
    {
        $this->sName = "localhost";
        $this->uName = "deni";
        $this->pass = "deni";
        $this->db_name = "inventory";
        $this->charset = "utf8mb4";

        try {
            $dsn = "mysql:host=" . $this->sName . ";db_name=" . $this->db_name . ";charset=" . $this->charset;
            $pdo = new PDO ($dsn, $this->uName, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed:" . $e->getMessage();
        }
    }
}
