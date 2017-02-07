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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Main';
$route['admin/register'] = "admin/registration";

$route['admin/profile/update'] = "admin/update_admin_user";
$route['admin/password/update'] = "admin/update_admin_password";

$route['admin/district/create'] = "admin/admin_create_district";
$route['admin/district/update/(:any)'] = "admin/admin_update_district/$1";

$route['admin/sub/district/create'] = "admin/admin_create_sub_district";
$route['admin/sub/district/update/(:any)'] = "admin/admin_update_sub_district/$1";

$route['admin/course/create'] = "admin/admin_create_course";
$route['admin/course/update/(:any)'] = "admin/admin_update_course/$1";
$route['admin/course/delete/(:any)'] = "admin/admin_delete_course/$1";


$route['admin/course/assign/(:any)/(:any)'] = "admin/admin_course_assign/$1/$2";
$route['admin/course/remove/(:any)/(:any)'] = "admin/admin_course_remove/$1/$2";

$route['admin/instructor/create'] = "admin/admin_create_instructor";
$route['admin/instructor/update/(:any)'] = "admin/admin_update_instructor/$1";
$route['admin/instructor/delete/(:any)'] = "admin/admin_delete_instructor/$1";


//$route['admin/show/applicants'] = "admin/admin_show_applicants";
$route['admin/show/applicants'] = "admin/admin_applicant_list_search";
$route['admin/show/applicants/(:num)'] = 'admin/admin_applicant_list_search/$1';

$route['admin/applicant/form/upload'] = "admin/admin_upload_applicant_form";
$route['admin/applicant/form/update/(:any)'] = "admin/admin_update_applicant_form/$1";
$route['admin/applicant/form/delete/(:any)'] = "admin/admin_delete_applicant_form/$1";

$route['admin/applicant/delete/(:any)'] = "admin/admin_delete_applicant/$1";
$route['admin/applicant/enroll/(:any)'] = "admin/admin_enroll_applicant/$1";
$route['admin/applicant/withdraw/(:any)'] = "admin/admin_withdraw_applicant/$1";
$route['admin/applicant/passed/(:any)'] = "admin/admin_passed_applicant/$1";

$route['admin/applicant/make/active/(:any)'] = "admin/admin_make_active_applicant_form/$1";
$route['admin/applicant/make/inactive/(:any)'] = "admin/admin_make_inactive_applicant_form/$1";

$route['admin/assign/course/to/instructor/(:any)'] = "admin/admin_assign_course_instructor/$1";


$route['admin/show/sub/district'] = "admin/show_sub_district";
$route['admin/show/course'] = "admin/show_course_by_type";
$route['home/show/applicant/sub/district'] = "home/show_applicant_sub_district";
$route['home/edit/applicant/data/(:any)'] = "home/edit_applicant_data/$1";

$route['home/application'] = "home/application_submit";
$route['home/confirm/application/(:any)'] = "home/confirm_applicant_submission/$1";
$route['home/confirm/application/pdf/(:any)'] = "home/make_pdf/$1";
$route['sign-out'] = "admin/logout";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
