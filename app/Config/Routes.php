<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Website Section
// Home
$routes->get('/', 'Website\Home\Home::index');
// End Home
// About
$routes->get('/about', 'Website\About\About::index');
// End About
// End Website Section



// $routes->get('/item', 'Pages\Pages::item');
// $routes->get('/item/(:alpha)/(:num)', 'Pages\Pages::item/$1/$2');
// $routes->get('/about', 'Pages\Pages::about');
// $routes->get('/contact', 'Pages\Pages::contact');
// $routes->get('/comics', 'Pages\Pages::comics');
// $routes->get('/comics/view/(:any)', 'Pages\Pages::view/$1');
// $routes->get('/comics/view/(:any)/(:any)', 'Pages\Pages::view/$1/$2');
// $routes->post('/comics/save', 'Pages\Pages::save');
// $routes->put('/comics/edit', 'Pages\Pages::edit');
// $routes->delete('/comics/(:num)/(:any)', 'Pages\Pages::delete/$1/$2');
// $routes->get('/comics/(:any)', 'Pages\Pages::detail/$1');

// People
// $routes->get('/people', 'Pages\People::index');
