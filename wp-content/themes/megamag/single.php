<?php get_header(); ?>
<?php $key="external_link_key"; $single=1; $external_link = get_post_meta($post->ID, $key, $single); ?>

<?php 
	$megamag_options_post = get_option('megamag_options_post'); 
	$megamag_options_appearance = get_option('megamag_options_appearance'); 

	if (isset($megamag_options_post['share_fb']) 
		|| isset($megamag_options_post['share_twitter'])
		|| isset($megamag_options_post['share_digg'])
		|| isset($megamag_options_post['share_pin'])
		|| isset($megamag_options_post['share_google'])
		|| isset($megamag_options_post['share_reddit'])
		|| isset($megamag_options_post['share_tumblr'])
		|| isset($megamag_options_post['share_stumble'])
	) {
		$show_share = true;
	} else {
		$show_share = false;	
	}


?>
		
		<div id="main" class="container">
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54bfa6a93ab7615d" async="async"></script>

			<div id="content">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div <?php post_class(); ?>>

				<?php 

					if (isset($megamag_options_post['show_featured'])) {
						$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						if (get_the_post_thumbnail() != NULL) { 
							?>
							
							<?php if($external_link == ""){ ?>
									<a target="" rel="lightbox" href="<?php echo $thumbnail_url[0]; ?>" title="<?php the_title(); ?>"> 
										<img src="<?php printf($thumbnail_url[0]); ?>" width="610" alt="<?php the_title(); ?>" /> </a><?php ;}
								
									else{ ?>
									<a target="_blank" href="<?php echo $external_link; ?>" title="<?php the_title(); ?>"> 
										<img src="<?php printf($thumbnail_url[0]); ?>" width="609" alt="<?php the_title(); ?>" /> 
									</a> <?php } ?>																					
						<?php
						}
					}
				?>

					<h1 class="post-heading"><?php the_title(); ?></h1>
					
					<ul class="post-meta post">
						<li class="author"><?php the_author_posts_link(); ?></li>						 
						<li class="cat"><?php the_category(', ') ?></li>
						<li class="comment"><a href="#comments"><?php printf(get_comments_number(get_the_ID())); ?></a></li>
					</ul>
					<style>
					h1.test {
						text-align:left;
						font-family:Arial,"Times New Roman";
						font-size:1.125em;
						font-style:normal;
						font-weight:bold;
						margin-top:0;
						margin-left:auto;
						margin-right:auto;
						margin-bottom:0; 
						}
			
					div.testdiv {
						text-align:left;					
						margin-top:0;
						margin-left:auto;
						margin-right:auto;
						margin-bottom:5; 
						font-size:14px;
						line-height:23px;
						color:#000;		
						}
					</style>
					<?php if(function_exists('email_link')) { email_link(); } ?>
					<div class="post-content">
						
						<?php 
							$result_cmb_is_review = get_post_meta($post->ID, 'cmb_is_review', true);

							if ($result_cmb_is_review == 'checked') {
								include 'inc/template_review.php'; 
							}
						?>						
						<?php the_content(); ?>
						<?php					
						$key = "definition";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Definition</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						<?php 
						$key = "origin";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Origin</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						<?php 
						$key = "function";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Function</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						<?php 
						$key = "method";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Method</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>						
						
						<?php 
						$key = "composition";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Composition</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "application";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Application</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "nutrition";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Nutrition</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "fda_legal_requirement";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>FDA Legal Requirement</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "fda_legal_requirement_note";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>FDA Legal Requirement Note</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "FDA_legal_requirement";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>FDA Legal Requirement</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "FDA_legal_requirement_note";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>FDA Legal Requirement Note</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "composition_image";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>COMPOSITION IMAGE</h1>";
							echo "<div class=testdiv><img src=" . $thumb . " width=270></img></div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "allergen_statement";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Allergen Statement</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>	
						<?php 
						$key = "to_be_labelled_as";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>To Be Labelled As</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
						<?php 
						$key = "types";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>Types and Variations</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>                        						
                        
						<?php 
						$key = "references";
						$thumb = get_post_meta(get_the_ID(), $key, true);
						if ($thumb)
						{
							echo "<h1 class=test>References</h1>";
							echo "<div class=testdiv>" . $thumb . "</div><div>&nbsp;</div>";
						}
						?>
						
					</div>
					
					<!-- SHARE BUTTONS -->
					<?php 
						if ($show_share === true) {
					?>
							<div class="post-share">

								<?php include 'inc/template_share.php'; ?>
							
							</div>
					<?php
						}
					?>
					<!-- END SHARE BUTTONS -->

					<?php 

						if (isset($megamag_options_post['show_tags'])) {
							if (has_tag()) { 
							?>
					
								<div class="post-tags">
									<span class="tags"><?php _e('Tags', 'lcz_megamag'); ?></span>
									<?php the_tags('',' '); ?>
								</div>
								
							<?php
							} 
						}
					?>
					
					<!-- RESPONSIVE SHARE BUTTONS -->
					<?php 
						if ($show_share === true) {
					?>
							<div class="post-share-responsive">

								<?php include 'inc/template_share.php'; ?>
							
							</div>
					<?php
						}
					?>
					<!-- END RESPONSIVE SHARE BUTTONS -->

					<?php 

						if (get_the_author_meta('description') != '' && isset($megamag_options_post['show_author_info'])) {

					?>
					
							<div class="post-author">
								
								<?php echo get_avatar(get_the_author_meta('ID'), 80) ?>

								<h1><?php _e('About the Author', 'lcz_megamag'); ?></h1>
								<p><?php the_author_meta('description'); ?></p>
								
							</div>

					<?php
						}
					?>
					

					<?php 
					 	if (isset($megamag_options_post['show_related'])) {
							include 'inc/template_related_posts.php'; 
						}
					?>
					
					<?php 
						if (isset($megamag_options_post['show_comments'])) {
							comments_template( '', true ); 
					}
					?>
					
				</div>
				<!-- END POST -->

				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lcz_megamag'); ?></p>
				<?php endif; ?>	<!-- main post loop -->


			</div>
			<!-- END CONTENT -->


<?php get_sidebar(); ?>			

<?php get_footer(); ?>