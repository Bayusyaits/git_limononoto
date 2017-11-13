<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Authentication extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('bower', array('CI' => $this));
		$this->load->helper(array('form','cilm_limononoto','seo_helper','cookie'));
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dyn_medsos','Authentication/Auth_libraries','Authentication/auth_dyn_menu','General/Tb_dft_javascript','Password','Format','Facebook'));
		$this->load->model(array('object_model','menu_model','user_model'));
		$this->facebook->enable_debug(TRUE);
		$this->css = $this->tb_dhd_css->build_css();
		$this->menu_title = $this->auth_dyn_menu->build_menu_title();
		$this->menu_footer = $this->auth_dyn_menu->build_menu_footer();
		$this->js = $this->tb_dft_javascript->build_javascript();
		$this->property = $this->auth_dyn_menu->get_opengraph_property();
		$this->javascript = null;
		
	}
		 
	public function index()
	{	
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'],
								'url'				=> site_url(),
								'image'				=> img_url().'favicon/apple-touch-icon.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->form_auth = $this->tb_form->build_form_auth();
		$this->render('include/header', array(
            'css' => $this->css
        ));
		$this->render('index', array(
            'menu_title' => $this->menu_title,
            'form_auth' => $this->form_auth
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));

	}
	/*Before you can login, you must active your account with the code sent to your email address.
	If you did not receive this email, please check your junk/spam folder.
	Click here to resend the activation email.
	If you entered an incorrect email address, you will need to re-register with the correct email address.
	If you have forgotten your password, you can retrieve it from the forgotten password page

To find out which Twitter account your phone is connected to:
Arahkan ke twitter.com di komputer.
Klik link Activate your account yang ada di halaman awal seperti gambar di bawah ini.
Masukkan nomor telepon Anda saat diarahkan, beserta kode negara.
Jika nomor telepon Anda ditautkan ke akun Twitter, kami akan mengirim pesan teks ke telepon Anda yang berisi kode verifikasi. Gunakan kode ini untuk memastikan bahwa nomor ponsel itu milik Anda.
Di halaman berikut, Twitter akan meminta Anda untuk melengkapi profil Twitter Anda. Nama pengguna Anda sudah akan diisi. Nama pengguna itu milik akun yang sama dengan yang terkait dengan telepon Anda.

Possible errors:
If your number is connected to an account and you've already logged in on twitter.com before, the steps above will prompt you to log in with your username and email instead. Recover a lost password here. 
If your mobile number is not connected to any Twitter accounts, you'll see an error message. Sign up for a new account here. 
*/
	public function complete()
	{	
		
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'],
								'url'				=> site_url(),
								'image'				=> '',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->form_auth = $this->tb_form->build_form_auth();
		$this->render('include/header', array(
            'css' => $this->css
        ));
		$this->render('complete', array(
            'menu_title' => $this->menu_title,
            'form_auth' => $this->form_auth
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));

	}	
	public function passwordreset()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'],
								'url'				=> site_url(),
								'image'				=> '',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->form_auth = $this->tb_form->build_form_passwordreset();
		$this->render('include/header', array(
            'css' => $this->css
        ));
		$this->render('forgot/password', array(
            'menu_title' => $this->menu_title,
            'form_auth' => $this->form_auth
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
		
	
	
	
}
# nama file home.php
# folder apllication/controller/