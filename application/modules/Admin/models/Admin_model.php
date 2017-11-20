<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
	private $table = 'tb_ui_users';
    private $_data = array();  
    public function get_user_name($id)
    {
       $query = $this->db->get_where($this->table,array('id'=>$id));
       $users = array();
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users['first_name']           = $row->first_name;
                $users['last_name']            = $row->last_name;
            }
        }
      return $users;

	    }
	    function record_count($table)
	 {
	  return $this->db->count_all($table);
	 }	
	  public function get_table_levels_user($levels_id)
    {
       $show = $this->admin_model->check_levels_id();
       $query = $this->db->get_where('tb_lvc_users',array('show'=>$show,'id'=>$levels_id));
       $user = NULL;
       if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $user           = decrypt_ciphertext($row->table);
            }
        }
      return $user;

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
public function get_navmenu_userdata($table,$level_id){
//$this->db->cache_on();
$show = SHOW_ADMIN;
$count_record = $this->admin_model->record_count($table);
$this->db->select("$table.*");
//$this->db->where_in('id', array('20','15','22','42','86'));
$this->db->where("$table.dyn_group_id = dyn_groups.id");
$this->db->where("$table.show = '$show'");
$this->db->where("tb_lvc_users.id = '539101'");
$this->db->from(array("dyn_groups","tb_lvc_users"));
$this->db->order_by("$table.id", "desc");
$query = $this->db->limit($count_record,0)->get($table);
$results = null;
if ($query->num_rows() > 0)
    {
		$results = $query->result();
		
	}else{
		$results = null;
	}
return $results;
}
public function get_childs_navmenu_userdata($table,$id){
//$this->db->cache_on();
$show = SHOW_ADMIN;
$count_record = $this->admin_model->record_count($table);
$this->db->select("*");
$this->db->where(array("show"=> $show,"parent_id"=> $id));
//$this->db->where_in('parent_id', $id);
$query = $this->db->limit($count_record,0)->get($table);
$results = null;
if ($query->num_rows() > 0)
    {
		$results = $query->result();
		
	}else{
		$results = null;
	}
return $results;
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
 public function update_user($data) {
      	extract($data);
	    $this->db->where('id', $data['id']);
	    $this->db->update($this->table, array('last_login' => time()));
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
   $user = $this->auth_model->plain_auth($email);
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
  public function get_object_active($table)
	 {
   $query = $this->db->get($table);
   $object = array();
   $data = NULL;
   if ($query->num_rows() > 0)
    {
        foreach ($query->result() as $row)
        {
            $object[]            = $row->show;
        }
    }
    if (!empty($object))
    {
        foreach ($object as $key => $value)
        {
        	$val = $value;
        	$value = decrypt_ciphertext($value);
            if (isset($value) && $value == SHOW_ACTIVE)
            {
            	$data = $val;
            }
        }
    }
  return $data;

    }
  public function get_object_levels($table){
		//$this->db->cache_on();
		$show = $this->admin_model->get_object_active($table);
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.show = '$show'");
    	$this->db->from("dyn_groups");
    	$this->db->order_by("$table.id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
  public function get_object_select($table){
		//$this->db->cache_on();
		$show = SHOW_ACTIVE;
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.show = '$show'");
    	$this->db->from("dyn_groups");
    	$this->db->order_by("$table.id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
  public function get_object_data($table){
		//$this->db->cache_on();
		$show = SHOW_ADMIN;
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.show = '$show'");
    	$this->db->from("dyn_groups");
    	$this->db->order_by("$table.id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function get_childs_object_data($table,$id){
		//$this->db->cache_on();
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("*");
    	$this->db->where(array('parent_id'=>$id,'show'=>SHOW_ADMIN));
    	$this->db->order_by("last_edit", "asc");//mengurutkan bedasarkan edit,perhatikan urutan jvascript
    	$query = $this->db->limit($count_record,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function load_data() {
			return $this->_ref_data;
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
  public function get_navmenu_data($table){
		//$this->db->cache_on();
		$show = SHOW_ADMIN;
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("$table.*");
    	$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.show = '$show'");
    	$this->db->from(array("dyn_groups"));
    	$this->db->order_by("$table.id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	//$this->db->cache_off();
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function get_childs_navmenu_data($table,$id){
		//$this->db->cache_on();
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("*");
    	$this->db->where('parent_id', $id);
    	$this->db->where('show', SHOW_ADMIN);
    	$this->db->order_by("id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function get_menu_data($table, $limit ,$start,$menu_id){
		//$this->db->cache_on();
		$show = $this->admin_model->get_object_active($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where(array("tb_dyn_menu.id"=> $menu_id,"$table.show"=> $show,"$table.is_parent"=> 1));
    	$this->db->from("tb_dyn_menu");
    	$this->db->order_by("$table.created_on", "asc");
    	$query = $this->db->limit($limit,$start)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
  public function get_navmenu_property($table,$url){
		//$this->db->cache_on();
		$count_record = $this->admin_model->record_count($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where(array("$table.url" => $url,"$table.show" => SHOW_ADMIN));
    	$this->db->from("dyn_groups");
    	$this->db->order_by("$table.id", "asc");
    	$query = $this->db->limit($count_record,0)->get($table);
    	//$this->db->cache_off();
    	$results = null;
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
/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function purge_na($expire_period = 172800)
	{
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

public function get_data() {
	return $this->_data;
}
  	
}//class user_member_model

?>