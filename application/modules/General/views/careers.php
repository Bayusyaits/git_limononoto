<div class="<?php echo 'lm-page-'.uri_string();?>">
<section class="lm-module-container lm-banner <?php echo 'lm-banner-contact';?> fade out">
<div class="lm-layout-drawer">
<?php echo $this->menu_title; ?>
</div>
</section>

<!-- Main component for a primary marketing message or call to action -->
<article class="lm-grid content-canvas lm-canvas">
 <div class="lm-module-container"> 
 <div class="lm-container-fluid fade out">
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
