<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

$routes->get('/', 'OAuth::login');
$routes->get('auth/login', 'OAuth::login');
$routes->post('auth/proses_login', 'OAuth::proses_login');

$routes->get('auth/register', 'OAuth::register');
$routes->post('auth/proses_register', 'OAuth::proses_register');

$routes->get('auth/logout', 'OAuth::logout');

$routes->get('dashboard', 'Dashboard::index');

//Categories
$routes->get('category', 'Category::index');
$routes->get('category/create', 'Category::create');
$routes->get('category/store', 'Category::store');
$routes->get('category/edit', 'Category::edit');
$routes->get('category/delete', 'Category::delete');

//Products
$routes->get('product', 'Product::index');
$routes->get('product/create', 'Product::create');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
