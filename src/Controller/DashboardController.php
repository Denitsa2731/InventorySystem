<?php


namespace App\Controller;


use App\Repository\OrderRepository;
use App\Repository\OrdersProductsRepository;
use App\Repository\ProductRepository;

class DashboardController extends BaseController
{
    /**
     * @var ProductRepository
     * @var OrderRepository

     */
    private $product_repository;
    private $order_repository;
    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->order_repository = new OrderRepository();

    }
    public function dashboard()
    {
        session_start();
        if($_SESSION["user"])
        {
            $expiringProducts = $this->product_repository->getExpiringProducts();

            $this->render('../templates/dashboard/input.php', [
                'expiringProducts' => $expiringProducts,
                'products' =>$this->product_repository->showAllProducts(),
                'orders' => $this->order_repository->showAllOrders()
            ]);
        }else{
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }
    }

}