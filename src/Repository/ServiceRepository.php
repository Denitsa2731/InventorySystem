<?php
namespace App\Repository;
use App\Database\Database;

class ServiceRepository
{
    private $stm;

    function __construct()
    {
        $this->stm = $this->connect();
    }

    public function addService($name, $price, $creation_date)
    {
        $stmt = $this->stm->prepare("INSERT INTO invoices.service(name, price, creation_date) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $price, $creation_date]);
    }

    public function showAllServices()
    {
        $invoices = [];
        $stmt = $this->stm->query("SELECT * FROM invoices.service ORDER BY id DESC");

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
        $stmt = $this->stm->prepare("SELECT * FROM invoices.service WHERE id=?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function updateService(array $data)
    {
        $stmt = $this->stm->prepare("UPDATE invoices.service SET name=?, price=?, creation_date=? WHERE id=?");

        return $stmt->execute([$data['name'], $data['price'], $data['creation_date'], $data['id']]);
    }

    public function deleteClient(int $id)
    {
        $stmt = $this->stm->prepare("DELETE FROM invoices.service WHERE id=?");
        return $stmt->execute([$id]);
    }

}
