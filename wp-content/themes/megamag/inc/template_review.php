						<?php 
							$review_overall = get_post_meta($post->ID, 'cmb_review_overall', true);
							$cmb_review_criteria = get_post_meta($post->ID, 'cmb_review_criteria', true);
							$min_rating = $megamag_options_post['review_min'];
							$max_rating = $megamag_options_post['review_max'];
							$increment = $megamag_options_post['review_increments'];

							$rating_percentage = mb_get_rating_percentage($review_overall,$min_rating,$max_rating,$increment,true);
						 ?>

						<div class="review-wrapper">
						
							<div class="overall <?php echo mb_get_rating_color($rating_percentage); ?>">
								<div class="score"><?php echo $review_overall; ?></div>
								<div class="verdict">
									<span class="text"><?php _e('Our overall verdict', 'lcz_megamag'); ?></span>
									<span class="overall-verdict">"<?php echo mb_get_rating_label($rating_percentage); ?>"</span>
								</div>
							</div>
							
							<?php  

								for ($i = 0; $i < count($cmb_review_criteria); $i++) {
									if (!empty($cmb_review_criteria[$i][0])) {
										$criteria_rating_percentage = mb_get_rating_percentage($cmb_review_criteria[$i][1],$min_rating,$max_rating,$increment,true);
										$rating_bar_width = ($criteria_rating_percentage / 100) * 200;
										?>
										<div class="criteria">
											
											<span class="criteria-text"><?php echo $cmb_review_criteria[$i][0]; ?>:</span>
											<span class="score-text"><?php echo $cmb_review_criteria[$i][1] . "/" . $max_rating; ?></span>
											<div class="grey-bar">
												<!-- ADDED NEW CODE STYLE-BACKGROUND -->
												<img src="<?php echo get_template_directory_uri(); ?>/images/reviews/score-10.png" alt="" height='14px' width='<?php echo $rating_bar_width; ?>px' 
												style="background:<?php if (!empty($megamag_options_appearance['color_rating_bar'])) {echo $megamag_options_appearance['color_rating_bar']; } else {echo $megamag_options_appearance['color_main']; } ?>;" />
											</div>
											
										</div>
										<?php
									}
								}

							?>

							
						</div>
