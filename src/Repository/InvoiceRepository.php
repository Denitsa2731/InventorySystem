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


    public function addInvoice($client_name, $number, $date, $client_email, $client_address, $creation_date, $client_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO invoices.invoice(client_name, number, date, client_email, client_address, creation_date, client_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$client_name,  $number, $date, $client_email, $client_address, $creation_date, $client_id]);
    }
    public function add_service($qty, $invoiceId, $serviceId){
        $stmt = $this->conn->prepare("INSERT INTO invoices.invoice_service(qty, invoice_id, service_id) VALUES (?, ?, ?)");
        return $stmt->execute([$qty, $invoiceId, $serviceId]);
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
            $sql = "
                SELECT
                    * 
                FROM
                    invoices.invoice
                WHERE 
                    id=:id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result!=false){
                $invoice = new Invoice($result['client_name'], $result['client_email'], $result['client_address'] ,$result['creation_date'], $result['date'], $result['number'], $result['client_id'], $result['id']);

                return $invoice;
            }
            return false;
    }


    public function updateInvoice(array $data)
    {
        $sql = "
            UPDATE
                invoices.invoice 
            SET
                number = :number, 
                date = :date 
            WHERE
                id = :id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':number', $data['number'], \PDO::PARAM_INT);
        $stmt->bindValue(':date', $data['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], \PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function deleteInvoice(int $id)
    {
        $sql = "
            DELETE FROM
                    invoices.invoice 
            WHERE 
                    id= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('id', $id);

        return $stmt->execute();
    }
}
