<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('auth_lang');	
		$this->load->library('Bower', array('CI' => $this));
		$this->load->helper(array('form','cilm_limononoto','language','cookie'));
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dyn_medsos','Authentication/tb_dyn_menu','General/Tb_dft_javascript','Authentication/Auth_libraries','Password','Format','user_agent'));	
		$this->load->model(array('auth_model'));
		$this->css = $this->tb_dhd_css->build_css();
		$this->menu_title = $this->tb_dyn_menu->build_menu_title();
		$this->menu_footer = $this->tb_dyn_menu->build_menu_footer();
		$this->js = $this->tb_dft_javascript->build_javascript();
		$this->javascript = null;
	}
	
	public function signup_terms(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('signup_terms'));
		$email = $this->input->post('email');
		$email = $this->security->xss_clean($email);
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['email'] = $this->lang->line('err_email_required');
				
		if($this->form_validation->run() == true) {
			$plain_auth = $this->auth_model->plain_signup($email);
			if($plain_auth == ERR_INVALID_REGISTRATION){		
				$data['email'] = $this->lang->line('err_email_invalid');
				$data['errors'] = $errors;
				$data['message'] = "Sorry, $email".' '.$this->lang->line('err_email_exists');
			}else{
				$sign_up = $this->session->tempdata("sign_up");
				$datauser = array(
				        'email' => $email
				);
				$data['success'] = true;
				$data['message'] = $this->lang->line('email_verification_signup').' '.$email;
				$data['redirect'] = 'api/signup';
				$this->session->set_tempdata('sign_up', $datauser, 2400);
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
	//public funtion signup_terms
		
	public function activation(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$sign_up = $this->session->tempdata("sign_up");
		$email = $sign_up['email'];
		$this->form_validation->set_rules($this->config->item('activation'));
		$code = $this->input->post('code');
		$activation_code = generateRandomNumeric(6);
		$hash_activation_code = $this->password->create_bcrypt($activation_code);
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['email'] = $this->lang->line('err_data_exists');
			$data['redirect_errors'] = 'auth';
		if (empty($code))
		    $data['code'] = $this->lang->line('err_code_required');
		    
		
		if($this->form_validation->run() == true) {
					
			if($this->password->validate_bcrypt($code, $sign_up['activation_code'])) {
				//$this->session->set_flashdata("error", "code Is Invalid");
				$data['success'] = true;
				$data['message'] = $this->lang->line('success_activation_code');
				$data['redirect'] = 'api/signup';
				$datauser = array(
			        'email' => $email,
					'sent_email' => 0,
					'activation_code' => $sign_up['activation_code'],
					'activation' => 'Success'
			    );	
			    $data['redirect'] = 'auth/confirmemail?vc=p&e-m='.$sign_up['email'].'&activation='.$code;
				$this->session->set_tempdata("sign_up", $datauser, 2400);
			}
			else {
				$data['success'] = false;
				$data['code'] = $this->lang->line('err_code_invalid');
				$data['message'] = $this->lang->line('err_input_activation');
			}	
					
		}
		else {
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_input_activation');
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}//else_activation
	
	
	public function confirmemail()
	{	
		$this->title = 'Signup | Limononoto';
		$sign_up = $this->session->tempdata("sign_up");
		$email = $this->input->get('e-m');
		$activation = $this->input->get('activation');
		if($this->input->get('vc') && $email == $sign_up['email'] && $sign_up['activation_code'] != null){		
		if($this->auth_libraries->email_check($email) == '0') {		
			$this->render('include/header', array(
	            'css' => $this->css
	        ));
	        $this->javascript = $this->bower->js('default');
	        $this->javascript[] = $this->bower->add(js_url().'/jquery/lm-select-form.js');
	        $this->output->cache(6); // Will expire in 6 minutes
			if($this->password->validate_bcrypt($activation, $sign_up['activation_code'])) {
				$datauser = array(
				        'email' => $email,
						'sent_email' => 'Success',
						'activation_code' => $sign_up['activation_code'],
						'activation' => $activation
				);
			    $this->session->set_tempdata('sign_up', $datauser, 2400);
			    $this->form_auth = $this->tb_form->build_form_signup();
				$this->render('signup', array(
			            'menu_title' => $this->menu_title,
			            'form_auth' => $this->form_auth
			        ));
			}else if($this->password->validate_bcrypt($sign_up['activation'], $sign_up['activation_code'])) {
				$this->form_auth = $this->tb_form->build_form_signup();
				$this->render('signup', array(
			            'menu_title' => $this->menu_title,
			            'form_auth' => $this->form_auth
			        ));	
			}
			else{
			$this->form_auth = $this->tb_form->build_form_activation();
			$this->render('activation', array(
			            'menu_title' => $this->menu_title,
			            'form_auth' => $this->form_auth
			        ));	
			}//else_validate_password
			$this->render('include/footer', array(
	            'menu_footer' => $this->menu_footer,
	            'js' => $this->js,
	            'javascript' => $this->javascript
	        ));
		}else {
		$this->session->set_tempdata('sign_up', null, 6);
		redirect('signup');	
		
		}//else_email_check
		}else {
		$this->session->set_tempdata('sign_up', null, 6);
		redirect('auth');
		}//else_$get_vc
	}//public_confirmemail
	
	public function signup(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$this->form_validation->set_rules($this->config->item('signup'));
		$sign_up = $this->session->tempdata("sign_up");
		$email = $sign_up['email'];
		$activation = $sign_up['activation'];
		$lm_ui_signup_firstname = $this->security->sanitize_filename($this->input->post('firstname'));
		$lm_ui_signup_lastname = $this->security->sanitize_filename($this->input->post('lastname'));
		$lm_ui_signup_password = $this->input->post('password');
		$lm_ui_signup_cpassword = $this->input->post('cpassword');
		$lm_ui_signup_select_level = $this->input->post('level');
		$lm_ui_signup_select_country = $this->input->post('country');
		$hash_signup_password = $this->password->create_hash($lm_ui_signup_cpassword);
		$firstname = $this->security->xss_clean($lm_ui_signup_firstname);
		$lastname = $this->security->xss_clean($lm_ui_signup_lastname);
		
		if(empty($sign_up))
			$data['session'] = $this->lang->line('err_no_session');
			$data['redirect'] = 'auth';
			
		if(empty($lm_ui_signup_cpassword))
			$data['cpassword'] = $this->lang->line('err_cpassword_required');
		
		if (empty($lm_ui_signup_firstname))
		    $data['firstname'] = $this->lang->line('err_firstname_required');
		    
		if (empty($lm_ui_signup_lastname))
		    $data['lastname'] = $this->lang->line('err_lastname_required'); 
		    
		if (empty($lm_ui_signup_password))
		    $data['password'] = $this->lang->line('err_password_required');
		    
		if (empty($lm_ui_signup_select_level))
		    $data['level'] = $this->lang->line('err_level_required');

		if (empty($lm_ui_signup_select_country))
		    $data['country'] = $this->lang->line('err_country_required');	
		    
		if($this->form_validation->run() == false) {
			$data['success'] = false;
			$data['errors'] = $errors;
			$data['message'] = $this->lang->line('err_input_activation');
		}
		else {
		if($this->password->validate_password($lm_ui_signup_password, $hash_signup_password))  {
			$time = time();
			$password_hash = $this->password->create_hash($lm_ui_signup_password);
			$activation_code = generateRandomNumeric(6);
			$token_salt = generateToken(20);
			$hash_activation_code = $this->password->create_bcrypt($activation_code);
			$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
			$create_id = insert_id_user($lm_ui_signup_select_level);
			$data_user = array(
                'id'=>encrypt_plaintext($create_id),
                'username'=>encrypt_plaintext($firstname.''.$lastname),
                'first_name'=>encrypt_plaintext($firstname),
                'last_name'=>encrypt_plaintext($lastname),
                'email' => $this->db->escape(encrypt_email($email)),
                'password' => $password_hash,
                'activation_code' => $hash_activation_code,
                'created_on' => encrypt_plaintext($time),
                'ip' => encrypt_plaintext($ip),
                'platform' => encrypt_plaintext($user_agent),
                'levels_id' => encrypt_plaintext($lm_ui_signup_select_level),
                'country_id' => encrypt_plaintext($lm_ui_signup_select_country),
                'salt' => $token_salt,
                'activation'=>encrypt_plaintext(3)
            );
            
			$insert_data = $this->auth_model->insert_user($data_user);
			
			if($insert_data == ERR_NONE) {						
			//insert_user
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
		} else {
			$data['success'] = false;
			$data['errors'] = $errors;
			$data['message'] = $this->lang->line('err_input_activation');
		}	
					
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	}