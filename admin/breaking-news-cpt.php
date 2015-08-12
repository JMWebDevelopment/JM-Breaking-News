<?php 
/**
* Breaking-news-cpt.php
*
* File that create the breaking news custom post type
*
* @author Jacob Martella
* @package JM Breaking News
* @version 1.3
*/
function jm_breaking_news_cpt() {
	$labels = array(
		'name' => __('Breaking News', 'jm-breaking-news'),
		'singular_name' => __('Breaking News Post', 'jm-breaking-news'),
		'add_new' => __('Add New', 'jm-breaking-news'),
		'add_new_item' => __('Add New Breaking News Item', 'jm-breaking-news'),
		'edit_item' => __('Edit Breaking News Item', 'jm-breaking-news'),
		'new_item' => __('New Breaking News Item', 'jm-breaking-news'),
		'all_items' => __('All Breaking News Items', 'jm-breaking-news'),
		'view_item' => __('View Breaking News Item', 'jm-breaking-news'),
		'search_items' => __('Search Breaking News', 'jm-breaking-news'),
		'not_found' => __('No Breaking News Found', 'jm-breaking-news'),
		'not_found_in_trash' => __('No Breaking News in Trash', 'jm-breaking-news'),
		'menu_name' => __('Breaking News', 'jm-breaking-news')
	);
	$args = array(
		'labels' => $labels,
		'description' => __('Post type to put breaking news text and a link.', 'jm-breaking-news'),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-lightbulb',
		'supports' => array('title'),
	);
	register_post_type('jm_breaking_news', $args);
}
add_action('init', 'jm_breaking_news_cpt');
?>