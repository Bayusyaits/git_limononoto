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
    document.getElementById("lm-form-job").submit();
  }
  function validate(event) {
    event.preventDefault();
    var formModalJoin = jQuery('.lm-validate-form'),
		formJoin = formModalJoin.find('#lm-form-job'),
		inputFile = formJoin.find('#lm-ui-resume'),
		lm_error_submit = formJoin.find('#lm-ui-join-submit');	
	var a=document.forms["lm-form-job"]["firstname"].value,
	    b=document.forms["lm-form-job"]["ufile[0]"].value,
	    c=document.forms["lm-form-job"]["phonenumber"].value,
	    d=document.forms["lm-form-job"]["answer"].value,
	    e=document.forms["lm-form-job"]["email"].value;
	    jQuery("textarea").prop('required',true);
	    jQuery("input[name=email]").prop('required',true);
	    jQuery("select").prop('required',true);
    if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="",e==null || e=="")
      {
      formJoin.find('.lm-input-required').toggleClass('has-error');
	  formJoin.find('.btn').toggleClass('has-error');
	  inputFile.next('label').toggleClass('has-error');
	   lm_error_submit.toggleClass('lm-error-button lm-animated');
      }else {
	      grecaptcha.execute();
	      lm_error_submit.attr('disabled', 'disabled');
	  }
    }
  function onload() {
    var element = document.getElementById('lm-ui-join-submit');
    element.onclick = validate;
  }
</script>
<script>onload();</script>
</div>