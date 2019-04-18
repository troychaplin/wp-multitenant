<?php
/**
 * Include autoload
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

require_once dirname( __DIR__ ) . '/vendor/autoload.php';


/**
 * Load .env file
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

$dotenv = Dotenv\Dotenv::create( __DIR__ );
$dotenv->load();
$dotenv->required( [ 'ENV_BASEPATH', 'ENV_PUBLICPATH', 'WP_ROOT_PATH', 'WP_STABLE_PATH', 'WP_ASSETS_PATH', 'DB_USER', 'DB_PASSWORD', 'DB_HOST' ] );


/**
 * Include wp-config file from individual install
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 * @see https://gist.github.com/markjaquith/6214749 - original idea that functions without env vars
 *
 * TODO: make sure this works with wp-cli
 */

$url_slugs = explode( '/', $_SERVER['REQUEST_URI'] );

while ( count( $url_slugs ) > 0 ) {
	$wpconfig_path = getenv( 'ENV_PUBLICPATH' ) . implode( '/', $url_slugs ) . '/wp-config.php';

	if ( file_exists( $wpconfig_path ) ) {
		include $wpconfig_path;
		break;
	} else {
		array_pop( $url_slugs );
	}
}


/**
 * Include global constants
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 */

require_once getenv( 'WP_CONFIG_PATH' ) . '/constants.php';
