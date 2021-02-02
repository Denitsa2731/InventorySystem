<?php
namespace App\Repository;

use App\Database\Database;
use App\Entity\Service;

class ServiceRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addService($name, $price, $creation_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO invoices.service(name, price, creation_date) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $price, $creation_date]);
    }

    public function showAllServices()
    {
        $invoices = [];
        $stmt = $this->conn->query("SELECT * FROM invoices.service ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($invoices, array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'creation_date' => $row['creation_date'],
            ));
        }

        return $invoices;
    }

    public function getServiceById(int $id)
    {
        $sql = "SELECT * FROM invoices.service WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $service = new Service($result['name'], $result['creation_date'], $result['price']);

        return $service;
    }

    public function updateService(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE invoices.service SET name=?, price=?, creation_date=? WHERE id=?");

        return $stmt->execute([$data['name'], $data['price'], $data['creation_date'], $data['id']]);
    }

    public function deleteService(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM invoices.service WHERE id=?");
        return $stmt->execute([$id]);
    }

}
