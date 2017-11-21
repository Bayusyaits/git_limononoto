<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class MY_Email extends CI_Email {
	  
      public function __construct($config = array())
      {
          if (count($config) > 0)
          {
              $this->initialize($config);
          }
          else
          {
              $this->_smtp_auth = ($this->smtp_user == 'info@limononoto.com' AND $this->smtp_pass == 'bFAPQfX8HrXxGhD8') ? FALSE : TRUE;
              $this->_safe_mode = ((boolean)@ini_get("safe_mode") === FALSE) ? FALSE : TRUE;
          }

          log_message('debug', "Email Class Initialized");
      }

      // this will allow us to add headers whenever we need them
      public function set_header($header, $value)
      {
          $this->_headers[$header] = $value;
      }
      
      public function __get($var)
	{
		return get_instance()->$var;
	}

	public function verif_email($data,$template_id)
	{
	$this->config->load('email');
	$this->load->helper(array('cilm_limononoto')); 
	$this->load->library('email');
	$this->load->model(array('object_model'));
	$object = array();
	$this->email->to($data['email']); //email tujuan. Isikan dengan emailmu!
	$this->email->subject($data['subject']);
	$results = $this->object_model->get_object_file('tb_dyn_email',$template_id);
	if (is_array($results) || is_object($results))
		{
		foreach ($results as $row) {
		$template_url = decrypt_ciphertext($row->url);
		$from = decrypt_ciphertext($row->from);
		$from = ucfirst($from);
		$email = decrypt_email($row->email);
	    $this->email->from($email, $from);
	    $message = $this->load->view($template_url,$data,TRUE);
	    $this->email->message($message);
	    $path = $this->config->item('server_root');
	    if($this->email->send())
	    {
	      $object =  true;
	    }
	    else
	    {
	      $object = false;
	      //show_error($this->email->print_debugger());
	    }//else_email_send
	    	}
		   }
		   return $object;
		}	
	   		
      
  }