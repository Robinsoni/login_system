<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter' => 'isLoggedIn']); 
$routes->post('/login', 'LoginController::loginAction'); 
$routes->get('/login_failure', 'LoginController::loginFailure'); 
$routes->get('/home', 'Home::index',['filter' => 'isLoggedIn']);

service('auth')->routes($routes);
