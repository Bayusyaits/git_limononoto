<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . 'modules/Rest_server/controllers/Rest_data.php';

//uncomment di bawah ini atau gunakan autoload yang di config->config->composer_autoload default ada di composer_autoload
//require_once FCPATH . 'vendor/autoload.php';


/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class Users extends REST_data {
	
	
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		$this->cektoken();
		$this->load->library(array('auth_jwt'));
		$this->load->helper(array('authorization','jwt','cilm_limononoto'));
		$this->load->model(array('auth_model','user_model'));
        // Configure limits on our controller methods
		// Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
	
	public function active_get()
    {
        // Users from a data store e.g. database
        
        $users_active = $this->user_model->select_all_user_active();
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
        $id = $this->get('id');
		foreach ($users_active as $key => $active_all) { // line 48
		    $active_all = $users_active;
		 }
        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users_active)
            {
                // Set the response and exit
                
                $this->response($users_active, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users_active))
        {
            foreach ($users_active as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user_active = $value;
                }
            }
        }

        if (!empty($user_active))
        {
            $this->set_response($user_active, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function active_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => insert_id_user(2), // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

   
	
    public function users_get()
    {
        // Users from a data store e.g. database
        
        $users = $this->user_model->select_all_user();
	    //jika user menambahkan id maka akan di select berdasarkan id, jika tidak maka akan di select seluruhnya
        $id = $this->get('id');
		
        if ($id === NULL)
        {
        for ($i = 1; $i < count($users); $i++)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if (is_array($users))
            {
                // Set the response and exit
                
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = $users['id'];

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($users['id']) && $users['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => insert_id_user(2), // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id'=>$id,
	        'activation'=>0,
            'message' => 'Deleted the resource'
        ];
		$delete = $this->user_model->delete_user($id);
	    if ($delete) {
        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); 
        }// NO_CONTENT (204) being the HTTP response code
    }
	 public function is_member() {
        if ($this->user_model->is_member('deneme',9))
            echo 'uye';
    }
    public function is_admin() {
        if ($this->user_model->is_member('Admin'))
            echo 'adminovic';
    }
    function get_user_groups(){
        //print_r( $this->user_model->get_user_groups());
        foreach($this->user_model->get_user_groups() as $a){
            echo $a->id . " " . $a->name . "<br>";
        }
    }
    public function get_group_name() {
        echo $this->user_model->get_group_name(1);
    }
    public function get_group_id() {
        echo $this->user_model->get_group_id("Admin");
    }
    public function list_users() {
        echo '<pre>';
        print_r($this->user_model->list_users());
        echo '</pre>';
    }
    public function list_groups() {
        echo '<pre>';
        print_r($this->user_model->list_groups());
        echo '</pre>';
    }
    public function check_email() {
        if ($this->user_model->check_email("aa@a.com"))
            echo 'uygun ';
        else
            echo 'alindi ';
        $this->user_model->print_errors();
    }
    public function get_user() {
        print_r($this->user_model->get_user());
    }
    function create_user() {
        $a = $this->user_model->create_user("admin@admin.com", "12345", "Admin");
        if ($a)
            echo "tmm   ";
        else
            echo "hyr  ";
        print_r($this->user_model->get_user($a));
        $this->user_model->print_errors();
    }
    public function is_banned() {
        print_r($this->user_model->is_banned(6));
    }
    function ban_user() {
        $a = $this->user_model->ban_user(6);
        print_r($a);
    }
    function delete_user() {
        $a = $this->user_model->delete_user(7);
        print_r($a);
    }
    function unban_user() {
        $a = $this->user_model->unban_user(6);
        print_r($a);
    }
    function update_user() {
        $a = $this->user_model->update_user(6, "a@a.com", "12345", "tested");
        print_r($a);
    }
    function update_activity() {
        $a = $this->user_model->update_activity();
        print_r($a);
    }
}
