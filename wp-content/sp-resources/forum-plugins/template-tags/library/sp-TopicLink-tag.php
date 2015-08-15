<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	======================================================================================
	sp_TopicLinkTag()

	displays a link to a specific forum topic if current user has access privilege
	Will use your theme styling.

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------
		topicId			ID of the Topic							number			REQUIRED
		linkText		textual content of link					text			Topic Name
						placeholder %TOPICNAME% is replaced by designated forum name
		beforeLink		before link text/HTML					text			''
		afterLink		after link text/html					text			''
		listTags		Wrap the link in li tags				true/false		false
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

========================================================================================*/

function sp_do_sp_TopicLinkTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('topicId'		=> '',
				  'linkText'	=> '%TOPICNAME%',
				  'beforeLink'	=> '',
				  'afterLink'	=> '',
				  'listTags'	=> 0,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_TopicLinkTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$topicId	= (int) $topicId;
	$linkText	= esc_attr($linkText);
	$beforeLink	= sp_filter_title_display($beforeLink);
	$afterLink	= sp_filter_title_display($afterLink);
	$listTags	= (int) $listTags;
	$echo		= (int) $echo;

	if (empty($topicId)) return '';
	sp_forum_api_support();

	if(!empty($beforeLink)) $beforeLink = trim($beforeLink).' ';
	if(!empty($afterLink)) $afterLink = ' '.trim($afterLink);

	$spdb = new spdbComplex;
		$spdb->table		= SFTOPICS;
		$spdb->fields		= SFTOPICS.'.topic_id, '.SFTOPICS.'.forum_id, topic_slug, topic_name, forum_name, forum_slug';
		$spdb->join			= array(SFFORUMS.' ON '.SFTOPICS.'.forum_id = '.SFFORUMS.'.forum_id');
		$spdb->where		= SFTOPICS.'.topic_id='.$topicId;
	$thistopic = $spdb->select();

	$out = '';
	if($thistopic) {
		if (sp_can_view($thistopic[0]->forum_id, 'topic-title')) {
			$out='';
			$linkText = str_replace("%TOPICNAME%", sp_filter_title_display($thistopic[0]->topic_name), $linkText);
			if (empty($linkText)) $linkText=sp_filter_title_display($thistopic[0]->topic_name);
			if ($listTags) $out.='<li>';
			$out.= '<span>'.$beforeLink.'<a href="'.sp_build_url($thistopic[0]->forum_slug, $thistopic[0]->topic_slug, 0, 0).'">'.$linkText.'</a>'.$afterLink.'</span>';
			if ($listTags) $out.='</li>';
		}
	} else {
		$out = sprintf(__('Topic %s not found', 'sp-ttags'), $topicId);
	}

	$out = apply_filters('sph_TopicLinkTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_TopicLinkShortcode($atts) {
    $args = array();
    if (isset($atts['topicid']))    $args['topicId']    = $atts['topicid'];
    if (isset($atts['linktext']))   $args['linkText']   = $atts['linktext'];
    if (isset($atts['beforelink'])) $args['beforeLink'] = $atts['beforelink'];
    if (isset($atts['afterlink']))  $args['afterLink']  = $atts['afterlink'];
    if (isset($atts['listtags']))   $args['listTags']   = $atts['listtags'];

    $args['echo'] = 0;
    return sp_do_sp_TopicLinkTag($args);
}

?>