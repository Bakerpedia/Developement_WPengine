				<div class="widget">

					<h1><?php if (!empty($widget_title)) {echo $widget_title;} else {echo "Flickr Photostream";}; ?></h1>
				<?php 

				//defaults

				if (!isset($flickr_num)) $flickr_num = 9;
				if (!isset($flickr_show)) $flickr_show = 'latest';

				if (empty($flickr_id)) {
					$megamag_options = get_option('megamag_options');
					if (!empty($megamag_options['main_flickr_id'])) {
						$flickr_id = $megamag_options['main_flickr_id'];	
					} else {
						echo "Please set flickr user ID in widget settings!";
					}
				}

				?>

						<div class="flickr_badge_wrapper">
							<script type="text/javascript" 
								src="http://www.flickr.com/badge_code.gne?count=<?php echo $flickr_num; ?>&display=<?php echo $flickr_show; ?>&size=square&nsid=<?php echo $flickr_id; ?>&raw=1">
								    
							</script>
						</div>

				</div>

