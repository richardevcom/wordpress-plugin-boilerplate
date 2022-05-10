<?php

namespace richardevcom\wppb\admin;

/**
 * Widgets functionality of the plugin.
 *
 * @link       richardev.com
 * @since      1.0.1
 *
 * @package    wppb
 * @subpackage wppb/admin/Widgets
 */

/**
 * Widgets functionality of the plugin.
 *
 * @package    wppb
 * @subpackage wppb/admin/Widgets
 * @author     richardev <richardev@localhost>
 */
class WPPB_Widgets extends \WP_Widget {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.1
	 */
	public function __construct() {
		//
	}

	public function register_widgets() {
		/**
		 * Register Widget widget
		 */
		require_once WPPB_ADMIN_PATH . 'widgets/class-wppb-widget.php';
		register_widget(widgets\WPPB_Widget::class);
	}
}
