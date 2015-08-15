								<?php 

									if (isset($megamag_options_post['share_twitter'])) {
									?>
										<span class="share-item">
											<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>: " data-url="<?php the_permalink(); ?>" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_fb'])) {
									?>
										<span class="share-item">
											<iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=box_count&amp;width=60&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=61" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:61px;" allowTransparency="true"></iframe>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_digg'])) {
									?>
										<span class="share-item">
											<script type="text/javascript">
											(function() {
											var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
											s.type = 'text/javascript';
											s.async = true;
											s.src = 'http://widgets.digg.com/buttons.js';
											s1.parentNode.insertBefore(s, s1);
											})();
											</script>
											<a class="DiggThisButton DiggMedium" href="http://digg.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>"></a>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_pin'])) {
									?>
										<span class="share-item">
											<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode($thumbnail_url[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
											<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_google'])) {
									?>
										<span class="share-item">
											<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
											<g:plusone size="tall"></g:plusone>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_reddit'])) {
									?>
										<span class="share-item">
											<script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_tumblr'])) {
									?>
										<span class="share-item">
											<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:62px; height:20px; background:url('http://platform.tumblr.com/v1/share_2.png') top left no-repeat transparent;">Share on Tumblr</a>
										</span>
									<?php		
									}
									
									if (isset($megamag_options_post['share_stumble'])) {
									?>
										<span class="share-item">
											<script src="http://www.stumbleupon.com/hostedbadge.php?s=5"></script>
										</span>
									<?php		
									}
									
								?>
