				<div class="widget">

					<?php 
						if (!empty($content)) {
							echo $content;	
						} else {
					?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/default_banner.jpg" alt="default_banner" />
					<?php	
						}
					?>
					
					
				</div>
				