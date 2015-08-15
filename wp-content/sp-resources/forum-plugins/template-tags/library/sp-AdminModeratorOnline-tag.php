<?php
/*
$LastChangedDate: 2014-05-18 09:44:50 -0700 (Sun, 18 May 2014) $
$Rev: 11449 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/* 	====================================================================================================

	sp_AdminModeratorOnlineTag()

	displays online status of admins and moderators

	parameters:
		name			description								type			default
		-------------------------------------------------------------------------------------------------
		tagId			unique id to use for div or list		text			spAdminModeratorOnlineTag
		tagClass		class to be applied for styling			text			spListTag
		moderator		Display moderator status				true/false		true
		custom			Display custom status text if set		true/false		true
		customClass		class to be applied to message			text			spAdminMessageTag
		listTags		Wrap in <ul> and <li> tags				true/false		true
						If false a div will be used
		listClass		class to be applied to list item style	text			spListItemTag
		onToolTip		Tooltip to display if online			text			'Online'
		onIcon			Icon to display if online				filename		sp_UserOnlineSmall.png
		offToolTip		Tooltip to display if offline			text			'Offline'
		offIcon			Icon to display if offline				filename		sp_UserOfflineSmall.png
        useAvatar       Use Avatar in place of on/off icons     true/false		false
        avatarSize      size of avatar if used                  number          '25'
		echo			echo content or return content			true/false		true

	NOTE: True must be expressed as a 1 and False as a zero

========================================================================================================*/

function sp_do_sp_AdminModeratorOnlineTag($args='') {
    #check if forum displayed
    if (sp_abort_display_forum()) return;

	$defs = array('tagId'    	=> 'spAdminModeratorOnlineTag',
				  'tagClass' 	=> 'spListTag',
				  'moderator'	=> 1,
				  'custom'		=> 1,
				  'customClass'	=> 'spAdminMessageTag',
				  'listTags'	=> 1,
				  'listClass'	=> 'spListItemTag',
				  'onToolTip'	=> __('Online', 'sp-ttags'),
				  'onIcon'		=> 'sp_UserOnlineSmall.png',
				  'offIcon'		=> 'sp_UserOfflineSmall.png',
				  'offToolTip'	=> __('Offline', 'sp-ttags'),
				  'useAvatar'	=> 0,
                  'avatarSize'	=> 25,
                  'echo'		=> 1
				  );
	$a = wp_parse_args($args, $defs);
	$a = apply_filters('sph_AdminModeratorOnlineTag_args', $a);
	extract($a, EXTR_SKIP);

	# sanitize before use
	$tagId		= esc_attr($tagId);
	$tagClass	= esc_attr($tagClass);
	$moderator	= (int) $moderator;
	$custom		= (int) $custom;
	$customClass= esc_attr($customClass);
	$listTags	= (int) $listTags;
	$listClass	= esc_attr($listClass);
	$onToolTip	= sp_filter_title_display($onToolTip);
	$offToolTip	= sp_filter_title_display($offToolTip);
	$onIcon		= sp_filter_filename_save($onIcon);
	$offIcon	= sp_filter_filename_save($offIcon);
    $useAvatar	= (int) $useAvatar;
    $avatarSize	= (int) $avatarSize;
	$echo		= (int) $echo;

	sp_forum_api_support();

	$where='admin=1';
	if ($moderator) $where.=' OR moderator = 1';

	$spdb = new spdbComplex;
		$spdb->table		= SFMEMBERS;
		$spdb->fields		= 'user_id AS ID, user_email, '.SFMEMBERS.'.display_name, admin, user_options, admin_options, '.SFTRACK.'.id AS online';
		$spdb->left_join	= array(SFTRACK.' ON '.SFMEMBERS.'.user_id = '.SFTRACK.'.trackuserid', SFUSERS.' ON '.SFMEMBERS.'.user_id = '.SFUSERS.'.ID');
		$spdb->where		= $where;
		$spdb->orderby		= 'online DESC';
	$admins = $spdb->select();

	$out = '';
	if ($admins) {
		$out.= ($listTags) ? "<ul id='$tagId' class='$tagClass'>" : "<div id='$tagId' class='$tagClass'>";
		foreach ($admins as $admin) {
			$noAvatar = '';
			$msg = '';
			$userOpts = unserialize($admin->user_options);
			if (!$userOpts['hidestatus']) {
				$userName = sp_build_name_display($admin->ID, sp_filter_name_display($admin->display_name));
				$icon = ($admin->online) ? $onIcon : $offIcon;
				$tip = ($admin->online) ? $onToolTip : $offToolTip;
				if (!$useAvatar) $noAvatar.= "<img src='".sp_find_icon(SPTHEMEICONSURL, "$icon")."' alt='' title='$tip' />";
				if (!$admin->online && $custom) {
					$userOpts = unserialize($admin->admin_options);
					if (isset($userOpts['offline_message'])) {
						$msg = sp_filter_text_display($userOpts['offline_message']);
						if ($msg != '') $msg= "<div class='$customClass'>$msg</div>";
					}
				}

				# begin loop display
				if ($listTags ? $out.= "<li class='$listClass'>" : $out.= "<div class='$listClass'>");

				# Avatar or Icon
				if ($useAvatar) {
				    $admin->avatar = '';
                    $out.= sp_UserAvatar("tagClass=spAvatar&imgClass=spAvatar&size=$avatarSize&context=user&echo=0", $admin);
				} else {
					$out.= $noAvatar;
				}

				# User name and current online status
				$out.= "<span class='spOnlineAdmin'><span class='spOnlineUser'>$userName</span> is <span class='admin$tip'>$tip</span>";

                # display offline message is set
                $out.= $msg;
				$out.= '</span>';

				# end loop display
				if ($listTags ? $out.= '<div style="clear:both;"></div></li>' : $out.= '</div><div style="clear:both;"></div>');
            }
        }
		$out.= ($listTags) ? '</ul>' : '</div>';
	}

	$out = apply_filters('sph_AdminModeratorOnlineTag', $out);

	if ($echo) {
		echo $out;
	} else {
		return $out;
	}
}

function sp_do_AdminModeratorOnlineShortcode($atts) {
    $args = array();
    if (isset($atts['tagid']))          $args['tagId']          = $atts['tagid'];
    if (isset($atts['tagclass']))       $args['tagClass']       = $atts['tagclass'];
    if (isset($atts['moderator']))      $args['moderator']      = $atts['moderator'];
    if (isset($atts['custom']))         $args['custom']         = $atts['custom'];
    if (isset($atts['customclass']))    $args['customClass']    = $atts['customclass'];
    if (isset($atts['listtags']))       $args['listTags']       = $atts['listtags'];
    if (isset($atts['listclass']))      $args['listClass']      = $atts['listclass'];
    if (isset($atts['ontooltip']))      $args['onToolTip']      = $atts['ontooltip'];
    if (isset($atts['onicon']))         $args['onIcon']         = $atts['onicon'];
    if (isset($atts['officon']))        $args['offIcon']        = $atts['officon'];
    if (isset($atts['offtooltip']))     $args['offToolTip']     = $atts['offtooltip'];
    if (isset($atts['useAvatar']))      $args['useAvatar']      = $atts['useAvatar'];
    if (isset($atts['avatarSize']))     $args['avatarSize']     = $atts['avatarSize'];

    $args['echo'] = 0;
    return sp_do_sp_AdminModeratorOnlineTag($args);
}

?>