		<div id="main" class="container">
		
			<div id="content">

				<div class="browsing">
					
				<?php 
					$type = mb_get_page_type(); 
					switch ($type) {
						case 'category':
							$titlebar_description = __('Browsing Category', 'lcz_megamag');
							$titlebar_name = single_cat_title('', false);
							break;
						case 'tag':
							$titlebar_description = __('Browsing Tag', 'lcz_megamag');
							$titlebar_name = single_tag_title('', false);
							break;
						case 'search':
							$titlebar_description = __('Search Results For', 'lcz_megamag');
							$titlebar_name = get_search_query();
							break;
						case 'author':
							$titlebar_description = __('Browsing Author', 'lcz_megamag');
							$titlebar_name = get_the_author_meta('display_name',$wp_query->post->post_author);
							break;
						default:
							$titlebar_description = __('Browsing', 'lcz_megamag');
							$titlebar_name = __('Unknown', 'lcz_megamag');
							break;

					}

				?>

					<span><?php echo $titlebar_description; ?></span>
					<h1><?php echo $titlebar_name; ?></h1>
					
				</div>

				<?php while ( have_posts() ) : the_post(); ?>

				<?php $result_cmb_excerpt = get_post_meta(get_the_ID(), 'cmb_excerpt', true);?>

					<div class="blog-item">
					
						<div class="item-image big">
						
						<?php 

							if (has_post_thumbnail(get_the_ID())) { 
								printf("<a href='%s'>%s</a>", get_permalink(),get_the_post_thumbnail(get_the_ID(), 'archive_thumb'));
							} else { ?>
								<a href='<?php the_permalink(); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" width="270" /></a>
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
							<!-- <ul class="post-meta archive">
								<li class="author"><?php //the_author(); ?></li>
								<li class="date"><?php// echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li>
								<li class="comment"><a href="<?php //echo get_permalink(get_the_ID()); ?>#comments" class="comment"><?php // printf(get_comments_number(get_the_ID())); ?></a></li>
							</ul>-->
							<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt(get_the_content(), 148, true);} ?> <br><a href="<?php the_permalink(); ?>" class="readmore"><?php _e("Read More", "lcz_megamag"); ?></a></p>
						</div>
					</div>
				
				<?php endwhile; // end of the loop. ?>

				
				<?php 
					//wp_query is the gloabal var. If you put this in function remember to globalize var using: global $wp_query
					$total_pages = $wp_query->max_num_pages;
					if ($total_pages > 1) {
						$current_page = get_query_var('paged') ? get_query_var('paged') : 1;
						echo paginate_links(array(
							'base'         => add_query_arg('paged','%#%'),	//base url
							'format'       => '',							//replaces the %_% above
							'total'        => $total_pages,					//total num pages
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

