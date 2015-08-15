			<div class="widget">
			
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

						//defaults
						if (empty($small_latest_num)) $small_latest_num = 3;

						if ($small_latest_show == 'latest') {
							$results_small_latest = get_posts(array(
								'numberposts' 		=> $small_latest_num,
								'offset' 			=> 0,
								'category'			=> '',
								'orderby'			=> 'post_date',
								'order'				=> 'DESC',
								'post_type'    		=> 'post',
								'post_status'     	=> 'publish',
								'suppress_filters' => true
							));
						} elseif ($small_latest_show == 'reviews') {
							$results_small_latest = get_posts(array(
								'numberposts'		=> $small_latest_num,
								'meta_key'			=> 'cmb_is_review',
								'meta_value'		=> 'checked',
								'orderby'			=> 'post_date',
								'order'				=> 'DESC',
								'post_type'    		=> 'post',
								'post_status'     	=> 'publish',
								'suppress_filters'  => true,
							));
						} elseif ($small_latest_show == 'highest rated reviews'){
							
							$results_small_latest = get_posts(array(
								'numberposts'		=> -1,
								'meta_key'			=> 'cmb_is_review',
								'meta_value'		=> 'checked',
								'orderby'			=> 'post_date',
								'order'				=> 'DESC',
								'exclude'			=> $retired_exclude_string,
								'post_type'    		=> 'post',
								'post_status'     	=> 'publish',
								'suppress_filters'  => true,
							));
							
						} elseif ($small_latest_show == 'lowest rated reviews'){
							
							$results_small_latest = get_posts(array(
								'numberposts'		=> -1,
								'meta_key'			=> 'cmb_is_review',
								'meta_value'		=> 'checked',
								'orderby'			=> 'post_date',
								'order'				=> 'DESC',
								'exclude'			=> $retired_exclude_string,
								'post_type'    		=> 'post',
								'post_status'     	=> 'publish',
								'suppress_filters'  => true,
							));
							
						} else {
							$results_small_latest = get_posts(array(
								'numberposts' 		=> $small_latest_num,
								'offset' 			=> 0,
								'category'			=> get_cat_ID($small_latest_show),
								'orderby'			=> 'post_date',
								'order'				=> 'DESC',
								'post_type'    		=> 'post',
								'post_status'     	=> 'publish',
								'suppress_filters' => true
							));
						}
						
						//build rating array
						$ratings_array = array();
						for ($i = 0; $i < count($results_small_latest); $i++) {
							$ratings_array[$i][0] = get_post_meta($results_small_latest[$i]->ID, 'cmb_review_overall', true);
							$ratings_array[$i][1] = $i;
							if ($small_latest_show == 'highest rated reviews') {
								rsort($ratings_array); 
							} else {
								sort($ratings_array); 
							}
						}
					?>

				<h1><?php if (!empty($widget_title)) {echo $widget_title;} else {echo $small_latest_show;}; ?></h1>
				
					<?php 
						if ($small_latest_show == 'highest rated reviews' || $small_latest_show == 'lowest rated reviews') {
							for ($n=0; $n<$small_latest_num; $n++) {
								$i = $ratings_array[$n][1];
								if (!empty($results_small_latest[$i])) {
										include 'template_small_latest.php';
								} //if not empty
							}
						} else {
							for ($i=0; $i<$small_latest_num; $i++) {
								if (!empty($results_small_latest[$i])) {
										include 'template_small_latest.php';
								} //if not empty
							}
						}
					
					 ?>

				
			</div>
