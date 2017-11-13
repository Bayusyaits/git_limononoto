<footer id="lm-main-footer" class="lm-footer">
<div class="lm-module-container">
<?php  echo $this->menu_footer; ?>
<p title="limononoto">&copy; <?php echo date('Y'); ?> Limono Noto. All Right Reserved</p>
</div>
</footer>
</div><!-- lm-page-body -->
</div><!-- lm-wrapper -->
<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-75631737-1', 'auto');
	  ga('send', 'pageview');
</script>
<?php
     foreach ($this->js as $file) { ?>
     <script type="text/javascript" src="<?php echo $file['src']; ?>"></script>
<?php } ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		<!-- Javascript -->	
<script type="text/javascript">
    // Ajax post
window.console.log = function(){
  //console.info('Sorry , developers tools are blocked here....');
  window.console.log = function() {
      return false;
  }
}            
</script>
</div>
</body>
</html>

