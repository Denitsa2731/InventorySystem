<?php
namespace App\Entity;

class Invoice
{

    private $name;
    private $email;
    private $address;
    private $creation_date;
    private $date;
    private $number;



    public function __construct( $client_name, $client_email, $client_address,$creation_date, $date, $number)
    {
        $this->name = $client_name;
        $this->email = $client_email;
        $this->address = $client_address;
        $this->creation_date = $creation_date;
        $this->date = $date;
        $this->number = $number;

    }

    public function getInvoiceName()
    {
        return $this->name;
    }

    public function getInvoiceEmail()
    {
        return $this->email;
    }

    public function getInvoiceAddress()
    {
        return $this->address;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getNumber()
    {
        return $this->number;
    }

    public function setClientAddress($client_address){
        $this->address = $client_address;
    }
    public function setCreationDate($creation_date){
        $this->creation_date = $creation_date;
    }
    public function setClientEmail($client_email){
        $this->email = $client_email;
    }
    public function setClientName($client_name){
    $this->name = $client_name;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setNumber($number){
        $this->number = $number;
    }


}