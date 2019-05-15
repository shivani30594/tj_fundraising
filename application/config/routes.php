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
//admin routes
// $route['a_login'] = 'admin/security';
// $route['a_logout'] = 'admin/security/logout';
// $route['a_dashboard'] = 'admin/dashboard';
//$route['a_forget_password']='admin/security/forgetPassword';

// user routes

// customer routes
$route['default_controller'] = 'security';
// admin routes
$route['a_login'] = 'admin/security';
$route['a_logout'] = 'admin/security/logout';
$route['a_dashboard'] = 'admin/dashboard';
$route['a_group'] = 'admin/group';
$route['a_product'] = 'admin/product';
$route['a_category'] = 'admin/category';
$route['a_order'] = 'admin/order';
$route['a_user'] = 'admin/user';
$route['a_paypal'] = 'admin/paypal/index';
$route['a_chgstatus/(:num)'] = 'admin/user/change_status/$1';
$route['a_product_info/(:num)'] = 'admin/product/view_product/$1';
$route['a_contact'] = 'admin/contact';
$route['a_respond'] = 'admin/contact/respond';
$route['a_commission'] = 'admin/commission/index';


//user routes
$route['u_login'] = 'security';
$route['u_dashboard'] = 'user/dashboard';
$route['u_customer'] = 'user/customer';
$route['u_logout'] = 'security/logout';
$route['u_join_group'] = 'user/dashboard/join_group';
$route['u_campaign'] = 'user/campaign';
$route['u_invite'] = 'user/customer/invite';
$route['invite'] = 'user/customer/cust_invite';
$route['share'] = 'user/customer/share';
$route['u_order'] = 'user/order/index';
$route['u_sale'] = 'user/sale/index';
$route['u_contact'] = 'user/contact/index';
$route['u_product'] = 'user/product/index';
$route['u_agreement/(:any)'] = 'user/campaign/aggrement/$1';
$route['u_setagreement'] = 'user/campaign/set_aggrement';
$route['u_setgoal'] = 'user/dashboard/set_goal';
$route['u_product/(:num)'] = 'user/product/index/$1';
$route['u_leader_board/(:num)'] = 'user/dashboard/leader_board/$1';


$route['marketing/(:any)/(:any)'] = 'customer/marketing/index/$1/$2';
$route['cust_save'] = 'customer/customer/save';
$route['display_product'] = 'customer/customer/display_product';
$route['cart_details'] = 'customer/customer/cart_details';
$route['checkout'] = 'customer/customer/checkout';
$route['display_product/(:num)'] = 'customer/customer/display_product/$1';
$route['product_view/(:num)'] = 'customer/customer/view/$1';
$route['my_orders/(:any)'] = 'customer/order/index/$1';
$route['comment/(:any)'] = 'customer/order/comment/$1';
$route['cancel/(:any)'] = 'customer/order/cancel_order/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
