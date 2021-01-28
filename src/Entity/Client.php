<?php
namespace App\Entity;

class Client
{
    private $name;
    private $email;
    private $address;
    private $date;

    public function __construct( $client_name, $client_email, $client_address,$creation_date)
    {
        $this->name = $client_name;
        $this->email = $client_email;
        $this->address = $client_address;
        $this->date = $creation_date;
    }

    public function getClientName()
    {
        return $this->name;
    }

    public function getClientEmail()
    {
        return $this->email;
    }

    public function getClientAddress()
    {
        return $this->address;
    }
    public function getCreationDate()
    {
        return $this->date;
    }
    public function setClientAddress($client_address)
    {
        $this->address = $client_address;
    }
    public function setCreationDate($creation_date)
    {
        $this->date = $creation_date;
    }
    public function setClientEmail($client_email)
    {
        $this->email = $client_email;
    }
    public function setClientName($client_name)
    {
    $this->name = $client_name;
    }


}