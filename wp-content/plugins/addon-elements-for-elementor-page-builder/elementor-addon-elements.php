<?php

/**
 * Plugin Name: Elementor Addon Elements
 * Description: Elementor Addon Elements comes with 25+ widgets and extensions to extend the power of Elementor Page Builder.
 * Plugin URI: https://www.elementoraddons.com/elements-addon-elements/
 * Author: WPVibes
 * Version: 1.12.5
 * Author URI: https://wpvibes.com/
 * Elementor tested up to: 3.15
 * Elementor Pro tested up to: 3.15
 * Text Domain: wts-eae
 * @package WTS_EAE
 */
if(! defined('EAE_FILE')){
define( 'EAE_FILE', __FILE__ );
define( 'EAE_URL', plugins_url( '/', __FILE__ ) );
define( 'EAE_PATH', plugin_dir_path( __FILE__ ) );
define( 'EAE_SCRIPT_SUFFIX', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
define( 'EAE_VERSION', '1.12.5' );
}


if ( ! function_exists( '_is_elementor_installed' ) ) {

	function _is_elementor_installed() {
		$file_path         = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

/**
 * Handles plugin activation actions.
 *
 * @since 1.0
 */
if ( ! function_exists( 'eae_activate' ) ) {
	function eae_activate() {
		if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
			return;
		}
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
}
register_activation_hook( __FILE__, 'eae_activate' );
require_once 'inc/bootstrap.php';
