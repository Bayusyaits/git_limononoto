<footer id="lm-main-footer" class="lm-footer lm-footer-auth fade out">
<div class="lm-module-container lm-ui-auth">
<?php echo $this->menu_footer; ?>		
</div>
</footer>
</div><!-- End of Tag lm-wrapper -->
<!-- Javascript -->	
<script type="text/javascript">
!function(e,t,a,n,c,s,o){e.GoogleAnalyticsObject=c,e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new Date,s=t.createElement(a),o=t.getElementsByTagName(a)[0],s.async=1,s.src=n,o.parentNode.insertBefore(s,o)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-75631737-1","auto"),ga("send","pageview");
/*onload script*/function loadScript(e,t){var a=document.createElement("script");a.type="text/javascript",a.readyState?a.onreadystatechange=function(){("loaded"==a.readyState||"complete"==a.readyState)&&(a.onreadystatechange=null,t())}:a.onload=function(){t()},a.src=e,document.getElementsByTagName("footer")[0].appendChild(a)}
</script>
<?php echo $this->js; 
if(is_array($this->javascript) && $this->javascript != null){foreach ($this->javascript as $files) { ?>
     <script async="async" type="text/javascript" src="<?php echo $files['src']; ?>"></script>
<?php }} ?>
</body>
</html>


