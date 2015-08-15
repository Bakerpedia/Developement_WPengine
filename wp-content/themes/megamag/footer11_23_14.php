<?php $megamag_options = get_option('megamag_options'); ?>
		
		</div>
		<!-- END MAIN -->
		
		<div id="footer">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 1st Area") ) : ?>  
	        <?php endif; ?>  

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 2nd Area") ) : ?>  
	        <?php endif; ?>  

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 3rd Area") ) : ?>  
	        <?php endif; ?>  


	        <div class="widget last">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 4th Area") ) : ?>  
		        <?php endif; ?>  
	        </div>

			
		</div>
		<!-- END FOOTER-WRAPPER -->
		
		<div id="footer-bottom">
				
			<p class="left"><?php echo $megamag_options['footer_text_left']; ?></p>
			<p class="right"><?php echo $megamag_options['footer_text_right']; ?></p>
				
		</div>
		<!-- END FOOTER-WRAPPER -->

	</div>
	<!-- END WRAPPER -->

	<div id="to_top"><img src="<?php echo get_template_directory_uri(); ?>/images/totop.png"></div>

	<?php if (!empty($megamag_options['google_analytics_code'])) mb_google_analytics($megamag_options['google_analytics_code']); ?>

 	<?php wp_footer(); ?>
	
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-39853201-1', 'bakerpedia.com');
	ga('send', 'pageview');
</script>
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>

</body>

</html>