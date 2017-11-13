<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Auth_dyn_menu {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_menu        = 'id="menu"';
    private $class_menu        = 'class="menu"';
    private $class_parent    = 'class="parent"';
    private $class_last        = 'class="last"';
	private $login;
	
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
        $this->login = $this->ci->session->userdata('login');
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
    
    
    function build_menu_title($table = 'tb_dyn_menu')
    {
        $results = $this->ci->menu_model->get_navmenu_data($table);
        $html_out  = "\t".''."\n";
		$html_out .= "";

        // loop through the $menu array() and build the parent menus.
        if (is_array($results) || is_object($results))
		{
		foreach ($results as $row) {
		$title = $row->title;
		$dyn_group_id = $row->dyn_group_id;
		$url = $row->url;
		$id = $row->id;
		$show = $row->show;
		$icon = $row->icon;
		$target = $row->target;
		$attribute = $row->attribute;
		$parent = $row->parent_id;
		$position = $row->position;
		$is_parent = $row->is_parent;
		$page_title = $row->page_title;
		$description = $row->description;
		$page_title = ucfirst($page_title);
		$title = ucfirst($title);
		$url = strtolower($url);
            if($url == uri_string()) {
           		if($dyn_group_id == 532702 && $target != 539015){
                $html_out .= '<h1 class="reset"><span class="lm-bold" id="typed">'.ucfirst($page_title).'</span></h1>';

				}else{
				 $html_out .= '<h6>'.$description.'</h6>';
				}
              }
            }
        }

        $html_out .= "\t\t";
        $html_out .= "\t";

        return $html_out;
    } 
    function build_menu_footer($table = 'tb_dyn_menu')
    {
        $results = $this->ci->menu_model->get_navmenu_data($table);
        $html_out  = '<nav>';
		$html_out .= '<ul class="lm-col-left">';

        // loop through the $menu array() and build the parent menus.
        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$title = $row->title;
			$dyn_group_id = $row->dyn_group_id;
			$url = $row->url;
			$id = $row->id;
			$show = $row->show;
			$icon = $row->icon;
			$target = $row->target;
			$attribute = $row->attribute;
			$parent = $row->parent_id;
			$position = $row->position;
			$is_parent = $row->is_parent;
			$title = ucfirst($title);
			$url = strtolower($url);
             if ($dyn_group_id == 532703 && $parent == 0) 
                {
                if($position == 3)
                {
                    if ($is_parent == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<li>
              <a href="#" title="'.$title.'">'.$title.'</a>';
                    }
                    else
                    {
                        $html_out .= '<li class="lm-ft-li lm-scroll-to-reveal">'.anchor($url, '<span>'.$title.'</span>');
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs($table, $id);

                    $html_out .= '</li>';
                }
                }
            }
        }

        $html_out .= '</ul>';
        $html_out .= '</nav>';
        $html_out .= '<p title="limononoto" class="lm-scroll-to-reveal lm-col-right">&copy;'.date('Y').' Limononoto. All Right Reserved</p>';

        return $html_out;
    }
    function get_childs($table, $ref_id)
    {
    	$results_ref = $this->ci->menu_model->get_childs_navmenu_data($table,$ref_id);
        $has_subcats = FALSE;
        $html_out = '<ul>';

        if (is_array($results_ref) || is_object($results_ref))
		{
		foreach ($results_ref as $ref) {
		$title = $ref->title;
		$dyn_group_id = $ref->dyn_group_id;
		$url = $ref->url;
		$id = $ref->id;
		$show = $ref->show;
		$icon = $ref->icon;
		$target = $ref->target;
		$attribute = $ref->attribute;
		$parent = $ref->parent_id;
		$position = $ref->position;
		$is_parent = $ref->is_parent;
		$title = ucfirst($title);
		$url = strtolower($url);
		if ($dyn_group_id == 532701)    // are we allowed to see this menu?
            {
        	if($position == 2)
                {
                $has_subcats = TRUE;

                if ($is_parent == TRUE)
                {
                    $html_out .= '<li class="lm-navmenu-link" title="'.$title.'">'.anchor('#', '<span>'.ucfirst($title).'</span>');
                }
                else
                {
                    $html_out .= '<li class="lm-navmenu-link" title="'.$title.'">'.anchor($url, '<span>'.ucfirst($title).'</span>');
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($table, $id);

                $html_out .= '</li>' . "\n";
            }else if ($dyn_group_id == 532702 && $position == 2)  {
            
                $has_subcats = TRUE;

                if ($menu[$i]['is_parent'] == TRUE)
                {
                    $html_out .= '<li class="lm-navmenu-link" title="'.$title.'">'.anchor('#', '<span>'.ucfirst($title).'</span>');
                }
                else
                {
                    $html_out .= '<li class="lm-navmenu-link" title="'.$title.'">'.anchor($url, '<span>'.ucfirst($title).'</span>');
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($table, $id);

                $html_out .= '</li>' . "\n";
	            
            }
        }
        }
        }
        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;
    }
    function get_opengraph_property()
    {
    	$property = null;
        $results = $this->ci->menu_model->get_navmenu_property('tb_dyn_menu',uri_string());
        if (is_array($results) || is_object($results))
		{
		foreach ($results as $row) {
		$property['description'] = $row->description;
		$property['page_title'] = $row->page_title;
		$property['title'] = $row->title;
		$property['last_edit'] = $row->last_edit;
		$property['page_title'] = ucfirst($property['page_title']);
		$property['title'] = ucwords($property['title']);
		}
		}
        return $property;
    }
    function sitemap_image($table = 'tb_dyn_menu')
    {
	    $results = $this->ci->menu_model->get_menu_image($table);    	
    	if (is_array($results) || is_object($results))
		{
			$html_out  = "\t".''."\n";
			foreach ($results as $row) {
			$file = img_url().''.$row->file;
			$url = $row->url;
		    $html_out .= "\t".'<url><loc>'.base_url($url).'</loc>'."\n";
		    $html_out .= "\t".'<image:image><image:loc>'.$file.'</image:loc></image:image></url>'."\n";
			 }
	        }else{
		       $html_out = null; 
	        }	
        return $html_out;
    }
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  