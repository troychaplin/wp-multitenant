<?php
/**
 * Include global env vars
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

require_once '/app/wordpress/app/wp-env.php';
// require_once getenv( 'WP_APP_PATH' ) . '/env.php';

/**
 * Include global constants
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

require_once 'site-config.php';

/**
 * Include global constants
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

require_once getenv( 'WP_APP_PATH' ) . '/wp-constants.php';

/**
 * Set absolute path to wp directory and include settings
 *
 * @since WP Multi Tenant
 * @package WordPress Constants
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

require_once ABSPATH . 'wp-settings.php';
