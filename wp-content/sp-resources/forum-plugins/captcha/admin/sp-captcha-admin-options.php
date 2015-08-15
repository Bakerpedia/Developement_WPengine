 <?php
/*
Simple:Press
Captcha Plugin Admin Options Form
$LastChangedDate: 2013-02-17 11:59:36 -0800 (Sun, 17 Feb 2013) $
$Rev: 9855 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function sp_captcha_admin_options_form() {
	$captcha = sp_get_option('spCaptcha');

	spa_paint_open_panel();
		spa_paint_open_fieldset(__('Captcha on User Registration', 'sp-cap'), true, 'captcha');
			spa_paint_checkbox(__('Add Captcha form to WP registration/signup form', 'sp-cap'), 'registration', $captcha['registration']);
		spa_paint_close_fieldset();
	spa_paint_close_panel();

	do_action('sph_captcha_options_panel');
}
?>