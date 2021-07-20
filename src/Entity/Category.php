<?php


namespace App\Entity;


class Category
{
    private $categoryName;
    private $category_id;

    public function __construct($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }
}