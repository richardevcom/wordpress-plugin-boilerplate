<?php

namespace richardevcom\wppb\config;

/**
 * Current plugin version.
 * Update this with your latest release.
 */
define('WPPB_VERSION', '1.0.0');
define('WPPB_PREFIX', 'wppb');
define('WPPB_PATH', plugin_dir_path(dirname(__FILE__)));
define('WPPB_URL', plugin_dir_url(dirname(__FILE__)));

/**
 * Generate base directory paths & urls constants
 * Ex. WPPB_ADMIN_PATH, WPPB_PUBLIC_URL, etc.
 */
define('WPPB_ADMIN_PATH', WPPB_PATH . 'admin/');
define('WPPB_ADMIN_URL', WPPB_URL . 'admin/');
define('WPPB_INCLUDES_PATH', WPPB_PATH . 'includes/');
define('WPPB_INCLUDES_URL', WPPB_URL . 'includes/');
define('WPPB_LANGUAGES_PATH', WPPB_PATH . 'languages/');
define('WPPB_LANGUAGES_URL', WPPB_URL . 'languages/');
define('WPPB_PUBLIC_PATH', WPPB_PATH . 'public/');
define('WPPB_PUBLIC_URL', WPPB_URL . 'public/');
