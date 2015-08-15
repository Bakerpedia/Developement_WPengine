<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	=====================================================================================
	displays hottest topics on the forum

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------------
		tagId			unique id to use for div or list		text			spRecentPostsTag
		tagClass		class to be applied for styling			text			spListTag
		listClass		class to be applied to list item style	text			spListItemTag
		textClass		class to be applied to text labels		text			spTextTag
		listTags		Wrap in <ul> and <li> tags				int       		1
						- If false a div will be used
		forumIds		comma delimited list of forum id's		optional		0
						to include in hot topics
		limit			How many topics to show in the list		int  			5
		showForum		show the forum name     				int    			1
		textForum		text preceeding forum name				text	   		see below
		showCount		see note below for usage				int		  	    1
		textCount		text to use for $ of posts				text			see below
		showHotness		see note below for usage				int			    1
		textHotness		text to use for hotness score			text			see below
		echo			echo content or return content			int   		    1
 	===================================================================================*/
function sp_do_sp_HotTopicsTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	global $spThisUser;

	$defs = array('tagId'    	=> 'spHotTopicsTag',
				  'tagClass' 	=> 'spHotTopicsTag',
				  'listClass'	=> 'spListItemTag',
				  'textClass'	=> 'spHotTopicTextTag',
				  'listTags'	=> 1,
				  'forumIds'	=> 0,
				  'limit'		=> 5,
				  'days'		=> 30,
				  'showForum'	=> 1,
				  'textForum'	=> __('posted in', 'sp-ttags'),
				  'showCount'	=> 1,
				  'textCount'	=> __('recent posts', 'sp-ttags'),
				  'showHotness'	=> 1,
				  'textHotness'	=> __('hotness', 'sp-ttags'),
				  'echo'		=> 1
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_HotTopicsTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$tagId			= esc_attr($tagId);
	$tagClass		= esc_attr($tagClass);
	$listClass		= esc_attr($listClass);
	$textClass		= esc_attr($textClass);
	$listTags		= (int) $listTags;
	$forumIds		= sp_filter_title_display($forumIds);
	$limit			= (int) $limit;
	$days			= (int) $days;
	$showForum		= (int) $showForum;
	$textForum	    = sp_filter_title_display($textForum);
	$showCount		= (int) $showCount;
	$textCount	    = sp_filter_title_display($textCount);
	$showHotness	= (int) $showHotness;
	$textHotness	= sp_filter_title_display($textHotness);
	$echo			= (int) $echo;

	sp_forum_api_support();

	$forumList = '';
	if (!empty($forumIds)) { # are we passing forum ID's?
		$flist = explode(',', $forumIds);
		foreach ($flist as $id) {
            if (sp_can_view($id, 'topic-title')) $forumList[] = $id;
		}
	} else {
    	global $spThisUser;
		$allForums = sp_get_forum_memberships($spThisUser->ID);
		if ($allForums) {
			foreach ($allForums as $id) {
                if (sp_can_view($id, 'topic-title')) $forumList[] = $id;
			}
		}
	}
    if (!empty($forumList)) {
		$where = ' AND '.SFPOSTS.'.forum_id IN ('.implode(',', $forumList).')';
    } else {
        return '';
    }

	# get any posts that meeet date criteria
	$spdb = new spdbComplex;
	$spdb->table  = SFPOSTS;
	$spdb->fields = SFPOSTS.'.topic_id, DATEDIFF(CURDATE(), post_date) AS delta, '.SFPOSTS.'.forum_id, forum_name, forum_slug, forum_slug, topic_name, topic_slug';
	$spdb->join	  = array(SFTOPICS.' ON '.SFTOPICS.'.topic_id = '.SFPOSTS.'.topic_id',
				  		  SFFORUMS.' ON '.SFFORUMS.'.forum_id = '.SFPOSTS.'.forum_id');
	$spdb->where  = 'DATE_SUB(CURDATE(),INTERVAL '.$days.' DAY) <= post_date'.$where;
	$spdb = apply_filters('sph_HotTopicsTagQuery', $spdb);
	$posts = $spdb->select();

    $out = '';
	$out = ($listTags) ? "<ul id='$tagId' class='$tagClass'>" : "<div id='$tagId' class='$tagClass'>";
	if ($posts) {
		# give each topic with posts a score - currently ln(cur date - post date) for each post
		$score = $count = $forum_name = $forum_slug = $topic_slug = $topic_name = array();
		foreach ($posts as $post) {
			if ($post->delta != $days) {
                $value = apply_filters('sph_HotTopicTagScore', log($days - $post->delta), $post, $a); # let plugins modify the hotness algorithm
				$score[$post->topic_id] = (isset($score[$post->topic_id])) ? $score[$post->topic_id] + $value : $value;
				$count[$post->topic_id] = (isset($count[$post->topic_id])) ? $count[$post->topic_id] + 1 : 1;
				$forum_name[$post->topic_id] = sp_filter_title_display($post->forum_name);
				$forum_slug[$post->topic_id] = $post->forum_slug;
				$topic_slug[$post->topic_id] = $post->topic_slug;
				$topic_name[$post->topic_id] = sp_filter_title_display($post->topic_name);
			}
		}
		# reverse sort the posts and limit to number to display
		arsort($score);
		$topics = array_slice($score, 0, $limit, true);

		# now output the popular topics
		foreach ($topics as $id => $topic) {
			$out.= ($listTags) ? "<li class='$listClass'>" : "<div class='$textClass'>";
            $out.= sp_get_topic_url($forum_slug[$id], $topic_slug[$id], $topic_name[$id]);
			if ($showForum) $out.= " $textForum $forum_name[$id]";
			if ($showCount) $out.= ' ('.$count[$id]." $textCount)";
			if ($showHotness) $out.= ' ('.round($score[$id], 2)." $textHotness)";
            $out.= ($listTags) ? '</li>' : '</div>';
		}
	} else {
		$out.= "<div class='$textClass'>".__('No current hot topics to display', 'sp-ttags').'</div>';
	}
	$out.= ($listTags) ? '</ul>' : '</div>';

	$out = apply_filters('sph_HotTopicsTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_HotTopicsShortcode($atts) {
    $args = array();
    if (isset($atts['tagid']))          $args['tagId']          = $atts['tagid'];
    if (isset($atts['tagclass']))       $args['tagClass']       = $atts['tagclass'];
    if (isset($atts['listclass']))      $args['listClass']      = $atts['listclass'];
    if (isset($atts['textclass']))      $args['textClass']      = $atts['textclass'];
    if (isset($atts['listtags']))       $args['listTags']       = $atts['listtags'];
    if (isset($atts['forumids']))       $args['forumIds']       = $atts['forumids'];
    if (isset($atts['limit']))          $args['limit']          = $atts['limit'];
    if (isset($atts['days']))           $args['days']           = $atts['days'];
    if (isset($atts['showforum']))      $args['showForum']      = $atts['showforum'];
    if (isset($atts['textforum']))      $args['textForum']      = $atts['textforum'];
    if (isset($atts['showcount']))      $args['showCount']      = $atts['showcount'];
    if (isset($atts['textcount']))      $args['textCount']      = $atts['textcount'];
    if (isset($atts['showhotness']))    $args['showHotness']    = $atts['showhotness'];
    if (isset($atts['texthotness']))    $args['textHotness']    = $atts['texthotness'];

    $args['echo'] = 0;
    return sp_do_sp_HotTopicsTag($args);
}

?>