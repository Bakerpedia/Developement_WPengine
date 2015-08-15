				<div class="widget">
					
					<?php 
						//defaults
						if (empty($fb_like_page)) {
							$megamag_options = get_option('megamag_options');
							if (!empty($megamag_options['main_fb_page'])) {
								$fb_like_page = $megamag_options['main_fb_page'];

							} else {
								$fb_like_page = "envato";
							}
						}
					 
						if (stristr($fb_like_page, 'http')) {
							$fb_url = $fb_like_page;
						} else {
							$fb_url = "http://www.facebook.com/$fb_like_page";	
						}
					 ?>

					<h1><?php if (!empty($widget_title)) {echo $widget_title;} else {echo "Like Us On Facebook";}; ?></h1>
					
					<div class="fb-like-box" 
						data-href=<?php echo $fb_url; ?>
						data-width="300" 
						data-show-faces=<?php if (isset($fb_faces)) {echo "true";} else {echo "false";} ?>
						data-stream=<?php if (isset($fb_wall)) {echo "true";} else {echo "false";} ?> 
						data-header=<?php if (isset($fb_header)) {echo "true";} else {echo "false";} ?>>
					</div>

				</div>
				
