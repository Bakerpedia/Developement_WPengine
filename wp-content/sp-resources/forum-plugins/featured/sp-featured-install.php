<?php
/*
Simple:Press
Featured Topics and Posts Plugin install/upgrade routine
$LastChangedDate: 2013-02-17 11:52:14 -0800 (Sun, 17 Feb 2013) $
$Rev: 9854 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_featured_do_install() {
	$options = sp_get_option('featured');
	if (empty($options)) {
        $options['dbversion'] = SPFEATUREDDBVERSION;
        sp_update_option('featured', $options);
    }

    # set up our sfmeta if needed
    $check = sp_get_sfmeta('featured', 'topics');
	if (empty($check)) sp_add_sfmeta('featured', 'topics', array(), true);
    $check = sp_get_sfmeta('featured', 'posts');
	if (empty($check)) sp_add_sfmeta('featured', 'posts', array(), true);
}

# sp reactivated.
function sp_featured_do_sp_activate() {
}

# permissions reset
function sp_featured_do_reset_permissions() {
}

?>