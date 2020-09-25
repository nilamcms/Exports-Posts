<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       NN Exports Posts
 * @since      1.0.0
 *
 * @package    Nn_Exports_Posts
 * @subpackage Nn_Exports_Posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nn_Exports_Posts
 * @subpackage Nn_Exports_Posts/includes
 * @author     cmsMinds  <nilam@cmsminds.com>
 */
class Nn_Exports_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nn-exports-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
