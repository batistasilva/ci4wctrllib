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
$routes->get('/', 'Home::index');

// $routes->get('my-slug', 'Site::generateMySlug');
// $routes->get('my-users', 'UserCtrl::getUserID');
//
//...
/*
$routes->match(["get", "post"], "add-user", "UserCtrl::addUser");
$routes->match(["get", "post"], "save-useradd", "UserCtrl::saveUserAdd");
$routes->match(["get", "post"], "edit-user/(:num)", "UserCtrl::editUser/$1");
$routes->match(["get", "post"], "save-userupdt/(:num)", "UserCtrl::saveUserUpdt/$1");
$routes->get("list-users", "UserCtrl::listUsers");
$routes->get("delete-member/(:num)", "UserCtrl::deleteUser/$1");
*/
// CRUD RESTful Routes
$routes->get('users', 'UserCrud::users');
$routes->get('user-form', 'UserCrud::create');
$routes->post('submit-form', 'UserCrud::store');
$routes->get('edit-view/(:num)', 'UserCrud::singleUser/$1');
$routes->post('update', 'UserCrud::update');
$routes->get('delete/(:num)', 'UserCrud::delete/$1');


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Main::index');
$routes->get('main', 'Main::index');//For main page
//$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');
//$routes->get('(:any)', 'Pages::view/$1');
//$routes->get('cpny', 'CtrlCompany::index');
//$routes->get('users', 'CtrlCompany::index');
//$routes->add('cpnyedit/(:num)', 'CtrlCompany::viewCpnyId/$1');

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
