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
$handle = opendir(APPPATH.'modules');
if ($handle)
{
	while ( false !== ($module = readdir($handle)) )
	{
		# make sure we don't map silly dirs like .svn, or . or ..
		
		if (substr($module, 0, 1) != ".")
		{
			if ( file_exists(APPPATH.'modules/'.$module.'/config/routes.php') )
			{
				include(APPPATH.'modules/'.$module.'/config/routes.php');
			}		
		}
	}
}
$route['default_controller'] = "dispatcher";
$route['404_override'] = '';

$modules = array('customer','cart','order','system');
$path = implode('|', $modules);
$route['(' . $path . ')'] = 'dispatcher/user_dispatcher/$1';
$route['(' . $path . ')/(:any)'] = 'dispatcher/user_dispatcher/$1/$2';
$route['(' . $path . ')/(:any)/(:any)'] = 'dispatcher/user_dispatcher/$1/$2/$3';
$route['(' . $path . ')/(:any)/(:any)/(:any)'] = 'dispatcher/user_dispatcher/$1/$2/$3/$4';
$route['(' . $path . ')/(:any)/(:any)/(:any)/(:any)'] = 'dispatcher/user_dispatcher/$1/$2/$3/$4/$5';
$route['(' . $path . ')/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'dispatcher/user_dispatcher/$1/$2/$3/$4/$5/$6';

//$route['page'] = "dispatcher/user_dispatcher/passing/page";
$route['page/(:any)'] = 'dispatcher/user_dispatcher/pages/page/$1';
//$route['page/(:any)'] = 'dispatcher/user_dispatcher/pages/page/$1';
/*admin */
$route['admin'] = "dispatcher/admin_dispatcher";
$route['admin/login'] = 'auth/login_admin';
$route['admin/logout'] = 'auth/logout_admin';
$route['admin/(:any)'] = 'dispatcher/admin_dispatcher/$1';

//products
$route['products'] = 'dispatcher/user_dispatcher/product/products';
$route['products/(:any)'] = 'dispatcher/user_dispatcher/product/products/$1';
$route['products/(:any)/(:any)'] = 'dispatcher/user_dispatcher/product/products/$1/$2';
$route['products/(:any)/(:any)/(:any)'] = 'dispatcher/user_dispatcher/product/products/$1/$2/$3';


//products preview
$route['product_preview'] = 'dispatcher/user_dispatcher/product/product_preview';
$route['product_preview/(:any)'] = 'dispatcher/user_dispatcher/product/product_preview/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */