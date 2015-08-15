<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	======================================================================================
	sp_ForumLinkTag()

	displays a link to a specific forum topic listing if current user has access privilege
	Will use your theme styling.

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------
		forumId			ID of the Forum							number			REQUIRED
		linkText		textual content of link					text			Forum Name
						placeholder %FORUMNAME% is replaced by designated forum name
		beforeLink		before link text/HTML					text			''
		afterLink		after link text/html					text			''
		listTags		Wrap the link in li tags				true/false		false
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

========================================================================================*/

function sp_do_sp_ForumLinkTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('forumId'		=> '',
				  'linkText'	=> '%FORUMNAME%',
				  'beforeLink'	=> '',
				  'afterLink'	=> '',
				  'listTags'	=> 0,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_ForumLinkTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$forumId	= (int) $forumId;
	$linkText	= esc_attr($linkText);
	$beforeLink	= sp_filter_title_display($beforeLink);
	$afterLink	= sp_filter_title_display($afterLink);
	$listTags	= (int) $listTags;
	$echo		= (int) $echo;

	if (empty($forumId)) return '';
	sp_forum_api_support();

	if (!empty($beforeLink)) $beforeLink = trim($beforeLink).' ';
	if (!empty($afterLink)) $afterLink = ' '.trim($afterLink);

	if (sp_can_view($forumId, 'forum-title')) {
		$forumrec = spdb_table(SFFORUMS, "forum_id=$forumId", 'row');
		if($forumrec) {
			$out='';
			$linkText = str_replace("%FORUMNAME%", sp_filter_title_display($forumrec->forum_name), $linkText);
			if (empty($linkText)) $linkText=sp_filter_title_display($forumrec->forum_name);
			if ($listTags) $out.='<li>';
			$out.= '<span>'.$beforeLink.'<a href="'.sp_build_url($forumrec->forum_slug, '', 0, 0).'">'.$linkText.'</a>'.$afterLink.'</span>';
			if ($listTags) $out.='</li>';
		} else {
			$out = sprintf(__('Forum %s not found', 'sp-ttags'), $forumId);
		}
	}

	$out = apply_filters('sph_ForumLinkTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_ForumLinkShortcode($atts) {
    $args = array();
    if (isset($atts['forumid']))    $args['forumId']    = $atts['forumid'];
    if (isset($atts['linktext']))   $args['linkText']   = $atts['linktext'];
    if (isset($atts['beforelink'])) $args['beforeLink'] = $atts['beforelink'];
    if (isset($atts['afterlink']))  $args['afterLink']  = $atts['afterlink'];
    if (isset($atts['listtags']))   $args['listTags']   = $atts['listtags'];

    $args['echo'] = 0;
    return sp_do_sp_ForumLinkTag($args);
}

?>