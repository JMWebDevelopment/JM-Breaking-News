<?php
/**
 * File that displays the custom meta box for the breaking custom post type.
 *
 * PHP version 7.3
 *
 * @link       https://jacobmartella.com
 * @since      2.0.0
 *
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/admin/partials
 */

global $post;
$values = get_post_custom( $post->ID );
if ( isset( $values['jm_breaking_news_in_ex'] ) ) {
	$in_ex = $values['jm_breaking_news_in_ex'][0];
} else {
	$in_ex = '0';
}
if ( isset( $values['jm_breaking_news_link'] ) ) {
	$link = $values['jm_breaking_news_link'][0];
} else {
	$link = '';
}
if ( isset( $values['jm_breaking_news_internal_link'] ) ) {
	$internal_link = $values['jm_breaking_news_internal_link'][0];
} else {
	$internal_link = '';
}
if ( isset( $values['jm_breaking_news_target'] ) ) {
	$target = $values['jm_breaking_news_target'][0];
} else {
	$target = '';
}
if ( isset( $values['jm_breaking_news_limit'] ) ) {
	$limit = $values['jm_breaking_news_limit'][0];
} else {
	$limit = 1;
}
if ( isset( $values['jm_breaking_news_color'] ) ) {
	$color = $values['jm_breaking_news_color'][0];
} else {
	$color = '#C42B2B';
}
if ( isset( $values['jm_breaking_news_background_color'] ) ) {
	$background_color = $values['jm_breaking_news_background_color'][0];
} else {
	$background_color = '#262626';
}
if ( isset( $values['jm_breaking_news_text_color'] ) ) {
	$text_color = $values['jm_breaking_news_text_color'][0];
} else {
	$text_color = '#ffffff';
}
if ( isset( $values['jm_breaking_news_news_text_color'] ) ) {
	$news_text_color = $values['jm_breaking_news_news_text_color'][0];
} else {
	$news_text_color = '#ffffff';
}

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
echo '<td><input type="text" name="jm_breaking_news_color" id="jm_breaking_news_color" value="' . $color .'" class="color-field" /></td>';
echo '</tr>';

echo '<tr>';
echo '<td><label for="jm_breaking_news_background_color">' . __( 'Background Color for body section', 'jm-breaking-news' ) . '</label></td>';
echo '<td><input type="text" name="jm_breaking_news_background_color" id="jm_breaking_news_background_color" value="' . $background_color .'" class="color-field" /></td>';
echo '</tr>';

echo '<tr>';
echo '<td><label for="jm_breaking_news_text_color">' . __( 'Text Color for "Breaking News" section', 'jm-breaking-news' ) . '</label></td>';
echo '<td><input type="text" name="jm_breaking_news_text_color" id="jm_breaking_news_text_color" value="' . $text_color .'" class="color-field" /></td>';
echo '</tr>';

echo '<tr>';
echo '<td><label for="jm_breaking_news_news_text_color">' . __( 'Text Color for body section', 'jm-breaking-news' ) . '</label></td>';
echo '<td><input type="text" name="jm_breaking_news_news_text_color" id="jm_breaking_news_news_text_color" value="' . $news_text_color .'" class="color-field" /></td>';
echo '</tr>';
echo '</table>';
