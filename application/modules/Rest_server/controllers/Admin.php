<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'modules/Rest_server/controllers/Rest_data.php';

class Admin extends REST_data
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    
	// Load config from file: config/jwt.php
    public function __construct()
	{
		parent::__construct();	
		$this->lang->load('auth_lang');		
		$this->load->library(array('Authenticaion/Auth_libraries','Rest_server/auth_jwt','user_agent','form_validation','Password','Format','user_agent'));
		$this->load->helper(array('authorization','jwt','asset'));
		$this->load->model(array('user_model','rest_model','auth_model'));
	}
		
    public function manage_get()
    {
    $id = (int) $this->get('id',TRUE);
    $sign_up = $this->session->tempdata("sign_up");
	$email = $sign_up['email'];    
    $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $id,"email" => $email, "admin" => false));
    /**$decode = $this->auth_jwt->decode($output);*/
    //Check email = 0
    $check = $this->auth_libraries->check_email($email);
    $invalidSignup = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid checktokensignup!!'];
    if($check){
	$this->set_response($output, Rest_data::HTTP_OK);
	//redirect('contact');
    }else{
	$this->response($invalidSignup, Rest_data::HTTP_BAD_REQUEST);
	//redirect('contact');
    }    
    }
    
    public function insert_post()
    {
    
    $errors         = array();
    $_data 		    = array();
	$this->config->load('validation_rules');
    $config = $this->config->item('insert_user');
    $this->form_validation->set_rules($config);
	//Post 
	$firstname = $this->security->sanitize_filename($this->input->post('firstname'));
	$lastname = $this->input->post('lastname');
	$email = $this->security->xss_clean($this->input->post('email'));
	$password = $this->input->post('password');
	$cpassword = $this->input->post('cpassword');
	$level = $this->input->post('level');
	$country = $this->input->post('country');
    $message_failed = ['status'=>FALSE,'email'=>$email,'message'=>$this->lang->line('err_rules')];
    $password_hash = $this->password->create_hash($cpassword);    
    //kondisi
    $plain_insert = $this->auth_model->plain_signup($email);
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = TRUE;
			$_data['email']   = $this->lang->line('err_email_required');
		}else if($plain_insert == ERR_INVALID_REGISTRATION){	
			$errors['email'] = TRUE;
			$_data['email'] = $this->lang->line('err_email_exists'); 
		}else{
			$_data['email'] = ''; 
		}
		if(empty($firstname)){
			$errors['firstname'] = TRUE;
			$_data['firstname'] = $this->lang->line('err_firstname_required'); 
		}else{
			$_data['firstname'] = ''; 
		}
		if(empty($lastname)){
			$errors['lastname'] = TRUE;
			$_data['lastname'] = $this->lang->line('err_lastname_required'); 
		}else{
			$_data['lastname'] = ''; 
		}
		if(empty($password)){
			$errors['password'] = TRUE;
			$_data['password'] = $this->lang->line('err_password_required'); 
		}else if(!$this->password->validate_password($password, $password_hash))  {
			$errors['password'] = TRUE;
			$_data['password'] = $this->lang->line('err_password_notmatch'); 
		}else{
			$_data['password'] = ''; 
		}
		if(empty($cpassword)){
			$errors['cpassword'] = TRUE;
			$_data['cpassword'] = $this->lang->line('err_cpassword_required'); 
		}else{
			$_data['cpassword'] = ''; 
		}
		if(empty($level)){
			$errors['level'] = TRUE;
			$_data['level'] = $this->lang->line('err_level_required'); 
		}else{
			$_data['level'] = ''; 
		}
		if(empty($country)){
			$errors['country'] = TRUE;
			$_data['country'] = $this->lang->line('err_country_required'); 
		}else{
			$_data['country'] = ''; 
		}
		if(!empty($errors)){
			$errors['warning'] = TRUE;
			$_data['warning'] = $this->lang->line('err_create'); 
		}else{
			$_data['warning'] = $this->lang->line('succes_create'); 
		}	
		
		if ($this->form_validation->run() == TRUE and empty($errors)) {
			
			$time = time();
			$activation_code = generateRandomNumeric(6);
			$token_salt = generateToken(20);
			$hash_activation_code = $this->password->create_bcrypt($activation_code);
			$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
			$create_id = insert_id_user($level);
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
                'levels_id' => encrypt_plaintext($level),
                'country_id' => encrypt_plaintext($country),
                'salt' => $token_salt,
                'activation'=>encrypt_plaintext(5)
            );
			$insert_data = $this->rest_model->insert_user($data_user);
			if($insert_data == ERR_NONE) {
			$this->session->set_flashdata("sent", $_data);
			redirect('admin/manage');
			$this->set_response($output,Rest_data::HTTP_OK);
			}else{
			$this->session->set_flashdata("sent", $_data);
	        redirect('admin/manage'); 
	   		$this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);	
			}
		}else {
	    	$this->session->set_flashdata("sent", $_data);
	        redirect('admin/manage'); 
	   		$this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);
	    }//else_validation
		
    }
       
    }
    
    