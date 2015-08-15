<?php

// TODO - figure out how to get this more robustly
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-load.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-admin/includes/post.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-includes/post.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-includes/formatting.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-admin/includes/media.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-admin/includes/file.php');
/** @noinspection PhpIncludeInspection */
require_once ('../../../wp-admin/includes/image.php');

nocache_headers();

$id = media_handle_upload('file', $_REQUEST['postID']);

if (is_wp_error($$id)) {
    // TODO
    // esc_html($id->get_error_message()) . '</div>';
}

$post = get_post($id);

$filename = esc_html(basename($post->guid));
$title = esc_attr($post->post_title);
// $post->post_mime_type
// $meta = wp_get_attachment_metadata( $post->ID );

$link = '';

// Return JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id","imageLink" : "' . $link . '"}');


