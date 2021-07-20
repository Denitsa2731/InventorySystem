<?php


namespace App\Controller;

use App\Database\Database;
use App\Repository\OrderRepository;
use App\Repository\OrdersProductsRepository;
use App\Repository\ProductRepository;


class OrderController extends BaseController
{
    /**
     * @var OrderRepository
     * @var ProductRepository
     * @var OrdersProductsRepository
     */
    private $order_repository;
    private $product_repository;
    private $orders_products_repository;

    public function __construct()
    {
        $this->order_repository = new OrderRepository();
        $this->product_repository = new ProductRepository();
        $this->orders_products_repository = new OrdersProductsRepository();

    }

    public function list()
    {
        session_start();
        if($_SESSION["user"])
        {
        $this->render('../templates/orders/list.php', [
            'orders' => $this->order_repository->showAllOrders()
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
            if (isset($_POST['customerName']) && $_POST['customerName'] != '' && isset($_POST['customerAddress']) && $_POST['customerAddress'] != '' &&
                isset($_POST['customerPhone']) && $_POST['customerPhone'] != '' &&
                isset($_POST['grossAmount'])
                && $_POST['grossAmount'] != '' &&
                isset($_POST['vat']) && $_POST['vat'] != '' &&
                isset($_POST['netAmount']) && $_POST['netAmount'] != '' &&
                isset($_POST['discount']) && $_POST['discount'] != ''

            ){
                // isset($_POST['productCategory']) && $_POST['productCategory'] != '') {

                // get variables from the form
                $customerName = $_POST['customerName'];
                $customerAddress = $_POST['customerAddress'];
                $customerPhone = $_POST['customerPhone'];
                $grossAmount = $_POST['grossAmount'];
                $vat = $_POST['vat'];
                $netAmount = $_POST['netAmount'];
                $discount = $_POST['discount'];

               $orderId = $this->order_repository->addOrder($customerName, $customerAddress, $customerPhone, $grossAmount, $vat,  $netAmount, $discount );
                for ($i = 0; $i < count($_POST['product']); $i++) {
                    $productId = $_POST['product'][$i];
                    $soldQty = $_POST['qty'][$i];
                    $date = date('Y-m-d H:i:s');
                    $product = $this->product_repository->getProductById($productId);

                    if ($product != false) {
                        $productPrice = $product->getProductPrice();
                        $this->orders_products_repository->addOrdersProducts($orderId, $productId, $soldQty, $productPrice, $date);
                        //update products
                        $product->setProductQty($product->getProductQty() - $soldQty);
                        $data['id'] = $productId;
                        $data['productName'] = $product->getProductName();
                        $data['productQty'] = $product->getProductQty();
                        $data['productPrice'] = $product->getProductPrice();
                        $data['productBarCode'] = $product->getProductBarCode();
                        $data['productCategory'] = $product->getProductCategory();
                        $data['lastOrderDate'] = $product->getLastOrderDate();
                        $data['lastRefillDate'] = $product->getLastRefillDate();

                        $this->product_repository->updateProduct($data);

                        $data = [
                            'id'=>$productId,
                            'lastOrderDate'=>$date
                        ];
                        $this->product_repository->updateLastOrderDate($data);
                    }
                }
                header('Location: http://localhost/~deni/InventorySystem/public/order');
            }

            die('error');
        }

        $products = $this->product_repository->showRefilledProducts();
        session_start();
        if($_SESSION["user"])
        {
        $this->render('../templates/orders/input.php', [
            'button_label' => 'Добави',
            'products' => $products
        ]);
        }else{
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $order = $this->order_repository->getOrderById($id);

            $this->render('../templates/orders/show.php', [

                'order' => $order

            ]);

        }
    }

    public function add_order()
    {

        $id = $_GET['order_id'];
        if (!isset($id)){
            die('Error 404');
        }
        $order = $this->order_repository->getOrderById($id);
        $products = $this->product_repository->showAllProducts();

        if ($order == false) {
            die('Error 404');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST['productQty']) && $_POST['productQty'] !='' ){
                // get variables from the form
                $productQty = $_POST['productQty'];
                $orderId = $id;
                $productId = $_POST['product_id'];

                $this->order_repository->add_product(
                    $productQty,
                    $orderId,
                    $productId
                );
                header('Location: http://localhost/~deni/InventorySystem/public/order_show?id=' . $orderId);
            }
            die('Error');

        }

        $this->render('../templates/invoices/add_service.php', [
            'order' => $order,
            'products' => $products

        ]);
    }

    public function update()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $order = $this->order_repository->getOrderById($_GET['id']);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST['customerName']) && $_POST['customerName'] != '' && isset($_GET['id']) && isset($_POST['customerAddress'])
                    && $_POST['customerAddress'] != '' &&
                    isset($_POST['customerPhone']) && $_POST['customerPhone'] != '' ) {
                    // get variables from the form
                    $data['id'] = $_GET['id'];
                    $data['customerName'] = $_POST['customerName'];
                    $data['customerAddress'] = $_POST['customerAddress'];
                    $data['customerPhone'] = $_POST['customerPhone'];
                    $data['grossAmount'] = $order->getGrossAmount();
                    $data['vat'] = $order->getVat();
                    $data['netAmount'] = $order->getNetAmount();
                    $data['discount'] = $order->getDiscount();


                    $this->order_repository->updateOrder($data);

                    header('Location: http://localhost/~deni/InventorySystem/public/order');
                }

                die('error');

            }
            $order_products = $this->order_repository->showOrderProducts($id);
            $this->render('../templates/orders/update.php', [
                'button_label' => 'Редактирай',
                'order' => $order,
                'order_products' => $order_products
            ]);
        } else {
            echo "404";
        }

    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $order = $this->order_repository->getOrderById($_GET['id']);
        }


        if ($order == false) {
            die ('404');

        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->order_repository->deleteOrder($_GET['id']);
            header('Location: http://localhost/~deni/InventorySystem/public/order');
            exit(0);
        }
        $this->render('../templates/orders/delete.php', [
            'button_label' => 'ДА'
        ]);
    }

}