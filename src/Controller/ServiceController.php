<?php

namespace App\Controller;

use App\Repository\ServiceRepository;

class ServiceController extends BaseController
{
    /**
     * @var ServiceRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new ServiceRepository();
    }

    public function list()
    {
        $this->render('../templates/services/list.php', [
            'services' => $this->repository->showAllServices()
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['price'])
                && $_POST['price'] != '' &&
                isset($_POST['creation_date']) && $_POST['creation_date'] != '') {

                // get variables from the form
                $name = $_POST['name'];
                $price = $_POST['price'];
                $creation_date = $_POST['creation_date'];

                $this->repository->addService($name, $price, $creation_date);
                header('Location: http://localhost/~deni/new_invoices/public/services');
            }

            die('error');
        }

        $this->render('../templates/services/input.php', [
            'button_label' => 'create'
        ]);
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $service = $this->repository->getServiceById($_GET['id']);


            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                // if the form's submit button is clicked, we need to process the form
                if (isset($_POST['name']) && $_POST['name'] != '' &&  isset($_GET['id']) && isset($_POST['price'])
                    && $_POST['price'] != '' &&
                    isset($_POST['creation_date']) && $_POST['creation_date'] != '') {



                    // get variables from the form
                    $data['id'] = $_GET['id'];
                    $data['name'] = $_POST['name'];
                    $data['price'] = $_POST['price'];
                    $data['creation_date'] = $_POST['creation_date'];



                    $this->repository->updateService($data);
                    header('Location: http://localhost/~deni/new_invoices/public/services');
                }

                die('error');

            }


            $this->render('../templates/services/input.php', [
                'button_label' => 'update',
                'service' => $service
            ]);
        } else {
            echo "404";
        }

    }
    public function delete()
    {
        if (isset($_GET['id'])) {
            $service = $this->repository->getServiceById($_GET['id']);
        }


        if ($service == false) {
            die ('404');

        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->repository->deleteService($_GET['id']);
            header('Location: http://localhost/~deni/new_invoices/public/services');
            exit(0);
        }
        $this->render('../templates/services/delete.php', [
            'button_label' => 'YES'
        ]);
    }
}