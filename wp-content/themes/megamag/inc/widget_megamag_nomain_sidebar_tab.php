				<?php 

					$show_popular_posts = true; //isset($instance['show_popular_posts']) ? 'true' : 'false';
					$show_comments = true; //isset($instance['show_comments']) ? 'true' : 'false';
					$show_tags = true; //isset($instance['show_tags']) ? 'true' : 'false';

					//setting defaults
					if (empty($tab_num_popular)) $tab_num_popular = 3;
					if (empty($tab_num_comments)) $tab_num_comments = 3;
					if (empty($tab_num_tags)) $tab_num_tags = 20;
					if (empty($popular_by)) $popular_by = 'views';

				 ?>


				<div class="widget">

					<div class="tabs_wrapper">

						<ul class="tabs">
							<?php if($show_popular_posts == true): ?><li><a href="#tab1"><?php _e('Popular', 'lcz_megamag'); ?></a></li><?php endif; ?>
							<?php if($show_comments == true): ?><li><a href="#tab2"><?php _e('Comments', 'lcz_megamag'); ?></a></li><?php endif; ?>
							<?php if($show_tags == true): ?><li><a href="#tab3"><?php _e('Tags', 'lcz_megamag'); ?></a></li><?php endif; ?>
						</ul>

						<div class="tabs_container">

							<?php if($show_popular_posts == true): ?>
								<div id="tab1" class="tab_content">
									<?php 

										//build array of posts that should be excluded (retired from popular)
										$results_retired = get_posts(arraY(
											'meta_key' => 'cmb_retire_popular',
											'meta_value' => 'checked'
										));

										$retired_exclude_string = "";
										foreach ($results_retired as $retired) {
												$retired_exclude_string .= $retired->ID . ", ";
										}
										$retired_exclude_string = substr($retired_exclude_string, 0, strlen($retired_exclude_string)-2);


										if ($popular_by == 'views') {
											$results_popular_posts = get_posts("numberposts=$tab_num_popular&offset=0&orderby=meta_value_num&meta_key=post_views&order=DESC&post_type=post&post_status=publish&suppress_filters=true&exclude=$retired_exclude_string");
										} elseif ($popular_by == 'comments') {
											$results_popular_posts = get_posts(array(

												'numberposts' 		=> $tab_num_popular,
												'offset' 			=> 0,
												'category'			=> '',
												'orderby'			=> 'comment_count',
												'order'				=> 'DESC',
												'post_type'    		=> 'post',
												'post_status'     	=> 'publish',
												'suppress_filters'  => true,
												'exclude'			=> $retired_exclude_string

											));
										}

										//don't display more than you have
										if ($tab_num_popular > count($results_popular_posts)) $tab_num_popular = count($results_popular_posts);

										for ($i = 0; $i < $tab_num_popular; $i++) {
									?>
											
											<div class="item small">
												
												<div class="item-image small">
													<?php 

														if (has_post_thumbnail($results_popular_posts[$i]->ID)) { 
															printf("<a href='%s'>%s</a>", get_permalink($results_popular_posts[$i]->ID),get_the_post_thumbnail($results_popular_posts[$i]->ID,'small_thumb'));
														} else { ?>
															<a href='<?php the_permalink($results_popular_posts[$i]->ID); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/item-small.jpg" alt="" /></a>
														<?php
														}

														if (get_post_meta($results_popular_posts[$i]->ID, 'cmb_is_review',true) == 'checked') {
														?>
																	<div class="item-score small">
																		<span class="the-score"><?php echo get_post_meta($results_popular_posts[$i]->ID, 'cmb_review_overall',true); ?></span>
																	</div>
														<?php	
														}

													?>
													<div class="item-icon <?php if (get_post_meta($results_popular_posts[$i]->ID, 'cmb_is_review',true) != 'checked') {echo get_post_format($results_popular_posts[$i]->ID);} ?>"></div>

												</div>
												<h2><a href="<?php echo get_permalink($results_popular_posts[$i]->ID); ?>"><?php echo $results_popular_posts[$i]->post_title; ?></a></h2>
												<ul class="meta">
													<li><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_popular_posts[$i]->post_date));?></li>
													<li><a href="<?php echo get_permalink($results_popular_posts[$i]->ID); ?>#comments" class="comment"><?php printf(get_comments_number($results_popular_posts[$i]->ID)); ?></a></li>
												</ul>
											
											</div>
											
										<?php	
										}

									?>

								</div> <!-- tab1 -->
							<?php endif; ?>



							
							<?php if($show_comments == true): ?>
							<div id="tab2" class="tab_content">

								<?php 
									$results_comments = get_comments(array(
										'number'			=> $tab_num_comments,
										'orderby'			=> 'comment_date',
										'order'				=> 'DESC',
										'status'			=> 'approve'

									));

									//don't display more than you have
									if ($tab_num_comments > count($results_comments)) $tab_num_comments = count($results_comments);

									for ($i = 0; $i < $tab_num_comments; $i++) {
									?>
											
											<div class="item small comment">
												
												<?php echo get_avatar( $results_comments[$i]->comment_author_email, $size = '60'); ?>  
												
												<div class="arrow"></div>
												<div class="item-comment">
													<h2><?php echo $results_comments[$i]->comment_author; ?> says: </h2>
													<a href="<?php echo get_permalink($results_comments[$i]->comment_post_ID); ?>#comments"><?php echo mb_make_excerpt($results_comments[$i]->comment_content, 70, true); ?></a></li>
												</div>
												
											</div>
											
										<?php	
									}

									?>


							</div> <!-- tab2 -->
							<?php endif; ?>





							<?php if($show_tags == true): ?>
							<div id="tab3" class="tab_content">

								<div class='tab_tag_cloud'>

								<?php 
									if ($tags_as == 'cloud') {
										wp_tag_cloud(array(
											'smallest'                  => 8,     
											'largest'                   => 22,    
											'unit'                      => 'pt',     
											'number'                    => $tab_num_tags,      
											'format'                    => 'flat',    
											'orderby'                   => 'name',     
											'order'                     => 'ASC',    
											'exclude'                   => null,     
											'include'                   => null,     
											'link'                      => 'view',     
											'taxonomy'                  => 'post_tag',     
											'echo'                      => true
										));
									} else {

										if ($tags_as == 'list_alphabetically') {
											$tags = get_tags(array(
												'orderby'					=> 'name',
												'order'						=> 'ASC',
												'hide_empty'				=> true,
												'number'					=> $tab_num_tags
											));	
										} else {
											$tags = get_tags(array(
												'orderby'					=> 'count',
												'order'						=> 'DESC',
												'hide_empty'				=> true,
												'number'					=> $tab_num_tags
											));
										}
										foreach ($tags as $tag) {
											$link = get_tag_link($tag->term_id);
											echo "<a href='$link'>$tag->name</a> ";
										}
									}

								 ?>

								 </div>

							</div> <!-- tab3 -->
							<?php endif; ?>

						</div> <!-- tabs_container -->


					</div> <!-- tabs wrapper -->

				</div> <!-- widget -->


				
