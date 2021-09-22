<?php

/**
 * Specify database details
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
 * Set site specific database prefix
 *
 * @since WP Multi Tenant
 * @package WordPress Constants
 * @version 1.0
 */
$table_prefix = 'wp_table_prefix'; // @codingStandardsIgnoreLine

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
