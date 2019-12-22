<?php 
/*
* Plugin Name: JM Breaking News
* Plugin URI: http://www.jacobmartella.com/jm-breaking-news/
* Description: Displays a breaking news banner, similar to that of CNN, with custom text and link on the webpage via a custom post type.
* Version: 1.9.2
* Author: Jacob Martella
* Author URI: http://www.jacobmartella.com
* License: GPLv3
* Text Domain: jm-breaking-news
* Domain Path: /languages
*/

/**
* Set up the plugin when the user activates the plugin. Adds the breaking news custom post type the text domain for translations.
*/
$jm_breaking_news_plugin_path = plugin_dir_path( __FILE__ );
define('JM_BREAKING_NEWS_PATH', $jm_breaking_news_plugin_path);

//* Load the text domain
function jm_breaking_news_load_plugin_textdomain() {
	load_plugin_textdomain( 'jm-breaking-news', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'jm_breaking_news_load_plugin_textdomain' );

//* Load the page for the custom post type
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-cpt.php');

//* Load the custom fields for the breaking news
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-fields.php');

//* Load the contextual help for the breaking news
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-contextual-help.php');

//* Load the custom fields for the CPT in the rest api
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-rest-api.php');

//* Load the widget
include_once(plugin_dir_path( __FILE__ ) . 'breaking-news-widget.php');

/**
* Loads and registers the stylesheet for the breaking news banner
*/
function jm_breaking_news_style() {
	wp_register_style( 'jm-breaking-news-style', plugin_dir_url( __FILE__ ) . '/css/breaking-news-style.css' );
	wp_enqueue_style( 'jm-breaking-news-style' );
	wp_register_style( 'lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700' );
  	wp_enqueue_style( 'lato' );
  	wp_register_style( 'oswald', '//fonts.googleapis.com/css?family=Oswald:400,700,300' );
  	wp_enqueue_style( 'oswald' );
}
add_action( 'wp_enqueue_scripts', 'jm_breaking_news_style' );

/**
* Loads the script for the breaking news custom post type
*/
function jm_breaking_news_admin_scripts() {
	global $typenow;
	if ($typenow == 'jm_breaking_news') {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'jm_breaking_news_admin_script', plugin_dir_url( __FILE__ ) . 'js/breaking-news-show-hide-fields.js' );
		wp_enqueue_style( 'jm_breaking_news_admin_styles', plugin_dir_url( __FILE__ ) . 'css/breaking-news-admin-style.css' );


		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true ) ) {
		    $selected = get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true );
        } else {
		    $selected = '';
        }
        $args = array(
            'rest_url'      => get_home_url() . '/wp-json/',
            'selected_post' => $selected
        );
        wp_enqueue_script( 'jm_breaking_news_load_posts_script', plugin_dir_url( __FILE__ ) . 'js/breaking-news-load-posts.js' );
        wp_localize_script( 'jm_breaking_news_load_posts_script', 'jmloadposts', $args );
	}
}
add_action( 'admin_enqueue_scripts', 'jm_breaking_news_admin_scripts' );

/**
* Returns the HTML for the breaking news banner
*
* Add '<?php echo jm_breaking_news(); ?>' anywhere in your theme to display the breaking news.
*
* @return string, HTML for the banner
*/
function jm_breaking_news() {
	$html = '';
	$jm_breaking_news_args = array(
		'post_type'         => 'jm_breaking_news',
		'posts_per_page'    => 1,
	);
	$jm_breaking_news = new WP_Query( $jm_breaking_news_args );
	if ( $jm_breaking_news->have_posts() ) : while ( $jm_breaking_news->have_posts() ) : $jm_breaking_news->the_post();
		$current_time = strtotime( current_time( 'mysql' ) );
		$post_time = strtotime( get_the_date( 'r' ) );
		$difference = ( $current_time - $post_time ) / ( 60 * 60 );
		$limit = get_post_meta( get_the_ID(), 'jm_breaking_news_limit', true );
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_target', true ) == 1 ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_in_ex', true ) == 1 ) {
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
	endwhile; endif;
	wp_reset_query();

	return $html;
}

//* Breaking News Custom RSS Feed
add_action( 'wp_head', 'jm_breaking_news_feed' );
function jm_breaking_news_feed() {
    $post_types = array( 'jm_breaking_news' );
    foreach( $post_types as $post_type ) {
        $feed = get_post_type_archive_feed_link( $post_type );
        if ( $feed === '' || !is_string( $feed ) ) {
            $feed =  get_bloginfo( 'rss2_url' ) . "?post_type=$post_type";
        }
        printf( __( '<link rel="%1$s" type="%2$s" href="%3$s" />' ),"alternate","application/rss+xml",$feed );
    }
}

//* Register and create the shortcode to display the section
function jm_breaking_news_register_shortcode() {
	add_shortcode( 'jm-breaking-news', 'jm_breaking_news_shortcode' );
}
add_action( 'init', 'jm_breaking_news_register_shortcode' );
function jm_breaking_news_shortcode( $atts ) {

	$html = '';
	$jm_breaking_news_args = array(
			'post_type'         => 'jm_breaking_news',
			'posts_per_page'    => 1,
	);
	$jm_breaking_news = new WP_Query($jm_breaking_news_args);
	if ( $jm_breaking_news->have_posts() ) : while ( $jm_breaking_news->have_posts() ) : $jm_breaking_news->the_post();
		$current_time = strtotime( current_time( 'mysql' ) );
		$post_time = strtotime( get_the_date( 'r' ) );
		$difference = ( $current_time - $post_time ) / ( 60 * 60 );
		$limit = get_post_meta( get_the_ID(), 'jm_breaking_news_limit', true );
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_target', true ) == 1 ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_in_ex', true ) == 1 ) {
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
	endwhile; endif;
	wp_reset_query();

	return $html;
}

function breaking_news_blocks_editor_scripts() {
	// Make paths variables so we don't write em twice ;)
	$blockPath = '/js/editor.blocks.js';
	$editorStylePath = '/css/blocks.editor.css';
	// Enqueue optional editor only styles
	wp_enqueue_style(
		'jsforwp-blocks-editor-css',
		plugins_url( $editorStylePath, __FILE__)
	);
	// Enqueue the bundled block JS file
	wp_enqueue_script(
		'breaking-news-blocks-js',
		plugins_url( $blockPath, __FILE__ ),
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api', 'wp-editor' ],
		filemtime( plugin_dir_path(__FILE__) . $blockPath )
	);
	// Pass in REST URL
	wp_localize_script(
		'breaking-news-blocks-js',
		'jm_breaking_news_globals',
		[
			'rest_url'  => esc_url( rest_url() ),
			'nonce'     => wp_create_nonce( 'wp_rest' ),
		]);
}
// Hook scripts function into block editor hook


function breaking_news_block_scripts() {
	// Make paths variables so we don't write em twice ;)
	$stylePath = '/css/blocks.style.css';
	// Enqueue optional editor only styles
	wp_enqueue_style(
		'jm-breaking-news-block-css',
		plugins_url( $stylePath, __FILE__)
	);
}
// Hook scripts function into block editor hook

function jm_breaking_news_check_gutenberg() {
	if ( is_admin() ) {
		if ( is_plugin_active( 'gutenberg/gutenberg.php' ) || version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
			add_action( 'enqueue_block_assets', 'breaking_news_block_scripts' );
			add_action( 'enqueue_block_editor_assets', 'breaking_news_blocks_editor_scripts' );
			register_block_type( 'jm-breaking-news/jm-breaking-news', array(
				'render_callback' => 'rendered_jm_breaking_news',
			) );
		}
	}
}
add_action( 'admin_init', 'jm_breaking_news_check_gutenberg' );

function rendered_jm_breaking_news( $attributes ){
	$html = '';
	$jm_breaking_news_args = array(
		'post_type'         => 'jm_breaking_news',
		'posts_per_page'    => 1,
	);
	$jm_breaking_news = new WP_Query($jm_breaking_news_args);
	if ( $jm_breaking_news->have_posts() ) : while ( $jm_breaking_news->have_posts() ) : $jm_breaking_news->the_post();
		$current_time = strtotime( current_time( 'mysql' ) );
		$post_time = strtotime( get_the_date( 'r' ) );
		$difference = ( $current_time - $post_time ) / ( 60 * 60 );
		$limit = get_post_meta( get_the_ID(), 'jm_breaking_news_limit', true );
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_target', true ) == 1 ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_in_ex', true ) == 1 ) {
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
	endwhile; endif;
	wp_reset_query();

	return $html;
}
