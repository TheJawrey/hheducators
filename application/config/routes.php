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
$route['user_duties'] = 'group1/browse_duties/getUserDuties';
$route['duty_details'] = 'group1/browse_duties/dutyDetails';
$route['add_duty_user'] = 'group1/browse_duties/addDutyUser';
$route['remove_duty_user'] = 'group1/browse_duties/removeDutyUser';
$route['update_duty'] = 'group1/browse_duties/updateDuty';
$route['edit_duty'] = 'group1/browse_duties/editDuty';
$route['filter_duties'] = 'group1/browse_duties/filterDuties';
$route['get_duty/(:num)'] = 'group1/browse_duties/getDutyById/$1';
$route["add_duty"] = 'group1/browse_duties/addDuty';

$route['update_user_info'] = 'group1/browse_users/updateUser'; // on submission of admin edit user form
$route['edit_account'] = 'group1/browse_users/editAccount';

$route['confirm_user_password'] = 'group1/browse_users/confirmUserPassword'; // user_profile button for admin
$route['change_password'] = 'group1/browse_users/changePassword'; // user_profile button for non-admin


$route['log_out'] = 'group1/browse_users/logOut';
$route['login'] = 'group1/login_controller';
$route['login_validate'] = 'group1/login_controller/validateCredentials';
$route['browse_duties'] = 'group1/browse_duties';
$route['browse_users'] = 'group1/browse_users';
$route['browse_course_details'] = 'group1/browse_courses/get_course_details'; //<== THIS ONE
$route['details'] = 'group1/browse_users/userProfile';
$route['teacher_classes'] = 'group1/teacher_classes';

$route['forgot_password'] = 'group1/browse_users/forgotPassword'; //
$route['send_email'] = 'group1/browse_users/sendEmail';
$route['reset_password/(:any)'] = 'group1/browse_users/reset_password/$1'; // take random string identifier and reset password

// GROUP 3 ROUTES

$route['courses'] = 'group3/courses_main/courses_dash';
$route['add_class'] = 'group3/courses_main/add_class_page';
$route['save_new_class'] = 'group3/courses_main/save_new_class';
$route['course_details'] = 'group3/courses_main/course_details';
$route['course_edit'] = 'group3/courses_main/course_edit';
$route['course_update'] = 'group3/courses_main/course_update';

$route['course_delete'] = 'group3/courses_main/course_delete'; // use this for course_delete page

$route['view_categories'] = 'group3/courses_main/view_categories';
$route['add_category'] = 'group3/courses_main/add_category_page';
$route['save_new_category'] = 'group3/courses_main/submit_category';
$route['delete_category'] = 'group3/courses_main/delete_category';
//***********************



$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// ************** Group 4 Routes *************************

$route['gradebook/teacher/new-assignment'] = 'group4/gradebook/new_assignment';
$route['gradebook/teacher/edit-assignment'] = 'group4/gradebook/edit_assignment';
$route['gradebook/teacher/grade-assignment'] = 'group4/gradebook/grade_assignment';
$route['gradebook/(:any)'] = 'group4/gradebook/$1';
$route['gradebook'] = 'group4/gradebook';

// **********************************
