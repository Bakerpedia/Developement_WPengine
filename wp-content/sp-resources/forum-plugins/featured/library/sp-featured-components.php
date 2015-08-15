<?php
/*
Simple:Press
Featured Topics and Posts Plugin Support Routines
$LastChangedDate: 2013-08-23 12:55:44 -0700 (Fri, 23 Aug 2013) $
$Rev: 10569 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_featured_do_topic_tool($out, $forum, $topic, $page) {
    global $spThisUser, $spGlobals;
	if ($spThisUser->admin || $spThisUser->moderator) {
		$out.= '<div class="spForumToolsFeatured">';
		$out.= '<img class="spIcon" src="'.sp_find_icon(SPFEATUREDIMAGES, 'sp_ToolsFeaturedAdd.png').'" alt="" title="" />';
        $featured = in_array($topic['topic_id'], $spGlobals['featured']['topics']);
		$featuretext = ($featured) ? __('Unfeature this topic', 'sp-featured') : __('Feature this topic', 'sp-featured');
		$featureaction = ($featured) ? 'remove' : 'add';
		$out.= '<a href="javascript:document.featuretopic'.$topic['topic_id'].'.submit();">'.$featuretext.'</a>';
		$out.= '<form action="'.sp_build_url($forum['forum_slug'], '', $page, 0).'" method="post" name="featuretopic'.$topic['topic_id'].'">';
		$out.= '<input type="hidden" name="featuretopic" value="'.$topic['topic_id'].'" />';
		$out.= "<input type='hidden' name='featuretopicaction' value='$featureaction' />";
		$out.= '</form>';
		$out.= '</div>';
	}
    return $out;
}

function sp_featured_do_post_tool($out, $forum, $topic, $post, $page, $postnum) {
    global $spThisUser, $spGlobals;
	if ($spThisUser->admin || $spThisUser->moderator) {
		$out.= '<div class="spTopicToolsFeatured">';
		$out.= '<img class="spIcon" src="'.sp_find_icon(SPFEATUREDIMAGES, 'sp_ToolsFeaturedAdd.png').'" alt="" title="" />';
        $featured = in_array($post['post_id'], $spGlobals['featured']['posts']);
		$featuretext = ($featured) ? __('Unfeature this post', 'sp-featured') : __('Feature this post', 'sp-featured');
		$featureaction = ($featured) ? 'remove' : 'add';
		$out.= '<a href="javascript:document.featurepost'.$post['post_id'].'.submit();">'.$featuretext.'</a>';
		$out.= '<form action="'.sp_build_url($forum['forum_slug'], $topic['topic_slug'], $page, 0).'" method="post" name="featurepost'.$post['post_id'].'">';
		$out.= '<input type="hidden" name="featurepost" value="'.$post['post_id'].'" />';
		$out.= "<input type='hidden' name='featurepostaction' value='$featureaction' />";
		$out.= '</form>';
		$out.= '</div>';
	}
    return $out;
}

function sp_featured_do_process_actions() {
	global $spThisUser, $spGlobals;

    # only admins and mods
    if (!$spThisUser->admin && !$spThisUser->moderator) return;

    if (isset($_POST['featuretopic']) && !empty($_POST['featuretopicaction'])) {
        $topic = sp_esc_int($_POST['featuretopic']);
        $featured = $spGlobals['featured']['topics'];
        if ($_POST['featuretopicaction'] == 'add') {
            $featured[] = $topic;
            $featured = array_unique($featured);
        } else {
            $key = array_search($topic, $featured);
            if ($key !== false) unset($featured[$key]);
        }
        sp_add_sfmeta('featured', 'topics', $featured, true);
        $spGlobals['featured']['topics'] = $featured;
    }

    if (isset($_POST['featurepost']) && !empty($_POST['featurepostaction'])) {
        $post = sp_esc_int($_POST['featurepost']);
        $featured = $spGlobals['featured']['posts'];
        if ($_POST['featurepostaction'] == 'add') {
            $featured[] = $post;
            $featured = array_unique($featured);
        } else {
            $key = array_search($post, $featured);
            if ($key !== false) unset($featured[$key]);
        }
        sp_add_sfmeta('featured', 'posts', $featured, true);
        $spGlobals['featured']['posts'] = $featured;
    }
}
?>