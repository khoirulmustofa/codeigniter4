<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);
$routes->get('/', 'Home::index');
$routes->get('/test', 'TestController::index');

$routes->group('dashboard', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {
    $routes->get('/dashboard', 'HomeController::index');
});
