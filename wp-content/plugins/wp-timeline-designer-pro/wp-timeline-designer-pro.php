<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.solwininfotech.com/
 * @since             1.0.0
 * @package           Wp_Timeline_Designer_PRO
 *
 * @wordpress-plugin
 * Plugin Name:       WP Timeline Designer PRO
 * Plugin URI:        https://www.solwininfotech.com/
 * Description:       Best WordPress Timeline Plugin to create a stunning timeline on your website.
 * Version:           1.4.4
 * Author:            Solwin Infotech
 * Author URI:        https://www.solwininfotech.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-timeline-designer-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WTL_VERSION', '1.4.4' );
define( 'WTL_TEXTDOMAIN', 'wp-timeline-designer-pro' );
define( 'WTL_DIR', plugin_dir_path( __FILE__ ) );
define( 'WTL_URL', plugins_url() . '/wp-timeline-designer-pro' );

require_once 'admin/wtl-functions.php';
require_once 'admin/class-wp-timeline-ajax.php';
require_once 'admin/class-wp-timeline-support.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-timeline-activator.php
 */
function wtl_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-timeline-activator.php';
	Wp_Timeline_Activator::activate();
	if ( is_plugin_active( 'wp-timeline-designer/wp-timeline-designer.php' ) ) {
		deactivate_plugins( 'wp-timeline-designer/wp-timeline-designer.php', true );
	}
	add_option( 'wp_timeline_plugin_do_activation_redirect', true );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-timeline-deactivator.php
 */
function wtl_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-timeline-deactivator.php';
	Wp_Timeline_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'wtl_activate' );
register_deactivation_hook( __FILE__, 'wtl_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-timeline.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_timeline() {
	$plugin = new Wp_Timeline();
	$plugin->run();

}
run_wp_timeline();
if ( ! class_exists( 'Wp_Timeline_Lite' ) ) {
	require_once 'admin/class-wtl-custom-post-type.php';
	require_once 'wp_timeline_templates/class-wtl-template-config.php';
	require_once 'admin/class-wp-timeline-designer-pro-widget.php';
}

/* Check if autoptimize plugin activated and excute exclude code. */
if ( is_plugin_active( 'autoptimize/autoptimize.php' ) ) {
	add_filter( 'autoptimize_filter_js_exclude', 'wtl_jquery_toggle' );
	/**
	 * Exclude scripts from Autoptimize.
	 *
	 * Added js file which may case problem with autoptimize,
	 *
	 * @param string $in IN.
	 *
	 * @return string
	 */
	function wtl_jquery_toggle( $in ) {
		return $in . ',aos-min.js,ajax.js,wp-timeline-public.js';
	}
}

add_action( 'admin_init', 'wp_timeline_activate_au' );

if ( ! function_exists( 'wp_timeline_activate_au' ) ) {
	/**
	 * Add auto update
	 */
	function wp_timeline_activate_au() {
		include_once 'admin/assets/class-wp-timeline-auto-update.php';
		new Wp_Timeline_Auto_Update();
	}
}
