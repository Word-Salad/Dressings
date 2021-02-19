<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       wordsaladcoop@gmail.com
 * @since      1.0.0
 *
 * @package    Ws_Custom_Metadata
 * @subpackage Ws_Custom_Metadata/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ws_Custom_Metadata
 * @subpackage Ws_Custom_Metadata/includes
 * @author     Word Salad <wordsaladcoop@gmail.com>
 */
class Ws_Custom_Metadata_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ws-custom-metadata',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
