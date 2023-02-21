<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['users'] = 'users';
$route['users/add'] = 'users/add';
$route['users/login'] = 'users/login';
$route['users/profile'] = 'users/profile';




