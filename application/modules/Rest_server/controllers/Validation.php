<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'modules/Rest_server/controllers/Rest_data.php';

class Validation extends REST_data
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    
	// Load config from file: config/jwt.php
    public function __construct()
	{
		parent::__construct();		
	    $this->load->library(array('Authenticaion/Auth_libraries','Rest_server/auth_jwt','Authentication/Recaptcha','user_agent','form_validation'));
		$this->load->helper(array('authorization','jwt','asset'));
		$this->load->model(array('validation_model'));	
	}
	
	
	public function applicant_get()
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
	redirect('contact/join');
    }else{
	$this->response($invalidSignup, Rest_data::HTTP_BAD_REQUEST);
	redirect('contact/join');
    }    
    }
	
    public function applicant_post()
    {	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    $errors         = array();
        $_data 		    = array();
		$this->config->load('validation_rules');
        $config = $this->config->item('join');
        $this->form_validation->set_rules($config);
		//Post 
		$email	 	= $this->input->post('email');
		$firstname = $this->security->sanitize_filename($this->input->post('firstname'));
		$lastname = $this->input->post('lastname');
		$email = $this->security->xss_clean($this->input->post('email'));
		$phonenumber = $this->security->sanitize_filename($this->input->post('phonenumber'));
		$message = $this->security->sanitize_filename($this->input->post('answer'));
		$message = nl2br($message);
		$subject = $this->input->post('department');		
		$userfile = 'ufile';
		$recaptcha = $this->input->post('g-recaptcha-response');
        $object = new Recaptcha();
		$response = $object->verifyResponse($recaptcha);
	    $message_failed = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid Credentials!!'];
	    $upload_file = count($_FILES[$userfile]['name']);
	    //kondisi
	    if(empty($firstname)){
			$errors['firstname'] = TRUE;
			$_data['firstname'] = $this->lang->line('err_firstname_required'); 
		}else{
			$_data['firstname'] = ''; 
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = TRUE;
			$_data['email']   = $this->lang->line('err_email_required');
		}else{
			$_data['email'] = ''; 
		}
		/*phonenumber = +11234567890*/
		if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $phonenumber) )
		{
			$phonenumber = $phonenumber;
			$_data['phonenumber'] = ''; 

		}else{
			$errors['phonenumber'] = TRUE;
			$_data['phonenumber'] = $this->lang->line('err_phonenumber_required');
			$phonenumber = '';
		}
		if(empty($subject)){
			$errors['subject'] = TRUE;
			$_data['subject'] = $this->lang->line('err_subject_required'); 
		}else{
			$_data['subject'] = ''; 
		}
		if(empty($message)){
			$errors['answer'] = TRUE;
			$_data['answer'] = $this->lang->line('err_message_required'); 
		}else{
			$_data['answer'] = ''; 
		}	
		if(!$_FILES[$userfile]['name'][0] || $upload_file > 2){
			$errors['resume'] = TRUE;
			$_data['resume'] = $this->lang->line('err_upload_required'); 
			$resume = '';
		}else{
			$_data['resume'] = '';
			$resume = encrypt_plaintext($_FILES[$userfile]['name'][0]);
		}
		if(!$_FILES[$userfile]['name'][1]){
			$cover_letter = '';
		}else{
			$cover_letter = encrypt_plaintext($_FILES[$userfile]['name'][0]);
		}
		if(!empty($errors)){
			$errors['warning'] = TRUE;
			$_data['warning'] = $this->lang->line('err_send_message'); 
		}else{
			$_data['warning'] = $this->lang->line('succes_send_message'); 
		}	
	    if ($this->form_validation->run() == TRUE and isset($response['success']) and $response['success'] === true and empty($errors)) {
	       	$create_id = insert_id_job_aplicant($subject);
	       	$upload_path = 'contact/join/'.$create_id;
			$time = time();
			$token = generateRandomString(16);
	       	$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
			$output['id_token'] = $this->auth_jwt->encode($data = array("id" => $create_id,"email" => $email));
			$data_user = array(
				'id'=>encrypt_plaintext($create_id),
                'first_name'=>encrypt_plaintext($firstname),
                'last_name'=>encrypt_plaintext($lastname),
                'email' => encrypt_plaintext($email),
                'message' => encrypt_plaintext($message),
                'resume' => $resume,
                'cover_letter' => $cover_letter,
                'token' => encrypt_plaintext($token),
                'created_on' => $time,
                'ip' => encrypt_plaintext($ip),
                'platform' => encrypt_plaintext($user_agent),
                'phone_number' => encrypt_plaintext($phonenumber),
                'department_id' => $subject,
                'menu_id'=>'532061',
                'reply_to_message'=>'0'
            );
            
			$data = array(
            	'resume' => $resume,
                'cover_letter' => $cover_letter,
                'upload' => $userfile,
                'first_name' => $firstname,
            	'message' => $message,
            	'phone_number' => $phonenumber,
            	'department_id' => $subject,
                'email' => $email
            );
	        $plain_data  = $this->validation_model->plain_data_join($data);
	        if($plain_data == ERR_NONE){
	         $this->load->library('upload', multiple_upload($upload_path,$userfile));
	        $insert_data = $this->validation_model->insert_data_join($data_user);   
            }else{
	          $insert_data = TRUE; 
			  delete_file_upload($upload_path); 
            }
            if($insert_data == TRUE) {
	        $this->set_response($output,Rest_data::HTTP_OK);
	        $this->auth_libraries->unset_errors('join_errors');
			$this->session->set_flashdata("sent", $_data);
			redirect('contact/join');
	        }else{
	        $this->session->set_flashdata("sent", $_data);
            redirect('contact/join');
			$this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);
	        }
	    }else {
	    	$this->session->set_flashdata("sent", $_data);
	        redirect('contact/join'); 
	   		$this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);
	    }
	    }
    
  
    public function contact_get()
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
	redirect('contact');
    }else{
	$this->response($invalidSignup, Rest_data::HTTP_BAD_REQUEST);
	redirect('contact');
    }    
    }
    
	public function contact_post()
    {	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    $errors         = array();
        $_data 		    = array();
        $this->config->load('validation_rules');
        $config = $this->config->item('contact');
        $this->form_validation->set_rules($config);
		//Post 
		$email	 	= $this->security->xss_clean($this->input->post('email'));
		$firstname = $this->security->sanitize_filename($this->input->post('firstname'));
		$lastname = $this->input->post('lastname');
		$phonenumber = $this->input->post('phonenumber');
		$message = $this->security->sanitize_filename($this->input->post('message'));
		$message = nl2br($message);
		$subject = $this->input->post('subject');
		$recaptcha = $this->input->post('g-recaptcha-response');
        $object = new Recaptcha();
		$response = $object->verifyResponse($recaptcha);
	    $message_failed = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid Credentials!!'];
	    
	    //kondisi
	    if(empty($firstname)){
			$errors['firstname'] = TRUE;
			$_data['firstname'] = $this->lang->line('err_firstname_required');
		}else{
			$_data['firstname'] = ''; 
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = TRUE;
			$_data['email']   = $this->lang->line('err_email_required'); 
		}else{
			$_data['email'] = ''; 
		}
		/*phonenumber = +11234567890*/
		if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $phonenumber) )
		{
			$phonenumber = $phonenumber;
			$_data['phonenumber'] = ''; 

		}else{
			$errors['phonenumber'] = TRUE;
			$_data['phonenumber'] = $this->lang->line('err_phonenumber_required'); 
			$phonenumber = '';
		}
		if(empty($subject)){
			$errors['subject'] = TRUE;
			$_data['subject'] = $this->lang->line('err_subject_required'); 
		}else{
			$_data['subject'] = ''; 
		}
		if(empty($message)){
			$errors['message'] = TRUE;
			$_data['message'] = $this->lang->line('err_message_required'); 
		}else{
			$_data['message'] = ''; 
		}	
		if(!empty($errors)){
			$errors['warning'] = TRUE;
			$_data['warning'] = $this->lang->line('err_send_message'); 
		}else{
			$_data['warning'] = $this->lang->line('succes_send_message'); 
		}
	    
	    if ($this->form_validation->run() == TRUE and isset($response['success']) and $response['success'] === true and empty($errors)) {
	       	$create_id = insert_id_contact($subject);
			$time = time();
			$token = generateRandomString(16);
	       	$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
			$output['id_token'] = $this->auth_jwt->encode($data = array("id" => $create_id,"email" => $email));
			$data_user = array(
				'id'=>encrypt_plaintext($create_id),
                'first_name'=>encrypt_plaintext($firstname),
                'last_name'=>encrypt_plaintext($lastname),
                'email' => encrypt_email($email),
                'message' => encrypt_plaintext($message),
                'token' => encrypt_plaintext($token),
                'created_on' => $time,
                'ip' => encrypt_plaintext($ip),
                'platform' => encrypt_plaintext($user_agent),
                'phone_number' => encrypt_plaintext($phonenumber),
                'subject_id' => $subject,
                'menu_id'=>'53206',
                'reply_to_message'=>'0'
            );
			$data = array(
                'first_name' => $firstname,
            	'message' => $message,
            	'phone_number' => $phonenumber,
            	'subject_id' => $subject,
                'email' => $email
            );
	        $plain_data  = $this->validation_model->plain_data_contact($data);
	        if($plain_data == ERR_NONE){
	        $insert_data = $this->validation_model->insert_data_contact($data_user);   
            }else{
	          $insert_data = TRUE;
            }
            if($insert_data == TRUE) {
	        $this->set_response($output,Rest_data::HTTP_OK);
	        $this->auth_libraries->unset_errors('contact_errors');
			$this->session->set_flashdata("sent", $_data);
			redirect('contact');
	        }else{
	        $this->session->set_flashdata("sent", $_data);
	        redirect('contact');
			$this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);
	        }
	    }else {
	     $this->session->set_flashdata("sent", $_data);
	     redirect('contact');
	      $this->set_response($message_failed, Rest_data::HTTP_BAD_REQUEST);
	    }
	    }
	    public function newsletter_post()
		    {
			$email	 	= $this->input->post('email', true);
		    $invalidNewsletter = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid Credentials!!'];
		    $checkuser = $this->validation_model->plain_validation('tb_cli_newsletter',$email);
		    $create_id = insert_id_newsletter();
			$time = time();
		    $token = generateRandomString(16);
	       	$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
		    $data_user = array(
				'id'=>encrypt_plaintext($create_id),
                'email' => encrypt_email($email),
                'token' => encrypt_plaintext($token),
                'created_on' => $time,
                'ip' => encrypt_plaintext($ip),
                'platform' => encrypt_plaintext($user_agent),
                'status'=>encrypt_plaintext('subscribed')
            );
            $insert_data = $this->validation_model->insert_cli_newsletter($data_user); 
            $output['id_token'] = $this->auth_jwt->encode($data = array("id" => count_user() + 1,"email" => $email));
		    if ($insert_data == ERR_NONE) {
		    redirect('home');
	        $this->set_response($output,Rest_data::HTTP_CREATED);
		    }else {
		    redirect('home');
		    $this->response($invalidNewsletter,Rest_data::HTTP_BAD_REQUEST);
		    }
		    }
	public function newsletter_get()
    {
    		$newsletter = $this->session->tempdata("newsletter");
			$email = $newsletter['email']; 
			if(!empty($email)){
		    $invalidNewsletter = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid Credentials!!'];
		    $checkuser = $this->validation_model->plain_validation('tb_cli_newsletter',$email);
		    $create_id = insert_id_newsletter();
			$time = time();
		    $token = generateRandomString(16);
	       	$user_agent = $this->input->user_agent();
			$ip = $this->input->ip_address();
		    $data_user = array(
				'id'=>encrypt_plaintext($create_id),
                'email' => encrypt_email($email),
                'token' => encrypt_plaintext($token),
                'created_on' => $time,
                'ip' => encrypt_plaintext($ip),
                'platform' => encrypt_plaintext($user_agent),
                'status'=>encrypt_plaintext('subscribed')
            );
            $insert_data = $this->validation_model->insert_cli_newsletter($data_user); 
            $output['id_token'] = $this->auth_jwt->encode($data = array("id" => count_user() + 1,"email" => $email));
		    if ($insert_data == ERR_NONE) {
		    redirect('home');
	        $this->set_response($output,Rest_data::HTTP_CREATED);
		    }else {
		    redirect('home');
		    $this->response($invalidNewsletter,Rest_data::HTTP_BAD_REQUEST);
		    }
		    }else{
			redirect('home');
		    $this->response($invalidNewsletter,Rest_data::HTTP_NOT_FOUND);    
		    }
		    }
	    
    }
    
    