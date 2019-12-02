<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller']      = 'home';
$route['login-user']              = 'front/login';
$route['kategori/(:any)']         = 'front/kategori/tipe/$1';
$route['menuorder/(:any)']        = 'front/menuorder/detail/$1';
$route['cart']                    = 'front/cart';
$route['cart/additem']            = 'front/cart/additem';
$route['cart/remove_item/(:any)'] = 'front/cart/remove_item/$1';
$route['cart/update_item']        = 'front/cart/update_item';
$route['checkout']                = 'front/checkout';
$route['checkout/(:any)']         = 'front/checkout/$1';
$route['checkout/selesai/(:any)'] = 'front/checkout/selesai/$1';
$route['checkout/print/(:any)']   = 'front/checkout/print/$1';
$route['404_override']            = 'my_error';
$route['translate_uri_dashes']    = false;
