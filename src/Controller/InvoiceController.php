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
            if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['number']) &&
                $_POST['number'] != '' && isset($_POST['date']) && $_POST['date'] != '' &&
                isset($_POST['email']) && $_POST['email'] != '' &&
                isset($_POST['address']) && $_POST['address'] != '' &&
                isset($_POST['creation_date']) && $_POST['creation_date'] != '') {

                // get variables from the form
                $name = $_POST['name'];
                $number = $_POST['number'];
                $date = $_POST['date'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $creation_date = $_POST['creation_date'];

                $this->repository->addInvoice($name, $number, $date, $email, $address, $creation_date);
                header('Location: http://localhost/~deni/new_invoices/public/invoice');
            }

            die('error');
        }

        $this->render('../templates/invoices/input.php', [
            'button_label' => 'create'
        ]);
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $invoice = $this->repository->getInvoiceById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['number']) &&
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

                    $this->repository->updateInvoice($data);
                    header('Location: http://localhost/~deni/new_invoices/public/invoice');
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
            $invoice = $this->repository->getInvoiceById($_GET['id']);
        }


        if ($invoice == false) {
            die ('404');

        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->repository->deleteInvoice($_GET['id']);
            header('Location: http://localhost/~deni/new_invoices/public/invoice');
            exit(0);
        }
        $this->render('../templates/invoices/delete.php', [
            'button_label' => 'YES'
        ]);
    }






}