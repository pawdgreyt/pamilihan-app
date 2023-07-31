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

$route['pages/home'] = 'pages/view';
$route['pages/home/(:any)'] = 'pages/view';

$route['login'] = 'users/login';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)'] = 'pages/view';