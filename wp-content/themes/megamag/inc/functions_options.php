<?php

/* ========================================================================================================================
OPTIONS PAGE
======================================================================================================================== */

	//add admin options page, add submenu
	add_action('admin_menu', 'register_custom_admin_menus');

	function register_custom_admin_menus () {
		global $screen_handle_megamag_menu;	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)
		global $screen_handle_megamag_submenu_homepage;
		global $screen_handle_megamag_submenu_post;
		global $screen_handle_megamag_submenu_appearance;

		$screen_handle_megamag_menu = add_menu_page(
			'The MegaMag Menu', 					//page title (appears in the browser title area / on the tab)
			'MEGAMAG', 								//on screen name of options page (appears in left-hand menu)
			'manage_options', 						//capability (user-level) minimum level for access to this page.
			'handle_megamag_menu',					//handle of this options page
			'display_custom_admin_menu_page', 		//the function / callback that runs the whole admin page
			'',										//optional icon url 16x16px
			200										//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);
		$screen_handle_megamag_submenu_homepage = add_submenu_page(
			'handle_megamag_menu',					//the handle of the parent options page
			'Homepage Settings',					//the submenu title that will appear in browser title area.
			'Homepage',					//the on screen name of the submenu
			'manage_options',						//privileges check
			'handle_megamag_submenu_homepage',		//the handle of this submenu
			'display_megamag_submenu_homepage'		//the callback function to display the actual submenu page content.
		);

		$screen_handle_megamag_submenu_post = add_submenu_page(
			'handle_megamag_menu',					//the handle of the parent options page
			'Post Settings',						//the submenu title that will appear in browser title area.
			'Post',						//the on screen name of the submenu
			'manage_options',						//privileges check
			'handle_megamag_submenu_post',		//the handle of this submenu
			'display_megamag_submenu_post'		//the callback function to display the actual submenu page content.
		);

		$screen_handle_megamag_submenu_appearance = add_submenu_page(
			'handle_megamag_menu',					//the handle of the parent options page
			'Appearance Settings',						//the submenu title that will appear in browser title area.
			'Appearance',						//the on screen name of the submenu
			'manage_options',						//privileges check
			'handle_megamag_submenu_appearance',		//the handle of this submenu
			'display_megamag_submenu_appearance'		//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		global $submenu;	
		$submenu['handle_megamag_menu'][0][0] = "General";

		add_action('load-'.$screen_handle_megamag_menu, 'add_help_megamag_menu');		//when our menu page is loaded (handle_megamag_menu) then it executes the function add_help_megamag_menu
		add_action('load-'.$screen_handle_megamag_submenu_homepage, 'add_help_megamag_submenu_homepage');		
		add_action('load-'.$screen_handle_megamag_submenu_post, 'add_help_megamag_submenu_post');		
		add_action('load-'.$screen_handle_megamag_submenu_appearance, 'add_help_megamag_submenu_appearance');		
	}

	//register setting, add a section and add a field to the main options page
	add_action('admin_init', 'initialize_theme_options');	//when admin_init runs also run the function initialize_theme_options

	function initialize_theme_options () {
		register_setting(
			'group_megamag_options',					//group name. The group for the fields custom_options_group
			'megamag_options',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_input_general'						//optional 3rd param. Callback /function to sanitize and validate
		);

		register_setting(
			'group_megamag_options_hp',					//group name. The group for the fields
			'megamag_options_hp',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_input_hp'						//optional 3rd param. Callback /function to sanitize and validate
		);

		register_setting(
			'group_megamag_options_post',					//group name. The group for the fields
			'megamag_options_post',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_input'						//optional 3rd param. Callback /function to sanitize and validate
		);

		register_setting(
			'group_megamag_options_appearance',					//group name. The group for the fields
			'megamag_options_appearance',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_input'						//optional 3rd param. Callback /function to sanitize and validate
		);

		// add_settings_section(
		// 	'general_settings_section',				//ID / handle of the section created
		// 	'General Theme Settings',				//the title of the section that will be displayed on the options page.
		// 	'general_settings_section_callback',	//a function / callback that gets called when the section is created. You can use this as you would like and also refrain from using it at all.
		// 	'handle_megamag_menu'				//the handle of the menu page to display this section  semi-works if general
		// );

		
		//if this is first runthrough set default values
		if (get_option('megamag_options') == FALSE) {		//trying to get options 'megamag_options' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'header_banner_code' 		=> '',
		 			'show_header_banner' 		=> 'checked',
		 			'logo_img_url' 				=> '',
		 			'favicon_url' 				=> '',
		 			'use_responsive_design'		=> 'checked',
		 			'main_twitter_screen_name' 	=> '',
		 			'main_fb_page' 				=> '',
		 			'main_feedburner_account' 	=> '',
		 			'main_flickr_id' 			=> '',
		 			'google_analytics_code' 	=> '',
		 			'footer_text_left' 			=> 'Copyright &#169; 2012 BOOSTDEVELOPERS. All rights reserved.',
		 			'footer_text_right' 		=> 'Designed by BOOSTDEVELOPERS',
		 			'reset_all' 				=> ''
				);

			update_option('megamag_options', $options);
		}

		if (get_option('megamag_options_hp') == FALSE) {		
		 	$options = array (
		 			'hp_style'				=> 'magazine',
		 			'slider_show' 			=> 'checked',
		 			'slider_style'			=> 'fullwidth1',
		 			'slider_fx'				=> 'random',
		 			'slider_anim_speed'		=> 500,
		 			'slider_pause_time'		=> 3000
				);

			update_option('megamag_options_hp', $options);
		}

		if (get_option('megamag_options_post') == FALSE) {		
		 	$options = array (

		 			'default_check' 		=> 'checked',
		 			'show_featured' 		=> 'checked',
		 			'show_author_info' 		=> 'checked',
		 			'show_tags' 			=> 'checked',
		 			'show_related' 			=> 'checked',
		 			'show_comments' 		=> 'checked',

		 			'share_fb'				=> 'checked',
		 			'share_twitter'			=> 'checked',
		 			'share_pin'				=> 'checked',
		 			'share_google'			=> 'checked',

		 			'review_min' 			=> 1,
		 			'review_max'			=> 10,
		 			'review_increments'		=> 0.5,

		 			'review_label_100'		=> 'Perfect',
		 			'review_label_80'		=> 'Excellent',
		 			'review_label_60'		=> 'Good',
		 			'review_label_40'		=> 'Average',
		 			'review_label_20'		=> 'Bad',
		 			'review_label_0'		=> 'Abysmal'

				);

			update_option('megamag_options_post', $options);
		}

		if (get_option('megamag_options_appearance') == FALSE) {		
		 	$options = array (

		 			'header_style' 			=> 'boxed',
		 			'color_header_bg' 		=> '#000000',
		 			'gradient_header'		=> 'checked',
		 			'color_nav_bg' 			=> '#000000',
		 			'gradient_nav'			=> 'checked',
					'color_nav_text' 		=> '#FFFFFF',
					'nav_text_shadow' 		=> 'dark',
          			'font_main'     		=> array('megamag_default','',''),
          			'font_nav'     			=> array('megamag_default','',''),
          			'font_widget_headings'  => array('megamag_default','',''),
          			'font_post_headings'	=> array('megamag_default','',''),
		 			'color_body_bg' 		=> '#4C4946',
		 			'color_main' 			=> '#FF8604',
		 			'color_rating_bar' 		=> '#FF8604',
		 			'shadow_header'			=> 'checked',
		 			'shadow_nav'			=> 'checked',
		 			'shadow_main'			=> 'checked'
				);

			update_option('megamag_options_appearance', $options);
		}


	}

	//register contextual help

	function add_help_megamag_menu() {					//adds a contextual help menu for the screen with the $custom_admin_menu_screen_handle
		$screen = get_current_screen();

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_general',            		//unique id for the tab
		   'title' => 'General',      						//unique visible title for the tab
			'callback' => 'display_help_general_general'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_accounts',            		//unique id for the tab
		   'title' => 'Accounts',      						//unique visible title for the tab
			'callback' => 'display_help_general_accounts'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_footer',            		//unique id for the tab
		   'title' => 'Footer',      						//unique visible title for the tab
			'callback' => 'display_help_general_footer'			//optional function to callback
		) );
	}

	function add_help_megamag_submenu_homepage() {					//adds a contextual help menu for the screen with the $custom_admin_menu_screen_handle
		$screen = get_current_screen();

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_style',            		//unique id for the tab
		   'title' => 'Style',      						//unique visible title for the tab
			'callback' => 'display_help_hp_style'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_slider',            		//unique id for the tab
		   'title' => 'Slider',      						//unique visible title for the tab
			'callback' => 'display_help_hp_slider'			//optional function to callback
		) );
	}

	function add_help_megamag_submenu_post() {					//adds a contextual help menu for the screen with the $custom_admin_menu_screen_handle
		$screen = get_current_screen();

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_post',            		//unique id for the tab
		   'title' => 'Post',      						//unique visible title for the tab
			'callback' => 'display_help_post'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_share',            		//unique id for the tab
		   'title' => 'Share',      						//unique visible title for the tab
			'callback' => 'display_help_share'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_reviews',            		//unique id for the tab
		   'title' => 'Reviews',      						//unique visible title for the tab
			'callback' => 'display_help_reviews'			//optional function to callback
		) );
	}

	function add_help_megamag_submenu_appearance() {					//adds a contextual help menu for the screen with the $custom_admin_menu_screen_handle
		$screen = get_current_screen();

		$screen->add_help_tab( array( 
		   'id' => 'megamag_help_appearance',            		//unique id for the tab
		   'title' => 'Appearance',      						//unique visible title for the tab
			'callback' => 'display_help_appearance'			//optional function to callback
		) );
	}

	
	//display the menus
	function display_custom_admin_menu_page () {
		require "options_general.php";
	}

	function display_megamag_submenu_homepage () {
		require "options_homepage.php";
	}

	function display_megamag_submenu_post () {
		require "options_post.php";
	}

	function display_megamag_submenu_appearance () {
		require "options_appearance.php";
	}

	//display context help
	function display_help_general_general () {
		require "help/contextual_help_general_general.php";
	}

	function display_help_general_accounts () {
		require "help/contextual_help_general_accounts.php";
	}

	function display_help_general_footer () {
		require "help/contextual_help_general_footer.php";
	}

	function display_help_hp_style () {
		require "help/contextual_help_hp_style.php";
	}

	function display_help_hp_slider () {
		require "help/contextual_help_hp_slider.php";
	}

	function display_help_post () {
		require "help/contextual_help_post.php";
	}

	function display_help_share () {
		require "help/contextual_help_share.php";
	}

	function display_help_reviews () {
		require "help/contextual_help_reviews.php";
	}

	function display_help_appearance () {
		require "help/contextual_help_appearance.php";
	}

	//misc.
	function general_settings_section_callback () {
		echo "MegaMag general settings";			//This message that displays on the options page is optional
	}

	function validate_input ($input) {				//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.
		// $output = array();
		// foreach ($input as $key => $value) {
		// 	$output[$key] = esc_attr( strip_tags( stripslashes( $input[ $key ] ) ) );	
		// }
		return $input;
	}
	
	function validate_input_general ($new_instance) {				

		$old_instance = get_option('megamag_options');
		if ($new_instance['main_fb_page'] != $old_instance['main_fb_page']) delete_transient('facebook_count');
		if ($new_instance['main_twitter_screen_name'] != $old_instance['main_twitter_screen_name']) delete_transient('twitter_count');
		if ($new_instance['main_feedburner_account'] != $old_instance['main_feedburner_account']) delete_transient('rss_count');

		return $new_instance;
	}

	function validate_input_hp ($new_instance) {				

		// if (!empty($new_instance['del_item'])) {
		// 	//delete the slider feature status of selected item
		// 	$del_item_id = $new_instance['del_item'];
		// 	delete_post_meta($del_item_id, 'cmb_slider_feature');
		// }

		return $new_instance;
	}
