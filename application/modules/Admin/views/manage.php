<div class="lm-page-dashboard">
<section class="lm-module-container lm-banner lm-banner-home fade out">
<div class="lm-container">
<?php
echo $this->menu_title;
?>
</div>
</section>
<main class="lm-inner lm-module-container">
<div class="lm-feed">
<div class="lm-create-user">
	<button class="lm-button-create" data-control-name="create.post" id="lm-create-user">Create User</button>
</div>
   <?php echo $this->levels; ?>
<div class="lm-datauser" id="lm-update-datauser">
<?php echo $this->insert; ?>
</div>
</div>
</main>
</div><!-- Lm-Page -->
