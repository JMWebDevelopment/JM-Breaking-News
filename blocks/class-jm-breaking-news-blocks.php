<?php
/**
 * Holds all of the admin side functions.
 *
 * PHP version 7.3
 *
 * @link       https://jacobmartella.com
 * @since      2.0.0
 *
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/admin
 */

namespace JM_Breaking_News;

use WP_Query;

/**
 * Runs the admin side.
 *
 * This class defines all code necessary to run on the admin side of the plugin.
 *
 * @since      2.0.0
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/admin
 */
class JM_Breaking_News_Blocks {

	/**
	 * Version of the plugin.
	 *
	 * @since 2.0.0
	 * @var string $version Description.
	 */
	private $version;


	/**
	 * Builds the JM_Breaking_News object.
	 *
	 * @since 2.0.0
	 *
	 * @param string $version Version of the plugin.
	 */
	public function __construct( $version ) {
		$this->version = $version;
	}

	public function create_blocks() {
		register_block_type(
			__DIR__ . '/build/breaking-news-block',
			array(
				'render_callback' => array( $this, 'render_jm_breaking_news_block' ),
			)
		);
	}

	/**
	 * Render callback function.
	 *
	 * @param array    $attributes The block attributes.
	 * @param string   $content    The block content.
	 * @param WP_Block $block      Block instance.
	 *
	 * @return string The rendered output.
	 */
	public function render_jm_breaking_news_block( $attributes, $content, $block ) {
		ob_start();
		require plugin_dir_path( __FILE__ ) . 'build/breaking-news-block/template.php';
		return ob_get_clean();
	}

}
