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
    $lm_form(".lm-manage-modal").click(function(event) {
            event.preventDefault();
            var id = $lm_form(this).attr("data-user"),
            	load_update = $lm_form("#lm-update-datauser"),
            	manage_wrapper = $lm_form(".lm-manage-wrapper"),
            	loadurl = val_url+"admin/manage";
            var z=jQuery.noConflict();
            
           jQuery.ajax({
				url:val_url+'load/manage',
				method:'POST',
				data:{id:id},
				cache:false,
				success:function(data){
				load_update.html(data).each(function(){
				z(document).ready(function(){z(".lm-multiselect").val(),
				z(".lm-multiselect").multiselect({onChange:function(e,s){}})});
				$lm_form("#lm-ui-update-submit").click(function(event) {
				var firstname = $lm_form("#lm-ui-firstname").val().replace(/<|>/g, ""),
	            	id = $lm_form("#lm-ui-id").val().replace(/<|>/g, ""),
	            	lastname = $lm_form("#lm-ui-lastname").val().replace(/<|>/g, ""),
					email = $lm_form("#lm-ui-email").val().replace(/<|>/g, ""),
					activation = $lm_form("#lm-ui-activation-user"),
					level = $lm_form("#lm-ui-level"),
					country = $lm_form("#lm-ui-country");
                var formModal = $lm_form('.lm-form-admin'),
					formmanage = formModal.find('#lm-form-manage'),
					formmanageSelectLevel = formmanage.find('#lm-ui-level'),
					formmanageSelectCountry = formmanage.find('#lm-ui-country'),
					formmanageSelectActivation = formmanage.find('#lm-ui-activation-user'),
					lm_text_danger = formmanage.find("#lm-text-danger-manage"),
                    lm_error_message_id = formmanage.find("#is-hidden-id"),
                    lm_error_message_email = formmanage.find("#is-hidden-email"),
                    lm_error_message_firstname = formmanage.find("#is-hidden-firstname"),
                    lm_error_message_lastname = formmanage.find("#is-hidden-lastname"),
                    lm_error_message_levels = formmanage.find("#is-hidden-level"),
                    lm_error_message_country = formmanage.find("#is-hidden-country"),
                    lm_error_message_activation = formmanage.find("#is-hidden-activation"),
                    lm_error_submit = formmanage.find('input[type="submit"]');
                 var formData = {
                'id' 	: $lm_form('input[name=id]#lm-ui-id').val().replace(/<|>/g, ""),
				'firstname' 	: $lm_form('input[name=firstname]#lm-ui-firstname').val().replace(/<|>/g, ""),
				'lastname' 	: $lm_form('input[name=lastname]#lm-ui-lastname').val().replace(/<|>/g, ""),
				'email' 	: $lm_form('input[name=email]#lm-ui-email').val().replace(/<|>/g, ""),
				'level' : $lm_form('select[name=level]#lm-ui-level').val(),
				'country' : $lm_form('select[name=country]#lm-ui-country').val(),
				'activation_user' : $lm_form('select[name=activation_user]#lm-ui-activation-user').val()
				};
                
                jQuery.ajax({
            
            	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url			: val_url+"update/user",
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
					 lm_text_danger.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
				lm_error_submit.toggleClass('lm-error-button lm-animated');
				
			if (data.session){
				window.location.href= val_url+data.redirect;
				}
			
			if (data.id){
	            formmanage.find('input[type="text"]#lm-ui-id').toggleClass('has-error');
	            lm_error_message_id.html('<span class="lm-error-message is-visible">' + data.id + '</span>').fadeIn(1000);
            } else if (data.id){
               formmanage.find('input[type="text"]#lm-ui-id').toggleClass('has-error');
               lm_error_message_id.html('<span class="lm-error-message is-visible">' + data.id + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="text"]#lm-ui-id').removeClass('has-error');
			     lm_error_message_id.html('').fadeIn(1000);
            }//else email	
            
            if (data.email){
	            formmanage.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
	            lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formmanage.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="email"]#lm-ui-email').removeClass('has-error');
			     lm_error_message_email.html('').fadeIn(1000);
            }//else email	
            
            if (data.firstname){
	            formmanage.find('input[type="text"]#lm-ui-firstname').toggleClass('has-error');
	            lm_error_message_firstname.html('<span class="lm-error-message is-visible">' + data.firstname + '</span>').fadeIn(1000);
            } else if (data.firstname){
               formmanage.find('input[type="text"]#lm-ui-firstname').toggleClass('has-error');
               lm_error_message_firstname.html('<span class="lm-error-message is-visible">' + data.firstname + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="text"]#lm-ui-firstname').removeClass('has-error');
			     lm_error_message_firstname.html('').fadeIn(1000);
            }//else email
            
            if (data.lastname){
	            formmanage.find('input[type="text"]#lm-ui--lastname').toggleClass('has-error');
	            lm_error_message_lastname.html('<span class="lm-error-message is-visible">' + data.lastname + '</span>').fadeIn(1000);
            } else if (data.lastname){
               formmanage.find('input[type="text"]#lm-ui--lastname').toggleClass('has-error');
               lm_error_message_lastname.html('<span class="lm-error-message is-visible">' + data.lastname + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="text"]#lm-ui--lastname').removeClass('has-error');
			     lm_error_message_lastname.html('').fadeIn(1000);
            }//else email
                        
            // handle errors for password alias ---------------
			
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
	            formmanageSelectCountry.find('.btn').toggleClass('has-error');
	            lm_error_message_country.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else if (data.country){
               formmanageSelectCountry.find('.btn').toggleClass('has-error');
               lm_error_message_country.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else {
			     formmanageSelectCountry.find('.btn').removeClass('has-error');
			     lm_error_message_country.html('').fadeIn(1000);
            }//else level
			
			if (data.activation){
	            formmanageSelectActivation.find('.btn').toggleClass('has-error');
	            lm_error_message_activation.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else if (data.activation){
               formmanageSelectActivation.find('.btn').toggleClass('has-error');
               lm_error_message_activation.html('<span class="lm-error-message is-visible">' + data.country + '</span>').fadeIn(1000);
            } else {
			     formmanageSelectActivation.find('.btn').removeClass('has-error');
			     lm_error_message_activation.html('').fadeIn(1000);
            }//else level
					 		
				 } else {
		
		            // ALL GOOD! just show the success message!
		            update = '<a  href="#" class="lm-manage-link">';
					update += '<div class="lm-manage-id"><h5>'+data.id+'<h5></div>';
	                update += '<div class="lm-manage-email"><p>'+data.email+'</p></div>';
	                update += '</a>';
	                manage_wrapper.find('#'+data.id).html(update).fadeIn(1000);
				lm_text_danger.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);			
						
		        }
                
                
                    })
                    
            .fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
                        
						});
						
		$lm_form("#lm-ui-delete-submit").click(function(event) {
				var id = $lm_form("#lm-ui-id").val().replace(/<|>/g, ""),
					email = $lm_form("#lm-ui-email").val().replace(/<|>/g, ""),
					level = $lm_form("#lm-ui-level");
                var formModal = $lm_form('.lm-form-admin'),
					formmanage = formModal.find('#lm-form-manage'),
					formmanageSelectLevel = formmanage.find('#lm-ui-level'),
					lm_text_danger = formmanage.find("#lm-text-danger-manage"),
                    lm_error_message_id = formmanage.find("#is-hidden-id"),
                    lm_error_message_email = formmanage.find("#is-hidden-email"),
                    lm_error_message_levels = formmanage.find("#is-hidden-level"),
                    lm_error_submit = formmanage.find('input[type="submit"]');
                 var formData = {
				'id' 	: $lm_form('input[name=id]#lm-ui-id').val().replace(/<|>/g, ""),
				'email' 	: $lm_form('input[name=email]#lm-ui-email').val().replace(/<|>/g, ""),
				'level' : $lm_form('select[name=level]#lm-ui-level').val(),
				'activation_user' : $lm_form('select[name=activation_user]#lm-ui-activation-user').val()
				};
				
				jQuery.ajax({
            
            	type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url			: val_url+"delete/user",
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
					 lm_text_danger.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-danger">' + data.message + '</p></div>').fadeIn(1000);
				lm_error_submit.toggleClass('lm-error-button lm-animated');
				
			if (data.session){
				window.location.href= val_url+data.redirect;
				}
			
			if (data.id){
	            formmanage.find('input[type="text"]#lm-ui-id').toggleClass('has-error');
	            lm_error_message_id.html('<span class="lm-error-message is-visible">' + data.firstname + '</span>').fadeIn(1000);
            } else if (data.id){
               formmanage.find('input[type="text"]#lm-ui-id').toggleClass('has-error');
               lm_error_message_id.html('<span class="lm-error-message is-visible">' + data.id + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="text"]#lm-ui-id').removeClass('has-error');
			     lm_error_message_id.html('').fadeIn(1000);
            }//else email	
             if (data.email){
	            formmanage.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
	            lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else if (data.email){
               formmanage.find('input[type="email"]#lm-ui-email').toggleClass('has-error');
               lm_error_message_email.html('<span class="lm-error-message is-visible">' + data.email + '</span>').fadeIn(1000);
            } else {
			     formmanage.find('input[type="email"]#lm-ui-email').removeClass('has-error');
			     lm_error_message_email.html('').fadeIn(1000);
            }//else email
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
           
           
					 		
				 } else {
		
		            // ALL GOOD! just show the success message!
					// ALL GOOD! just show the success message!
					update = '';
					manage_wrapper.find('#'+data.id+'').html(update).fadeIn(1000);
					lm_text_danger.html('<div class="has-error lm-wrap-error"><p class="lm-form-message text-success">' + data.message + '</p></div>').fadeIn(1000);			
						
		        }
                
                
                    })
                    
            .fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
				
				
						});
				
			return false;
						
			});
			}
			});
			
                    });   
               
  
return false; //not to post the  form physically
            });
            
        
		 })(jQuery);
		//]]>