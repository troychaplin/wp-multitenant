<?php
/**
 * Specify database name
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
define( 'DB_NAME', 'db_name' );

/**
 * Specify install folder
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
define( 'WP_INSTALL_FOLDER', '' );

/**
 * Enable Multisite
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
define( 'ENABLE_MULTISITE', false );

if ( true === ENABLE_MULTISITE ) {
	define( 'WP_ALLOW_MULTISITE', true );

	// TODO: Uncomment the following constants after completing the network setup
	// define( 'MULTISITE', true );
	// define( 'SUBDOMAIN_INSTALL', false );
	// define( 'DOMAIN_CURRENT_SITE', getenv( 'ENV_CURRENT_DOMAIN' ) );
	// define( 'PATH_CURRENT_SITE', '/' );
	// define( 'SITE_ID_CURRENT_SITE', 1 );
	// define( 'BLOG_ID_CURRENT_SITE', 1 );
}

/**
 * Set site specific salts
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
define( 'AUTH_KEY', 'put your unique phrase here' );
define( 'SECURE_AUTH_KEY', 'put your unique phrase here' );
define( 'LOGGED_IN_KEY', 'put your unique phrase here' );
define( 'NONCE_KEY', 'put your unique phrase here' );
define( 'AUTH_SALT', 'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT', 'put your unique phrase here' );
define( 'NONCE_SALT', 'put your unique phrase here' );
