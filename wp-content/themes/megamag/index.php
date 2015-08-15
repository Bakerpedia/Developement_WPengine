<?php get_header(); ?>
<?php $megamag_options_hp = get_option('megamag_options_hp'); ?>

		<div id="main" class="container">

			<?php 
				if (isset($megamag_options_hp['slider_show']) && $megamag_options_hp['slider_style'] == 'fullwidth1') {
					include 'inc/template_slider_fullwidth1.php'; 
				}

				if (isset($megamag_options_hp['slider_show']) && $megamag_options_hp['slider_style'] == 'fullwidth2') {
					include 'inc/template_slider_fullwidth2.php'; 
				}

			?>
			
			
			
			<div id="content">
				<?php 
					if (isset($megamag_options_hp['slider_show']) && $megamag_options_hp['slider_style'] == 'compact') {
						include 'inc/template_slider_compact.php'; 
					}

					if ($megamag_options_hp['hp_style'] == 'blog') {
						include 'inc/template_blog.php';
					} else {
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Widget Area") ) :
						endif;
					}
				?>

			</div>
			<!-- END CONTENT -->


<?php get_sidebar(); ?>			

<?php get_footer(); ?>