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
$route['default_controller'] = 'LandingPage';
$route['404_override'] = 'landingPage/error_page';
$route['translate_uri_dashes'] = FALSE;

$route['produk/(:any)'] = 'LandingPage/detailproduk/$1';
$route['category/(:any)'] = 'LandingPage/detailCategory/$1';
$route['cart'] = 'user/getcart';
$route['checkout'] = 'user/checkout';
$route['orders'] = 'user/orders';
$route['search'] = 'LandingPage/search';

$route['home'] = 'LandingPage/index';
$route['shop'] = 'LandingPage/shop';
$route['about'] = 'LandingPage/aboutUs';
$route['contact'] = 'LandingPage/contactUs';
$route['buatpesanan'] = 'user/order';
$route['pesanan'] = 'user/hlmorder';
$route['orderid/(:num)'] = 'user/setOrderIdToSession/$1';
$route['error_page'] = 'landingPage/error_page';

// $route['dashboard/update_monthly_report'] = 'dashboard/update_monthly_report';




