<?php
/**
 * Plugin Name:       JM Breaking News
 * Plugin URI:        http://www.jacobmartella.com/jm-breaking-news/
 * Description:       Displays a breaking news banner, similar to that of CNN, with custom text and link on the webpage via a custom post type.
 * Version:           2.1.0
 * Author:            Jacob Martella
 * Author URI:        https://jacobmartella.com
 * Text Domain:       jm-breaking-news
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 *
 * @package    JM_Breaking_News
 * @subpackage JM_Breaking_News/includes
 */

namespace JM_Breaking_News;

// If this file is called directly, then about execution.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'CM_TABLE_PREFIX' ) ) {
	define( 'CM_TABLE_PREFIX', 'wp_' );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jm-starter-plugin-activator.php
 *
 * @since 1.0.0
 */
function activate_jm_breaking_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jm-breaking-news-activator.php';
	JM_Breaking_News_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-starter-plugin-deactivator.php
 *
 * @since 1.0.0
 */
function deactivate_jm_breaking_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jm-breaking-news-deactivator.php';
	JM_Breaking_News_Deactivator::deactivate();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_jm_breaking_news' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_jm_breaking_news' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-jm-breaking-news.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_starter_plugin() {

	$spmm = new JM_Breaking_News();
	$spmm->run();

}

// Call the above function to begin execution of the plugin.
run_starter_plugin();
