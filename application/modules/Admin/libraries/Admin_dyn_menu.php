<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Admin_dyn_menu {

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
    
    function build_navbar($table = 'tb_dyn_menu')
    {
        $menu = array();
        $results = $this->ci->menu_model->get_navmenu_data($table);
    	$html_out  = "\t".'<header id="lm-header" class="lm-header lm-hd lm-navbar-wrapper slide down">'."\n";
    	$html_out .= "\t\t".'<div class="lm-container-fluid">'."\n";
    	$html_out .= "\t\t".'<nav class="lm-primary-nav lm-nav-top lm-hd-nav lm-nav" id="lm-primary-nav"><ul class="lm-nav-ul">'."\n";

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
			// CodeIgniter's anchor(uri segments, text, attributes) tag.
			
				if ($dyn_group_id == 532701 && $parent == 0 && empty($target))    // are we allowed to see this menu?
                {
                if($position == 1 && !empty($icon))
                {
                    if ($is_parent == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<li class="lm-nav-li" title="'.$title.'">
              <button '.$attribute.' ><span class="'.$icon.'"></span></button>';
                    }else{
	                    $html_out .= "\t\t\t\t".'<li class="lm-nav-li" title="'.$title.'"><a href="'.$url.'" '.$attribute.'><span class="'.$icon.'"></span></a>';
                    }
                    $html_out .= '</li>'."\n";
				}
				}
			}
        }
		$html_out .= "\t\t".'</ul></nav>' . "\n";
		$html_out .= "\t\t".'</div>' . "\n";
        $html_out .= "\t".'</header>' . "\n";
        $html_out .= $this->build_menuright();

        return $html_out;
    } 
        
    function build_menu($table = 'tb_dyn_menu')
    {
        $menu = array();
        $level_user_id = decrypt_ciphertext($this->login['levels_id']);
        $table = $this->ci->admin_model->get_table_levels_user($level_user_id);
        $results = $this->ci->admin_model->get_navmenu_userdata($table,$level_user_id);
        $html_out  = "\t".'<nav class="lm-navmenu lm-navmenu-left" data-focus="#first-link">'."\n";
        $html_out .= $this->build_navmenu_nav();
        $html_out .= "\t".'<div class="lm-navmenu-content">'."\n";
		$html_out .= "\t\t".'<ul class="lm-navmenu-ul">'."\n";

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
			$levels_id = $row->levels_id;
			$title = ucfirst($title);
			$url = strtolower($url);
            if ($dyn_group_id == 532702 && empty($parent) && empty($target))    // are we allowed to see this menu?
                {
                if($position == 2)
                {
                    if ($is_parent == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<li class="lm-navmenu-submenu lm-dropdown" title="'.$title.'">
              <button id="first-link">'.$title.'</button>';
                    }
                    else
                    {
                        $html_out .= "\t\t\t\t".'<li class="lm-navmenu-link" title="'.$title.'">'.anchor($url, '<span>'.$title.'</span>');
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs_user($table, $id,$levels_id);

                    $html_out .= '</li>'."\n";
                }
              }
            }
            
        }

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= "\t".'</div>' . "\n";
		$html_out .= "\t".'</nav>' . "\n";
        return $html_out;
    }
    
    function build_navmenu_nav($table = 'tb_dyn_menu')
    {
        $menu = array();
        $results = $this->ci->menu_model->get_navmenu_data($table);
        $html_out  = "\t".'<div class="lm-navmenu-nav">'."\n";

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
			// CodeIgniter's anchor(uri segments, text, attributes) tag.
			
				if ($dyn_group_id == 532702 && $parent == 0 && empty($target))    // are we allowed to see this menu?
                {
                if($position == 2 && !empty($icon))
                {
                    if ($is_parent == FALSE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<button '.$attribute.'><span id="lm-icon-menu-2" class="'.$icon.'"></span></button>';
                    }
				}
				}
			}
        }
        $html_out .= "\t".'</div>' . "\n";
        return $html_out;
    }  

    function build_menuright($table = 'tb_dyn_menu')
    {
        $menu = array();
        $results = $this->ci->menu_model->get_navmenu_data($table);
        $html_out  = "\t".'<div class="lm-secondary-nav lm-navmenu-right"  id="lm-navmenu-right">'."\n";
		$html_out .= "\t\t".'<nav class="lm-main-nav">'."\n";
		$html_out .= "\t\t".'<ul class="lm-navmenu-right-ul">'."\n";

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
            if ($dyn_group_id == 532702 && $parent == 0)    // are we allowed to see this menu?
                {
                if($position == 4)
                {
                    if (empty($target))
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t\t\t\t".'<li class="lm-navmenu-right-li" title="'.$title.'">'.anchor($url, '<span>'.ucfirst($title).'</span></li>');
                    }
                    if ($this->login)
                    {
                    if($target == 539019) {
	                 $html_out .= "\t\t\t\t".'<li class="lm-navmenu-right-li" title="'.$title.'">'.anchor($url, '<span>'.ucfirst($title).'</span></li>');
	                 }
	                }else{
		             if(!empty($target) && $target != 539019) {
	                 $html_out .= "\t\t\t\t".'<li title="'.$title.'"><a '.$attribute.' >'.ucfirst($title).'</a></li>';
	                 }
	                }
                }
              }
            }
            
        }

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= "\t".'</nav>' . "\n";
        $html_out .= "\t".'</div>' . "\n";

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
    function get_childs_user($table,$ref_id,$ref_level_id)
    {
    	$results_ref = $this->ci->admin_model->get_childs_navmenu_userdata($table,$ref_id);
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
		$level_id = $ref->levels_id;
		$title = ucfirst($title);
		$url = strtolower($url);
		if ($dyn_group_id == 532702)    // are we allowed to see this menu?
            {
	        if($position == 2 && $level_id == $ref_level_id)
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
	                $html_out .= $this->get_childs_user($table, $id,$level_id);
	
	                $html_out .= '</li>' . "\n";
	            }
            }
        }
        }      
        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;   
        
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
    
    function build_menu_title_user()
    {
        $level_user_id = decrypt_ciphertext($this->login['levels_id']);
    	$table = $this->ci->admin_model->get_table_levels_user($level_user_id);
        $results = $this->ci->admin_model->get_navmenu_userdata($table,$level_user_id);
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
				 $html_out .= '<p>'.$description.'</p>';
				}
              }
            }
        }

        $html_out .= "\t\t";
        $html_out .= "\t";

        return $html_out;
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