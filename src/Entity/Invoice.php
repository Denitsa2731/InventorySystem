<?php
namespace App\Entity;

class Invoice
{

    private $client_name;
    private $client_email;
    private $client_address;
    private $creation_date;
    private $date;
    private $number;

    public function __construct( $client_name, $client_email, $client_address,$creation_date, $date, $number)
    {
        $this->client_name = $client_name;
        $this->client_email = $client_email;
        $this->client_address = $client_address;
        $this->creation_date = $creation_date;
        $this->date = $date;
        $this->number = $number;
    }

    public function getClientName()
    {
        return $this->client_name;
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function getClientAddress()
    {
        return $this->client_address;
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
        $this->client_address = $client_address;
    }
    public function setCreationDate($creation_date){
        $this->creation_date = $creation_date;
    }
    public function setClientEmail($client_email){
        $this->client_email = $client_email;
    }
    public function setClientName($client_name){
    $this->cluent_name = $client_name;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setNumber($number){
        $this->number = $number;
    }
}