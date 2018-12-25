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

# HOME PAGE
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
#$route['translate_uri_dashes'] = FALSE;
$route['translate_uri_dashes'] = TRUE;


/***************************************************************************************/
#		            																	#
#      									ACCOUNT      								    #
#																						#
/***************************************************************************************/
# User
$route['tai-khoan/dang-ky'] = 'user/signup';
$route['tai-khoan/cap-nhat.*'] = 'user/update_signup';
$route['tai-khoan/dang-nhap'] = 'user/signin';
$route['tai-khoan/dang-xuat'] = 'user/signout';
$route['tai-khoan/quen-mat-khau'] = 'user/forgetpass';
$route['user/check-username'] = 'user/ajax_check_user';
$route['user/check-email'] = 'user/ajax_check_email';
$route['user/subscribe'] = 'user/subscribe';
$route['user/ajax-signin'] = 'user/ajax_signin';

$route['tai-khoan/thong-tin'] = 'user/my_info';
$route['user/delete-avatar-user'] = 'user/ajax_del_ava_user';
$route['tai-khoan/doi-mat-khau'] = 'user/changepass';
$route['tai-khoan/sua-thong-tin'] = 'user/edit_info';
$route['tai-khoan/sua-giao-nhan'] = 'user/edit_delivery';

$route['tai-khoan/san-pham-thich'] = 'product/product_favorite';
$route['tai-khoan/xoa-san-pham-thich/(:num)'] = 'product/removefav/$1';

$route['tai-khoan/san-pham-xem'] = 'product/product_view';
$route['tai-khoan/xoa-san-pham-xem/(:num)'] = 'product/removeview/$1';

# Category
$route['danh-muc'] = 'product/list_category';
$route['danh-muc/(:num)-(:any)/sap-xep/(:any)'] = 'product/category';
$route['danh-muc/(:num)-(:any)'] = 'product/category';

# Viewed current
$route['san-pham/xem-gan-day'] = 'product/viewed_current';

# Product
$route['san-pham/tat-ca-san-pham'] = 'product/all_product';
$route['san-pham/tat-ca-san-pham/trang.*'] = 'product/all_product';
$route['san-pham/tim-kiem'] = 'product/search_product';
$route['product/get_product'] = 'product/get_product';
$route['san-pham/(:num)-(:any)'] = 'product/product';

# Order & Show cart
$route['showcart/add'] = 'showcart/add';
$route['showcart/buynow'] = 'showcart/buynow';
$route['dat-hang'] = 'showcart/checkout';
$route['checkout/login'] = 'user/signin_and_checkout'; // Login & checkout
$route['dat-hang/co-tao-tai-khoan'] = 'showcart/checkout_register'; // Checkout & have create account
$route['dat-hang/khong-tao-tai-khoan'] = 'showcart/checkout_register'; // Checkout & no create account
$route['dat-hang-thanh-cong.*'] = 'showcart/orderSuccess'; // Order success

$route['gio-hang'] = 'showcart/cart';
$route['showcart/update-cart'] = 'showcart/update_cart';
$route['showcart/del-cart/(:num)'] = 'showcart/delete_cart/$1';
$route['showcart/cancel-order'] = 'showcart/cancel_order';

$route['tai-khoan/don-hang'] = 'showcart/my_order';
$route['tai-khoan/don-hang/(:num)'] = 'showcart/get_order/$1';

# News
$route['tin-tuc'] = 'content/news';
$route['tin-tuc/(:num)-(:any)'] = 'content/detail';

# Blogs
$route['blogs'] = 'content/blogs';
$route['blogs/(:num)-(:any)'] = 'content/detail';

# Promotion
$route['khuyen-mai'] = 'content/promotion';
$route['khuyen-mai/(:num)-(:any)'] = 'content/detail';

# Contact us
$route['lien-he'] = 'welcome/contactus';


/***************************************************************************************/
#		            																	#
#      									ADMIN       								    #
#																						#
/***************************************************************************************/
# Login
$route['admin/login'] = 'admin_registion/login';
$route['admin/logout'] = 'admin_registion/logout';

# Home
$route['admin'] = 'admin_home';

# User
$route['admin/user'] = 'admin_user/user';
$route['admin/add-user'] = 'admin_user/action_user';
$route['admin/edit-user/(:num)'] = 'admin_user/action_user/$1';
$route['admin/del-user/(:num)'] = 'admin_user/delete_user/$1';
$route['admin/publish-user.*'] = 'admin_user/publish_user';
$route['admin/delete-image-user'] = 'admin_user/ajax_del_img_user';
$route['admin/check-username'] = 'admin_user/ajax_check_user';
$route['admin/check-email'] = 'admin_user/ajax_check_email';
$route['admin/check-mobile'] = 'admin_user/ajax_check_mobile';

# Customer
$route['admin/customer'] = 'admin_user/customer';
$route['admin/publish-customer.*'] = 'admin_user/publish_customer';
$route['admin/del-customer/(:num)'] = 'admin_user/delete_customer/$1';

# Email
$route['admin/list-email'] = 'admin_email/email';
$route['admin/del-email/(:num)'] = 'admin_email/delete_email/$1';
$route['admin/publish-email.*'] = 'admin_email/publish_email';

# Contact
$route['admin/contact'] = 'admin_email/contact';
$route['admin/del-contact/(:num)'] = 'admin_email/delete_contact/$1';
$route['admin/publish-contact.*'] = 'admin_email/publish_contact';

# Content
$route['admin/content'] = 'admin_content/content';
$route['admin/add-content'] = 'admin_content/action_content';
$route['admin/edit-content/(:num)'] = 'admin_content/action_content/$1';
$route['admin/del-content/(:num)'] = 'admin_content/delete_content/$1';
$route['admin/publish-content.*'] = 'admin_content/publish_content';
$route['admin/delete-image-content'] = 'admin_content/ajax_del_img_cont';

$route['admin/blogs'] = 'admin_content/blogs';
$route['admin/guide'] = 'admin_content/guide';
$route['admin/promotion'] = 'admin_content/promotion';
$route['admin/collection'] = 'admin_content/collection';

# Product
$route['admin/product'] = 'admin_product/product';
$route['admin/add-product'] = 'admin_product/action_product';
$route['admin/edit-product/(:num)'] = 'admin_product/action_product/$1';
$route['admin/del-product/(:num)'] = 'admin_product/delete_product/$1';
$route['admin/publish-product.*'] = 'admin_product/publish_product';
$route['admin/delete-image-product'] = 'admin_product/ajax_del_img_pro';
$route['admin/delete-doc-product'] = 'admin_product/ajax_del_doc_pro';
$route['admin/get-relative-product'] = 'admin_product/ajax_get_rela_pro';

# Category
$route['admin/category'] = 'admin_category/category';
$route['admin/add-category'] = 'admin_category/action_category';
$route['admin/edit-category/(:num)'] = 'admin_category/action_category/$1';
$route['admin/del-category/(:num)'] = 'admin_category/delete_category/$1';
$route['admin/publish-category.*'] = 'admin_category/publish_category';
$route['admin/delete-image-category'] = 'admin_category/ajax_del_img_cat';

# Style
$route['admin/style'] = 'admin_product/style';
$route['admin/add-style'] = 'admin_product/action_style';
$route['admin/edit-style/(:num)'] = 'admin_product/action_style/$1';
$route['admin/del-style/(:num)'] = 'admin_product/delete_style/$1';
$route['admin/publish-style.*'] = 'admin_product/publish_style';
$route['admin/delete-image-style'] = 'admin_product/ajax_del_img_style';

# Color
$route['admin/color'] = 'admin_product/color';
$route['admin/add-color'] = 'admin_product/action_color';
$route['admin/edit-color/(:num)'] = 'admin_product/action_color/$1';
$route['admin/del-color/(:num)'] = 'admin_product/delete_color/$1';
$route['admin/publish-color.*'] = 'admin_product/publish_color';

# Media
$route['admin/images'] = 'admin_home/images';
$route['admin/documents'] = 'admin_home/documents';
$route['admin/videos'] = 'admin_home/videos';
$route['admin/musics'] = 'admin_home/musics';
$route['admin/newicon'] = 'admin_home/newicon';

$route['admin/create-object'] = 'admin_home/createobj';
$route['admin/delete-object'] = 'admin_home/deleteobj';

# Settings
$route['admin/setting'] = 'admin_setting/setting';
$route['admin/edit-config'] = 'admin_setting/edit_config';
$route['admin/infous'] = 'admin_setting/infous';
$route['admin/settup-infous'] = 'admin_setting/settup_infous';
$route['admin/settup-home'] = 'admin_setting/settup_home';
$route['admin/delete-image-show-home'] = 'admin_setting/ajax_del_show_home';

# Order
$route['admin/order'] = 'admin_order/order';
$route['admin/detail-order/(:num)'] = 'admin_order/detail_order/$1';
$route['admin/change-status-order'] = 'admin_order/change_status_order';

# System
$route['admin/system-info'] = 'admin_home/system_info';