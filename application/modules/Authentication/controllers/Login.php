<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('General/Tb_form','Authentication/Auth_libraries','Password','Format'));
		$this->load->helper(array('cilm_limononoto','language'));
		$this->load->model(array('auth_model'));
		$this->lang->load('auth_lang');	
	}
	/**
	 * Cotoh penggunaan bootstrap pada codeigniter::index()
	 */   
	
	public function login(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('login'));
		$email = $this->input->post('email');
		$email = $this->security->xss_clean($email);
		$password = $this->input->post('password');
		$token = generateToken(20);
		$token_hash = $this->password->create_bcrypt($token);
		$link = 'api/login';		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['email'] = $this->lang->line('err_email_invalid');
		
		if (empty($password))
		    $data['password'] = $this->lang->line('err_password_invalid');
		
		if($this->form_validation->run() == true) {
			$matching = array('email' => $email);
			$plain_login = $this->auth_model->plain_login($password,$email);
			if($plain_login == ERR_INVALID_UNLISTED){
				$data['message'] = 'Sorry, '.$email.' '.$this->lang->line('err_email_not_listed');	
			}
			elseif ($plain_login == ERR_INVALID_PASSWORD) {
				//$this->session->set_flashdata("error", "Password Is Invalid");
				$data['password'] = $this->lang->line('err_password_invalid');	
				$data['message'] = $this->lang->line('err_password_invalid');		
			}
			elseif ($plain_login == ERR_INVALID_ACTIVATION) {
				//$this->session->set_flashdata("error", "Password Is Invalid");
				$data['message'] = $this->lang->line('info_activation_invalid');			
			}
			elseif ($plain_login == ERR_INVALID_VERIFICATION) {
				//$this->session->set_flashdata("error", "Password Is Invalid");
				$data['message'] = $this->lang->line('err_banned_account');				
			}
			elseif ($plain_login == ERR_INVALID_MODERATION) {
				//$this->session->set_flashdata("error", "Password Is Invalid");
				$data['message'] = $this->lang->line('info_account_moderation');				
			}else{
				if($this->session->userdata('twofactor') == TWOFACTOR_EMAIL)
				$link = 'send-email/login';
				if($this->session->userdata('twofactor') == TWOFACTOR_SMS)
				$link = 'contact?sms';
				$data['success'] = true;
				$data['message'] = $this->lang->line('success_login');
				$data['redirect'] = $link;	
				$this->session->set_userdata("login", $this->auth_model->get_data());
		}// else_empty
		}else {
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_login_failed_all');
		}// else_empty
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	//public funtion login
	
	
	
}

# nama file home.php
# folder apllication/controller/