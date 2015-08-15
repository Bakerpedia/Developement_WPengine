<?php
/*
$LastChangedDate: 2013-08-08 05:12:46 -0700 (Thu, 08 Aug 2013) $
$Rev: 10484 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	======================================================================================
	sp_GroupLinkTag()

	displays a link to a specific group forum listing if current user has access privilege
	Will use your theme styling.

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------
		groupId			ID of the Group							number			REQUIRED
		linkText		textual content of link					text			Group Name
						placeholder %GROUPNAME% is replaced by designated group name
		beforeLink		before link text/HTML					text			''
		afterLink		after link text/html					text			''
		listTags		Wrap the link in li tags				true/false		false
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

========================================================================================*/

function sp_do_sp_GroupLinkTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('groupId'		=> '',
				  'linkText'	=> '%GROUPNAME%',
				  'beforeLink'	=> '',
				  'afterLink'	=> '',
				  'listTags'	=> 0,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_GroupLinkTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$groupId	= (int) $groupId;
	$linkText	= esc_attr($linkText);
	$beforeLink	= sp_filter_title_display($beforeLink);
	$afterLink	= sp_filter_title_display($afterLink);
	$listTags	= (int) $listTags;
	$echo		= (int) $echo;

	if (empty($groupId)) return '';
	sp_forum_api_support();
	if (!empty($beforeLink)) $beforeLink = trim($beforeLink).' ';
	if (!empty($afterLink)) $afterLink = ' '.trim($afterLink);

	# check user has access to at kleast ine forum in group
	$canview = false;
	$forums = spdb_table(SFFORUMS, "group_id=$groupId");
	if ($forums) 	{
		foreach ($forums as $forum) {
			if (sp_can_view($forum->forum_id, 'forum-title')) $canview = true;
		}
	}
	if ($forums && $canview) {
		$grouprec = spdb_table(SFGROUPS, "group_id=$groupId", 'row');
		$out='';
		$linkText = str_replace("%GROUPNAME%", sp_filter_title_display($grouprec->group_name), $linkText);
		if (empty($linkText)) $linkText=sp_filter_title_display($grouprec->group_name);
		if ($listTags) $out.='<li>';
		$out.= '<span>'.$beforeLink.'<a href="'.add_query_arg(array('group'=>$groupId), sp_url()).'">'.$linkText.'</a>'.$afterLink.'</span>';
		if ($listTags) $out.='</li>';
	}

	$out = apply_filters('sph_GroupLinkTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_GroupLinkShortcode($atts) {
    $args = array();
    if (isset($atts['groupid']))    $args['groupId']    = $atts['groupid'];
    if (isset($atts['linktext']))   $args['linkText']   = $atts['linktext'];
    if (isset($atts['beforelink'])) $args['beforeLink'] = $atts['beforelink'];
    if (isset($atts['afterlink']))  $args['afterLink']  = $atts['afterlink'];
    if (isset($atts['listtags']))   $args['listTags']   = $atts['listtags'];

    $args['echo'] = 0;
    return sp_do_sp_GroupLinkTag($args);
}

?>