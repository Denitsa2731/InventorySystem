<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\InvoiceRepository;
use App\Repository\ProductRepository;


class InvoiceController extends BaseController
{
    /**
     * @var InvoiceRepository
     * @var ClientRepository
     * @var ProductRepository
     */
    private $invoice_repository;
    private $client_repository;
    private $service_repository;


    public function __construct()
    {

        $this->invoice_repository = new InvoiceRepository();
        $this->client_repository = new ClientRepository();
        $this->service_repository = new ProductRepository();
    }

    public function list()
    {
        $this->render('../templates/invoices/list.php', [
            'invoices' => $this->invoice_repository->showAllInvoices()
        ]);
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $invoice = $this->invoice_repository->getInvoiceById($id);
            $client = $this->client_repository->getClientById($invoice->getClientId());

            $this->render('../templates/invoices/show.php', [

                'invoice' => $invoice,
                'client' => $client

            ]);

        }
    }

    public function add_service()
    {

        $id = $_GET['invoice_id'];
        if (!isset($id)){
            die('Error 404');
        }
        $invoice = $this->invoice_repository->getInvoiceById($id);
        $services = $this->service_repository->showAllServices();

        if ($invoice == false) {
            die('Error 404');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST['qty']) && $_POST['qty'] !='' ){
                // get variables from the form
                $qty = $_POST['qty'];
                $invoiceId = $id;
                $serviceId = $_POST['service_id'];

                $this->invoice_repository->add_service(
                    $qty,
                    $invoiceId,
                    $serviceId
                );
                header('Location: http://localhost/~deni/InventorySystem/public/invoice_show?id=' . $invoiceId);
            }
            die('Error');

        }

        $this->render('../templates/invoices/add_service.php', [
        'invoice' => $invoice,
        'service' => $services

        ]);
    }




    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['number']) && $_POST['number'] != '' &&
                isset($_POST['date']) && $_POST['date'] != '') {
                // get variables from the form
                $number = $_POST['number'];
                $date = $_POST['date'];
                $client_id = $_POST['client_id'];
                $creation_date = date('Y-m-d');
                $client = $this->client_repository->getClientById($client_id);

                $name = $client->getClientName();
                $email = $client->getClientEmail();
                $address = $client->getClientAddress();


                $this->invoice_repository->addInvoice(
                    $name,
                    $number,
                    $date,
                    $email,
                    $address,
                    $creation_date,
                    $client_id
                );
                header('Location: http://localhost/~deni/InventorySystem/public/invoice');
            }

            die('error');
        }

        $this->render('../templates/invoices/input.php', [
            'button_label' => 'create',
            'clients' => $this->client_repository->showAllClients()
        ]);
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $invoice = $this->invoice_repository->getInvoiceById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST['number']) &&
                    $_POST['number'] != '' &&
                    isset($_POST['id']) &&
                    isset($_POST['date']) && $_POST['date'] != '') {

                    // get variables from the form
                    $data ['number'] = $_POST['number'];
                    $data['date'] = $_POST['date'];
                    $id = $_POST['id'];

                    $client = $this->client_repository->getClientById($id);

                    $this->invoice_repository->updateInvoice($data);
                    header('Location: http://localhost/~deni/InventorySystem/public/invoice');
                }

                die('error');

            }

            $this->render('../templates/invoices/input.php', [
                'button_label' => 'update',
                'invoice' => $invoice
            ]);
        } else {
            echo "404";
        }

    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $invoice = $this->invoice_repository->getInvoiceById($_GET['id']);
        }


        if ($invoice == false) {
            die ('404');

        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->invoice_repository->deleteInvoice($_GET['id']);
            header('Location: http://localhost/~deni/InventorySystem/public/invoice');
            exit(0);
        }
        $this->render('../templates/invoices/delete.php', [
            'button_label' => 'YES'
        ]);
    }


}