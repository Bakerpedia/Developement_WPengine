<?php  /* Template Name: FeaturedLandingPagePost */ ?>
<?php  /* KJH Page created on 10/29/2014 - this page was created so that the owner could place specific posts on the landing page
		instead of the latest posts*/ ?>
<?php get_header(); ?>		
<?php $megamag_options_post = get_option('megamag_options_post') ?>	
		<div id="main" class="container">		
			<div id="content">
			<?php 
					
						include 'inc/template_slider_compact.php'; 
					
				?>
			<!-- get featured landing page post ID=52-->			
			<h1 class="blog-heading"><?php _e("Featured Post", "lcz_megamag"); ?></h1>
				<style>
				#opaqLogo{
					opacity:0.4;
					filter:alpha(opacity=40); /* For IE8 and earlier */
					padding-top:50px;
				}
				</style>
				
			<?php
			global $more;
			$more = 0;
			query_posts('cat=52'); 
				// if(have_posts()) : while(have_posts()) : the_post(); 
				while ( have_posts() ) : the_post(); 
			?>		
			
			<?php $result_cmb_excerpt = get_post_meta(get_the_ID(), 'cmb_excerpt', true);?>

					<div class="blog-item">
					
						<div class="item-image big">
						
						<?php 						
							if (has_post_thumbnail(get_the_ID())) { 
								printf("<a href='%s'>%s</a>", get_permalink(),get_the_post_thumbnail(get_the_ID(), 'archive_thumb'));
							} else { ?>
								<a href='<?php the_permalink(); ?>'><img id="opaqLogo" src="<?php echo get_template_directory_uri(); ?>/images/logo-300x57.png" alt="" width="270" /></a>
							<?php
							}

							if (get_post_meta(get_the_ID(), 'cmb_is_review',true) == 'checked') {
							?>
								<div class="item-score big">
									<span class="the-score"><?php echo get_post_meta(get_the_ID(), 'cmb_review_overall',true); ?></span>
									<span class="score-text"><?php _e('Score', 'lcz_megamag'); ?></span>
								</div>
							<?php	
							}
						?>
							
							<div class="item-icon <?php if (get_post_meta(get_the_ID(), 'cmb_is_review',true) != 'checked') {echo get_post_format(get_the_ID());} ?>"></div>
						
						</div>
						
						<div class="archive-text">						
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>					
						<!--	<ul class="post-meta archive"></ul>  -->
							<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt(get_the_content(), 148, true);} ?> <br><a href="<?php the_permalink(); ?>" class="readmore"><?php _e("Read More", "lcz_megamag"); ?></a></p>
						</div>
						
					</div>

				<?php// endwhile; else: ?>
				<?php endwhile; // end of the loop. ?>
				<?php //endif; ?>	<!-- main post loop -->		

				<?php 
					//wp_query is the gloabal var. If you put this in function remember to globalize var using: global $wp_query
					
					$total_pages = $wp_query->max_num_pages;
					if ($total_pages > 1) {
						$current_page = get_query_var('paged') ? get_query_var('paged') : 1;
						echo paginate_links(array(
							'base'         => add_query_arg('paged','%#%'),	//base url
							'format'       => '',							//replaces the %_% above
							'total'        => 1,					//total num pages
							'current'      => $current_page,				//current page
							'show_all'     => False,						//show all the pages available 
							'end_size'     => 1,							//how many pages at the ends
							'mid_size'     => 2,							//how many pages around the current page
							'prev_next'    => false,						//show prev and next buttons
							'type'         => 'list',						//plain, array, list
						));					
					}

				 ?>				
			</div>
			<!-- END CONTENT -->
<?php get_sidebar(); ?>			
<?php get_footer(); ?>	
			
				

