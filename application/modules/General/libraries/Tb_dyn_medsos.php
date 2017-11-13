<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Tb_dyn_medsos {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_medsos        = 'id="tag_id_medsos"';
    private $class_medsos        = 'class="tag_class_medsos"';
    private $class_parent    = 'class="parent_medsos"';
    private $class_last        = 'class="last_medsos"';

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
        log_message('debug', "Social Media Class Initialized");
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
    function build_medsos($table = 'tb_dyn_medsos')
    {
        $medsos = array();
        $results = $this->ci->object_model->get_object_data($table);
        $html_out  = '<div class="lm-hd-sidebar"><div class="lm-ms-medsos">';
		$html_out .= '<ul class="lm-ms-ul" >';

        // loop through the $medsos array() and build the parent menus.
        if (is_array($results) || is_object($results))
		{
        foreach ($results as $row) {
        $title = $row->title;
		$url = $row->url;
		$dyn_group_id = $row->dyn_group_id;
		$icon = $row->icon;
		$show = $row->show;
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '
                        <li class="lm-ms-li" title="'.$title.'"><a target="_blank" title="'.$title.'" href="'.$url.'"><span class="lm-icon-social lm-icon-'.$icon.'"></span></a></li>';
                    

                    // loop through and build all the child submenus.

                    $html_out .= '';
            }
            
        }

        $html_out .= '</ul>';
        $html_out .= '</div></div>';

        return $html_out;
    }  
	/**
     * get_childs($medsos, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $medsos    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  