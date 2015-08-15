<?php
/*
$LastChangedDate: 2013-08-23 12:55:44 -0700 (Fri, 23 Aug 2013) $
$Rev: 10569 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	=====================================================================================
	sp_do_sp_UserGroupsTag($userid, $args)

	displays user groups for the specified user

	parameters:
		name			description								  type			default
		----------------------------------------------------------------------------------------
		tagClass		class to be applied for styling			  text			spUserGroupsTag
		stacked   		show the usergroup titles/badges stacked     				1
		showTitle		show the rank title     				  int    			1
		showBadge		show the rank badge     				  int 	   		    1
		echo			echo content or return content			  int   		    1
 	===================================================================================*/
function sp_do_sp_UserGroupsTag($userid, $args='', $noMembershipLabel='', $adminLabel='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	global $spPaths;

	$defs = array('tagClass' 	=> 'spUserGroupsTag',
                  'stacked'     => 1,
                  'showTitle'   => 1,
                  'showBadge'   => 1,
				  'echo'		=> 1,
				  );
	$a = wp_parse_args($args, $defs);
	extract($a, EXTR_SKIP);

	$tagClass	= esc_attr($tagClass);
	$stacked	= (int) $stacked;
	$showTitle	= (int) $showTitle;
	$showBadge	= (int) $showBadge;
	$echo       = (int) $echo;

	$thisUser = sp_get_user($userid);

    $show = false;
	$tout = "<span class='$tagClass'>";
    if (!empty($thisUser->memberships)) {
        $first = true;
        $split = ($stacked) ? '<br />' : ', ';
    	foreach ($thisUser->memberships as $membership) {
    	    if (!$first) $tout.= $split;
            if ($showTitle) {
        	    $show = true;
                $tout.= $membership['usergroup_name'];
            }
			if ($showBadge && !empty($membership['usergroup_badge'])) {
        	    $show = true;
                if ($showTitle) $tout.= '<br />';
                $tout.= "<img src='".SF_STORE_URL.'/'.$spPaths['ranks'].'/'.$membership['usergroup_badge']."' alt='' />";
            }
            $first = false;
    	}
    } else if ($thisUser->admin) {
        if ($showTitle) {
    	    $show = true;
            $tout.= sp_filter_title_display($adminLabel);
        }
    } else {
	    $show = true;
        $tout.= sp_filter_title_display($noMembershipLabel);
    }
	$tout.= "</span>\n";
    $out = ($show) ? $tout : '';

    if ($echo) {
        echo $out;
    } else {
        return $out;
    }
}

function sp_do_UserGroupsShortcode($atts) {
    $args = array();
    $userid = $atts['userid'];
    $noMembershipLabel = $atts['nomembershiplabel'];
    $adminLabel = $atts['adminlabel'];
    if (isset($atts['tagclass']))   $args['tagClass']   = $atts['tagclass'];
    if (isset($atts['stacked']))    $args['stacked']    = $atts['stacked'];
    if (isset($atts['showtitle']))  $args['showTitle']  = $atts['showtitle'];
    if (isset($atts['showbadge']))  $args['showBadge']  = $atts['showbadge'];

    $args['echo'] = 0;
    return sp_do_sp_UserGroupsTag($userid, $args, $noMembershipLabel, $adminLabel);
}

?>