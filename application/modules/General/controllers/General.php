<?php defined('BASEPATH') OR exit('No direct script access allowed');


class General extends MY_Controller {
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
		$this->property = $this->tb_dyn_menu->get_opengraph_property();
		$this->javascript = null;
	}

		 
	public function index()
	{
		force_ssl();
		$this->title = 'Home | Limononoto';	
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> 'Limononoto Design | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  'Fill do you want'
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('home', array(
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
		
	public function about()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'profile',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';	
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('about', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
        
	}
	public function contact()
	{
		$this->load->library(array('General/Tb_profile','Authentication/Recaptcha'));
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		if($this->property['title'] = 'get in touch')
		$this->property['title'] = 'contact';
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->form_validation = $this->tb_form->build_form_contact();
		$this->contact_profile = $this->tb_profile->build_mn_profile();
		$this->javascript = $this->bower->js('default');
        $this->javascript[] = $this->bower->add(js_url().'/jquery/lm-select-form.js');
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('contact', array(
            'menu_title' => $this->menu_title,
            'form_validation' => $this->form_validation,
           	 'contact_profile' => $this->contact_profile 
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js,
            'javascript' => $this->javascript
        ));
	}
	public function join()
	{
		$this->load->library(array('General/Tb_profile','General/Recaptcha'));
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->form_validation = $this->tb_form->build_form_applicant();
		$this->contact_profile = $this->tb_profile->build_mn_profile();
		$this->javascript = $this->bower->js('default');
        $this->javascript[] = $this->bower->add(js_url().'/jquery/lm-select-form.js');
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('contact/join', array(
            'menu_title' => $this->menu_title,
            'form_validation' => $this->form_validation,
           	 'contact_profile' => $this->contact_profile 
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js,
            'javascript' => $this->javascript
        ));
	}
	
    public function expertise()
	{
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('expertise', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function careers()
	{
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('careers', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function load_blog(){
		$data			= array();
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$categories = $this->input->post('categories');
		if($categories && !empty($categories) && $categories != 53175010){
		 $this->blog = $this->tb_dyn_listing_menu->load_menu_data('tb_dyn_menu_blog',$limit,$start,'blog',$categories);
		 $load = $this->load->view('blog/category', array('blog'=>$this->blog));
		}else{
		 $this->blog = $this->tb_dyn_listing_menu->load_menu_data('tb_dyn_menu_blog',$limit,$start,'blog',null);
		 $load = $this->load->view('blog/page', array('blog'=>$this->blog));
		}
		if($limit && !empty($limit) && $load != null){
		 echo json_encode($load);
		}
	}
	public function load_work(){
		$data			= array();
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$categories = $this->input->post('categories');
		if($categories && !empty($categories) && $categories != 5317101){
		 $this->work = $this->tb_dyn_listing_menu->load_menu_data('tb_dyn_menu_work',$limit,$start,'work',$categories);
		 $load = $this->load->view('work/category', array('work'=>$this->work));
		}else{
		 $this->work = $this->tb_dyn_listing_menu->load_menu_data('tb_dyn_menu_work',$limit,$start,'work',null);
		 $load = $this->load->view('work/page', array('work'=>$this->work));
		}
		if($limit && !empty($limit) && $load != null){
		 echo json_encode($load);
		 //$this->output->enable_profiler(TRUE);
		}
	}
	public function work()
	{
		force_ssl();
		$this->output->delete_cache();
		//$this->output->cache(60); // Will expire in 60 minutes
		$this->categories = $this->tb_dyn_listing_menu->load_categories('tb_categories_work');
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('work', array(
            'menu_title' => $this->menu_title,
            'categories'=>$this->categories
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function blog()
	{
		force_ssl();
		$this->categories = $this->tb_dyn_listing_menu->load_categories('tb_categories_blog');
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('blog', array(
            'menu_title' => $this->menu_title,
            'categories'=>$this->categories
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function privacy()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('privacy', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function help()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('help', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
    public function terms()
	{
		force_ssl();
		$this->opengraph = 	array(
								'type'				=> 'website',
								'title'				=> $this->property['page_title'].' | Limononoto',
								'url'				=> site_url().''.uri_string(),
								'image'				=> img_url().'favicon/logo.png',
								'description'		=>  $this->property['description']
							);
		$this->load->vars('opengraph', $this->opengraph);
		$this->title = ucfirst($this->property['title']).' | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css,
            'navbar' => $this->navbar,
            'navmenu' => $this->navmenu,
            'newsletter' => $this->newsletter,
            'navbar_form' => $this->navbar_form
        ));
		$this->render('terms', array(
            'menu_title' => $this->menu_title
        ));
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js
        ));
	}
	public function sitemap()
	{
		$data = "";//select urls from DB to Array
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->render("sitemap", array(
            'data' => $data
        ));
	}
	
	public function sitemap_image()
	{
		$this->image = $this->tb_dyn_menu->sitemap_image();
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->render("sitemap-image", array(
            'image' => $this->image
        ));
	}
	public function logout()
    {
        // delete cookie dan session
        
        $this->title = 'Logout | Limononoto';
		// log the user out
		$logout = $this->auth_libraries->logout();
		// redirect them to the login page
		$this->session->set_flashdata('logout','telah logout');
		return redirect('auth');    
    }
	
}
# nama file home.php
# folder apllication/controller/