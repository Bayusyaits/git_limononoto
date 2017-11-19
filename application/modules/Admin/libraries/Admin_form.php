<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Admin_form {

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
        $this->ci->lang->load('auth_lang');    
		$this->ci->load->library(array('password','form_validation'));
		$this->ci->load->helper(array('authorization','language'));    
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
     
     
   function build_password_strength()
    {	
    	$html_out  = "\t".'<div id="lm-passwordstrength" title="Strength"><div id="lm-passwordbar"></div></div>';
	    $html_out .= "\t\t".'<div class="left-bartxt">'."\n";
        $html_out .= "\t".'<div id="lm-strengthbar"><p>Password Strength:</p></div>'."\n";
         $html_out .= "\t".'<div id="lm-passwordstrength-text"></div>'."\n";
        $html_out .= "\t".'</div>'."\n";
        return $html_out;
    }
    public function form_manage() {
    	$this->messages = $this->ci->session->flashdata('sent');
		$this->insert_button = array('id' => 'lm-ui-insert-submit',' class'=>'lm-input-modal');
	    $this->form_manage = array(
	    	'class' => 'lm-form',
	    	'id' => 'lm-form-manage',
	    	'method' => 'POST',
	    	'autocomplete' => 'off',
	    	'name' => 'lm-form-manage',
	    	);
	    $this->fieldset = array('class' => 'fieldset');
			$this->input_email = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-email',
			'type' => 'email',
			'name' => 'email',
			'placeholder' => $this->ci->lang->line('email_placeholder'));
			$this->input_firstname = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-matching',
			'type' => 'text',
			'name' => 'firstname',
			'placeholder' => $this->ci->lang->line('firstname_placeholder'));
			$this->input_lastname = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-lastname',
			'type' => 'text',
			'name' => 'lastname',
			'placeholder' => $this->ci->lang->line('lastname_placeholder'));
			$this->input_level = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-level',
			'type' => 'numeric',
			'name' => 'level',
			'placeholder' => $this->ci->lang->line('level_placeholder'));
			$this->input_password = array(
			'class' => 'lm-input-required lm-input-modal', 
			'id' => 'lm-ui-auth-password',
			'type' => 'password',
			'name' => 'password',
			'placeholder' => $this->ci->lang->line('password_placeholder'));
			
			$this->input_cpassword = array(
			'class' => 'lm-input-required lm-input-modal', 
			'id' => 'lm-ui-auth-cpassword',
			'type' => 'password',
			'name' => 'cpassword',
			'placeholder' => $this->ci->lang->line('confirm_password_placeholder'));
		$html_out = "\t\t".'<div class="lm-feed-base">'."\n";
		$html_out .= "\t\t".'<div class="lm-form-admin">'."\n";
	    $html_out .= form_open_multipart('api/insert/user', $this->form_manage)."\n";
	    
		$html_out .= "\t\t".'<div class="lm-col lm-col-1">'."\n";	
		$html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= $this->ci->admin_libraries->set_form_message_errors($this->messages['warning'])."\n";
        $html_out .= form_fieldset_close()."\n";
	
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_firstname)."\n";
		$html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['firstname'])."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_lastname)."\n";
		$html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['lastname'])."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_email)."\n";
		$html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['email'])."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_input($this->input_password)."\n";
        $html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['password'])."\n";
        $html_out .= "\t".'<span class="is-hidden" id="is-hidden-password"></span>'."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= $this->build_password_strength()."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= form_input($this->input_cpassword)."\n";
        $html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['cpassword'])."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= $this->build_input_levels('tb_lvc_users', 'lm-ui-level', 5327010, 'level', 'level')."\n";
        $html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['level'])."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
        $html_out .= $this->build_input_select('tb_lvc_countries', 'lm-ui-country', 5327010, 'country', 'country')."\n";
        $html_out .= $this->ci->admin_libraries->set_message_errors($this->messages['country'])."\n";
        $html_out .= form_fieldset_close()."\n";
        
		$html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_submit('submit',$this->ci->lang->line('insert_button'),$this->insert_button)."\n";
		$html_out .= form_fieldset_close()."\n";
		
		$html_out .= "\t\t".form_close()."\n";		
	    $html_out .= "\t".'</div>'."\n";
        return $html_out;
	} 
     
    public function build_form_manage($id) {
		$results = $this->ci->admin_model->select_user_id($id);
		$this->form_manage = array(
    	'class' => 'lm-form',
    	'id' => 'lm-form-manage',
    	'method' => 'POST',
    	'autocomplete' => 'off',
    	'name' => 'lm-form-manage',
    	);
		$this->update_button = array('id' => 'lm-ui-update-submit',' class'=>'lm-input-modal');
		$this->delete_button = array('id' => 'lm-ui-delete-submit',' class'=>'lm-input-modal');
		$html_out = "\t\t".'<div class="lm-feed-base">'."\n";
		$html_out .= "\t\t".'<div class="lm-form-admin">'."\n";
	    $html_out .= form_open_multipart('api/update/user', $this->form_manage)."\n";
	    $this->fieldset = array('class' => 'fieldset');
		 if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$id = decrypt_ciphertext($row->id);
			$email = decrypt_email($row->email);
			$firstname = decrypt_ciphertext($row->first_name);
			$lastname = decrypt_ciphertext($row->last_name);
			$level = decrypt_ciphertext($row->levels_id);
			$this->input_id = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-id',
			'type' => 'numeric',
			'name' => 'id',
			'value' => $id,
			'readonly' => TRUE,
			'placeholder' => $this->ci->lang->line('id_placeholder'));
			$this->input_email = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-email',
			'type' => 'email',
			'name' => 'email',
			'value' => $email,
			'placeholder' => $this->ci->lang->line('email_placeholder'));
			$this->input_firstname = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-firstname',
			'type' => 'text',
			'name' => 'firstname',
			'value' => $firstname,
			'placeholder' => $this->ci->lang->line('firstname_placeholder'));
			$this->input_lastname = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-lastname',
			'type' => 'text',
			'name' => 'lastname',
			'value' => $lastname,
			'placeholder' => $this->ci->lang->line('lastname_placeholder'));
			$this->input_level = array(
			'class' => 'lm-input-modal lm-input-required', 
			'id' => 'lm-ui-level',
			'type' => 'numeric',
			'name' => 'level',
			'value' => $level,
			'placeholder' => $this->ci->lang->line('level_placeholder'));
		$html_out .= "\t\t".'<div class="lm-col lm-col-1">'."\n";	
		$html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_id)."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_firstname)."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_lastname)."\n";
        $html_out .= form_fieldset_close()."\n";
        
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_email)."\n";
        $html_out .= form_fieldset_close()."\n";
        $html_out .= form_fieldset('', $this->fieldset)."\n";
		$html_out .= form_input($this->input_level)."\n";
		$html_out .= form_fieldset_close()."\n";
		$html_out .= "\t\t".'<div class="lm-col lm-col-2">'."\n";	
		$html_out .= form_submit('',$this->ci->lang->line('update_button'),$this->update_button)."\n";
		$html_out .= "\t".'</div>'."\n";
		$html_out .= "\t\t".'<div class="lm-col lm-col-2">'."\n";
		$html_out .= form_submit('',$this->ci->lang->line('delete_button'),$this->delete_button)."\n";
		$html_out .= "\t".'</div>'."\n";
		$html_out .= "\t".'</div>'."\n";	
			}
		}else{
			$html_out .= null;
		}
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
		$results = $this->ci->admin_model->get_object_select($table);
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
    
    function build_input_levels($table, $_id, $_dyn_group_id, $_name, $_title)
    {
    	$ci =& get_instance();
        $form_select = array();
		$results = $this->ci->admin_model->get_object_levels($table);
		$this->lm_icon = array('class' => 'lm-label-icon lm-icon-arrow-down');
        $html_out  = form_label('select',$_id,$this->lm_icon);
        $html_out .= "\t".'<select aria-required="true" aria-label="'.$_title.'" id="'.$_id.'" name="'.$_name.'" class="lm-multiselect">'."\n";

		$html_out .= "\t".'<option class="subject lm-option-disable" disabled="disabled" selected="selected">Select '.$_title.'</option>'."\n";

        if (is_array($results) || is_object($results))
		{
			foreach ($results as $row) {
			$show = decrypt_ciphertext($row->show);
			$dyn_group_id = $row->dyn_group_id;
			$id = $row->id;
			$name = decrypt_ciphertext($row->name);
			$substr = substr($id,0,4);
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
            $html_out .= "\t".'<option class="subject" value="'.strtoupper($id).'">'.ucfirst($name).'</option>'."\n";
                    
                    // loop through and build all the child submenus.

                    $html_out .= "\n";
            }
            
        }else{
	        $html_out .= '';
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