<?php 
/**
* breaking-news-fields.php
*
* File that sets up the custom fields for the breaking news custom post type.
*
* @author Jacob Martella
* @package JM Breaking News
* @version 1.8
*/
//* Add the meta box
function jm_breaking_news_add_box() {
	add_meta_box( 'jm-breaking-news-meta', __( 'Breaking News Info', 'jm-breaking-news' ), 'breaking_news_meta_box_cb', 'jm_breaking_news', 'normal', 'default' );
}
add_action( 'admin_menu', 'jm_breaking_news_add_box' );

$args = array( 'numberposts' => -1 );
global $posts_array;
$posts = get_posts( $args );
foreach( $posts as $post ) {
	setup_postdata( $post );
	$link = get_the_ID();
	$name = get_the_title();
	$posts_array[ $link ] = $name;
}

//* Create the actual meta box
function breaking_news_meta_box_cb() {
	global $post;
	global $posts_array;
	$values = get_post_custom( $post->ID );
	if ( isset( $values[ 'jm_breaking_news_in_ex' ] ) ) { $in_ex = $values[ 'jm_breaking_news_in_ex' ][ 0 ]; } else { $in_ex = '0'; }
	if ( isset( $values[ 'jm_breaking_news_link' ] ) ) { $link = $values[ 'jm_breaking_news_link' ][ 0 ]; } else { $link = ''; }
	if ( isset( $values[ 'jm_breaking_news_internal_link' ] ) ) { $internal_link = $values[ 'jm_breaking_news_internal_link' ][ 0 ]; } else { $internal_link = ''; }
	if ( isset( $values[ 'jm_breaking_news_target' ] ) ) { $target = $values[ 'jm_breaking_news_target' ][ 0 ]; } else { $target = ''; }
	if ( isset( $values[ 'jm_breaking_news_limit' ] ) ) { $limit = $values[ 'jm_breaking_news_limit' ][ 0 ]; } else { $limit = 1; }
	if ( isset( $values[ 'jm_breaking_news_color' ] ) ) { $color = $values[ 'jm_breaking_news_color' ][ 0 ]; } else { $color = '#C42B2B'; }
    if ( isset( $values[ 'jm_breaking_news_background_color' ] ) ) { $background_color = $values[ 'jm_breaking_news_background_color' ][ 0 ]; } else { $background_color = '#262626'; }
    if ( isset( $values[ 'jm_breaking_news_text_color' ] ) ) { $text_color = $values[ 'jm_breaking_news_text_color' ][ 0 ]; } else { $text_color = '#ffffff'; }
    if ( isset( $values[ 'jm_breaking_news_news_text_color' ] ) ) { $news_text_color = $values[ 'jm_breaking_news_news_text_color' ][ 0 ]; } else { $news_text_color = '#ffffff'; }

	wp_nonce_field( 'jm_breaking_news_nonce', 'meta_box_nonce' );

	echo '<table class="jm-breaking-news-fields">';
	echo '<tr>';
	echo '<td><label for="jm_breaking_news_in_ex">' . __( 'External Link', 'jm-breaking-news' ) . '</label>';
	echo '<input type="radio" name="jm_breaking_news_in_ex" id="jm_breaking_news_external" value="0"' . checked( $in_ex, 0, false ) . ' />';
	echo '<label for="jm_breaking_news_in_ex">' . __('Internal Link', 'jm-breaking-news') . '</label>';
	echo '<input type="radio" name="jm_breaking_news_in_ex" id="jm_breaking_news_internal" value="1"' . checked( $in_ex, 1, false ) . ' /></td>';
	echo '</tr>';

	if ( $in_ex == 1 ) { $ex_display_style = 'style="display:none;"'; } else { $ex_display_style = ''; }
	echo '<tr id="external-link" ' . $ex_display_style . ' >';
	echo '<td><label for="jm_breaking_news_link">' . __( 'Breaking News Link', 'jm-breaking-news' ) . '</label></td>';
	echo '<td><input type="text" name="jm_breaking_news_link" id="jm_breaking_news_link" value="' . $link .'" /></td>';
	echo '</tr>';

	if ( $in_ex == 0 ) { $in_display_style = 'style="display:none;"'; } else { $in_display_style = ''; }
	echo '<tr id="internal-link" ' . $in_display_style . ' >';
	echo '<td><label for="jm_breaking_news_internal_link">' . __( 'Breaking News Link', 'jm-breaking-news' ) . '</label></td>';
	echo '<td><select id="jm_breaking_news_internal_link" name="jm_breaking_news_internal_link">';
	foreach ( $posts_array as $key => $name ) {
		if ( $key == $internal_link ) {
			$selected = 'selected="selected"';
		} else {
			$selected = '';
		}
		echo '<option value="' . $key . '" ' . $selected . '>' . $name . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td><label for="jm_breaking_news_target">' . __( 'Display Link in New Window', 'jm-breaking-news' ) . '</label></td>';
	echo '<td><input type="checkbox" name="jm_breaking_news_target" id="jm_breaking_news_target" value="1" ' . checked( $target, 1, false ) . '  /></td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td><label for="jm_breaking_news_limit">' . __( 'Time Limit to Show Breaking News', 'jm-breaking-news' ) . '</label></td>';
	echo '<td><input type="number" min="1" max="48" name="jm_breaking_news_limit" id="jm_breaking_news_limit" value="' . $limit .'" /></td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td><label for="jm_breaking_news_color">' . __( 'Background Color for "Breaking News" section', 'jm-breaking-news' ) . '</label></td>';
	echo '<td><input type="text" name="jm_breaking_news_color" id="jm_breaking_news_color" value="' . $color .'" /></td>';
	echo '</tr>';

    echo '<tr>';
    echo '<td><label for="jm_breaking_news_background_color">' . __( 'Background Color for body section', 'jm-breaking-news' ) . '</label></td>';
    echo '<td><input type="text" name="jm_breaking_news_background_color" id="jm_breaking_news_background_color" value="' . $background_color .'" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="jm_breaking_news_text_color">' . __( 'Text Color for "Breaking News" section', 'jm-breaking-news' ) . '</label></td>';
    echo '<td><input type="text" name="jm_breaking_news_text_color" id="jm_breaking_news_text_color" value="' . $text_color .'" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="jm_breaking_news_news_text_color">' . __( 'Text Color for body section', 'jm-breaking-news' ) . '</label></td>';
    echo '<td><input type="text" name="jm_breaking_news_news_text_color" id="jm_breaking_news_news_text_color" value="' . $news_text_color .'" /></td>';
    echo '</tr>';
    echo '</table>';
}

if ( ! function_exists( 'check_color' ) ) {
	function check_color( $value ) {
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #
			return true;
		}

		return false;
	}
}

//* Save and sanitize the meta box
function jm_breaking_news_save_box( $post_id ) {
	global $posts_array;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if( ! isset( $_POST[ 'meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'meta_box_nonce' ], 'jm_breaking_news_nonce' ) ) {
		return;
	}
	/*if( !current_user_can( 'edit_post' ) ) {
		return;
	}*/

	if ( isset( $_POST[ 'jm_breaking_news_in_ex' ] ) && $_POST[ 'jm_breaking_news_in_ex' ] && $_POST[ 'jm_breaking_news_in_ex' ] == 1 ) { $check = 1; } else { $check = 0; }
    update_post_meta( $post_id, 'jm_breaking_news_in_ex', $check );

	if( isset( $_POST[ 'jm_breaking_news_link' ] ) ) {
        update_post_meta( $post_id, 'jm_breaking_news_link', wp_filter_nohtml_kses( $_POST[ 'jm_breaking_news_link' ] ) );
    }

	if( isset( $_POST[ 'jm_breaking_news_limit' ] ) ) {
        update_post_meta( $post_id, 'jm_breaking_news_limit', intval( esc_attr( $_POST[ 'jm_breaking_news_limit' ] ) ) );
    }

    if ( isset( $_POST[ 'jm_breaking_news_target'] ) && $_POST[ 'jm_breaking_news_target' ] ) { $check = 1; } else { $check = 0; }
    update_post_meta( $post_id, 'jm_breaking_news_target', $check );

    
	if ( isset( $_POST[ 'jm_breaking_news_internal_link' ] ) && array_key_exists( $_POST[ 'jm_breaking_news_internal_link' ], $posts_array ) ) {
		update_post_meta( $post_id, 'jm_breaking_news_internal_link', wp_filter_nohtml_kses( $_POST[ 'jm_breaking_news_internal_link' ] ) );
	}

    $color = strip_tags( stripslashes( trim( $_POST[ 'jm_breaking_news_color' ] ) ) );
    $background_color = strip_tags( stripslashes( trim( $_POST[ 'jm_breaking_news_background_color' ] ) ) );
    $text_color = strip_tags( stripslashes( trim( $_POST[ 'jm_breaking_news_text_color' ] ) ) );
    $news_text_color = strip_tags( stripslashes( trim( $_POST[ 'jm_breaking_news_news_text_color' ] ) ) );

    if( TRUE === check_color( $color ) ) {
		update_post_meta( $post_id, 'jm_breaking_news_color', $color );
    }
    if( TRUE === check_color( $background_color ) ) {
        update_post_meta( $post_id, 'jm_breaking_news_background_color', $background_color );
    }
    if( TRUE === check_color( $text_color ) ) {
        update_post_meta( $post_id, 'jm_breaking_news_text_color', $text_color );
    }
    if( TRUE === check_color( $news_text_color ) ) {
        update_post_meta( $post_id, 'jm_breaking_news_news_text_color', $news_text_color );
    }
}
add_action( 'save_post', 'jm_breaking_news_save_box' );
?>