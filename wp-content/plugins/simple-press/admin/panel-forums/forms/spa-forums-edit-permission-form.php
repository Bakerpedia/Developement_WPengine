<?php
/*
Simple:Press
Admin Forums Edit Permission Form
$LastChangedDate: 2014-06-20 20:47:00 -0700 (Fri, 20 Jun 2014) $
$Rev: 11582 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# function to display the edit forum permission set form.  It is hidden until the edit permission set link is clicked
function spa_forums_edit_permission_form($perm_id) {
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
    	spjAjaxForm('sfpermissionnedit<?php echo $perm_id; ?>', 'sfreloadfb');
    });
</script>
<?php
	$perm = spdb_table(SFPERMISSIONS, "permission_id=$perm_id", 'row');

	echo '<div class="sfform-panel-spacer"></div>';

	spa_paint_options_init();

    $ahahURL = SFHOMEURL.'index.php?sp_ahah=forums-loader&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;saveform=editperm';
?>
	<form action="<?php echo $ahahURL; ?>" method="post" id="sfpermissionnedit<?php echo $perm->permission_id; ?>" name="sfpermissionedit<?php echo $perm->permission_id; ?>">
<?php
		echo sp_create_nonce('forum-adminform_permissionedit');
		spa_paint_open_tab(spa_text('Forums').' - '.spa_text('Manage Groups and Forums'), true);
			spa_paint_open_panel();
				spa_paint_open_fieldset(spa_text('Edit Permission Set'), 'true', 'edit-permission-set');
?>
					<input type="hidden" name="permission_id" value="<?php echo $perm->permission_id; ?>" />
					<input type="hidden" name="ugroup_perm" value="<?php echo $perm->permission_role; ?>" />
					<table class="form-table">
						<tr>
							<td class="sflabel"><?php spa_display_permission_select($perm->permission_role); ?></td>
						</tr>
					</table>
<?php
				spa_paint_close_fieldset();
			spa_paint_close_panel();
			do_action('sph_forums_edit_perm_panel');
		spa_paint_close_container();
?>
		<div class="sfform-submit-bar">
		<input type="submit" class="button-primary" id="editperm<?php echo $perm->permission_id; ?>" name="editperm<?php echo $perm->permission_id; ?>" value="<?php spa_etext('Update Permission Set'); ?>" />
		<input type="button" class="button-primary" onclick="javascript:jQuery('#curperm-<?php echo $perm->permission_id; ?>').html('');" id="sfpermissionnedit<?php echo $perm->permission_id; ?>" name="editpermcancel<?php echo $perm->permission_id; ?>" value="<?php spa_etext('Cancel'); ?>" />
		</div>
	</form>

	<?php spa_paint_close_tab(); ?>

	<div class="sfform-panel-spacer"></div>
<?php
}
?>