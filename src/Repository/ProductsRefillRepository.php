<?php


namespace App\Repository;

use App\Database\Database;

class ProductsRefillRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addProductsRefill( $productId, $qty, $date, $productPrice)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.products_refill(productId, qty, date, Price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$productId, $qty, $date, $productPrice]);
        return $this->conn->lastInsertId();
    }


}