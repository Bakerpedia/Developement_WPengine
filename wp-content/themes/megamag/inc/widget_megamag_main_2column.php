				<div class="home-widget">

					<?php 
						//defaults
						if (empty($num_2column_posts)) $num_2column_posts = 3;
						$default_cat = get_categories(array(
							'orderby' => 'name',
							'order' => 'ASC',
							'number' => 1
						));
						if (empty($left_cat)) $left_cat = $default_cat[0]->name;
						if (empty($right_cat)) $right_cat = $default_cat[0]->name;


						$results_left_cat = get_posts(array(
							'numberposts' 		=> $num_2column_posts,
							'offset' 			=> 0,
							'category'			=> get_cat_ID($left_cat),
							'orderby'			=> 'post_date',
							'order'				=> 'DESC',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

						$results_right_cat = get_posts(array(
							'numberposts' 		=> $num_2column_posts,
							'offset' 			=> 0,
							'category'			=> get_cat_ID($right_cat),
							'orderby'			=> 'post_date',
							'order'				=> 'DESC',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

					?>


					
					<div class="block half">
					
						<h1><a href="<?php echo get_category_link(get_cat_ID($left_cat)); ?>"><?php if (!empty($widget_title_left)) {echo $widget_title_left;} else {echo $left_cat;}; ?></a></h1>
						
					<?php 
						if (!empty($results_left_cat[0])) {
							$result_cmb_excerpt = get_post_meta($results_left_cat[0]->ID, 'cmb_excerpt', true);
					?>

							<div class="item big">
							
								<div class="item-image big">
									<?php 

										if (has_post_thumbnail($results_left_cat[0]->ID)) { 
											printf("<a href='%s'>%s</a>", get_permalink($results_left_cat[0]->ID),get_the_post_thumbnail($results_left_cat[0]->ID, 'big_thumb'));
										} else { ?>
											<a href='<?php the_permalink($results_left_cat[0]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-big.jpg" alt="" /></a>
										<?php
										}

										if (get_post_meta($results_left_cat[0]->ID, 'cmb_is_review',true) == 'checked') {
										?>
											<div class="item-score big">
												<span class="the-score"><?php echo get_post_meta($results_left_cat[0]->ID, 'cmb_review_overall',true); ?></span>
												<span class="score-text"><?php _e('Score', 'lcz_megamag'); ?></span>
											</div>
										<?php	
										}

								?>
								
									<div class="item-icon <?php if (get_post_meta($results_left_cat[0]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_left_cat[0]->ID);} ?>"></div>

								</div>

								<h2><a href="<?php echo get_permalink($results_left_cat[0]->ID); ?>"><?php echo $results_left_cat[0]->post_title ?></a></h2>
								<ul class="meta">
									<li class="author"><?php $author = get_user_by('id',$results_left_cat[0]->post_author); echo $author->user_nicename; ?></li>
									<li class="date"><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_left_cat[0]->post_date));?></li>
									<li class="comment"><a href="<?php echo get_permalink($results_left_cat[0]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_left_cat[0]->ID)); ?></a></li>
								</ul>
								<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt($results_left_cat[0]->post_content, 118, true);} ?> <a href="<?php echo get_permalink($results_left_cat[0]->ID); ?>"><?php _e("Read More", "lcz_megamag"); ?></a></p>
							
							</div>

						<?php 
						} else {
							echo "Sorry, there are no posts in this category!";						
						}
						?>
						
						<?php 
							for ($i=1; $i<$num_2column_posts; $i++) {
								if (!empty($results_left_cat[$i])) {
						?>

									<div class="item small">
									
										<div class="item-image small">
											<?php 

												if (has_post_thumbnail($results_left_cat[$i]->ID)) { 
													printf("<a href='%s'>%s</a>", get_permalink($results_left_cat[$i]->ID),get_the_post_thumbnail($results_left_cat[$i]->ID,'small_thumb'));
												} else { ?>
													<a href='<?php the_permalink($results_left_cat[$i]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
												<?php
												}

												if (get_post_meta($results_left_cat[$i]->ID, 'cmb_is_review',true) == 'checked') {
												?>
															<div class="item-score small">
																<span class="the-score"><?php echo get_post_meta($results_left_cat[$i]->ID, 'cmb_review_overall',true); ?></span>
															</div>
												<?php	
												}

											?>

											<div class="item-icon <?php if (get_post_meta($results_left_cat[$i]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_left_cat[$i]->ID);} ?>"></div>

										</div>
										<h2><a href="<?php echo get_permalink($results_left_cat[$i]->ID); ?>"><?php echo $results_left_cat[$i]->post_title ?></a></h2>
										<ul class="meta">
											<li><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_left_cat[$i]->post_date));?></li>
											<li><a href="<?php echo get_permalink($results_left_cat[$i]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_left_cat[$i]->ID)); ?></a></li>
										</ul>
									
									</div>

						<?php
								}   //endif
							}		//endfor
						 ?>
						
					</div> <!-- end block half -->
					
					<div class="block half last">
					
						<h1><a href="<?php echo get_category_link(get_cat_ID($right_cat)); ?>"><?php if (!empty($widget_title_right)) {echo $widget_title_right;} else {echo $right_cat;}; ?></a></h1>
						
					<?php 
						if (!empty($results_right_cat[0])) {
							$result_cmb_excerpt = get_post_meta($results_right_cat[0]->ID, 'cmb_excerpt', true);
					?>
							<div class="item big">
							
								<div class="item-image big">
									<?php 

										if (has_post_thumbnail($results_right_cat[0]->ID)) { 
											printf("<a href='%s'>%s</a>", get_permalink($results_right_cat[0]->ID),get_the_post_thumbnail($results_right_cat[0]->ID, 'big_thumb'));
										} else { ?>
											<a href='<?php the_permalink($results_right_cat[0]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-big.jpg" alt="" /></a>
										<?php
										}

										if (get_post_meta($results_right_cat[0]->ID, 'cmb_is_review',true) == 'checked') {
										?>
											<div class="item-score big">
												<span class="the-score"><?php echo get_post_meta($results_right_cat[0]->ID, 'cmb_review_overall',true); ?></span>
												<span class="score-text"><?php _e('Score', 'lcz_megamag'); ?></span>
											</div>
										<?php	
										}

									?>
									<div class="item-icon <?php if (get_post_meta($results_right_cat[0]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_right_cat[0]->ID);} ?>"></div>

								</div>

								<h2><a href="<?php echo get_permalink($results_right_cat[0]->ID); ?>"><?php echo $results_right_cat[0]->post_title ?></a></h2>
								<ul class="meta">
									<li class="author"><?php $author = get_user_by('id',$results_right_cat[0]->post_author); echo $author->user_nicename; ?></li>
									<li class="date"><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_right_cat[0]->post_date));?></li>
									<li class="comment"><a href="<?php echo get_permalink($results_right_cat[0]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_right_cat[0]->ID)); ?></a></li>
								</ul>
								<p><?php if (!empty($result_cmb_excerpt)) {echo $result_cmb_excerpt;} else {echo mb_make_excerpt($results_right_cat[0]->post_content, 118, true);} ?> <a href="<?php echo get_permalink($results_right_cat[0]->ID); ?>"><?php _e("Read More", "lcz_megamag"); ?></a></p>
							
							</div>
						
						<?php 
						} else {
							echo "Sorry, there are no posts in this category!";						
						}
						?>

						<?php 
							for ($i=1; $i<$num_2column_posts; $i++) {
								if (!empty($results_right_cat[$i])) {
						?>

									<div class="item small">
									
										<div class="item-image small">
											<?php 

												if (has_post_thumbnail($results_right_cat[$i]->ID)) { 
													printf("<a href='%s'>%s</a>", get_permalink($results_right_cat[$i]->ID),get_the_post_thumbnail($results_right_cat[$i]->ID,'small_thumb'));
												} else { ?>
													<a href='<?php the_permalink($results_right_cat[$i]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
												<?php
												}
												
												if (get_post_meta($results_right_cat[$i]->ID, 'cmb_is_review',true) == 'checked') {
												?>
															<div class="item-score small">
																<span class="the-score"><?php echo get_post_meta($results_right_cat[$i]->ID, 'cmb_review_overall',true); ?></span>
															</div>
												<?php	
												}

											?>
											
											<div class="item-icon <?php if (get_post_meta($results_right_cat[$i]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_right_cat[$i]->ID);} ?>"></div>

										</div>
										<h2><a href="<?php echo get_permalink($results_right_cat[$i]->ID); ?>"><?php echo $results_right_cat[$i]->post_title ?></a></h2>
										<ul class="meta">
											<li><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_right_cat[$i]->post_date));?></li>
											<li><a href="<?php echo get_permalink($results_right_cat[$i]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_right_cat[$i]->ID)); ?></a></li>
										</ul>
									
									</div>

						<?php
								}
							}
						 ?>
						
					</div>
					
				</div>
