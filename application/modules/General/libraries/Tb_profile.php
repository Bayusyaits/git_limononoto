<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Tb_profile {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_profile        = 'id="profile"';
    private $class_profile     = 'class="profile"';
    private $class_parent      = 'class="parent"';
    private $class_last        = 'class="last"';

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
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
    function build_mn_profile($table = 'tb_mn_profile')
    {
        $profile = array();

        // use active record database to get the menu.
        $query = $this->ci->db->get($table);

        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`

            foreach ($query->result() as $row)
            {
                $profile['id']            = $row->id;
                $profile['menu_id']        = $row->menu_id;
                $profile['url']            = $row->url;
                $profile['official_name']            = $row->official_name;
                $profile['description']        = $row->description;
                $profile['code_offices']            = $row->code_offices;
                $profile['country_id']            = $row->country_id;
                $profile['email']    = $row->email;
                $profile['phone_number']        = $row->phone_number;
                $profile['address']        = $row->address;
                $profile['map']        = $row->map;
                $profile['code']    		   = $row->code;
                $profile['show']    = $row->show;
            }
        }
        $query->free_result();    // The $query result object will no longer be available

        // ----------------------------------------------------------------------     
        // now we will build the dynamic menus.
        $html_out  = '';
        $html_out .= "\t\t".'<div class="lm-page-sub">'."\n";


        // loop through the $profile array() and build the parent menus.


             if ($profile['menu_id'] == 6 && $profile['id'] == 61100171)
                {
                if ($profile['show'] == 1)    // are we allowed to see this menu?
                {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                     $html_out .= '<div class="lm-page-sub__3-col">
              <p>'.$profile['description'].'</p>
            ';
                    $html_out .= '</div>';
                       
                        $html_out .= '<div class="lm-page-sub__3-col">
              <p>Write me as<a href="mailto:'.$profile['email'].'" title="Office E-mail" class="lm-link lm-office-email"> '.$profile['email'].'</a> or call
              <a href="tel:'.$profile['phone_number'].'" title="Office Phonenumber" class="lm-link lm-office-tel"> '.$profile['phone_number'].'</a></p>';
                    $html_out .= '</div>';
                    
                    $html_out .= '<div class="lm-page-sub__3-col">
              <p>Work at Limononoto <a href="'.$profile['map'].'" title="Show in Google Maps" class="lm-link lm-office-map" target="_blank">'.$profile['address'].'</a></p>';
                    $html_out .= '</div>';
                    
                    $html_out .= '<div class="lm-page-sub__3-col">
              <p></p>';
                    $html_out .= '</div>';
                }
                }

        $html_out .= "\t\t".'</div>' . "\n";
        $html_out .= '';

        return $html_out;
    }  
	/**
     * get_childs($profile, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $profile    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  