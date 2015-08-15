<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	============================================================================================
	sp_AuthorPostsTag()

	displays all the posts for the specified author id - forum visability rules apply

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------------
		tagId			unique id to use for div or list		text			spAuthorPostsTag
		tagClass		class to be applied for styling			text			spLinkTag
		authorId		author to show the posts for			number			Required
		showForum		show the forum name						true/false		true
		showDate		show the date of the latest post		true/false		true
		limit			number of posts to return 0 = all		number			5
		listTags		wrap all in ul and items in li tags		true/false		false
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

==============================================================================================*/

function sp_do_sp_AuthorPostsTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('tagId'    	=> 'spAuthorPostsTag',
				  'tagClass' 	=> 'spLinkTag',
				  'authorId'	=> '',
				  'showForum'	=> 1,
				  'showDate'	=> 1,
				  'limit'		=> 5,
				  'listTags'	=> 0,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_AuthorPostsTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$tagId		= esc_attr($tagId);
	$tagClass	= esc_attr($tagClass);
	$authorId	= (int) $authorId;
	$showForum	= (int) $showForum;
	$showDate	= (int) $showDate;
	$limit		= (int) $limit;
	$listTags	= (int) $listTags;
	$echo		= (int) $echo;

    if (empty($authorId)) return;
	sp_forum_api_support();

	if ($limit == 0) {
		$limit = '';
	}

	# limit to viewable forums based on permissions
	$where = SFPOSTS.'.user_id = '.$authorId.' AND '.SFPOSTS.'.post_status=0 ';
	$forum_ids = sp_get_forum_memberships();
	# create where clause based on forums that current user can view
	if ($forum_ids != '') {
		$where .= "AND ".SFPOSTS.".forum_id IN (".implode(",", $forum_ids).")";
	} else {
		return '';
	}

	$spdb = new spdbComplex;
		$spdb->table		= SFPOSTS;
		$spdb->distinct		= true;
		$spdb->fields		= SFPOSTS.'.post_id, '.SFPOSTS.'.forum_id, '.SFPOSTS.'.topic_id, '.spdb_zone_datetime('post_date').',
							  post_index, forum_slug, forum_name, topic_slug, topic_name';
		$spdb->join			= array(SFTOPICS.' ON '.SFPOSTS.'.topic_id = '.SFTOPICS.'.topic_id',
									SFFORUMS.' ON '.SFPOSTS.'.forum_id = '.SFFORUMS.'.forum_id');
		$spdb->where		= $where;
		$spdb->orderby		= 'post_date DESC';
		$spdb->limits		= $limit;
	$sfposts = $spdb->select();

	if(!$listTags) {
		$out = "<div id='$tagId' class='$tagClass'>";
		$open = '<div>';
		$close = '</div>';
	} else {
		$out = "<ul id='$tagId' class='$tagClass'>";
		$open = '<li>';
		$close = '</li>';
	}

	if ($sfposts) {
		foreach ($sfposts as $sfpost) {
			$out.= $open;
			if ($showForum) {
				$out .= sp_filter_title_display($sfpost->forum_name).'<br />';
			}
			$out .= '<a href="'.sp_build_url($sfpost->forum_slug, $sfpost->topic_slug, 0, $sfpost->post_id, $sfpost->post_index).'">'.sp_filter_title_display($sfpost->topic_name).'</a><br />'."\n";
			if ($showDate) {
				$out .= sp_date('d', $sfpost->post_date).'<br />';
			}
			$out.= $close;
		}
	} else {
		$out .= $open.__('No posts by this author', 'sp-ttags').$close;
	}
	if(!$listTags) {
		$out .= '</div>';
	} else {
		$out.= '</ul>';
	}

	$out = apply_filters('sph_AuthorPostsTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_AuthorPostsShortcode($atts) {
    $args = array();
    if (isset($atts['tagid']))          $args['tagId']          = $atts['tagid'];
    if (isset($atts['tagclass']))       $args['tagClass']       = $atts['tagclass'];
    if (isset($atts['authorid']))       $args['authorId']       = $atts['authorid'];
    if (isset($atts['showforum']))      $args['showForum']      = $atts['showforum'];
    if (isset($atts['showdate']))       $args['showDate']       = $atts['showdate'];
    if (isset($atts['limit']))          $args['limit']          = $atts['limit'];
    if (isset($atts['listtags']))       $args['listTags']       = $atts['listtags'];

    $args['echo'] = 0;
    return sp_do_sp_AuthorPostsTag($args);
}

?>