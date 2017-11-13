<main class="lm-main-auth">
<section class="lm-module-caption">
<div class="lm-container">
<div class="lm-medium-column lm-raised-coloumn">
<div class="lm-module-caption-center">
	<a href="<?php echo site_url('/');?>" class="lm-hd-a-navigation-auth lm-main-page" id="lm-hd-a-navigation" title="home"><span class="lm-primary-logo lm-main-logo lm-logo" id="lm-primary-logo"></span></a>
	<?php
    echo $this->tb_dyn_menu->build_menu_title();
	?>
	</div><!-- col-md-12 -->
</div><!-- container -->
</div>
</section>

<div class="lm-user-modal-container lm-ui-auth"> <!-- this is the container wrapper -->
<div class="lm-offset-auth fade out">
<?php 
	    $auth_signup_terms = array('class' => ' lm-form lm-form-auth', 'id' => 'lm-form-complete', 'role' => 'form', 'autocomplete' => 'off');
	    echo form_open('', $auth_signup_terms);?>
	    <p class="fieldset">
		    <div class="lm-warning lm-text-danger" id="lm-text-danger-complete">
				<p class="lm-form-message">Join in Limononoto, our monthly roundup</p>
		</div>
	    </p>
			<p class="fieldset">
			<label class="lm-label-icon lm-icon-code" for="lm-ui-complete-code">Verification Code</label>
            <input type="text" name="lm_ui_complete_phonenumber" id="lm-ui-complete-phonenumber" class="lm-input-modal" placeholder="phone number" onpaste="return false;"/>
            <span class="is-hidden" id="is-hidden-code"></span>
				</p>
			<p class="fieldset">
					<input type="submit" value="Submit" id="lm-ui-complete-submit"/>
			</p>
			<p class="fieldset">
			<p  class="lm-auth-p ">Need help?<a href="<?php site_url('contact')?>" title="Contact"> Please contact Twitter Support.</a></p>
			</p>
  <?php 
    // Form Close
    echo form_close(); ?>
     </div>
</div><!-- lm-banner-container -->
</main>
<!-- Main component for a primary marketing message or call to action -->    
