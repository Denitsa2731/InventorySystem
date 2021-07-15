<?php

namespace App\Controller;

use App\Repository\ClientRepository;


class ClientController extends BaseController
{
    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new ClientRepository();
    }

    public function list()
    {

        session_start();
        if($_SESSION["user"])
        {
        $this->render('../templates/clients/list.php', [
            'clients' => $this->repository->showAllClients()
        ]);
        }else{
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
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
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $date = $_POST['date'];

                $this->repository->addClient($name, $email,$address, $date);
                header('Location: http://localhost/~deni/InventorySystem/public/client');
            }

            die('error');
        }

        $this->render('../templates/clients/input.php', [
            'button_label' => 'create'
        ]);
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $client = $this->repository->getClientById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST['name']) && $_POST['name'] != '' && isset($_GET['id']) && isset($_POST['email'])
                    && $_POST['email'] != '' &&
                    isset($_POST['address']) && $_POST['address'] != '' && isset($_POST['date']) &&
                    $_POST['date'] != '') {
                    // get variables from the form
                    $data['id'] = $_GET['id'];
                    $data['name'] = $_POST['name'];
                    $data['email'] = $_POST['email'];
                    $data['address'] = $_POST['address'];
                    $data['date'] = $_POST['date'];


                    $this->repository->updateClient($data);
                    header('Location: http://localhost/~deni/InventorySystem/public/client');
                }

                die('error');

            }

            $this->render('../templates/clients/input.php', [
                'button_label' => 'update',
                'client' => $client
            ]);
        } else {
            echo "404";
        }

    }


    public function delete()
    {
       if (isset($_GET['id'])) {
           $client = $this->repository->getClientById($_GET['id']);
       }


        if ($client == false) {
            die ('404');

        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->repository->deleteClient($_GET['id']);
            header('Location: http://localhost/~deni/InventorySystem/public/client');
            exit(0);
        }
        $this->render('../templates/clients/delete.php', [
            'button_label' => 'YES'
        ]);
    }

}