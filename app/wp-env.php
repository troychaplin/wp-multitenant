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

// echo '<pre>';
// print_r( $dotenv );
// echo '</pre>';

