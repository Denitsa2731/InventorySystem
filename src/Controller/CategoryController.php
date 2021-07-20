<?php

namespace App\Controller;
use App\Repository\CategoryRepository;


class CategoryController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    public function list()
    {
        session_start();
        if($_SESSION["user"])
        {
        $this->render('../templates/categories/list.php', [
            'categories' => $this->repository->showAllCategories()
        ]);
        }else{
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

    public function create()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['categoryName']) && $_POST['categoryName'] != '') {
                // get variables from the form
                $categoryName = $_POST['categoryName'];
                $category = $this->repository->getCategoryByName($categoryName);

                if($category == false)
                {
                    $this->repository->addCategory($categoryName);
                    header('Location: http://localhost/~deni/InventorySystem/public/category');
                }else{
                    die("Вече съществува категория с това име!");
                }
            }

            die('error');
        }
        if($_SESSION["user"])
        {
        $this->render('../templates/categories/input.php', [
            'button_label' => 'Добави'
        ]);
    }else{
    header('Location: http://localhost/~deni/InventorySystem/public/user/login');
}
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = $this->repository->getCategoryById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                // if the form's submit button is clicked, we need to process the form
                if (isset($_POST['categoryName']) && $_POST['categoryName'] != '') {
                    // get variables from the form
                    $data['id'] = $_GET['id'];
                    $data['categoryName'] = $_POST['categoryName'];

                    $this->repository->updateCategory($data);
                    header('Location: http://localhost/~deni/InventorySystem/public/category');
                }

                die('error');

            }
            $this->render('../templates/categories/input.php', [
                'button_label' => 'Редактирай',
                'category' => $category
            ]);
        } else {
            echo "404";
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $category = $this->repository->getCategoryById($_GET['id']);
        }

        if ($category == false) {
            die ('404');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->repository->deleteCategory($_GET['id']);
            header('Location: http://localhost/~deni/InventorySystem/public/category');
            exit(0);
        }
        $this->render('../templates/categories/delete.php', [
            'button_label' => 'ДА'
        ]);
    }

}