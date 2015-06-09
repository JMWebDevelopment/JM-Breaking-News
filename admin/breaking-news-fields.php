<?php 
/**
* breaking-news-fields.php
*
* File that sets up the custom fields for the breaking news custom post type.
*
* @author Jacob Martella
* @package JM Breaking News
* @version 1.0
*/
//* Add the meta box
function jm_breaking_news_add_box() {
	add_meta_box('jm-breaking-news-meta', __('Breaking News Info', 'jm-breaking-news'), 'breaking_news_meta_box_cb', 'jm_breaking_news', 'normal', 'default');
}
add_action('admin_menu', 'jm_breaking_news_add_box');

//* Create the actual meta box
function breaking_news_meta_box_cb() {
	global $post;
	$values = get_post_custom($post->ID);
	if (isset($values['jm_breaking_news_link'])) { $link = $values['jm_breaking_news_link'][0]; } else { $link = ''; }
	if (isset($values['jm_breaking_news_target'])) { $target = $values['jm_breaking_news_target'][0]; } else { $target = ''; }
	if (isset($values['jm_breaking_news_limit'])) { $limit = $values['jm_breaking_news_limit'][0]; } else { $limit = ''; }

	wp_nonce_field('jm_breaking_news_nonce', 'meta_box_nonce');

	echo '<p>';
	echo '<label for="jm_breaking_news_link">' . __('Breaking News Link', 'jm-breaking-news') . '</label>';
	echo '<input type="text" name="jm_breaking_news_link" id="jm_breaking_news_link" value="' . $link .'" class="widefat" />';
	echo '</p>';

	echo '<p>';
	echo '<label for="jm_breaking_news_target">' . __('Display Link in New Window', 'jm-breaking-news') . '</label>';
	echo '<input type="checkbox" name="jm_breaking_news_target" id="jm_breaking_news_target" value="1" ' . checked($target, 1, false) . '  />';
	echo '</p>';

	echo '<p>';
	echo '<label for="jm_breaking_news_limit">' . __('Time Limit to Show Breaking News', 'jm-breaking-news') . '</label>';
	echo '<input type="number" min="1" max="48" name="jm_breaking_news_limit" id="jm_breaking_news_limit" value="' . $limit .'" />';
	echo '</p>';
}

//* Save and sanitize the meta box
function jm_breaking_news_save_box($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'jm_breaking_news_nonce' ) ) {
		return;
	}
	if( !current_user_can( 'edit_post' ) ) {
		return;
	}

	if(isset($_POST['jm_breaking_news_link'])) {
        update_post_meta($post_id, 'jm_breaking_news_link', wp_filter_nohtml_kses($_POST['jm_breaking_news_link']));
    }

	if(isset($_POST['jm_breaking_news_limit'])) {
        update_post_meta($post_id, 'jm_breaking_news_limit', intval(esc_attr($_POST['jm_breaking_news_limit'])));
    }

    if (isset( $_POST['jm_breaking_news_target'] ) && $_POST['jm_breaking_news_target']) { $check = 1; } else { $check = 0; }
    update_post_meta( $post_id, 'jm_breaking_news_target', $check );
}
add_action('save_post', 'jm_breaking_news_save_box');
?>