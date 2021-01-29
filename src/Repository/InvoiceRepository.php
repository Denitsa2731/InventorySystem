<?php
namespace App\Repository;

use App\Database\Database;
use App\Entity\Invoice;

class InvoiceRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();

    }

    public function getAllClientNames()
    {
        $clientNames = [];
        $stmt = $this->conn->query("SELECT client_name FROM invoices.client ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($clientNames, $row['client_name']);
        }

        return $clientNames;
    }

    public function addInvoice($client_name, $number, $date, $client_email, $client_address, $creation_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO invoices.invoice(client_name, date, number, client_email, client_address, creation_date) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$client_name, $date, $number, $client_email, $client_address, $creation_date]);
    }

    public function showAllInvoices()
    {
        $invoices = [];
        $stmt = $this->conn->query("SELECT * FROM invoices.invoice ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($invoices, array(
                'id' => $row['id'],
                'name' => $row['client_name'],
                'number' => $row['number'],
                'date' => $row['date'],
                'email' => $row['client_email'],
                'address' => $row['client_address'],
                'creation_date' => $row['creation_date'],
            ));
        }

        return $invoices;
    }
    public function getInvoiceById(int $id)
    {
            $sql = "SELECT * FROM invoices.invoice WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $invoice = new Invoice($result['client_name'], $result['number'], $result['date'] ,$result['client_email'], $result['client_address'], $result['creation_date']);

            return $invoice;
    }


    public function updateInvoice(array $data)
    {

        $stmt = $this->conn->prepare("UPDATE invoices.invoice SET client_name=?, number=?, date=? client_email=?, client_address=?, creation_date=? WHERE id=?");

        return $stmt->execute([$data['client_name'], $data['number'], $data['date'], $data['id'], $data['client_email'], $data['client_address'], $data['creation_date']]);
    }


    public function deleteInvoice(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM invoices.invoice WHERE id=?");
        return $stmt->execute([$id]);
    }
}
