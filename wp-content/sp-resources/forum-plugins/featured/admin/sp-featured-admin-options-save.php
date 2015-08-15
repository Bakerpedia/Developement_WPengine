<?php
/*
Simple:Press
Featured Topics and Posts Plugin Admin Options Save Routine
$LastChangedDate: 2013-02-17 11:52:14 -0800 (Sun, 17 Feb 2013) $
$Rev: 9854 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_featured_admin_options_save() {
	check_admin_referer('forum-adminform_userplugin', 'forum-adminform_userplugin');

	# Save options
	$topics = sp_filter_title_save(trim($_POST['topic_list']));
    $topics = explode(',', $topics);
    sp_add_sfmeta('featured', 'topics', $topics, true);

	$posts = sp_filter_title_save(trim($_POST['post_list']));
    $posts = explode(',', $posts);
    sp_add_sfmeta('featured', 'posts', $posts, true);

	$out = __('Featured topics and posts options updated', 'sp-featured');
	return $out;
}
?>