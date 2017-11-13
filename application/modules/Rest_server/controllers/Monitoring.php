<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . '/libraries/REST_Controller.php';

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
class Monitoring extends REST_Controller{

    function __construct(){
    parent::__construct();
	    $this->load->library(array('auth_jwt'));
		$this->load->helper(array('authorization','jwt'));
		$this->load->model(array('user_model' => 'user'));
	}

    public function unit_get()
    {
    	$data = array('respon : '.$this->get('id'));
    	$this->response($data);
    
    }
    public function unit_post()
    {
   	 	$data = array('respon : '.$this->post('id'));
    	$this->response($data);
    
    }
    public function unit_put()
    {
    	$data = array('respon : '.$this->put('id'));
    	$this->response($data);
    
    }
    public function unit_delete()
    {
    	$data = array('respon : '.$this->delete('id'));
    	$this->response($data);
    
    }
}
