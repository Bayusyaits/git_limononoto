<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/api/Rest_data.php';

class Member extends Rest_data {
	public function __construct()
	{
		parent::__construct();		
		$this->cektoken();
		$this->load->library(array('auth_jwt','form_validation'));
		$this->load->helper(array('authorization','jwt'));
		$this->load->model(array('auth_model' => 'auth','user_model' => 'user'));
	}
	
	
	/**
	 * Cotoh penggunaan bootstrap pada codeigniter::index()
	 */
	
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
     
      function user_get($id = null){

    $id = (int) $this->get('id',TRUE);
		 $response = [
            'status' => Rest_data::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $data = ($id) ? $this->user->select_user_id($id) : $this->user->select_user();
		if ($data) { 
           $this->response($data, Rest_data::HTTP_OK);     
                return;
		}
		$this->response($response, Rest_data::HTTP_FORBIDDEN);

	  }
  function user_post(){
    $data = [
      'id'=>$this->post('id',TRUE),
      'email'=>$this->post('email',TRUE),
      'password'=>$this->post('password',TRUE)
    ];
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
    $this->form_validation->set_rules('password','Password','trim|required|max_length[50]');
    $message = ['status'=>FALSE,'message'=>'user_post user_put'];
      //jika berhasil di masukan maka akan di respon kembali sesuai dengan data yang di masukan
    if (!$this->form_validation->run()) {
      //mengembalikan respon bad request dengan validasi error
      $this->set_response($message,Rest_data::HTTP_BAD_REQUEST);
    }else {
    if ($this->user->insert_user($data)) {
        $this->response($data,Rest_data::HTTP_CREATED);

    }
    }

  }
  
  function user_put(){
    $id = (int) $this->get('id',TRUE);

    //mendapatkan data json yang kemudian dilakukan json decode
    //php://input is not available with enctype="multipart/form-data".
    $data = json_decode(file_get_contents('php://input'),TRUE);
	$headers = $this->input->request_headers();
    //mendapatkan data json yang kemudian dilakukan json decode
    $decode = $this->auth_jwt->decode($headers['Authorization']);
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
    $this->form_validation->set_rules('password','Password','trim|required|max_length[50]');    
    $message = ['status'=>FALSE,'message'=>'failed user_put'];
    $data_user = array('id'=>$decode->id);
      if ($this->user->update_user($data_user)) {
        $this->response($decode,Rest_data::HTTP_OK);
      }else {
        $this->response($message,Rest_data::HTTP_BAD_REQUEST);
      }

  }
  function user_delete(){
	$id = (int) $this->get('id',TRUE);
    //mendapatkan data json yang kemudian dilakukan json decode
    $message = ['status'=>FALSE,'id'=>$id,'message'=>'failed user_get',];
    $delete = $this->user->delete_user($id);
    if ($delete) {
      $this->response([
        'id'=>$id,
        'activation'=>0,
        'status'=>'deleted'
      ],Rest_data::HTTP_OK);
    }else {
        $this->response($message,Rest_data::HTTP_BAD_REQUEST);
    }

  }

	function member_get(){

    $id = (int) $this->get('id',TRUE);
    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya

    if ($data) {
      //mengembalikan respon http ok 200 dengan data dari select di atas
      $this->response($data,Restdata::HTTP_OK);
    }else {
        $this->notfound('Anggota Tidak Di Temukan');

    }

  }

  function member_post(){

    $data = [
      'npm'=>$this->post('npm',TRUE),
      'nama'=>$this->post('nama',TRUE),
      'jurusan'=>$this->post('jurusan',TRUE)
    ];

    $this->form_validation->set_rules('npm','NPM','trim|required|max_length[20]|is_unique[anggota.npm]');
    $this->form_validation->set_rules('nama','Nama','trim|required|max_length[50]');
    $this->form_validation->set_rules('jurusan','Jurusan','trim|required|max_length[20]');

    if (!$this->form_validation->run()) {
      //mengembalikan respon bad request dengan validasi error
      $this->badreq($this->validation_errors());
    }else {
      //jika berhasil di masukan maka akan di respon kembali sesuai dengan data yang di masukan
        $this->response($data,Restdata::HTTP_CREATED);

    }

  }
	    
		
}

# nama file home.php
# folder apllication/controller/