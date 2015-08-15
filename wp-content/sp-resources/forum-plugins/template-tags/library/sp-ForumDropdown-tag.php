<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	==============================================================================================
	sp_ForumDropdownTag()

	displays a dropdown of links to forums

	parameters:
		name			description								type			default
		------------------------------------------------------------------------------------------
		tagId			unique id to use for div or list		text			spForumDropdownTag
		tagClass		class to be applied for styling			text			spLinkTag
		selectClass		class to be applied to select control	text			spSelectTag
		forumList:		ID's of forums (comma delimited in quotes) or 0 for all 0
		label:			Text label to display					text			"Select forum"
		length			length of title in select				number			30
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

================================================================================================*/

function sp_do_sp_ForumDropdownTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('tagId'    	=> 'spForumDropdownTag',
				  'tagClass' 	=> 'spLinkTag',
				  'selectClass'	=> 'spSelectTag',
				  'forumList'	=> 0,
				  'label'		=> __("Select forum", 'sp-ttags'),
				  'length'		=> 30,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_ForumDropdownTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$tagId		= esc_attr($tagId);
	$tagClass	= esc_attr($tagClass);
	$selectClass= esc_attr($selectClass);
	$forumList	= esc_attr($forumList);
	$label		= sp_filter_title_display($label);
	$length		= (int) $length;
	$echo		= (int) $echo;

	global $spThisUser;
	sp_forum_api_support();
	$forum_ids = array();
	if ($forumList == 0) {
		$forum_ids = sp_get_forum_memberships($spThisUser->ID);
	} else {
		$allforums = explode(',', $forumList);
		foreach ($allforums as $thisforum) {
			if (sp_can_view($thisforum, 'forum-title')) $forum_ids[] = $thisforum;
		}
	}
	if(empty($forum_ids)) return;

	# create where clause based on forums that current user can view
	$where = "forum_id IN (".implode(",", $forum_ids).")";

	$spdb = new spdbComplex;
		$spdb->table		= SFFORUMS;
		$spdb->fields		= 'forum_slug, forum_name';
		$spdb->join			= array(SFGROUPS.' ON '.SFFORUMS.'.group_id = '.SFGROUPS.'.group_id');
		$spdb->where		= $where;
		$spdb->orderby		= 'group_seq, forum_seq';
	$forums = $spdb->select();

	$out = "<div id='$tagId' class='$tagClass'>";
	$out.= '<select name="forumselect" class="'.$selectClass.'" onChange="javascript:spjChangeForumURL(this)">'."\n";
	$out.= '<option>'.$label.'</option>'."\n";
	foreach ($forums as $forum) {
		$out.= '<option value="'.sp_build_url($forum->forum_slug, '', 0, 0).'">&nbsp;&nbsp;'.sp_create_name_extract(sp_filter_title_display($forum->forum_name), $length).'</option>'."\n";
	}
	$out.= '</select>'."\n";
	$out.= '</div>';

	$out.= '<script type="text/javascript">';
	$out.= 'function spjChangeForumURL(menuObj) {';
	$out.= 'var i = menuObj.selectedIndex;';
	$out.= 'if(i > 0) {';
	$out.= 'if(menuObj.options[i].value != "#") {';
	$out.= 'window.location = menuObj.options[i].value;';
	$out.= '}}}';
	$out.= '</script>';

	$out = apply_filters('sph_ForumDropdownTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_ForumDropdownShortcode($atts) {
	$defs = array('tagId'    	=> 'spForumDropdownTag',
				  'tagClass' 	=> 'spLinkTag',
				  'selectClass'	=> 'spSelectTag',
				  'forumList'	=> 0,
				  'label'		=> __("Select forum", 'sp-ttags'),
				  'length'		=> 30,
				  'echo'		=> 1,
				  );

    $args = array();
    if (isset($atts['tagid']))       $args['tagId']         = $atts['tagid'];
    if (isset($atts['tagclass']))    $args['tagClass']      = $atts['tagclass'];
    if (isset($atts['selectclass'])) $args['selectClass']   = $atts['selectclass'];
    if (isset($atts['forumlist']))   $args['forumList']     = $atts['forumlist'];
    if (isset($atts['label']))       $args['label']         = $atts['label'];
    if (isset($atts['length']))      $args['length']        = $atts['length'];

    $args['echo'] = 0;
    return sp_do_sp_ForumDropdownTag($args);
}

?>