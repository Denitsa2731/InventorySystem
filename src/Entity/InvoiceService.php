<?php


namespace App\Entity;


class InvoiceService
{
    private $qty;
    private $invoice_id;
    private $service_id;

    public function __construct( $qty, $invoice_id, $service_id)
    {
        $this->qty = $qty;
        $this->invoice_id = $invoice_id;
        $this->service_id = $service_id;
    }
    public function getQuantity()
    {
        return $this->qty;
    }
    public function getInvoice_id()
    {
        return $this->invoice_id;
    }
    public function getService_id()
    {
        return $this->service_id;
    }

    public function setQuantity($qty)
    {
        $this->qty = $qty;
    }
    public function setInvoice_id($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }
    public function setService_id($service_id)
    {
        $this->service_id = $service_id;
    }

}