				<div class="home-widget">

					<h1><?php if (!empty($widget_title)) {echo $widget_title;} else {echo "Latest";}; ?></h1>
					
					<div class="block half">

					<?php 
						if (!empty($results_query[0])) {
							
							$result_cmb_excerpt = get_post_meta($results_query[0]->ID, 'cmb_excerpt', true);
							?>
								
								<div class="item big">
								
									<div class="item-image big">
									
									<?php 
										if (has_post_thumbnail($results_query[0]->ID)) { 
											printf("<a href='%s'>%s</a>", get_permalink($results_query[0]->ID),get_the_post_thumbnail($results_query[0]->ID, 'big_thumb'));
										} else { ?>
											<a href='<?php the_permalink($results_query[0]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
										<?php
										}

										if (get_post_meta($results_query[0]->ID, 'cmb_is_review',true) == 'checked') {
										?>
											<div class="item-score big">
												<span class="the-score"><?php echo get_post_meta($results_query[0]->ID, 'cmb_review_overall',true); ?></span>
												<span class="score-text"><?php _e('Score', 'lcz_megamag'); ?></span>
											</div>
										<?php	
										}
									?>
									
										<div class="item-icon <?php if (get_post_meta($results_query[0]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_query[0]->ID);} ?>"></div>
												
									</div>


									<h2><a href="<?php echo get_permalink($results_query[0]->ID); ?>"><?php echo $results_query[0]->post_title ?></a></h2>
									<ul class="meta">
										<li class="author"><?php $author = get_user_by('id',$results_query[0]->post_author); echo $author->user_nicename; ?></li>
										<li class="date"><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_query[0]->post_date));?></li>
										<li class="comment"><a href="<?php echo get_permalink($results_query[0]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_query[0]->ID)); ?></a></li>
									</ul>
									<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt($results_query[0]->post_content, 118, true);} ?> <a href="<?php echo get_permalink($results_query[0]->ID); ?>"><?php _e("Read More", "lcz_megamag"); ?></a></p>
								
								</div>
							<?php 
								} else {
									echo "Sorry, you do not have any posts!";						
								}
							?>
						
					</div>
					
					<div class="block half last">
									

						<?php 
							for ($i=1; $i<5; $i++) {
								if (!empty($results_query[$i])) {
						?>

									<div class="item small">
									
										<div class="item-image small">
										<?php 

											if (has_post_thumbnail($results_query[$i]->ID)) {
												printf("<a href='%s'>%s</a>", get_permalink($results_query[$i]->ID),get_the_post_thumbnail($results_query[$i]->ID,'small_thumb'));
											} else { ?>
												<a href='<?php the_permalink($results_query[$i]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
											<?php
											}
										
											if (get_post_meta($results_query[$i]->ID, 'cmb_is_review',true) == 'checked') {
											?>
												<div class="item-score small">
													<span class="the-score"><?php echo get_post_meta($results_query[$i]->ID, 'cmb_review_overall',true); ?></span>
												</div>
											<?php	
											}
											?>
											
												<div class="item-icon <?php if (get_post_meta($results_query[$i]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_query[$i]->ID);} ?>"></div>
													
										</div>
										
										<h2><a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><?php echo $results_query[$i]->post_title ?></a></h2>
										<ul class="meta">
											<li><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_query[$i]->post_date));?></li>
											<li><a href="<?php echo get_permalink($results_query[$i]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_query[$i]->ID)); ?></a></li>
										</ul>
									
									</div>
										

						<?php
								}
							}
						 ?>
						
					</div>
								
				</div> <!-- END HOME WIDGET-->

