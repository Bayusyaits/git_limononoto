<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'modules/Rest_server/libraries/REST_Controller.php';

//uncomment di bawah ini atau gunakan autoload yang di config->config->composer_autoload default ada di composer_autoload
//require_once FCPATH . 'vendor/autoload.php';
require APPPATH . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

class Rest_data extends REST_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->library(array('Rest_server/auth_jwt'));
	$this->load->helper(array('authorization','jwt'));
	$this->load->model(array('user_model'));
  }
  //method untuk not found 404
  public function notfound($pesan){

    $this->response([
      'status'=>FALSE,
      'message'=>$pesan
    ],REST_Controller::HTTP_NOT_FOUND);

  }

  //method untuk bad request 400
  public function badreq($pesan){
    $this->response([
      'status'=>FALSE,
      'message'=>$pesan
    ],REST_Controller::HTTP_BAD_REQUEST);
  }

  //method untuk melihat token pada user
  public function viewtoken_post(){
    $curr_time = new DateTime();

    $email = $this->post('email',TRUE);
    $pass = $this->post('password',TRUE);

    $dataadmin = $this->user_model->is_valid($email);

    if ($dataadmin) {

      if (password_verify($pass,$dataadmin->password)) {
        $output['id_token'] = $this->auth_jwt->encode($data = array("id" => $dataadmin->id,"email" => $dataadmin->email));
        $this->response($output,REST_Controller::HTTP_OK);

      }else {

        $this->viewtokenfail($email,$pass);

      }

    }else {
      $this->viewtokenfail($email,$pass);
    }

  }

  //method untuk jika view token diatas fail
  public function viewtokenfail($email,$pass){
    $this->response([
      'status'=>FALSE,
      'email'=>$email,
      'password'=>$pass,
      'message'=>'Invalid Credentials!!'
      ],REST_Controller::HTTP_BAD_REQUEST);
  }

//method untuk mengecek token setiap melakukan post, put, etc
  public function cektoken(){
    $jwt = $this->input->request_headers();
    if (Authorization::tokenIsExist($jwt)) {
      $decode = $this->auth_jwt->decode($jwt['Authorization']);
      $email = $decode->email;
      //melakukan pengecekan database, jika email tersedia di database maka return true
      if ($this->user_model->is_valid_num($email)>0) {
        return true;
      }
    } 
  }
}
