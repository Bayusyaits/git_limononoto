<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'modules/Rest_server/controllers/Rest_data.php';
/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 * 4. check : decode token:https://www.jsonwebtoken.io/
 * 5. https://blogpadli.com/baca/Rest-Api-Dengan-Codeigniter-Dan-Json-Web-Token
 */

class Auth_token extends REST_data
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    
	// Load config from file: config/jwt.php
    public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Password','Authentication/Auth_libraries','Format'));
		$this->load->model(array('auth_model','user_model'));
		$this->load->helper(array('authorization','jwt'));
		$this->cektoken();
	}
	
    public function login_get()
    {
	$_login = $this->session->userdata('login');
	$_twofactor = $this->session->userdata('twofactor');
	$email = $_login['email'];
	$levels_id = decrypt_ciphertext($_login['levels_id']);
	$id = $_login['id'];
    $invalidLogin = ['status'=>FALSE,'email'=>decrypt_email($email),'message'=>'Invalid login!!'];
    $checkuser = $this->user_model->is_valid($email);
    $link = 'dashboard';
    $ui = $this->user_model->check_levels_ui($levels_id);
    if($ui == 3 && isset($_twofactor)){
	    $link = 'home';
    }
    if ($checkuser) {
    	//Belum diset, yang tidak login masih dapat mengakses dashboard
    	// belum di set, yang telah login masih dapat mengakses halaman auth
    	// belum di set, Twofactor
    	$update_user = $this->auth_model->logged_in($id);//update logged_in = 1 && last_login = time()
    	$data = ($id) ? $this->user_model->select_user_id($id) : $this->user_model->select_user();
        redirect($link);
        $this->set_response($data,Rest_data::HTTP_OK);
    }else {
      $this->auth_libraries->logout();
      redirect('login');
      $this->response($invalidLogin,Rest_data::HTTP_BAD_REQUEST);
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
	    $data = ($id) ? $this->user_model->select_user_id($id) : $this->user_model->select_user();
		$email	 	= $this->input->post('email', true);
		$password 	= $this->input->post('password', true);
	    $invalidLogin = ['status'=>FALSE,'email'=>$email, 'message'=>'Invalid Credentials!!'];
	    $date = new DateTime();
	    $get_id = $this->user_model->select_id($email);
	    if ($get_id) {
	        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $get_id['id'],"email" => $email));
	        redirect('dashboard');
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->auth_libraries->logout();
		  redirect('login');
	      $this->response($invalidLogin,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    public function twofactor_get()
    {
	$_login = $this->session->userdata('login');
	$_twofactor = $this->session->userdata('twofactor');
	$email = decrypt_email($_login['email']);
	$levels_id = decrypt_ciphertext($_login['levels_id']);
	$id = $_login['id'];
	$_id = decrypt_ciphertext($_login['id']);
    $invalidLogin = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid login!!'];
    $get_salt = $this->auth_model->is_twofactor($_twofactor,$_id);
    $link = 'dashboard';
    $ui = $this->user_model->check_levels_ui($levels_id);
    if($ui == 3 && isset($_twofactor)){
	    $link = 'admin/manage';
    }
    if ($get_salt == ERR_NONE) {
    	$this->session->set_userdata("twofactor", TWOFACTOR_ACCESS);
    	$update_user = $this->auth_model->logged_in($id);//update logged_in = 1 && last_login = time()
    	$data = ($id) ? $this->user_model->select_user_id($id) : $this->user_model->select_user();
    	redirect($link);
        $this->set_response($data,Rest_data::HTTP_OK);
    }else {
      $this->auth_libraries->logout();
      redirect('login');
      $this->response($invalidLogin,Rest_data::HTTP_BAD_REQUEST);
    }
    }
    
    /**
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */

    public function signup_get()
    {
    $id 	= count_user() + 1;
    $sign_up = $this->session->tempdata("sign_up");
	$email = $sign_up['email'];    
    $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $id,"email" => $email, "admin" => false));
    /**$decode = $this->auth_jwt->decode($output);*/
    //Check email = 0
    $check = $this->auth_libraries->check_email($email);
    $invalidSignup = ['status'=>FALSE,'email'=>decrypt_email($email),'message'=>'Invalid signup!!'];
    if($check){
    redirect('send-email/signup');
	$this->set_response($output, Rest_data::HTTP_OK);
    }else{
    $this->auth_libraries->logout();
    redirect('signup');
	$this->response($invalidSignup, Rest_data::HTTP_BAD_REQUEST);
    }    
    }
    
	public function signup_post()
    {	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    
		$email	 	= $this->input->post('email', true);
		$this->user_model->select_id($email);
		$id = (int) $this->get('id',TRUE);
	    $invalidSignup = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid Credentials!!'];
	    $checkuser = $this->auth_libraries->check_email($email);
	    if ($checkuser && empty($id)) {
	        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => count_user() + 1,"email" => $email));
	        redirect('dashboard');
	        $this->set_response($output,Rest_data::HTTP_CREATED);
	    }else {
	      $this->auth_libraries->logout();
		  redirect('signup');
	      $this->response($invalidSignup,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    
    public function password_get()
    {
    $password_reset = $this->session->tempdata("password_reset");
	$email	 		= $password_reset['email'];
	$id = $password_reset['id'];
    $invalidPassword = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid password!!'];
    $checkuser = $this->auth_libraries->email_check($email);
    if ($checkuser) {
        
        redirect('send-email/passwordreset');
        //$this->set_response($output,Rest_data::HTTP_OK);
    }else {
      $this->auth_libraries->logout();
      redirect('passwordreset');
      $this->response($invalidPassword,Rest_data::HTTP_BAD_REQUEST);
    }
    }
    public function password_post()
    {
    	$id = (int) $this->get('id',TRUE);
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    $data = ($id) ? $this->user_model->select_user($id) : $this->user_model->select_user($id);
		$email	 	= $this->input->post('email', true);
	    $invalidLogin = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid password!!'];
	    $checkuser = $this->auth_libraries->email_check($email);
	    if ($checkuser) {
	    	$this->user_model->select_id($email);
	        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $this->auth_model->get_data(),"email" => $email));
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->response($invalidLogin,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    
    public function passwordresendemail_get()
    {
    $password_reset = $this->session->tempdata("password_reset");
	$email	 		= $password_reset['email'];
    $invalidPassword = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid password!!'];
	$plain_passwordreset = $this->auth_model->plain_passwordreset($email);
	if($plain_passwordreset == ERR_NONE){
        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $this->auth_model->get_data()['id'],"email" => $this->auth_model->get_data()['email']));
        $this->session->set_tempdata("password_reset", $this->auth_model->get_data(), 3600);
        redirect('send-email/passwordreset');
        $this->set_response($output,Rest_data::HTTP_OK);
    }else {
      $this->auth_libraries->logout();
      redirect('passwordreset');
      $this->response($invalidPassword,Rest_data::HTTP_BAD_REQUEST);
    }
    }
    public function passwordresendemail_post()
    {
    	$id = (int) $this->get('id',TRUE);
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
	    $data = ($id) ? $this->user_model->select_user($id) : $this->user_model->select_user($id);
		$email	 	= $this->input->post('email', true);
	    $invalidLogin = ['status'=>FALSE,'email'=>$email,'message'=>'Invalid password!!'];
	    $checkuser = $this->auth_libraries->email_check($email);
	    if ($checkuser) {
	    	$this->user_model->select_id($email);
	        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $this->auth_model->get_data(),"email" => $email));
	        $this->set_response($output,Rest_data::HTTP_OK);
	    }else {
	      $this->response($invalidLogin,Rest_data::HTTP_BAD_REQUEST);
	    }
    }
    
     
    
}