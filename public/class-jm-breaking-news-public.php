<?php
/**
 * Holds all of the public side functions.
 *
 * PHP version 7.3
 *
 * @link       https://jacobmartella.com
 * @since      2.0.0
 *
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/public
 */

namespace JM_Breaking_News;

/**
 * Runs the public side.
 *
 * This class defines all code necessary to run on the public side of the plugin.
 *
 * @since      2.0.0
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/public
 */
class JM_Breaking_News_Public {

	/**
	 * Version of the plugin.
	 *
	 * @since 2.0.0
	 * @var string $version Description.
	 */
	private $version;

	/**
	 * Builds the JM_Breaking_News_Public object.
	 *
	 * @since 2.0.0
	 *
	 * @param string $version Version of the plugin.
	 */
	public function __construct( $version ) {
		$this->version = $version;
	}

}
