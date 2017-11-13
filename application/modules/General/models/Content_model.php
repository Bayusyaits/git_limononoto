<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
    }
	private $_data = array();
	private $_ref_data = array();

	 
		public function get_content_data($table, $limit ,$start,$menu_url,$id){
		$show = $this->object_model->get_object_active($table);
		$menu_id = $this->menu_model->get_menu_url($menu_url);
		$id = $this->menu_model->plain_api_page($table,$id);
		$this->db->select("*");
    	$this->db->where(array("show"=> $show,"id"=> $id,"is_parent"=> 1,"parent_id"=> 0));
    	$this->db->order_by("is_parent", "asc");
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
		public function load_idea($post_id,$creator_id){
		//$this->db->cache_on();
		$table = 'tb_creator_idea';
		$show = $this->object_model->get_object_active($table);
		$id = $this->menu_model->plain_creator_id($creator_id);
		$this->db->select("idea,quote");
		//$this->db->like('tags',$match[$i]); 
    	$this->db->where(array("post_id"=> $post_id,"show"=> $show,"creator_id"=> $id));
    	$query = $this->db->limit(1)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
		       $results = $query->result();
			}else{
				$results = null;
			}
		return $results;
		}
		public function get_childs_content_data($table, $limit ,$start,$id){
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
		public function get_content_opengraph($table,$menu_url,$id){
		$show = $this->object_model->get_object_active($table);
		$menu_id = $this->menu_model->get_menu_url($menu_url);
		$id = $this->menu_model->plain_api_page($table,$id);
		$this->db->select("*");
		//$this->db->where_in('id', array('20','15','22','42','86'));
    	$this->db->where(array("menu_id"=>$menu_id,"show"=> $show,"id"=> $id,"is_parent"=> 1));
    	$query = $this->db->limit(1,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
				$results = $query->result();
				
			}else{
				$results = null;
			}
		return $results;
		}
		public function load_related_posts($table,$url,$categories,$ref_id){
		//$this->db->cache_on();
		$show = $this->object_model->get_object_active($table);
		$id = $this->menu_model->get_menu_url($url);
		$this->db->select("*");
		//$this->db->like('tags',$match[$i]); 
    	$this->db->where(array("menu_id"=> $id,"show"=> $show,"parent_id"=> "0","is_parent"=> 1,'category_id'=>$categories));
    	$this->db->where("id != '$ref_id'");
    	$this->db->order_by("created_on", "asc");
    	$query = $this->db->limit(2,0)->get($table);
    	$results = null;
    	if ($query->num_rows() > 0)
	        {
		       $results = $query->result();
			}else{
				$results = null;
			}
		return $results;
		}
		
    }

?>