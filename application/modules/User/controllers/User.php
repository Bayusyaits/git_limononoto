<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Bower', array('CI' => $this));
	}
		 
	public function index()
	{
		force_ssl();
		
	}
	public function view_xml(){
	   header("Content-type: text/xml");
	   
	}
	
}
# nama file home.php
# folder apllication/controller/