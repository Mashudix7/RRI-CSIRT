<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/**
 * =====================================================
 * CSIRT RRI Routes Configuration
 * =====================================================
 * 
 * Komentar: Konfigurasi routing aplikasi
 * - Landing pages untuk company profile
 * - Auth routes untuk autentikasi
 * - Dashboard/Admin routes (akan ditambahkan)
 * =====================================================
 */

// Default controller - Landing page
$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// =====================================================
// Landing Page Routes (Public)
// =====================================================
$route['tentang'] = 'landing/tentang';
$route['tim'] = 'landing/tim';
$route['kontak'] = 'landing/kontak';

// =====================================================
// Article Routes (Public)
// =====================================================
$route['artikel'] = 'artikel/index';
$route['artikel/(:num)'] = 'artikel/detail/$1';

// =====================================================
// Auth Routes
// =====================================================
$route['auth'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

// =====================================================
// Dashboard Routes (Protected)
// =====================================================
$route['dashboard'] = 'dashboard/index';
$route['incidents'] = 'incidents/index';
$route['incidents/(:num)'] = 'incidents/detail/$1';
$route['incidents/create'] = 'incidents/create';
$route['incidents/store'] = 'incidents/store';
$route['incidents/(:num)/notes'] = 'incidents/notes/$1';
$route['admin/incidents'] = 'incidents/index'; // Alias for admin consistency

// =====================================================
// Admin Routes (Protected - Admin Only)
// =====================================================
$route['admin/users'] = 'admin/users';
$route['admin/users/(:any)'] = 'admin/users/$1';
$route['admin/articles'] = 'admin/articles';
$route['admin/articles/(:any)'] = 'admin/articles/$1';
$route['admin/teams'] = 'admin/teams';
$route['admin/teams/(:any)'] = 'admin/teams/$1';
$route['admin/ip-management'] = 'admin/ip_management';
$route['admin/ip-management/(:any)'] = 'admin/ip_management/$1';
$route['admin/reports'] = 'admin/reports';
$route['admin/audit'] = 'admin/audit';
$route['admin/settings'] = 'admin/settings';

