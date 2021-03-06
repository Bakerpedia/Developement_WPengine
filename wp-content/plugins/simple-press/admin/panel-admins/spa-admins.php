<?php
/*
Simple:Press
Admin ADmins
$LastChangedDate: 2014-06-20 20:47:00 -0700 (Fri, 20 Jun 2014) $
$Rev: 11582 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# Check Whether User Can Manage Admins
global $spStatus;

if (!sp_current_user_can('SPF Manage Admins') && !$spThisUser->admin && !$spThisUser->moderator) {
	spa_etext('Access denied - you do not have permission');
	die();
}

include_once SF_PLUGIN_DIR.'/admin/panel-admins/spa-admins-display.php';
include_once SF_PLUGIN_DIR.'/admin/panel-admins/support/spa-admins-prepare.php';
include_once SF_PLUGIN_DIR.'/admin/library/spa-tab-support.php';

if ($spStatus != 'ok') {
    include_once SPLOADINSTALL;
    die();
}

global $adminhelpfile;
$adminhelpfile = 'admin-admins';
# --------------------------------------------------------------------

$tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'youradmin';
spa_panel_header();
spa_render_admins_panel($tab);
spa_panel_footer();
?>