<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twofactor extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Bower', array('CI' => $this));
		$this->load->library(array('General/Tb_form','General/Tb_dyn_listing_menu','General/Tb_dhd_css','General/Tb_dyn_medsos','Authentication/Auth_libraries','Authentication/auth_dyn_menu','General/Tb_dft_javascript','Password','Format'));
		$this->load->helper(array('form','cilm_limononoto','language'));
		$this->load->model(array('object_model','menu_model','user_model'));
		$this->_required_user();
		$this->_check_vaidity();
		$this->css = $this->tb_dhd_css->build_css();
		$this->menu_title = $this->auth_dyn_menu->build_menu_title();
		$this->menu_footer = $this->auth_dyn_menu->build_menu_footer();
		$this->js = $this->tb_dft_javascript->build_javascript();
		$this->login = $this->session->userdata('login');
		$id = $this->login['id'];
		$this->user = $this->user_model->get_user_name($id);
		$this->javascript = null;
	}
	public function index()
	{	
		force_ssl();
		$login = $this->session->userdata('login');
		$twofactor = $this->session->userdata('twofactor');
		$this->title = 'Two-factor Authentication | Limononoto';
		$this->render('include/header', array(
            'css' => $this->css
        ));
		$email = $this->input->get('e-mail');
		$activation = $this->input->get('activation');
		$this->javascript[] = $this->bower->add(js_url().'/ajax/lm-form.js');
		if($twofactor != null && $this->input->get('v2') == 'a' && $email == decrypt_email($login['email']) && $login['activation_code'] != null){
		$this->form_auth = $this->tb_form->build_form_twofactor();
			if($this->password->validate_bcrypt($activation, $login['activation_code'])) {
				$this->render('twofactor', array(
		            'menu_title' => $this->menu_title,
		            'form_auth' => $this->form_auth
		        ));	
			}else{
				$this->render('twofactor', array(
		            'menu_title' => $this->menu_title,
		            'form_auth' => $this->form_auth
		        ));	
			}//else_validate_password
		}else {
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('twofactor');	
		redirect("login?twofactor");	
		}//else_$get_vc
		$this->render('include/footer', array(
            'menu_footer' => $this->menu_footer,
            'js' => $this->js,
            'javascript' => $this->javascript
        ));	

	}
	public function twofactor(){
		$errors         = array();      // array to hold validation errors
		$data			= array();
		$this->config->load('validation_rules');
		$twofactor = $this->session->userdata('login');
		$email = decrypt_email($twofactor['email']);
		$this->form_validation->set_rules($this->config->item('twofactor'));
		$code = $this->input->post('code');
		$birthday = $this->input->post('birthday');
		$activation_code = generateRandomNumeric(6);
		$token_salt = generateToken(20);   
		$hash_activation_code = $this->password->create_bcrypt($activation_code);
		$datauser = array(
			        'email' => $twofactor['email'],
					'levels_id' => $twofactor['levels_id'],
					'id' => $twofactor['id'],
					'last_login' => $twofactor['last_login'],
					'activation' => $hash_activation_code
	    );
	    $plain = array(
			        'birthday' => $birthday,
					'levels_id' => $twofactor['levels_id'],
					'id' => $twofactor['id'],
					'activation_code' => $hash_activation_code,
					'salt' => $token_salt
	    );	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$data['email'] = $this->lang->line('err_data_exists');
			$this->session->unset_userdata('login');	
			$data['redirect_errors'] = 'auth';
		}
		if (empty($code))
		    $data['code'] = $this->lang->line('err_code_required');
		if (empty($birthday))
		    $data['birthday'] = $this->lang->line('err_birthday_required');
		if($this->form_validation->run() == true) {
		if($this->password->validate_bcrypt($code, $twofactor['activation_code'])){
			$plain_twofactor = $this->auth_model->plain_twofactor($plain);
			if($plain_twofactor == ERR_NONE) {
				$data['success'] = true;
				$data['message'] = $this->lang->line('success_activation_code');
				$this->session->set_userdata("login", $datauser);
				$this->session->set_userdata("twofactor", $token_salt);
			    $data['redirect'] = 'api/twofactor';
			}
			else {
				$data['success'] = false;
				$data['birthday'] = $this->lang->line('err_birthday_invalid');
				$data['message'] = $this->lang->line('err_input_activation');
			}	
				
		} else {
			$data['success'] = false;
			$data['code'] = $this->lang->line('err_code_invalid');
			$data['message'] = $this->lang->line('err_input_activation');
		}		
		} else {
		$data['success'] = false;
		$data['errors'] = $errors;
		$data['message'] = $this->lang->line('err_input_activation');
		}// else_empty
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
# nama file home.php
# folder apllication/controller/