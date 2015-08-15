			<div class="slider-wrapper full">
			
				<?php 
					require 'functions_slider_sort.php';
				?>

				<div id="slider" class="nivoSlider">

					<?php 
						if (count($results_slider_posts) > 5) {
							$num_slider_posts = 5;	
						} else {
							$num_slider_posts = count($results_slider_posts);	
						}
						for ($i = 0; $i < $num_slider_posts; $i++) { 
							$current_id = $order_array[$i];  
							//get the array key for the object from $results_slider_posts where ID is = $current_id
							for ($n = 0; $n < count($results_slider_posts); $n++) { 
								if ($results_slider_posts[$n]->ID == $current_id) {
									$current_key = $n;
									break;	
								}
							}
							
							$slider_img_full_width_url = wp_get_attachment_image_src(get_post_thumbnail_id($results_slider_posts[$current_key]->ID),'slider_full_width');

							?>
							<a href="<?php echo get_permalink($results_slider_posts[$current_key]->ID); ?>">
								<img src="<?php echo $slider_img_full_width_url[0]; ?>" alt="" title="#htmlcaption<?php echo $current_key; ?>" />
							</a>
							<?php
						}
					?>

				</div>

					<?php 
						for ($i = 0; $i < count($results_slider_posts); $i++) { 
							$result_cmb_slider_caption = get_post_meta($results_slider_posts[$i]->ID, 'cmb_slider_caption', true);
							$result_cmb_slider_caption_title = get_post_meta($results_slider_posts[$i]->ID, 'cmb_slider_caption_title', true);
							$result_cmb_hide_slider_caption_title = get_post_meta($results_slider_posts[$i]->ID, 'cmb_hide_slider_caption_title', true);
							$result_cmb_hide_slider_caption = get_post_meta($results_slider_posts[$i]->ID, 'cmb_hide_slider_caption', true);

							$cat = get_the_category($results_slider_posts[$i]->ID);
							
							if (empty($result_cmb_hide_slider_caption_title) || empty($result_cmb_hide_slider_caption)) {
								?>
								<div id="htmlcaption<?php echo $i; ?>" class="nivo-html-caption">
									<div class="featured-text">
										<?php
										if (empty($result_cmb_hide_slider_caption_title)) {
										?>
											<h2><a href="<?php echo get_permalink($results_slider_posts[$i]->ID); ?>"><?php echo $result_cmb_slider_caption_title; ?></a></h2>
										<?php		
										}

										if (empty($result_cmb_hide_slider_caption)) {
										?>
											<p><?php echo $result_cmb_slider_caption; ?></p>
										<?php		
										}
										?>
									</div>
								</div>
								<?php
							}
						}
					?>

			</div>
