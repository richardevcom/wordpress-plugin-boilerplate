<?php

namespace richardevcom\wppb;

/**
 * WordPress plugin boilerplate file
 *
 * This file is automatically indexed by WordPress and will make your plugin
 * accessible in admin panel.
 * 
 * This file serves as setup of plugin itself and will automatically load all
 * necessary dependencies and set them up for you.
 *
 * @link              richardev.com
 * @since             1.0.0
 * @package           WPPB
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        https://wordpress.org/plugins/wp-plugin-boilerplate
 * Description:       This plugin boilerplate is meant for you to develop your own plugin on.
 * Version:           1.0.0
 * Author:            @richardevcom
 * Author URI:        https://www.richardev.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wppb
 * Domain Path:       /languages
 */

// Protect this file from being called directly.
if (!defined('WPINC')) {
	die;
}

/**
 * Load configration and constants
 */
require_once plugin_dir_path(__FILE__) . 'includes/wppb-config.php';

/**
 * Helper functions
 */
require_once WPPB_INCLUDES_PATH . 'wppb-helpers.php';

/**
 * Let's run our plugin
 */
\richardevcom\wppb\helpers\wppb_init();
