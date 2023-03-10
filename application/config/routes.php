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
$route['default_controller'] = 'vendor';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['store/vendor'] = 'vendor/vendor_list';
$route['store/get-vendor']['GET'] = 'vendor/get_vendor_data';
$route['store/update-vendor']['POST'] = 'vendor/create_update_vendor';
$route['store/delete-vendor']['POST'] = 'vendor/delete_vendor_by_id';
$route['store/get-vendor-name-availability']['GET'] = 'vendor/check_vendor_name_available';
$route['store/get-vendor-email-availability']['GET'] = 'vendor/check_vendor_email_available';
$route['store/get-vendor-phone-availability']['GET'] = 'vendor/check_vendor_phone_available';


$route['store/purchase-order'] = 'purchaseorder';
$route['store/purchase-order/list'] = 'purchaseorder/purchase_order_list';
$route['store/get-purchase-order']['GET'] = 'purchaseorder/get_purchase_order_data';
$route['store/update-purchase-order']['POST'] = 'purchaseorder/create_update_purchase_order';
$route['store/delete-purchase-order']['POST'] = 'purchaseorder/delete_purchase_order';



//set modules/config/routes.php
$modules_path = APPPATH.'modules/';     
$modules = scandir($modules_path);

foreach($modules as $module)
{
    if($module === '.' || $module === '..') continue;
    if(is_dir($modules_path) . '/' . $module)
    {
        $routes_path = $modules_path . $module . '/config/routes.php';
        if(file_exists($routes_path))
        {
            require($routes_path);
        }
        else
        {
            continue;
        }
    }
}
