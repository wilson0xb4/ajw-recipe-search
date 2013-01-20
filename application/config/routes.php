<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
// test routing
$route['ajw/search_results'] = 'ajw/search_results';
$route['ajw/display'] = 'ajw/display';

// app routings
$route['settings'] = 'ajw/settings';
$route['inventory'] = 'ajw/inventory';
$route['search/(:any)'] = 'ajw/search/$1';
$route['display/(:any)'] = 'ajw/display/$1';
$route['ajw/display/(:any)'] = 'ajw/display/$1';
$route['search'] = 'ajw/search';
$route['ajw/settings'] = 'ajw/settings';
$route['ajw/inventory'] = 'ajw/inventory';
$route['ajw/search/(:any)'] = 'ajw/search/$1';
$route['ajw/search'] = 'ajw/search';
//$route['ajw/home'] = 'ajw';
//$route['ajw'] = 'ajw/search';

// tutorial examples
$route['news/create'] = 'news/create';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';

$route['default_controller'] = 'ajw';
$route['(:any)'] = 'ajw/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */