<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Users
$route['login'] = 'users/login';
$route['register'] = 'users/register';
$route['admin'] = 'users/admin';

// Products
$route['products'] = 'products';
$route['products/category/(:any)/(:any)'] = 'products/filter_category/$1/$2';
$route['products/search_and_sort'] = 'products/search_and_sort';
$route['products/show/(:any)'] = 'products/show/$1';
$route['products/buy'] = 'products/buy';

// Carts
$route['carts'] = 'carts';
$route['carts/cart_items'] = 'carts/cart_items';
$route['carts/remove_in_cart/(:any)'] = 'carts/remove_in_cart/$1';

$route['stripe/payment'] = 'stripe/payment';

// Orders
$route['orders/add'] = 'orders/store';
$route['orders/show'] = 'orders/show';
$route['orders/update_status'] = 'orders/update_status';

// Dashboard
$route['dashboard'] = 'dashboards';
$route['dashboard/orders'] = 'dashboards/orders';
$route['dashboard/orders/search'] = 'dashboards/order_search';
$route['dashboard/products'] = 'dashboards/products';
$route['dashboard/products/search'] = 'dashboards/search';
$route['dashboard/products/add'] = 'dashboards/add';
$route['dashboard/products/delete/(:any)'] = 'dashboards/delete/$1';




