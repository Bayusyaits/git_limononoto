<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------
/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {
	private static $instance;
	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}
		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}
	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class
class Secure_Controller extends CI_Controller {
    /**
     * Secure Constructor
     *
     * 
     */
    function __construct() {
        parent::__construct();
        // When someone successfully logs in, set a session userdata variable of "logged_in".
        // Here we check if it exists
        if (!$this->session->userdata('logged_in')) {
            // ====================
            // = Login has failed =
            // ====================
            // If not logged in, record what url they are attempting to acces and show the login form
            $this->session->set_userdata('REDIRECT', $this->uri->uri_string());
            // Give the browser an Unauthorized HTTP header
            $this->output->set_status_header('401');
            // Redirect to the login page, change this to your login controller/method
            $this->load->helper('url');
            redirect('login');
        } else {
            // =======================
            // = Login has succeeded =
            // =======================
        }
    }
}
