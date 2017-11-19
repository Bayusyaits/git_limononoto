<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 //date_default_timezone_set('Asia/Jakarta');
class MY_Controller extends MX_Controller
{
 
	protected $data = array();
	
	
	 public function __construct() {
        parent::__construct();
        $this->set_timezone();
        $this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_header("X-XSS-Protection: 1; mode=block");
		$this->output->set_header('X-Content-Type-Options: nosniff');
		$this->output->set_header('Access-Control-Expose-Headers: XContent-Range, Date, Etag, Cache-Control');
		$this->output->set_header('Alt-Svc: quic=":443"; ma=2592000; v="39,38,37,35"');
		$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_header('HTTP/1.1 200 OK');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
		$this->offset = 60 * 60 * 24 * 3;
	    $this->expstr = "Expires: " .gmdate("D, d M Y H:i:s",time() + $this->offset) . " GMT";
	    $this->output->set_header($this->expstr);
	    $this->output->set_header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    $method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
	    }
	    $this->load->module(array('General','Authentication','User','Admin','Rest_server'));
    }

    public function set_timezone() {
        if ($this->session->userdata('user_id')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'user');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                date_default_timezone_set($query->row()->timezone);
            } else {
                return false;
            }
        }
    }
	 function _required_user($params =array()){
        $action =$this->router->fetch_method();
        $_login = $this->session->userdata('login');
        if(empty($params['except']))
            $params['except'] =array();
        if(empty($params['only']))
            $params['only'] =array();
        if(count($params['except']) > 0 && in_array($action,$params['except']))
            return true;    
        if(count($params['only']) > 0 && in_array($action,$params['only']) && $_login)
            return true;
        if($_login)    
            return true;
            $this->session->unset_userdata('login');
		}  
	function _check_vaidity($params =array()){
	//digunakan,saat setelah login untuk mengecek sesion kadaluarsa tanpa logout, data akan diupdate 
        $_login = $this->session->userdata('login');
		$_last_login = $_login['last_login'];
		$_email    = $_login['email'];
	    // If you only want to update in intervals, check the last_activity.
	    // You may need to load the date helper, or simply use time() instead.
	    $time_since = time() - $_last_login;
	    $interval = 7200;
        if($time_since < $interval)
            return true;
            $updated = $this->db
          ->where('email', $_email)
          ->update('tb_ui_users',array('last_login'=> time(),'logged_in'=>'0'));
    // Update database
	}  	
		
	protected $savedContent=array();
	protected function render()
	{
		$args = func_get_args();
		return call_user_func_array(array($this->load, 'view'), $args);
	}
	protected function beginContent()
	{
		ob_start();
		$level = ob_get_level();
		$this->savedContent[$level] = func_get_args();
		return null;
	}
	protected function endContent()
	{
		$level = ob_get_level();
		$content = ob_get_clean();
		$config = $this->savedContent[$level];
		$data['content'] = $content;
		return call_user_func_array(array($this, 'render'),$config);
	}
}
	
	
	