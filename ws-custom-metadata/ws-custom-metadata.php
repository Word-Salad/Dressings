<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              wordsaladcoop@gmail.com
 * @since             1.0.0
 * @package           Ws_Custom_Metadata
 *
 * @wordpress-plugin
 * Plugin Name:       WS Custom Metadata
 * Plugin URI:        ws-custom-metadata
 * Description:       Manage and Display Metadata (just for users so far)
 * Version:           1.0.0
 * Author:            Word Salad
 * Author URI:        wordsaladcoop@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ws-custom-metadata
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
define( 'WS_CUSTOM_METADATA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ws-custom-metadata-activator.php
 */
function activate_ws_custom_metadata() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ws-custom-metadata-activator.php';
	Ws_Custom_Metadata_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ws-custom-metadata-deactivator.php
 */
function deactivate_ws_custom_metadata() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ws-custom-metadata-deactivator.php';
	Ws_Custom_Metadata_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ws_custom_metadata' );
register_deactivation_hook( __FILE__, 'deactivate_ws_custom_metadata' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ws-custom-metadata.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ws_custom_metadata() {

	$plugin = new Ws_Custom_Metadata();
	$plugin->run();

}
run_ws_custom_metadata();

/**
 * Shortcode (show yr info. Throw it in an html block to style.)
 */
function $user_meta_1 () {
	$user_id = get_current_user_id();
	$user_age = get_user_meta( $user_id, '$user_meta_1', true );
	return $user_meta_1;
}
add_shortcode('$user_meta_1' , '$user_meta_1');

function $user_meta_2 () {
	$user_id = get_current_user_id();
	$user_age = get_user_meta( $user_id, '$user_meta_2', true );
	return $user_meta_2;
}
add_shortcode('$user_meta_2' , '$user_meta_2');

function $user_meta_3 () {
	$user_id = get_current_user_id();
	$user_age = get_user_meta( $user_id, '$user_meta_3', true );
	return $user_meta_3;
}
add_shortcode('$user_meta_3' , '$user_meta_3');

function $user_meta_4 () {
	$user_id = get_current_user_id();
	$user_age = get_user_meta( $user_id, '$user_meta_4', true );
	return $user_meta_4;
}
add_shortcode('$user_meta_4' , '$user_meta_4');
