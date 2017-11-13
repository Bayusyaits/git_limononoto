<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    private $table = 'tb_ui_users';
    private $twofactor = 'tb_ui_twofactor';
    private $security = 'tb_security_method';
    private $_data = array();	
	public function get_id_twofactor($id)
    {
       $query = $this->db->get($this->twofactor);
       $users = array();
       $user = null;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $users[]            = $row->id;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value === $id)
                {
                	$user = $val;
                }
            }
        }
      return $user;
	    }
	    public function plain_security($id)
    {
       $query = $this->db->get_where($this->security,array("id"=>$id));
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`
           $user  = IS_TWOFACTOR;
        }else{
	        $user = NULL;
        }
      return $user;
	    }	
	public function set_levels_id($levels_id)
    {
       $show = $this->auth_model->check_levels_id();
       $query = $this->db->get_where('tb_lvc_users',array('show'=>$show));
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[]            = $row->id;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value === $levels_id)
                {
                	if($level_id == 1){
                	$user = 539101;
                	}
                	else if($level_id == 2){
                	$user = 539202;
                	}
                	else if($level_id == 3){
                	$user = 539203;
                	}
                	else {
	                $user = false;	
                	}
                }
            }
        }
      return $user;

	    }
	public function plain_auth($email)
    {
       $query = $this->db->get($this->table);
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[]            = $row->email;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_email($value);
                if (isset($value) && $value === $email)
                {
                	$user = $val;
                }
            }
        }
      return $user;

	    }
	
	    public function is_twofactor($salt,$id)
    {
       $_id = $this->auth_model->get_id_twofactor($id);
       $query = $this->db->get_where($this->twofactor,array("id"=>$_id));
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $users[]            = $row->salt;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value === $salt)
                {
                	$user = ERR_NONE;
                }
            }
        }
      return $user;

	    }
	
	public function update_data($table, $id, $data)
    {
    	extract($data);
    	$this->db->where('id',$id);
    	$this->db->limit(1);
		return $this->db->update($table, $data);
    }
    
    public function update_twofactor($table, $id, $data)
    {
    	extract($data);
    	$this->db->where('id',$id);
    	$this->db->limit(1);
		return $this->db->update($table, $data);
    }
	public function insert_data($table,$data)
    {
	     $duplicate_data = array();
	     foreach($data AS $key => $value) {
	        $duplicate_data[] = sprintf("%s='%s'", $key, addslashes($value));
	     }
		// Query to check whether username already exist or not
		// Query to insert data in database
		
		$sql = sprintf("%s ON DUPLICATE KEY UPDATE %s", $this->db->insert_string($table, $data), implode(',', $duplicate_data));
		$this->db->query($sql);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return ERR_NONE;
		}else {
		return ERR_INVALID_REGISTRATION;	
		}//else_affected_rows
		
    }
	public function plain_twofactor($plain)
    {
       extract($plain);
       $query = $this->db->get_where($this->table,array('id'=>$plain['id'],'levels_id'=>$plain['levels_id']));
       $users = array();
       $user = NULL;
       $id = decrypt_ciphertext($plain['id']);
       $salt = encrypt_plaintext($plain['salt']);
       $new_id = encrypt_plaintext($id);
       $data = array("id"=>$new_id,"salt"=>$salt);
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[]            = $row->birthday;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value === $plain['birthday'])
                {
				    $_id = $this->auth_model->get_id_twofactor($id);
				    if($_id == null){
						$this->auth_model->insert_data($this->twofactor, $data);
						$user = ERR_NONE;
				    }else{
				    	$update_user = array('salt'=>$plain['salt'],'activation_code' => $plain['activation_code']);
				    	$this->auth_model->update_data($this->table,$plain['id'],$update_user);
					    //second
					    $update_twofactor = array('salt'=>$salt);
				    	$this->auth_model->update_twofactor($this->twofactor,$plain['id'],$update_twofactor);
	                	$user = ERR_NONE;
                	}
                }
            }
        }
      return $user;

	    }      
	
	public function get_id_user($id)
    {
       $query = $this->db->get($this->table);
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[]            = $row->id;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_email($value);
                if (isset($value) && $value === $id)
                {
                	$user = $val;
                }
            }
        }
      return $user;

	    }
	
	public function plain_login($password,$email)
    {
	   $validation = array();
	   $user = $this->auth_model->plain_auth($email);
	   $query = $this->db->get_where($this->table, array('email'=>$user));
	   $val = null;
	   $method = null;
	   		if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	            	$validation[$row->id]   					= $row->id;
	            	$validation[$row->levels_id]   				= $row->levels_id;
					$validation[$row->activation]   			= $row->activation;
					$validation[$row->last_login]   			= $row->last_login;
					$validation[$row->password]					= $row->password;
					$validation[$row->method_id]				= $row->method_id;
	            }
	        }else{
		        $val = ERR_INVALID_UNLISTED;
	        }
	        $query->free_result();   
	        $method_id = decrypt_ciphertext($validation[$row->method_id]);
	        $plain_security = $this->auth_model->plain_security($method_id);
	        if($method_id == 53201)
            $method = TWOFACTOR_EMAIL;
            if($method_id == 53202)
            $method = TWOFACTOR_SMSL;
            if($method_id == 53203)
            $method = TWOFACTOR_AUTHY;
            if($method_id == 53204)
            $method = TWOFACTOR_DEVICE;
	        if($plain_security == IS_TWOFACTOR){
				$this->session->set_userdata('twofactor', $method);
			   }
		        if (is_array($validation))
		           {
		            foreach($validation as $key)
					{
				    	if ($this->password->validate_password($password, $validation[$row->password]))
								{
								$decrypt_activation = decrypt_ciphertext($validation[$row->activation]);
								if($decrypt_activation == 1) {
								$val = ERR_INVALID_ACTIVATION;
								//saat sudah terdaftar	
								}elseif($decrypt_activation == 2) {
								//saat sudah terdaftar, namun diblokir
								$val = ERR_INVALID_VERIFICATION;
								} elseif($decrypt_activation == 3) {
								//saat sudah terdaftar, namun Moderasi Account oleh Admin
								$val = ERR_INVALID_MODERATION;
								}else{ 
									$this->_data = [
									'id'		=>		$validation[$row->id] ,
									'levels_id'	=>	$validation[$row->levels_id],
									'email'	=>	$user,
									'last_login'	=>	$validation[$row->last_login],
									'activation'=>	$validation[$row->activation]
									];
									$val = ERR_NONE;
								}//else
						}else{
							$val = ERR_INVALID_PASSWORD;
						}//validate_password
				}
			}
			return $val;

	    }
	
	public function plain_passwordreset($email)
    {
	   $validation = array();
	   $user = $this->auth_model->plain_auth($email);
	   $query = $this->db->get_where($this->table, array('email'=>$user));
	   $val = null;
	   		if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	            	$validation[$row->id]   		= $row->id;
	            	$validation[$row->levels_id] 	= $row->levels_id;
					$validation[$row->activation]   = $row->activation;
					$validation[$row->last_login]   = $row->last_login;
	            }
	        }else{
		        $val = ERR_INVALID_UNLISTED;
	        }
	        $query->free_result();   
	        if (is_array($validation))
	           {
	            foreach($validation as $key => $value)
				{
					$decrypt_activation = decrypt_ciphertext($validation[$row->activation]);
				    if($decrypt_activation == 1) {
						$val = ERR_INVALID_ACTIVATION;
						//saat sudah terdaftar	
						}elseif($decrypt_activation == 2) {
						//saat sudah terdaftar, namun diblokir
						$val = ERR_INVALID_VERIFICATION;
						} elseif($decrypt_activation == 3) {
						//saat sudah terdaftar, namun Moderasi Account oleh Admin
						$val = ERR_INVALID_MODERATION;
						}else{ 
							$this->_data = [
							'id'		=>		$validation[$row->id] ,
							'levels_id'	=>	$validation[$row->levels_id],
							'email'	=>	$user,
							'last_login'	=>	$validation[$row->last_login],
							'activation'=>	$validation[$row->activation]
							];
							$val = ERR_NONE;
					}//else
				    	
				}
			}
		return $val;
	  }
	  
	  public function plain_resetpassword($data)
    {
	   $validation = array();
	   $user = $this->auth_model->plain_auth($data['email']);
	   $query = $this->db->get_where($this->table, array('email'=>$user));
	   $val = null;
	   		if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	            	$validation[$row->id]   		= $row->id;
	            	$validation[$row->levels_id] 	= $row->levels_id;
					$validation[$row->activation]   = $row->activation;
					$validation[$row->last_login]   = $row->last_login;
	            }
	        }else{
		        $val = ERR_INVALID_UNLISTED;
	        }
	        $query->free_result();   
	        if (is_array($validation))
	           {
	            foreach($validation as $value)
				{
				    extract($data);
				    $this->db->where('id', $validation[$row->id]);
				    $this->db->update($this->table, array('activation_code' => $data['activation_code'], 'password' => $data['password'], 'forgotten_password_time' => $data['forgotten_password_time']));
					$this->_data = array('email'=> $user);
					$val = ERR_NONE;
				}
			}
		return $val;
	  }
	    
	
	public function plain_signup($email)
    {
	   $validation = array();
	   $user = $this->auth_model->plain_auth($email);
	   $query = $this->db->get_where($this->table, array('email'=>$user));
	   $val = null;
	   		if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	                $val = ERR_INVALID_REGISTRATION;
	            }
	        }else{
		        $val = ERR_NONE;
	        }
	        			
	        return $val;
	    }
	    
	//insert into user table
    public function insert_user($data)
    {
	     $duplicate_data = array();
	     foreach($data AS $key => $value) {
	        $duplicate_data[] = sprintf("%s='%s'", $key, addslashes($value));
	     }
		// Query to check whether username already exist or not
		// Query to insert data in database
		
		$sql = sprintf("%s ON DUPLICATE KEY UPDATE %s", $this->db->insert_string($this->table, $data), implode(',', $duplicate_data));
		$this->db->query($sql);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return ERR_NONE;
		}else {
		return ERR_INVALID_REGISTRATION;	
		}//else_affected_rows
		
    }
	public function logged_in($_id){
    $id = $this->auth_model->get_id_user($_id);
    $update_time = array('last_login' => time(), 'logged_in' => '1');
    $updated = $this->auth_model->update_data($this->table,$id,$update_time);
      if($updated){
      return true;
      }else{
	  return false;
      }
	}	 
	public function get_data() {
		return $this->_data;
	}
	//public getdata
	
}//class user_member_model

?>