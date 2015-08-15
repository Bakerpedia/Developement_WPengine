<?php
/*
$LastChangedDate: 2013-04-18 22:21:03 -0700 (Thu, 18 Apr 2013) $
$Rev: 10187 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	======================================================================================
	sp_ForumHomeLinkTag()

	displays a standard link to your forums home page.
	Will use your theme styling.

	parameters:
		name			description								type			default
		----------------------------------------------------------------------------------
		beforeLink		before link text/HTML					text			''
		afterLink		after link text/html					text			''
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

========================================================================================*/

function sp_do_sp_ForumHomeLinkTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('beforeLink'	=> '',
				  'afterLink'	=> '',
			 	  'echo'		=> 1
			 	  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_ForumHomeLinkTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$beforeLink	= sp_filter_title_display($beforeLink);
	$afterLink	= sp_filter_title_display($afterLink);
	$echo		= (int) $echo;

	if(!empty($beforeLink)) $beforeLink = trim($beforeLink).' ';
	if(!empty($afterLink)) $afterLink = ' '.trim($afterLink);

	$pid = sp_get_option('sfpage');
	$title = spdb_table(SFWPPOSTS, "ID=$pid", 'post_title');
	$out.= '<span>'.$beforeLink.'<a href="'.get_permalink($pid).'">'.$title.'</a>'.$afterLink.'</span>';
	$out = apply_filters('sph_ForumHomeLinkTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_ForumHomeLinkShortcode($atts) {
    $args = array();
    if (isset($atts['beforelink']))  $args['beforeLink']  = $atts['beforelink'];
    if (isset($atts['afterlink']))   $args['afterLink']   = $atts['afterlink'];

    $args['echo'] = 0;
    return sp_do_sp_ForumHomeLinkTag($args);
}

?>