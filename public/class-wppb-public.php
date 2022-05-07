<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       richardev.com
 * @since      1.0.0
 *
 * @package    wppb
 * @subpackage wppb/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    wppb
 * @subpackage wppb/public
 * @author     richardev <richardev@localhost>
 */
class WPPB_Public {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		//
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPPB_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPPB_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( WPPB_PREFIX, WPPB_PUBLIC_URL . 'css/wppb-public.css', array(), WPPB_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPPB_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPPB_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( WPPB_PREFIX, WPPB_PUBLIC_URL . 'js/wppb-public.js', array( 'jquery' ), WPPB_VERSION, false );

	}

}
