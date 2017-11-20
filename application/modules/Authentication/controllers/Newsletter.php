<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('General/Tb_form','Authentication/Auth_libraries','Password','Format'));
		$this->load->helper(array('cilm_limononoto','language'));
		$this->load->model(array('validation_model'));
		$this->lang->load('validation_lang');	
	}
	/**
	 * Cotoh penggunaan bootstrap pada codeigniter::index()
	 */   
	
	public function index(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('newsletter'));
		$email = $this->input->post('email');
		$email = $this->security->xss_clean($email);
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['email'] = $this->lang->line('err_email_required');
				
		if($this->form_validation->run() == true) {
			$plain_newsletter = $this->validation_model->plain_newsletter('tb_cli_newsletter',$email);
			if($plain_newsletter == ERR_INVALID_REGISTRATION){		
				$data['email'] = $this->lang->line('err_email_invalid');
				$data['errors'] = $errors;
				$data['message'] = "Sorry, $email".' '.$this->lang->line('err_email_exists');
			}else{
				$sign_up = $this->session->tempdata("sign_up");
				$datauser = array(
				        'email' => $email
				);
				$data['success'] = true;
				$data['message'] = $this->lang->line('success_newsletter').' '.$email;
				$data['redirect'] = 'api/newsletter';
				$this->session->set_tempdata('newsletter', $datauser, 600);
			}
			//else_email is invalid	
					
		}
		else {
			
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_email_invalid');
		
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	//public funtion login
	
	
	
}

# nama file home.php
# folder apllication/controller/