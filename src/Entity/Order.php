<?php


namespace App\Entity;


class Order
{
    private $id;
    private $customerName;
    private $customerAddress;
    private $customerPhone;
    private $grossAmount;
    private $vat;
    private $netAmount;
    private $discount;

    public function __construct( $id, $customerName, $customerAddress, $customerPhone, $grossAmount, $vat, $netAmount, $discount )
    {
        $this->id = $id;
        $this->customerName = $customerName;
        $this->customerAddress = $customerAddress;
        $this->customerPhone = $customerPhone;
        $this->grossAmount = $grossAmount;
        $this->vat = $vat;
        $this->netAmount = $netAmount;
        $this->discount = $discount;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function getNetAmount()
    {
        return $this->netAmount;
    }

    public function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
    }

    public function getVat()
    {
        return $this->vat;
    }

    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    public function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;
    }

    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;
    }

    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;
    }

    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}