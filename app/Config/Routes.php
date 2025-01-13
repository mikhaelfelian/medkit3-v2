<?php

use CodeIgniter\Router\RouteCollection;
$routes->setAutoRoute(true);

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


// Master routes
// These routes handle all master data operations including:
// - Gudang (Warehouse management)
// - Satuan (Units of measurement)
// - Kategori (Categories)
// - Merk (Brands)
// - Obat (Medicine/Drugs)
// All routes are protected by auth filter

// Gudang routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/gudang', 'Gudang::index');
    $routes->get('/master/gudang/create', 'Gudang::create');
    $routes->post('/master/gudang/store', 'Gudang::store');
    $routes->get('/master/gudang/edit/(:num)', 'Gudang::edit/$1');
    $routes->post('/master/gudang/update/(:num)', 'Gudang::update/$1');
    $routes->get('/master/gudang/delete/(:num)', 'Gudang::delete/$1');
});

// Satuan routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/satuan', 'Satuan::index');
    $routes->get('/master/satuan/create', 'Satuan::create');
    $routes->post('/master/satuan/store', 'Satuan::store');
    $routes->get('/master/satuan/edit/(:num)', 'Satuan::edit/$1');
    $routes->post('/master/satuan/update/(:num)', 'Satuan::update/$1');
    $routes->get('/master/satuan/delete/(:num)', 'Satuan::delete/$1');
});

// Kategori routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/kategori', 'Kategori::index');
    $routes->get('/master/kategori/create', 'Kategori::create');
    $routes->post('/master/kategori/store', 'Kategori::store');
    $routes->get('/master/kategori/edit/(:num)', 'Kategori::edit/$1');
    $routes->post('/master/kategori/update/(:num)', 'Kategori::update/$1');
    $routes->get('/master/kategori/delete/(:num)', 'Kategori::delete/$1');
});

// Merk routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/merk', 'Merk::index');
    $routes->get('/master/merk/create', 'Merk::create');
    $routes->post('/master/merk/store', 'Merk::store');
    $routes->get('/master/merk/edit/(:num)', 'Merk::edit/$1');
    $routes->post('/master/merk/update/(:num)', 'Merk::update/$1');
    $routes->get('/master/merk/delete/(:num)', 'Merk::delete/$1');
});

// Obat routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/obat', 'Obat::index');
    $routes->get('/master/obat/create', 'Obat::create');
    $routes->post('/master/obat/store', 'Obat::store'); 
    $routes->get('/master/obat/edit/(:num)', 'Obat::edit/$1');
    $routes->post('/master/obat/update/(:num)', 'Obat::update/$1');
    $routes->get('/master/obat/delete/(:num)', 'Obat::delete/$1');
    $routes->get('/master/obat/trash', 'Obat::trash');
    $routes->get('/master/obat/restore/(:num)', 'Obat::restore/$1');
    $routes->post('/master/obat/item_ref_save/(:num)', 'Obat::item_ref_save/$1');
    $routes->get('/master/obat/item_ref_delete/(:num)', 'Obat::item_ref_delete/$1');
    $routes->get('/master/obat/export', 'Obat::xls_items');
});

// Tindakan routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/tindakan', 'Tindakan::index');
    $routes->get('/master/tindakan/create', 'Tindakan::create');
    $routes->post('/master/tindakan/store', 'Tindakan::store');
    $routes->get('/master/tindakan/edit/(:num)', 'Tindakan::edit/$1');
    $routes->post('/master/tindakan/update/(:num)', 'Tindakan::update/$1');
    $routes->get('/master/tindakan/delete/(:num)', 'Tindakan::delete/$1');
    $routes->get('/master/tindakan/delete_permanent/(:num)', 'Tindakan::delete_permanent/$1');
    $routes->get('/master/tindakan/trash', 'Tindakan::trash');
    $routes->get('/master/tindakan/restore/(:num)', 'Tindakan::restore/$1');
    $routes->get('/master/tindakan/export', 'Tindakan::xls_items');
    $routes->post('/master/tindakan/item_ref_save/(:num)', 'Tindakan::item_ref_save/$1');
    $routes->get('/master/tindakan/item_ref_delete/(:num)', 'Tindakan::item_ref_delete/$1');
});

// Radiologi routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/radiologi', 'Radiologi::index');
    $routes->get('/master/radiologi/create', 'Radiologi::create');
    $routes->post('/master/radiologi/store', 'Radiologi::store');
    $routes->get('/master/radiologi/edit/(:num)', 'Radiologi::edit/$1');
    $routes->post('/master/radiologi/update/(:num)', 'Radiologi::update/$1');
    $routes->get('/master/radiologi/delete/(:num)', 'Radiologi::delete/$1');
    $routes->get('/master/radiologi/trash', 'Radiologi::trash');
    $routes->get('/master/radiologi/restore/(:num)', 'Radiologi::restore/$1');
    $routes->get('/master/radiologi/delete_permanent/(:num)', 'Radiologi::delete_permanent/$1');
    $routes->get('/master/radiologi/export', 'Radiologi::xls_items');
    $routes->post('/master/radiologi/item_ref_save/(:num)', 'Radiologi::item_ref_save/$1');
    $routes->get('/master/radiologi/item_ref_delete/(:num)', 'Radiologi::item_ref_delete/$1');
});

// BHP routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/bhp', 'BHP::index');
    $routes->get('/master/bhp/create', 'BHP::create');
    $routes->post('/master/bhp/store', 'BHP::store');
    $routes->get('/master/bhp/edit/(:num)', 'BHP::edit/$1');
    $routes->post('/master/bhp/update/(:num)', 'BHP::update/$1');
    $routes->get('/master/bhp/delete/(:num)', 'BHP::delete/$1');
    $routes->get('/master/bhp/trash', 'BHP::trash');
    $routes->get('/master/bhp/restore/(:num)', 'BHP::restore/$1');
    $routes->get('/master/bhp/delete_permanent/(:num)', 'BHP::delete_permanent/$1');
    $routes->post('/master/bhp/item_ref_save/(:num)', 'BHP::item_ref_save/$1');
    $routes->get('/master/bhp/item_ref_delete/(:num)', 'BHP::item_ref_delete/$1');
    $routes->get('/master/bhp/export', 'BHP::xls_items');
});

// Pengaturan routes
$routes->group('pengaturan', ['filter' => 'auth'], function ($routes) {
    $routes->get('app', 'Pengaturan::index');
    $routes->post('app/update', 'Pengaturan::update');
});

// Public API routes
$routes->group('publik', function ($routes) {
    $routes->get('items', 'Publik::getItems');
});

// BHP routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/bhp', 'BHP::index');
    $routes->get('/master/bhp/create', 'BHP::create');
    $routes->post('/master/bhp/store', 'BHP::store');
    $routes->get('/master/bhp/edit/(:num)', 'BHP::edit/$1');
    $routes->post('/master/bhp/update/(:num)', 'BHP::update/$1');
    $routes->get('/master/bhp/delete/(:num)', 'BHP::delete/$1');
    $routes->get('/master/bhp/trash', 'BHP::trash');
    $routes->get('/master/bhp/restore/(:num)', 'BHP::restore/$1');
    $routes->get('/master/bhp/delete_permanent/(:num)', 'BHP::delete_permanent/$1');
    $routes->post('/master/bhp/item_ref_save/(:num)', 'BHP::item_ref_save/$1');
    $routes->get('/master/bhp/item_ref_delete/(:num)', 'BHP::item_ref_delete/$1');
    $routes->get('/master/bhp/export', 'BHP::xls_items');
});

// Poli routes
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('/master/poli', 'Poli::index');
    $routes->get('/master/poli/create', 'Poli::create');
    $routes->post('/master/poli/store', 'Poli::store');
    $routes->get('/master/poli/edit/(:num)', 'Poli::edit/$1');
    $routes->post('/master/poli/update/(:num)', 'Poli::update/$1');
    $routes->get('/master/poli/delete/(:num)', 'Poli::delete/$1');
});
