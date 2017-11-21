<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Admin_libraries
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * extra where
	 *
	 * @var array
	 **/
	public $_extra_where = array();

	/**
	 * extra set
	 *
	 * @var array
	 **/
	public $_extra_set = array();

	
	public $_cache_user_in_group;
	
	
	
	
	
	/**
	 * The CodeIgniter object variable
	 * @access public
	 * @var object
	 */
	public $ci;
	/**
	 * Variable for loading the config array into
	 * @access public
	 * @var array
	 */
	public $config_vars;
	/**
	 * Array to store error messages
	 * @access public
	 * @var array
	 */
	public $errors = array();
	/**
	 * Array to store info messages
	 * @access public
	 * @var array
	 */
	public $infos = array();
	
	/**
	 * Local temporary storage for current flash errors
	 *
	 * Used to update current flash data list since flash data is only available on the next page refresh
	 * @access public
	 * var array
	 */
	public $flash_errors = array();
	/**
	 * Local temporary storage for current flash infos
	 *
	 * Used to update current flash data list since flash data is only available on the next page refresh
	 * @access public
	 * var array
	 */
	public $flash_infos = array();
	/**
     * The CodeIgniter object variable
	 * @access public
     * @var object
     */
    public $auth_db;
	########################
	# Base Functions
	########################
	/**
	 * Constructor
	 */
	private $login;
	public function __construct()
	{
		$this->ci = & get_instance();
		// Dependancies
		if(CI_VERSION >= 2.2){
			$this->ci->load->library('driver');
		}
		// config/aauth.php
		$this->config->load('auth');
		$this->config_vars = $this->ci->config->item('auth');
		$this->ci->lang->load('auth_lang');
		
		// load error and info messages from flashdata (but don't store back in flashdata)
		$this->errors = $this->ci->session->flashdata('errors') ?: array();
		$this->infos = $this->ci->session->flashdata('infos') ?: array();
		
		$this->ci->load->library(array('email', 'form_validation', 'session'));
		$this->ci->load->helper(array('cookie', 'language','url'));
		$this->ci->load->model('auth_model');	
		$this->login = $this->ci->session->userdata('login');
	}

	
	public function __get($var)
	{
		return get_instance()->$var;
	}
	public function unset_errors($errors){
	    if($this->CI->session->userdata($errors)){
		   $this->CI->session->unset_userdata($errors);
		 }else{
			 return false;
		 }
		 return $errors;
    }
    public function set_message_errors($errors){
	    $message = array();

        // use active record database to get the menu.
	    $html_out  = "\t".''."\n";

	    if($errors){
		   $html_out = '<span class="lm-error-message is-visible">'.$errors.'</span>';
		 }else{
		   $html_out = '<span class="lm-error-message">'.$errors.'</span>';
		 }
        $html_out .= "\t".'' . "\n";
		 return $html_out;
    }
    
    public function set_form_message_errors($errors){
	    $message = array();

        // use active record database to get the menu.
	    $html_out  = "\t".'<div class="lm-warning-auth lm-text-danger">'."\n";

	    if($errors){
		   $html_out .= '<p class="lm-form-message">'.$errors.'</p>';
		 }else{
		   $html_out .= '<p class="lm-form-message">'.$this->ci->lang->line('contact_subheading').'</p>';
		 }
        $html_out .= "\t".'</div>'. "\n";
		 return $html_out;
    }
     	
 	//not tested excatly
	/**
	 * Delete user
	 * Delete a user from database. WARNING Can't be undone
	 * @param int $user_id User id to delete
	 * @return bool Delete fails/succeeds
	 */
 	public function delete_user($user_id) {
		// delete from perm_to_user
		$this->auth_db->where('id', $user_id);
		return $this->auth_db->delete('tb_ui_users');
	}
 	public function ban_user($user_id) {
		$data = array(
			'activation' => 2,
			'activation_code' => ''
		);
		$this->auth_db->where('id', $user_id);
		return $this->auth_db->update('tb_ui_users', $data);
	}
	//tested
	/**
	 * Unban user
	 * Activates user account
	 * Same with unlock_user()
	 * @param int $user_id User id to activate
	 * @return bool Activation fails/succeeds
	 */
	public function unban_user($user_id) {
		$data = array(
			'activation' => 4
		);
		$this->auth_db->where('id', $user_id);
		return $this->auth_db->update('tb_ui_users', $data);
	}
 	//tested
	/**
	 * Check user banned
	 * Checks if a user is banned
	 * @param int $user_id User id to check
	 * @return bool False if banned, True if not
	 */
	public function is_banned($user_id) {
		$query = $this->auth_db->where('id', $user_id);
		$query = $this->auth_db->where('activation', 2);
		$query = $this->auth_db->get('tb_ui_users');
		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
 	/**
	 * user_exist_by_username
	 * Check if user exist by username
	 * @param $user_id
	 *
	 * @return bool
	 */
	public function user_exist_by_username($name) {
		$query = $this->auth_db->where('username', $name);
		$query = $this->auth_db->get('tb_ui_users');
		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
	
	function levels_user()
    {
    	$ci =& get_instance();
		$results = $this->ci->admin_model->get_object_levels('tb_lvc_users');
        $html_out = "\t\t".'<div class="lm-feed-levels fade out" id="lm-feed-left">'."\n";
        $html_out .= "\t\t".'<div class="lm-feed-module">'."\n";
        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$iso = decrypt_ciphertext($row->iso);
			$id = $row->id;
			$ui = $row->ui_id;
			$name = decrypt_ciphertext($row->name);
			if($id != 539101 ) {
			if($id === 539202){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else if($id === 539203){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else if($id === 539304){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else if($id === 539305){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else if($id === 539506){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else if($id === 539507){
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
			
			}else {
			$html_out .= "\t\t".'<div class="lm-level-wrapper" data-level="'.$id.'">'."\n";
			$html_out .= "\t\t".'<h5 class="lm-h5 lm-level-name">'.ucfirst($name).'</h5>'."\n";
				
			}
			// loop through and build all the child submenus.
            $html_out .= $this->get_childs($id);
                    
			$html_out .= "\t".'</div>'."\n";
			}
			}
			            
        }else{
	        $html_out .= '';
        }
        $html_out .= "\t".'</div>'."\n";
        $html_out .= "\t".'</div>'."\n";

        return $html_out;
    }  
	function get_childs($ref_level)
    {	
    	$results = $this->ci->admin_model->select_all_user();
    	$this->fieldset = array('class' => 'fieldset');
        $html_out = "\t\t".'<div class="lm-manage-wrapper">'."\n";
        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$id = decrypt_ciphertext($row->id);
			$email = decrypt_email($row->email);
			$firstname = decrypt_ciphertext($row->first_name);
			$lastname = decrypt_ciphertext($row->last_name);
			$level = decrypt_ciphertext($row->levels_id);			
			if($level == $ref_level){
			$html_out .= form_fieldset('', $this->fieldset)."\n";
			$html_out .= "\t".div_open('lm-manage-modal',$id,$row->id).'<a href="#" class="lm-manage-link"><div class="lm-manage-id"><h5>'.$id.'</h5></div>'.'<div class="lm-manage-email"><p>'.$email.'</p></div></a>'.div_close()."\n";        
	        $html_out .= form_fieldset_close()."\n";
			}
    	}
    	}
    	$html_out .= "\t".'</div>'."\n";
	 	return $html_out;   
    }
	
    function build_childs_manage()
    {	
    	$results = $this->ci->admin_model->select_all_user();
    	$this->fieldset = array('class' => 'fieldset');
        $html_out = "\t\t".'<div class="lm-feed-levels fade out" id="lm-feed-left">'."\n";
        $html_out .= "\t\t".'<div class="lm-feed-module">'."\n";
        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$id = decrypt_ciphertext($row->id);
			$email = decrypt_email($row->email);
			$firstname = decrypt_ciphertext($row->first_name);
			$lastname = decrypt_ciphertext($row->last_name);
			$level = decrypt_ciphertext($row->levels_id);		
			if($level == 539202){
			$html_out .= "\t\t".'<div class="lm-col lm-col-2">'."\n";
			$html_out .= "\t\t".'<h5>Member</h5>'."\n";
	        }
	        if($level == 539203){
			$html_out .= "\t\t".'<div class="lm-col lm-col-2">'."\n";
			$html_out .= "\t\t".'<h5>Contributor</h5>'."\n";
	        }
			$html_out .= "\t".'</div>'."\n";				
			}
    	}
    	$html_out .= "\t".'</div>'."\n";
    	$html_out .= "\t".'</div>'."\n";
    	
	 	return $html_out;   
    }
 	/**
	 * user_exist_by_name !DEPRECATED!
	 * Check if user exist by name
	 * @param $user_id
	 *
	 * @return bool
	 */
	public function user_exist_by_name( $name ) {
		return $this->user_exist_by_username($name);
	}
 	   
}
