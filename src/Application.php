<?php


namespace App;

use App\Controller\CategoryController;
use App\Controller\DashboardController;
use App\Controller\ProductController;
use App\Controller\ClientController;
use App\Controller\InvoiceController;
use App\Controller\OrderController;
use App\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Router;


class Application
{
    private $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();

        $routes = [
            'clients_list' => [
                '/client',
                [
                    '_controller' => ClientController::class,
                    '_action' => 'list'
                ]
            ],
            'clients_update' => [
                '/client_update',
                [
                '_controller' => ClientController::class,
                '_action' => 'update'
                ]
            ],
            'clients_create' => [
                '/client_create',
                [
                    '_controller' => ClientController::class,
                    '_action' => 'create'
                ]
            ],
            'clients_delete' => [
                '/client_delete',
                [
                    '_controller' => ClientController::class,
                    '_action' => 'delete'
                ]
            ],
            'orders_list' => [
                '/order',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'list'
                ]
            ],
            'orders_update' => [
                '/order_update',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'update'
                ]
            ],
            'orders_create' => [
                '/order_create',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'create'
                ]
            ],
            'orders_delete' => [
                '/order_delete',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'delete'
                ]
            ],
            'orders_show' => [
                '/order_show',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'show'
                ]
            ],
            'api_get_product_by_id' => [
                '/api/get-product-by-id',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'getProductValueById'
                ]
            ],
            'api_get_all_products' => [
                '/api/get-all-products',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'getAllProducts'
                ]
            ],
            'add_product' => [
                '/orders/add_product',
                [
                    '_controller' => OrderController::class,
                    '_action' => 'add_order'
                ]
            ],

            'products_list' => [
                '/products',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'list'
                ]
            ],
            'products_update' => [
                '/product_update',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'update'
                ]
            ],
            'products_create' => [
                '/product_create',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'create'
                ]
            ],
            'products_delete' => [
                '/product_delete',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'delete'
                ]
            ],
            'user_login' => [
                '/user/login',
                [
                    '_controller' => UserController::class,
                    '_action' => 'login'
                ]
            ],
            'logout'  => [
                '/user/logout',
                [
                    '_controller' => UserController::class,
                    '_action' => 'logout'
                ]
            ],
            'user_register' => [
                '/user/register',
                [
                    '_controller' => UserController::class,
                    '_action' => 'register'
                ]
            ],
            'dashboard' =>[
                '/dashboard',
                [
                    '_controller' => DashboardController::class,
                    '_action' => 'dashboard'
                ]
            ],
            'invoices_list' => [
                '/invoice',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'list'
                ]
            ],
            'invoices_update' => [
                '/invoice_update',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'update'
                ]
            ],
            'invoices_create' => [
                '/invoice_create',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'create'
                ]
            ],
            'invoices_delete' => [
                '/invoice_delete',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'delete'
                ]
            ],
            'invoices_show' => [
                '/invoice_show',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'show'
                ]
            ],
            'categories_list' => [
                '/category',
                [
                    '_controller' => CategoryController::class,
                    '_action' => 'list'
                ]
            ],
            'categories_update' => [
                '/category_update',
                [
                    '_controller' => CategoryController::class,
                    '_action' => 'update'
                ]
            ],
            'categories_create' => [
                '/category_create',
                [
                    '_controller' => CategoryController::class,
                    '_action' => 'create'
                ]
            ],
            'categories_delete' => [
                '/category_delete',
                [
                    '_controller' => CategoryController::class,
                    '_action' => 'delete'
                ]
            ],
            'categories_show' => [
                '/category_show',
                [
                    '_controller' => CategoryController::class,
                    '_action' => 'show'
                ]
            ],
            'add_service' => [
                '/invoices/add_service',
                [
                    '_controller' => InvoiceController::class,
                    '_action' => 'add_service'
                ]
            ],
            'product_history' => [
                '/product_history',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'loadHistory'
                ]
            ],
            'product_addQty' => [
                '/product_addQty',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'addProductQty'
                ]
            ],
            'expiring_products' => [
                '/expiring_products',
                [
                    '_controller' => ProductController::class,
                    '_action' => 'getExpiringProducts'
                ]
            ]


        ];

        foreach ($routes as $name => $arguments) {
            $this->routes->add($name, new Route($arguments[0], $arguments[1]));
        }
    }

    public function dispatch()
    {
        $request = Request::createFromGlobals();

        $context = new RequestContext();
        $matcher = new UrlMatcher($this->routes, $context);
        try {
            $parameters = $matcher->match($request->getPathInfo());
        } catch (ResourceNotFoundException $e) {
            die('error 404');
        }

        $controller = new $parameters['_controller'];
        call_user_func_array(array($controller, $parameters['_action']), []);


//        if (strpos($uri, '/client_update') === 0) {
//            $client = new ClientController();
//            $client->update();
//
//
//        } elseif (strpos($uri, '/client_create') === 0) {
//            $client = new ClientController();
//            $client->create();
//
//        } elseif (strpos($uri, '/client') === 0) {
//            $client = new ClientController();
//            $client->list();
//
//        } elseif (strpos($uri, '/service') === 0) {
//            $client = new ClientController();
//            $client->list();
//
//        } elseif (strpos($uri, '/invoice') === 0) {
//            $client = new ClientController();
//            $client->list();
//
//        } elseif (strpos($uri, '/delete') === 0) {
//            $client = new ClientController();
//            $client->delete();
//
//        }


    }
}