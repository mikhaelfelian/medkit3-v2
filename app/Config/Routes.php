<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', to: 'Auth::index');

// Auth routes
$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->match(['get', 'post'], 'login', 'Auth::login');
    $routes->post('cek_login', 'Auth::cek_login');
    $routes->get('logout', 'Auth::logout');
    $routes->match(['get', 'post'], 'forgot_password', 'Auth::forgot_password');
});

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Satuan routes
$routes->group('satuan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Satuan::index');
    $routes->get('create', 'Satuan::create');
    $routes->post('store', 'Satuan::store');
    $routes->get('edit/(:num)', 'Satuan::edit/$1');
    $routes->post('update/(:num)', 'Satuan::update/$1');
    $routes->get('delete/(:num)', 'Satuan::delete/$1');
    $routes->post('toggle/(:num)', 'Satuan::toggle/$1');
});

// Pengaturan routes
$routes->group('pengaturan', ['filter' => 'auth'], function ($routes) {
    $routes->get('app', 'Pengaturan::index');
    $routes->post('app/update', 'Pengaturan::update');
});
