				<div class="widget">
					<?php
						//if widget accounts are empty defaults to general account settings 
						$megamag_options = get_option('megamag_options');
						if (empty($facebook_page)) {
							if (!empty($megamag_options['main_fb_page'])) $facebook_page = $megamag_options['main_fb_page'];
						}

						if (empty($twitter_screen_name)) {
							if (!empty($megamag_options['main_twitter_screen_name'])) $twitter_screen_name = $megamag_options['main_twitter_screen_name'];
						}

						if (empty($feedburner_account)) {
							if (!empty($megamag_options['main_feedburner_account'])) $feedburner_account = $megamag_options['main_feedburner_account'];
						}

					?>
					
					<div class="social-count">
						<a href="http://www.facebook.com/<?php echo $facebook_page; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="" /></a>
						<span><?php if(mb_get_facebook_count($facebook_page) === false) {echo "Sorry, invalid page.";} else {echo mb_get_facebook_count($facebook_page);} ?></span>
					</div>
					
					<div class="social-count">
						<a href="http://www.twitter.com/<?php echo $twitter_screen_name; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="" /></a>
						<span><?php echo mb_get_twitter_count($twitter_screen_name); ?></span>
					</div>
					
					<div class="social-count last">
						<a href="http://feeds.feedburner.com/<?php echo $feedburner_account; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="" /></a>
						<!-- OLD CODE <span><?php // if (mb_get_rss_count($feedburner_account) === false) {echo "Sorry, that page does not exist.";} else {echo mb_get_rss_count($feedburner_account);} ?></span>--><!-- NEW CODE -->
						<span>RSS</span>
					</div>
					
				</div>
