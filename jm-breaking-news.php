<?php 
/*
* Plugin Name: JM Breaking News
* Plugin URI: http://www.jacobmartella.com/jm-breaking-news/
* Description: Displays a breaking news banner, similar to that of CNN, with custom text and link on the webpage via a custom post type.
* Version: 1.3
* Author: Jacob Martella
* Author URI: http://www.jacobmartella.com
* License: GPLv3
*/

/**
* Set up the plugin when the user activates the plugin. Adds the breaking news custom post type the text domain for translations.
*/

$jm_breaking_news_plugin_path = plugin_dir_path( __FILE__ );
define('JM_BREAKING_NEWS_PATH', $jm_breaking_news_plugin_path);

//* Load the page for the custom post type
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-cpt.php');

//* Load the custom fields for the breaking news
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-fields.php');

//* Load the contextual help for the breaking news
include_once(JM_BREAKING_NEWS_PATH . 'admin/breaking-news-contextual-help.php');

//* Load the text domain
load_plugin_textdomain('jm-breaking-news', false, basename( dirname( __FILE__ ) ) . '/languages' );

/**
* Loads and registers the stylesheet for the breaking news banner
*/
function jm_breaking_news_style() {
	wp_register_style('jm-breaking-news-style', plugin_dir_url(__FILE__) . '/css/breaking-news-style.css');
	wp_enqueue_style('jm-breaking-news-style');
	wp_register_style('lato', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700');
  	wp_enqueue_style( 'lato');
  	wp_register_style('oswald', 'http://fonts.googleapis.com/css?family=Oswald:400,700,300');
  	wp_enqueue_style( 'oswald');
}
add_action('wp_enqueue_scripts', 'jm_breaking_news_style');

/**
* Loads and prints the styles for the breaking news custom post type
*/
function jm_breaking_news_admin_style() {
	global $typenow;
	if ($typenow == 'jm_breaking_news') {
		wp_enqueue_style('jm_breaking_news_admin_styles', plugin_dir_url(__FILE__) . 'css/breaking-news-admin-style.css');
	}
}
add_action('admin_print_styles', 'jm_breaking_news_admin_style');

/**
* Loads the script for the breaking news custom post type
*/
function jm_breaking_news_admin_scripts() {
	global $typenow;
	if ($typenow == 'jm_breaking_news') {
		wp_enqueue_script('jm_breaking_news_admin_script', plugin_dir_url(__FILE__) . 'js/breaking-news-show-hide-fields.js');
	}
}
add_action('admin_enqueue_scripts', 'jm_breaking_news_admin_scripts');

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
		'post_type' => 'jm_breaking_news',
		'posts_per_page' => 1,
	);
	$jm_breaking_news = new WP_Query($jm_breaking_news_args);
	if ($jm_breaking_news->have_posts()) : while ($jm_breaking_news->have_posts()) : $jm_breaking_news->the_post();
		$current_time = strtotime(current_time('mysql'));
		$post_time = strtotime(get_the_date('r'));
		$difference = ($current_time - $post_time)/(60 * 60);
		$limit = get_post_meta(get_the_ID(), 'jm_breaking_news_limit', true);
		if (get_post_meta(get_the_ID(), 'jm_breaking_news_target', true) == 1) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if (get_post_meta(get_the_ID(), 'jm_breaking_news_in_ex', true) == 1) {
			$link = get_post_meta(get_the_ID(), 'jm_breaking_news_internal_link', true);
		} else {
			$link = get_post_meta(get_the_ID(), 'jm_breaking_news_link', true);
		}
		if ($difference < $limit) {
			$html .= '<section class="breaking-news-box">';
			$html .= '<div class="breaking-news-left">';
			$html .= '<h2 class="breaking-news-left-h2">' . __('Breaking News', 'jm-breaking-news') . '</h2>';
			$html .= '</div>';
			$html .= '<div class="breaking-news-right">';
			$html .= '<h2 class="breaking-news-right-h2"><a href="' . $link . '" ' . $target .'>' . get_the_title() . '</a></h2>';
			$html .= '</div>';
			$html .= '</section>';
		}
	endwhile; endif;
	wp_reset_query();

	return $html;
}

?>