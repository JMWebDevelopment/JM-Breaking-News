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
	 * @since 2.0.0
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

			if ( get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true ) ) {
				$selected = get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true );
			} else {
				$selected = '';
			}
			$args = [
				'rest_url'      => get_home_url() . '/wp-json/',
				'selected_post' => $selected,
			];
			wp_enqueue_script( 'jm_breaking_news_load_posts_script', plugin_dir_url( __FILE__ ) . 'js/breaking-news-load-posts.min.js', [ 'jquery' ], $this->version, 'all' );
			wp_localize_script( 'jm_breaking_news_load_posts_script', 'jmloadposts', $args );
		}
	}

	/**
	 * Displays help text in the contextual menu.
	 *
	 * @since 1.0.0
	 *
	 * @param string    $contextual_help      The incoming text for contextual help.
	 * @param int       $screen_id               The id of the current screen.
	 * @param WP_Screen $screen            The current screen.
	 * @return string                      The new contextual help screen text.
	 */
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

	/**
	 * Adds in the meta box for the breaking news custom post type.
	 *
	 * @since 2.0.0
	 */
	public function add_meta_box() {
		add_meta_box( 'jm-breaking-news-meta', __( 'Breaking News Info', 'jm-breaking-news' ), [ $this, 'create_meta_box' ], 'jm_breaking_news', 'normal', 'default' );
	}

	/**
	 * Loads in the custom meta box for the custom post type.
	 *
	 * @since 2.0.0
	 */
	public function create_meta_box() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/breaking-news-meta-box.php';
	}

	/**
	 * Saves the data in the meta box for the breaking news custom post type.
	 *
	 * @since 2.0.0
	 *
	 * @param int $post_id      The ID of the breaking news post.
	 */
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

	/**
	 * Checks the color value to make sure that it is a hex color code.
	 *
	 * @since 2.0.0
	 *
	 * @param string $value      The entered color value.
	 * @return boolean           Whether the value is a hex color code or not.
	 */
	public function check_color( $value ) {
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) || preg_match( '/^[a-f0-9]{6}$/i', $value ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Adds in the rest API data for a breaking news post.
	 *
	 * @since 2.0.0
	 */
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

	/**
	 * Gets the value for a custom field.
	 *
	 * @since 2.0.0
	 *
	 * @param WP_Post         $post         The current post.
	 * @param string          $field_name   The name of the field.
	 * @param WP_REST_Request $request      The REST request.
	 */
	public function get_field( $post, $field_name, $request ) {
		return get_post_meta( get_the_ID(), $field_name, true );
	}

	/**
	 * Loads the block editor scripts and styles.
	 *
	 * @since 2.0.0
	 */
	public function blocks_editor_scripts() {
		wp_enqueue_style( 'jm-breaking-news-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700', [], $this->version, 'all' );
		wp_enqueue_style( 'jm-breaking-news-oswald', '//fonts.googleapis.com/css?family=Oswald:400,700,300', [], $this->version, 'all' );
	}

	/**
	 * Loads the front-end styles for the block.
	 *
	 * @since 2.0.0
	 */
	public function block_scripts() {
		$style_path = '/public/css/blocks.style.css';
		wp_enqueue_style(
			'jm-breaking-news-block-css',
			plugins_url( $style_path, __FILE__ )
		);
	}

	/**
	 * Renders the breaking news block on the front end.
	 *
	 * @since 2.0.0
	 *
	 * @param array $attributes      The attributes for the block.
	 * @return string                The HTML for the block.
	 */
	public function rendered_jm_breaking_news( $attributes ) {
		$html                  = '';
		$jm_breaking_news_args = [
			'post_type'         => 'jm_breaking_news',
			'posts_per_page'    => 1,
		];
		$jm_breaking_news      = new WP_Query( $jm_breaking_news_args );

		if ( $jm_breaking_news->have_posts() ) :
			while ( $jm_breaking_news->have_posts() ) :
				$jm_breaking_news->the_post();
				$current_time = strtotime( current_time( 'mysql' ) );
				$post_time    = strtotime( get_the_date( 'r' ), get_the_ID() );
				$difference   = ( $current_time - $post_time ) / ( 60 * 60 );
				$limit        = get_post_meta( get_the_ID(), 'jm_breaking_news_limit', true );
				if ( 1 === get_post_meta( get_the_ID(), 'jm_breaking_news_target', true ) ) {
					$target = 'target="_blank"';
				} else {
					$target = '';
				}
				if ( 1 === get_post_meta( get_the_ID(), 'jm_breaking_news_in_ex', true ) ) {
					$link = get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true );
				} else {
					$link = get_post_meta( get_the_ID(), 'jm_breaking_news_link', true );
				}
				if ( get_post_meta( get_the_ID(), 'jm_breaking_news_color', true ) ) {
					$style = 'style="background-color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_color', true ) . ';"';
				} else {
					$style = '';
				}
				if ( get_post_meta( get_the_ID(), 'jm_breaking_news_background_color', true ) ) {
					$background_color_style = 'style="background-color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_background_color', true ) . ';"';
				} else {
					$background_color_style = '';
				}
				if ( get_post_meta( get_the_ID(), 'jm_breaking_news_text_color', true ) ) {
					$text_color_style = 'style="color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_text_color', true ) . ';"';
				} else {
					$text_color_style = '';
				}
				if ( get_post_meta( get_the_ID(), 'jm_breaking_news_news_text_color', true ) ) {
					$news_text_color_style = 'style="color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_news_text_color', true ) . ';"';
				} else {
					$news_text_color_style = '';
				}
				$use_limit = apply_filters( 'jm_breaking_news_use_time_limit', true );
				if ( $difference < $limit || false === $use_limit ) {
					$html .= '<section class="breaking-news-box">';
					$html .= '<div class="breaking-news-left" ' . $style . '>';
					$html .= '<h2 class="breaking-news-left-h2" ' . $text_color_style . '>' . __( 'Breaking News', 'jm-breaking-news' ) . '</h2>';
					$html .= '</div>';
					$html .= '<div class="breaking-news-right" ' . $background_color_style . '>';
					if ( $link != '' ) {
						$html .= '<p class="breaking-news-right-h2" ' . $news_text_color_style . '><a href="' . $link . '" ' . $target . '>' . get_the_title() . '</a></p>';
					} else {
						$html .= '<p class="breaking-news-right-h2" ' . $news_text_color_style . '>' . get_the_title() . '</p>';
					}
					$html .= '</div>';
					$html .= '</section>';
				}
			endwhile;
		endif;
		wp_reset_postdata();

		return $html;
	}

	/**
	 * Checks to make sure Gutenberg is active or the WP version is greater than 5.0.
	 *
	 * @since 2.0.0
	 */
	public function check_gutenberg() {
		if ( ! function_exists( 'register_block_type' ) ) {
			// Block editor is not available.
			return;
		}
		add_action( 'enqueue_block_editor_assets', [ $this, 'blocks_editor_scripts' ] );
	}

}
