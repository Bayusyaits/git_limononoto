<div class="<?php echo 'lm-page-'.uri_string();?>">
<section class="lm-module-container lm-banner lm-banner-home fade out">
        <div class="lm-container">
         <?php
    echo $this->tb_dyn_menu->build_menu_title();
	?>
        </div>
      </section>
<article class="lm-grid lm-<?php echo uri_string();?>-modal lm-module-container">
 <div class="lm-container-fluid fade out"> 
 <div class="lm-modal-container">
	        <h1><?php echo uri_string();?></h1>
	        <p>
	        <?php 
		        $stored = '4524c6687163817e23397b0d20a43f7ba21fe575';
		        $storeds = 'passdsword';
				var_dump($this->session->sess_expiration);
				$this->load->library('user_agent');
				$browser = $this->agent->mobile();
				echo $browser;
								
		     ?>
	        </p>
	        This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
	        <p>To see the difference between static and fixed top navbars, just scroll.</p>
	        <p>
	          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a></p>
	</div>
	<div class="lm-modal-container box lm-scroll-inner">
	        <h1><?php echo uri_string();?></h1>
	        <p>
	        <?php 
		        echo '<pre>' . print_r($this->session->userdata, TRUE) . '</pre>';
		        
	        ?>
	        </p>
	        This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
	        <p>To see the difference between static and fixed top navbars, just scroll.</p>
	        <p>
	          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a></p>
	</div>
	<div class="lm-modal-container fade out">
	        <h1><?php echo uri_string();?></h1>
	        <p>
	        <?php 
		        echo '<pre>' . print_r($this->session->userdata, TRUE) . '</pre>';
		        
	        ?>
	        </p>
	        This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
	        <p>To see the difference between static and fixed top navbars, just scroll.</p>
	        <p>
	          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a></p>
	</div>
	</div>
</article>
</div><!-- Lm-Page -->
