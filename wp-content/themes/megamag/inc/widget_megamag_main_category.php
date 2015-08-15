					<?php 

						//defaults
						$default_cat = get_categories(array(
							'orderby' => 'name',
							'order' => 'ASC',
							'number' => 1
						));
						if (empty($category)) $category = $default_cat[0]->name;
						$num_posts = 5;

						$results_query = get_posts(array(
							'numberposts' 		=> $num_posts,
							'offset' 			=> 0,
							'category'			=> get_cat_ID($category),
							'orderby'			=> 'post_date',
							'order'				=> 'DESC',
							'post_type'    		=> 'post',
							'post_status'     	=> 'publish',
							'suppress_filters' => true
						));

						if (empty($widget_title)) {
							$widget_title = "<a href='". get_category_link(get_cat_ID($category)) . "'>" . $category . "</a>";
						} else {
							$widget_title = "<a href='". get_category_link(get_cat_ID($category)) . "'>" . $widget_title . "</a>";
						}
						
						include 'template_main_1_column.php';

					?>