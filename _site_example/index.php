<?php // @codingStandardsIgnoreLine
/**
 * Load wp theme and output it.
 * =============
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */

define('WP_USE_THEMES', true);

/**
 * Load wp environment and template
 * =============
 * @since WP Multi Tenant
 * @package Site Configuration
 * @version 1.0
 */

/** Loads the WordPress Environment and Template */
require dirname(__FILE__) . '/wp/wp-blog-header.php';
