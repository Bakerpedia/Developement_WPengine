<?php
/*
Simple:Press
Captcha Plugin Admin Options Save Routine
$LastChangedDate: 2013-02-17 11:59:36 -0800 (Sun, 17 Feb 2013) $
$Rev: 9855 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_captcha_admin_options_save() {
    $captcha = array();
    $captcha['registration'] = isset($_POST['registration']);
	sp_update_option('spCaptcha', $captcha);

    do_action('sph_captcha_uploads_save');

	return __('Captcha options updated!', 'sp-cap');
}

?>