<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::Index');
//$routes->get('/', 'Home::index');


//$routes->get('/welcome', 'User::index');
$routes->get('/', 'Landing::landing');
$routes->get('/pembayaran', 'Payment::bayar');
$routes->post('/pembayaran/proses', 'Payment::proses');
$routes->get('/catalog', 'Catalog::home');
$routes->get('/', 'User::index', ['filter' => 'role:user']);
$routes->get('/', 'User::index', ['filter' => 'role:admin']);
$routes->get('/adm', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/adm/ruangan', 'Admin::daftar_ruangan', ['filter' => 'role:admin']);
$routes->get('/adm/(:num)', 'Admin::detail_user/$1', ['filter' => 'role:admin']);
$routes->get('/adm/daftar_transaksi', 'Admin::daftar_transaksi', ['filter' => 'role:admin']);
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/user', 'User::index', ['filter' => 'role:user']);
$routes->get('/user', 'User::index', ['filter' => 'role:admin']);
$routes->get('/user/rencana', 'User::rencana', ['filter' => 'role:user']);
$routes->get('/user/rencana', 'User::rencana', ['filter' => 'role:admin']);
$routes->get('/user/sewa', 'User::sewa', ['filter' => 'role:user']);
$routes->get('/user/sewa', 'User::sewa', ['filter' => 'role:admin']);
$routes->get('/user/sewa/getKetersediaanRuangan/(:segment)', 'User::getKetersediaanRuangan/$1', ['filter' => 'role:user']);
$routes->get('/user/sewa/getKetersediaanRuangan/(:segment)', 'User::getKetersediaanRuangan/$1', ['filter' => 'role:admin']);
$routes->get('/user/sewa/getNominalPerJam/(:segment)', 'User::getNominalPerJam/$1', ['filter' => 'role:user']);
$routes->get('/user/sewa/getNominalPerJam/(:segment)', 'User::getNominalPerJam/$1', ['filter' => 'role:admin']);
$routes->post('/user/simpanTransaksi', 'User::simpanTransaksi', ['filter' => 'role:user']);
$routes->post('/user/simpanTransaksi', 'User::simpanTransaksi', ['filter' => 'role:admin']);
$routes->get('/user/detailTransaksi/(:num)', 'User::detailTransaksi/$1', ['filter' => 'role:user']);
$routes->get('/user/detailTransaksi/(:num)', 'User::detailTransaksi/$1', ['filter' => 'role:admin']);
$routes->get('/pembayaran/berhasil/(:segment)', 'User::pembayaranBerhasil/$1');
$routes->post('/pembayaran/midtrans-notification', 'User::verifikasiPembayaran');
$routes->get('/user/transaksi/batalkan/(:num)', 'User::batalkanSewa/$1', ['filter' => 'role:user']);
$routes->get('/user/transaksi/batalkan/(:num)', 'User::batalkanSewa/$1', ['filter' => 'role:admin']);




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
