<?php

add_action('wp_ajax_del_slider_item', 'del_slider_item');
add_action('wp_ajax_nopriv_del_slider_item', 'del_slider_item_must_login');

function del_slider_item() {
	if (!wp_verify_nonce($_REQUEST['nonce'], 'del_slider_item_nonce')) {
		exit('NONCE INCORRECT!');
	}

	$del_item_id = $_REQUEST['item_id'];
	delete_post_meta($del_item_id, 'cmb_slider_feature');

	$result['type'] = 'success';

	//check if this is an ajax call
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	      $result = json_encode($result);
	      echo $result;
	}

	die();

}

function del_slider_item_must_login() {
	die();		
}
