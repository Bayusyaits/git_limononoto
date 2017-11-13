<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
    
    private $table = 'tb_dyn_menu_contact';
    private $_data = array();

	public function pages($id)
    {  

        $this->db->select('*');
        $this->db->from('tb_dyn_menu');
        $this->db->where('id', $id); 
        $query = $this->db->get();


    if ($query->num_rows() > 0)
        { return $query->row_array();
        }
        else {return NULL;
	        
        }

    }   //public_profile	
	
	public function insert_data_contact($data)
    {
		// Query to insert data in database
		$duplicate_data = array();
	    foreach($data AS $key => $value) {
	        $duplicate_data[] = sprintf("%s='%s'", $key, addslashes($value));
	    }
		$sql = sprintf("%s ON DUPLICATE KEY UPDATE %s", $this->db->insert_string('tb_dyn_menu_contact', $data), implode(',', $duplicate_data));
		$this->db->query($sql);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return TRUE;
		}else {
		return ERR_INVALID_INSERT;	
		}//else_affected_rows
    }
    
    public function insert_data_join($data)
    {
		// Query to insert data in database
		$duplicate_data = array();
	    foreach($data AS $key => $value) {
	        $duplicate_data[] = sprintf("%s='%s'", $key, addslashes($value));
	    }
		$sql = sprintf("%s ON DUPLICATE KEY UPDATE %s", $this->db->insert_string('tb_dyn_menu_join', $data), implode(',', $duplicate_data));
		$this->db->query($sql);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return TRUE;
		}else {
		return ERR_INVALID_INSERT;	
		}//else_affected_rows
    }
    
    public function check_url($data)
    {
            // Query to check whether username already exist or not
		$this->db->get_where('tb_dyn_menu', array('link_type' => $link_type));
        $query = $this->db->get();
    }
	
	//public getdata
	public function plain_validation($table, $email)
    {
       $query = $this->db->get($table);
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
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
	    //public getdata
	public function plain_newsletter($table,$email)
    {
	   $validation = array();
	   $user = $this->validation_model->plain_validation($table,$email);
	   $query = $this->db->get_where($table, array('email'=>$user));
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
	    
	public function plain_data_contact($data)
    {
	   $validaiton = array();
	   $user = $this->validation_model->plain_validation('tb_dyn_menu_contact',$data['email']);
	   $val = ERR_NONE;
        // use active record database to get the validaiton.
       $query = $this->db->get_where($this->table, array('email' => $user));
	        if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	                $validaiton[$row->id]      = $row->id;
	                $validaiton[$row->first_name]      = decrypt_ciphertext($row->first_name);
	                $validaiton[$row->message]      = decrypt_ciphertext($row->message);
	                $validaiton[$row->phone_number]      = decrypt_ciphertext($row->phone_number);
	                $validaiton[$row->subject_id]      = $row->subject_id;
	            }
	        }else{
		        $val = ERR_NONE; 
	        }
	        $query->free_result();   
	        if (is_array($validaiton))
	           {
	            foreach($validaiton as $value)
				{
					if (isset($validaiton[$row->subject_id]) && $validaiton[$row->subject_id] == $data['subject_id'])
					    {
					    if (isset($validaiton[$row->first_name]) && $validaiton[$row->first_name] == $data['first_name'])
					    {
					    	if (isset($validaiton[$row->phone_number]) && $validaiton[$row->phone_number] == $data['phone_number'])
								{
								if (isset($validaiton[$row->message]) && $validaiton[$row->message] == $data['message'])
								{
								$id = $validaiton[$row->id];
								$update = array('created_on' => time());
								$this->validation_model->update_data('tb_dyn_menu_contact',$id,$update);
							    $val = ERR_INVALID_INSERT;
								}
							}
						}
					}
				}
			}  

	        return $val;
	    }
	    
    public function update_data($table, $id, $data)
    {
    	extract($data);
    	$this->db->where('id',$id);
    	$this->db->limit(1);
		return $this->db->update($table, $data);
    }
    
    public function plain_data_join($data)
    {
	   $validaiton = array();
	   $user = $this->validation_model->plain_validation('tb_dyn_menu_join',$data['email']);
	   $val = ERR_NONE;
        // use active record database to get the validaiton.
       $query = $this->db->get_where($this->table, array('email' => $user));
	        if ($query->num_rows() > 0)
	        {
	            foreach ($query->result() as $row)
	            {
	                $validaiton[$row->id]      = $row->id;
	                $validaiton[$row->first_name]      = decrypt_ciphertext($row->first_name);
	                $validaiton[$row->message]      = decrypt_ciphertext($row->message);
	                $validaiton[$row->phone_number]      = decrypt_ciphertext($row->phone_number);
	                $validaiton[$row->department_id]      = $row->department_id;
	            }
	        }else{
		        $val = ERR_NONE; 
	        }
	        $query->free_result();   
	        if (is_array($validaiton))
	           {
	            foreach($validaiton as $value)
				{
					if (isset($validaiton[$row->department_id]) && $validaiton[$row->department_id] == $data['department_id'])
					    {
					    if (isset($validaiton[$row->first_name]) && $validaiton[$row->first_name] == $data['first_name'])
					    {
					    	if (isset($validaiton[$row->phone_number]) && $validaiton[$row->phone_number] == $data['phone_number'])
								{
								if (isset($validaiton[$row->message]) && $validaiton[$row->message] == $data['message'])
								{
								$id = $validaiton[$row->id];
								$update = array('created_on' => time(), 'resume' => $data['resume'], 'cover_letter' => $data['cover_letter']);
								$this->validation_model->update_data('tb_dyn_menu_join',$id,$update);
							    $val = ERR_INVALID_INSERT;
								}
							}
						}
					}
				}
			}  

	        return $val;
	    }
	    //insert into user table
    public function insert_cli_newsletter($data)
    {
	     $duplicate_data = array();
	     foreach($data AS $key => $value) {
	        $duplicate_data[] = sprintf("%s='%s'", $key, addslashes($value));
	     }
		// Query to check whether username already exist or not
		// Query to insert data in database
		
		$sql = sprintf("%s ON DUPLICATE KEY UPDATE %s", $this->db->insert_string('tb_cli_newsletter', $data), implode(',', $duplicate_data));
		$this->db->query($sql);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return ERR_NONE;
		}else {
		return ERR_INVALID_REGISTRATION;	
		}//else_affected_rows
		
    }
	public function get_data() {
		return $this->_data;
	}
    
    }

?>