<?php  /* Template Name: FeaturedCrackerPost */ ?>
<?php 
  /* used for the alphabetical listing include */
  $category = 6;
?>
<?php get_header(); ?>

<?php $megamag_options_post = get_option('megamag_options_post') ?>
		
		<div id="main" class="container">
		
			<div id="content">
			<!-- get featured cracker post (CUSTOM KEVIN H.)-->			
			<?php
			global $more;
			$more = 0;
			query_posts('cat=29'); 
				if(have_posts()) : while(have_posts()) : the_post();
			?>
			<h1 class="blog-heading">Featured Cracker Post</h1>
			
			<div class="blog-item" id="column1-wrap">	
				<div class="archive-text" style="padding-bottom:5px;" >
					<a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail($page->ID, 'medium'); ?>
					</a>
				</div>
			</div>
				<div id="column2" class="blog-item">
				
				<?php					
					$key = "definition";
					$thumb = get_post_meta(get_the_ID(), $key, true);
					if ($thumb)
					{
						echo "<strong>Definition</strong>";
						echo "<div>" . $thumb . "</div><div>&nbsp;</div>";
					}
				?>
				
				<p><br><a href="<?php the_permalink(); ?>" class="readmore">Read More</a></p>
				</div>
			<?php		
			endwhile;
			endif;
			wp_reset_query();
			?>
			<!-- END get featured cracker post (CUSTOM KEVIN H.)-->	

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
		
				<!---NEW alpha listing include 02/24 KJH-->
				<?php include('AlphaListingInclude.php'); ?>
			
			</div>
			<!-- END CONTENT -->


<?php get_sidebar(); ?>			

<?php get_footer(); ?>	
			
				

