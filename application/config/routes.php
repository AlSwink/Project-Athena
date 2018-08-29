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
$route['default_controller'] = 'landing';
$route['404_override'] = 'redirect/index';
$route['translate_uri_dashes'] = FALSE;
$route['accounts/index'] = 'redirect/lost';
$route['login'] = 'landing';
$route['request_login'] = 'landing/request_login';

//swi routes
$route['swi'] = 'applications/swi';
$route['swi/standalone'] = 'applications/swi/1';
$route['swi/(:any)'] = 'apps/swi/$1';
$route['swi/get_document/(:any)/(:any)'] = 'apps/swi/get_document/$1/$2';
$route['swi/get_document_process/(:any)'] = 'apps/swi/get_document_process/$1';
$route['swi/get_input_document/(:any)'] = 'apps/swi/get_input_document/$1';
$route['swi/get_assigned_document/(:any)'] = 'apps/swi/get_assigned_document/$1';
$route['swi/reset/(:any)'] = 'apps/swi/reset_assignment/$1';
$route['swi/unassign/(:any)'] = 'apps/swi/unassign/$1';
$route['swi/input_worksheet'] = 'apps/swi/input_worksheet/';
$route['swi/getEmployeeInfo/(:any)'] = 'apps/swi/getEmployeeInfo/$1';
$route['swi/progress_board/(:any)'] = 'apps/swi/getDepartmentProgress/$1';
//system_health_check routes
$route['health_check'] = 'applications/system_health_check';
$route['health_check/standalone'] = 'applications/system_health_check/1';
$route['health_check/(:any)'] = 'apps/system_health_check/$1';

//referral routes
$route['referral/(:any)/(:any)'] = 'redirect/referral/$1/$2';

//api
$route['test'] = 'api/test';

//tool routes
