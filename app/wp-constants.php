<?php
/**
 * Global database constants for local env
 * =============
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 *
 */
define( 'DB_USER', getenv( 'DB_USER' ) );
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );
define( 'DB_HOST', getenv( 'DB_HOST' ) );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**
 * Set site specific database prefix
 * =============
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
$table_prefix = 'wpm_'; // @codingStandardsIgnoreLine

/**
 * Set Home and Admin URLs
 *
 * @since WP Multi Tenant
 * @package WordPress Constants
 * @version 1.0
 */
define( 'WP_INSTALL_DIR', getenv( 'ENV_PUBLICPATH' ) . '/' . WP_INSTALL_FOLDER );
define( 'WP_HOME', 'https://' . getenv( 'ENV_CURRENT_DOMAIN' ) . '/' . WP_INSTALL_FOLDER );
define( 'WP_SITEURL', 'https://' . getenv( 'ENV_CURRENT_DOMAIN' ) . '/' . WP_INSTALL_FOLDER . '/wp' );

/**
 * Set paths to wp-content and plugins
 *
 * @since WP Multi Tenant
 * @package WordPress Constants
 * @version 1.0
 */
define( 'WP_CONTENT_DIR', WP_INSTALL_DIR . '/wp-content' );
define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

define( 'WP_PLUGIN_DIR', getenv( 'WP_ASSETS_PATH' ) . '/plugins' );
define( 'WP_PLUGIN_URL', WP_HOME . '/wp-content/plugins' );

define( 'WPMU_PLUGIN_DIR', getenv( 'WP_ASSETS_PATH' ) . '/mu-plugins' );
define( 'WPMU_PLUGIN_URL', WP_HOME . '/wp-content/mu-plugins' );

/**
 * Configure Debugging
 *
 * @since WP Multi Tenant
 * @package WordPress Constants
 * @version 1.0
 */
define( 'WP_DEBUG', true );
