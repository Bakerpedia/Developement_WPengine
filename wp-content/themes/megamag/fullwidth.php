<?php

	/* Template Name: Full Width Page */

?>
<?php get_header(); ?>

<?php $megamag_options_post = get_option('megamag_options_post') ?>
		
		<div id="main" class="container">
		
			<div id="content" class="full">
			

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="post">

				<?php 

					if (isset($megamag_options_post['show_featured'])) {
						$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						if (get_the_post_thumbnail() != NULL) { 
							?>
							<img src="<?php printf($thumbnail_url[0]); ?>" width=610>
						<?php
						}
					}
				?>

					<h1 class="post-heading page"><?php the_title(); ?></h1>
					
					<div class="post-content">
						
						<?php the_content(); ?>
						
						
					</div>
					
					<?php 
						//if (isset($megamag_options_post['show_comments'])) {
						//	comments_template( '', true ); 
						//}
					?>
					
				</div>
				<!-- END POST -->

				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lcz_megamag'); ?></p>
				<?php endif; ?>	<!-- main post loop -->


			</div>
			<!-- END CONTENT -->		

<?php get_footer(); ?>