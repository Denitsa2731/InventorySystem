<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Client;


class ClientRepository
{
    private $conn;

    public function __construct()

    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addClient($client_name, $client_email, $client_address, $creation_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO invoices.client(client_name, client_email, client_address, creation_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$client_name, $client_email, $client_address, $creation_date]);
    }



    public function showAllClients()
    {
        $clients = [];
        $stmt = $this->conn->query("SELECT * FROM invoices.client ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($clients, array(
                'id' => $row['id'],
                'name' => $row['client_name'],
                'email' => $row['client_email'],
                'address' => $row['client_address'],
                'date' => $row['creation_date'],
            ));
        }

        return $clients;
    }

    public function getClientById(int $id)
    {
        $sql = "SELECT * FROM invoices.client WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $client = new Client($result['client_name'], $result['client_email'], $result['client_address'], $result['creation_date']);

        return $client;
    }

    public function updateClient(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE invoices.client SET client_name=?, client_email=?, client_address=?, creation_date=? WHERE id=?");

        return $stmt->execute([$data['name'], $data['email'], $data['address'], $data['date'], $data['id']]);
    }

    public function deleteClient(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM invoices.client WHERE id=?");
        return $stmt->execute([$id]);
    }
}
