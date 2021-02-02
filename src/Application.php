<?php


namespace App;

use App\Controller\ServiceController;
use App\Controller\ClientController;
use App\Controller\InvoiceController;
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
            'services_list' => [
                '/services',
                [
                    '_controller' => ServiceController::class,
                    '_action' => 'list'
                ]
            ],
            'services_update' => [
                '/service_update',
                [
                    '_controller' => ServiceController::class,
                    '_action' => 'update'
                ]
            ],
            'services_create' => [
                '/service_create',
                [
                    '_controller' => ServiceController::class,
                    '_action' => 'create'
                ]
            ],
            'services_delete' => [
                '/service_delete',
                [
                    '_controller' => ServiceController::class,
                    '_action' => 'delete'
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