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

$routes->get('/dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers', 'filter' => 'auth']);


/*****
 * MASTER ROUTES
 * These routes handle all master data operations including:
 * - Gudang (Warehouse management)
 * - Satuan (Units of measurement)
 * - Kategori (Categories)
 * - Merk (Brands)
 * - Obat (Medicine/Drugs)
 * All routes are protected by auth filter
 ****/

// Gudang routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('gudang', 'Gudang::index');
    $routes->get('gudang/create', 'Gudang::create');
    $routes->post('gudang/store', 'Gudang::store');
    $routes->get('gudang/edit/(:num)', 'Gudang::edit/$1');
    $routes->post('gudang/update/(:num)', 'Gudang::update/$1');
    $routes->get('gudang/delete/(:num)', 'Gudang::delete/$1');
});

// Satuan routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('satuan', 'Satuan::index');
    $routes->get('satuan/create', 'Satuan::create');
    $routes->post('satuan/store', 'Satuan::store');
    $routes->get('satuan/edit/(:num)', 'Satuan::edit/$1');
    $routes->post('satuan/update/(:num)', 'Satuan::update/$1');
    $routes->get('satuan/delete/(:num)', 'Satuan::delete/$1');
});

// Kategori routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('kategori', 'Kategori::index');
    $routes->get('kategori/create', 'Kategori::create');
    $routes->post('kategori/store', 'Kategori::store');
    $routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
    $routes->post('kategori/update/(:num)', 'Kategori::update/$1');
    $routes->get('kategori/delete/(:num)', 'Kategori::delete/$1');
});

// Merk routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('merk', 'Merk::index');
    $routes->get('merk/create', 'Merk::create');
    $routes->post('merk/store', 'Merk::store');
    $routes->get('merk/edit/(:num)', 'Merk::edit/$1');
    $routes->post('merk/update/(:num)', 'Merk::update/$1');
    $routes->get('merk/delete/(:num)', 'Merk::delete/$1');
});

// Obat routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('obat', 'Obat::index');
    $routes->get('obat/create', 'Obat::create');
    $routes->post('obat/store', 'Obat::store'); 
    $routes->get('obat/edit/(:num)', 'Obat::edit/$1');
    $routes->post('obat/update/(:num)', 'Obat::update/$1');
    $routes->get('obat/delete/(:num)', 'Obat::delete/$1');
    $routes->get('obat/trash', 'Obat::trash');
    $routes->get('obat/restore/(:num)', 'Obat::restore/$1');
    $routes->post('obat/item_ref_save/(:num)', 'Obat::item_ref_save/$1');
    $routes->get('obat/item_ref_delete/(:num)', 'Obat::item_ref_delete/$1');
    $routes->get('obat/export', 'Obat::xls_items');
});

// Tindakan routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('tindakan', 'Tindakan::index');
    $routes->get('tindakan/create', 'Tindakan::create');
    $routes->post('tindakan/store', 'Tindakan::store');
    $routes->get('tindakan/edit/(:num)', 'Tindakan::edit/$1');
    $routes->post('tindakan/update/(:num)', 'Tindakan::update/$1');
    $routes->get('tindakan/delete/(:num)', 'Tindakan::delete/$1');
    $routes->get('tindakan/delete_permanent/(:num)', 'Tindakan::delete_permanent/$1');
    $routes->get('tindakan/trash', 'Tindakan::trash');
    $routes->get('tindakan/restore/(:num)', 'Tindakan::restore/$1');
    $routes->get('tindakan/export', 'Tindakan::xls_items');
    $routes->post('tindakan/item_ref_save/(:num)', 'Tindakan::item_ref_save/$1');
    $routes->get('tindakan/item_ref_delete/(:num)', 'Tindakan::item_ref_delete/$1');
});

// Lab routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('lab', 'Lab::index');
    $routes->get('lab/create', 'Lab::create');
    $routes->post('lab/store', 'Lab::store');
    $routes->get('lab/edit/(:num)', 'Lab::edit/$1');
    $routes->post('lab/update/(:num)', 'Lab::update/$1');
    $routes->get('lab/delete/(:num)', 'Lab::delete/$1');
    $routes->get('lab/trash', 'Lab::trash');
    $routes->get('lab/restore/(:num)', 'Lab::restore/$1');
    $routes->get('lab/delete_permanent/(:num)', 'Lab::delete_permanent/$1');
    $routes->post('lab/item_ref_save/(:num)', 'Radiologi::item_ref_save/$1');
    $routes->get('lab/item_ref_delete/(:num)', 'Radiologi::item_ref_delete/$1');
    $routes->post('lab/item_lab_save/(:num)', 'Lab::item_lab_save/$1');
    $routes->get('lab/item_lab_delete/(:num)', 'Lab::item_lab_delete/$1');
    $routes->get('lab/export', 'Lab::xls_items');
});

// Radiologi routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('radiologi', 'Radiologi::index');
    $routes->get('radiologi/create', 'Radiologi::create');
    $routes->post('radiologi/store', 'Radiologi::store');
    $routes->get('radiologi/edit/(:num)', 'Radiologi::edit/$1');
    $routes->post('radiologi/update/(:num)', 'Radiologi::update/$1');
    $routes->get('radiologi/delete/(:num)', 'Radiologi::delete/$1');
    $routes->get('radiologi/trash', 'Radiologi::trash');
    $routes->get('radiologi/restore/(:num)', 'Radiologi::restore/$1');
    $routes->get('radiologi/delete_permanent/(:num)', 'Radiologi::delete_permanent/$1');
    $routes->get('radiologi/export', 'Radiologi::xls_items');
    $routes->post('radiologi/item_ref_save/(:num)', 'Radiologi::item_ref_save/$1');
    $routes->get('radiologi/item_ref_delete/(:num)', 'Radiologi::item_ref_delete/$1');
});

// BHP routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('bhp', 'BHP::index');
    $routes->get('bhp/create', 'BHP::create');
    $routes->post('bhp/store', 'BHP::store');
    $routes->get('bhp/edit/(:num)', 'BHP::edit/$1');
    $routes->post('bhp/update/(:num)', 'BHP::update/$1');
    $routes->get('bhp/delete/(:num)', 'BHP::delete/$1');
    $routes->get('bhp/trash', 'BHP::trash');
    $routes->get('bhp/restore/(:num)', 'BHP::restore/$1');
    $routes->get('bhp/delete_permanent/(:num)', 'BHP::delete_permanent/$1');
    $routes->post('bhp/item_ref_save/(:num)', 'BHP::item_ref_save/$1');
    $routes->get('bhp/item_ref_delete/(:num)', 'BHP::item_ref_delete/$1');
    $routes->get('bhp/export', 'BHP::xls_items');
});

// Poli routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('poli', 'Poli::index');
    $routes->get('poli/create', 'Poli::create');
    $routes->post('poli/store', 'Poli::store');
    $routes->get('poli/edit/(:num)', 'Poli::edit/$1');
    $routes->post('poli/update/(:num)', 'Poli::update/$1');
    $routes->get('poli/delete/(:num)', 'Poli::delete/$1');
});

// Gelar routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('gelar', 'Gelar::index');
    $routes->get('gelar/create', 'Gelar::create');
    $routes->post('gelar/store', 'Gelar::store');
    $routes->get('gelar/edit/(:num)', 'Gelar::edit/$1');
    $routes->post('gelar/update/(:num)', 'Gelar::update/$1');
    $routes->get('gelar/delete/(:num)', 'Gelar::delete/$1');
});

// Pasien routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('pasien', 'Pasien::index');
    $routes->get('pasien/create', 'Pasien::create');
    $routes->post('pasien/store', 'Pasien::store');
    $routes->get('pasien/edit/(:num)', 'Pasien::edit/$1');
    $routes->post('pasien/update/(:num)', 'Pasien::update/$1');
    $routes->get('pasien/detail/(:num)', 'Pasien::detail/$1');
    $routes->get('pasien/delete/(:num)', 'Pasien::delete/$1');
    $routes->get('pasien/trash', 'Pasien::trash');
    $routes->get('pasien/restore/(:num)', 'Pasien::restore/$1');
    $routes->get('pasien/delete_permanent/(:num)', 'Pasien::delete_permanent/$1');
    $routes->get('pasien/reset_user/(:num)', 'Pasien::resetUser/$1');
    $routes->get('pasien/create_user/(:num)', 'Pasien::createUser/$1');
    $routes->get('pasien/delete_photo/(:num)', 'Pasien::deletePhoto/$1');
});

// Karyawan Routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function($routes) {
    $routes->get('karyawan', 'Karyawan::index');
    $routes->get('karyawan/create', 'Karyawan::create');
    $routes->post('karyawan/store', 'Karyawan::store');
    $routes->get('karyawan/edit/(:num)', 'Karyawan::edit/$1');
    $routes->post('karyawan/update/(:num)', 'Karyawan::update/$1');
    $routes->get('karyawan/delete/(:num)', 'Karyawan::delete/$1');
    $routes->get('karyawan/detail/(:num)', 'Karyawan::detail/$1');
});

// Supplier Routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function($routes) {
    $routes->get('supplier', 'Supplier::index');
    $routes->get('supplier/create', 'Supplier::create');
    $routes->post('supplier/store', 'Supplier::store');
    $routes->get('supplier/edit/(:num)', 'Supplier::edit/$1');
    $routes->post('supplier/update/(:num)', 'Supplier::update/$1');
    $routes->get('supplier/delete/(:num)', 'Supplier::delete/$1');
    $routes->get('supplier/detail/(:num)', 'Supplier::detail/$1');
    $routes->get('supplier/trash', 'Supplier::trash');
});

// ICD Routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function($routes) {
    $routes->get('icd', 'Icd::index');
    $routes->get('icd/create', 'Icd::create');
    $routes->post('icd/store', 'Icd::store');
    $routes->get('icd/edit/(:num)', 'Icd::edit/$1');
    $routes->post('icd/update/(:num)', 'Icd::update/$1');
    $routes->get('icd/delete/(:num)', 'Icd::delete/$1');
    $routes->get('icd/detail/(:num)', 'Icd::detail/$1');
});

// Kamar Routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function($routes) {
    $routes->get('kamar', 'Kamar::index');
    $routes->get('kamar/create', 'Kamar::create');
    $routes->post('kamar/store', 'Kamar::store');
    $routes->get('kamar/edit/(:num)', 'Kamar::edit/$1');
    $routes->post('kamar/update/(:num)', 'Kamar::update/$1');
    $routes->get('kamar/delete/(:num)', 'Kamar::delete/$1');
    $routes->get('kamar/detail/(:num)', 'Kamar::detail/$1');
});

// Penjamin routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function ($routes) {
    $routes->get('penjamin', 'Penjamin::index');
    $routes->get('penjamin/create', 'Penjamin::create');
    $routes->post('penjamin/store', 'Penjamin::store');
    $routes->get('penjamin/edit/(:num)', 'Penjamin::edit/$1');
    $routes->post('penjamin/update/(:num)', 'Penjamin::update/$1');
    $routes->get('penjamin/delete/(:num)', 'Penjamin::delete/$1');
});

// Platform Routes
$routes->group('master', ['namespace' => 'App\Controllers\Master', 'filter' => 'auth'], function($routes) {
    $routes->get('platform', 'Platform::index');
    $routes->get('platform/create', 'Platform::create');
    $routes->post('platform/store', 'Platform::store');
    $routes->get('platform/edit/(:num)', 'Platform::edit/$1');
    $routes->post('platform/update/(:num)', 'Platform::update/$1');
    $routes->get('platform/delete/(:num)', 'Platform::delete/$1');
    $routes->get('platform/detail/(:num)', 'Platform::detail/$1');
});

/** END MASTER **/

/*
 * TRANSAKSI ROUTES
 */
// Purchase Order Routes
$routes->group('transaksi', ['namespace' => 'App\Controllers\Transaksi', 'filter' => 'auth'], function($routes) {
    $routes->get('po', 'TransBeliPO::index');
    $routes->get('po/create', 'TransBeliPO::create');
    $routes->post('po/store', 'TransBeliPO::store');
    $routes->get('po/detail/(:num)', 'TransBeliPO::detail/$1');
    $routes->get('po/edit/(:num)', 'TransBeliPO::edit/$1');
    $routes->post('po/update/(:num)', 'TransBeliPO::update/$1');
    $routes->get('po/print/(:num)', 'TransBeliPO::pdf_po/$1');
    $routes->post('po/cart_add/(:num)', 'TransBeliPO::cart_add/$1');
    $routes->post('po/update-status/(:num)', 'TransBeliPO::updateStatus/$1');
});
/** END MASTER **/

/*
 * GUDANG ROUTES
 */
// Stock Routes
$routes->group('stock', ['namespace' => 'App\Controllers\Gudang', 'filter' => 'auth'], function($routes) {
    $routes->get('items', 'Stock::items');
    $routes->get('items/history/(:num)', 'Stock::history/$1');
    $routes->get('items/detail/(:num)', 'Stock::detail/$1');
    $routes->post('items/update/(:num)', 'Stock::update/$1');
});

/** END GUDANG **/

// Pengaturan routes
$routes->group('pengaturan', ['filter' => 'auth'], function ($routes) {
    $routes->get('app', 'Pengaturan::index');
    $routes->post('app/update', 'Pengaturan::update');
});


// Public API routes
$routes->group('publik', function ($routes) {
    $routes->get('items', 'Publik::getItems');
    $routes->get('items_stock', 'Publik::getItemsStock');
});
?>