					<div class="post-related">

						<h1><?php _e('Related Posts', 'lcz_megamag'); ?></h1>

					<?php 
						$category = get_the_category();
						$num_related_posts = 4;					


						$results_related = get_posts(array(
							'numberposts' 		=> $num_related_posts+1,
							'category'			=> $category[0]->term_id,
							'orderby'			=> 'rand',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

						$results_filler = get_posts(array(

							'numberposts' 		=> $num_related_posts+1,
							'category'			=> '',
							'orderby'			=> 'rand',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

						$related_counter = 0;

						while ($related_counter<$num_related_posts) {		//run this until we have displayed the number of posts defined by $num_related_posts

							if (!empty($results_related[$related_counter])) {		//if there are still related posts

								if (get_the_ID() != $results_related[$related_counter]->ID) {	//if main story does not match related ?>		

									<div class="related-item <?php if ($related_counter == ($num_related_posts-1)) echo "last"; ?>">

										<?php 
											if (has_post_thumbnail($results_related[$related_counter]->ID)) { 
												printf("<a href='%s'>%s</a>", get_permalink($results_related[$related_counter]->ID),get_the_post_thumbnail($results_related[$related_counter]->ID, 'related_thumb'));
											} else { ?>
												 <a href='<?php the_permalink($results_related[$related_counter]->ID); ?>'><img src="" alt="" /></a> 
										<?php
											}
										?>

										<h2><a href="<?php echo get_permalink($results_related[$related_counter]->ID); ?>"><?php echo $results_related[$related_counter]->post_title; ?></a></h2>
									</div>

									<?php
									$related_counter++;
								} else { 	//if main story matches related post filler  ?>

									<div class="related-item <?php if ($related_counter == ($num_related_posts-1)) echo "last"; ?>">

										<?php 
											if (has_post_thumbnail($results_filler[$related_counter]->ID)) { 
												printf("<a href='%s'>%s</a>", get_permalink($results_filler[$related_counter]->ID),get_the_post_thumbnail($results_filler[$related_counter]->ID, 'related_thumb'));
											} else { ?>
												<a href='<?php the_permalink($results_filler[$related_counter]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/related.jpg" alt="" /></a>
										<?php
											}
										?>

										<h2><a href="<?php echo get_permalink($results_filler[$related_counter]->ID); ?>"><?php echo $results_filler[$related_counter]->post_title; ?></a></h2>
									</div>

									<?php
									$related_counter++;
								}
									
							} else { 		//if out of related stories post filler instead  

								if (!empty($results_filler[$related_counter])) {		//check if there are remaining filler stories.

									?>	

									<div class="related-item <?php if ($related_counter == ($num_related_posts-1)) echo "last"; ?>">

											<?php 
												if (has_post_thumbnail($results_filler[$related_counter]->ID)) { 
													printf("<a href='%s'>%s</a>", get_permalink($results_filler[$related_counter]->ID),get_the_post_thumbnail($results_filler[$related_counter]->ID, 'related_thumb'));
												} else { ?>
													<a href='<?php the_permalink($results_filler[$related_counter]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/related.jpg" alt="" /></a>
											<?php
												}
											?>

										<h2><a href="<?php echo get_permalink($results_filler[$related_counter]->ID); ?>"><?php echo $results_filler[$related_counter]->post_title; ?></a></h2>
									</div>

									<?php
									$related_counter++;
								} else {											//if no remaining filler stories just increment counter.
									$related_counter++;
								}
							}		//end if there are still related posts
						}		//end while



					 ?>
						
						
						
					</div>
