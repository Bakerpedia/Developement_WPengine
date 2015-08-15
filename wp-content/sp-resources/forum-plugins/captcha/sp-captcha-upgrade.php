<?php
/*
Simple:Press
Name plugin install/upgrade routine
$LastChangedDate: 2014-06-07 14:32:19 -0700 (Sat, 07 Jun 2014) $
$Rev: 11528 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_captcha_do_upgrade_check() {
    if (!sp_is_plugin_active('captcha/sp-captcha-plugin.php')) return;

    $options = sp_get_option('spCaptcha');

    $db = $options['dbversion'];
    if (empty($db)) $db = 0;

    # quick bail check
    if ($db == SPCAPTCHADBVERSION ) return;

    # apply upgrades as needed

    # db version upgrades
    if ($db < 1) {
	   spdb_query('UPDATE '.SFAUTHS." SET auth_cat=6 WHERE auth_name='bypass_captcha'");
    }

    # save data
    $options['dbversion'] = SPCAPTCHADBVERSION;
    sp_update_option('spCaptcha', $options);
}

?>