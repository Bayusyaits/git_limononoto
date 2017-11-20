<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ud extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Password','Format'));
		$this->load->helper(array('cilm_limononoto','language'));
		$this->lang->load('auth_lang');	
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
		 
	public function update()
	{
		$errors         = array();      // array to hold validation errors
		$data			= array('csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash());
		$this->config->load('validation_rules');
	    $config = $this->config->item('update_user');
	    $this->form_validation->set_rules($config);
	    $id = $this->input->post('id');
	    $firstname = $this->security->sanitize_filename($this->input->post('firstname'));
		$lastname = $this->input->post('lastname');
		$email = $this->security->xss_clean($this->input->post('email'));
		$level = $this->input->post('level');
	    $message = ['status'=>FALSE,'message'=>'failed user_put'];
		if($this->form_validation->run() == true)  {
			$data['success'] = true;
			$data['message'] = $this->lang->line('success_signup');
			$data['redirect'] = 'auth';
			$this->session->set_tempdata('sign_up',null,6);	
			$this->session->set_tempdata("moderate", true,3600);	
			}else {
			$data['success'] = false;
			$data['errors'] = $errors;
			$data['message'] = $this->lang->line('err_input_activation');
			}//else_insert_user
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function delete()
	{
		
	}
	
}
# nama file home.php
# folder apllication/controller/