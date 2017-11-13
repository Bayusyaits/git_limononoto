<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dft_javascript','User/User_dyn_menu', 'General/Tb_dyn_medsos','User/User_libraries','Facebook'));
		$this->load->helper(array('form','cilm_limononoto','seo_helper','cookie'));
		$this->load->model(array('menu_model','user_model'));
		$this->_required_user();
		$this->_check_vaidity();
		$this->css = $this->tb_dhd_css->build_css();
		$this->js = $this->tb_dft_javascript->build_javascript();	
		$this->navbar = $this->user_dyn_menu->build_navbar();
		$this->navmenu = $this->user_dyn_menu->build_menu();
		//navmenu belum di set
		//profile user (dari databasebelum diset)
		$this->menu_footer = $this->user_dyn_menu->build_menu_footer();
		$this->menu_title = $this->user_dyn_menu->build_menu_title_user();
		$this->facebook->enable_debug(TRUE);
		$this->property = $this->user_dyn_menu->get_opengraph_property();
		$this->login = $this->session->userdata('login');
		$id = $this->login['id'];
		$this->javascript = null;
	}
		 
	public function index()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'],
								'url'				=> site_url(),
								'image'				=> '',
								'description'		=>  $this->property['description']
							);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->load->vars(
							array('opengraph'=> $this->opengraph)
						);
		$this->render('include/header', array(
        'css' => $this->css,
        'navbar' => $this->navbar,
        'navmenu'=> $this->navmenu
        ));
		$this->render('rest_server', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
			'js' => $this->js
        ));
	}
	public function view_xml(){
	   header("Content-type: text/xml");
	   
	}
	
}
# nama file home.php
# folder apllication/controller/