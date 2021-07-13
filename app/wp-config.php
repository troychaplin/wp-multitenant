<?php
/**
 * Include wp-config file from individual install
 *
 * @since WP Multi Tenant
 * @package WordPress Config
 * @version 1.0
 * @see https://gist.github.com/markjaquith/6214749 - original idea that functions without env vars
 *
 */
$install_path       = str_replace( $_SERVER['DOCUMENT_ROOT'], '', dirname( $_SERVER['SCRIPT_FILENAME'] ) );
$install_path_parts = explode( '/', $install_path );
$install_path_count = count( $install_path_parts );

while ( $install_path_count > 0 ) {
    $install_path = $_SERVER['DOCUMENT_ROOT'] . implode( '/', $install_path_parts ) . '/wp-config.php';

    if ( file_exists( $install_path ) ) {
        include $install_path;
        break;
    } else {
        array_pop( $install_path_parts );
    }
}