<?php

/**
 * Dashboard functionality of the plugin.
 *
 * @link       richardev.com
 * @since      1.0.0
 *
 * @package    wppb
 * @subpackage wppb/admin/dashboard
 */

/**
 * Dashboard functionality of the plugin.
 *
 * @package    wppb
 * @subpackage wppb/admin/dashboard
 * @author     richardev <richardev@localhost>
 */
class WPPB_Dashboard {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	function dashboard_widget() {
		wp_add_dashboard_widget(
			'wppb_dashboard_widget',
			esc_html__('WPPB Widget', 'wppb'),
			array($this, 'wppb_dashboard_widget_render'),
		);

		/**
		 * !!! CODE BELOW WILL FORCE WIDGET TO THE TOP
		 */

		// // Globalize the metaboxes array, this holds all the widgets for wp-admin.
		// global $wp_meta_boxes;

		// // Get the regular dashboard widgets array 
		// // (which already has our new widget but appended at the end).
		// $default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

		// // Backup and delete our new dashboard widget from the end of the array.
		// $wppb_widget_backup = array('wppb_dashboard_widget' => $default_dashboard['wppb_dashboard_widget']);
		// unset($default_dashboard['wppb_dashboard_widget']);

		// // Merge the two arrays together so our widget is at the beginning.
		// $sorted_dashboard = array_merge($wppb_widget_backup, $default_dashboard);

		// // Save the sorted array back into the original metaboxes. 
		// $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
	}

	/**
	 * Create the function to output the content of our Dashboard Widget.
	 */
	function wppb_dashboard_widget_render() {
		// Display whatever you want to show.
		_e(sprintf("Great! It works. Now try customizing your own widget in <code>%s</code>", "admin/" . basename(__FILE__)), "wppb");
	}

	/**
	 * Register the stylesheets for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style(WPPB_PREFIX . '_DASHBOARD', WPPB_ADMIN_URL . 'css/wppb-dashboard.css', array(), WPPB_VERSION, 'all');
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(WPPB_PREFIX . '_DASHBOARD', WPPB_ADMIN_URL . 'js/wppb-dashboard.js', array('jquery'), WPPB_VERSION, false);
	}
}
