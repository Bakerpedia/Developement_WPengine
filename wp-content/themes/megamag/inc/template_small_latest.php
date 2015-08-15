									<div class="item small">
									
										<div class="item-image small">
											<?php 
	
												if (has_post_thumbnail($results_small_latest[$i]->ID)) { 
													printf("<a href='%s'>%s</a>", get_permalink($results_small_latest[$i]->ID),get_the_post_thumbnail($results_small_latest[$i]->ID,'small_thumb'));
												} else { ?>
													<a href='<?php the_permalink($results_small_latest[$i]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
												<?php
												}
	
												if (get_post_meta($results_small_latest[$i]->ID, 'cmb_is_review',true) == 'checked') {
												?>
															<div class="item-score small">
																<span class="the-score"><?php echo get_post_meta($results_small_latest[$i]->ID, 'cmb_review_overall',true); ?></span>
															</div>
												<?php	
												}
	
											?>
											
												<div class="item-icon <?php if (get_post_meta($results_small_latest[$i]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_small_latest[$i]->ID);} ?>"></div>
										
										</div>
	
										<h2><a href="<?php echo get_permalink($results_small_latest[$i]->ID); ?>"><?php echo $results_small_latest[$i]->post_title ?></a></h2>
										<ul class="meta">
											<li><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_small_latest[$i]->post_date));?></li>
											<li><a href="<?php echo get_permalink($results_small_latest[$i]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_small_latest[$i]->ID)); ?></a></li>
										</ul>
									
									</div>
