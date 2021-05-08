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

	/**
	 * Enqueues the styles for the admin side of the plugin.
	 *
	 * @since 2.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'jm-breaking-news-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700', [], $this->version, 'all' );
		wp_enqueue_style( 'jm-breaking-news-oswald', '//fonts.googleapis.com/css?family=Oswald:400,700,300', [], $this->version, 'all' );
		wp_enqueue_style( 'jm-breaking-news-admin', plugin_dir_url( __FILE__ ) . 'css/breaking-news-style.min.css', [], $this->version, 'all' );
	}

	/**
	 * Enqueues the scripts for the admin side of the plugin.
	 *
	 * @since 2.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Loads the breaking news function.
	 *
	 * @since 2.0.0
	 */
	public function load_breaking_news_function() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/breaking-news-function.php';
	}

	/**
	 * Adds the breaking news custom post type to the RSS feed.
	 *
	 * @since 2.0.0
	 */
	public function breaking_news_feed() {
		$post_types = array( 'jm_breaking_news' );
		foreach ( $post_types as $post_type ) {
			$feed = get_post_type_archive_feed_link( $post_type );
			if ( '' === $feed || ! is_string( $feed ) ) {
				$feed = get_bloginfo( 'rss2_url' ) . "?post_type=$post_type";
			}
			printf( __( '<link rel="%1$s" type="%2$s" href="%3$s" />' ), 'alternate', 'application/rss+xml', $feed );
		}
	}

	/**
	 * Registers the breaking news shortcode.
	 *
	 * @since 2.0.0
	 */
	public function register_shortcode() {
		add_shortcode( 'jm-breaking-news', [ $this, 'breaking_news_shortcode' ] );
	}

	/**
	 * Renders the JM Breaking News shortcode.
	 *
	 * @since 2.0.0
	 *
	 * @param array $atts      The attributes for the shortcode.
	 * @return string          The HTML for the breaking news shortcode.
	 */
	public function breaking_news_shortcode( $atts ) {
		$html = '';
		$jm_breaking_news_args = [
			'post_type'      => 'jm_breaking_news',
			'posts_per_page' => 1,
		];
		$jm_breaking_news = new WP_Query($jm_breaking_news_args);
		if ( $jm_breaking_news->have_posts() ) :
			while ( $jm_breaking_news->have_posts() ) :
				$jm_breaking_news->the_post();
				$current_time = strtotime( current_time( 'mysql' ) );
				$post_time    = strtotime( get_the_date( 'r' ) );
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
						$html .= '<h2 class="breaking-news-right-h2" ' . $news_text_color_style . '><a href="' . $link . '" ' . $target . '>' . get_the_title() . '</a></h2>';
					} else {
						$html .= '<h2 class="breaking-news-right-h2" ' . $news_text_color_style . '>' . get_the_title() . '</h2>';
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
	 * Loads and registers the breaking news widget.
	 *
	 * @since 2.0.0
	 */
	function register_widget() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/breaking-news-widget.php';

		register_widget( 'JM_Breaking_News_Widget' );
	}

}
