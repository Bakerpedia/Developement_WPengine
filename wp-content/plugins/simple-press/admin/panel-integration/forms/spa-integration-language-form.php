<?php
/*
Simple:Press
Admin Integration Storage Locations Form
$LastChangedDate: 2014-06-21 04:47:00 +0100 (Sat, 21 Jun 2014) $
$Rev: 11582 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function spa_integration_language_form() {

	include_once SF_PLUGIN_DIR.'/admin/library/sp-languages.php';
	global $siteLang, $locale;

	# Get user language setting
	$siteLang = $locale;
	if(!empty($siteLang)) {
		$siteLang = substr($siteLang, 6);
		foreach($langSets as $lKey => $lName) {
			if(strpos($siteLang, $lKey) != 0) {
				$siteLang = $lKey;
				break;
			}
		}
	}

	if(empty($siteLang) || $siteLang=='en_US' || $siteLang=='en-US' || $siteLang=='en') {
		echo '<br /><div class="sfoptionerror">';
		spa_etext('Your site language setting is English/US and therefore no translation files are required for Simple:Press');
		echo '</div>';
		return;
	}
	# check we can download
	if (ini_get('allow_url_fopen') == false) {
		echo '<br /><div class="sfoptionerror">';
		spa_etext('Your server will not allow us to download the language files from Simple:Press');
		echo '</div>';
		return;
	}

	$userLang = array();
	$userLang['spLang'] = $siteLang;
	$userLang['spRTL'] = is_rtl();

	$formLang = '';
	$displayLang = '';

	spa_paint_open_tab(spa_text('Integration').' - '.spa_text('Language Settings'));
		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Language'), true, 'language-select');

				if(!empty($userLang) && array_key_exists($userLang['spLang'], $langSets)) {
					$formLang = $userLang['spLang'];
				} elseif (array_key_exists($siteLang, $langSets)) {
					$formLang = $siteLang;
				}

				if(!empty($formLang)) {
					foreach($langSets as $lKey => $lName) {
						if($formLang == $lKey) $displayLang = $lName;
					}
				}

				if(empty($formLang)) {
					echo '<br /><div class="sfoptionerror">';
					spa_etext('Your site language setting has not been recognised by Simple:Press. Please select the correct language from the available list');
					echo '</div>';

					spa_paint_select_start(spa_text('Your site language setting').' - <b>'.$formLang.'</b>', 'spLang', '');
					foreach($langSets as $lKey => $lName) {
						$sel = ($formLang==$lKey) ? ' selected="selected" ' : '';
						echo '<option value="'.$lKey.'"'.$sel.'>'.$lName.'</option>';
					}
					spa_paint_select_end();
				} else {
					echo '<br /><div class="sfoptionerror">';
					echo spa_text('Your site language is set to').' <b>'.$formLang.' - '.$displayLang.'</b>';
					echo '</div>';
				}

			spa_paint_close_fieldset();
		spa_paint_close_panel();

		spa_paint_close_container();
		echo '<div class="sfform-panel-spacer"></div>';

	spa_paint_close_tab();

	echo '<div class="sfform-panel-spacer"></div>';

	# Now stop if we still do not know the language
	if(empty($userLang['spLang'])) return;

	# load up the XML file
	$c = wp_remote_get('http://simple-press.com/downloads/simple-press/simple-press.xml');
	if (is_wp_error($c) || wp_remote_retrieve_response_code($c) != 200) {
		echo '<p>'.spa_text('Unable to communicate with Simple Press server').'</p>';
		return;
	}
	$l = new SimpleXMLElement($c['body']);
	if (empty($l)) {
		echo '<p>'.spa_text('Unable to communicate with Simple Press server').'</p>';
		return;
	}

	# Core, theme and plugin lists and downloads
	$gif = SFCOMMONIMAGES.'working.gif';
	$site = SFHOMEURL.'index.php?sp_ahah=integration-langs&amp;sfnonce='.wp_create_nonce('forum-ahah');
	$x = 0;

	spa_paint_open_tab(spa_text('Integration').' - '.spa_text('Language Translations'), true);
		spa_paint_open_panel();
			echo '<br />';
			echo '&nbsp;&nbsp;<img src="'.SFADMINIMAGES.'sp_Yes.png" title="'.spa_text('Translation file installed').'" alt="" style="vertical-align: middle;" />&nbsp;&nbsp;'.spa_text('Translation file installed');
			echo '&nbsp;&nbsp;<img src="'.SFADMINIMAGES.'sp_No.png" title="'.spa_text('No Translation file installed').'" alt="" style="vertical-align: middle;" />&nbsp;&nbsp;'.spa_text('No Translation file installed');

			# Core - front and admin

			spa_paint_open_fieldset(spa_text('Core Simple:Press'), false);

				$item = $l->core;
				$version = $item->version;

				echo '<table class="wp-list-table widefat">';
					echo '<tr><td width="50%"><b>Core: Simple:Press '.$version.'</b></td>';
					$thisItem = $site.'&amp;item=corefront&amp;version='.str_replace('.', '', $version).'&amp;langcode='.$userLang['spLang'].'&amp;textdom=sp';
					$target = 'spItem'.$x;
					$x++;
					echo '<td><span id="'.$target.'">';
					if(sp_check_for_mo('language-sp', 'sp', $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
					echo '&nbsp;&nbsp;';
					echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';

					echo '<tr class="alternate"><td width="50%"><b>Core: Administration '.$version.'</b></td>';
					$thisItem = $site.'&amp;item=coreadmin&amp;version='.str_replace('.', '', $version).'&amp;langcode='.$userLang['spLang'].'&amp;textdom=spa';
					$target = 'spItem'.$x;
					$x++;
					echo '<td><span id="'.$target.'">';
					if(sp_check_for_mo('language-sp', 'spa', $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
					echo '&nbsp;&nbsp;';
					echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';
				echo '</table>';

			spa_paint_close_fieldset();

			# Themes in use

			spa_paint_open_fieldset(spa_text('Active Simple:Press Themes'), false);

				$list = $l->themes;
				$done = array();
				$class = 'alternate';

				echo '<table class="wp-list-table widefat">';
					$t = sp_get_option('sp_current_theme');
					$theme=$t['theme'];
					$done[]=$theme;
					$data = sp_get_xml_theme_entry($list, $theme);
					$class = ( $class == 'alternate' ) ? '' : 'alternate';
					$name = (isset($data->name)) ? $data->name : $theme;
					echo '<tr class="'.$class.'"><td width="50%"><b>'.$name.'</b></td>';
					if(isset($data->name)) {
						$thisItem = $site.'&amp;item=theme&amp;langcode='.$userLang['spLang'].'&amp;textdom='.$data->lang.'&amp;name='.$theme;
						$target = 'spItem'.$x;
						$x++;
						echo '<td><span id="'.$target.'">';
						if(sp_check_for_mo('language-sp-themes', $data->lang, $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
						echo '&nbsp;&nbsp;';
						echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';
					} else {
						echo '<td>'.spa_text('No Translation Project Exists').'</td></tr>';
					}
					$t = sp_get_option('sp_tablet_theme');
					if($t['active']) {
						$theme=$t['theme'];
						if(!in_array($theme, $done)) {
							$done[]=$theme;
							$data = sp_get_xml_theme_entry($list, $theme);
							$class = ( $class == 'alternate' ) ? '' : 'alternate';
							$name = (isset($data->name)) ? $data->name : $theme;
							echo '<tr class="'.$class.'"><td width="50%"><b>'.$name.'</b></td>';
							if(isset($data->name)) {
								$thisItem = $site.'&amp;item=theme&amp;langcode='.$userLang['spLang'].'&amp;textdom='.$data->lang.'&amp;name='.$theme;
								$target = 'spItem'.$x;
								$x++;
								echo '<td><span id="'.$target.'">';
								if(sp_check_for_mo('language-sp-themes', $data->lang, $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
								echo '&nbsp;&nbsp;';
								echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';
							} else {
								echo '<td>'.spa_text('No Translation Project Exists').'</td></tr>';
							}
						}
					}

					$t = sp_get_option('sp_mobile_theme');
					if($t['active']) {
						$theme=$t['theme'];
						if(!in_array($theme, $done)) {
							$done[]=$theme;
							$data = sp_get_xml_theme_entry($list, $theme);
							$class = ( $class == 'alternate' ) ? '' : 'alternate';
							$name = (isset($data->name)) ? $data->name : $theme;
							echo '<tr class="'.$class.'"><td width="50%"><b>'.$name.'</b></td>';
							if(isset($data->name)) {
								$thisItem = $site.'&amp;item=theme&amp;langcode='.$userLang['spLang'].'&amp;textdom='.$data->lang.'&amp;name='.$theme;
								$target = 'spItem'.$x;
								$x++;
								echo '<td><span id="'.$target.'">';
								if(sp_check_for_mo('language-sp-themes', $data->lang, $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
								echo '&nbsp;&nbsp;';
								echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';
							} else {
								echo '<td>'.spa_text('No Translation Project Exists').'</td></tr>';
							}
						}
					}
				echo '</table>';

			spa_paint_close_fieldset();

			# Plugins if any

			$plugins = sp_get_option('sp_active_plugins');
			if($plugins) {

				spa_paint_open_fieldset(spa_text('Active Simple:Press Plugins'), false);

					echo '<table class="wp-list-table widefat">';

						$list = $l->plugins;
						$class = 'alternate';

						foreach($plugins as $plugin) {
							$name = explode('/', $plugin);
							$data = sp_get_xml_plugin_entry($list, $name[0]);
							$class = ( $class == 'alternate' ) ? '' : 'alternate';
							$plugname = (isset($data->name)) ? $data->name : $name[0];
							echo '<tr class="'.$class.'"><td width="50%"><b>'.$plugname.'</b></td>';
							if(isset($data->name)) {
								$thisItem = $site.'&amp;item=plugin&amp;langcode='.$userLang['spLang'].'&amp;textdom='.$data->lang.'&amp;name='.$name[0];
								$target = 'spItem'.$x;
								$x++;
								echo '<td><span id="'.$target.'">';
								if(sp_check_for_mo('language-sp-plugins', $data->lang, $thisItem, $target) ? $btext = spa_text('Get Latest') : $btext = spa_text('Install'));
								echo '&nbsp;&nbsp;';
								echo '<input type="button" class="logDetail button" value="'.$btext.'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" /></span></td></tr>';
							} else {
								echo '<td>'.spa_text('No Translation Project Exists').'</td></tr>';
							}
						}
					echo '</table>';

				spa_paint_close_fieldset();
			}

		spa_paint_close_panel();
		echo '<div class="sfform-panel-spacer"></div>';

		spa_paint_close_container();
	spa_paint_close_tab();
}

# --- Support Functions ---

function sp_get_xml_theme_entry($list, $cTheme) {
	$data = '';
	foreach ($list->theme as $theme) {
		if($theme->display == 'yes' && (strcasecmp($theme->name, $cTheme) == 0)) {
			$data = $theme;
			break;
		}
	}
	return $data;
}

function sp_get_xml_plugin_entry($list, $cPlugin) {
	$data = '';
	foreach ($list->plugin as $plugin) {
		if($plugin->display == 'yes' && (strcasecmp($plugin->folder, $cPlugin) == 0)) {
			$data = $plugin;
			break;
		}
	}
	return $data;
}

function sp_check_for_mo($folder, $tDom, $thisItem, $target) {
	global $spPaths, $siteLang;
	$moFile = WP_CONTENT_DIR.'/'.$spPaths[$folder].'/'.$tDom.'-'.$siteLang.'.mo';
	if(file_exists($moFile)) {
		$gif = SFCOMMONIMAGES.'working.gif';
		echo '<img src="'.SFADMINIMAGES.'sp_Yes.png" title="'.spa_text('Translation file found').'" alt="" style="vertical-align: middle;" />';
		echo '&nbsp;&nbsp;';
		$thisItem.= '&amp;remove=1';
		echo '<input type="button" class="logDetail button" value="'.spa_text('Remove').'" onclick="spjLoadAhah(\''.$thisItem.'\', \''.$target.'\', \''.$gif.'\');" />';
		return true;
	} else {
		echo '<img src="'.SFADMINIMAGES.'sp_No.png" title="'.spa_text('No translation file found').'" alt="" style="vertical-align: middle;" />';
		return false;
	}
}

?>