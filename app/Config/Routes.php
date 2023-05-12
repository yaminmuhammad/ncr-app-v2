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

// LOGIN
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');

$routes->get('/ncr_form', 'Ncr::create_ncr', ['filter' => 'auth']);
$routes->post('/ncr/save', 'Ncr::save', ['filter' => 'auth']);
$routes->get('/home/edit/(:segment)', 'Ncr::edit/$1');
$routes->get('/home', 'Ncr::index_ncr', ['filter' => 'auth']);
$routes->get('/home/(:any)', 'Ncr::detail_ncr/$1', ['filter' => 'auth']);
$routes->get('/print/(:any)', 'Ncr::printToExcel/$1', ['filter' => 'auth']);
$routes->get('/send/(:any)', 'Ncr::sendEmail/$1', ['filter' => 'auth']);
$routes->post('/home/update/(:any)', 'Ncr::update_ncr/$1', ['filter' => 'auth']);
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
