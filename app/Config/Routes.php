<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// WEBSITE SECTION

// Home
$routes->get('/', 'Website\Home\Home::index');

// About
$routes->get('/page/about/edit-content', 'Website\About\About::editContentAbout');
$routes->post('/page/about/edit-content', 'Website\About\About::editContentAbout');
// $routes->get('/terms-conditions', 'Website\Home\Home::terms');
// $routes->get('/privacy-policy', 'Website\Home\Home::privacy');
// End Home
// About
// $routes->get('/about-us', 'Website\About\About::index');
// End About
// NewsBlog
// $routes->get('/news-blog', 'Website\NewsBlog\NewsBlog::index');
// $routes->get('/news-blog/detail/(:num)/(:num)/(:num)/(:any)', 'Website\NewsBlog\NewsBlog::detail/$1/$2/$3/$4');
// End NewsBlog
// Hospitals
// $routes->get('/hospitals', 'Website\Hospitals\Hospitals::index');
// $routes->get('/hospitals/package/(:any)/(:any)', 'Website\Hospitals\Hospitals::package/$1/$2');
// $routes->get('/hospitals/(:any)', 'Website\Hospitals\Hospitals::single/$1');
// End Hospitals
// Doctors
// $routes->get('/doctors', 'Website\Doctors\Doctors::index');
// $routes->get('/doctors/specialists/(:any)', 'Website\Doctors\Doctors::index/$1');
// $routes->get('/doctors/profile/(:any)', 'Website\Doctors\Doctors::profile/$1');
// $routes->get('/doctors/appointment/(:any)', 'Website\Doctors\Doctors::appointment/$1');
// End Doctors
// Pharmacies
// $routes->get('/pharmacies', 'Website\Pharmacies\Pharmacies::index');
// End Pharmacies
// Specialists
// $routes->get('/specialists', 'Website\Specialists\Specialists::index');
// End Specialists
// Contact
// $routes->get('/contact-us', 'Website\Contact\Contact::index');
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

// ADMIN

// $routes->get('/dashboard', 'Cms\General\General::index');
// $routes->get('/user-management', 'Cms\MenuManagement\MenuManagement::index', ['filter' => 'superadmin']);
// End Dashboard User
// Menu Management
$routes->get('/menu-management/data-menu', 'Cms\MenuManagement\MenuManagement::dataMenu');
// $routes->post('/menu-management/data-menu', 'Cms\MenuManagement\MenuManagement::dataMenu');
// $routes->get('/menu-management/data-menu-user', 'Cms\MenuManagement\MenuManagement::dataMenuUser');
$routes->get('/menu-management/data-menu-management', 'Cms\MenuManagement\MenuManagement::dataDropdownMenu');
// $routes->get('/menu-management/data-menu-management-user', 'Cms\MenuManagement\MenuManagement::dataDropdownMenuUser');
$routes->get('/menu-management/submenu', 'Cms\MenuManagement\MenuManagement::dataSubmenu');
// $routes->post('/menu-management/submenu', 'Cms\MenuManagement\MenuManagement::dataSubmenu');
// $routes->get('/menu-management/submenu-user', 'Cms\MenuManagement\MenuManagement::dataSubmenuUser');
$routes->get('/menu-management/tabmenu', 'Cms\MenuManagement\MenuManagement::dataTabMenu');
// $routes->post('/menu-management/tabmenu', 'Cms\MenuManagement\MenuManagement::dataTabMenu');
// $routes->get('/menu-management/tabmenu-user', 'Cms\MenuManagement\MenuManagement::dataTabMenuUser');
$routes->get('/menu-management/action-buttons', 'Cms\General\General::dtActionButtons');

// Menu CRUD
// Admin
$routes->get('/menu-management/admin/edit', 'Cms\MenuManagement\MenuManagement::editMenu');
$routes->post('/menu-management/admin/create', 'Cms\MenuManagement\MenuManagement::createMenu');
$routes->put('/menu-management/admin/edit', 'Cms\MenuManagement\MenuManagement::editMenu');
// User
// $routes->get('/menu-management/user/edit', 'Cms\MenuManagement\MenuManagement::editMenuUser');
// $routes->post('/menu-management/user/create', 'Cms\MenuManagement\MenuManagement::createMenuUser');
// $routes->put('/menu-management/user/edit', 'Cms\MenuManagement\MenuManagement::editMenuUser');
// End Menu CRUD

// Submenu CRUD
// Admin
$routes->get('/menu-management/admin/edit-submenu', 'Cms\MenuManagement\MenuManagement::editSubmenu');
$routes->post('/menu-management/admin/create-submenu', 'Cms\MenuManagement\MenuManagement::createSubmenu');
$routes->put('/menu-management/admin/edit-submenu', 'Cms\MenuManagement\MenuManagement::editSubmenu');
// User 
// $routes->get('/menu-management/user/edit-submenu', 'Cms\MenuManagement\MenuManagement::editSubmenuUser');
// $routes->post('/menu-management/user/create-submenu', 'Cms\MenuManagement\MenuManagement::createSubmenuUser');
// $routes->put('/menu-management/user/edit-submenu', 'Cms\MenuManagement\MenuManagement::editSubmenuUser');
// End Submenu CRUD

// Tabmenu CRUD
// Admin
$routes->get('/menu-management/admin/edit-tabmenu', 'Cms\MenuManagement\MenuManagement::editTabMenu');
$routes->post('/menu-management/admin/create-tabmenu', 'Cms\MenuManagement\MenuManagement::createTabMenu');
$routes->put('/menu-management/admin/edit-tabmenu', 'Cms\MenuManagement\MenuManagement::editTabMenu');
// User
// $routes->get('/menu-management/user/edit-tabmenu', 'Cms\MenuManagement\MenuManagement::editTabMenuUser');
// $routes->post('/menu-management/user/create-tabmenu', 'Cms\MenuManagement\MenuManagement::createTabMenuUser');
// $routes->put('/menu-management/user/edit-tabmenu', 'Cms\MenuManagement\MenuManagement::editTabMenuUser');
// End Tabmenu CRUD

$routes->delete('/menu-management/admin/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// $routes->delete('/menu-management/user/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// $routes->get('/(:segment)/(:segment)/(:segment)/(:any)', 'Cms\General\General::index/$1/$2/$3/$4', ['filter' => 'superadmin']);
// $routes->get('/menu-management/user', 'Cms\MenuManagement\MenuManagement::index', ['filter' => 'superadmin']);
// End Menu Management

// User Management
// User
$routes->get('/user-management/data-user', 'Cms\UserManagement\UserManagement::dataUser');
$routes->post('/user-management/users/create-user', 'Cms\UserManagement\UserManagement::createUser');
$routes->get('/user-management/users/edit-user', 'Cms\UserManagement\UserManagement::editUser');
$routes->put('/user-management/users/edit-user', 'Cms\UserManagement\UserManagement::editUser');

// Role
$routes->get('/user-management/data-role', 'Cms\UserManagement\UserManagement::dataRole');
$routes->get('/user-management/management/roles/menu', 'Cms\UserManagement\UserManagement::viewMenuManagementRole');
$routes->get('/user-management/management/roles/submenu', 'Cms\UserManagement\UserManagement::viewMenuManagementRoleChild');
$routes->get('/user-management/management/roles/tabmenu', 'Cms\UserManagement\UserManagement::viewMenuManagementRoleChildTab');
$routes->post('/user-management/roles/create-role', 'Cms\UserManagement\UserManagement::createRole');
$routes->post('/user-management/create-menu-management-role', 'Cms\UserManagement\UserManagement::createMenuManagementRole');
$routes->post('/user-management/create-menu-management-role-child', 'Cms\UserManagement\UserManagement::createMenuManagementRoleChild');
$routes->post('/user-management/create-menu-management-role-child-tab', 'Cms\UserManagement\UserManagement::createMenuManagementRoleChildTab');
$routes->get('/user-management/roles/edit-role', 'Cms\UserManagement\UserManagement::editRole');
$routes->put('/user-management/roles/edit-role', 'Cms\UserManagement\UserManagement::editRole');
$routes->post('/user-management/roles/edit-menu-management-role', 'Cms\UserManagement\UserManagement::editMenuManagementRole');
$routes->post('/user-management/roles/edit-menu-management-role-child', 'Cms\UserManagement\UserManagement::editMenuManagementChildRole');
$routes->post('/user-management/roles/edit-menu-management-role-child-tab', 'Cms\UserManagement\UserManagement::editMenuManagementChildTabRole');
$routes->put('/user-management/roles/edit-menu-management-role', 'Cms\UserManagement\UserManagement::editMenuManagementRole');
$routes->put('/user-management/roles/edit-menu-management-child-role', 'Cms\UserManagement\UserManagement::editMenuManagementChildRole');
$routes->put('/user-management/roles/edit-menu-management-child-tab-role', 'Cms\UserManagement\UserManagement::editMenuManagementChildTabRole');
// Dropdown Role
$routes->get('/user-management/data-dropdown-role', 'Cms\UserManagement\UserManagement::dataDropdownRole');

// Log User
$routes->get('/user-management/data-log-user', 'Cms\UserManagement\UserManagement::dataLogUser');

// Log Auth
$routes->get('/user-management/data-log-auth', 'Cms\UserManagement\UserManagement::dataLogAuth');

// Delete
$routes->delete('/user-management/user-management/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// End User Management

// Settings
// Language
$routes->get('/setting/data-language', 'Cms\Settings\Language::dataLanguage');
$routes->get('/setting/search-language', 'Cms\Settings\Language::searchDataLanguage');
$routes->get('/setting/data-language-for-tags', 'Cms\Settings\Language::getDataLanguageForTags');
$routes->post('/setting/create-language', 'Cms\Settings\Language::createLanguage');
$routes->get('/setting/edit-language', 'Cms\Settings\Language::editLanguage');
$routes->post('/setting/edit-language', 'Cms\Settings\Language::editLanguage');
// Country
$routes->get('/setting/data-country', 'Cms\Settings\Country::dataCountry');
$routes->get('/setting/search-country', 'Cms\Settings\Country::searchDataCountry');
$routes->get('/setting/data-country-for-tags', 'Cms\Settings\Country::getDataCountryForTags');
$routes->post('/setting/create-country', 'Cms\Settings\Country::createCountry');
$routes->get('/setting/edit-country', 'Cms\Settings\Country::editCountry');
$routes->post('/setting/edit-country', 'Cms\Settings\Country::editCountry');
$routes->delete('/setting/country/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// End Settings

// Pages
$routes->get('/pages/data-navbar', 'Cms\Pages\Pages::dataPages');
$routes->post('/pages/create-navbar', 'Cms\Pages\Pages::createPages');
$routes->get('/pages/edit-navbar', 'Cms\Pages\Pages::editPages');
$routes->put('/pages/edit-navbar', 'Cms\Pages\Pages::editPages');
$routes->delete('/pages/pages/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// End Pages

// Group Pages
$routes->get('/group-pages/data-navbar', 'Cms\Pages\GroupPages::dataGroupPages');
$routes->get('/pages/group-pages/page-list', 'Cms\Pages\GroupPages::viewGroupPagesList');
$routes->post('/pages/create-group-pages-list', 'Cms\Pages\GroupPages::createGroupPagesList');
$routes->post('/group-pages/create-navbar', 'Cms\Pages\GroupPages::createGroupPages');
$routes->get('/group-pages/edit-navbar', 'Cms\Pages\GroupPages::editGroupPages');
$routes->put('/group-pages/edit-navbar', 'Cms\Pages\GroupPages::editGroupPages');
$routes->delete('/pages/group-pages/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// End Group Pages

// MISC
$routes->get('/setting/misc', 'Cms\Settings\Misc::viewDataMisc');
$routes->get('/setting/misc/save-misc', 'Cms\Settings\Misc::createMisc');
$routes->post('/setting/misc/save-misc', 'Cms\Settings\Misc::createMisc');
// END MISC

// HOSPITAL
$routes->get('/hospital/data-hospital-location', 'Cms\Hospital\Hospital::dataLocationByCountryUuid');
$routes->post('/hospital/create-hospital-location', 'Cms\Hospital\Hospital::createHospitalLocation');
$routes->get('/hospital/edit-hospital-location', 'Cms\Hospital\Hospital::editHospitalLocation');
$routes->post('/hospital/edit-hospital-location', 'Cms\Hospital\Hospital::editHospitalLocation');
$routes->get('/hospital/data-hospital', 'Cms\Hospital\Hospital::dataHospital');
$routes->get('/hospital/search-hospital', 'Cms\Hospital\Hospital::searchDataHospital');
$routes->get('/hospital/data-hospital-tags', 'Cms\Hospital\Hospital::getDataHospitalForTags');
$routes->get('/hospital/data-hospital-branch', 'Cms\Hospital\Hospital::dataHospitalBranch');
$routes->post('/hospital/create-hospital', 'Cms\Hospital\Hospital::createHospital');
$routes->get('/hospital/create-hospital', 'Cms\Hospital\Hospital::createHospital');
$routes->get('/hospital/edit-hospital', 'Cms\Hospital\Hospital::editHospital');
$routes->post('/hospital/edit-hospital', 'Cms\Hospital\Hospital::editHospital');
$routes->get('/hospital/data-packages', 'Cms\Hospital\Hospital::dataPackages');
$routes->get('/hospital/hospital/packages', 'Cms\Hospital\Hospital::viewPackageHospital');
$routes->get('/hospital/hospital/package/post', 'Cms\Hospital\Hospital::viewPackagePost');
$routes->post('/hospital/hospital/package/data-post', 'Cms\Hospital\Hospital::createHospitalPackage');
$routes->get('/hospital/hospital/package/data-post', 'Cms\Hospital\Hospital::createHospitalPackage');
$routes->get('/hospital/hospital/package/update', 'Cms\Hospital\Hospital::viewPackagePost');
$routes->post('/hospital/hospital/package/data-update', 'Cms\Hospital\Hospital::editHospitalPackage');
$routes->get('/hospital/hospital/package/data-update', 'Cms\Hospital\Hospital::editHospitalPackage');
$routes->get('/hospital/hospital/package/content', 'Cms\Hospital\Hospital::viewPackageContentEditor');
$routes->post('/hospital/package-image/insert', 'Cms\Hospital\Hospital::uploadImageCustom');
$routes->get('/hospital/package-image/insert', 'Cms\Hospital\Hospital::uploadImageCustom');
$routes->delete('/hospital/hospital-package/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
$routes->delete('/hospital/hospital-branch/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
$routes->delete('/hospital/hospital-location/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
$routes->delete('/hospital/hospital/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');
// END HOSPITAL

// DOCTOR
$routes->get('/doctor/data-doctor', 'Cms\Doctor\Doctor::dataDoctor');
$routes->post('/doctor/create-doctor', 'Cms\Doctor\Doctor::createDoctor');
$routes->get('/doctor/create-doctor', 'Cms\Doctor\Doctor::createDoctor');
$routes->get('/doctor/edit-doctor', 'Cms\Doctor\Doctor::editDoctor');
$routes->post('/doctor/edit-doctor', 'Cms\Doctor\Doctor::editDoctor');
$routes->get('/doctor/data-doctor-specialist', 'Cms\Doctor\Doctor::dataDoctorSpecialist');
$routes->get('/doctor/search-specialist', 'Cms\Doctor\Doctor::searchDataDoctorSpecialist');
$routes->get('/doctor/data-specialist-tags', 'Cms\Doctor\Doctor::getDataDoctorSpecialistForTags');
$routes->post('/doctor/create-doctor-specialist', 'Cms\Doctor\Doctor::createDoctorSpecialist');
$routes->get('/doctor/create-doctor-specialist', 'Cms\Doctor\Doctor::createDoctorSpecialist');
$routes->get('/doctor/edit-doctor-specialist', 'Cms\Doctor\Doctor::editDoctorSpecialist');
$routes->post('/doctor/edit-doctor-specialist', 'Cms\Doctor\Doctor::editDoctorSpecialist');
$routes->delete('/doctor/doctor/(:segment)/(:segment)/(:any)', 'Cms\General\General::delMenu/$1/$2/$3');

// END ADMIN

// GENERAL VIEW
$routes->get('/(:segment)', 'Website\Home\Home::general/$1');
$routes->get('/(:segment)/(:segment)', 'Website\Home\Home::general/$1/$2');
$routes->get('/(:segment)/(:segment)/(:segment)', 'Website\Home\Home::general/$1/$2/$3');
// $routes->get('/(:segment)', 'Website\Home\Home::general/$1');
// $routes->group('cms', ['filter' => 'canView'], function ($routes) {
//     $routes->get('(:segment)', 'Cms\General\General::index/$1');
// });
// $routes->get('/(:segment)/(:segment)', 'Cms\General\General::index/$1/$2', ['filter' => 'canView']);
// $routes->get('/(:segment)/(:segment)', 'Website\Home\Home::general/$1/$2');
// END GENERAL VIEW

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
