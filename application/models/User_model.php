<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
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
	  public function get_table_levels_user($levels_id)
    {
       $show = $this->user_model->check_levels_id();
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
       $show = $this->user_model->check_levels_id();
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
                if (isset($value) && $value == SHOW_ACTIVE)
                {
                	$user = $val;
                }
            }
        }
      return $user;

	    }  
public function get_navmenu_userdata($table,$level_id){
//$this->db->cache_on();
$show = SHOW_ACTIVE;
$count_record = $this->object_model->record_count($table);
$this->db->select("$table.*");
//$this->db->where_in('id', array('20','15','22','42','86'));
$this->db->where("$table.dyn_group_id = dyn_groups.id");
$this->db->where("$table.show = '$show'");
$this->db->where("tb_lvc_users.id = '$level_id'");
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
$show = SHOW_ACTIVE;
$count_record = $this->object_model->record_count($table);
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
	    $this->db->update('tb_ui_users', array('last_login' => time()));
	    return true;
	}
 public function select_user_id($id){
    $this->db->where('id', $id);
	$query = $this->db->get($this->table);
	$row = $query->result();
	$this->_data = $row;
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
    $query = $this->db->get('tb_ui_users');
        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $users[$row->id]           	= decrypt_ciphertext($row->id);
                $users[$row->username]      = decrypt_ciphertext($row->username);
                $users[$row->email]         = decrypt_email($row->email);
                $users[$row->levels_id]     = decrypt_ciphertext($row->levels_id);
                $users[$row->country_id]    = decrypt_ciphertext($row->country_id);
                $users[$row->website_url]   = decrypt_ciphertext($row->website_url);
                $users[$row->phone_number]  = decrypt_ciphertext($row->phone_number);
                $users[$row->description]   = decrypt_ciphertext($row->description);
                $users[$row->created_on]    = decrypt_ciphertext($row->created_on);
                $users[$row->activation]    = decrypt_ciphertext($row->activation);
            }
        }
      $query->free_result();
      return $users;
  }
   public function select_all_user_active(){
   	$this->db->where('activation', '4');
    $query = $this->db->get('tb_ui_users');
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
public function delete_user($id){
	$this->db->select('*');
	$this->db->where('id', $id);
    $this->db->delete('tb_ui_users');
    if ($this->db->affected_rows() > 0) {
      return true;
    }
  }

public function get_data() {
	return $this->_data;
}
  	
}//class user_member_model

?>