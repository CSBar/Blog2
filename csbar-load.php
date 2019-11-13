<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the csbar-config.php file. The csbar-config.php
 * file will then load the csbar-settings.php file, which
 * will then set up the csbar environment.
 *
 * If the csbar-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * csbar-config.php file.
 *
 * Will also search for csbar-config.php in csbar' parent
 * directory to allow the csbar directory to remain
 * untouched.
 *
 * @package csbar
 */
/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
/*
 * If csbar-config.php exists in the csbar root, or if it exists in the root and csbar-settings.php
 * doesn't, load csbar-config.php. The secondary check for csbar-settings.php has the added benefit
 * of avoiding cases where the current directory is a nested installation, e.g. / is csbar(a)
 * and /blog/ is csbar(b).
 *
 * If neither set of conditions is true, initiate loading the setup process.
 */
if ( file_exists( ABSPATH . 'csbar-config.php' ) ) {
	/** The config file resides in ABSPATH */
	require_once( ABSPATH . 'csbar-config.php' );
} elseif ( @file_exists( dirname( ABSPATH ) . '/csbar-config.php' ) && ! @file_exists( dirname( ABSPATH ) . '/csbar-settings.php' ) ) {
	/** The config file resides one level above ABSPATH but is not part of another installation */
	require_once( dirname( ABSPATH ) . '/csbar-config.php' );
} else {
	// A config file doesn't exist
	define( 'csbarINC', 'csbar-includes' );
	require_once( ABSPATH . csbarINC . '/load.php' );
	// Standardize $_SERVER variables across setups.
	csbar_fix_server_vars();
	require_once( ABSPATH . csbarINC . '/functions.php' );
	$path = csbar_guess_url() . '/csbar-admin/setup-config.php';
	/*
	 * We're going to redirect to setup-config.php. While this shouldn't result
	 * in an infinite loop, that's a silly thing to assume, don't you think? If
	 * we're traveling in circles, our last-ditch effort is "Need more help?"
	 */
	if ( false === strpos( $_SERVER['REQUEST_URI'], 'setup-config' ) ) {
		header( 'Location: ' . $path );
		exit;
	}
	define( 'csbar_CONTENT_DIR', ABSPATH . 'csbar-content' );
	require_once( ABSPATH . csbarINC . '/version.php' );
	csbar_check_php_mysql_versions();
	csbar_load_translations_early();
	// Die with an error message
	$die = sprintf(
		/* translators: %s: csbar-config.php */
		__( "There doesn't seem to be a %s file. I need this before we can get started." ),
		'<code>csbar-config.php</code>'
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: Documentation URL. */
		__( "Need more help? <a href='%s'>We got it</a>." ),
		__( './support/article/editing-csbar-config-php/' )
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: csbar-config.php */
		__( "You can create a %s file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file." ),
		'<code>csbar-config.php</code>'
	) . '</p>';
	$die .= '<p><a href="' . $path . '" class="button button-large">' . __( 'Create a Configuration File' ) . '</a>';
	csbar_die( $die, __( 'csbar &rsaquo; Error' ) );
}
