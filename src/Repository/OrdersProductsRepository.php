<?php


namespace App\Repository;


use App\Database\Database;

class OrdersProductsRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addOrdersProducts($orderId, $productId, $soldQty,  $productPrice, $date)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.orders_products(orderId, productId, soldQty, price, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$orderId, $productId, $soldQty, $productPrice, $date]);
        return $this->conn->lastInsertId();
    }

}