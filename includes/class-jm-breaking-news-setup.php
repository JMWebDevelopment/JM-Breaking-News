<?php
/**
 * Add in extra functionality like custom post types or taxonomies.
 *
 * @link       https://jacobmartella.com
 * @since      2.0.0
 *
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/includes
 */

namespace JM_Breaking_News;

/**
 * Add in extra functionality like custom post types or taxonomies.
 *
 * @since      2.0.0
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/includes
 */
class JM_Breaking_News_Setup {

	/**
	 * Creates the breaking new custom post type.
	 *
	 * @since 2.0.0
	 */
	public function custom_post_type() {
		$labels = [
			'name'               => __( 'Breaking News', 'jm-breaking-news' ),
			'singular_name'      => __( 'Breaking News Post', 'jm-breaking-news' ),
			'add_new'            => __( 'Add New', 'jm-breaking-news' ),
			'add_new_item'       => __( 'Add New Breaking News Item', 'jm-breaking-news' ),
			'edit_item'          => __( 'Edit Breaking News Item', 'jm-breaking-news' ),
			'new_item'           => __( 'New Breaking News Item', 'jm-breaking-news' ),
			'all_items'          => __( 'All Breaking News Items', 'jm-breaking-news' ),
			'view_item'          => __( 'View Breaking News Item', 'jm-breaking-news' ),
			'search_items'       => __( 'Search Breaking News', 'jm-breaking-news' ),
			'not_found'          => __( 'No Breaking News Found', 'jm-breaking-news' ),
			'not_found_in_trash' => __( 'No Breaking News in Trash', 'jm-breaking-news' ),
			'menu_name'          => __( 'Breaking News', 'jm-breaking-news' )
		];

		$args = [
			'labels'        => $labels,
			'description'   => __( 'Post type to put breaking news text and a link.', 'jm-breaking-news' ),
			'public'        => true,
			'menu_position' => 5,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-lightbulb',
			'supports'      => array( 'title' ),
		];

		register_post_type( 'jm_breaking_news', $args );
	}

}
