<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['setting-default'] = 'setting_default';
$route['outlet/outlet-detail/(:any)'] = 'outlet_detail/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
