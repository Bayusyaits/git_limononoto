<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Object_model extends CI_Model {
	
	public function __construct() {

	parent::__construct();
	
	}
	private $_data = array();
	private $_ref_data = array();
	
	function fetch_record($table, $limit, $start)
	 {
	  $this->db->limit($limit, $start);
	  $query = $this->db->get($table);
	  return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	 }
	
	 function record_count($table)
	 {
	  return $this->db->count_all($table);
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
	public function plan_object($table,$_id)
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
	    public function get_name($table,$name)
    {
       $query = $this->db->get($table);
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
            	$val = $value;
            	$value = decrypt_ciphertext($value);
                if (isset($value) && $value == $name)
                {
                	$data = $val;
                }
            }
        }
      return $data;

	    }
	    public function get_object_file($table,$_id){
	    //$this->db->cache_on();
	    $show = $this->object_model->get_object_active($table);
	    $count_record = $this->object_model->record_count($table);
	    $id = $this->object_model->plan_object($table,$_id);
		$this->db->select("$table.*");
		$this->db->where("$table.dyn_group_id = dyn_groups.id");
    	$this->db->where("$table.id = '$id'");
    	$this->db->where("$table.show = '$show'");
    	$this->db->from("dyn_groups");
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
		$count_record = $this->object_model->record_count($table);
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
		$show = SHOW_ACTIVE;
		$count_record = $this->object_model->record_count($table);
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
		$count_record = $this->object_model->record_count($table);
		$this->db->select("*");
    	$this->db->where(array('parent_id'=>$id,'show'=>SHOW_ACTIVE));
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
		public function get_data() {
			return $this->__data;
		}
    }

?>