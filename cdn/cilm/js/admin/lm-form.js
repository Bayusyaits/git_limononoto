 // Ajax post
 //<![CDATA[
		(function($) {
		var store = store || {};
    
	    /*
	     * Sets the jwt to the store object
	     */
	    store.setJWT = function(data){
	        this.JWT = data;
	    }
	var $lm_form = jQuery.noConflict();
    $lm_form(document).ready(function(e) {
     $lm_form(".lm-manage-modal").click(function(event) {
                    event.preventDefault();
                    var id = $lm_form(this).attr("data-user"),
                    	load_update = $lm_form("#lm-update-datauser");
                   jQuery.ajax({
						url:val_url+'load/manage',
						method:'POST',
						data:{id:id},
						cache:false,
						success:function(data){
						load_update.html(data).each(function(){
					 	});
					}
					});
                    });   
                $lm_form("#lm-ui-update-submit").click(function(event) {
                    event.preventDefault();
                    var email = $lm_form("#lm-ui-email").val().replace(/<|>/g, "");
                    var email_group = $lm_form("#email-group");
                    var lm_text_danger_update = $lm_form("#lm-text-danger");
                    
                    var formModal = $lm_form('.lm-ui-subform'),
						formupdate = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form"),
                    	lm_error_message_email = formMessage.find("#is-hidden-email"),
                    	lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'email' 			: $lm_form('input[name=email]#lm-ui-email').val().replace(/<|>/g, "")
		};
		// process the form
				   
                    jQuery.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"val/update",
						data 		: formData, // our data object
						dataType 	: 'json', // what type of data do we expect back from the server
						encode 		:  true,
	                    cache		:  false
	                                            
                        })
                        
                 .done(function(data) {
					 store.setJWT(data.JWT);
                // log data to the console so we can see
                console.log(data); 

                // here we will handle errors and validation messages
          if ( ! data.success) {
			
			lm_text_danger_update.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
			lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.email){
	            formupdate.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
				lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formupdate.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
			     formupdate.find('input[type="email"]#lm-ui-email').removeClass('has-error');
			     lm_error_message_email.html('').fadeIn(1000);
            }//else email

            
			 
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
			          window.location = val_url+data.redirect;
				}
			lm_error_submit.attr('disabled', 'disabled');
			
			lm_text_danger_update.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000); // add the actual error message under our input
			formupdate.find('input[type="text"]#lm-ui-password').removeClass('has-error');
			lm_error_message_email.html('').fadeIn(1000);
			lm_error_message_password.html('').fadeIn(1000);

        }
                
                
                    })
                    
                    // using the fail promise callback
			.fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
                    
                event.preventDefault();
	});

                $lm_form("#lm-ui-login-submit").click(function(event) {
                    event.preventDefault();
                    var email = $lm_form("#lm-ui-login-email").val().replace(/<|>/g, "");
                    var email_group = $lm_form("#email-group");
                    var lm_text_danger_login = $lm_form("#lm-text-danger-login");
                    var password_group = $lm_form("#password-group");
                    var password = $lm_form("#lm-ui-login-password").val().replace(/<|>/g, "");
                    
                    var formModal = $lm_form('.lm-ui-auth'),
						formLogin = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-login"),
                    	lm_error_message_email = formMessage.find("#is-hidden-login-email"),
                    	lm_error_message_password = formMessage.find("#is-hidden-password"),
                    	lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'email' 			: $lm_form('input[name=email]#lm-ui-login-email').val().replace(/<|>/g, ""),
			'password' 			: $lm_form('input[name=password]#lm-ui-login-password').val().replace(/<|>/g, "")
		};
		// process the form
		
                    jQuery.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/login",
						data 		: formData, // our data object
						dataType 	: 'json', // what type of data do we expect back from the server
						encode 		:  true,
	                    cache		:  false
	                                            
                        })
                        
                 .done(function(data) {
					 store.setJWT(data.JWT);
                // log data to the console so we can see
                console.log(data); 

                // here we will handle errors and validation messages
          if ( ! data.success) {
			
			lm_text_danger_login.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
			lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.email){
	            formLogin.find('input[type="email"]#lm-ui-login-email').toggleClass('has-error');
				lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formLogin.find('input[type="email"]#lm-ui-login-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
			     formLogin.find('input[type="email"]#lm-ui-login-email').removeClass('has-error');
			     lm_error_message_email.html('').fadeIn(1000);
            }//else email

            // handle errors for password alias ---------------
            
            if (data.password){
	            formLogin.find('#lm-ui-login-password').toggleClass('has-error'); // add the actual error message under our input
	            lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else if (data.password) {
               formLogin.find('input[type="text"]#lm-ui-login-password').toggleClass('has-error');
                lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else {
            	  formLogin.find('input[type="text"]#lm-ui-login-password').removeClass('has-error');
			      lm_error_message_password.html('').fadeIn(1000);
            }//else password
			 
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					//if (rememberme.is(":checked")) {
               
			   			//window.location = val_url+"home";
			        //}else{
				        //window.location = val_url+"dashboard";
			        //}
			        
			          window.location = val_url+data.redirect;
					
				}
			lm_error_submit.attr('disabled', 'disabled');
			lm_text_danger_login.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000); // add the actual error message under our input
			formLogin.find('input[type="text"]#lm-ui-login-password').removeClass('has-error');
			lm_error_message_email.html('').fadeIn(1000);
			lm_error_message_password.html('').fadeIn(1000);
            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
            //alert('success'); // for now we'll just alert the user

        }
                
                
                    })
                    
                    // using the fail promise callback
			.fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
                    
                event.preventDefault();
	});
	                $lm_form("#lm-ui-signup-submit").click(function(event) {
                event.preventDefault();
                var firstname = $lm_form("#lm-ui-matching").val().replace(/<|>/g, "");
                var lastname = $lm_form("#lm-ui-signup-lastname").val().replace(/<|>/g, "");
                var level = $lm_form("#lm-ui-level");
                var country = $lm_form("#lm-ui-country");
                var password_group = $lm_form("#password-group");
                var password = $lm_form("#lm-ui-auth-password").val().replace(/<|>/g, "");
                var cpassword = $lm_form("#lm-ui-auth-cpassword").val().replace(/<|>/g, "");
                
                var formModal = $lm_form('.lm-ui-auth'),
					formsignup = formModal.find('#lm-form-signup-post');
					formsignupSelectLevel = formsignup.find('#lm-ui-level');
					formsignupSelectCountry = formsignup.find('#lm-ui-country');
					lm_text_danger_signup = formsignup.find("#lm-text-danger-signup"),
                    lm_error_message_firstname = formsignup.find("#is-hidden-firstname"),
                    lm_error_message_lastname = formsignup.find("#is-hidden-lastname"),
                    lm_error_message_password = formsignup.find("#is-hidden-password"),
                    lm_error_message_cpassword = formsignup.find("#is-hidden-cpassword"),
                    lm_error_message_levels = formsignup.find("#is-hidden-level"),
                    lm_error_message_country = formsignup.find("#is-hidden-country"),
                    lm_error_submit = formsignup.find('input[type="submit"]');
                    
                var formData = {
        'country' : $lm_form('select[name=country]').val(),
		'level' : $lm_form('select[name=level]').val(), 
		'firstname' 	: $lm_form('input[name=firstname]').val().replace(/<|>/g, ""),
		'lastname' 	: $lm_form('input[name=lastname]').val().replace(/<|>/g, ""),    
		'password' 	: $lm_form('input[name=password]').val().replace(/<|>/g, ""),
		'cpassword' 	: $lm_form('input[name=cpassword]').val().replace(/<|>/g, "")
		};

		// process the form
		
		   
                    jQuery.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/signup/session",
						data 		: formData, // our data object
						dataType 	: 'json', // what type of data do we expect back from the server
						encode 		:  true,
						cache		:  false
                        
                        })
                        
                 .done(function(data) {

                // log data to the console so we can see
                console.log(data); 

                // here we will handle errors and validation messages
          if ( ! data.success) {
			  lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
				lm_error_submit.toggleClass('lm-error-button lm-animated');
				
			if (data.session){
	        	//window.alert(data.session)
				window.location.href= val_url+data.redirect;
				}
				
            if (data.firstname){
	            formsignup.find('input[type="text"]#lm-ui-matching').toggleClass('has-error');
	            lm_error_message_firstname.html('<span class="lm-error-message is-visible">' + data.firstname + '</span>').fadeIn(1000);
            } else if (data.firstname){
               formsignup.find('input[type="text"]#lm-ui-matching').toggleClass('has-error');
               lm_error_message_firstname.html('<span class="lm-error-message is-visible">' + data.firstname + '</span>').fadeIn(1000);
            } else {
			     formsignup.find('input[type="text"]#lm-ui-matching').removeClass('has-error');
			     lm_error_message_firstname.html('').fadeIn(1000);
            }//else email
            
            if (data.lastname){
	            formsignup.find('input[type="text"]#lm-ui-signup-lastname').toggleClass('has-error');
	            lm_error_message_lastname.html('<span class="lm-error-message is-visible">' + data.lastname + '</span>').fadeIn(1000);
            } else if (data.lastname){
               formsignup.find('input[type="text"]#lm-ui-signup-lastname').toggleClass('has-error');
               lm_error_message_lastname.html('<span class="lm-error-message is-visible">' + data.lastname + '</span>').fadeIn(1000);
            } else {
			     formsignup.find('input[type="text"]#lm-ui-signup-lastname').removeClass('has-error');
			     lm_error_message_lastname.html('').fadeIn(1000);
            }//else email
                        
            // handle errors for password alias ---------------
            
            if (data.password){
	            formsignup.find('input[type="password"]#lm-ui-auth-password').toggleClass('has-error'); 
	            lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else if (data.password) {
               formsignup.find('input[type="password"]#lm-ui-auth-password').toggleClass('has-error');
               lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else {
			     formsignup.find('input[type="password"]#lm-ui-auth-password').removeClass('has-error');
			     lm_error_message_password.html('').fadeIn(1000);
            }//else password
            
            if (data.cpassword){
	            formsignup.find('input[type="password"]#lm-ui-auth-cpassword').toggleClass('has-error');
	            lm_error_message_cpassword.html('<span class="lm-error-message is-visible">' + data.cpassword + '</span>').fadeIn(1000);
            } else if (data.cpassword){
	            formsignup.find('input[type="password"]#lm-ui-auth-cpassword').toggleClass('has-error');	            lm_error_message_cpassword.html('<span class="lm-error-message is-visible">' + data.cpassword + '</span>').fadeIn(1000);
            } else {
			     formsignup.find('input[type="password"]#lm-ui-auth-cpassword').removeClass('has-error');
			     lm_error_message_cpassword.html('').fadeIn(1000);
            }//else password
			
			if (data.level){
	            formModal.find('.btn').toggleClass('has-error');
	            lm_error_message_levels.html('<span class="lm-error-message is-visible">' + data.level + '</span>').fadeIn(1000);
            } else if (data.level){
               formModal.find('.btn').toggleClass('has-error');
               lm_error_message_levels.html('<span class="lm-error-message is-visible">' + data.level + '</span>').fadeIn(1000);
            } else {
			     formModal.find('.btn').removeClass('has-error');
			     lm_error_message_levels.html('').fadeIn(1000);
            }//else level
           
           
           if (data.country){
	            formsignupSelectCountry.find('.btn').toggleClass('has-error');
	            lm_error_message_country.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else if (data.country){
               formsignupSelectCountry.find('.btn').toggleClass('has-error');
               lm_error_message_country.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else {
			     formsignupSelectCountry.find('.btn').removeClass('has-error');
			     lm_error_message_country.html('').fadeIn(1000);
            }//else level
			
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					
			          window.location = val_url+data.redirect;
					
				}
				lm_error_submit.attr('disabled', 'disabled');
				lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
            //alert('success'); // for now we'll just alert the user

        }
                
                
                    })
                    
                    // using the fail promise callback
			.fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
                    
                event.preventDefault();
	});
return false; //not to post the  form physically
            });
            
        
		 })(jQuery);
		//]]>