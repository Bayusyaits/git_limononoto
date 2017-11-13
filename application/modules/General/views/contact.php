<div class="<?php echo 'lm-page-'.uri_string();?>">
<section class="lm-module-container lm-banner <?php echo 'lm-banner-contact';?> fade out">
<div class="lm-layout-drawer">
<?php echo $this->menu_title; ?>
</div>
</section>
<main class="lm-inner lm-module-container">
   <?php echo $this->form_validation;
    echo $this->contact_profile; ?>
</main>
</div><!-- Lm-Page -->

<script>
	function onSubmit(token) {
    //alert('Thanks ' + document.getElementById('lm-ui-firstname').value + ' ');
    document.getElementById("lm-form-contact").submit();
  }

  function validate(event) {
    event.preventDefault();
    var formModalContact = jQuery('.lm-validate-form'),
		formContact = formModalContact.find('#lm-form-contact'),	
		lm_error_submit = formContact.find('#lm-ui-contact-submit');
	var a=document.forms["lm-form-contact"]["firstname"].value,
	    b=document.forms["lm-form-contact"]["email"].value,
	    c=document.forms["lm-form-contact"]["phonenumber"].value,
	    d=document.forms["lm-form-contact"]["message"].value;
	    jQuery("textarea").prop('required',true);
	    jQuery("input[name=email]").prop('required',true);
	    jQuery("select").prop('required',true);
    if (a==null || a==="",b==null || b==="",c==null || c==="",d==null || d==="")
      {
      formContact.find('.lm-input-required').toggleClass('has-error');
	      formContact.find('.btn').toggleClass('has-error');
	      lm_error_submit.toggleClass('lm-error-button lm-animated');
      }else {
	      grecaptcha.execute();
	     }
    }
  function onload() {
    var element = document.getElementById('lm-ui-contact-submit');
    element.onclick = validate;
  }
</script>
<script>onload();</script>
</div>