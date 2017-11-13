<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * Dynmic_menu.php
 *
 */
class Tb_dhd_css {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_css        = 'id="tag_id_css"';
    private $class_css        = 'class="tag_class_css"';
    private $class_parent    = 'class="parent_css"';
    private $class_last        = 'class="last_css"';

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
        if(CI_VERSION >= 2.2){
			$this->ci->load->library('driver');
		}
        log_message('debug', "Menu Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
    function build_css($table = 'tb_dhd_css')
    {
    	$this->ci->load->add_package_path(APPPATH.'third_party/bower');
        $this->ci->load->remove_package_path(APPPATH.'third_party/bower');
    	$css_bower = $this->ci->bower->css('default');
        $css = array();
        $results = $this->ci->object_model->get_object_data($table);
        // ----------------------------------------------------------------------     
        // now we will build the dynamic menus.
        $html_out  = "\n\n";

        // loop through the $css array() and build the parent menus.
        if (is_array($results) || is_object($results))
		{
        foreach ($results as $row) {
        $title = $row->title;
		$url = $row->url;
		$dyn_group_id = $row->dyn_group_id;
		$id = $row->id;
		$show = $row->show;
		$media = $row->media;
		
                if ($dyn_group_id == 532706)    // are we allowed to see this menu?
                {		
                		$css = css_url().$url;
                		$css_bower = $this->ci->bower->add(css_bower().$url, array('embed' => TRUE));
                		$href = $css.'?v='.$css_bower['filemtime'];
                		$link = array(
						        'href'  => $href,
						        'rel'   => 'stylesheet',
						        'type'  => 'text/css',
						        'id'    => $url,
						        'media' => $media
						);
						
						$html_out .= link_tag($link);
                        // CodeIgniter's anchor(uri segments, text, mediaibutes) tag.
                    }

            }
        }

        $html_out .= "";
        $html_out .= '' . "\n";

        return $html_out;
    }  
	/**
     * get_childs($css, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $css    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  