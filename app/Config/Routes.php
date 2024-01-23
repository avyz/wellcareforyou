<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Website Section
// Home
$routes->get('/', 'Website\Home\Home::index');
$routes->get('/terms-conditions', 'Website\Home\Home::terms');
$routes->get('/privacy-policy', 'Website\Home\Home::privacy');
// End Home
// About
$routes->get('/about', 'Website\About\About::index');
// End About
// NewsBlog
$routes->get('/news-blog', 'Website\NewsBlog\NewsBlog::index');
$routes->get('/news-blog/detail/(:num)/(:num)/(:num)/(:any)', 'Website\NewsBlog\NewsBlog::detail/$1/$2/$3/$4');
// End NewsBlog
// Hospitals
$routes->get('/hospitals', 'Website\Hospitals\Hospitals::index');
$routes->get('/hospitals/package/(:any)/(:any)', 'Website\Hospitals\Hospitals::package/$1/$2');
$routes->get('/hospitals/(:any)', 'Website\Hospitals\Hospitals::single/$1');
// End Hospitals
// Doctors
$routes->get('/doctors', 'Website\Doctors\Doctors::index');
$routes->get('/doctors/specialists/(:any)', 'Website\Doctors\Doctors::index/$1');
$routes->get('/doctors/profile/(:any)', 'Website\Doctors\Doctors::profile/$1');
$routes->get('/doctors/appointment/(:any)', 'Website\Doctors\Doctors::appointment/$1');
// End Doctors
// Pharmacies
$routes->get('/pharmacies', 'Website\Pharmacies\Pharmacies::index');
// End Pharmacies
// Specialists
$routes->get('/specialists', 'Website\Specialists\Specialists::index');
// End Specialists
// Contact
$routes->get('/contact-us', 'Website\Contact\Contact::index');
// End Contact
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
