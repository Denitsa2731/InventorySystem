<?php
namespace App\Entity;

class Product
{
    private $productName;
    private $productQty;
    private $productDate;
    private $productPrice;
    private $productBarCode;
    private $productCategory;
    private $lastOrderDate;
    private $lastRefillDate;



    public function __construct( $productName, $productQty, $productDate, $productPrice, $productBarCode, $productCategory, $lastOrderDate, $lastRefillDate)
    {
        $this->productName = $productName;
        $this->productQty = $productQty;
        $this->productDate = $productDate;
        $this->productPrice = $productPrice;
        $this->productBarCode = $productBarCode;
        $this->productCategory = $productCategory;
        $this->lastOrderDate = $lastOrderDate;
        $this->lastRefillDate = $lastRefillDate;
    }

    public function getProductCategory()
    {
        return $this->productCategory;
    }

    public function getProductBarCode()
    {
        return $this->productBarCode;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function getProductDate()
    {
        return $this->productDate;
    }

    public function getProductQty()
    {
        return $this->productQty;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getLastOrderDate()
    {
        return $this->lastOrderDate;
    }

    public function getLastRefillDate()
    {
        return $this->lastRefillDate;
    }

    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function setProductBarCode($productBarCode)
    {
        $this->productBarCode = $productBarCode;
    }

    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    public function setProductDate($productDate)
    {
        $this->productDate = $productDate;
    }

    public function setProductQty($productQty)
    {
        $this->productQty = $productQty;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function setLastOrderDate($lastOrderDate)
    {
        $this->lastOrderDate = $lastOrderDate;
    }

    public function setLastRefillDate($lastRefillDate)
    {
        $this->lastRefillDate = $lastRefillDate;
    }

}