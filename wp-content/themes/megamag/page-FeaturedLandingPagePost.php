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
				<div class="widget3" style="padding-right: 0px;">
					<form style="font-weight:bolder; color:#000000;"  role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					    <div>
					        <input style="font-weight:bolder; color:#000000;" type="text" 
							value="<?php _e('What baking topic can we search for you today?', 'lcz_megamag'); ?>" 
							name="s" id="s" onfocus="if(this.value == this.defaultValue) this.value = ''"/>
					        <input type="submit" id="searchsubmit" value="" />
					    </div>
					</form>
					</br>
				</div>	
			<!-- get featured landing page post ID=52-->			
			<h1 class="blog-heading"><?php _e("Featured Posts", "lcz_megamag"); ?></h1>
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
							<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt(get_the_content(), 148, true);} ?> <br><a href="<?php the_permalink(); ?>" class="readmore"><?php _e("Read More", "lcz_megamag"); ?></a></p>
						</div>						
					</div>				
				<?php endwhile; // end of the loop. 
					// Reset Query
					wp_reset_query();
				?>						
			</div>
			<!-- END CONTENT -->
			
<?php  get_sidebar();?>
		
<?php get_footer(); ?>	
			
				

