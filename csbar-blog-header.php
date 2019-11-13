<?php
/**
 * Loads the csbar environment and template.
 *
 * @package csbar
 */
if ( ! isset( $csbar_did_header ) ) {
	$csbar_did_header = true;
	// Load the csbar library.
	require_once( dirname( __FILE__ ) . '/csbar-load.php' );
	// Set up the csbar query.
	csbar();
	// Load the theme template.
	require_once( ABSPATH . WPINC . '/template-loader.php' );
}
