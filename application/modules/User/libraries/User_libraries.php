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

class User_libraries
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
	public $CI;
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
		$this->CI = & get_instance();
		// Dependancies
		if(CI_VERSION >= 2.2){
			$this->CI->load->library('driver');
		}
		// config/aauth.php
		$this->config->load('auth');
		$this->config_vars = $this->CI->config->item('auth');
		$this->CI->lang->load('auth_lang');
		
		// load error and info messages from flashdata (but don't store back in flashdata)
		$this->errors = $this->CI->session->flashdata('errors') ?: array();
		$this->infos = $this->CI->session->flashdata('infos') ?: array();
		
		$this->CI->load->library(array('email', 'form_validation', 'session'));
		$this->CI->load->helper(array('cookie', 'language','url'));
		$this->CI->load->model('auth_model');	
		$this->login = $this->CI->session->userdata('login');
	}

	
	public function __get($var)
	{
		return get_instance()->$var;
	}

    public function set_form_message_errors($errors){
	    $message = array();

        // use active record database to get the menu.
	    $html_out  = "\t".'<div class="lm-warning-auth lm-text-danger">'."\n";

	    if($errors){
		   $html_out .= '<p class="lm-form-message">'.$errors.'</p>';
		 }else{
		   $html_out .= '<p class="lm-form-message">'.$this->CI->lang->line('contact_subheading').'</p>';
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
