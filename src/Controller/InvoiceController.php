<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\InvoiceRepository;


class InvoiceController extends BaseController
{
    /**
     * @var InvoiceRepository
     */
    private $invoice_repository;
    private $client_repository;


    public function __construct()
    {

        $this->invoice_repository = new InvoiceRepository();
        $this->client_repository = new ClientRepository();
    }

    public function list()
    {
        $this->render('../templates/invoices/list.php', [
            'invoices' => $this->invoice_repository->showAllInvoices()
        ]);
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['number']) && $_POST['number'] != '' &&
                isset($_POST['date']) && $_POST['date'] != '')
            {
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
                header('Location: http://localhost/~deni/new_invoices/public/invoice');
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

                if (isset($_POST['name']) && $_POST['name'] != '' && isset($_GET['id']) && isset($_POST['number']) &&
                    $_POST['number'] != '' && isset($_POST['date']) && $_POST['date'] != '' &&
                    isset($_POST['email']) && $_POST['email'] != '' &&
                    isset($_POST['address']) && $_POST['address'] != '' &&
                    isset($_POST['creation_date']) && $_POST['creation_date'] != '') {

                    // get variables from the form
                    $data['id'] = $_GET['id'];
                    $data['name'] = $_POST['name'];
                    $data['number'] = $_POST['number'];
                    $data['date'] = $_POST['date'];
                    $data['email'] = $_POST['email'];
                    $data['address'] = $_POST['address'];
                    $data['creation_date'] = $_POST['creation_date'];


                    $this->invoice_repository->updateInvoice($data);
                    header('Location: http://localhost/~deni/new_invoices/public/invoice');
                }

                die('error');

            }

            $this->render('../templates/invoices/input.php', [
                'button_label' => 'update',
                'invoice' => $invoice,
                'clients' => $this->client_repository->showAllClients()

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
            header('Location: http://localhost/~deni/new_invoices/public/invoice');
            exit(0);
        }
        $this->render('../templates/invoices/delete.php', [
            'button_label' => 'YES'
        ]);
    }


}