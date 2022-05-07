<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that src attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       richardev.com
 * @since      1.0.0
 *
 * @package    wppb
 * @subpackage wppb/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    wppb
 * @subpackage wppb/includes
 * @author     richardev <richardev@localhost>
 */
class WPPB {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WPPB_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 * 
	 * @param    string               $file             Plugin index filename.
	 * @since    1.0.0
	 */
	public function __construct($file) {
		$this->register_setup_hooks($file);
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WPPB_Loader. Orchestrates the hooks of the plugin.
	 * - WPPB_I18n. Defines internationalization functionality.
	 * - WPPB_Admin. Defines all hooks for the admin area.
	 * - WPPB_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WPPB_INCLUDES_PATH . 'class-wppb-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once WPPB_INCLUDES_PATH . 'class-wppb-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WPPB_ADMIN_PATH . 'class-wppb-admin.php';
		require_once WPPB_ADMIN_PATH . 'class-wppb-dashboard.php';
		require_once WPPB_ADMIN_PATH . 'class-wppb-widgets.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WPPB_PUBLIC_PATH . 'class-wppb-public.php';

		$this->loader = new WPPB_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WPPB_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WPPB_I18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$wppb_admin = new WPPB_Admin();

		$this->loader->add_filter('plugin_action_links_' . plugin_basename(WPPB_PATH . 'wppb.php'), $wppb_admin, 'add_action_links',);
		$this->loader->add_action('admin_menu', $wppb_admin, 'add_menu_page');
		$this->loader->add_action('admin_enqueue_scripts', $wppb_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $wppb_admin, 'enqueue_scripts');

		$wppb_dashboard = new WPPB_Dashboard();
		$this->loader->add_action('admin_enqueue_scripts', $wppb_dashboard, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $wppb_dashboard, 'enqueue_scripts');
		$this->loader->add_action('wp_dashboard_setup', $wppb_dashboard, 'dashboard_widget');

		$wppb_widgets = new WPPB_Widgets();
		$this->loader->add_action('widgets_init', $wppb_widgets, 'register_widgets');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$wppb_public = new WPPB_Public();

		$this->loader->add_action('wp_enqueue_scripts', $wppb_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $wppb_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Register activation & deactivation hooks
	 * 
	 * @param    string               $file             Plugin index filename.
	 * @since    1.0.0
	 */
	private function register_setup_hooks($file) {
		register_activation_hook($file, array($this, 'activate_wppb'));
		register_deactivation_hook($file, array($this, 'deactivate_wppb'));
		register_uninstall_hook($file, array($this, 'uninstall_wppb'));
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WPPB_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/setup/class-wppb-activator.php
	 */
	function activate_wppb() {
		// Check if user has permission
		if (!current_user_can('activate_plugins'))
			return;

		require_once WPPB_INCLUDES_PATH . 'setup/class-wppb-activator.php';
		WPPB_Activator::activate();
	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/setup/class-wppb-deactivator.php
	 */
	function deactivate_wppb() {
		// Check if user has permission
		if (!current_user_can('activate_plugins'))
			return;

		require_once WPPB_INCLUDES_PATH . 'setup/class-wppb-deactivator.php';
		WPPB_Deactivator::deactivate();
	}

	/**
	 * The code that runs during plugin uninstallation.
	 * This action is documented in includes/setup/class-wppb-uninstaller.php
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
		WPPB_Deactivator::uninstall();
	}
}
