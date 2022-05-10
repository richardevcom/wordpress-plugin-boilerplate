<?php

namespace richardevcom\wppb;

/**
 * Main plugin class flie
 *
 * @link       richardev.com
 * @since      1.0.1
 *
 * @package    wppb
 * @subpackage wppb/includes
 */

/**
 * Main plugin class
 *
 * Used to setup dependencies, admin and public side
 * of the plugin.
 *
 * @since      1.0.1
 * @package    wppb
 * @subpackage wppb/includes
 * @author     richardev <richardev@localhost>
 */
class WPPB {

	/**
	 * Variable that manages all the plugin hooks.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      WPPB_Hooks    $hooks    Manages all hooks for the plugin.
	 */
	protected $hooks;

	/**
	 * Set up main plugin functionality 
	 * 
	 * @param    string               $file             Plugin index filename.
	 * @since    1.0.1
	 */
	public function __construct() {
		$this->register_setup_hooks(WPPB_PATH . 'wppb.php');
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Hooks class file
		 * 
		 * @author @DevinVinson
		 * @source https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/blob/master/plugin-name/includes/class-plugin-name-loader.php
		 */
		require_once WPPB_INCLUDES_PATH . 'class-wppb-hooks.php';

		/**
		 * Internationalization class file
		 */
		require_once WPPB_INCLUDES_PATH . 'class-wppb-i18n.php';

		/**
		 * Admin class file
		 * 
		 * All of the admin side functionality happens there.
		 */
		require_once WPPB_ADMIN_PATH . 'class-wppb-admin.php';

		/**
		 * Admin dashboard class
		 */
		require_once WPPB_ADMIN_PATH . 'class-wppb-dashboard.php';

		/**
		 * Admin widgets class
		 */
		require_once WPPB_ADMIN_PATH . 'class-wppb-widgets.php';

		/**
		 * Public class file
		 */
		require_once WPPB_PUBLIC_PATH . 'class-wppb-public.php';

		$this->hooks = new WPPB_Hooks();
	}

	/**
	 * Setup plugin domain/locale
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WPPB_I18n();

		// Register plugin domain
		$this->hooks->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register admin hooks
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {
		$wppb_admin = new WPPB_Admin();
		// CSS
		$this->hooks->add_action('admin_enqueue_scripts', $wppb_admin, 'enqueue_styles');
		// JS
		$this->hooks->add_action('admin_enqueue_scripts', $wppb_admin, 'enqueue_scripts');
		// Action links in plugins.php page
		$this->hooks->add_filter('plugin_action_links_' . plugin_basename(WPPB_PATH . 'wppb.php'), $wppb_admin, 'add_action_links',);
		// Admin menu page
		$this->hooks->add_action('admin_menu', $wppb_admin, 'add_menu_page');

		$wppb_dashboard = new admin\WPPB_Dashboard();
		if ($wppb_admin->pagenow() === 'index.php') {
			// CSS
			$this->hooks->add_action('admin_enqueue_scripts', $wppb_dashboard, 'enqueue_styles');
			// JS
			$this->hooks->add_action('admin_enqueue_scripts', $wppb_dashboard, 'enqueue_scripts');
		}

		// Load dashboard widget
		$this->hooks->add_action('wp_dashboard_setup', $wppb_dashboard, 'dashboard_widget');

		$wppb_widgets = new admin\WPPB_Widgets();
		// Load widgets
		$this->hooks->add_action('widgets_init', $wppb_widgets, 'register_widgets');
	}

	/**
	 * Register public hooks
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function define_public_hooks() {
		$wppb_public = new WPPB_Public();
		// CSS
		$this->hooks->add_action('wp_enqueue_scripts', $wppb_public, 'enqueue_styles');
		// JS
		$this->hooks->add_action('wp_enqueue_scripts', $wppb_public, 'enqueue_scripts');
	}

	/**
	 * Run plugin dependencies, hooks, etc. here
	 *
	 * @since    1.0.1
	 */
	public function run() {
		$this->hooks->run();
	}

	/**
	 * Register activation, deactivation and uninstallation hooks
	 * 
	 * @param    string               $index             Plugin index filename.
	 * @since    1.0.1
	 */
	private function register_setup_hooks($index) {
		register_activation_hook($index, array($this, 'activate_wppb'));
		register_deactivation_hook($index, array($this, 'deactivate_wppb'));
		register_uninstall_hook($index, array($this, 'uninstall_wppb'));
	}

	/**
	 * Run during plugin activation
	 */
	function activate_wppb() {
		// Check if user has permission
		if (!current_user_can('activate_plugins'))
			return;

		require_once WPPB_INCLUDES_PATH . 'setup/class-wppb-activator.php';
		setup\WPPB_Activator::activate();
	}

	/**
	 * Run during plugin deactivation
	 */
	function deactivate_wppb() {
		// Check if user has permission
		if (!current_user_can('activate_plugins'))
			return;

		require_once WPPB_INCLUDES_PATH . 'setup/class-wppb-deactivator.php';
		setup\WPPB_Deactivator::deactivate();
	}

	/**
	 * Run during plugin uninstallation
	 */
	function uninstall_wppb() {
		// If uninstall not called from WordPress, then exit.
		if (!defined('WP_UNINSTALL_PLUGIN')) {
			exit;
		}

		// Check if user has permission
		if (!current_user_can('activate_plugins'))
			return;

		require_once WPPB_INCLUDES_PATH . 'setup/class-wppb-uninstaller.php';
		setup\WPPB_Uninstaller::uninstall();
	}
}
