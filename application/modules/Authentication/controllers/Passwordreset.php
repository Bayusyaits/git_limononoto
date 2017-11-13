<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Passwordreset extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('bower', array('CI' => $this));
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dyn_medsos','Authentication/Auth_libraries','General/Tb_dyn_menu','General/Tb_dft_javascript','Password'));
		$this->load->helper(array('form','cilm_limononoto','language'));
		$this->load->model(array('object_model','menu_model','user_model'));
		$this->css = $this->tb_dhd_css->build_css();
		$this->menu_title = $this->tb_dyn_menu->build_menu_title();
		$this->menu_footer = $this->tb_dyn_menu->build_menu_footer();
		$this->js = $this->tb_dft_javascript->build_javascript();
		$this->javascript = null;
	}
	public function passwordreset(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('passwordreset'));
		$email = $this->input->post('email');
		$email = $this->security->xss_clean($email);		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		    $data['email'] = $this->lang->line('err_email_invalid');
 		if($this->form_validation->run() == true) {
			$plain_passwordreset = $this->auth_model->plain_passwordreset($email);
			if($plain_passwordreset == ERR_INVALID_UNLISTED){
				$data['message'] = 'Sorry, '.$email.' '.$this->lang->line('err_email_not_listed');				}
			elseif ($plain_passwordreset == ERR_INVALID_PASSWORD) {
				$data['password'] = $this->lang->line('err_password_invalid');	
				$data['message'] = $this->lang->line('err_password_invalid');		
			}
			elseif ($plain_passwordreset == ERR_INVALID_ACTIVATION) {
				$data['message'] = $this->lang->line('info_activation_invalid');			
			}
			elseif ($plain_passwordreset == ERR_INVALID_VERIFICATION) {
				$data['message'] = $this->lang->line('err_banned_account');				
			}
			elseif ($plain_passwordreset == ERR_INVALID_MODERATION) {
				$data['message'] = $this->lang->line('info_account_moderation');				
			}else{
				$data['success'] = true;
				$data['message'] = $this->lang->line('success_passwordreset');
				$data['redirect'] = 'api/passwordreset';
				$this->session->set_tempdata("password_reset", $this->auth_model->get_data(), 3600);
				}// else_empty
		}
		else {
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_passwordreset_failed_all');
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	//public funtion passwordreset
	
	public function resetpassword(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$password_reset = $this->session->tempdata('password_reset');
		$email = $password_reset['email'];
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('resetpassword'));
		$code = $this->input->post('code');
		$password = $this->input->post('password');
		$cpassword = $this->input->post('cpassword');
		$hash_resetpassword_password = $this->password->create_hash($password);
		$activation_code = generateRandomNumeric(6);
		$hash_activationcode_reset = $this->password->create_bcrypt($activation_code);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['email'] = $this->lang->line('err_email_invalid');
			$data['redirect_errors'] = 'passwordreset';
		if (empty($code))
		    $data['code'] = $this->lang->line('err_code_required');
		if(empty($password))
			$data['password'] = $this->lang->line('err_password_required');
		if (empty($cpassword))
		    $data['cpassword'] = $this->lang->line('err_cpassword_required');
		if($password != $cpassword)
			$data['password'] = $this->lang->line('err_password_required');
		
		if($this->form_validation->run() == true) {
			if($this->password->validate_bcrypt($code, $password_reset['activation_code'])) {
			$datauser = array(
		        'email' => $email,
		        'password' => $hash_resetpassword_password,
		        'activation_code' => $hash_activationcode_reset,
		        'forgotten_password_time' => time()
		    );	
				$plain_passwordreset = $this->auth_model->plain_resetpassword($datauser);
				if($plain_passwordreset == ERR_NONE){
					//$this->session->set_flashdata("error", "code Is Invalid");
					$plain_passwordreset = $this->auth_model->plain_login($password,$email);
				    $this->session->set_userdata("login", $this->auth_model->get_data());
					$data['success'] = true;
					$data['message'] = $this->lang->line('success_resetpassword');
					$data['redirect'] = 'api/login';
					$this->session->set_tempdata('password_reset', $this->lang->line('success_resetpassword'), 60);
				}
			}
			else {
				$data['success'] = false;
				$data['errors'] = $errors;
				$data['message'] = $this->lang->line('err_input_activation');
				$data['code'] = $this->lang->line('err_code_invalid');
			}	
					
		}
		else {
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_input_activation');
		
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}//else_resetpassword
	
	public function password()
	{	
		$this->title = 'Password Reset | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css
        ));
		$email = $this->input->get('e-mail');
		$activation = $this->input->get('activation');
		$password_reset = $this->session->tempdata('password_reset');
		if($this->input->get('pr') && $email == $password_reset['email'] && $password_reset['activation_code'] != null){
		$this->form_auth = $this->tb_form->build_form_activation_resetpassword();
			if($this->password->validate_bcrypt($activation, $password_reset['activation_code'])) {
				$this->render('forgot/resetpassword', array(
		            'menu_title' => $this->menu_title,
		            'form_auth' => $this->form_auth
		        ));	
			}else{
				$this->render('forgot/resetpassword', array(
		            'menu_title' => $this->menu_title,
		            'form_auth' => $this->form_auth
		        ));	
			}//else_validate_password
		}else {
		$this->session->set_tempdata('password_reset', null, 6);
		redirect('passwordreset');
		}//else_$get_vc
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));		
	}//public_confirmemail
}