<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Errors extends MY_Controller {

	// Override 404 error
	// Match with $route['404_override'] value from /application/config/routes.php
	/*https://github.com/maltyxx/bower*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('General/Facebook','General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dft_javascript','General/Tb_dyn_menu', 'General/Tb_dyn_medsos','General/Tb_profile','General/Bower'));
		$this->load->helper(array('form','cilm_limononoto'));
		$this->load->model(array('menu_model'));
		$this->lang->load('error_pages_lang');	
		$this->navbar = $this->tb_dyn_menu->build_navbar_errors();	
		$this->menu_footer = $this->tb_dyn_menu->build_menu_footer();	
	}
	public function page_missing()
	{
		$this->load->add_package_path(APPPATH.'third_party/bower');
        $this->load->remove_package_path(APPPATH.'third_party/bower');
        $this->css = $this->bower->css('default');
        $this->css[] = $this->bower->add(css_url().'lm-cilm.css', array('embed' => TRUE));
		$this->js = $this->bower->js('default');
        $this->js[] = $this->bower->add(js_url().'/jquery/jquery.min.js');
		$this->output->set_status_header('404');
		$this->title = '404 | Limononoto';	
		$this->render('errors/templates/include/public/lm-header', array(
            'css' => $this->css,
            'navbar' => $this->navbar
        ));	
        $this->render('errors/cli/error_404');
        $this->render('errors/templates/include/public/lm-footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));

	}
	
	public function bad_gateway()
	{
		$this->load->add_package_path(APPPATH.'third_party/bower');
        $this->load->remove_package_path(APPPATH.'third_party/bower');
        $this->css = $this->bower->css('default');
        $this->css[] = $this->bower->add(css_url().'lm-cilm.css', array('embed' => TRUE));
		$this->js = $this->bower->js('default');
        $this->js[] = $this->bower->add(js_url().'/jquery/jquery.min.js');
		$this->output->set_status_header('502');
		$this->title = '502 | Limononoto';	
		$this->render('errors/templates/include/public/lm-header', array(
            'css' => $this->css,
            'navbar' => $this->navbar
        ));	
        $this->render('errors/cli/error_general');
        $this->render('errors/templates/include/public/lm-footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));

	}
}