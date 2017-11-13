<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('Bower', array('CI' => $this));
		$this->load->library(array('General/Tb_dhd_css','General/Tb_dft_javascript','Admin/Admin_dyn_menu','Admin/Admin_libraries'));
		$this->load->helper(array('form','cilm_limononoto','seo_helper','cookie'));
		$this->load->model(array('menu_model','admin_model'));
    }
	public function Admin()
	{
		force_ssl();
		$this->title = 'Dashboard | Limononoto';
		$this->render('include/header', array(
        ));
		$this->render('rest_server', array(
        ));
		$this->render('include/footer', array(
        ));
	}
  	
}//class user_member_model

?>