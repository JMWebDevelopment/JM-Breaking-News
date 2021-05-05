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

/**
 * Runs the admin side.
 *
 * This class defines all code necessary to run on the admin side of the plugin.
 *
 * @since      2.0.0
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/admin
 */
class JM_Breaking_News_Admin {

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

	/**
	 * Enqueues the styles for the admin side of the plugin.
	 *
	 * @since SIMPLEPIE_TYPE_RSS_20.0.0
	 */
	public function enqueue_styles() {
		global $typenow;

		if ( 'jm_breaking_news' === $typenow ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'jm-breaking-news-admin', plugin_dir_url( __FILE__ ) . 'css/admin-style.min.css', [], $this->version, 'all' );
		}

	}

	/**
	 * Enqueues the scripts for the admin side of the plugin.
	 *
	 * @since 2.0.0
	 */
	public function enqueue_scripts() {
		global $typenow;

		if ( 'jm_breaking_news' === $typenow ) {
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jm-breaking-news-show-hide', plugin_dir_url( __FILE__ ) . 'js/show-hide-fields.min.js', [ 'jquery' ], $this->version, 'all' );
		}
	}

	public function contextual_help( $contextual_help, $screen_id, $screen ) {
		if ( ( 'jm_breaking_news' === $screen->id ) || ( 'edit-jm_breaking_news' === $screen->id ) ) {
			$contextual_help  = '<h2>' . __( 'Breaking News Help', 'jm-breaking-news' ) . '</h2>';
			$contextual_help .= '<ul>';
			$contextual_help .= '<li>' . __( 'Title', 'jm-breaking-news' ) . '<br />' . __( 'The title is the text that is shown in the breaking news banner.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'Internal/External Link', 'jm-breaking-news' ) . '<br />' . __( 'This radio box option allows you to select whether the link is internal or external. The appropriate option will then appear below.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'External Link', 'jm-breaking-news' ) . '<br />' . __( 'This text box is where you can add the external link, if there is one, to the breaking news box.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'Internal Link', 'jm-breaking-news' ) . '<br />' . __( 'This select menu allows you to select a post on your site to link to in the breaking news box.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'Target', 'jm-breaking-news' ) . '<br />' . __( 'Check this box to open the link in a new window.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'Time Limit', 'jm-breaking-news' ) . '<br />' . __( 'Set a time limit for the breaking news banner to show.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '<li>' . __( 'Background Color', 'jm-breaking-news' ) . '<br />' . __( 'Set a background color for the "Breaking News" half of the banner.', 'jm-breaking-news' ) . '</li>';
			$contextual_help .= '</ul>';
		}

		return $contextual_help;
	}

	public function add_meta_box() {
		add_meta_box( 'jm-breaking-news-meta', __( 'Breaking News Info', 'jm-breaking-news' ), [ $this, 'create_meta_box' ], 'jm_breaking_news', 'normal', 'default' );
	}

	public function create_meta_box() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/breaking-news-meta-box.php';
	}

	public function save_meta_box( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'jm_breaking_news_nonce' ) ) {
			return;
		}

		if ( isset( $_POST['jm_breaking_news_in_ex'] ) && $_POST['jm_breaking_news_in_ex'] && 1 === $_POST['jm_breaking_news_in_ex'] ) {
			$check = 1;
		} else {
			$check = 0;
		}
		update_post_meta( $post_id, 'jm_breaking_news_in_ex', $check );

		if ( isset( $_POST[ 'jm_breaking_news_link'] ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_link', wp_filter_nohtml_kses( $_POST['jm_breaking_news_link'] ) );
		}

		if ( isset( $_POST['jm_breaking_news_limit'] ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_limit', intval( esc_attr( $_POST['jm_breaking_news_limit'] ) ) );
		}

		if ( isset( $_POST['jm_breaking_news_target'] ) && $_POST['jm_breaking_news_target'] ) {
			$check = 1;
		} else {
			$check = 0;
		}
		update_post_meta( $post_id, 'jm_breaking_news_target', $check );

		if ( isset( $_POST['jm_breaking_news_internal_link'] ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_internal_link', intval( $_POST['jm_breaking_news_internal_link'] ) );
		}

		$color            = wp_strip_all_tags( stripslashes( trim( $_POST['jm_breaking_news_color'] ) ) );
		$background_color = wp_strip_all_tags( stripslashes( trim( $_POST['jm_breaking_news_background_color'] ) ) );
		$text_color       = wp_strip_all_tags( stripslashes( trim( $_POST['jm_breaking_news_text_color'] ) ) );
		$news_text_color  = wp_strip_all_tags( stripslashes( trim( $_POST['jm_breaking_news_news_text_color'] ) ) );

		if ( $this->check_color( $color ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_color', $color );
		}
		if ( $this->check_color( $background_color ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_background_color', $background_color );
		}
		if ( $this->check_color( $text_color ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_text_color', $text_color );
		}
		if ( $this->check_color( $news_text_color ) ) {
			update_post_meta( $post_id, 'jm_breaking_news_news_text_color', $news_text_color );
		}
	}

	public function check_color( $value ) {
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) || preg_match( '/^[a-f0-9]{6}$/i', $value ) ) {
			return true;
		}

		return false;
	}

	public function add_rest_data() {
		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_in_ex',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Internal or External Link',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_internal_link',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Link',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_link',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Link',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_target',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Opens in a new window or not',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_limit',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'How long the post stays visible',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_color',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Color for the background of the "Breaking News" section.',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_background_color',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Color for the background of the body section.',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_text_color',
			array(
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => array(
					'description' => 'Color for the text of the "Breaking News" section.',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field(
			'jm_breaking_news',
			'jm_breaking_news_news_text_color',
			[
				'get_callback'    => [ $this, 'get_field' ],
				'schema'          => [
					'description' => 'Color for the text of the body section.',
					'type'        => 'string',
					'context'     => [ 'view' ],
				],
			]
		);
	}

	public function get_field( $post, $field_name, $request ) {
		return get_post_meta( get_the_ID(), $field_name, true );
	}

}
