<?php

/**************************************
INDEX
WIDGET: MAIN: 1-COLUMN: LATEST
WIDGET: MAIN: 2-COLUMN: CATEGORIES
WIDGET: MAIN: 1-COLUMN: CATEGORIES
WIDGET: MAIN: 1-COLUMN: REVIEWS
WIDGET: SIDEBAR: SEARCH
WIDGET: SIDEBAR: BANNER
WIDGET: SIDEBAR: SOCIAL COUNTER
WIDGET: SIDEBAR: TAB
WIDGET: SIDEBAR: FACEBOOK
WIDGET: SIDEBAR: FLICKR
WIDGET: BLOG DESCRIPTION
WIDGET: SMALL LATEST
WIDGET: OFFICIAL TWITTER WIDGET


***************************************/



/**************************************
WIDGET: MAIN: 1-COLUMN: LATEST
***************************************/

	class megamag_main_latest extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: 1-column : Latest Posts',
				'description' 	=> 'Display the latest posts in your main widget area.',


			);

			parent::__construct(
				'megamag_main_latest', 		//the ID or handle of my widget
				'',  				// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 			//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);
			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
			<?php
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_main_latest.php';
		}
	}

	
	add_action('widgets_init', 'register_widget_megamag_main_latest' );
	function register_widget_megamag_main_latest () {
		register_widget('megamag_main_latest');	//all this function does is register the widget for use.
	}



/**************************************
WIDGET: MAIN: 2-COLUMN: CATEGORIES
***************************************/

	class megamag_main_2column extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: 2-column : Categories',
				'description' 	=> 'Display categories in 2 columns in your main widget area.',
			);

			parent::__construct(
				'megamag_main_2column', 		//the ID or handle of my widget
				'',  					//the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			$categories = get_categories(array(
				'orderby' => 'name',
				'order' => 'ASC'
			));

			?>
				<p>
					<i>Leave title empty to use category name as title.</i>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title_left'); ?> ">Left title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title_left'); ?>' name='<?php echo $this->get_field_name('widget_title_left'); ?>' value='<?php if(isset($widget_title_left)) echo $widget_title_left; ?>'>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('left_cat'); ?> ">Left side category: </label> 
					<select id="<?php echo $this->get_field_id('left_cat'); ?>" name="<?php echo $this->get_field_name('left_cat'); ?>"> 
	     			<?php 
	     				foreach ($categories as $single_category) {
	     				?>
	     					<option value="<?php echo $single_category->name; ?>" <?php if (isset($left_cat)) {if ($left_cat == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?></option> 
	     				<?php	     						
	     				}
	     			 ?>
	     			</select>
	     		</p>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title_right'); ?> ">Right title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title_right'); ?>' name='<?php echo $this->get_field_name('widget_title_right'); ?>' value='<?php if(isset($widget_title_right)) echo $widget_title_right; ?>'>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('right_cat'); ?> ">Right side category: </label> 
					<select id="<?php echo $this->get_field_id('right_cat'); ?>" name="<?php echo $this->get_field_name('right_cat'); ?>"> 
	     			<?php 
	     				foreach ($categories as $single_category) {
	     				?>
	     					<option value="<?php echo $single_category->name; ?>" <?php if (isset($right_cat)) {if ($right_cat == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?></option> 
	     				<?php	     						
	     				}
	     			 ?>
	     			</select>
	     		</p>

				<p>
					<label for='<?php echo $this->get_field_id('num_2column_posts'); ?>'>Number of posts: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('num_2column_posts'); ?>' 
						name='<?php echo $this->get_field_name('num_2column_posts'); ?>' 
						value='<?php if (isset($num_2column_posts)) echo esc_attr($num_2column_posts); ?>'
					>
				</p>

			<?php
		
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_main_2column.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_main_2column' );
	function register_widget_megamag_main_2column () {
		register_widget('megamag_main_2column');
	}


/**************************************
WIDGET: MAIN: 1-COLUMN: CATEGORIES
***************************************/

	class megamag_main_category extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: 1-column : Category',
				'description' 	=> 'Display posts from one category in your main widget area.',


			);

			parent::__construct(
				'megamag_main_category', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
				<p>
					<i>Leave title empty to use category name as title.</i>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('category'); ?> ">Select category: </label> 
					<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>"> 
	     			<?php 
	     				$categories = get_categories(array(
	     					'orderby' => 'name',
	     					'order' => 'ASC'
	     				));
	     				foreach ($categories as $single_category) {
	     				?>
	     					<option value="<?php echo $single_category->name; ?>" <?php if (isset($category)) {if ($category == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?></option> 
	     				<?php	     						
	     				}
	     			 ?>

					</select> 
				</p>

			<?php
		
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_main_category.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_main_category' );
	function register_widget_megamag_main_category () {
		register_widget('megamag_main_category');	
	}


/**************************************
WIDGET: MAIN: 1-COLUMN: REVIEWS
***************************************/

	class megamag_main_reviews extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: 1-column : Reviews',
				'description' 	=> 'Display latest reviews in your main widget area.',
			);

			parent::__construct(
				'megamag_main_reviews', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);
			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
			<?php
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_main_reviews.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_main_reviews' );
	function register_widget_megamag_main_reviews () {
		register_widget('megamag_main_reviews');	
	}


/**************************************
WIDGET: SIDEBAR: SEARCH
***************************************/

	class megamag_nomain_sidebar_search extends WP_Widget {

		function __construct () {
			$params = array (
				'name' => 'MEGAMAG: Search',
				'description' => 'A handy search box for all your searching needs.'
			);

			parent::__construct(
				'megamag_nomain_sidebar_search', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form
			include 'widget_megamag_nomain_sidebar_search.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_nomain_sidebar_search' );
	function register_widget_megamag_nomain_sidebar_search () {
		register_widget('megamag_nomain_sidebar_search');	
	}

/**************************************
WIDGET: SIDEBAR: BANNER
***************************************/

	class megamag_nomain_sidebar_banner extends WP_Widget {

		function __construct () {

			$params = array (
				'name'			=> 'MEGAMAG: Banner',
				'description' 	=> 'Displays banner.'
			);
			$control_ops = array('width' => 400, 'height' => 350);

			parent::__construct(
				'megamag_nomain_sidebar_banner', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params, 				//args or parameters to be set.
				$control_ops			//control params
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for='<?php echo $this->get_field_id('content'); ?>'>Banner HTML</label>
					<textarea class='widefat' id='<?php echo $this->get_field_id('content'); ?>' name='<?php echo $this->get_field_name('content'); ?>' rows='15'><?php if (isset($content)) echo esc_attr($content); ?></textarea>

				</P>
				<p>Sidebar widget width: 300 px<br>
				Footer widget width: 220 px</p>

			<?php
		
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_sidebar_banner.php';
		}

	}

	add_action('widgets_init', 'register_widget_megamag_nomain_sidebar_banner' );
	function register_widget_megamag_nomain_sidebar_banner () {
		register_widget('megamag_nomain_sidebar_banner');
	}


/**************************************
WIDGET: SIDEBAR: SOCIAL COUNTER
***************************************/

	class megamag_nomain_sidebar_social_counter extends WP_Widget {

		function __construct () {
			$params = array (
				'name' 			=> 'MEGAMAG: Social Counter',
				'description' 	=> 'Displays the social counter.',
			);
			parent::__construct(
				'megamag_nomain_sidebar_social_counter', 		//the ID or handle of my widget
				'',  							// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 						//args or parameters to be set.
			);

		}

		function form($instance) {
			extract($instance);

			$megamag_options_post = get_option('megamag_options_post');
			if (!empty($megamag_options_post['oauth_access_token']['screen_name'])) {
				$screen_name = 	$megamag_options_post['oauth_access_token']['screen_name'];
			}


			?>
				<p>
					<label for='<?php echo $this->get_field_id('facebook_page'); ?>'>Facebook page: <i>(example: envato)</i></label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('facebook_page'); ?>' name='<?php echo $this->get_field_name('facebook_page'); ?>' value='<?php if (isset($facebook_page)) echo esc_attr($facebook_page); ?>'>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('twitter_screen_name'); ?>'>Twitter screen name:</label>
					<?php 
						if (!empty($megamag_options_post['oauth_access_token']['screen_name'])) {
						?>
							<input readonly class='widefat' type='text' id='<?php echo $this->get_field_id('twitter_screen_name'); ?>' name='<?php echo $this->get_field_name('twitter_screen_name'); ?>' value='<?php if (isset($screen_name)) echo esc_attr($screen_name); ?>'>
						<?php		
						} else {
							echo "<br>";
							echo "<i>Go to MegaMag Settings > Post > Twitter OAuth to authorize access to your twitter account</i>";
						}


					?>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('feedburner_account'); ?>'>Feedburner account: <i>(example: envato)</i></label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('feedburner_account'); ?>' name='<?php echo $this->get_field_name('feedburner_account'); ?>' value='<?php if (isset($feedburner_account)) echo esc_attr($feedburner_account); ?>'>
				</p>
			<?php
		}

		// transients are erased if the names are changed
		function update($new_instance, $old_instance) {
			if ($new_instance['facebook_page'] != $old_instance['facebook_page']) delete_transient('facebook_count');
			if ($new_instance['twitter_screen_name'] != $old_instance['twitter_screen_name']) delete_transient('twitter_count');
			if ($new_instance['feedburner_account'] != $old_instance['feedburner_account']) delete_transient('rss_count');

			return $new_instance;	 
		}
		
		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_sidebar_social_counter.php';
		}

	}

	add_action('widgets_init', 'register_widget_megamag_nomain_sidebar_social_counter' );
	function register_widget_megamag_nomain_sidebar_social_counter () {
		register_widget('megamag_nomain_sidebar_social_counter');	
	}


/**************************************
WIDGET: SIDEBAR: TAB
***************************************/

	class megamag_nomain_sidebar_tab extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: Tab',
				'description' 	=> 'Displays tabs for popular posts, comments and tags.',
			);

			parent::__construct(
				'megamag_nomain_sidebar_tab', 		//the ID or handle of my widget
				'',  				// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 			//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('popular_by'); ?> "></label> 
					<select id="<?php echo $this->get_field_id('popular_by'); ?>" name="<?php echo $this->get_field_name('popular_by'); ?>"> 
	     			<option value="views" <?php if (isset($popular_by)) {if ($popular_by == "views") echo "selected='selected'";} ?>>Popular by most views</option> 
	     			<option value="comments" <?php if (isset($popular_by)) {if ($popular_by == "comments") echo "selected='selected'";} ?>>Popular by most comments</option> 
					</select> 
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('tab_num_popular'); ?>'>Number of popular posts: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('tab_num_popular'); ?>' 
						name='<?php echo $this->get_field_name('tab_num_popular'); ?>' 
						value='<?php if (isset($tab_num_popular)) echo esc_attr($tab_num_popular); ?>'
					>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('tab_num_comments'); ?>'>Number of comments: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('tab_num_comments'); ?>' 
						name='<?php echo $this->get_field_name('tab_num_comments'); ?>' 
						value='<?php if (isset($tab_num_comments)) echo esc_attr($tab_num_comments); ?>'
					>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('tags_as'); ?> "></label> 
					<select id="<?php echo $this->get_field_id('tags_as'); ?>" name="<?php echo $this->get_field_name('tags_as'); ?>"> 
	     			<option value="list_alphabetically" <?php if (isset($tags_as)) {if ($tags_as == "list_alphabetically") echo "selected='selected'";} ?>>View tags as list (alphabetically)</option> 
	     			<option value="list_popular" <?php if (isset($tags_as)) {if ($tags_as == "list_popular") echo "selected='selected'";} ?>>View tags as list (most popular)</option> 
	     			<option value="cloud" <?php if (isset($tags_as)) {if ($tags_as == "cloud") echo "selected='selected'";} ?>>View tags as cloud</option> 
					</select> 
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('tab_num_tags'); ?>'>Number of tags: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='100'
						id='<?php echo $this->get_field_id('tab_num_tags'); ?>' 
						name='<?php echo $this->get_field_name('tab_num_tags'); ?>' 
						value='<?php if (isset($tab_num_tags)) echo esc_attr($tab_num_tags); ?>'
					>
				</p>

			<?php
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form
			include 'widget_megamag_nomain_sidebar_tab.php';
		}
	}

	
	add_action('widgets_init', 'register_widget_megamag_nomain_sidebar_tab' );
	function register_widget_megamag_nomain_sidebar_tab () {
		register_widget('megamag_nomain_sidebar_tab');	
	}


/**************************************
WIDGET: SIDEBAR: FACEBOOK
***************************************/

	class megamag_nomain_sidebar_facebook extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: Facebook Like (Sidebar only)',
				'description' 	=> 'Displays Facebook like box',


			);

			parent::__construct(
				'megamag_nomain_sidebar_facebook', 		//the ID or handle of my widget
				'',  				// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 			//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
				<p>
					<label for='<?php echo $this->get_field_id('fb_like_page'); ?>'>Facebook Page: <i>(example: envato)</i> </label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('fb_like_page'); ?>' name='<?php echo $this->get_field_name('fb_like_page'); ?>' value='<?php if (isset($fb_like_page)) echo esc_attr($fb_like_page); ?>'>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_faces' ); ?>" name="<?php echo $this->get_field_name( 'fb_faces' ); ?>" value="checked" <?php checked(isset($fb_faces)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_faces' ); ?>">Show faces?</label>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_wall' ); ?>" name="<?php echo $this->get_field_name( 'fb_wall' ); ?>" value="checked" <?php checked(isset($fb_wall)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_wall' ); ?>">Show wall?</label>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_header' ); ?>" name="<?php echo $this->get_field_name( 'fb_header' ); ?>" value="checked" <?php checked(isset($fb_header)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_header' ); ?>">Show header?</label>
				</p>
			<?php
		
		}


		function update($new_instance, $old_instance) {
		    // $instance = $old_instance;  
		    // /* Strip tags for title and name to remove HTML (important for text inputs). */  
		    // $instance['title'] = strip_tags( $new_instance['title'] );  
		    // $instance['app_id'] = strip_tags( $new_instance['app_id'] );  
		    // $instance['page_name'] = strip_tags( $new_instance['page_name'] );  
		    // $instance['width'] = strip_tags( $new_instance['width'] );  
		    // $instance['show_faces'] = (bool)$new_instance['show_faces'];  
		    // $instance['show_stream'] = (bool)$new_instance['show_stream'];  
		    // $instance['show_header'] = (bool)$new_instance['show_header'];  
		    return $new_instance;  
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form
			include 'widget_megamag_nomain_sidebar_facebook.php';
		}

	}

	add_action('widgets_init', 'register_widget_megamag_nomain_sidebar_facebook' );
	function register_widget_megamag_nomain_sidebar_facebook () {
		register_widget('megamag_nomain_sidebar_facebook');	
	}



/**************************************
WIDGET: FLICKR
***************************************/


	class megamag_nomain_flickr extends WP_Widget {

		function __construct () {

			$params = array (
				'name'			=> 'MEGAMAG: Flickr Photo Stream',
				'description' 	=> 'Displays a photo stream from Flickr',
			);

			parent::__construct(
				'megamag_nomain_flickr', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
				<p>
					<label for='<?php echo $this->get_field_id('flickr_id'); ?>'>Flickr user ID (<a href='' target='_blank'>http://idgettr.com/</a>) : </label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('flickr_id'); ?>' name='<?php echo $this->get_field_name('flickr_id'); ?>' value='<?php if (isset($flickr_id)) echo esc_attr($flickr_id); ?>'>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('flickr_num'); ?>'>Number of pictures: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('flickr_num'); ?>' 
						name='<?php echo $this->get_field_name('flickr_num'); ?>' 
						value='<?php if (isset($flickr_num)) echo esc_attr($flickr_num); ?>'
					>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('flickr_show'); ?> ">Show: </label> 
					<select id="<?php echo $this->get_field_id('flickr_show'); ?>" name="<?php echo $this->get_field_name('flickr_show'); ?>"> 
	     			<option value="latest" <?php if (isset($flickr_show)) {if ($flickr_show == "latest") echo "selected='selected'";} ?>>Latest</option> 
	     			<option value="random" <?php if (isset($flickr_show)) {if ($flickr_show == "random") echo "selected='selected'";} ?>>Random</option> 
					</select> 
				</p>
			<?php
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_flickr.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_nomain_flickr' );
	function register_widget_megamag_nomain_flickr () {
		register_widget('megamag_nomain_flickr');	
	}



/**************************************
WIDGET: BLOG DESCRIPTION
***************************************/

	class megamag_nomain_blog_description extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: Blog Description',
				'description' 	=> 'Displays the blog description.',
			);

			parent::__construct(
				'megamag_nomain_blog_description', 		//the ID or handle of my widget
				'',  						// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 					//args or parameters to be set.
			);
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_blog_description.php';
		}

	}

	add_action('widgets_init', 'register_widget_megamag_nomain_blog_description' );
	function register_widget_megamag_nomain_blog_description () {
		register_widget('megamag_nomain_blog_description');	
	}


/**************************************
WIDGET: SMALL LATEST
***************************************/

	class megamag_nomain_small_latest extends WP_Widget {

		function __construct () {

			$params = array (
				'name' 			=> 'MEGAMAG: Latest Posts',
				'description' 	=> 'Displays the latest blog posts.',


			);

			parent::__construct(
				'megamag_nomain_small_latest', 		//the ID or handle of my widget
				'',  				// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 			//args or parameters to be set.
			);
		}

		function form($instance) {
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id('small_latest_show'); ?> ">Show: </label> 
					<select id="<?php echo $this->get_field_id('small_latest_show'); ?>" name="<?php echo $this->get_field_name('small_latest_show'); ?>"> 
	     				<option value="latest" <?php if (isset($small_latest_show)) {if ($small_latest_show == "latest") echo "selected='selected'";} ?>>Latest posts</option> 
	     				<option value="reviews" <?php if (isset($small_latest_show)) {if ($small_latest_show == "reviews") echo "selected='selected'";} ?>>Latest reviews</option> 
	     				<option value="highest rated reviews" <?php if (isset($small_latest_show)) {if ($small_latest_show == "highest rated reviews") echo "selected='selected'";} ?>>Higest rated reviews</option> 
	     				<option value="lowest rated reviews" <?php if (isset($small_latest_show)) {if ($small_latest_show == "lowest rated reviews") echo "selected='selected'";} ?>>Lowest rated reviews</option> 
						<?php 
							$categories = get_categories(array(
								'orderby' => 'name',
								'order' => 'ASC'
							));
							foreach ($categories as $single_category) {
							?>
								<option value="<?php echo $single_category->name; ?>" <?php if (isset($small_latest_show)) {if ($small_latest_show == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?></option> 
							<?php	     						
							}
						 ?>

	     			</select>
	     		</p>

				<p>
					<label for='<?php echo $this->get_field_id('small_latest_num'); ?>'>Number of posts: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('small_latest_num'); ?>' 
						name='<?php echo $this->get_field_name('small_latest_num'); ?>' 
						value='<?php if (isset($small_latest_num)) echo esc_attr($small_latest_num); ?>'
					>
				</p>
				
			<?php
		
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_small_latest.php';
		}

	}

	add_action('widgets_init', 'register_widget_megamag_nomain_small_latest' );
	function register_widget_megamag_nomain_small_latest () {
		register_widget('megamag_nomain_small_latest');	
	}



/**************************************
WIDGET: OFFICIAL TWITTER WIDGET
***************************************/

	class megamag_nomain_twitter_widget extends WP_Widget {

		function __construct () {

			$params = array (
				'classname' => 'megamag_sidebar_twitter_via_widget', 								
				'name' 			=> 'MEGAMAG: Official Twitter widget',
				'description' 	=> 'Displays tweets using the official Twitter widget.',
			);

			parent::__construct(
				'megamag_nomain_twitter_widget', 		//the ID or handle of my widget
				'',  					// the spoken name of the widget. This comes via the $params so no need to put it in here also, but you could.
				$params 				//args or parameters to be set.
			);
		}

		function form($instance) {
			//default for checkboxes
			if (empty($instance)) {
				$defaults_checkboxes = array(
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 			=> 'Latest tweets',
				'twitter_num_tweets' 	=> 3
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			extract($instance);

			?>
				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('twitter_widget_code'); ?>'>Twitter widget code: </label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('twitter_widget_code'); ?>' name='<?php echo $this->get_field_name('twitter_widget_code'); ?>' rows='10'><?php if (isset($twitter_widget_code)) echo esc_attr($twitter_widget_code); ?></textarea>
					Generate you own widget code here: <a href='https://twitter.com/settings/widgets' target='_blank'>https://twitter.com/settings/widgets/</a>
				</P>

				<br><hr><br>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'use_megamag_design' ); ?>" name="<?php echo $this->get_field_name( 'use_megamag_design' ); ?>" value="checked" <?php checked(isset($use_megamag_design)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'use_megamag_design' ); ?>">Use MEGAMAG design instead?</label>
				</p>


				<p>
					<label for='<?php echo $this->get_field_id('twitter_num_tweets'); ?>'>Number of tweets: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('twitter_num_tweets'); ?>' 
						name='<?php echo $this->get_field_name('twitter_num_tweets'); ?>' 
						value='<?php if (isset($twitter_num_tweets)) echo esc_attr($twitter_num_tweets); ?>'
					>
				</p>

			<?php
		
		}

		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		function widget($args, $instance) {
			extract($args);			//widget setup args like $args[before_widget] etc.
			extract($instance);		//the variables passed from our form

			include 'widget_megamag_nomain_twitter_widget.php';
		}
	}

	add_action('widgets_init', 'register_widget_megamag_nomain_twitter_widget' );
	function register_widget_megamag_nomain_twitter_widget () {
		register_widget('megamag_nomain_twitter_widget');	
	}
