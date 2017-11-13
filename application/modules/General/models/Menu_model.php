<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
	private $_data = array();
	private $_ref_data = array();

	 public function get_menu_id($table,$_id)
    {
       $query = $this->db->get($table);
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $object[]            = $row->id;
            }
        }
        if (!empty($object))
        {
            foreach ($object as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value == $_id)
                {
                	$data = $val;
                }
            }
        }
      return $data;

	    }
	      public function plain_api_page($table,$id)
    {
       $query = $this->db->get($table);
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $object[]            = $row->id;
            }
        }
        if (!empty($object))
        {
            foreach ($object as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value == $id)
                {
                	$data = $val;
                }
            }
        }
      return $data;

	    }
	    
	       public function plain_creator_id($id)
    {
       $query = $this->db->get('tb_creator_idea');
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $object[]            = $row->creator_id;
            }
        }
        if (!empty($object))
        {
            foreach ($object as $key => $value)
            {
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value == $id)
                {
                	$data = $val;
                }
            }
        }
      return $data;

	    }
 
	    public function get_menu_url($url)
		{
       $query = $this->db->get_where('tb_dyn_menu', array('url'=>$url));
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $object[]              = $row->id;
            }
        }
        	 foreach ($object as $value)
            {

                	$data = $value;
            }
        	
			return $data;
	    }
	 	
	 	
	    public function get_navmenu_userdata($table,$level_id){
	    //$this->db->cache_on();
	    $levels_id = $this->user_model->get_levels_id($level_id);
	    $count_record = $this->object_model->record_count($table);
	    $show = $this->object_model->get_object_active($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.show = '$show'");
    	$this->db->where("tb_lvc_users.id = '$levels_id'");
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
		$show = $this->object_model->get_object_active($table);
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
		
		public function get_navmenu_data($table){
		//$this->db->cache_on();
		$show = SHOW_ACTIVE;
		$count_record = $this->object_model->record_count($table);
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
		
		public function get_navmenu_property($table,$url){
		//$this->db->cache_on();
		$count_record = $this->object_model->record_count($table);
		$this->db->select("$table.*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where(array("$table.url" => $url,"$table.show" => SHOW_ACTIVE));
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
		public function get_childs_navmenu_data($table,$id){
		//$this->db->cache_on();
		$count_record = $this->object_model->record_count($table);
		$this->db->select("*");
    	$this->db->where('parent_id', $id);
    	$this->db->where('show', SHOW_ACTIVE);
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
		$show = $this->object_model->get_object_active($table);
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
		public function get_menu_image($table){
		$this->db->select("$table.file,url");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where(array("$table.show"=> SHOW_ACTIVE));
    	$query = $this->db->limit(5,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function get_childs_menu_data($table, $limit ,$start,$id){
		//$this->db->cache_on();
		$show = $this->object_model->get_object_active($table);
		$this->db->select("*");
    	$this->db->where(array("show"=> $show,"parent_id"=> $id));
    	$this->db->order_by("created_on", "asc");
    	$query = $this->db->limit(3,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		
		public function load_menu_data($table, $limit ,$start,$url){
		//$this->db->cache_on();
		$show = $this->object_model->get_object_active($table);
		$id = $this->menu_model->get_menu_url($url);
		$this->db->select("*");
    	$this->db->where(array("menu_id"=> $id,"show"=> $show,"is_parent"=> 1));
    	$this->db->order_by("created_on", "asc");
    	$query = $this->db->limit($limit, $start)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();	
			}else{
				$results = null;
			}
		return $results;
		}
		public function load_menu_data_categories($table, $limit ,$start,$url,$categories){
		//$this->db->cache_on();
		$show = $this->object_model->get_object_active($table);
		$count_record = $this->object_model->record_count($table);
		$id = $this->menu_model->get_menu_url($url);
		$this->db->select("*");
    	$this->db->where(array("menu_id"=> $id,"show"=> $show,"is_parent"=> 1,'category_id'=>$categories));
    	$this->db->order_by("created_on", "asc");
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
		
		
	public function plain_get_categories($table,$id)
    {
      $categories_id = $this->object_model->plan_object($table,$id);
       $query = $this->db->get_where($table,array('id'=>$categories_id));
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $object[]            = $row->name;
            }
        }
        if (!empty($object))
        {
            foreach ($object as $key => $value)
            {
            	$show = decrypt_ciphertext($row->show);
            	if(isset($show) == SHOW_ACTIVE){
                	$data = $value;
                	}
            }
        }
      return $data;
	    }
	   public function get_categories_active($table)
	   {
       $query = $this->db->get($table);
       $object = array();
       $data = NULL;
       if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
            	$show = decrypt_ciphertext($row->show);
            	if(isset($show) == 1){
                	$data = $query->result();
                	}
            }
        }
      return $data;
	    }
		public function load_data() {
			return $this->_ref_data;
		}
		public function get_data() {
			return $this->__data;
		}
    }

?>