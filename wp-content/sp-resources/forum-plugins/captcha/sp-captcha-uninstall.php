<?php
/*
Simple:Press
Captcha plugin uninstall routine
$LastChangedDate: 2013-02-17 11:59:36 -0800 (Sun, 17 Feb 2013) $
$Rev: 9855 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# this uninstall function is for the captcha plugin uninstall only
function sp_captcha_do_uninstall() {
    # delete our option
    sp_delete_option('spCaptcha');

    sp_delete_auth('bypass_captcha');
}
?>