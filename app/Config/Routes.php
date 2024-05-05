<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// service('auth')->routes($routes);

$routes->get('/test', 'TestController::index');
$routes->get('/group', 'TestController::group');
$routes->get('/permission', 'TestController::permission');
$routes->get('/permission_to_group', 'TestController::permissionToGroup');

$routes->group('', ['namespace' => 'App\Controllers\LandingPage'], function ($routes) {
    $routes->get('/', 'HomeController::index');
});
$routes->group('', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('/login', 'LoginController::loginView');
    $routes->post('/login_action', 'LoginController::loginAction');

    $routes->get('/logout', 'LogoutController::index');

});

$routes->group('', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {
    $routes->get('/dashboard', 'HomeController::index');
});
