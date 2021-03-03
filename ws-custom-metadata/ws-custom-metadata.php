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
 * @since             0.0.0
 * @package           Ws_Custom_Metadata
 *
 * @wordpress-plugin
 * Plugin Name:       WS Custom Metadata
 * Plugin URI:        ws-custom-metadata
 * Description:       Manage and Display Metadata (just for users so far)
 * Version:           0.0.0
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
define( 'WS_CUSTOM_METADATA_VERSION', '0.0.3' );

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



function fb_add_custom_user_profile_fields( $user ) {
	
	$all_meta = get_user_meta($user->ID, '', false);
?>
	<h3><?php _e('Extra Profile Information', 'your_textdomain'); ?></h3>

	<table class="form-table">
	<?php foreach ($all_meta as $key => $value) { 
		if (strpos($key, 'salad_') !== false) {
			$key = str_replace('salad_', '', $key);
	?>
			<tr>
				<th><label for="<?php echo $key ?>"><?php _e("$key", 'your_textdomain'); ?></label></th>
				<td>
					<input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo $value[0] ?>" class="regular-text" /><br />
					<span class="description"><?php _e("Update $key", 'your_textdomain'); ?></span>
				</td>
			</tr>
		<?php 
		} ?>
	<?php 
	} ?>
	</table>
<?php 
}

function fb_save_custom_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return FALSE;
	} else {
		$all_meta = get_user_meta($user_id, '', false);
	
		foreach ($all_meta as $key => $value) { 
			if (strpos($key, 'salad_') !== false) {
				$key = str_replace('salad_', '', $key);
				update_usermeta( $user_id, 'salad_' . "$key", $_POST["$key"] );
			}
		}
	}
}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );
