<?php

namespace richardevcom\wppb;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       richardev.com
 * @since      1.0.0
 *
 * @package    wppb
 * @subpackage wppb/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    wppb
 * @subpackage wppb/includes
 * @author     richardev <richardev@localhost>
 */
class WPPB_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wppb',
			false,
			WPPB_LANGUAGES_PATH
		);
	}
}
