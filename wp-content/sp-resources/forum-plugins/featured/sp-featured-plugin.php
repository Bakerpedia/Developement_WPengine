<?php
/*
Simple:Press Plugin Title: Featured Topics and Posts
Version: 1.0.6
Plugin URI: http://simple-press.com
Description: A Simple:Press plugin for highlighting a list of featured topics or posts
Author: Andy Staines & Steve Klasen
Author URI: http://simple-press.com
Simple:Press Versions: 5.5 and above
$LastChangedDate: 2014-06-07 14:32:19 -0700 (Sat, 07 Jun 2014) $
$Rev: 11528 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# IMPORTANT DB VERSION
define('SPFEATUREDDBVERSION', 0);

define('SPFEATUREDDIR', 		SFPLUGINDIR.'featured/');
define('SPFEATUREDADMINDIR',    SFPLUGINDIR.'featured/admin/');
define('SPFEATUREDAHAHDIR', 	SFPLUGINDIR.'featured/ahah/');
define('SPFEATUREDLIBDIR', 	    SFPLUGINDIR.'featured/library/');
define('SPFEATUREDLIBURL', 	    SFPLUGINURL.'featured/library/');
define('SPFEATUREDCSS', 		SFPLUGINURL.'featured/resources/css/');
define('SPFEATUREDSCRIPT', 	    SFPLUGINURL.'featured/resources/jscript/');
define('SPFEATUREDIMAGES', 	    SFPLUGINURL.'featured/resources/images/');
define('SPFEATUREDTAGS', 	    SFPLUGINDIR.'featured/template-tags/');
define('SPFEATUREDTEMP', 	    SFPLUGINDIR.'featured/template-files/');

add_action('init', 										          'sp_featured_localization');
add_action('sph_activate_featured/sp-featured-plugin.php',        'sp_featured_install');
add_action('sph_deactivate_featured/sp-featured-plugin.php',      'sp_featured_deactivate');
add_action('sph_uninstall_featured/sp-featured-plugin.php',       'sp_featured_uninstall');
add_action('sph_activated', 				                      'sp_featured_sp_activate');
add_action('sph_deactivated', 				                      'sp_featured_sp_deactivate');
add_action('sph_uninstalled', 								      'sp_featured_sp_uninstall');
add_action('sph_plugin_update_featured/sp-featured-plugin.php',   'sp_featured_upgrade_check');
add_action('admin_footer',                                        'sp_featured_upgrade_check');
add_action('sph_permissions_reset', 						      'sp_featured_reset_permissions');
add_action('sph_setup_forum', 							    	  'sp_featured_process_actions');
add_action('sph_admin_menu', 	                                  'sp_featured_menu');

add_filter('sph_plugins_active_buttons',        'sp_featured_uninstall_option', 10, 2);
add_filter('sph_add_post_tool', 	            'sp_featured_post_tool', 10, 9);
add_filter('sph_add_topic_tool', 		        'sp_featured_topic_tool', 10, 4);
add_filter('sph_admin_help-admin-components',   'sp_featured_admin_help', 10, 3);

function sp_featured_menu() {
    $subpanels = array(__('Featured Topics/Posts', 'sp-featured') => array('admin' => 'sp_featured_admin_options', 'save' => 'sp_featured_admin_save_options', 'form' => 1, 'id' => 'featuredopt'));
    sp_add_admin_subpanel('components', $subpanels);
}

function sp_featured_admin_options() {
    include_once(SPFEATUREDADMINDIR.'sp-featured-admin-options.php');
	sp_featured_admin_options_form();
}

function sp_featured_admin_save_options() {
    include_once(SPFEATUREDADMINDIR.'sp-featured-admin-options-save.php');
    return sp_featured_admin_options_save();
}

function sp_featured_admin_help($file, $tag, $lang) {
    if ($tag == '[featured-lists]') $file = SPFEATUREDADMINDIR.'sp-featured-admin-help.'.$lang;
    return $file;
}

function sp_featured_localization() {
	sp_plugin_localisation('sp-featured');
}

function sp_featured_install() {
    include_once(SPFEATUREDDIR.'sp-featured-install.php');
    sp_featured_do_install();
}

function sp_featured_deactivate() {
    include_once(SPFEATUREDDIR.'sp-featured-uninstall.php');
    sp_featured_do_deactivate();
}

function sp_featured_uninstall() {
    include_once(SPFEATUREDDIR.'sp-featured-uninstall.php');
    sp_featured_do_uninstall();
}

function sp_featured_sp_activate() {
	include_once(SPFEATUREDDIR.'sp-featured-install.php');
    sp_featured_do_sp_activate();
}

function sp_featured_sp_deactivate() {
	include_once(SPFEATUREDDIR.'sp-featured-uninstall.php');
    sp_featured_do_sp_deactivate();
}

function sp_featured_sp_uninstall() {
	include_once(SPFEATUREDDIR.'sp-featured-uninstall.php');
    sp_featured_do_sp_uninstall();
}

function sp_featured_upgrade_check() {
    include_once(SPFEATUREDDIR.'sp-featured-upgrade.php');
    sp_featured_do_upgrade_check();
}

function sp_featured_uninstall_option($actionlink, $plugin) {
    include_once(SPFEATUREDDIR.'sp-featured-uninstall.php');
    $actionlink = sp_featured_uninstall_option_links($actionlink, $plugin);
	return $actionlink;
}

function sp_featured_reset_permissions() {
    include_once(SPFEATUREDDIR.'sp-featured-install.php');
    sp_featured_do_reset_permissions();
}

function sp_featured_topic_tool($out, $topic, $forum, $page) {
    include_once(SPFEATUREDLIBDIR.'sp-featured-components.php');
	$out = sp_featured_do_topic_tool($out, $forum, $topic, $page);
    return $out;
}

function sp_featured_post_tool($out, $post, $forum, $topic, $page, $postnum, $useremail, $guestemail, $displayname) {
    include_once(SPFEATUREDLIBDIR.'sp-featured-components.php');
	$out = sp_featured_do_post_tool($out, $forum, $topic, $post, $page, $postnum);
    return $out;
}

function sp_featured_process_actions() {
    include_once(SPFEATUREDLIBDIR.'sp-featured-components.php');
	sp_featured_do_process_actions();
}

# Define Template Tags

function sp_FeaturedTopicsTag($args='') {
    include_once(SPFEATUREDTAGS.'sp-featured-topics-tag.php');
	return sp_do_sp_FeaturedTopicsTag($args);
}

function sp_FeaturedTopicsShortcode($atts) {
    include_once(SPFEATUREDTAGS.'sp-featured-topics-tag.php');
    return sp_do_FeaturedTopicsShortcode($atts);
}
add_shortcode('sp_featured_topics', 'sp_FeaturedTopicsShortcode');

function sp_FeaturedPostsTag($args='') {
    include_once(SPFEATUREDTAGS.'sp-featured-posts-tag.php');
	return sp_do_sp_FeaturedPostsTag($args);
}

function sp_FeaturedPostsShortcode($atts) {
    include_once(SPFEATUREDTAGS.'sp-featured-posts-tag.php');
    return sp_do_FeaturedPostsShortcode($atts);
}
add_shortcode('sp_featured_posts', 'sp_FeaturedPostsShortcode');

?>