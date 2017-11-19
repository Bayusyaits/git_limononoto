<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Admin_javascript {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_javascript      = 'id="tag_id_javascript"';
    private $class_javascript   = 'class="tag_class_javascript"';
    private $class_parent    	= 'class="parent_javascript"';
    private $class_last        	= 'class="last_javascript"';
    /*claim info*/
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
        log_message('debug', "Javascript Class Initialized");
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
    function build_javascript($table = 'tb_dft_javascript')
    {
    	$javascript_bower = $this->ci->bower->js('default');
        $javascript = array();
        $results = $this->ci->admin_model->get_object_data($table);
        $html_out  = "";
		$html_out .= "";
		$html_out .= "\t".'<script  type="text/javascript" src="'.js_url().'admin/jquery.min.js"></script>'."\n";
        if (is_array($results) || is_object($results))
		{
        foreach ($results as $row) {
        $title = $row->title;
		$url = $row->url;
		$dyn_group_id = $row->dyn_group_id;
		$id = $row->id;
		$show = $row->show;
		$target = $row->target;
		$parent = $row->parent_id;
		$is_parent = $row->is_parent;
                if (empty($parent) && $dyn_group_id == 532705)    // are we allowed to see this menu?
                {
                	$js = js_url().$url;
                	$js_bower = $this->ci->bower->add(js_bower().$url, array('embed' => TRUE));
                    if ($is_parent == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t".'<script type="text/javascript" src="'.$js.'?v='.$js_bower['filemtime'].'"></script>'."\n";
                    }
					}
                    // loop through and build all the child submenus.
                    if($this->login){
	                $html_out .= $this->get_childs_logged_in($table, $id);
                    }else{
                    $html_out .= $this->get_childs($table, $id);
					}
                }
            
        }

        $html_out .= '';
        $html_out .= '' . "";

        return $html_out;
    }  
    
     
	/**
     * get_childs($javascript, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $javascript    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($table, $ref_id)
    {
        $has_subcats = FALSE;
		$results_ref = $this->ci->admin_model->get_childs_object_data($table,$ref_id);
        $html_out  = '';
        $html_out .= '';
        $html_out .= '';

        if (is_array($results_ref) || is_object($results_ref))
		{
        foreach ($results_ref as $ref) {
        $title = $ref->title;
		$url = $ref->url;
		$dyn_group_id = $ref->dyn_group_id;
		$id = $ref->id;
		$show = $ref->show;
		$target = $ref->target;
		$parent = $ref->parent_id;
		$is_parent = $ref->is_parent;
		$async = null;
		if($target == 539015){
			$async = 'async="async"';
		}
                $has_subcats = TRUE;
				$js = js_url().$url;
            	$js_bower = $this->ci->bower->add(js_bower().$url, array('embed' => TRUE));
                $js_bower = $this->ci->bower->add(js_bower().$url, array('embed' => TRUE));
                if ($is_parent == TRUE)
                {
                    // CodeIgniter's anchor(uri segments, text, attributes) tag.
                    $html_out .= "\t".'<script '.$async.' type="text/javascript" src="'.$js.'?v='.$js_bower['filemtime'].'"></script>'."\n";
                }
                else
                {
                    $html_out .= "\t".'<script '.$async.' type="text/javascript" src="'.$js.'?v='.$js_bower['filemtime'].'"></script>'."\n";
                }


                // Recurse call to get more child submenus.
                if($this->login){
                $html_out .= $this->get_childs_logged_in($table, $id);
                }
                
                if(!$this->login){
                $html_out .= $this->get_childs($table, $id);
                }
        }
        }
        $html_out .= '';
        $html_out .= '';

        return ($has_subcats) ? $html_out : FALSE;
    }
    
    function get_childs_logged_in($table, $ref_id)
    {
        $has_subcats = FALSE;
		$results_ref = $this->ci->admin_model->get_childs_object_data($table,$ref_id);
        $html_out  = '';
        $html_out .= '';
        $html_out .= '';

        if (is_array($results_ref) || is_object($results_ref))
		{
        foreach ($results_ref as $ref) {
        $title = $ref->title;
		$url = $ref->url;
		$dyn_group_id = $ref->dyn_group_id;
		$id = $ref->id;
		$show = $ref->show;
		$target = $ref->target;
		$parent = $ref->parent_id;
		$is_parent = $ref->is_parent;
             if ($target != 539015 && !empty($parent) && $dyn_group_id == 532705)    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;
				$js = js_url().$url;
            	$js_bower = $this->ci->bower->add(js_bower().$url, array('embed' => TRUE));
                if ($is_parent == TRUE)
                {
                    // CodeIgniter's anchor(uri segments, text, attributes) tag.
                    $html_out .= "\t".'<script type="text/javascript" src="'.$js.'?v='.$js_bower['filemtime'].'"></script>'."\n";
                }
                else
                {
                    $html_out .= "\t".'<script type="text/javascript" src="'.$js.'?v='.$js_bower['filemtime'].'"></script>'."\n";
                }

                // Recurse call to get more child submenus.
                if($this->login){
                $html_out .= $this->get_childs_logged_in($table, $id);
                }
                
                if(!$this->login){
                $html_out .= $this->get_childs($table, $id);
                }
                

            }
        }
        }
        $html_out .= '';
        $html_out .= '';

        return ($has_subcats) ? $html_out : FALSE;
    }
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  