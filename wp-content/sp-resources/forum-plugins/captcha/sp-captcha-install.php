<?php
/*
Simple:Press
Captcha plugin install/upgrade routine
$LastChangedDate: 2013-02-17 11:59:36 -0800 (Sun, 17 Feb 2013) $
$Rev: 9855 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_captcha_do_install() {
	$captcha = sp_get_option('spCaptcha');
	if (empty($captcha)) {
        $captcha['registration'] = true;
        $captcha['dbversion'] = SPCAPTCHADBVERSION;
        sp_update_option('spCaptcha', $captcha);
    }

    # add a new permission into the auths table
	sp_add_auth('bypass_captcha', __('Can bypass the post captcha check', 'sp-cap'), 1, 0, 0, 0, 6);
    sp_activate_auth('bypass_captcha');
}

function sp_captcha_do_permissions_reset() {
	sp_add_auth('bypass_captcha', __('Can bypass the post captcha check', 'sp-cap'), 1, 0, 0, 0, 6);
}
?>