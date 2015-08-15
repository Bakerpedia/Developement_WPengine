<?php
/*
Simple:Press
Featured Topics and Posts Plugin install/upgrade routine
$LastChangedDate: 2014-06-07 14:32:19 -0700 (Sat, 07 Jun 2014) $
$Rev: 11528 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_featured_do_upgrade_check() {
    if (!sp_is_plugin_active('featured/sp-featured-plugin.php')) return;

    $options = sp_get_option('featured');

    $db = $options['dbversion'];
    if (empty($db)) $db = 0;

    # quick bail check
    if ($db == SPFEATUREDDBVERSION ) return;

    # apply upgrades as needed

    # db version upgrades

    # save data
    $options['dbversion'] = SPFEATUREDDBVERSION;
    sp_update_option('featured', $options);
}

?>