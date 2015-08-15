<?php
/*
Simple:Press
Featured Topics and Posts Plugin uninstall routine
$LastChangedDate: 2014-03-06 17:58:43 -0800 (Thu, 06 Mar 2014) $
$Rev: 11129 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# this uninstall function is for the topic description plugin uninstall only
function sp_featured_do_uninstall() {
    # delete our option
    sp_delete_option('featured');

    # remove our sfmeta
	sp_delete_sfmeta(0, 'featured');
}

function sp_featured_do_deactivate() {
}

function sp_featured_do_sp_deactivate() {
}

function sp_featured_do_sp_uninstall() {
}

function sp_featured_uninstall_option_links($actionlink, $plugin) {
	if ($plugin == 'featured/sp-featured-plugin.php') {
        $url = SFADMINPLUGINS.'&amp;action=uninstall&amp;plugin='.$plugin.'&amp;sfnonce='.wp_create_nonce('forum-adminform_plugins');
        $actionlink.= "&nbsp;&nbsp;<a href='$url' title='".__('Uninstall this plugin', 'sp-featured')."'>".__('Uninstall', 'sp-featured').'</a>';
        $url = SFADMINCOMPONENTS.'&amp;tab=plugin&amp;admin=sp_featured_admin_options&amp;save=sp_featured_admin_save_options&amp;form=1';
        $actionlink.= "&nbsp;&nbsp;<a href='$url' title='".__('Options', 'sp-featured')."'>".__('Options', 'sp-featured').'</a>';
    }
	return $actionlink;
}

?>