<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
	private $table = 'tb_ui_users';
    private $_data = array();  
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

public function create(array $post, $token)
{
    $data = [
        'user_id' => $token->id,
        'ln_token' => $post['todo'],
        'done' => $post['done'],
    ];
    $this->db->insert('tb_ln_token', $data);
    return $this->db->insert_id();
}

public function get_data() {
	return $this->_data;
}
  	
}//class user_member_model

?>