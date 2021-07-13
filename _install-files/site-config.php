<?php

/**
 * Specify database name
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */

define('DB_NAME', 'database_name');

/**
 * Specify domain name
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */

define('CURRENT_DOMAIN', 'domain_name');

/**
 * Specify install folder
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */

define('WP_INSTALL_FOLDER', 'full_site_path');

/**
 * Multisite Specific Constants
 *
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */
if ('true' === getenv('ENV_MULTISITE')) {
    define('WP_ALLOW_MULTISITE', true);
    // NOTE: These must be uncommented after network setup
    // define( 'MULTISITE', true );
    // define( 'SUBDOMAIN_INSTALL', false );
    // define( 'DOMAIN_CURRENT_SITE',  CURRENT_DOMAIN );
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
define('AUTH_KEY', 'put your unique phrase here');
define('SECURE_AUTH_KEY', 'put your unique phrase here');
define('LOGGED_IN_KEY', 'put your unique phrase here');
define('NONCE_KEY', 'put your unique phrase here');
define('AUTH_SALT', 'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT', 'put your unique phrase here');
define('NONCE_SALT', 'put your unique phrase here');
