<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Tb_form {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_form       = 'id="tag_id_form"';
    private $class_form    = 'class="tag_class_form"';
    private $class_parent  = 'class="parent_form"';
    private $class_last    = 'class="last_form"';
    private $login;
    private $signup;
  
    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
        $this->ci->load->config('recaptcha');
        $this->ci->lang->load('auth_lang');    
		$this->ci->load->library(array('password','form_validation'));
		$this->ci->load->helper(array('authorization','cilm_limononoto','language'));    
        $this->login = $this->ci->session->userdata('login');
        $this->signup = $this->ci->session->tempdata("sign_up");
        $this->recaptcha = $this->ci->config->item("recaptcha_client_key");
        if(CI_VERSION >= 2.2){
			$this->ci->load->library('driver');
		}
		log_message('debug', "Form Class Initialized");
        $this->email = decrypt_ciphertext($this->login['email']);
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
    function build_navbar_auth()
    {
    	
        $html_out  = '<div class="lm-user-modal lm-ui-auth">'."\n";
        $html_out .= "\t\t".'<div class="lm-user-modal-container" style="background:#fff;">'."\n";

		$html_out .= "\t\t".'<p class="lm-heading">'.$this->ci->lang->line('auth_heading').'</p>'."\n";

        // loop through the $form array() and build the parent menus.
           if (!$this->login)    // are we allowed to see this menu?
                {
                   
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
	               $html_out .= $this->build_navbar_login();
	               $html_out .= $this->build_navbar_signup();
	               $html_out .= $this->build_navbar_passwordreset();
	            }
                    
        $html_out .= "\t\t".'<a class="lm-icon lm-icon-close">'.$this->ci->lang->line('close_auth').'</a>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    }     
    function form_login()
    {	
    	 $this->form_login = array(
    	 'class' => 'lm-form lm-form-auth ',
    	 'id' => 'lm-form-login');
    	
		$this->input_email = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-login-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		
		$this->input_password = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-login-password',
		'type' => 'text',
		'name' => 'password',
		'placeholder' => $this->ci->lang->line('password_placeholder'));
		
		$this->input_submit = array('id' => 'lm-ui-login-submit');
		
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_email = array('class' => 'lm-label-icon lm-icon-email');
		$this->lm_icon_password = array('class' => 'lm-label-icon lm-icon-password');
				
        // loop through the $form array() and build the parent menus.
      
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out = form_open('', $this->form_login)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= "\t".'<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-login">
								<p class="lm-form-message">'.$this->ci->lang->line('login_subheading').'</p></div>'."\n";
						$html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-login-email',$this->lm_icon_email)."\n";
                        $html_out .= form_input($this->input_email)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-login-email"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset);
                        $html_out .= form_label('','lm-ui-login-email',$this->lm_icon_password)."\n";
                        $html_out .= form_input($this->input_password)."\n";
                        $html_out .= "\t".'<a class="hide-password">Hide</a>';
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-password"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= "\t".'<div class="lm-col"><div class="lm-col-right">'."\n";
                        $html_out .= "\t".'<p class="lm-link-tab">'.anchor('passwordreset', $this->ci->lang->line('link_passwordreset_title')).'</p>'."\n";
                        $html_out .= '</div></div>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('login_submit_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= "\t\t".form_close()."\n";


        return $html_out;
    }
    function form_newsletter()
    {	
    	 $this->form = array(
    	 'class' => 'lm-form lm-subform',
    	 'id' => 'lm-form-newsletter');
    	
		$this->input_email = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-newsletter-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		
		$this->input_submit = array('id' => 'lm-ui-newsletter-submit');
		
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_email = array('class' => 'lm-label-icon lm-icon-email');
				
        // loop through the $form array() and build the parent menus.
      
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out = form_open('', $this->form)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= "\t".'<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-newsletter">
								<p class="lm-form-message">'.$this->ci->lang->line('newsletter_subheading').'</p></div>'."\n";
						$html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-newsletter-email',$this->lm_icon_email)."\n";
                        $html_out .= form_input($this->input_email)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-newsletter-email"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('newsletter_submit_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= "\t\t".form_close()."\n";


        return $html_out;
    }  
    function form_passwordreset()
    {
    	$this->form_passwordreset = array(
    	'class' => 'lm-form lm-form-auth',
    	'id' => 'lm-form-passwordreset');
    	
		$this->input_email = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-passwordreset-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		

		$this->input_submit = array('id' => 'lm-ui-passwordreset-submit');
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_email = array('class' => 'lm-label-icon lm-icon-email');
				

        // loop through the $form array() and build the parent menus.

        // CodeIgniter's anchor(uri segments, text, attributes) tag.
        $html_out = form_open('', $this->form_passwordreset)."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= "\t".'<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-passwordreset">
				<p class="lm-form-message">'.$this->ci->lang->line('passwordreset_subheading').'</p></div>'."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_label('','lm-ui-passwordreset-email',$this->lm_icon_email)."\n";
        $html_out .= form_input($this->input_email)."\n";
        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-passwordreset-email"></span>'."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_submit('',$this->ci->lang->line('passwordreset_submit_btn'),$this->input_submit)."\n";
        $html_out .= form_fieldset_close()."\n";
		$html_out .= "\t\t".form_close()."\n";
        
        return $html_out;
    
    }
    function form_signup_terms()
    {	
    	$this->form_signup =  array(
    	 'class' => 'lm-form lm-form-auth',
    	 'id' => 'lm-form-signup',
    	 'autocomplete' => 'off');
    	
		$this->input_email = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-signup-terms-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		

		$this->input_submit = array('id' => 'lm-ui-signup-terms-submit');
		
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_email = array('class' => 'lm-label-icon lm-icon-email');
				

        // loop through the $form array() and build the parent menus.
      
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out = form_open('', $this->form_signup)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                                $html_out .= "\t\t".'<div class="lm-warning lm-text-danger" id="lm-text-danger-signup-terms"><p class="lm-form-message">'.$this->ci->lang->line('signup_terms_subheading').'</p></div>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-signup-terms-email',$this->lm_icon_email)."\n";
                        $html_out .= form_input($this->input_email);
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-signup-email"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('signup_submit_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= "\t\t".form_close()."\n";


        return $html_out;
    }
    function form_twofactor()
    {
    	$this->form_twofactor = array(
    	'class' => 'lm-form lm-form-auth',
    	'id' => 'lm-form-twofactor');
    	
		$this->input_birthday = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-twofactor-birthday',
		'type' => 'text',
		'name' => 'birthday',
		'placeholder' => $this->ci->lang->line('birthday_placeholder'));
		
		$this->input_code = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-twofactor-code',
		'type' => 'text',
		'name' => 'code',
		'value' => $this->ci->input->get('activation'),
		'placeholder' => $this->ci->lang->line('verification_code_placeholder'));
		
		$this->input_submit = array('id' => 'lm-ui-twofactor-submit');
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_birthday = array('class' => 'lm-label-icon lm-icon-birthday');
		$this->lm_icon_code = array('class' => 'lm-label-icon lm-icon-code');
		$this->email = $this->ci->input->get('e-mail');
				

        // loop through the $form array() and build the parent menus.

        // CodeIgniter's anchor(uri segments, text, attributes) tag.
        $html_out = form_open('', $this->form_twofactor)."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= "\t".'<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-twofactor">
				<p class="lm-form-message">'.$this->ci->lang->line('activation_twofactor_subheading').''.$this->email.'</p></div>'."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_label('','lm-ui-twofactor-birthday',$this->lm_icon_birthday)."\n";
        $html_out .= form_input($this->input_birthday)."\n";
        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-birthday"></span>'."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_label('','lm-ui-twofactor-code',$this->lm_icon_code)."\n";
        $html_out .= form_input($this->input_code);
        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-code"></span>'."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_submit('',$this->ci->lang->line('activation_twofactor_btn'),$this->input_submit)."\n";
        $html_out .= form_fieldset_close()."\n";
		$html_out .= "\t\t".form_close()."\n";
        
        return $html_out;
    
    }
    function build_form_twofactor()
    {	
    	$html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
		$html_out .= "\t\t".'<div class="lm-offset-auth fade out" id="lm-twofactor">'."\n";
    	$html_out .= $this->ci->tb_form->form_twofactor()."\n";
        $html_out .= "\t\t".'<p class="lm-auth-p">'.$this->ci->lang->line('activation_twofactor_resend_code').anchor('', $this->ci->lang->line('resend_code'), array('id' => 'lm-ui-resendemail-twofactor','onclick' => 'return resendEmailTwoFactor();','target'=>'_blank')).'</p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    }     
    function build_navbar_login()
    {	
        $html_out  = "\t".'<div id="lm-login" class="lm-ui-form">'."\n";
        $html_out .= $this->ci->tb_form->form_login()."\n";
        $html_out .= "\t\t".'<p class="lm-form-bottom-signup center">'.$this->ci->lang->line('login_signup').'<a class="lm-signup" title="'.$this->ci->lang->line('link_signup_title').'">'.$this->ci->lang->line('link_signup_title').'</a></p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";
        return $html_out;
    }  
    function build_navbar_signup()
    {	
    	$html_out  = "\t".'<div id="lm-signup" class="lm-ui-form">'."\n";
    	$html_out .= $this->ci->tb_form->form_signup_terms('')."\n";
        $html_out .= "\t\t".'<p class="lm-form-bottom-signup center">'.$this->ci->lang->line('signup_login').'<a title="'.$this->ci->lang->line('link_login_title').'">'.$this->ci->lang->line('link_login_title').'</a></p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    }   
    
    function build_navbar_passwordreset()
    {	
        $html_out  = "\t".'<div id="lm-passwordreset" class="lm-ui-form">'."\n";
        // loop through the $form array() and build the parent menus.
		$html_out .= $this->ci->tb_form->form_passwordreset()."\n";
        $html_out .= "\t\t".'<p class="lm-link-tab center">'.$this->ci->lang->line('signup_login').'<a title="'.$this->ci->lang->line('link_login_title').'">'.$this->ci->lang->line('link_login_title').'</a></p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    }
    function build_form_login()
    {	
        // loop through the $form array() and build the parent menus.
        $html_out  = "\t".'<div class="lm-form-login">'."\n";
        $html_out .= $this->ci->tb_form->form_login()."\n";
        $html_out .= "\t\t".'<p class="lm-auth-p">'.$this->ci->lang->line('login_signup').''.anchor('', $this->ci->lang->line('link_signup_title'), array('class' => 'lm-button-auth-tabsignup')).'</p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";
        return $html_out;
    }  
    function build_form_passwordreset()
    {	
        // loop through the $form array() and build the parent menus.
        $html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
		$html_out .= "\t\t".'<div class="lm-offset-auth lm-form-passwordreset">'."\n";
        $html_out .= $this->ci->tb_form->form_passwordreset()."\n";
        $html_out .= "\t\t".'<p class="lm-auth-p">'.$this->ci->lang->line('signup_login').''.anchor('auth', $this->ci->lang->line('link_login_title')).'</p>'. "\n";
        $html_out .= "\t".'</div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }   
    
    //Auth
    
    function build_form_auth()
    {	    
        // now we will build the dynamic menus.
        $html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
        $html_out .= "\t\t".'<div class="lm-offset-auth">'."\n";

        // loop through the $form array() and build the parent menus.
           if (!$this->login)    // are we allowed to see this menu?
                {
                   
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
	               $html_out .= $this->build_form_signup_terms()."\n";
	               $html_out .= $this->build_form_login()."\n";
	               
	            }
                    

                    // loop through and build all the child submenus.

        $html_out .= "\t\t".'</div>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    }  
    
    function build_form_signup_terms()
    {	
     	$html_out  = "\t".'<div class="lm-form-signup lm-is-visible" >'."\n";
    	$html_out .= $this->ci->tb_form->form_signup_terms()."\n";
        $html_out .= "\t\t".'<p class="lm-form-bottom-signup center">'.$this->ci->lang->line('signup_tems_login').''.anchor('', $this->ci->lang->line('login_heading'), array('class' => 'lm-button-auth-tablogin','id'=>'lm-button-auth-login')).'</p>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";

        return $html_out;
    } 
        
    function build_form_activation_resetpassword()
    {	
    	$this->form_activation_resetpassword = array(
    	'class' => 'lm-form lm-form-auth',
    	'id' => 'lm-form-resetpassword');
    	
		$this->input_code = array(
		'class' => 'lm-ui-resetpassword-code lm-input-modal', 
		'id' => 'lm-ui-matching',
		'type' => 'text',
		'name' => 'code',
		'value' => $this->ci->input->get('activation'),
		'placeholder' => $this->ci->lang->line('verification_code_placeholder'));

		$this->input_password = array(
		'class' => 'lm-ui-resetpassword-password lm-input-modal', 
		'id' => 'lm-ui-auth-password',
		'type' => 'password',
		'name' => 'password',
		'placeholder' => $this->ci->lang->line('password_placeholder'));
		
		$this->input_cpassword = array(
		'class' => 'lm-ui-resetpassword-cpassword lm-input-modal', 
		'id' => 'lm-ui-auth-cpassword',
		'type' => 'password',
		'name' => 'cpassword',
		'placeholder' => $this->ci->lang->line('confirm_password_placeholder'));
			

		$this->input_submit = array('id' => 'lm-ui-resetpassword-submit');
		
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_code = array('class' => 'lm-label-icon lm-icon-code');
		$this->lm_icon_password = array('class' => 'lm-label-icon lm-icon-password');
		$this->email = $this->ci->input->get('e-mail');
				

        // loop through the $form array() and build the parent menus.

                $html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
				$html_out .= "\t\t".'<div class="lm-offset-auth fade out">'."\n";
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= form_open('', $this->form_activation_resetpassword)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= '<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-resetpassword">
								<p class="lm-form-message">'.$this->ci->lang->line('signup_subheading').''.$this->email.'</p></div>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-matching',$this->lm_icon_code)."\n";
                        $html_out .= form_input($this->input_code)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-code"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                       
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-auth-password',$this->lm_icon_password)."\n";
                        $html_out .= form_input($this->input_password)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-password"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_password_strength()."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-auth-cpassword',$this->lm_icon_password)."\n";
                        $html_out .= form_input($this->input_cpassword)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-cpassword"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('activation_resetpassword_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
						$html_out .= "\t\t".form_close()."\n";
        
        $html_out .= "\t\t".'<p class="lm-auth-p">'.$this->ci->lang->line('activation_resetpassword_resend_code').''.anchor('javascript:void(0)', $this->ci->lang->line('resend_code'), array('id' => 'lm-ui-resendemail-resetpassword','onclick' => 'return reSeMail();','target'=>'_blank')).'</a></p>'. "\n";
        $html_out .= "\t".'</div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }
    
    function build_form_activation()
    {	
    	$this->form_activation = array(
    	'class' => 'lm-form lm-form-auth lm-form-activation',
    	'id' => 'lm-form-activation');
    	
		$this->input_code = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-activation-code',
		'type' => 'text',
		'name' => 'code',
		'placeholder' => $this->ci->lang->line('verification_code_placeholder'));
		

		$this->input_submit = array('id' => 'lm-ui-activation-submit');
		
		$this->fieldset = array('class' => 'fieldset');
		$this->lm_icon_code = array('class' => 'lm-label-icon lm-icon-code');
				

        // loop through the $form array() and build the parent menus.

                $html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
				$html_out .= "\t\t".'<div class="lm-offset-auth fade out">'."\n";
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= form_open('', $this->form_activation)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= '<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-activation">
								<p class="lm-form-message">'.$this->ci->lang->line('activation_signup_subheading').''.$this->signup['email'].'</p></div>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_label('','lm-ui-activation-code',$this->lm_icon_code)."\n";
                        $html_out .= form_input($this->input_code);
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-code"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('activation_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
						$html_out .= "\t\t".form_close()."\n";
        
        $html_out .= "\t\t".'<p class="lm-auth-p">'.$this->ci->lang->line('activation_signup_resend_code').''.anchor('javascript:void(0)', $this->ci->lang->line('resend_code'), array('id' => 'lm-ui-resendemail-signup','onclick' => 'return reSeMail();','target'=>'_blank')).'</a></p>'. "\n";
        $html_out .= "\t".'</div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    } 
    
    function build_form_signup()
    {	
    	$this->form_activation = array(
    	'class' => 'lm-form lm-form-auth',
    	'id' => 'lm-form-signup-post');
    	
		$this->input_firstname = array(
		'class' => 'lm-ui-signup-firstname lm-input-modal', 
		'id' => 'lm-ui-matching',
		'type' => 'text',
		'name' => 'firstname',
		'placeholder' => $this->ci->lang->line('firstname_placeholder'));
		
		$this->input_lastname = array(
		'class' => 'lm-ui-signup-lastname lm-input-modal', 
		'id' => 'lm-ui-signup-lastname',
		'type' => 'text',
		'name' => 'lastname',
		'placeholder' => $this->ci->lang->line('lastname_placeholder'));
		
		$this->input_password = array(
		'class' => 'lm-ui-signup-password lm-input-modal', 
		'id' => 'lm-ui-auth-password',
		'type' => 'password',
		'name' => 'password',
		'placeholder' => $this->ci->lang->line('password_placeholder'));
		
		$this->input_cpassword = array(
		'class' => 'lm-ui-signup-cpassword lm-input-modal', 
		'id' => 'lm-ui-auth-cpassword',
		'type' => 'password',
		'name' => 'cpassword',
		'placeholder' => $this->ci->lang->line('confirm_password_placeholder'));
			

		$this->input_submit = array('id' => 'lm-ui-signup-submit');
		
		$this->fieldset = array('class' => 'fieldset');
				

        // loop through the $form array() and build the parent menus.

                $html_out  = "\t".'<div class="lm-user-modal-container lm-ui-auth fade out">'."\n";
				$html_out .= "\t\t".'<div class="lm-offset-auth fade out">'."\n";
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= form_open('', $this->form_activation)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= '<div class="lm-warning-auth lm-text-danger" id="lm-text-danger-signup">
								<p class="lm-form-message">'.$this->ci->lang->line('signup_subheading').''.$this->signup['email'].'</p></div>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_firstname)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-firstname"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_lastname)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-lastname"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                       
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_password)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-password"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_password_strength()."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_cpassword)."\n";
                        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-cpassword"></span>'."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_select('tb_lvc_users', 'lm-ui-level', 5327010, 'level', 'level')."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_select('tb_lvc_countries', 'lm-ui-country', 5327010, 'country', 'country')."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_submit('',$this->ci->lang->line('signup_btn'),$this->input_submit)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
						$html_out .= "\t\t".form_close()."\n";
        
        $html_out .= "\t".'</div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }   
    function build_password_strength()
    {	
    	$html_out  = "\t".'<div id="lm-passwordstrength" title="Strength"><div id="lm-passwordbar"></div></div>';
	    $html_out .= "\t\t".'<div class="left-bartxt">'."\n";
        $html_out .= "\t".'<div id="lm-strengthbar"><p>Password Strength:</p></div>'."\n";
         $html_out .= "\t".'<div id="lm-passwordstrength-text"></div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }
   function build_navbar_newsletter()
    {	
    	$html_out = null;
    	$this->ci->lang->load('validation_lang');
    	if (!$this->login)    // are we allowed to see this menu?
         {
    	$html_out  = '<div class="lm-ui-subform">'."\n";
        $html_out .= "\t\t".'<div class="lm-subform-modal-container" style="background:#fff;">'."\n";
		$html_out .= "\t\t".'<p class="lm-heading">'.$this->ci->lang->line('newsletter_heading').'</p>'."\n";

        // loop through the $form array() and build the parent menus.
           
                   
                $html_out .= "\t".'<div id="lm-newsletter" class="lm-ui-form">'."\n";
		        $html_out .= $this->ci->tb_form->form_newsletter()."\n";
		        $html_out .= "\t\t".'</div>'. "\n";
                    
        $html_out .= "\t\t".'<a class="lm-icon lm-icon-close">'.$this->ci->lang->line('close_auth').'</a>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";
        $html_out .= "\t\t".'</div>'. "\n";   
        }   
        return $html_out;
    }  
    
    
    //contact
    
    function build_form_contact()
    {	
    
    	$this->messages = $this->ci->session->flashdata('sent');
    	
    	$this->form_contact = array(
    	'class' => 'lm-form',
    	'id' => 'lm-form-contact',
    	'method' => 'POST',
    	'autocomplete' => 'off',
    	'name' => 'lm-form-contact',
    	);
    	
		$this->input_firstname = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-firstname',
		'type' => 'text',
		'name' => 'firstname',
		'placeholder' => $this->ci->lang->line('firstname_placeholder'));
		
		$this->input_lastname = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-lastname',
		'type' => 'text',
		'name' => 'lastname',
		'placeholder' => $this->ci->lang->line('lastname_placeholder'));
		
		$this->input_phonenumber = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-phonenumber',
		'type' => 'tel',
		'name' => 'phonenumber',
		'placeholder' => $this->ci->lang->line('phonenumber_placeholder'));
		
		$this->input_email = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		
		$this->input_message = array(
		'class' => 'lm-textarea-modal lm-input-required', 
		'id' => 'lm-ui-message',
		'name' => 'message',
		'rows'        => '3',
		'placeholder' => $this->ci->lang->line('message_placeholder'));
			

		$this->input_button = array('id' => 'lm-ui-contact-submit',' class'=>'lm-input-modal');
		
		$this->fieldset = array('class' => 'fieldset');
				

        // loop through the $form array() and build the parent menus.

				$html_out = "\t\t".'<div class="lm-validate-form fade out">'."\n";
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= form_open('api/contact', $this->form_contact)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->ci->auth_libraries->set_form_message_errors($this->messages['warning'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_firstname)."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['firstname'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_lastname)."\n";
                        $html_out .= form_fieldset_close()."\n";
                       
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_select('tb_lvc_subject', 'lm-ui-subject', 5327010, 'subject', 'subject')."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['subject'])."\n";
                        $html_out .= form_fieldset_close()."\n";
						
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_email)."\n";
                        $html_out .= "\t".'<span class="lm-eg-span">e.g.: name@example.com</span>'."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['email'])."\n";
                        $html_out .= form_fieldset_close()."\n";
						
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_phonenumber)."\n";
                        $html_out .= "\t".'<span class="lm-eg-span">e.g.: +6283897263653</span>'."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['phonenumber'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                                                
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_textarea($this->input_message)."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['message'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_button('',$this->ci->lang->line('contact_submit_btn'),$this->input_button)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= "\t\t".'<script src="https://www.google.com/recaptcha/api.js" async defer></script>'."\n";
                        $html_out .= $this->build_recaptcha()."\n";
						$html_out .= "\t\t".form_close()."\n";
        
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }   
    
    function build_form_applicant()
    {	
    
    	$this->messages = $this->ci->session->flashdata('sent');
    	
    	$this->form_applicant = array(
    	'class' => 'lm-form',
    	'id' => 'lm-form-job',
    	'method' => 'POST',
    	'autocomplete' => 'off',
    	'name' => 'lm-form-job',
    	);
    	
		$this->input_firstname = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-firstname',
		'type' => 'text',
		'name' => 'firstname',
		'placeholder' => $this->ci->lang->line('firstname_placeholder'));
		
		$this->input_lastname = array(
		'class' => 'lm-input-modal', 
		'id' => 'lm-ui-lastname',
		'type' => 'text',
		'name' => 'lastname',
		'placeholder' => $this->ci->lang->line('lastname_placeholder'));
		
		$this->input_phonenumber = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-phonenumber',
		'type' => 'tel',
		'name' => 'phonenumber',
		'placeholder' => $this->ci->lang->line('phonenumber_placeholder'));
		
		$this->input_email = array(
		'class' => 'lm-input-modal lm-input-required', 
		'id' => 'lm-ui-email',
		'type' => 'email',
		'name' => 'email',
		'placeholder' => $this->ci->lang->line('email_placeholder'));
		
		$this->input_message = array(
		'class' => 'lm-textarea-modal lm-input-required', 
		'id' => 'lm-ui-answer',
		'name' => 'answer',
		'rows'        => '3',
		'placeholder' => $this->ci->lang->line('message_placeholder'));
			

		$this->input_button = array('id' => 'lm-ui-join-submit',' class'=>'lm-input-modal');
		
		$this->fieldset = array('class' => 'fieldset');
				

        // loop through the $form array() and build the parent menus.

				$html_out = "\t\t".'<div class="lm-validate-form fade out">'."\n";
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= form_open_multipart('api/contact/job', $this->form_applicant)."\n";
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->ci->auth_libraries->set_form_message_errors($this->messages['warning'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_firstname)."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['firstname'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_lastname)."\n";
                        $html_out .= form_fieldset_close();
                       
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_select('tb_lvc_jobs', 'lm-ui-department', 5327010, 'department', 'department')."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['subject'])."\n";
                        $html_out .= form_fieldset_close()."\n";
						
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_email)."\n";
                        $html_out .= '<span class="lm-eg-span">e.g.: name@example.com</span>'."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['email'])."\n";
                        $html_out .= form_fieldset_close()."\n";
						
						$html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_input($this->input_phonenumber)."\n";
                        $html_out .= '<span class="lm-eg-span">e.g.: +6283897263653</span>'."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['phonenumber'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                                                
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_file(0,'lm-ui-resume',$this->ci->lang->line('attach_resume_cv'))."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['resume'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= $this->build_input_file(1,'lm-ui-cover-letter',$this->ci->lang->line('attach_cover_letter'))."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_textarea($this->input_message)."\n";
                        $html_out .= $this->ci->auth_libraries->set_message_errors($this->messages['answer'])."\n";
                        $html_out .= form_fieldset_close()."\n";
                        
                        $html_out .= form_fieldset('', $this->fieldset)."\n";
                        $html_out .= form_button('',$this->ci->lang->line('contact_submit_btn'),$this->input_button)."\n";
                        $html_out .= form_fieldset_close()."\n";
                        $html_out .= "\t\t".'<script src="https://www.google.com/recaptcha/api.js" async defer></script>'."\n";
                        $html_out .= $this->build_recaptcha()."\n";
						$html_out .= "\t\t".form_close()."\n";
        
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }   
    
    function build_input_file($array,$id,$title)
    {	
    	$this->input_upload = array(
		'class' => 'lm-ui-file lm-ui-upload', 
		'id' => $id,
		'type' => 'file',
		'name' => 'ufile['.$array.']',
		'data-multiple-caption' => '{count} files selected',
		'placeholder' => $title);
		
    	$this->lm_icon_upload = array('class' => 'lm-label-icon lm-icon-upload');
    	$html_out  = form_label('',$id,$this->lm_icon_upload);
    	$html_out .= form_input($this->input_upload).'<label for="'.$id.'" class="lm-label-file"><span>'.$title.'</span></label>'."\n";
    	$html_out .= "\t\t".'<span class="lm-eg-span">e.g.: file.pdf/doc/png/jpeg</span>'."\n";
        return $html_out;
    }
    
    function build_recaptcha()
    {	
    	$html_out  = "\t\t".'<div id="recaptcha" class="g-recaptcha"
    							 data-sitekey="'.$this->recaptcha.'"
    							 data-callback="onSubmit"
    							 data-size="invisible"></div>'."\n";
        return $html_out;
    }
    
    function build_input_select($table, $_id, $_dyn_group_id, $_name, $_title)
    {
    	$ci =& get_instance();
        $form_select = array();
		$results = $this->ci->object_model->get_object_select($table);
		$this->lm_icon = array('class' => 'lm-label-icon lm-icon-arrow-down');
        $html_out  = form_label('select',$_id,$this->lm_icon);
        $html_out .= "\t".'<select aria-required="true" aria-label="'.$_title.'" id="'.$_id.'" name="'.$_name.'" class="lm-multiselect">'."\n";

		$html_out .= "\t".'<option class="subject lm-option-disable" disabled="disabled" selected="selected">Select '.$_title.'</option>'."\n";

        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$show = $row->show;
			$dyn_group_id = $row->dyn_group_id;
			$id = $row->id;
			$name = $row->name;
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t".'<option class="subject" value="'.strtoupper($id).'">'.ucfirst($name).'</option>'."\n";
                    $html_out .= "\n";
            }
            
        }

        $html_out .= "\t".'</select>'."\n";
        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-'.$_title.'"></span>'."\n";

        return $html_out;
    }  
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  