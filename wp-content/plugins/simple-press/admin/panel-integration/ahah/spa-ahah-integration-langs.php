<?php
/*
Simple:Press Admin
Ahah call for language downloads
$LastChangedDate: 2014-06-21 04:47:00 +0100 (Sat, 21 Jun 2014) $
$Rev: 11582 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

spa_admin_ahah_support();

# ----------------------------------
# Check Whether User Can Manage Integration
if (!sp_current_user_can('SPF Manage Integration')) {
	spa_etext('Access denied - you do not have permission');
	die();
}

if (isset($_GET['item'])) {
	$item = $_GET['item'];
	spa_download_language_file($item);
	die();
}

function spa_download_language_file($item) {
	global $spPaths;

	$langCode = $_GET['langcode'];
	$homeName = $_GET['textdom'];
	if(isset($_GET['name'])) $itemName = $_GET['name'];

	if($item == 'corefront' || $item == 'coreadmin') {
		$url = 'http://glotpress.simple-press.com/projects/simple-press-core/version-'.$_GET['version'].'/'.$homeName.'/'.$langCode.'/default/export-translations?format=mo';
		$home = WP_CONTENT_DIR.'/'.$spPaths['language-sp'].'/'.$homeName.'-'.$langCode.'.mo';
	}

	if($item == 'theme') {
		$url = 'http://glotpress.simple-press.com/projects/simple-press-themes/'.$itemName.'/'.$homeName.'/'.$langCode.'/default/export-translations?format=mo';
		$home = WP_CONTENT_DIR.'/'.$spPaths['language-sp-themes'].'/'.$homeName.'-'.$langCode.'.mo';
	}

	if($item == 'plugin') {
		$url = 'http://glotpress.simple-press.com/projects/simple-press-plugins/'.$itemName.'/'.$homeName.'/'.$langCode.'/default/export-translations?format=mo';
		$home = WP_CONTENT_DIR.'/'.$spPaths['language-sp-plugins'].'/'.$homeName.'-'.$langCode.'.mo';
	}

	if(isset($_GET['remove'])) {
		$status = unlink($home);
		$status = !$status;
	} else {
		$status = file_put_contents($home, fopen($url, 'rb'));
	}

	if($status) {
		echo '<img src="'.SFADMINIMAGES.'sp_Yes.png" title="'.spa_text('Translation file installed').'" alt="" style="vertical-align: middle;" />';
	} else {
		echo '<img src="'.SFADMINIMAGES.'sp_No.png" title="'.spa_text('Translation install failed').'" alt="" style="vertical-align: middle;" />';
	}
}

die();
?>