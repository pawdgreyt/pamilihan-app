<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/products/(:any)'] = 'categories/products/$1';

$route['login'] = 'users/login';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['(:any)'] = 'pages/view/$1';