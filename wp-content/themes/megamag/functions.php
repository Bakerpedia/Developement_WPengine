<?php


/**************************************
INDEX

INCLUDES
ADD_THEME_SUPPORT CALLS
ADD JAVASCRIPT TO ADMIN PAGE
WORDPRESS MISC
UPLOAD CALL
LOAD TINYMCE PLUGINS

***************************************/





/**************************************
INCLUDES
***************************************/

include 'inc/functions_widgets.php';
include 'inc/functions_backend.php';
include 'inc/functions_options.php';
include 'inc/functions_custom.php';
include 'inc/functions_cmb.php';
include 'inc/shortcodes.php';
include 'inc/functions_google_webfonts.php';
include 'inc/libs/twitteroauth/twitteroauth/twitteroauth.php';


/**************************************
ADD_THEME_SUPPORT CALLS
***************************************/


	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array('gallery', 'video', 'audio') );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );


/**************************************
ADD JAVASCRIPT TO ADMIN PAGE
***************************************/


add_action('admin_enqueue_scripts', 'megamag_load_to_admin') ;  //works with admin_head action
function megamag_load_to_admin() {
	//scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');

	wp_enqueue_script('megamag_script', get_template_directory_uri(). '/js/colorpicker.js');
	
	//editv1m3r1m moved from hook admin_footer both lines
	wp_enqueue_script('backend_script', get_template_directory_uri(). '/js/backend_scripts.js');
	wp_localize_script('backend_script','extData', array('ajaxUrl' => admin_url('admin-ajax.php')));        
	
	//style
	wp_enqueue_style('thickbox');
	wp_enqueue_style('color-picker', get_template_directory_uri(). '/css/colorpicker.css');
	wp_enqueue_style('jquery-ui', get_template_directory_uri(). '/css/jquery-ui.css');
	wp_enqueue_style('admin_style', get_template_directory_uri(). '/css/admin.css');

	//localize script
	//if (get_current_screen()->id == 'megamag_page_handle_megamag_submenu_appearance') wp_localize_script('backend_script','extDataFonts', array('fonts' => mb_get_google_webfonts_from_file(get_template_directory_uri() . '/inc/webfonts')));        
	if (get_current_screen()->id == 'megamag_page_handle_megamag_submenu_appearance') wp_localize_script('backend_script','extDataFonts', array('fonts' => mb_get_google_webfonts()));        

}

add_action('admin_footer', 'megamag_load_to_admin_footer');
function megamag_load_to_admin_footer () {
}


/**************************************
WORDPRESS MISC
***************************************/

	//addbymb 19112012 to conform with Theme Check standards
	if ( ! isset( $content_width ) ) $content_width = 610;

	//////////////////////////////////////////////////////////////////
	// Fix Shortcode Empty Paragraphs (Autoformatting)
	//////////////////////////////////////////////////////////////////

	add_filter('the_content', 'shortcode_empty_paragraph_fix');

    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );

        $content = strtr($content, $array);

        return $content;
    }

	//get rid of relational links prefetching (interfering with view counts)
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	//register new menu
	register_nav_menus(
		array (
			'navigation' => 'Navigation'
		)
	); 

	//image sizes
	add_image_size( 'related_thumb', 136, 90, true);
	add_image_size( 'archive_thumb', 270, 180, true); 
	add_image_size( 'big_thumb', 295, 195, true); 
	add_image_size( 'small_thumb', 70, 70, true); 
	add_image_size( 'flickr_thumb', 66, 66, true); 
	add_image_size( 'slider_big', 502, 350, true); 
	add_image_size( 'slider_small', 96, 69, true); 
	add_image_size( 'slider_full_width', 940, 360, true); 
	add_image_size( 'slider_sort', 70, 50, true); 


	//register widgets area: sidebar widgets area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "sidebar_widget_area",
		    'name' => 'Sidebar Widget Area',  
		    'before_widget' => '<div class="widget">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h1>',  
		    'after_title' => '</h1>',  
		)); 
	 }


	//register widgets area: main widgets area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "main_widget_area",
		    'name' => 'Main Widget Area',  
		    'before_widget' => '',  
		    'after_widget' => '',  
		    'before_title' => '',  
		    'after_title' => '',  
		)); 
	 }


	//register widgets area: footer1 area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "footer_1_area",
		    'name' => 'Footer 1st Area',  
		    'before_widget' => '<div class="widget">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h1>',  
		    'after_title' => '</h1>', 
		)); 
	 }


	//register widgets area: footer2 area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "footer_2_area",
		    'name' => 'Footer 2nd Area',  
		    'before_widget' => '<div class="widget">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h1>',  
		    'after_title' => '</h1>',
		)); 
	 }


	//register widgets area: footer3 area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "footer_3_area",
		    'name' => 'Footer 3rd Area',  
		    'before_widget' => '<div class="widget">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h1>',  
		    'after_title' => '</h1>',
		)); 
	 }


	//register widgets area: footer4 area
	if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(  
	    	'id' => "footer_4_area",
		    'name' => 'Footer 4th Area',  
		    'before_widget' => '<div class="widget">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h1>',  
		    'after_title' => '</h1>',  
		)); 
	 }


	//add facebook javascript
	add_action('wp_footer', 'add_facebook_js');  

	function add_facebook_js () {
		?>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		</script>
		<?php
	}

	//add admin notices
	add_action('admin_notices','megamag_admin_notice_context_help');

	function megamag_admin_notice_context_help () {
		if (!isset($_GET['page'])) return;
		global $pagenow;
		global $current_user;
		if (isset($_GET['dismiss_megamag_notice'])) {
			add_user_meta($current_user->ID,'dismiss_' . $_GET['page'], 'true', true);
		}
		$current_page_dismiss_info = get_user_meta($current_user->ID, 'dismiss_' . $_GET['page'], true);
		if (($_GET['page']=='handle_megamag_menu' && empty($current_page_dismiss_info)) ||
			($_GET['page']=='handle_megamag_submenu_homepage' && empty($current_page_dismiss_info)) ||
			($_GET['page']=='handle_megamag_submenu_post' && empty($current_page_dismiss_info)) ||
			($_GET['page']=='handle_megamag_submenu_appearance' && empty($current_page_dismiss_info)) 
			) {
			?>
			
			<div class='updated'><br>This page has contextual help. Use the pulldown menu in the upper right-hand corner of the page to acces the help menu or click the small arrow next to each menu item for pop-out help.<a href='?<?php echo $_SERVER['QUERY_STRING']; ?>&dismiss_megamag_notice=true'> (dismiss)</a><br><br></div>
			
			<?php
		}
	}


	//comments
	function megamag_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="comment">
				<?php echo get_avatar($comment,$size='60'); ?>
							
				<div class="arrow"></div>
				<div class="comment-content">
					<div class="comment-meta">
						<span class="author"><?php comment_author(); ?></span>
						<span class="date"><?php comment_date(get_option('date_format') . ' \a\t ' . get_option('time_format')); ?></span>
						<span class="reply">
							<?php edit_comment_link(__('Edit', 'lcz_megamag')); ?>
							<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'lcz_megamag'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
						</span>
					</div>
					<div class="comment-text">
						<?php if ($comment->comment_approved == '0') : ?>
							<em><?php _e('Popular', 'lcz_megamag'); ?></em>
							<br />
							<?php endif; ?>
						<?php comment_text(); ?>
					</div>
				</div>
							
			</div>
			
		</li>

		<?php 
	}

	//add localization
	add_action('after_setup_theme', 'localization_setup');
	function localization_setup() {
		$lang_dir = get_template_directory() . '/lang';  
		load_theme_textdomain('lcz_megamag', $lang_dir);
	} 




/****************************
CUSTOM UPLOAD
****************************/

//upload header replacement img button text filter
add_action( 'admin_init', 'check_upload_page4' );
function check_upload_page4() {
	global $pagenow;
	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter( 'gettext', 'replace_thickbox_text4'  , 1, 3 );
	}
}

function replace_thickbox_text4($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'megamag_header_replacement_img' );
		if ( $referer != '' ) {
			return 'Use as header replacement';
		}
	}
	return $translated_text;
}

//upload logo button text filter
add_action( 'admin_init', 'check_upload_page' );
function check_upload_page() {
	global $pagenow;
	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
	}
}

function replace_thickbox_text($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'megamag_settings' );
		if ( $referer != '' ) {
			return 'Use as logo';
		}
	}
	return $translated_text;
}

//upload favicon button text filter
add_action( 'admin_init', 'check_upload_page2' );
function check_upload_page2() {
	global $pagenow;
	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter( 'gettext', 'replace_thickbox_text2'  , 1, 3 );
	}
}

function replace_thickbox_text2($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'megamag_favicon' );
		if ( $referer != '' ) {
			return 'Use as favicon';
		}
	}
	return $translated_text;
}

//upload custom background button text filter
add_action( 'admin_init', 'check_upload_page3' );
function check_upload_page3() {
	global $pagenow;
	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter( 'gettext', 'replace_thickbox_text3'  , 1, 3 );
	}
}

function replace_thickbox_text3($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'megamag_bg' );
		if ( $referer != '' ) {
			return 'Use as custom background';
		}
	}
	return $translated_text;
}


/****************************
LOAD TINYMCE PLUGINS
****************************/

	// init process for button control
	add_action('init', 'sc_addbuttons');

	function sc_addbuttons() {
	add_filter('mce_buttons_2', 'my_mce_buttons_2');
	   // Don't bother doing this stuff if the current user lacks permissions
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
	     return;
	 
	   // Add only in Rich Editor mode
	   if ( get_user_option('rich_editing') == 'true') {
	     add_filter("mce_external_plugins", "sc_add_tinymce_plugin");
	     add_filter('mce_buttons_3', 'sc_register_button');
	   }
	}
	 
	function sc_register_button($buttons) {
	   array_push($buttons, "shortcodeselect"); //"seperator" will make a short space between buttons
	   return $buttons;
	}
	 
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function sc_add_tinymce_plugin($plugin_array) {
	   $plugin_array['shortcodeselect'] = get_template_directory_uri().'/js/tinymce_scripts.js.php';
	   return $plugin_array;
	}
	
	function my_mce_buttons_2($buttons) {	
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
	}
	
	function posts_for_current_author($query) {
	global $user_level;

	if($query->is_admin && $user_level < 5) {
		global $user_ID;
		$query->set('author',  $user_ID);
		unset($user_ID);
	}
	unset($user_level);

	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');


