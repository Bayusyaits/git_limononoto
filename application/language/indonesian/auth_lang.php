<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - Indonesia
*
* Author: 	Daeng Muhammad Feisal
*     http://daengdoang.wordpress.com
*			daengdoang@gmail.com
*			@daengdoang
*
*
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  21.06.2013
* Last-Edit: 28.04.2016
*
* Description:  Indonesia language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Form yang dikirim tidak lulus pemeriksaan keamanan kami.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Silakan login dengan email/username dan password anda.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Kata Sandi:';
$lang['login_remember_label']  = 'Ingatkan Saya:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Lupa Kata Sandi?';

// Success 
$lang['succes_login'] = 'Anda berhasil masuk';
$lang['success_signup'] = 'Anda berhasil mendaftar';
$lang['success_resetpassword'] = 'Anda berhasil mereset password';
$lang['success_activation_code'] = 'Kode aktifasi anda benar';

// Index
$lang['index_heading']           = 'Pengguna';
$lang['index_subheading']        = 'Di bawah ini list dari para Pengguna.';
$lang['index_fname_th']          = 'Nama Awal';
$lang['index_lname_th']          = 'Nama Akhir';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Grup';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Aksi';
$lang['index_active_link']       = 'Aktif';
$lang['index_inactive_link']     = 'Tidak Aktif';
$lang['index_create_user_link']  = 'Buat Pengguna baru';
$lang['index_create_group_link'] = 'Buat grup baru';

// Deactivate User
$lang['deactivate_heading']                  = 'Deaktivasi Pengguna';
$lang['deactivate_subheading']               = 'Anda yakin akan melakukan deaktivasi akun Pengguna \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Ya:';
$lang['deactivate_confirm_n_label']          = 'Tidak:';
$lang['deactivate_submit_btn']               = 'Kirim';
$lang['deactivate_validation_confirm_label'] = 'konfirmasi';
$lang['deactivate_validation_user_id_label'] = 'ID Pengguna';

// Create User
$lang['create_user_heading']                           = 'Buat Pengguna';
$lang['create_user_subheading']                        = 'Silakan masukan informasi Pengguna di bawah ini.';
$lang['create_user_fname_label']                       = 'Nama Awal:';
$lang['create_user_lname_label']                       = 'Nama Akhir:';
$lang['create_user_company_label']                     = 'Nama Perusahaan:';
$lang['create_user_identity_label']                    = 'Identitas:';
$lang['create_user_email_label']                       = 'Surel:';
$lang['create_user_phone_label']                       = 'Telepon:';
$lang['create_user_password_label']                    = 'Kata Sandi:';
$lang['create_user_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['create_user_submit_btn']                        = 'Buat Pengguna';
$lang['create_user_validation_fname_label']            = 'Nama Awal';
$lang['create_user_validation_lname_label']            = 'Nama Akhir';
$lang['create_user_validation_identity_label']         = 'Identitas';
$lang['create_user_validation_email_label']            = 'Alamat Surel';
$lang['create_user_validation_phone_label']            = 'Telepon';
$lang['create_user_validation_company_label']          = 'Nama Perusahaan';
$lang['create_user_validation_password_label']         = 'Kata Sandi';
$lang['create_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';

// Edit User
$lang['edit_user_heading']                           = 'Ubah Pengguna';
$lang['edit_user_subheading']                        = 'Silakan masukan informasi Pengguna di bawah ini.';
$lang['edit_user_fname_label']                       = 'Nama Awal:';
$lang['edit_user_lname_label']                       = 'Nama Akhir:';
$lang['edit_user_company_label']                     = 'Nama Perusahaan:';
$lang['edit_user_email_label']                       = 'Surel:';
$lang['edit_user_phone_label']                       = 'Telepon:';
$lang['edit_user_password_label']                    = 'Kata Sandi: (jika mengubah sandi)';
$lang['edit_user_password_confirm_label']            = 'Konfirmasi Kata Sandi: (jika mengubah sandi)';
$lang['edit_user_groups_heading']                    = 'Anggota dari Grup';
$lang['edit_user_submit_btn']                        = 'Simpan Pengguna';
$lang['edit_user_validation_fname_label']            = 'Nama Awal';
$lang['edit_user_validation_lname_label']            = 'Nama Akhir';
$lang['edit_user_validation_email_label']            = 'Alamat Surel';
$lang['edit_user_validation_phone_label']            = 'Telepon';
$lang['edit_user_validation_company_label']          = 'Nama Perusahaan';
$lang['edit_user_validation_groups_label']           = 'Nama Grup';
$lang['edit_user_validation_password_label']         = 'Kata Sandi';
$lang['edit_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';

// Create Group
$lang['create_group_title']                  = 'Buat Grup';
$lang['create_group_heading']                = 'Buat Grupp';
$lang['create_group_subheading']             = 'Silakan masukan detail Grup di bawah ini.';
$lang['create_group_name_label']             = 'Nama Grup:';
$lang['create_group_desc_label']             = 'Deskripsi:';
$lang['create_group_submit_btn']             = 'Buat Grup';
$lang['create_group_validation_name_label']  = 'Nama Grup';
$lang['create_group_validation_desc_label']  = 'Deskripsi';

// Edit Group
$lang['edit_group_title']                    = 'Ubah Grup';
$lang['edit_group_saved']                    = 'Grup Tersimpan';
$lang['edit_group_heading']                  = 'Ubah Grup';
$lang['edit_group_subheading']               = 'Silakan masukan detail Grup di bawah ini.';
$lang['edit_group_name_label']               = 'Nama Grup:';
$lang['edit_group_desc_label']               = 'Deskripsi:';
$lang['edit_group_submit_btn']               = 'Simpan Grup';
$lang['edit_group_validation_name_label']    = 'Nama Grup';
$lang['edit_group_validation_desc_label']    = 'Deskripsi';

// Change Password
$lang['change_password_heading']                               = 'Ganti Kata Sandi';
$lang['change_password_old_password_label']                    = 'Kata Santi Lama:';
$lang['change_password_new_password_label']                    = 'Kata Sandi Baru (paling sedikit %s karakter):';
$lang['change_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['change_password_submit_btn']                            = 'Ubah';
$lang['change_password_validation_old_password_label']         = 'Kata Sandi Lama';
$lang['change_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['change_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi Baru';

// Forgot Password
$lang['forgot_password_heading']                 = 'Lupa Kata Sandi';
$lang['forgot_password_subheading']              = 'Silakan masukkan %s anda, agar kami dapat mengirim surel untuk mereset Kata Sandi Anda.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Kirim';
$lang['forgot_password_validation_email_label']  = 'Alamat Surel';
$lang['forgot_password_username_identity_label'] = 'Nama Pengguna';
$lang['forgot_password_email_identity_label']    = 'Surel';
$lang['forgot_password_email_not_found']         = 'Tidak ada data dari surel tersebut.';

// Reset Password
$lang['reset_password_heading']                               = 'Ganti Kata Sandi';
$lang['reset_password_new_password_label']                    = 'Kata Sandi Baru (paling sedikit %s karakter):';
$lang['reset_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['reset_password_submit_btn']                            = 'Ubah';
$lang['reset_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['reset_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi Baru';


/*AAuth*/
//Emailverification
$lang['email_verification_subject'] = 'Verifikasi Akun';
$lang['email_verification_code'] = 'Kode verifikasi anda adalah: ';
$lang['email_activation_code'] = 'Verification code has been sent to : ';
$lang['email_verification_text'] = "Anda juga bisa klik (atau salin dan tempel) tautan berikut ini\n\n";
$lang['email_verification_signup'] = "Cek email anda\n\n";
$lang['email_verification_resetpassword'] = "Cek email anda\n\n";
$lang['email_activation'] = "Cek email anda\n\n";
$lang['err_data_exists'] = "Sudah terdaftar";

// Password reset
$lang['email_reset_subject'] = 'Ganti Kata Sandi';
$lang['email_reset_text'] = "Untuk mengganti kata sandi klik (atau salin dan tempel) tautan dibawah ini:\n\n";

// Password reset success
$lang['email_reset_success_subject'] = 'Berhasil mengubah kata sandi';
$lang['email_reset_success_new_password'] = 'Kata sandi anda berhasil diubah. Kata sandi baru anda adalah : ';


/* Error Messages */

// Account creation errors
$lang['err_email_exists'] = 'Email sudah digunakan di sistem. Jika anda lupa kata sandi, silahkan klik tautan dibawah ini.';
$lang['err_phonenumber_required'] = "We couldn't find that number. Please try again.";
$lang['err_phonenumber_invalid'] = 'Invalid phone number. Please try again.';
$lang['err_username_exists'] = "Username telah digunakan oleh akun lain pada sistem.  Silahkan masukan username lain, atau jika anda lupa kata sandi, silahkan klik tautan dibawah ini.";
$lang['err_email_invalid'] = 'Alamat email tidak valid';
$lang['err_password_invalid'] = 'kata sandi tidak valid';
$lang['err_username_invalid'] = 'Username tidak valid';
$lang['err_username_required'] = 'Username tidak boleh kosong';
$lang['err_code_required'] = 'Kode Aktifasi tidak boleh kosong';
$lang['err_code_invalid'] = 'Kode Aktifasi tidak valid';
$lang['err_email_not_listed'] = 'Alamat email tidak terdaftar';


// Account update errors
$lang['err_update_email_exists'] = 'Alamat email telah digunakan pada sistem.  Silahkan masukan alamat email lainya.';
$lang['err_update_username_exists'] = "Username telah digunakan pada sistem.  Silahkan masukan username lainya.";
$lang['err_not_save_email'] = "Try again, Your email not save in server";

// Access errors
$lang['err_no_access'] = 'Maaf, Anda tidak memiliki akses ke sumber daya yang Anda minta.';
$lang['err_login_failed_email'] = 'Email dan sandi yang anda masukkan tidak cocok.';
$lang['err_login_failed_name'] = 'Username dan sandi yang Anda masukkan tidak cocok.';
$lang['err_login_failed_all'] = 'Email, username dan sandi yang Anda masukkan tidak cocok.';
$lang['err_login_attempts_exceeded'] = 'Anda telah melebihi upaya login anda, akun anda telah diblokir.';
$lang['err_recaptcha_not_correct'] = 'Maaf, teks reCAPTCHA yang anda dimasukkan salah.';

// Misc. errors
$lang['err_no_user'] = 'Pengguna tidak ada';
$lang['err_account_not_verified'] = 'Akun anda belum diverifikasi. Silakan cek email anda dan verifikasi akun anda .';
$lang['err_no_group'] = 'Grup tidak ada';
$lang['err_self_pm'] = 'Tidak dapat mengirim pesan kepada diri sendiri.';
$lang['err_no_pm'] = 'Pesan Pribadi tidak ditemukan';

$lang['err_invalid_unlisted'] = 'Pengguna tidak ada';
$lang['err_verification_invalid'] = 'Akun anda belum diverifikasi. Silakan cek email anda dan verifikasi akun anda .';
$lang['err_invalid_moderation'] = 'Grup tidak ada';
$lang['err_filter_email'] = 'Check kembali email yang telah diinput.';
$lang['err_banned_account'] = 'Your account has blocked';

$lang['err_signup_invalid'] = 'Tidak berhasil mendaftar';
$lang['err_input_activation'] = 'Terjadi kesalahan, pastikan kembali input yang diminta';
$lang['err_field_required'] = 'Field ini tidak boleh kosong';
$lang['err_no_session'] = 'session tidak ditemukan';

/* Info Moderation */
$lang['info_account_moderation'] = 'Your account is in <a class="lm-link" href="'.site_url("acc/moderation").'">Moderation</a>';
$lang['info_activation_invalid'] = 'Please, do activate or contact <a class="lm-link" href="'.site_url("pages/contact").'">Admin</a>';

/* Info messages */
$lang['info_already_member'] = 'Pengguna sudah anggota grup';
$lang['info_already_subgroup'] = 'Subgroup is already member of group';
$lang['info_require_user'] = 'Anda perlu daftar';
$lang['info_group_exists'] = 'Nama grup sudah ada';
$lang['info_perm_exists'] = 'Nama izin sudah ada';


/* Info messages */
$lang['info_logged_in'] = 'Anda telah login';
$lang['info_permission'] = 'Dibutuhkan Izin untuk masuk';


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