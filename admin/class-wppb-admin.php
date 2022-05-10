<?php

namespace richardevcom\wppb;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       richardev.com
 * @since      1.0.0
 *
 * @package    wppb
 * @subpackage wppb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    wppb
 * @subpackage wppb/admin
 * @author     richardev <richardev@localhost>
 */
class WPPB_Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		//
	}

	public function add_action_links($actions) {
		$mylinks = array(
			'<a href="' . admin_url('admin.php?page=wppb') . '">' . __('Settings', 'wppb') . '</a>',
		);
		$actions = array_merge($actions, $mylinks);
		return $actions;
	}

	/**
	 * Register a custom menu page.
	 */
	public function add_menu_page() {
		add_menu_page(
			__('WPPB', 'wppb'),
			__('WPPB', 'wppb'),
			'manage_options',
			'wppb',
			array($this, 'menu_page_callback'),
			'dashicons-wordpress-alt',
			66
		);
	}

	public function menu_page_callback() {
		require_once WPPB_ADMIN_PATH . 'templates/wppb-admin-display.php';
	}

	public function pagenow() {
		global $pagenow;
		return $pagenow;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPPB_Hooks as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPPB_Hooks will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style(WPPB_PREFIX, WPPB_ADMIN_URL . 'assets/css/wppb-admin.css', array(), WPPB_VERSION, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPPB_Hooks as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPPB_Hooks will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(WPPB_PREFIX, WPPB_ADMIN_URL . 'assets/js/wppb-admin.js', array('jquery'), WPPB_VERSION, false);
	}
}
