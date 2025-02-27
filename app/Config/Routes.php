<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('login', 'AuthController::login');

$routes->resource('clientes', ['controller' => 'ClientesController']);

$routes->resource('produtos', ['controller' => 'ProdutosController']);

$routes->resource('pedidos', ['controller' => 'PedidosController']);
