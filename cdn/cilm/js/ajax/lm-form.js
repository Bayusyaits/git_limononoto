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
	    var csfrData = {};
		csfrData[$lm_form(".lm-ui-csrf").attr("name")] 	= $lm_form(".lm-ui-csrf").attr("value")
		$lm_form.ajaxSetup({
			data: csfrData
			});
    $lm_form(document).ready(function(e) {
                $lm_form("#lm-ui-newsletter-submit").click(function(event) {
                    event.preventDefault();
                    var email = $lm_form("#lm-ui-newsletter-email").val().replace(/<|>/g, "");
                    var email_group = $lm_form("#email-group");
                    var lm_text_danger_newsletter = $lm_form("#lm-text-danger-newsletter");
                    
                    var formModal = $lm_form('.lm-ui-subform'),
						formnewsletter = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-newsletter"),
                    	lm_error_message_email = formMessage.find("#is-hidden-newsletter-email"),
                    	lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'email' 			: $lm_form('input[name=email]#lm-ui-newsletter-email').val().replace(/<|>/g, "")
		};
		// process the form
				   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"val/newsletter",
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
			
			lm_text_danger_newsletter.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
			lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.email){
	            formnewsletter.find('input[type="email"]#lm-ui-newsletter-email').toggleClass('has-error');
				lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formnewsletter.find('input[type="email"]#lm-ui-newsletter-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
			     formnewsletter.find('input[type="email"]#lm-ui-newsletter-email').removeClass('has-error');
			     lm_error_message_email.html('').fadeIn(1000);
            }//else email

            
			 
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
			          window.location = val_url+data.redirect;
				}
			lm_error_submit.attr('disabled', 'disabled');
			
			lm_text_danger_newsletter.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000); // add the actual error message under our input
			formnewsletter.find('input[type="text"]#lm-ui-newsletter-password').removeClass('has-error');
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
		
                    $lm_form.ajax({
                    
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
	
	$lm_form("#lm-ui-twofactor-submit").click(function(event) {
                    event.preventDefault();
                    var code = $lm_form("#lm-ui-twofactor-code").val().replace(/<|>/g, ""),
                    	birthday = $lm_form("#lm-ui-twofactor-birthday").val().replace(/<|>/g, "")
                    
                    var lm_text_danger_twofactor = $lm_form("#lm-text-danger-twofactor");
                    
                    
                    var formModal = $lm_form('.lm-ui-auth'),
						formtwofactor = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-twofactor"),
                    	lm_error_message_code = formMessage.find("#is-hidden-code");
                    	lm_error_message_birthday = formMessage.find("#is-hidden-birthday"),
						lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'code' : $lm_form('input[name=code]#lm-ui-twofactor-code').val().replace(/<|>/g, ""),
			'birthday' : $lm_form('input[name=birthday]#lm-ui-twofactor-birthday').val().replace(/<|>/g, "")
		};
				   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/twofactor",
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

            if (data.email){
	        	//window.alert(data.email)
				window.location.href= val_url+data.redirect_errors;
            }
				lm_text_danger_twofactor.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
				lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.code){
	            formtwofactor.find('input[type="text"]#lm-ui-twofactor-code').toggleClass('has-error');
	            lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else if (data.code){
               formtwofactor.find('input[type="text"]#lm-ui-twofactor-code').toggleClass('has-error');
               lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else {
			     formMessage.find('input[type="text"]#lm-ui-twofactor-code').removeClass('has-error');
            }//else code
			
			if (data.birthday){
	            formtwofactor.find('input[type="text"]#lm-ui-twofactor-birthday').toggleClass('has-error'); // add the actual error message under our input
	            lm_error_message_birthday.html('<span class="lm-error-message is-visible">' + data.birthday + '</span>').fadeIn(1000);
            } else if (data.birthday) {
               formtwofactor.find('input[type="text"]#lm-ui-twofactor-birthday').toggleClass('has-error');
               lm_error_message_birthday.html('<span class="lm-error-message is-visible">' + data.birthday + '</span>').fadeIn(1000);
            } else {
			     formtwofactor.find('input[type="text"]#lm-ui-twofactor-birthday').removeClass('has-error');
			     lm_error_message_birthday.html('').fadeIn(1000);
            }//else birthday
            
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					
			         window.location.href= val_url+data.redirect;
					
				}
			lm_error_submit.attr('disabled', 'disabled');
            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
             lm_text_danger_twofactor.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
             lm_error_message_code.html('').fadeIn(1000);

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
                $lm_form("#lm-ui-passwordreset-submit").click(function(event) {
                    event.preventDefault();
                    var email = $lm_form("#lm-ui-passwordreset-email").val().replace(/<|>/g, "");
                    var email_group = $lm_form("#email-group");
                    var lm_text_danger_password_reset = $lm_form("#lm-text-danger-passwordreset");
                    var formModal = $lm_form('.lm-ui-auth'),
						formpasswordreset = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-passwordreset"),
                    	lm_error_message_email = formMessage.find("#is-hidden-passwordreset-email"),
                    	lm_error_submit = formModal.find('input[type="submit"]');
                    
                 var formData = {
			'email' 			: $lm_form('input[name=email]#lm-ui-passwordreset-email').val().replace(/<|>/g, "")
		};

		// process the form
		
		   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/passwordreset",
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

			  lm_text_danger_password_reset.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
			  lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.email){
	            formpasswordreset.find('input[type="email"]#lm-ui-passwordreset-email').toggleClass('has-error');
	            lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formpasswordreset.find('input[type="email"]#lm-ui-passwordreset-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
                  formpasswordreset.find('input[type="email"]#lm-ui-passwordreset-email').removeClass('has-error');      		
			      lm_error_message_email.html('').fadeIn(1000);
            }//else email

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
			lm_text_danger_password_reset.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
		    formpasswordreset.find('input[type="email"]#lm-ui-passwordreset-email').removeClass('has-error');
		    lm_error_message_email.html('').fadeIn(1000);
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
                $lm_form("#lm-ui-resetpassword-submit").click(function(event) {
                    event.preventDefault();
                    var resetpassword_code = $lm_form(".lm-ui-resetpassword-code").val().replace(/<|>/g, ""),
                    	password = $lm_form(".lm-ui-resetpassword-password").val().replace(/<|>/g, ""),
						cpassword = $lm_form(".lm-ui-resetpassword-cpassword");
                    
                    var lm_text_danger_resetpassword = $lm_form("#lm-text-danger-resetpassword");
                    
                    
                    var formModal = $lm_form('.lm-ui-auth'),
						formresetpassword = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-resetpassword"),
                    	lm_error_message_code = formMessage.find("#is-hidden-code");
                    	lm_error_message_password = formMessage.find("#is-hidden-password"),
						lm_error_message_cpassword = formMessage.find("#is-hidden-cpassword"),
						lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'code' : $lm_form('input[name=code]#lm-ui-matching').val().replace(/<|>/g, ""),
			'password' : $lm_form('input[name=password]#lm-ui-auth-password').val().replace(/<|>/g, ""),
			'cpassword' : $lm_form('input[name=cpassword]#lm-ui-auth-cpassword').val().replace(/<|>/g, "")
		};

		// process the form
		
		   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/resetpassword",
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

            if (data.email){
	        	//window.alert(data.email)
				window.location.href= val_url+data.redirect_errors;
            }
				lm_text_danger_resetpassword.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
				lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.code){
	            formresetpassword.find('input[type="text"].lm-ui-resetpassword-code').toggleClass('has-error');
	            lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else if (data.code){
               formresetpassword.find('input[type="text"].lm-ui-resetpassword-code').toggleClass('has-error');
               lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else {
			     formresetpassword.find('input[type="text"].lm-ui-resetpassword-code').removeClass('has-error');
            }//else code
			
			if (data.password){
	            formresetpassword.find('input[type="password"].lm-ui-resetpassword-password').toggleClass('has-error'); // add the actual error message under our input
	            lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else if (data.password) {
               formresetpassword.find('input[type="password"].lm-ui-resetpassword-password').toggleClass('has-error');
               lm_error_message_password.html('<span class="lm-error-message is-visible">' + data.password + '</span>').fadeIn(1000);
            } else {
			     formresetpassword.find('input[type="password"].lm-ui-resetpassword-password').removeClass('has-error');
			     lm_error_message_password.html('').fadeIn(1000);
            }//else password
            
            if (data.cpassword){
	            formresetpassword.find('input[type="password"].lm-ui-resetpassword-cpassword').toggleClass('has-error'); // add the actual error message under our input
	            lm_error_message_cpassword.html('<span class="lm-error-message is-visible">' + data.cpassword + '</span>').fadeIn(1000);
            } else if (data.cpassword){
	            formresetpassword.find('input[type="password"].lm-ui-resetpassword-cpassword').toggleClass('has-error'); // add the actual error message under our input
	            lm_error_message_cpassword.html('<span class="lm-error-message is-visible">' + data.cpassword + '</span>').fadeIn(1000);
            } else {
			     formresetpassword.find('input[type="password"].lm-ui-resetpassword-cpassword').removeClass('has-error');
			     lm_error_message_cpassword.html('').fadeIn(1000);
            }//else password
			
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					
			         window.location.href= val_url+data.redirect;
					
				}
			lm_error_submit.attr('disabled', 'disabled');
            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
             lm_text_danger_resetpassword.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
             lm_error_message_code.html('').fadeIn(1000);

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
                $lm_form("#lm-ui-signup-terms-submit").click(function(event) {
                    event.preventDefault();
                    var email = $lm_form("#lm-ui-signup-terms-email").val().replace(/<|>/g, "");
                    var email_group = $lm_form("#email-group");
                    var lm_text_danger_signup = $lm_form("#lm-text-danger-signup-terms");
                    var formModal = $lm_form('.lm-ui-auth'),
						formsignupterms = formModal.find('.lm-form');
					var formMessage = $lm_form("#lm-form-signup"),
                    	lm_error_message_email = formMessage.find("#is-hidden-signup-email"),
                    	lm_error_submit = formMessage.find('input[type="submit"]');
                    
                 var formData = {
			'email' : $lm_form('input[name=email]#lm-ui-signup-terms-email').val().replace(/<|>/g, ""),
		};

		// process the form
		
		   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/signup",
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
            if (data.email){
	            formsignupterms.find('input[type="email"]#lm-ui-signup-terms-email').toggleClass('has-error');
	            lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.listed){
               formsignupterms.find('input[type="email"]#lm-ui-signup-terms-email').toggleClass('has-error');
                lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.listed + '</p></div>').fadeIn(1000);
            }else if (data.email){
               formsignupterms.find('input[type="email"]#lm-ui-signup-terms-email').toggleClass('has-error');
            } else {
			     formsignupterms.find('input[type="email"]#lm-ui-signup-terms-email').removeClass('has-error');
            }//else email
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					
			        
			          window.location = val_url+data.redirect;
					
				}
			lm_error_submit.attr('disabled', 'disabled');
            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
            //alert('success'); // for now we'll just alert the user
             lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
             lm_error_message_email.html('').fadeIn(1000);
             

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
	$lm_form("#lm-ui-resendemail-signup").click(function(event) {
	// process the form
	window.location = val_url+"api/signup";                    
	event.preventDefault();
	});
            
	$lm_form("#lm-ui-resendemail-resetpassword").click(function(event) {
	// process the form
	window.location = val_url+"api/passwordreset/resend";                    
	event.preventDefault();
	});
	
	$lm_form("#lm-ui-resendemail-twofactor").click(function(event) {
	// process the form
	window.location = val_url+"send-email/login";                    
	event.preventDefault();
	});
                $lm_form("#lm-ui-activation-submit").click(function(event) {
                    event.preventDefault();
                    var code = $lm_form("#lm-ui-activation-code").val().replace(/<|>/g, "");
                    var lm_text_danger_signup = $lm_form("#lm-text-danger-activation");
                    
                    var formModal = $lm_form('.lm-ui-auth'),
						formsignupactivation = formModal.find('.lm-form-activation');
                    	lm_error_message_code = formsignupactivation.find("#is-hidden-code"),
                    	lm_error_submit = formsignupactivation.find('input[type="submit"]');
                   
						var lm_ui_signup_code = document.getElementById("lm-ui-activation-code").value; 	
                    
                 var formData = {
			'code' : $lm_form('input[name=code]#lm-ui-activation-code').val().replace(/<|>/g, "")
		};

		// process the form
		
		   
                    $lm_form.ajax({
                    
                    	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url			: val_url+"auth/activation/signup",
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

            if (data.email){
	        	//window.alert(data.email)
				window.location.href= val_url+data.redirect_errors;
 
            }
            lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
            lm_error_submit.toggleClass('lm-error-button lm-animated');
            if (data.code){
	            formsignupactivation.find('input[type="text"]#lm-ui-activation-code').toggleClass('has-error');
	            lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else if (data.code){
               formsignupactivation.find('input[type="text"]#lm-ui-activation-code').toggleClass('has-error');
               lm_error_message_code.html('<span class="lm-error-message is-visible">' + data.code + '</span>').fadeIn(1000);
            } else {
			     formsignupactivation.find('input[type="text"]#lm-ui-activation-code').removeClass('has-error');
            }//else code
			
        } else {

            // ALL GOOD! just show the success message!
            if ( data.success) {
					
			          window.location.href= val_url+data.redirect;
					
				}
				lm_error_submit.attr('disabled', 'disabled');
             lm_text_danger_signup.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);
             lm_error_message_code.html('').fadeIn(1000);

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
		
		   
                    $lm_form.ajax({
                    
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