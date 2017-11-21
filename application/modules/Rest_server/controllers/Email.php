<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'modules/Rest_server/controllers/Rest_data.php';

class Email extends REST_data {
/*
	rubah session email, id ke jwt token
*/	
	public function __construct()
	{
		parent::__construct();
		$this->cektoken();
		$this->load->library(array('Password','Format','Rest_server/My_email'));
		$this->load->helper(array('authorization','cilm_limononoto'));
		$this->load->model(array('validation_model'));	
	}
	
	public function signup_get()
    {
        $sign_up = $this->session->tempdata("sign_up");
	    $send_to_email = $sign_up['email'];
	    $code = generateRandomNumeric(6);
		$hash_activation_code = $this->password->create_bcrypt($code);
		$invalidSignup = ['status'=>FALSE,'email'=>$send_to_email, 'message'=>'Invalid Password!!'];
	    $subject_email = 'Please Verify Your Email';
	    $datauser = array(
		        'email' => $send_to_email,
				'sent_email' => 1,
				'activation_code' => $hash_activation_code,
				'activation' => 'Success'
		);
	    $data = array(
	     'title'=> 'Confirm Email | Limononoto Design',
	     'subject'=> $subject_email,
	     'email'=> $send_to_email,
	     'paragraph'=> "<span style='display:block'>You have registered to become a Limononoto member.</span> To confirm that this is your email, please insert the Verification Code: <strong style='color: #676767'>$code</strong> on the verification page or click the button below</p>",
	     'code'=> $code,
	     'link'=> base_url()."auth/confirmemail?vc=p&e-m=".$send_to_email."&activation=".$code,
	         );
		$verify_email = $this->my_email->verif_email($data,5371502);
	    if($verify_email == true)
	    {
	      $this->session->set_tempdata('sign_up', $datauser, 2400);
	      redirect("auth/confirmemail?vc=p&e-m=".$send_to_email);
	      $this->set_response($data,Rest_data::HTTP_OK);
	    }
	    else
	    {
	      $this->session->set_tempdata('sign_up', null, 6);
		  redirect("auth?failed");
		  $this->response($invalidSignup,Rest_data::HTTP_BAD_REQUEST);	
	      //show_error($this->email->print_debugger());
	    }//else_email_send
    }
    /**
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function signup_post()
    {
        $id = (int) $this->get('id',TRUE);
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
		$email	 	= $this->input->post('email', true);
	    $invalidSignup = ['status'=>FALSE,'email'=>$email, 'message'=>'Invalid Password!!'];
	    $date = new DateTime();
	    $checkuser = $this->auth->email_check($email);
	    if ($checkuser) {
	    	$this->auth->select_id($email);
	        $output['id_token'] = $this->auth_jwt->encode($data = array("email" => $email));
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->response($invalidSignup,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    public function login_get()
    {
        $login = $this->session->userdata('login');
        $twofactor = $this->session->userdata('twofactor');
	    $send_to_email = decrypt_email($login['email']);
	    if($twofactor == TWOFACTOR_EMAIL){
	    $code = generateRandomNumeric(6);
		$hash_activation_code = $this->password->create_bcrypt($code);
		$invalidlogin = ['status'=>FALSE,'email'=>$send_to_email, 'message'=>'Invalid Password!!'];
	    $subject_email = 'Verification code';
	    $datauser = array(
		        'email' => $login['email'],
				'sent_email' => 1,
				'activation_code' => $hash_activation_code,
				'levels_id' => $login['levels_id'],
				'id' => $login['id'],
				'last_login' => $login['last_login'],
				'activation' => $login['activation']
		);
	    $data = array(
	     'title'=> 'Two-Factor Authentication | Limononoto Design',
	     'subject'=> $subject_email,
	     'email'=> $send_to_email,
	     'paragraph'=> "<span style='display:block'>You have registered to become a Limononoto member.</span> Please enter your second factor authentication code: <strong style='color: #676767'>$code</strong> on the Two-Factor Authentication page or click the button below</p>",
	     'code'=> $code,
	     'link'=> base_url()."login/two-factor?v2=a&e-mail=".$send_to_email."&activation=".$code,
	         );
		$verify_email = $this->my_email->verif_email($data,5371502);
	    if($verify_email == true)
	    {
	      $this->session->set_userdata('login', $datauser);
	      redirect("login/two-factor?v2=a&e-mail=".$send_to_email);
	      $this->set_response($data,Rest_data::HTTP_OK);
	    }
	    else
	    {
	      $this->session->unset_userdata('twofactor');
	      $this->session->unset_userdata('login');	
		  //redirect("auth?failed");	
		  show_error($this->email->print_debugger());
	      //show_error($this->email->print_debugger());
	    }//else_email_send
	    }else{
	      redirect("auth?failed");	
		  $this->session->unset_userdata('twofactor');
	      $this->session->unset_userdata('login');
	      $this->response($invalidlogin,Rest_data::HTTP_BAD_REQUEST);	
		  //redirect("auth?failed");	 
	    }
    }
    /**
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function login_post()
    {
        $id = (int) $this->get('id',TRUE);
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
		$email	 	= $this->input->post('email', true);
	    $invalidlogin = ['status'=>FALSE,'email'=>$email, 'message'=>'Invalid Password!!'];
	    $date = new DateTime();
	    $checkuser = $this->auth->email_check($email);
	    if ($checkuser) {
	    	$this->auth->select_id($email);
	        $output['id_token'] = $this->auth_jwt->encode($data = array("email" => $email));
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->response($invalidlogin,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    public function passwordreset_get($id = null)
    {
    	$password_reset = $this->session->tempdata("password_reset");
	    $send_to_email = decrypt_email($password_reset['email']);
	    $code = generateRandomNumeric(6);
		$hash_activation_code = $this->password->create_bcrypt($code);
	    $subject_email = 'Reset Password';
	    $invalidPassword = ['status'=>FALSE,'email'=>$send_to_email, 'message'=>'Invalid Password!!'];
	    $datauser = array(
		        'email' => $send_to_email,
				'sent_email' => 1,
				'activation_code' => $hash_activation_code,
				'activation' => 'Success'
		);
	    $data = array(
	     'title'=> 'Reset Password | Limononoto Design',
	     'subject'=> $subject_email,
	     'email'=> $send_to_email,
	     'paragraph'=> "<span style='display:block'>Your Password Has been reset.</span> please insert the Verification Code: <strong style='color: #676767'>$code</strong> on the Authentication Password page or click the button below</p>",
	     'code'=> $code,
	     'link'=> base_url()."auth/password?pr=pass&e-mail=".$send_to_email."&activation=".$code,
	         );
		$verify_email = $this->my_email->verif_email($data,5371502);
	    if($verify_email == true)
	    {
	      $this->session->set_tempdata('password_reset', $datauser, 2400);
	      redirect("auth/password?pr=pass&e-mail=".$send_to_email);
	      $this->set_response($datauser,Rest_data::HTTP_OK);
	      
	    }
	    else
	    {
	      $this->session->set_tempdata('password_reset', null, 6);
		  redirect("passwordreset?failed");	
		  $this->response($invalidPassword,Rest_data::HTTP_BAD_REQUEST);
	      //show_error($this->email->print_debugger());
	    }//else_email_send
	   
    }
    public function passwordreset_post()
    {
    $id = (int) $this->get('id',TRUE);
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    $data = ($id) ? $this->auth->select_user_id($id) : $this->auth->select_user();
		$email	 	= $this->input->post('email', true);
	    $invalidPassword = ['status'=>FALSE,'email'=>$email, 'message'=>'Invalid Password!!'];
	    $date = new DateTime();
	    $checkuser = $this->auth->email_check($email);
	    if ($checkuser) {
	    	$this->auth->select_id($email);
	        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $this->auth->get_data(),"email" => $email));
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->response($invalidPassword,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
	
}?>