<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Bower', array('CI' => $this));
		$this->load->library(array('Admin/Admin_form','Admin/Admin_css','Admin/Admin_javascript','Admin/Admin_dyn_menu','Admin/Admin_libraries'));
		$this->load->helper(array('form','cilm_limononoto','seo_helper','cookie'));
		$this->load->model(array('admin_model'));
		$this->_required_user();
		$this->_check_vaidity();
		$this->css = $this->admin_css->build_css();
		$this->js = $this->admin_javascript->build_javascript();	
		$this->navbar = $this->admin_dyn_menu->build_navbar();
		$this->navmenu = $this->admin_dyn_menu->build_menu();
		$this->menu_footer = $this->admin_dyn_menu->build_menu_footer();
		$this->menu_title = $this->admin_dyn_menu->build_menu_title();
		$this->property = $this->admin_dyn_menu->get_opengraph_property();
		$this->login = $this->session->userdata('login');
		$id = $this->login['id'];
		$this->javascript = null;
	}
		 
	public function index()
	{
		force_ssl();
		$this->manage = $this->admin_libraries->build_manage();
		$this->insert = $this->admin_form->form_manage();
		$this->javascript = $this->bower->js('default');
        $this->javascript[] = $this->bower->add(js_url().'admin/lm-select-form.js');
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
		$this->render('manage', array(
            'menu_title' => $this->menu_title,
            'insert' => $this->insert,
            'manage' => $this->manage
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
			'js' => $this->js,
			'javascript' => $this->javascript
        ));
	}
	public function load_manage()
	{
		$data			= array();
		$id = $this->input->post('id');
		 $this->manage = $this->admin_form->build_form_manage($id);
		 $load = $this->load->view('manage/page', array('manage'=>$this->manage));
		if($id && !empty($id) && $load != null){
		 echo json_encode($load);
		}
	}
	
}
# nama file home.php
# folder apllication/controller/