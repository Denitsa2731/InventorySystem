<?php
namespace App\Controller;

use App\Repository\InvoiceRepository;

class InvoiceController extends BaseController
{
    /**
     * @var InvoiceRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new InvoiceRepository();
    }
    public function list()
    {
        $this->render('../templates/invoices/list.php', [
            'invoices' => $this->repository->showAllInvoices()
        ]);
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['email'])
                && $_POST['email'] != '' &&
                isset($_POST['address']) && $_POST['address'] != '' && isset($_POST['date']) &&
                $_POST['date'] != '') {
                // get variables from the form
                $client_name = $_POST['name'];
                $client_email = $_POST['email'];
                $client_address = $_POST['address'];
                $creation_date = $_POST['date'];

                $this->repository->addClient($client_name, $client_email, $client_address, $creation_date);
                header('Location: http://localhost/~deni/new_invoices/public/client');
            }

            die('error');
        }

        $this->render('../templates/clients/input.php', [
            'button_label' => 'create'
        ]);
    }

}