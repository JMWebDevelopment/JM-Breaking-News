<?php 
/**
* breaking-news-fields.php
*
* File that sets up the custom fields for the breaking news custom post type.
*
* @author Jacob Martella
* @package JM Breaking News
* @version 1.2
*/
//* Add the meta box
function jm_breaking_news_add_box() {
	add_meta_box('jm-breaking-news-meta', __('Breaking News Info', 'jm-breaking-news'), 'breaking_news_meta_box_cb', 'jm_breaking_news', 'normal', 'default');
}
add_action('admin_menu', 'jm_breaking_news_add_box');

$args = array('numberposts' => -1);
global $posts_array;
$posts = get_posts($args);
foreach($posts as $post) {
	setup_postdata($post);
	$link = get_the_permalink(get_the_ID());
	$name = get_the_title();
	$posts_array[$link] = $name;
}

//* Create the actual meta box
function breaking_news_meta_box_cb() {
	global $post;
	global $posts_array;
	$values = get_post_custom($post->ID);
	if (isset($values['jm_breaking_news_in_ex'])) { $in_ex = $values['jm_breaking_news_in_ex'][0]; } else { $in_ex = '0'; }
	if (isset($values['jm_breaking_news_link'])) { $link = $values['jm_breaking_news_link'][0]; } else { $link = ''; }
	if (isset($values['jm_breaking_news_internal_link'])) { $internal_link = $values['jm_breaking_news_internal_link'][0]; } else { $internal_link = ''; }
	if (isset($values['jm_breaking_news_target'])) { $target = $values['jm_breaking_news_target'][0]; } else { $target = ''; }
	if (isset($values['jm_breaking_news_limit'])) { $limit = $values['jm_breaking_news_limit'][0]; } else { $limit = 1; }

	wp_nonce_field('jm_breaking_news_nonce', 'meta_box_nonce');

	echo '<p>';
	echo '<label for="jm_breaking_news_in_ex">' . __('External Link', 'jm-breaking-news') . '</label>';
	echo '<input type="radio" name="jm_breaking_news_in_ex" id="jm_breaking_news_external" value="0"' . checked($in_ex, 0, false) . ' />';
	echo '<label for="jm_breaking_news_in_ex">' . __('Internal Link', 'jm-breaking-news') . '</label>';
	echo '<input type="radio" name="jm_breaking_news_in_ex" id="jm_breaking_news_internal" value="1"' . checked($in_ex, 1, false) . ' />';
	echo '</p>';

	if ($in_ex == 1) { $ex_display_style = 'style="display:none;"'; } else { $ex_display_style = ''; }
	echo '<p id="external-link" ' . $ex_display_style . ' >';
	echo '<label for="jm_breaking_news_link">' . __('Breaking News Link', 'jm-breaking-news') . '</label>';
	echo '<input type="text" name="jm_breaking_news_link" id="jm_breaking_news_link" value="' . $link .'" />';
	echo '</p>';

	if ($in_ex == 0) { $in_display_style = 'style="display:none;"'; } else { $in_display_style = ''; }
	echo '<p id="internal-link" ' . $in_display_style . ' >';
	echo '<label for="jm_breaking_news_internal_link">' . __('Breaking News Link', 'jm-breaking-news') . '</label>';
	echo '<select id="jm_breaking_news_internal_link" name="jm_breaking_news_internal_link">';
	foreach ($posts_array as $key => $name) {
		if ($key == $internal_link) {
			$selected = 'selected="selected"';
		} else {
			$selected = '';
		}
		echo '<option value="' . $key . '" ' . $selected . '>' . $name . '</option>';
	}
	echo '</select>';
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
	global $posts_array;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'jm_breaking_news_nonce' ) ) {
		return;
	}
	if( !current_user_can( 'edit_post' ) ) {
		return;
	}

	if (isset( $_POST['jm_breaking_news_in_ex'] ) && $_POST['jm_breaking_news_in_ex'] && $_POST['jm_breaking_news_in_ex'] == 1 ) { $check = 1; } else { $check = 0; }
    update_post_meta( $post_id, 'jm_breaking_news_in_ex', $check );

	if(isset($_POST['jm_breaking_news_link'])) {
        update_post_meta($post_id, 'jm_breaking_news_link', wp_filter_nohtml_kses($_POST['jm_breaking_news_link']));
    }

	if(isset($_POST['jm_breaking_news_limit'])) {
        update_post_meta($post_id, 'jm_breaking_news_limit', intval(esc_attr($_POST['jm_breaking_news_limit'])));
    }

    if (isset( $_POST['jm_breaking_news_target'] ) && $_POST['jm_breaking_news_target']) { $check = 1; } else { $check = 0; }
    update_post_meta( $post_id, 'jm_breaking_news_target', $check );

    
	if (isset($_POST['jm_breaking_news_internal_link']) && array_key_exists($_POST['jm_breaking_news_internal_link'], $posts_array)) {
		update_post_meta($post_id, 'jm_breaking_news_internal_link', wp_filter_nohtml_kses($_POST['jm_breaking_news_internal_link']));
	}
}
add_action('save_post', 'jm_breaking_news_save_box');
?>