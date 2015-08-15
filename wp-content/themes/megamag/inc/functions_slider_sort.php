<?php
/*************************************************
This function updates the slider order
It is called in these places:
- options_homepage.php
- template_slider.php

It also supplies variables for the rest of those pages ($results_slider_posts and $order_array)

**************************************************/


			//update slider order so it matches cmb_slider_feature posts

			$results_slider_posts = get_posts(array(
				'numberposts'		=> -1,
				'meta_key'			=> 'cmb_slider_feature',
				'meta_value'		=> 'checked',
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
				'post_type'    		=> 'post',
				'post_status'     	=> 'publish',
				'suppress_filters'  => true,
			));

			//init variables
			$slider_array = array();
			$order_array = array();

			//build our two arrays for comparison. First slider_array
			foreach ($results_slider_posts as $slider_post) $slider_array[] = $slider_post->ID;

			//the order_array
			if (!empty($megamag_options_hp['slider_order'])) {
				$order_array = explode (',', $megamag_options_hp['slider_order']);
			} else {
				for ($i = 0; $i < count($results_slider_posts); $i++) {  
					$order_array[$i] = $results_slider_posts[$i]->ID;
				}	
			}

			if (count($slider_array) != count($order_array)) {						//something is up, the two arrays are not same length
				if (count($slider_array) > count($order_array)) {					//posts have been added - update order
					$diff_array = array_diff($slider_array, $order_array);			//array diff nb: the sequence of arrays is important.
					$new_order_array = array_merge($order_array, $diff_array);
					$order_string = "";
					foreach ($new_order_array as $new) {
						$order_string .= $new . ",";
					}
					$order_string = substr($order_string, 0, strlen($order_string)-1);
					echo "posts added";


				} elseif (count($slider_array) < count($order_array)) {				//posts have been removed - update order
					$diff_array = array_diff($order_array, $slider_array);
					$new_order_array = array_diff($order_array, $diff_array);
					$order_string = "";
					foreach ($new_order_array as $new) {
						$order_string .= $new . ",";
					}
					$order_string = substr($order_string, 0, strlen($order_string)-1);
					echo "posts removed";
				}	

				//save and update
				$megamag_options_hp['slider_order']	= $order_string;
				update_option('megamag_options_hp', $megamag_options_hp);
				$megamag_options_hp = get_option('megamag_options_hp'); 

				//and build new order array
				if (!empty($megamag_options_hp['slider_order'])) {
					$order_array = explode (',', $megamag_options_hp['slider_order']);
				} else {
					for ($i = 0; $i < count($results_slider_posts); $i++) {  
						$order_array[$i] = $results_slider_posts[$i]->ID;
					}	
				}
			}

