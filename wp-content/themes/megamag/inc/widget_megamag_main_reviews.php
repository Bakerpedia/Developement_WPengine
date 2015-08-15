				<?php 
					$results_query = get_posts(array(
						'numberposts'		=> 5,
						'meta_key'			=> 'cmb_is_review',
						'meta_value'		=> 'checked',
						'orderby'			=> 'post_date',
						'order'				=> 'DESC',
						'post_type'    		=> 'post',
						'post_status'     	=> 'publish',
						'suppress_filters'  => true,
					));

				if (empty($widget_title)) $widget_title = "Latest Reviews";

				include 'template_main_1_column.php';
				?>



