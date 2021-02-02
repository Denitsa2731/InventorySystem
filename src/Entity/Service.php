<?php
namespace App\Entity;

class Service
{
    private $name;
    private $creation_date;
    private $price;


    public function __construct( $name, $creation_date, $price)
    {
        $this->name = $name;
        $this->creation_date = $creation_date;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function setCreationDate($creation_date){
        $this->creation_date = $creation_date;
    }
    public function setPrice($price){
        $this->price = $price;
    }

}