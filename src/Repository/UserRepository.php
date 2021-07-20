<?php


namespace App\Repository;


use App\Database\Database;

class UserRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addRegister($userEmail, $userPassword, $firstName, $lastName, $userRole)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.users(userEmail, userPassword, firstName, lastName, userRole) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userEmail, $userPassword, $firstName, $lastName, $userRole]);

    }
    public function loadByEmail(string $userEmail)
    {
        $sql = "SELECT * FROM inventory.users WHERE userEmail=:userEmail";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':userEmail', $userEmail);
        $stmt->execute();
        $result = $stmt->fetch();

        if(isset($result))
        {
            return $result;
        }else {
          return false;
        }


    }

}