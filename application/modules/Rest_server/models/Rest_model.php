<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
	private $table = 'tb_ui_users';
    private $_data = array();  
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
    public function plain_signup($email)
    {
	   $validation = array();
	   $user = $this->rest_model->plain_auth($email);
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
	function record_count($table)
	 {
	  return $this->db->count_all($table);
	 }	
	    public function check_levels_ui($levels_id)
    {
       $show = $this->admin_model->check_levels_id();
       $query = $this->db->get_where('tb_lvc_users',array('show'=>$show,'id'=>$levels_id));
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $user           = $row->ui_id;
            }
        }
      return $user;

	    }
	  
	  public function get_user_active()
	   {
       $query = $this->db->get($this->table);
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
            	$active = $row->activation;
            	$activation = decrypt_ciphertext($row->activation);
            	if(isset($activation)  && $activation == USER_ACTIVE){
                	$data = $active;
                	}
            }
        }
      return $data;
	    }
  public function check_levels_id()
    {
       $query = $this->db->get('tb_lvc_users');
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[]            = $row->show;
            }
        }
        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value == SHOW_ADMIN)
                {
                	$user = $val;
                }
            }
        }
      return $user;

	    }  
  public function is_valid($email){
    $query = $this->db->get_where($this->table,array('email'=>$email));
    return $query->result();
  }
  public function is_valid_num($email){
    $query = $this->db->get_where($this->table,array('email'=>$email));
    return $query->num_rows();
  }
  public function select_user(){
	    $query = $this->db->get($this->table);
	    $row = $query->row_array();
	    $this->_data = $row;
	    return $this->_data;
  }
  public function plain_update_user($id){
  	   $query = $this->db->get($this->table);
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
 public function update_user($data,$userid) {
      	extract($data);
      	$id = $this->rest_model->plain_update_user($userid);
	    $this->db->where('id', $id);
	    $this->db->update($this->table, $data);
	    return true;
	}
 public function select_user_id($id){
	$query = $this->db->get_where($this->table,array('id'=>$id));
	if ($query->num_rows() > 0)
	        {
				$row = $query->result();
				$this->_data = $row;	
			}else{
				$this->_data = null;
			}
    return $this->_data;
  }
 public function select_id($email){
   $validaiton = array();
   $user = $this->auth->plain_auth($email);
   $query = $this->db->get_where($this->table, array('email'=>$user));
   		if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
            	$this->_data[]   		= $row->id;
				
            }
        }
    return $this->_data;
  }
   public function select_all_user(){
    $query = $this->db->get($this->table);
        if ($query->num_rows() > 0)
	        {
				$results = $query->result();	
			}else{
				$results = null;
			}
      return $results;
  }
   public function select_all_user_active(){
    $activation = $this->admin_model->get_user_active();
    $query = $this->db->get_where($this->table,array('activation'=>$activation));
        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users_active[$row->id]            = decrypt_ciphertext($row->id);
                $users_active[$row->username]      = decrypt_ciphertext($row->username);
                $users_active[$row->email]         = decrypt_email($row->email);
                $users_active[$row->levels_id]     = decrypt_ciphertext($row->levels_id);
                $users_active[$row->country_id]    = decrypt_ciphertext($row->country_id);
                $users_active[$row->website_url]   = decrypt_ciphertext($row->website_url);
                $users_active[$row->phone_number]  = decrypt_ciphertext($row->phone_number);
                $users_active[$row->description]   = decrypt_ciphertext($row->description);
                $users_active[$row->created_on]    = decrypt_ciphertext($row->created_on);
                $users_active[$row->activation]    = decrypt_ciphertext($row->activation);
            }
        }
      $query->free_result();
      return $users_active;
  }
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
public function delete_user($userid){
	$this->db->select('*');
	$id = $this->rest_model->plain_update_user($userid);
	$this->db->where('id', $id);
    $this->db->delete($this->table);
    if ($this->db->affected_rows() > 0) {
      return true;
    }
  }

public function get_data() {
	return $this->_data;
}
  	
}//class user_member_model

?>