<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Content extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_check_vaidity();	
		$this->load->library('Bower', array('CI' => $this));
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dyn_medsos','General/Tb_dyn_menu','General/Tb_dft_javascript','Facebook'));
		$this->load->helper(array('form','cilm_limononoto','seo_helper','cookie'));
		$this->load->model(array('object_model','menu_model'));
		$this->facebook->enable_debug(TRUE);
	    $this->css = $this->tb_dhd_css->build_css();
		$this->navbar = $this->tb_dyn_menu->build_navbar();
		$this->navmenu = $this->tb_dyn_menu->build_menu();
		$this->navbar_form = $this->tb_form->build_navbar_auth();
		$this->menu_title = $this->tb_dyn_menu->build_menu_title();
		$this->menu_footer = $this->tb_dyn_menu->build_menu_footer();
		$this->newsletter = $this->tb_form->build_navbar_newsletter();
		$this->js = $this->tb_dft_javascript->build_javascript();
		$this->javascript = null;	
	}
	public function blog()
	{
		$id = urldecode($this->uri->segment(2));
		$menu_url = urldecode($this->uri->segment(1));
		//$this->output->cache(6); // Will expire in 6 minutes
		$this->javascript = null;
		$this->blog = $this->tb_dyn_listing_menu->get_content_blog('tb_dyn_menu_blog',1,0,$menu_url,$id);
		$this->property = $this->tb_dyn_menu->get_opengraph_content('tb_dyn_menu_blog',$menu_url,$id);
		$this->opengraph = 	array(
								'type'				=> 'article',
								'title'				=> $this->property['title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> $this->property['file'],
								'description'		=>  $this->property['caption']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$title = restrict_writing($this->property['title'],25,' ');
		$this->title = ucfirst($title).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		if($this->blog == null){
		$this->render('errors/cli/error_404');
		}else{
		$this->render('blog/index', array(
            'blog'=>$this->blog
        ));
        }
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function work()
	{
		$id = urldecode($this->uri->segment(2));
		$menu_url = urldecode($this->uri->segment(1));
		$this->javascript = array();
		$this->work = $this->tb_dyn_listing_menu->get_content_data('tb_dyn_menu_work',1,0,$menu_url,$id);
		$this->property = $this->tb_dyn_menu->get_opengraph_content('tb_dyn_menu_work',$menu_url,$id);
		$this->opengraph = 	array(
								'type'				=> 'article',
								'title'				=> $this->property['title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> $this->property['file'],
								'description'		=>  $this->property['caption']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$title = restrict_writing($this->property['title'],25,' ');
		$this->title = ucfirst($title).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		if($this->work == null){
		$this->javascript = null;
		$this->render('errors/cli/error_404');
		}else{
		$this->javascript[] = $this->bower->add(js_url().'jquery/carousels.min.js');
		$this->render('work/index', array(
            'content'=>$this->work
        ));
        }
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js,
            'javascript' => $this->javascript
        ));
	}	
}
# nama file home.php
# folder apllication/controller/