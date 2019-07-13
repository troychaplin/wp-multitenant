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
$dotenv->required(
	[
		'DB_USER',
		'DB_PASSWORD',
		'DB_HOST',
		'ENV_SERVER_ENV',
		'ENV_CURRENT_DOMAIN',
		'ENV_BASE_SERVER',
		'ENV_PUBLICPATH',
		'WP_ROOT_PATH',
		'WP_APP_PATH',
		'WP_STABLE_PATH',
		'WP_ASSETS_PATH',
		'WP_CONFIG_PATH',
	]
);
