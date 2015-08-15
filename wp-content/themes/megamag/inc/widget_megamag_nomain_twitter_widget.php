			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<div class='twitter_widget'>
				<?php echo $twitter_widget_code; ?>

			</div>

			<div class='twitter_via_widget_megamag_design' data-megamag_design='<?php if(isset($use_megamag_design)) {echo "true";} else {echo "false";} ?>' data-num_tweets='<?php echo $twitter_num_tweets; ?>'>
					<ul class="twitter">
					</ul>
			</div>

			<?php echo $after_widget; ?>

