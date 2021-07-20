<?php


namespace App\Repository;

use App\Database\Database;
use App\Entity\Category;

class CategoryRepository
{
    private $conn;

    function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();

    }
    public function addCategory($categoryName)
    {
        $stmt = $this->conn->prepare("INSERT INTO inventory.categories(categoryName) VALUES (?)");
        return $stmt->execute([$categoryName]);
    }

    public function showAllCategories()
    {
        $categories = [];
        $stmt = $this->conn->query("SELECT * FROM inventory.categories ORDER BY id DESC");

        while ($row = $stmt->fetch()) {
            array_push($categories, array(
                'id' => $row['id'],
                'categoryName' => $row['categoryName'],
            ));
        }

        return $categories;
    }

    public function getCategoryById(int $id)
    {
        $sql = "SELECT * FROM inventory.categories WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $category = new Category($result['categoryName']);

        return $category;
    }

    public function getCategoryByName(string $categoryName)
    {
        $sql = "SELECT * FROM inventory.categories WHERE categoryName=:categoryName";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':categoryName', $categoryName);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result != false)
        {
            $category = new Category($result['categoryName']);
            return $category;
        }else{
            return false;
        }
    }

    public function updateCategory(array $data)
    {
        $stmt = $this->conn->prepare("UPDATE inventory.categories SET categoryName=? WHERE id=?");

        return $stmt->execute([ $data['categoryName'], $data['id']]);
    }

    public function deleteCategory(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM inventory.categories WHERE id=?");
        return $stmt->execute([$id]);
    }

}