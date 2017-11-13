<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['err_csrf'] = 'This form post did not pass our security checks.';
//Auth
$lang['close_auth']   = 'close';
$lang['auth_heading']   = 'auth';
// Login
$lang['login_heading']         = 'Log in';
$lang['login_subheading']      = 'Please log in with your email and password below.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Log in';
$lang['login_forgot_password'] = 'Forgot your password?';

$lang['activation_signup_subheading']      = 'Check your email ';
$lang['activation_twofactor_subheading']      = 'Check your email ';
$lang['signup_subheading']      = 'Your email has been sent to ';
$lang['signup_terms_subheading']      = 'Please sign up with your email below.';
$lang['signup_submit_btn']      = 'Sign up';
$lang['signup_btn']      = 'Submit';
$lang['activation_resetpassword_btn']      = 'Verify';
$lang['activation_twofactor_btn']      = 'Log in';

$lang['passwordreset_subheading']      = 'Lost your password? Please enter your email address. You will receive a link to create a new password.';
$lang['activation_subheading']      = 'Your email has been sent to ';
$lang['passwordreset_btn']      = 'Send Email';
$lang['activation_btn']      = 'Submit';

$lang['link_login_title']      = 'Log in';
$lang['link_passwordreset_title']   = 'Forgot Password?';
$lang['link_signup_title']   = 'Sign up';
$lang['login_signup']      = 'Need an account? ';
$lang['signup_tems_login']      = 'Have an account? ';
$lang['activation_signup_resend_code']      = "Haven't received verification email?";
$lang['activation_twofactor_resend_code']      = "Haven't received verification email?";
$lang['activation_resetpassword_resend_code']      = "Haven't received verification email?";
$lang['resend_code']      = " Resend";
$lang['signup_login']  = 'Back to ';
$lang['passwordreset_login']  = 'Back to ';

// Success 
$lang['success_login'] = 'Anda berhasil masuk';
$lang['success_signup'] = 'Anda berhasil mendaftar';
$lang['success_passwordreset'] = 'Success';
$lang['success_resetpassword'] = 'Anda berhasil mereset password';
$lang['success_activation_code'] = 'Kode aktifasi anda benar';
$lang['success_send_message'] = 'Your message, has been sent to your email';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';


$lang['username_placeholder']                       = 'Username';
$lang['birthday_placeholder']                       = 'Birthday';
$lang['firstname_placeholder']                       = 'First name';
$lang['lastname_placeholder']                       = 'Last name';
$lang['company_placeholder']                     = 'Company name';
$lang['identity_placeholder']                    = 'Identity';
$lang['email_placeholder']                       = 'Email';
$lang['phonenumber_placeholder']                 = 'Phone number';
$lang['password_placeholder']                    = 'Password';
$lang['confirm_password_placeholder']            = 'Confirm password';
$lang['attach_resume_cv']           			 = 'Attach resume/ cv';
$lang['attach_cover_letter']           			 = 'Attach_cover_letter';
$lang['verification_code_placeholder']            = 'Verification code';
$lang['message_placeholder']            		= 'Message';
$lang['create_user_submit_btn']                        = 'Create user';
$lang['contact_submit_btn']                        = 'Send Message';
$lang['contact_subheading']                        = 'We are happy to hear from you. Fill out the form below and a limononoto representative will contact you as soon as possible.';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['passwordreset_heading']                 = 'Forgot Password';
$lang['passwordreset_email_label']             = '%s:';
$lang['passwordreset_submit_btn']              = 'Send Email';
$lang['passwordreset_validation_email_label']  = 'Email Address';
$lang['passwordreset_identity_label'] = 'Identity';
$lang['passwordreset_email_identity_label']    = 'Email';
$lang['passwordreset_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';


/*AAuth*/
// Account verification
$lang['email_verification_subject'] = 'Account Verification';
$lang['email_verification_code'] = 'Your verification code is: ';
$lang['email_activation_code'] = 'Verification code has been sent to : ';
$lang['email_verification_text'] = " You can also click on (or copy and paste) the following link\n\n";
$lang['email_verification_signup'] = "Cek email anda\n\n";
$lang['email_verification_resetpassword'] = "Cek email anda\n\n";
$lang['email_activation'] = "Cek email anda\n\n";
$lang['err_data_exists'] = "Already registered";

// Password reset
$lang['email_reset_subject'] = 'Reset Password';
$lang['email_reset_text'] = "To reset your password click on (or copy and paste in your browser address bar) the link below:\n\n";

// Password reset success
$lang['email_reset_success_subject'] = 'Successful Pasword Reset';
$lang['email_reset_success_new_password'] = 'Your password has successfully been reset. Your new password is : ';


/* Error Messages */

// Account creation errors
$lang['err_email_exists'] = 'Email address already exists on the system. If you forgot your password, you can click the link below.';
$lang['err_phonenumber_required'] = "We couldn't find that number. Please try again.";
$lang['err_phonenumber_invalid'] = 'Invalid phone number. Please try again.';
$lang['err_username_exists'] = "Account already exists on the system with that username.  Please enter a different username, or if you forgot your password, please click the link below.";
$lang['err_email_invalid'] = 'Invalid email address';
$lang['err_password_invalid'] = 'Invalid password';
$lang['err_username_invalid'] = 'Invalid Username';
$lang['err_username_required'] = 'Username required';
$lang['err_code_required'] = 'Code is required';
$lang['err_code_invalid'] = 'Invalid Code';
$lang['err_birthday_required'] = 'Birthday is required';
$lang['err_birthday_invalid'] = 'Invalid Birthday';
$lang['err_phonenumber_required'] = 'Phone number is required';
$lang['err_phonenumber_invalid'] = 'Invalid Phone number';
$lang['err_subject_required'] = 'Subject is required';
$lang['err_subject_invalid'] = 'Invalid subject';
$lang['err_message_required'] = 'Message is required';
$lang['err_message_invalid'] = 'Invalid message';
$lang['err_upload_required'] = 'File is required';
$lang['err_upload_invalid'] = 'Invalid file';
$lang['err_send_message'] = 'Failed to send';
$lang['err_contact'] = 'Please, check again';
$lang['err_email_not_listed'] = 'Email address not recognized';

// Account update errors
$lang['err_update_email_exists'] = 'Email address already exists on the system.  Please enter a different email address.';
$lang['err_update_username_exists'] = "Username already exists on the system.  Please enter a different username.";


// Access errors
$lang['err_no_access'] = 'Sorry, you do not have access to the resource you requested.';
$lang['err_login_failed_email'] = 'email Address and Password do not match.';
$lang['err_login_failed_name'] = 'Username and Password do not match.';
$lang['err_login_failed_all'] = "We couldn't log you in. Please check what you've entered.";
$lang['err_passwordreset_failed_all'] = "Sorry, we couldn't find anyone with that email address.";
$lang['err_login_attempts_exceeded'] = 'You have exceeded your login attempts, your account has now been locked.';
$lang['err_recaptcha_not_correct'] = 'Sorry, the reCAPTCHA text entered was incorrect.';

// Misc. errors
$lang['err_no_user'] = 'User does not exist';
$lang['err_account_not_verified'] = 'Your account has not been verified. Please check your email and verify your account.';
$lang['err_no_group'] = 'Group does not exist';
$lang['err_no_subgroup'] = 'Subgroup does not exist';
$lang['err_self_pm'] = 'It is not possible to send a Message to yourself.';
$lang['err_no_pm'] = 'Private Message not found';
$lang['err_filter_email'] = 'Check kembali email yang telah diinput';
$lang['err_banned_account'] = 'Your account has blocked';

$lang['err_signup_invalid'] = 'Failed to signup, try again';
$lang['err_input_activation'] = "We couldn't log you in. Please check what you've entered";
$lang['err_field_required'] = 'This field should not be empty';
$lang['err_no_session'] = 'Your browser has cookies disabled. Make sure your cookies are enabled and try again';

/* Info Moderation */
$lang['info_account_moderation'] = 'Your account is in <a class="lm-link" href="'.site_url("acc/moderation").'">Moderation</a>';
$lang['info_activation_invalid'] = 'Please, do activate or contact <a class="lm-link" href="'.site_url("pages/contact").'">Admin</a>';

/* Info messages */
$lang['info_already_member'] = 'User is already member of group';
$lang['info_already_subgroup'] = 'Subgroup is already member of group';
$lang['info_group_exists'] = 'Group name already exists';
$lang['info_perm_exists'] = 'Permission name already exists';

/* Info messages */
$lang['info_logged_in'] = 'You are logged in';
$lang['info_require_user'] = 'You need a signup';
$lang['info_permission'] = 'Permission required to participate';


/* Field required */
$lang['err_firstname_required'] = 'Firstname is required';
$lang['err_lastname_required'] = 'Lastname is required';
$lang['err_email_required'] = 'Email is required';
$lang['err_cpassword_required'] = 'Confirm password is required';
$lang['err_password_required'] = 'Password is required';
$lang['err_subject_required'] = 'Subject is required';
$lang['err_level_required'] = 'Level is required';
$lang['err_country_required'] = 'Country is required';
$lang['err_not_match_password'] = 'Password dan konfirmasi password harus sama';
