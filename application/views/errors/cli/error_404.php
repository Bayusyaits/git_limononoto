<div class="<?php echo 'lm-page-errors'?>">
<section class="lm-module-container lm-banner <?php echo 'lm-banner-errors';?>">
        <div class="lm-layout-drawer">
         <?php
    echo $this->tb_dyn_menu->build_menu_title();
	?>
        </div>
      </section>
<article class="lm-grid lm-module-container">
   <?php 
	$heading = "An Error Occured";
	$message = "We're sorry, but we can not complete the action you requested. A notification has been sent to our customer service team. Please try again later.";
	
	echo "\nERROR: ",
		$this->lang->line('err_not_found_heading'),
		"\n\n",
		$this->lang->line('err_not_found_message'),
		"\n\n";
   ?>
</article>