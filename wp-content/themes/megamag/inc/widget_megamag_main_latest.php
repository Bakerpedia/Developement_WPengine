					<?php 
						$results_query = get_posts(array(

							'numberposts' 		=> 5,
							'offset' 			=> 0,
							'category'			=> '',
							'orderby'			=> 'post_date',
							'order'				=> 'DESC',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

						include 'template_main_1_column.php';
					?>

