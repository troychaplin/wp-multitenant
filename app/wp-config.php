<?php
echo 'root config<br>';

$install_path       = str_replace( $_SERVER['DOCUMENT_ROOT'], '', dirname( $_SERVER['SCRIPT_FILENAME'] ) );
$install_path_parts = explode( '/', $install_path );
while ( count( $install_path_parts ) > 0 ) {
	$install_path = $_SERVER['DOCUMENT_ROOT'] . implode( '/', $install_path_parts ) . '/wp-config.php';
	if ( file_exists( $install_path ) ) {
		include $install_path;
		break;
	} else {
		array_pop( $install_path_parts );
	}
}
