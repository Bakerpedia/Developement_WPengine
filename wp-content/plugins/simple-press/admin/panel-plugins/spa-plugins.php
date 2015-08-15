<?php
/*
Simple:Press
Admin Plugins
$LastChangedDate: 2014-06-21 20:33:29 -0700 (Sat, 21 Jun 2014) $
$Rev: 11585 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# Check Whether User Can Manage Admins
global $spStatus;

# Check Whether User Can Manage Plugins
# dont check for admin panels loaded by plugins - the plugins api will do that
$tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'plugin-list';
if ($tab != 'plugin') {
    if (!sp_current_user_can('SPF Manage Plugins')) {
   		spa_etext('Access denied - you do not have permission');
    	die();
    }
}

include_once SF_PLUGIN_DIR.'/admin/panel-plugins/spa-plugins-display.php';
include_once SF_PLUGIN_DIR.'/admin/panel-plugins/support/spa-plugins-prepare.php';
include_once SF_PLUGIN_DIR.'/admin/panel-plugins/support/spa-plugins-save.php';
include_once SF_PLUGIN_DIR.'/admin/library/spa-tab-support.php';
include_once SPAPI.'sp-api-plugins.php';
include_once SPAPI.'sp-api-themes.php';

if ($spStatus != 'ok') {
    include_once SPLOADINSTALL;
    die();
}

global $adminhelpfile;
$adminhelpfile = 'admin-plugins';
# --------------------------------------------------------------------

$action = (isset($_GET['action'])) ? $_GET['action'] : '';
$title  = (isset($_GET['title'])) ? sp_esc_str($_GET['title']) : '';
$plugin = (isset($_GET['plugin'])) ? sp_esc_str($_GET['plugin']) : '';

if ($action && $action == 'uninstall') {
    $msg = spa_text('Please confirm that you want to uninstall this plugin?');
?>
    <script type="text/javascript">
        if (confirm('<?php echo $msg; ?>')) {
            window.location = '<?php echo SFADMINPLUGINS."&plugin=$plugin&action=uninstall_confirmed&sfnonce=".wp_create_nonce('forum-adminform_plugins'); ?>';
        } else {
            window.location = '<?php echo SFADMINPLUGINS."&plugin=$plugin&action=uninstall_cancelled&sfnonce=".wp_create_nonce('forum-adminform_plugins'); ?>';
        }
    </script>
<?php
    die();
}

# was there a plugin action?
if ($action && $action != 'uninstall_cancelled') spa_save_plugin_activation();

spa_panel_header();
spa_render_plugins_panel($tab);
spa_panel_footer();

if ($action) {
	if ($action == 'activate') $msg = $title.' '.spa_text('Plugin').' <strong>'.spa_text('Activated').'</strong>';
	if ($action == 'deactivate') $msg = $title.' '.spa_text('Plugin').' <strong>'.spa_text('Deactivated').'</strong>';
	if ($action == 'uninstall_confirmed') $msg = $title.' '.spa_text('Plugin').' <strong>'.spa_text('Deactivated and Uninstalled').'</strong>';
	if ($action == 'uninstall_cancelled') $msg = spa_text('Plugin uninstall cancelled');
	if ($action == 'delete') $msg = $title.' '.spa_text('Plugin').' <strong>'.spa_text('Deleted').'</strong>';
	$msg = apply_filters('sph_plugin_message', $msg);

    if ($action != 'uninstall_cancelled') {
?>
    	<script type="text/javascript">
        	jQuery(document).ready(function(){
        		jQuery("#sfmsgspot").fadeIn("fast");
        		jQuery("#sfmsgspot").html("<?php echo $msg; ?>");
        		jQuery("#sfmsgspot").fadeOut(8000);
        		window.location = '<?php echo SFADMINPLUGINS; ?>';
        	});
    	</script>
<?php
    }
}
?>