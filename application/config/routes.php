<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

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
$route['email'] = 'email';
$route['default_controller'] = 'General';
$route['load/work']['POST'] = 'General/load_work';
$route['load/manage']['POST'] = 'Admin/load_manage';
$route['load/blog']['POST'] = 'General/load_blog';
$route['signup'] = 'Authentication';
$route['login'] = 'Authentication';
$route['login/two-factor'] = 'Authentication/Twofactor';
$route['passwordreset'] = 'Authentication/Authentication/passwordreset';
$route['dashboard'] = 'User';
$route['admin/manage'] = 'Admin';
$route['logout'] = 'General/logout';
$route['contact/join'] = 'General/join';
$route['auth'] = 'Authentication';
$route['account'] = 'My_Controller';
$route['404_override'] = 'Errors/page_missing';
$route['502_gateway'] = 'Errors/bad_gateway';
$route['home'] = 'General';
$route['(:any)'] = 'General/$1';
$route['sitemap\.xml'] = "General/sitemap";
$route['sitemap/image\.xml'] = "General/sitemap_image";
$route['translate_uri_dashes'] = FALSE;


/*
| -------------------------------------------------------------------------
| Added by CI Bootstrap 3
| Multilingual routing (use 2 characters (e.g. en, zh, cn, es) for switching languages)
| -------------------------------------------------------------------------
*/
$route['^(\w{2})/(.*)$'] = '$2';
$route['^(\w{2})$'] = $route['default_controller'];


//---------------------------------api user----------------------------------------------------

$route['api/user']['GET']                          = 'Rest_server/auth_token/user';
$route['api/user/format/(:any)']['GET']            = 'Rest_server/auth_token/user/format/$1';
$route['api/user/(:num)']['GET']                   = 'Rest_server/auth_token/user/id/$1';
$route['api/user/(:num)/format/(:any)']['GET']     = 'Rest_server/auth_token/user/id/$1/format/$2';

$route['api/user']['POST']                         = 'Rest_server/auth_token/user';
$route['api/user/(:num)']['PUT']                   = 'Rest_server/auth_token/user/id/$1';
$route['api/user/(:num)']['DELETE']                = 'Rest_server/auth_token/user/id/$1';

//---------------------------------api user----------------------------------------------------

$route['api/users']['GET']                          = 'Rest_server/users/users';
$route['api/users/format/(:any)']['GET']            = 'Rest_server/users/users/format/$1';
$route['api/users/id/(:num)']['GET']                = 'Rest_server/users/users/id/$1';
$route['api/users/(:num)']['GET']                   = 'Rest_server/users/users/id/$1';
$route['api/users/(:num)/format/(:any)']['GET']     = 'Rest_server/users/users/id/$1/format/$2';

$route['api/users']['POST']                         = 'Rest_server/users/users';
$route['api/users/(:num)']['PUT']                   = 'Rest_server/users/users/id/$1';
$route['api/users/(:num)']['DELETE']                = 'Rest_server/users/users/id/$1';

$route['api/active']['GET']                          = 'Rest_server/users/active';
$route['api/active/format/(:any)']['GET']            = 'Rest_server/users/active/format/$1';
$route['api/active/(:num)']['GET']                   = 'Rest_server/users/active/id/$1';
$route['api/active/(:num)/format/(:any)']['GET']     = 'Rest_server/users/active/id/$1/format/$2';

$route['api/active']['POST']                         = 'Rest_server/users/active';
$route['api/active/(:num)']['PUT']                   = 'Rest_server/users/active/id/$1';
$route['api/active/(:num)']['DELETE']                = 'Rest_server/users/active/id/$1';

$route['api/admin/manage']['POST']                    = 'Rest_server/admin/manage';
$route['api/insert/user']['POST']                    = 'Rest_server/admin/insert';
$route['update/user']['POST']          	   			= 'Admin/Admin_ajax/update';
$route['delete/user']['POST']     				 	= 'Admin/Admin_ajax/delete';

//---------------------------------api buku---------------------------------------------------------
$route['api/login']['GET']                             = 'Rest_server/Auth_token/login';
$route['api/login/format/(:any)']['GET']               = 'Rest_server/auth_token/login/format/$1';
$route['api/login/(:num)']['GET']                      = 'Rest_server/auth_token/login/id/$1';
$route['api/login/(:num)/format/(:any)']['GET']        = 'Rest_server/auth_token/login/id/$1/format/$2';
$route['api/twofactor']['GET']                         = 'Rest_server/auth_token/twofactor';

$route['api/login']['POST']                            = 'Rest_server/auth_token/login';
$route['api/login/(:num)']['PUT']                      = 'Rest_server/auth_token/login/id/$1';
$route['api/login/(:num)']['DELETE']                   = 'Rest_server/auth_token/login/id/$1';


//---------------------------------api signup---------------------------------------------------------

$route['api/signup']['GET']                            = 'Rest_server/auth_token/signup';
$route['api/signup/format/(:any)']['GET']              = 'Rest_server/auth_token/signup/format/$1';
$route['api/signup/(:num)']['GET']                     = 'Rest_server/auth_token/signup/id/$1';
$route['api/signup/(:num)/format/(:any)']['GET']       = 'Rest_server/auth_token/signup/id/$1/format/$2';
$route['api/signup']['POST']                           = 'Rest_server/auth_token/signup';

//---------------------------------api password---------------------------------------------------------

$route['api/passwordreset']['GET']                            = 'Rest_server/auth_token/password';
$route['api/passwordreset/format/(:any)']['GET']              = 'Rest_server/auth_token/password/format/$1';
$route['api/passwordreset/(:num)']['GET']                     = 'Rest_server/auth_token/password/id/$1';
$route['api/passwordreset/(:num)/format/(:any)']['GET']       = 'Rest_server/auth_token/password/id/$1/format/$2';
$route['api/passwordreset']['POST']                           = 'Rest_server/auth_token/password';


//---------------------------------api password resend---------------------------------------------------------

$route['api/passwordreset/resend']['GET']                     = 'Rest_server/auth_token/passwordresendemail';
$route['api/passwordreset/resend']['POST']                    = 'Rest_server/auth_token/passwordresendemail';

//---------------------------------api resetpassword---------------------------------------------------------

$route['api/resetpassword']['GET']                            = 'Rest_server/auth_token/resetpassword';
$route['api/resetpassword/format/(:any)']['GET']              = 'Rest_server/auth_token/resetpassword/format/$1';
$route['api/resetpassword/(:num)']['GET']                     = 'Rest_server/auth_token/resetpassword/id/$1';
$route['api/resetpassword/(:num)/format/(:any)']['GET']       = 'Rest_server/auth_token/resetpassword/id/$1/format/$2';
$route['api/resetpassword']['POST']                           = 'Rest_server/auth_token/resetpassword';


//---------------------------------api project---------------------------------------------------------

$route['member/project']                 					= 'panel/member/panel/project';
$route['member/project/new']              					= 'panel/member/panel/new_project';
$route['api/member/project/new']['GET']                     = 'Rest_server/member/project/new';
$route['api/member/project/new/(:any)']['GET']              = 'Rest_server/member/project/new/$1';

//---------------------------------View Token---------------------------------------------------------
$route['api/contact']['POST']		                       	= 'Validation/contact';
$route['api/contact/job']['POST']		                    = 'Validation/applicant';
$route['api/newsletter']['POST']		                	= 'Validation/newsletter';
$route['api/newsletter']['GET']		                		= 'Validation/newsletter';

//---------------------------------Api Login---------------------------------------------------------
$route['val/newsletter']['POST']		                       	= 'Authentication/Newsletter';
$route['auth/login']['POST']                      				= 'Authentication/login/login';
$route['auth/twofactor']['POST']                      			= 'Authentication/Twofactor/twofactor';
$route['auth/signup']['POST']                      	        = 'Authentication/signup/signup_terms';
$route['auth/activation/signup']['POST']                      	= 'Authentication/signup/activation';
$route['auth/signup/session']['POST']                          = 'Authentication/signup/signup';
$route['auth/complete']['POST']                            		= 'Authentication/complete';
$route['auth/passwordreset']['POST']                     	 	= 'Authentication/passwordreset/passwordreset';
$route['auth/resetpassword']['POST']                           = 'Authentication/passwordreset/resetpassword';
$route['auth/confirmemail']['POST']                             = 'Authentication/signup/confirmemail';
$route['auth/password']['POST']                            		= 'Authentication/passwordreset/password';

//---------------------------------View Email---------------------------------------------------------
$route['send-email/passwordreset']['GET']               = 'Rest_server/email/passwordreset';
$route['send-email/passwordreset']['POST']               = 'Rest_server/email/passwordreset';
$route['send-email/signup']['GET']                      = 'Rest_server/email/signup';
$route['send-email/signup']['POST']                      = 'Rest_server/email/signup';
$route['send-email/login']['GET']                      	= 'Rest_server/email/login';
$route['send-email/login']['POST']                      = 'Rest_server/email/login';


//---------------------------------View Token---------------------------------------------------------
$route['api/viewtoken']['POST']                       = 'Rest_server/restdata/viewtoken';


//---------------------------------api admin---------------------------------------------------------
$route['api/admin']['POST']                           = 'Rest_server/apiadmincontroller/admin';//untuk menambahkan admin

//---------------------------------Content work---------------------------------------------------------
$route['work/categories']            			 	 = 'General/load_work';
$route['work/(:num)/(:any)']            	     = 'General/content/work';
//---------------------------------Content blog---------------------------------------------------------
$route['blog/categories']            			 = 'General/load_blog';
$route['blog/(:num)/(:any)']            	     = 'General/content/blog';

