<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Tb_dyn_listing_menu {

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
    function __construct($params = array())
    {
    	$this->ci = & get_instance();
    	$this->ci->load->helper(array('text','html'));
		// Dependancies
		if(CI_VERSION >= 2.2){
			$this->ci->load->library('driver');
		}
        log_message('debug', "Pagination Class Initialized");
        $this->ci->load->model(array('content_model'));
        $this->login = $this->ci->session->userdata('login');
    }
    public function __get($var)
	{
		return get_instance()->$var;
	}
	public function load_categories($table){
    	$results = $this->menu_model->get_categories_active($table);
    	$menu_url = uri_string();
    	if (is_array($results) || is_object($results))
		{
			$html_out  = "\t".'<div class="lm-col lm-col-1 lm-filters lm-filters-closed fade out"><h4>sort</h4>'."\n";
			$html_out .= "\t".'<ul id="lm-sort-value" class="lm-filters-ul">'."\n";
			foreach ($results as $row) {
			$name = decrypt_ciphertext($row->name);
			$id = decrypt_ciphertext($row->id);
			$uri = convert_accented_characters(url_title($name, "dash", TRUE));
			if($menu_url == 'work') {
				$html_out .= "\t".'<li class="lm-filters-li" data-id="'.$id.'" title="'.$name.'"><a>'.$name.'</a></li>'."\n";
				 }
			if($menu_url == 'blog') {
				$html_out .= "\t".'<li class="lm-filters-li" data-id="'.$id.'" title="'.$name.'"><a>'.$name.'</a></li>'."\n";
			}
			 }
			 $html_out .= "\t".'</ul>'."\n";
			 $html_out .= "\t".'</div>'."\n";
	        }else{
		       $html_out = null; 
	        }	
        return $html_out;
		}
	public function load_menu_data($table,$limit,$start,$ref_url,$categories){
		if($categories && !empty($categories)){
    		$results = $this->menu_model->load_menu_data_categories($table,$limit,$start,$ref_url,$categories);
    	}else{
	    	$results = $this->menu_model->load_menu_data($table,$limit,$start,$ref_url);
    	}
    	$html_out  = "\t".''."\n";
    	if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$title = decrypt_ciphertext($row->title);
			$caption = decrypt_ciphertext($row->caption);
			$url = decrypt_ciphertext($row->url);
			$id = decrypt_ciphertext($row->id);
			$file = upload_url().''.$ref_url.'/'.$id.'/'.decrypt_ciphertext($row->file);
			$image = base64_image($file);
			$menu_id = $row->menu_id;
			$category_id = $row->category_id;
			$show = decrypt_ciphertext($row->show);
			$salt = $row->salt;
			$created_on = date_to_en($row->created_on);
			$datetime = date("Y-m-d H:i:s", $row->created_on);
			$uri_limiter = word_limiter($url,1);
			$parent = $row->parent_id;
			$uri = convert_accented_characters(url_title($uri_limiter, "dash", TRUE));
			if(empty($parent)){
			$category = $this->menu_model->plain_get_categories('tb_categories_'.$ref_url,$category_id);
			$category = decrypt_ciphertext($category);
			$category = ucfirst($category);
			$title = character_limiter($title,100);
			$alt = word_limiter($caption,5);
			list($width, $height) = getimagesize("$file");
			$html_out .= "\t".'<li class="lm-col lm-col-2 lm-grid-item" title="'.$title.'"><div class="lm-grid-wrapper">'."\n";
				if($ref_url == 'blog') {
				$html_out .= "\t".'<a href="'.$ref_url.'/'.$id.'/'.$uri.'"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div><div class="lm-post-thumbnail"><h3>'.$title.'</h3><div class="lm-ui-caption"><h5>'.$category.'</h5><div class="lm-ui-time"><time datetime="'.$datetime.'">'.$created_on.'</time></div></div></div></a>'."\n";
				 }
				 if($ref_url == 'work') {
					$html_out .= "\t".'<a href="'.$ref_url.'/'.$id.'/'.$uri.'"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div><div class="lm-post-thumbnail"><h3>'.$title.'</h3><div class="lm-ui-caption"><h5>'.$category.'</h5></div></div></a>'."\n";	  
				 }
				 $html_out .= "\t".'</div></li>'."\n";
			 }
	        }	
	        }else{
		       $html_out = null; 
	        }	
        return $html_out;
		}
	
    public function get_menu_data($table,$limit,$start){
    	$results = $this->menu_model->get_menu_data($table,$limit,$start);
    	$html_out  = "\t".''."\n";
    	$menu_url = uri_string();
    	if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$title = decrypt_ciphertext($row->title);
			$caption = decrypt_ciphertext($row->caption);
			$url = decrypt_ciphertext($row->url);
			$id = decrypt_ciphertext($row->id);
			$file = upload_url().''.$menu_url.'/'.$id.'/'.decrypt_ciphertext($row->file);
			$show = decrypt_ciphertext($row->show);
			$category_id = decrypt_ciphertext($row->category_id);
			$salt = $row->salt;
			$uri_limiter = word_limiter($url,1);
			$uri = convert_accented_characters(url_title($uri_limiter, "dash", TRUE));
			if($row->is_parent == 1 && $row->parent_id == 0) {
			$category = $this->menu_model->plain_get_categories('tb_categories_work',$category_id);
			$category = decrypt_ciphertext($category);
			$category = ucfirst($category);
			$html_out .= "\t".'<li class="lm-col lm-col-2 lm-grid-item" title="'.$title.'">
			<div  class="lm-image b-lazy" style="background-image: url('.$file.')"></div><div class="lm-post-thumbnail">
			<h4>'.$category.'</h4><h2>'.$title.'</h2><p>'.$caption.'</p></div><a href="'.$id.'/'.$uri.'"></a></li>'."\n";
				 
			 }
	        }
	        }else{
		       $html_out = null; 
	        }			
        return $html_out;
		}
	public function get_content_blog($table,$limit,$start,$menu_url,$id){
    	$results = $this->content_model->get_content_data($table,$limit,$start,$menu_url,$id);
    	$html_out  = "\t".''."\n";
    	if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$title = decrypt_ciphertext($row->title);
			$caption = decrypt_ciphertext($row->caption);
			$url = decrypt_ciphertext($row->url);
			$id = decrypt_ciphertext($row->id);
			$file = upload_url().''.$menu_url.'/'.$id.'/'.decrypt_ciphertext($row->file);
			$_id = $row->id;
			$show = decrypt_ciphertext($row->show);
			$text = decrypt_ciphertext($row->text);
			$created_on = date_to_en($row->created_on);
			$salt = $row->salt;
			$category_id = $row->category_id;
			$alt = word_limiter($caption,5);
			$uri = convert_accented_characters(url_title($url, "dash", TRUE));
			$category = $this->menu_model->plain_get_categories('tb_categories_'.$menu_url,$category_id);
			$category = decrypt_ciphertext($category);
			$category = ucfirst($category);
			$html_out .= "\t".'<div class="lm-content lm-post-work">'."\n";
			$paragraph_1 = word_limiter($text , 57, '');
			$rest_of_paragraph_1 = trim(str_replace($paragraph_1, "", $text));
			$newarr = explode("\n",$text);
			$paragraph_1 = null;
			$paragraph_2 = null;
			$paragraph_3 = null;
			$paragraph_4 = null;
			$paragraph_5 = null;
			$paragraph_6 = null;
			if(!empty($newarr[0]))
			   $paragraph_1 = '<p>'.$newarr[0].'</p>';
			if(!empty($newarr[1]))
			   $paragraph_2 = '<p>'.$newarr[1].'</p>';
			if(!empty($newarr[2]))
			   $paragraph_3 = '<p>'.$newarr[2].'</p>';
			if(!empty($newarr[3]))
			   $paragraph_4 = '<p>'.$newarr[3].'</p>';
			if(!empty($newarr[4]))
			   $paragraph_5 = '<p>'.$newarr[4].'</p>';
			if(!empty($newarr[5]))
			   $paragraph_6 = '<p>'.$newarr[5].'</p>';
			if (strpos($paragraph_1, "\n") !== false) {
			    $html_out .= "\n";
			}
			if($row->is_parent == 1 && $row->parent_id == 0) {
			$image = base64_image($file);
			list($width, $height) = getimagesize("$file");
			$image_properties = array(
				        'src'   => $image,
				        'alt'   => $alt,
				        'data-src'   => $file,
				        'class' => 'lm-image b-lazy',
				        'width' => $width,
				        'height'=> $height,
				        'rel'   => 'lightbox'
				);
			$html_out .= "\t".'<div class="lm-wrapper-media lm-image-size"><div class="b-lazy lm-media-image" data-src="'.$file.'"></div></div>
			<div class="lm-wrapper-content"><div class="lm-text">
			<div class="lm-scroll-to-inner lm-section-container">
			<div class="lm-text-block">
			<h1 class="lm-title">'.$title.'</h1>
			</div>
			<div class="lm-scroll-to-reveal lm-section-block">
			<div class="lm-section-item">';
		    $html_out .= $paragraph_1.''.$paragraph_2.''.$paragraph_3.''.$paragraph_4.''.$paragraph_5;
			$html_out .='</div></div></div></div>
			'."\n";
			}
			$html_out .= "\t".'<ul class="lm-hero-image lm-scroll-to-reveal js-flickity" id="lm-slide-block">'."\n";
			$html_out .= "\t".'<li class="lm-slide-item" title="'.$title.'"><div class="lm_listing_main"><h2 class="lm-explore">Taking cover
A cross-media experience</h2></div></li>'."\n";
			$html_out .= $this->get_childs_content_blog($table,$_id);
        	$html_out .= "\t".'</ul><span id="lm-show-item"><span id="lm-show-count"></span></span>'."\n";
        	 /*Related Post*/
        	 $html_out .= $this->load_related_posts($table,$menu_url,$category_id,$row->id);
	        }
	        }else{
		       $html_out = null; 
	        }
	        $html_out .= "\t".'</div></div>'."\n";			
        return $html_out;
		}
	public function get_content_data($table,$limit,$start,$menu_url,$id){
    	$results = $this->content_model->get_content_data($table,$limit,$start,$menu_url,$id);
    	$html_out  = "\t".''."\n";
    	if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$title = decrypt_ciphertext($row->title);
			$caption = decrypt_ciphertext($row->caption);
			$url = decrypt_ciphertext($row->url);
			$id = decrypt_ciphertext($row->id);
			$file = upload_url().''.$menu_url.'/'.$id.'/'.decrypt_ciphertext($row->file);
			$_id = $row->id;
			$show = decrypt_ciphertext($row->show);
			$text = decrypt_ciphertext($row->text);
			$created_on = date_to_en($row->created_on);
			$salt = $row->salt;
			$category_id = $row->category_id;
			$alt = word_limiter($caption,5);
			$uri = convert_accented_characters(url_title($url, "dash", TRUE));
			$category = $this->menu_model->plain_get_categories('tb_categories_'.$menu_url,$category_id);
			$category = decrypt_ciphertext($category);
			$category = ucfirst($category);
			$html_out .= "\t".'<div class="lm-content lm-post-work">'."\n";
			$paragraph_1 = word_limiter($text , 57, '');
			$rest_of_paragraph_1 = trim(str_replace($paragraph_1, "", $text));
			$newarr = explode("\n",$text);
			$paragraph_1 = null;
			$paragraph_2 = null;
			$paragraph_3 = null;
			$paragraph_4 = null;
			$paragraph_5 = null;
			$paragraph_6 = null;
			if(!empty($newarr[0]))
			   $paragraph_1 = '<p>'.$newarr[0].'</p>';
			if(!empty($newarr[1]))
			   $paragraph_2 = '<p>'.$newarr[1].'</p>';
			if(!empty($newarr[2]))
			   $paragraph_3 = '<p>'.$newarr[2].'</p>';
			if(!empty($newarr[3]))
			   $paragraph_4 = '<p>'.$newarr[3].'</p>';
			if(!empty($newarr[4]))
			   $paragraph_5 = '<p>'.$newarr[4].'</p>';
			if(!empty($newarr[5]))
			   $paragraph_6 = '<p>'.$newarr[5].'</p>';
			if (strpos($paragraph_1, "\n") !== false) {
			    $html_out .= "\n";
			}
			if($row->is_parent == 1 && $row->parent_id == 0) {
			$image = base64_image($file);
			list($width, $height) = getimagesize("$file");
			$image_properties = array(
				        'src'   => $image,
				        'alt'   => $alt,
				        'data-src'   => $file,
				        'class' => 'lm-image b-lazy',
				        'width' => $width,
				        'height'=> $height,
				        'rel'   => 'lightbox'
				);
			$html_out .= "\t".'<div class="lm-wrapper-media lm-image-size"><div class="b-lazy lm-media-image" data-src="'.$file.'"></div></div>
			<div class="lm-wrapper-content"><div class="lm-text">
			<div class="lm-scroll-to-inner lm-flex-container">
			<div class="lm-text-block lm-flex-item">
			<h1 class="lm-title">'.$title.'</h1>
			</div>
			</div>
			<div class="lm-scroll-to-reveal lm-flex-container lm-flex-block lm-flex-right">
			<div class="lm-section-content lm-flex-item">';
		    $html_out .= $paragraph_1.''.$paragraph_2.''.$paragraph_3.''.$paragraph_4.''.$paragraph_5;
			$html_out .='</div></div></div>
			'."\n";
			}
			$html_out .= "\t".'<ul class="lm-hero-image lm-scroll-to-reveal js-flickity" id="lm-slide-block">'."\n";
			$html_out .= "\t".'<li class="lm-slide-item" title="'.$title.'"><div class="lm_listing_main"><h2 class="lm-explore">Taking cover
A cross-media experience</h2></div></li>'."\n";
			 $html_out .= $this->get_childs_content_data($table,$_id);
        	 $html_out .= "\t".'</ul><span id="lm-show-item"><span id="lm-show-count"></span></span>'."\n";
        	 /*Quote from creator or company*/
        	 $html_out .= $this->load_idea($table,$menu_url,$row->id,$row->creator_id);
        	 /*Related Post*/
        	 $html_out .= $this->load_related_posts($table,$menu_url,$category_id,$row->id);
	        }
	        }else{
		       $html_out = null; 
	        }
	        $html_out .= "\t".'</div></div>'."\n";			
        return $html_out;
		}	
	public function load_idea($table,$ref_url,$post_id,$creator_id){
		$results = $this->content_model->load_idea($post_id,$creator_id);
    	
    	if (is_array($results) || is_object($results)){
			$html_out  = "\t".''."\n";
		foreach ($results as $row) {
			$quote = decrypt_ciphertext($row->quote);
			$idea = decrypt_ciphertext($row->idea);
			$html_out .= "\t".'<div class="lm-caption">'."\n";
				if($ref_url == 'blog') {
				$html_out .= "\t".'<div class="lm-flex-container lm-scroll-to-reveal"><div class="lm-flex-item lm-text-block lm-section-content"><h2>Idea</h2><p>'.$idea.'</p><div class="lm-quote lm-scroll-to-reveal"><blockquote><p class="lm-quote-p">'.$quote.'</p><footer class="lm-footer-quote"><cite><span>Bayu Syaits Dhin Anwar</span></cite></footer></blockquote></div></div></div>'."\n";		  
				 }
				 if($ref_url == 'work') {
				$html_out .= "\t".'<div class="lm-flex-container lm-scroll-to-reveal"><div class="lm-flex-item lm-text-block lm-section-content"><h2>Idea</h2><p>'.$idea.'</p><div class="lm-quote lm-scroll-to-reveal"><blockquote><p class="lm-quote-p">'.$quote.'</p><footer class="lm-footer-quote"><cite><span>Bayu Syaits Dhin Anwar</span></cite></footer></blockquote></div></div></div>'."\n";	  
				 }
				 $html_out .= "\t".'</div>'."\n";
			}
	        }else{
		    $html_out = null; 
	        }	
        return $html_out;
		}
    public function load_related_posts($table,$ref_url,$categories_id,$ref_id){
		$results = $this->content_model->load_related_posts($table,$ref_url,$categories_id,$ref_id);
    	
    	if (is_array($results) || is_object($results))
		{
			$html_out  = "\t".''."\n";
			foreach ($results as $row) {
			$title = decrypt_ciphertext($row->title);
			$caption = decrypt_ciphertext($row->caption);
			$url = decrypt_ciphertext($row->url);
			$id = decrypt_ciphertext($row->id);
			$file = upload_url().''.$ref_url.'/'.$id.'/'.decrypt_ciphertext($row->file);
			$image = base64_image($file);
			$menu_id = $row->menu_id;
			$category_id = $row->category_id;
			$show = decrypt_ciphertext($row->show);
			$salt = $row->salt;
			$created_on = date_to_en($row->created_on);
			$datetime = date("Y-m-d H:i:s", $row->created_on);
			$uri_limiter = word_limiter($url,1);
			$uri = convert_accented_characters(url_title($uri_limiter, "dash", TRUE));
			$html_out .= "\t".'<div class="lm-related-posts lm-scroll-to-reveal"><h2 class="lm-related-posts-title">More Projects</h2><ul class="lm-list-item lm-grid lm-work">'."\n";
			$category = $this->menu_model->plain_get_categories('tb_categories_'.$ref_url,$category_id);
			$category = decrypt_ciphertext($category);
			$category = ucfirst($category);
			$title = character_limiter($title,100);
			$alt = word_limiter($caption,5);
			list($width, $height) = getimagesize("$file");
			$html_out .= "\t".'<li class="lm-col lm-col-2 lm-grid-item" title="'.$title.'"><div class="lm-grid-wrapper">'."\n";
			$image_properties = array(
				        'src'   => $image,
				        'alt'   => $alt,
				        'data-src'   => $file,
				        'class' => 'lm-image b-lazy',
				        'width' => $width,
				        'height'=> $height,
				        'rel'   => 'lightbox'
				);
				if($ref_url == 'blog') {
				$html_out .= "\t".'<div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div><div class="lm-post-thumbnail"><a href="'.$ref_url.'/'.$id.'/'.$uri.'"><h3>'.$title.'</h3><div class="lm-ui-caption"><h5>'.$category.'</h5><div class="lm-ui-time"><time datetime="'.$datetime.'">'.$created_on.'</time></div></div></div></a>'."\n";
				 }
				 if($ref_url == 'work') {
					$html_out .= "\t".'<a href="'.$ref_url.'/'.$id.'/'.$uri.'"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div><div class="lm-post-thumbnail"><h3>'.$title.'</h3><div class="lm-ui-caption"><h5>'.$category.'</h5></div></div></a>'."\n";	  
				 }
				 $html_out .= "\t".'</div></li>'."\n";
				 $html_out .= "\t".'</ul></div>'."\n";
	        }	
	        }else{
		       $html_out = null; 
	        }	
        return $html_out;
		}
	function shared_post(){
		$html_out  = '';	
	}
    function get_childs_content_data($table,$ref_id)
    {
        $html_out  = '';
        $limit = 0;
        $start = 0;
        $menu_url = $this->uri->segment(1);
        $results_ref = $this->ci->content_model->get_childs_content_data($table,$limit, $start,$ref_id);
        if (is_array($results_ref) || is_object($results_ref))
		{
			foreach ($results_ref as $ref) {
			$title = decrypt_ciphertext($ref->title);
			$caption = decrypt_ciphertext($ref->caption);
			$url = decrypt_ciphertext($ref->url);
			$id = $ref->id;
			$file = upload_url().''.$menu_url.'/'.decrypt_ciphertext($ref_id).'/'.decrypt_ciphertext($ref->file);
			$image = base64_image($file);
			$show = decrypt_ciphertext($ref->show);
			$salt = $ref->salt;
			$parent = $ref->parent_id;
			$position = $ref->position;
			$is_parent = $ref->is_parent;
			$uri = convert_accented_characters(url_title($url, "dash", TRUE));
			$_id = decrypt_ciphertext($id);
			$has_subcats = TRUE;
            $alt = word_limiter($caption,5);
            $caption = character_limiter($caption,250);
            list($width, $height) = getimagesize("$file");
            $image_properties = array(
				        'src'   => $image,
				        'alt'   => $alt,
				        'data-src'   => $file,
				        'class' => 'lm-image b-lazy',
				        'width' => $width,
				        'height'=> $height,
				        'rel'   => 'lightbox'
				);
			if ($is_parent == TRUE)
                {
				if(!empty($file)){
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div></li>'."\n";
		 		}
		 		if (!empty($caption)) {
                	$html_out .= "\t".'<li class="lm-slide-item lm-text-slide-outer"><div class="lm-text-slide"><h4>'.$caption.'</h4></div></li>'."\n";
				}
			}else{
				list($width, $height) = getimagesize("$file");
				$extention = file_extention($file);
				if(!empty($file)){
				if($extention != 'mp4'){
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div></li>'."\n";
					}else{
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-video-size">
					<video class="lm-video b-lazy" controls>
			        <source data-src="video.mp4" type="video/mp4">
			        <source data-src="video.webm" type="video/webm"></video></div></li>'."\n";	
					}
		 		}
		 		if (!empty($caption)) {
            	    $html_out .= "\t".'<li class="lm-slide-item lm-text-slide-outer"><div class="lm-text-slide"><h4>'.$caption.'</h4></div></li>'."\n";
				}
			}
			$html_out .= $this->get_childs_content_data($table,$id);
			}
		
		}
                  
        $html_out .= '';
        return $html_out;
        
    }
    
    function get_childs_content_blog($table,$ref_id)
    {
        $html_out  = '';
        $limit = 0;
        $start = 0;
        $menu_url = $this->uri->segment(1);
        $results_ref = $this->ci->content_model->get_childs_content_data($table,$limit, $start,$ref_id);
        if (is_array($results_ref) || is_object($results_ref))
		{
			foreach ($results_ref as $ref) {
			$title = decrypt_ciphertext($ref->title);
			$caption = decrypt_ciphertext($ref->caption);
			$url = decrypt_ciphertext($ref->url);
			$id = $ref->id;
			$file = upload_url().''.$menu_url.'/'.decrypt_ciphertext($ref_id).'/'.decrypt_ciphertext($ref->file);
			$image = base64_image($file);
			$show = decrypt_ciphertext($ref->show);
			$salt = $ref->salt;
			$parent = $ref->parent_id;
			$position = $ref->position;
			$is_parent = $ref->is_parent;
			$uri = convert_accented_characters(url_title($url, "dash", TRUE));
			$_id = decrypt_ciphertext($id);
			$has_subcats = TRUE;
            $alt = word_limiter($caption,5);
            $caption = character_limiter($caption,250);
            list($width, $height) = getimagesize("$file");
            $image_properties = array(
				        'src'   => $image,
				        'alt'   => $alt,
				        'data-src'   => $file,
				        'class' => 'lm-image b-lazy',
				        'width' => $width,
				        'height'=> $height,
				        'rel'   => 'lightbox'
				);
			if ($is_parent == TRUE)
                {
				if(!empty($file)){
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div></li>'."\n";
		 		}
		 		if (!empty($caption)) {
                	$html_out .= "\t".'<li class="lm-slide-item lm-text-slide-outer"><div class="lm-text-slide"><h4>'.$caption.'</h4></div></li>'."\n";
				}
			}else{
				list($width, $height) = getimagesize("$file");
				$extention = file_extention($file);
				if(!empty($file)){
				if($extention != 'mp4'){
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-image-size"><img src="'.$image.'" alt="'.$alt.'" data-src="'.$file.'" class="lm-image b-lazy" width="'.$width.'" height="'.$height.'" rel="lightbox"/></div></li>'."\n";
					}else{
					$html_out .= "\t".'<li class="lm-slide-item lm-file-slide-outer"><div class="lm-video-size">
					<video class="lm-video b-lazy" controls>
			        <source data-src="video.mp4" type="video/mp4">
			        <source data-src="video.webm" type="video/webm"></video></div></li>'."\n";	
					}
		 		}
		 		if (!empty($caption)) {
            	    $html_out .= "\t".'<li class="lm-slide-item lm-text-slide-outer"><div class="lm-text-slide"><h4>'.$caption.'</h4></div></li>'."\n";
				}
			}
			$html_out .= $this->get_childs_content_blog($table,$id);
			}
		
		}
                  
        $html_out .= '';
        return $html_out;
        
    }
    
        
}

