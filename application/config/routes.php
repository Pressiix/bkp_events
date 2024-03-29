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
|	https://codeigniter.com/user_guide/general/routing.html
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
// $route['default_controller'] = 'welcome';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
$route['register'] = 'index_c/register';
$route['thankyou'] = 'index_c/thankyou';	//Thank You Action
$route['uncomplete'] = 'index_c/unsuccess1';//Duplicate Registration
$route['uncompleted'] = 'index_c/unsuccess2';//Banned User Registration
$route['check_mail_template'] = 'service_c/check_mail_template';

$route['confirm_event'] = 'index_c/confirm_event';

/** LIVE **/
$route['live'] = 'live_c/live';
$route['live_register'] = 'live_c/live_register';
$route['live_login'] = 'live_c/live_login';
$route['live-updates'] = 'live_c/live_update';
$route['service/checkmail'] = 'live_c/check_duplicate_reg1';

$route['default_controller'] = 'index_c/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;