<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Product;

class ProductRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function addProduct($productName, $productQty, $productDate, $productPrice, $productBarCode, $productCategory)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.product(productName, productQty, productDate, productPrice, productBarCode, productCategory) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$productName, $productQty, $productDate, $productPrice, $productBarCode, $productCategory]);
    }

    public function showOrderHistory(int $productId)
    {
        $orderHistory = [];
        $sql = "SELECT * FROM inventory.orders_products WHERE productId=:productId ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':productId', $productId);
        $stmt->execute();


        while ($row = $stmt->fetch()) {

            array_push($orderHistory, array(
                'id' => $row['id'],
                'soldQty' => $row['soldQty'],
                'price' => $row['price'],
                'date' => $row['date']
            ));
        }

        return $orderHistory;
    }

    public function searchByKeywords($keywords)
    {
        $products = [];
        $sql = "SELECT
	                   p.*, c.categoryName 
                    FROM 
	                    inventory.product p
                    JOIN 
	                    inventory.categories c ON (c.id = p.productCategory)
                    WHERE 
	                    p.productName LIKE  ?  OR p.productBarCode LIKE  ? ";
        $stmt = $this->conn->prepare($sql);

//        $stmt->bindValue(':keywords',$keywords, PDO::PARAM_STR);
        $stmt->execute(["%$keywords%", "%$keywords%"]);

        while ($row = $stmt->fetch()) {
            array_push($products, array(
                'id' => $row['id'],
                'productName' => $row['productName'],
                'productQty' => $row['productQty'],
                'productDate' => $row['productDate'],
                'productPrice' => $row['productPrice'],
                'productBarCode' => $row['productBarCode'],
                'productCategory' => $row['productCategory'],
                'categoryName' => $row['categoryName'],
                'lastOrderDate' => $row['lastOrderDate'],
                'lastRefillDate' => $row['lastRefillDate']
            ));
        }

        return $products;
    }

    public function showRefillHistory($productId)
    {
        $refillHistory = [];
        $sql = "SELECT * FROM inventory.products_refill where productId=:productId ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':productId', $productId);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            array_push($refillHistory, array(
                'id' => $row['id'],
                'qty' => $row['qty'],
                'date' => $row['date'],
                'price' => $row['price']
            ));

        }

        return $refillHistory;
    }

    public function showRefilledProducts()
    {
        $inventories = [];
        $stmt = $this->conn->query("SELECT
	                    p.*, c.categoryName 
                    FROM 
	                    inventory.product p
                    JOIN 
	                    inventory.categories c ON (c.id = p.productCategory)
                    WHERE
                        p.productQty>0
                ");


        while ($row = $stmt->fetch()) {
            array_push($inventories, array(
                'id' => $row['id'],
                'productName' => $row['productName'],
                'productQty' => $row['productQty'],
                'productDate' => $row['productDate'],
                'productPrice' => $row['productPrice'],
                'productBarCode' => $row['productBarCode'],
                'productCategory' => $row['productCategory'],
                'categoryName' => $row['categoryName'],
                'lastOrderDate' => $row['lastOrderDate'],
                'lastRefillDate' => $row['lastRefillDate']
            ));
        }

        return $inventories;
    }

    public function showAllProducts()
    {
        $inventories = [];
        $stmt = $this->conn->query("SELECT
	                    p.*, c.categoryName 
                    FROM 
	                    inventory.product p
                    JOIN 
	                    inventory.categories c ON (c.id = p.productCategory)");

        while ($row = $stmt->fetch()) {
            array_push($inventories, array(
                'id' => $row['id'],
                'productName' => $row['productName'],
                'productQty' => $row['productQty'],
                'productDate' => $row['productDate'],
                'productPrice' => $row['productPrice'],
                'productBarCode' => $row['productBarCode'],
                'productCategory' => $row['productCategory'],
                'categoryName' => $row['categoryName'],
                'lastOrderDate' => $row['lastOrderDate'],
                'lastRefillDate' => $row['lastRefillDate']
            ));
        }

        return $inventories;
    }

    public function getExpiringProducts()
    {
        $products = [];
        $stmt = $this->conn->query("SELECT * FROM inventory.product where `productQty`<5");

        while ($row = $stmt->fetch()) {
            array_push($products, array(
                'id' => $row['id'],
                'productName' => $row['productName'],
                'productQty' => $row['productQty'],
                'productDate' => $row['productDate'],
                'productPrice' => $row['productPrice'],
                'productBarCode' => $row['productBarCode'],
                'productCategory' => $row['productCategory'],
                'lastOrderDate' => $row['lastOrderDate'],
                'lastRefillDate' => $row['lastRefillDate']
            ));
        }
        return $products;
    }

    public function getProductById(int $id)
    {
        $sql = "SELECT * FROM inventory.product WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result != false) {

            $product = new Product($result['productName'], $result['productQty'], $result['productDate'], $result['productPrice'], $result['productBarCode'], $result['productCategory'], $result['lastOrderDate'], $result['lastRefillDate']);
            return $product;
        } else {
            return false;
        }
    }

    public function getProductByIdArray(int $id)
    {
        $sql = "SELECT * FROM inventory.product WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result != false) {

            return $result;
        } else {
            return false;
        }
    }

    public function updateProduct(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE inventory.product SET productName=?, productQty=?, productPrice=?, productBarCode=?, productCategory=?, lastOrderDate=?, lastRefillDate=?  WHERE id=?");

        return $stmt->execute([$data['productName'], $data['productQty'], $data['productPrice'], $data['productBarCode'], $data['productCategory'], $data['lastOrderDate'], $data['lastRefillDate'], $data['id']]);
    }

    public function updateLastOrderDate(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE inventory.product SET lastOrderDate=?    WHERE id=?");

        return $stmt->execute([$data['lastOrderDate'], $data['id']]);
    }

    public function deleteProduct(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM inventory.product WHERE id=?");
        return $stmt->execute([$id]);
    }

}
