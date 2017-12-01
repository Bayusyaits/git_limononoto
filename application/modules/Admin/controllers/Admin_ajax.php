<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ajax extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Password','Format'));
		$this->load->helper(array('cilm_limononoto','language'));
		$this->lang->load('admin_lang');	
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
		$activation = $this->input->post('activation_user');
		$country = $this->input->post('country');
	    if(empty($this->login) || !$this->login)
			$data['session'] = $this->lang->line('err_no_session');
			$data['redirect'] = 'auth';
		
		if (empty($id))
		    $data['id'] = $this->lang->line('err_id_required');
				    
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		    $data['email'] = $this->lang->line('err_email_required');
		
		if (empty($firstname))
		    $data['firstname'] = $this->lang->line('err_firstname_required');
		    
		if (empty($lastname))
		    $data['lastname'] = $this->lang->line('err_lastname_required'); 
		    
		if (empty($level))
		    $data['level'] = $this->lang->line('err_level_required');

		if (empty($country))
		    $data['country'] = $this->lang->line('err_country_required');
		if (empty($activation))
		    $data['activation'] = $this->lang->line('err_activation_required');	
	    
		if($this->form_validation->run() == true)  {
			$data_user = array(
                'username'=>encrypt_plaintext($firstname.''.$lastname),
                'first_name'=>encrypt_plaintext($firstname),
                'last_name'=>encrypt_plaintext($lastname),
                'email' => $this->db->escape(encrypt_email($email)),
                'levels_id' => encrypt_plaintext($level),
                'country_id' => encrypt_plaintext($country),
                'activation'=>encrypt_plaintext($activation)
            );
            $update = $this->admin_model->update_user($data_user,$id);
			if ($update == ERR_NONE) {
			$data['success'] = true;
			$data['id'] = $id;
			$data['name'] = ucfirst($firstname).' '.ucfirst($lastname);
			$data['id'] = $id;
			$data['email'] = $email;
			$data['message'] = $this->lang->line('success_update');
			}else{
			$data['success'] = false;
			$data['errors'] = $errors;
			$data['message'] = $this->lang->line('err_update');	
			}
			}else {
			$data['success'] = false;
			$data['errors'] = $errors;
			$data['message'] = $this->lang->line('err');
			}//else_insert_user
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function delete()
	{
	$errors         = array();      // array to hold validation errors
	$data			= array('csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash());
    $this->config->load('validation_rules');
    $config = $this->config->item('delete_user');
    $this->form_validation->set_rules($config);
    $id = $this->input->post('id');
    $email = $this->security->xss_clean($this->input->post('email'));
	$level = $this->input->post('level');
	if (empty($id))
	    $data['id'] = $this->lang->line('err_id_required');
	if (empty($email))
	    $data['email'] = $this->lang->line('err_email_required');
	if (empty($level))
		$data['level'] = $this->lang->line('err_level_required');
	if ($this->form_validation->run() == TRUE) {
    $delete = $this->admin_model->delete_user($id);
	if($delete == ERR_NONE){
	$data['success'] = true;
	$data['id'] = $id;
	$data['message'] = $this->lang->line('success_delete');
	}else{
	$data['success'] = false;
	$data['errors'] = $errors;
	$data['message'] = $this->lang->line('err_delete');	
	}
	}else{
	$data['success'] = false;
	$data['errors'] = $errors;
	$data['message'] = $this->lang->line('err_rules');		
	}		
	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
}
# nama file home.php
# folder apllication/controller/