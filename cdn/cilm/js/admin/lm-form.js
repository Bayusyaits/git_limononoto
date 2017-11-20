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
            	load_update = $lm_form("#lm-update-datauser");
           jQuery.ajax({
				url:val_url+'load/manage',
				method:'POST',
				data:{id:id},
				cache:false,
				success:function(data){
				load_update.html(data).each(function(){
				
				$lm_form("#lm-ui-update-submit").click(function(event) {
				var firstname = $lm_form("#lm-ui-firstname").val().replace(/<|>/g, "");
                 var formData = {
				'firstname' 	: $lm_form('input[name=firstname]').val().replace(/<|>/g, ""),
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
					 alert(data.message);			
				 } else {
		
		            // ALL GOOD! just show the success message!
							
					          alert(data.message);
							
						
		        }
                
                
                    })
                    
            .fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});
                        
						});
						
						$lm_form("#lm-ui-delete-submit").click(function(event) {
						  alert("delete");
						});
						
					 	});
					}
					});
					
                    });   
               
  
return false; //not to post the  form physically
            });
            
        
		 })(jQuery);
		//]]>