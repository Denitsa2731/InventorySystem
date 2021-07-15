<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductsRefillRepository;

class ProductController extends BaseController
{
    /**
     * @var ProductRepository
     * @var CategoryRepository
     * @var ProductsRefillRepository
     */
    private $product_repository;
    private $category_repository;
    private $productrefill_repository;

    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->category_repository = new CategoryRepository();
        $this->productrefill_repository = new ProductsRefillRepository();
    }
    public function getExpiringProducts()
    {
        session_start();
        if($_SESSION["user"])
        {
            $expiringProducts = $this->product_repository->getExpiringProducts();
            $this->render('../templates/products/expiring.php', [
                'products' => $expiringProducts
            ]);
        }else{
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }

    }

    public function list()
    {
        session_start();
        if(isset($_GET['keywords']) && $_GET['keywords'] != '' ) {
            $products = $this->product_repository->searchByKeywords($_GET['keywords']);
        }else{
            $products = $this->product_repository->showAllProducts();
        }
        if ($_SESSION["user"]) {

            $this->render('../templates/products/list.php', [
                'products' => $products
            ]);
        } else {
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

    public function loadHistory()
    {
        session_start();
        if ($_SESSION["user"]) {

            if (isset($_GET['product_id']) && $_GET['product_id'] != '') {

                $product_id = $_GET['product_id'];
                $this->render('../templates/products/history.php', [

                    'order_history' => $this->product_repository->showOrderHistory($product_id),
                    'refill_history' => $this->product_repository->showRefillHistory($product_id)
                ]);
            }
        } else {
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

    public function getProductValueById()
    {
        if (isset($_GET['product_id']) && $_GET['product_id'] != '') {

            $product_id = $_GET['product_id'];

            $product = $this->product_repository->getProductByIdArray($product_id);

            if ($product != false) {
                echo json_encode($product, 1);
            } else {
                echo 'Няма продукт с id ' . $product_id;
            }


        }
    }

    public function getAllProducts()
    {
        $products = $this->product_repository->showAllProducts();

        echo json_encode($products, 1);
    }

    public function create()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // if the form's submit button is clicked, we need to process the form
            if (isset($_POST['productName']) && $_POST['productName'] != '' && isset($_POST['productQty']) && $_POST['productQty'] != '' &&
                isset($_POST['productPrice'])
                && $_POST['productPrice'] != '' &&
                isset($_POST['productBarCode']) && $_POST['productBarCode'] != '') {
                // isset($_POST['productCategory']) && $_POST['productCategory'] != '') {

                // get variables from the form
                $productName = $_POST['productName'];
                $productQty = $_POST['productQty'];
                $productDate = date('Y-m-d H:i:s');
                $productPrice = $_POST['productPrice'];
                $productBarCode = $_POST['productBarCode'];
                //$productCategory = $_POST['productCategory'];
                $category_id = $_POST['category_id'];


                $this->product_repository->addProduct($productName, $productQty, $productDate, $productPrice, $productBarCode, $category_id);
                header('Location: http://localhost/~deni/InventorySystem/public/products');
            }

            die('error');
        }
        if($_SESSION["user"])
        {
        $this->render('../templates/products/input.php', [
            'button_label' => 'Добави',
            'categories' => $this->category_repository->showAllCategories()
        ]);
        }else{
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $this->product_repository->getProductById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                // if the form's submit button is clicked, we need to process the form
                if (isset($_POST['productName']) && $_POST['productName'] != '' &&
                    isset($_POST['productPrice']) && $_POST['productPrice'] != '' &&
                    isset($_POST['productBarCode']) && $_POST['productBarCode'] != '' &&
                    isset($_POST['category_id']) && $_POST['category_id'] != '') {
                    // get variables from the form

                    $data['id'] = $_GET['id'];
                    $data['productName'] = $_POST['productName'];
                    $data['productQty'] = $product->getProductQty();
                    $data['productPrice'] = $_POST['productPrice'];
                    $data['productBarCode'] = $_POST['productBarCode'];
                    $data['productCategory'] = $_POST['category_id'];
                    $data['lastOrderDate'] = $product->getLastOrderDate();
                    $data['lastRefillDate'] = $product->getLastRefillDate();

//                    $productId = $_GET['id'];
//                    $qty = $_POST['productQty'];
//                    $date = date('Y-m-d H:i:s');
//                    $productPrice = $_POST['productPrice'];
//
//                    if($data['productQty'] !== $product->getProductQty())
//                    {
//                        $this->productrefill_repository->addProductsRefill($productId, $qty, $date, $productPrice);
//                    }
                    $this->product_repository->updateProduct($data);
                    header('Location: http://localhost/~deni/InventorySystem/public/products');
                }

                die('error');

            }

            $this->render('../templates/products/input.php', [
                'button_label' => 'Редактирай',
                'product' => $product,
                'categories' => $this->category_repository->showAllCategories()
            ]);
        } else {
            echo "404";
        }
    }

    public function addProductQty()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $this->product_repository->getProductById($_GET['id']);

            if (isset($_POST['productQty']) && $_POST['productQty'] != '' &&
                isset($_POST['productPrice'])
                && $_POST['productPrice'] != '') {
                // isset($_POST['productCategory']) && $_POST['productCategory'] != '') {

                // get variables from the form

                $productId = $_GET['id'];
                $qty = $_POST['productQty'];
                $date = date('Y-m-d H:i:s');
                $productPrice = $_POST['productPrice'];

                $this->productrefill_repository->addProductsRefill($productId, $qty, $date, $productPrice);
                $productQty = $_POST['productQty']+ $product->getProductQty();

                $data['id'] = $productId;
                $data['productName'] = $product->getProductName();
                $data['productQty'] = $productQty;
                $data['productPrice'] = $productPrice;
                $data['productBarCode'] = $product->getProductBarCode();
                $data['productCategory'] = $product->getProductCategory();
                $data['lastOrderDate'] = $product->getLastOrderDate();
                $data['lastRefillDate'] = $date;

                $this->product_repository->updateProduct($data);
                header('Location: http://localhost/~deni/InventorySystem/public/products');

            }
            $this->render('../templates/products/addQty.php', [
                'button_label' => 'Добави',
                'product' => $product
            ]);
        } else {
            echo "404";
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $product = $this->product_repository->getProductById($_GET['id']);
        }

        if ($product == false) {
            die ('404');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->product_repository->deleteProduct($_GET['id']);
            header('Location: http://localhost/~deni/InventorySystem/public/products');
            exit(0);
        }
        $this->render('../templates/products/delete.php', [
            'button_label' => 'ДА'
        ]);
    }
}