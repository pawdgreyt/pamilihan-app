<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['products/index'] = 'products/index';
$route['products/add_to_cart_from_form'] = 'products/add_to_cart_from_form';
$route['products/manage'] = 'products/manage';
$route['products/create'] = 'products/create';
$route['products/update'] = 'products/update';
$route['products/(:any)'] = 'products/view/$1';
$route['products'] = 'products/index';

$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/products/(:any)'] = 'categories/products/$1';

$route['carts/index'] = 'carts/index';

$route['checkout/index'] = 'checkout/index';
$route['checkout/order-success'] = 'checkout/order-success';

$route['pages/home'] = 'pages/view';
$route['pages/home/(:any)'] = 'pages/view';

$route['manage/staff'] = 'users/index';
$route['staff/create'] = 'users/create_staff';
$route['staff/update'] = 'users/update_staff';
$route['change_password'] = 'users/change_password';

$route['login'] = 'users/login';
$route['register'] = 'users/register';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)'] = 'pages/view';