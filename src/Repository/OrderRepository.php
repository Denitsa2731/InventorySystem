<?php


namespace App\Repository;

use App\Database\Database;
use App\Entity\Order;

class OrderRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addOrder($customerName, $customerAddress, $customerPhone, $grossAmount, $vat, $netAmount, $discount)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.orders(customerName,customerAddress, customerPhone, grossAmount, vat, netAmount, discount) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$customerName, $customerAddress, $customerPhone, $grossAmount, $vat, $netAmount, $discount]);
        return $this->conn->lastInsertId();
    }

    public function showAllOrders()
    {
        $inventories = [];
        $stmt = $this->conn->query("SELECT * FROM inventory.orders ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($inventories, array(
                'id' => $row['id'],
                'customerName' => $row['customerName'],
                'customerAddress' => $row['customerAddress'],
                'customerPhone' => $row['customerPhone'],
                'grossAmount' =>$row['grossAmount'],
                'vat' =>$row['vat'],
                'netAmount' =>$row['netAmount'],
                'discount' =>$row['discount']
            ));
        }

        return $inventories;
    }

    public function getOrderById(int $id)
    {
        $sql = "SELECT * FROM inventory.orders WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $order = new Order($result['id'],$result['customerName'], $result['customerAddress'], $result['customerPhone'], $result['grossAmount'], $result['vat'], $result['netAmount'], $result['discount']);

        return $order;
    }

    public function updateOrder(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE inventory.orders SET customerName=?, customerAddress=?, customerPhone=?, grossAmount=?, vat=?, netAmount=?, discount=? WHERE id=?");

        return $stmt->execute([$data['customerName'], $data['customerAddress'], $data['customerPhone'], $data['grossAmount'], $data['vat'], $data['netAmount'], $data['discount'], $data['id']]);
    }

    public function deleteOrder(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM inventory.orders WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function showOrderProducts($orderId)
    {
        $sql = "SELECT op.*, p.productName, p.productQty, p.productPrice, o.discount, o.vat, o.grossAmount, o.netAmount 
                                                    FROM inventory.orders_products op 
                                                        JOIN inventory.product p ON (p.id = op.productId) 
                                                        JOIN inventory.orders o ON (o.id = op.orderId) 
                                                            WHERE op.orderId = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':orderId', $orderId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}