<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// WEBSITE SECTION

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

// END WEBSITE SECTION

// AUTH SECTION

// login
$routes->get('/login', 'Auth\Auth::index');
$routes->post('/auth-login', 'Auth\Auth::authLogin');
// end login
// login
$routes->get('/register', 'Auth\Auth::register');
$routes->post('/auth-register', 'Auth\Auth::authRegister');
$routes->get('/verification', 'Auth\Auth::requestOtp');
$routes->post('/verify', 'Auth\Auth::verifyOtp');
$routes->get('/resend/(:any)', 'Auth\Auth::resendOtp/$1');
// end login
// logout
$routes->get('/logout', 'Auth\Auth::logOut');
// end logout
// Login Google
$routes->get('/auth-google', 'Auth\Auth::authGoogle');
$routes->get('/redirect-google', 'Auth\Auth::callbackGoogle');
// End Login Google
// Login Facebook
$routes->get('/auth-facebook', 'Auth\Auth::authFacebook');
$routes->get('/redirect-facebook', 'Auth\Auth::callbackFacebook');
// End Login Facebook
// Reset Password
$routes->get('/forgot-password', 'Auth\Auth::forgotPassword');
$routes->post('/recovery-password', 'Auth\Auth::recoveryPassword');
$routes->get('/reset-password', 'Auth\Auth::resetPassword');
$routes->put('/new-password/(:any)', 'Auth\Auth::newPassword/$1');
// End Reset Password

// Lockscreen
$routes->get('/lockscreen', 'Auth\Auth::lockScreen');
$routes->post('/unlock', 'Auth\Auth::unlock');
// End Lockscreen

// Check idle
$routes->get('/check-activity', 'Auth\Auth::checkActivity');
// End check idle

// End AUTH SECTION

// CMS SECTION

// USER

// General View
$routes->get('/(:segment)', 'Cms\General\General::index/$1', ['filter' => 'superadmin']);
// $routes->get('/dashboard', 'Cms\General\General::index');
// $routes->get('/user-management', 'Cms\MenuManagement\MenuManagement::index', ['filter' => 'superadmin']);
// End Dashboard User
// Menu Management
$routes->get('/menu-management/data-menu', 'Cms\MenuManagement\MenuManagement::dataMenu');
$routes->post('/menu-management/data-menu', 'Cms\MenuManagement\MenuManagement::dataMenu');
$routes->get('/menu-management/submenu', 'Cms\MenuManagement\MenuManagement::dataSubmenu');
$routes->post('/menu-management/submenu', 'Cms\MenuManagement\MenuManagement::dataSubmenu');
$routes->get('/menu-management/tabmenu', 'Cms\MenuManagement\MenuManagement::dataTabMenu');
$routes->post('/menu-management/tabmenu', 'Cms\MenuManagement\MenuManagement::dataTabMenu');
$routes->get('/menu-management/action-buttons', 'Cms\MenuManagement\MenuManagement::dtActionButtons');
$routes->post('/menu-management/admin/create', 'Cms\MenuManagement\MenuManagement::createMenu');
$routes->get('/menu-management/admin/edit', 'Cms\MenuManagement\MenuManagement::editMenu');
$routes->put('/menu-management/admin/edit', 'Cms\MenuManagement\MenuManagement::editMenu');
$routes->put('/menu-management/admin/(:segment)/(:any)', 'Cms\MenuManagement\MenuManagement::delMenu/$1/$2');
$routes->get('/(:segment)/(:segment)', 'Cms\General\General::index/$1/$2', ['filter' => 'superadmin']);
$routes->get('/(:segment)/(:segment)/(:segment)', 'Cms\General\General::index/$1/$2/$3', ['filter' => 'superadmin']);
// $routes->get('/(:segment)/(:segment)/(:segment)/(:any)', 'Cms\General\General::index/$1/$2/$3/$4', ['filter' => 'superadmin']);
// $routes->get('/menu-management/user', 'Cms\MenuManagement\MenuManagement::index', ['filter' => 'superadmin']);
// End Menu Management

// END USER

// ADMIN



// END ADMIN

// End CMS SECTION



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
