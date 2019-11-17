<?php
/**
 * Used to set up and fix common variables and include
 * the csbar procedural and class library.
 *
 * Allows for some configuration in csbar-config.php (see default-constants.php)
 *
 * @package csbar
 */
/**
 * Stores the location of the csbar directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'csbarINC', 'csbar-includes' );
/*
 * These can't be directly globalized in version.php. When updating,
 * we're including version.php from another installation and don't want
 * these values to be overridden if already set.
 */
global $csbar_version, $csbar_db_version, $tinymce_version, $required_php_version, $required_mysql_version, $csbar_local_package;
require( ABSPATH . csbarINC . '/version.php' );
require( ABSPATH . csbarINC . '/load.php' );
// Check for the required PHP version and for the MySQL extension or a database drop-in.
csbar_check_php_mysql_versions();
// Include files required for initialization.
require( ABSPATH . csbarINC . '/class-csbar-paused-extensions-storage.php' );
require( ABSPATH . csbarINC . '/class-csbar-fatal-error-handler.php' );
require( ABSPATH . csbarINC . '/class-csbar-recovery-mode-cookie-service.php' );
require( ABSPATH . csbarINC . '/class-csbar-recovery-mode-key-service.php' );
require( ABSPATH . csbarINC . '/class-csbar-recovery-mode-link-service.php' );
require( ABSPATH . csbarINC . '/class-csbar-recovery-mode-email-service.php' );
require( ABSPATH . csbarINC . '/class-csbar-recovery-mode.php' );
require( ABSPATH . csbarINC . '/error-protection.php' );
require( ABSPATH . csbarINC . '/default-constants.php' );
require_once( ABSPATH . csbarINC . '/plugin.php' );
/**
 * If not already configured, `$blog_id` will default to 1 in a single site
 * configuration. In multisite, it will be overridden by default in ms-settings.php.
 *
 * @global int $blog_id
 * @since 2.0.0
 */
global $blog_id;
// Set initial default constants including csbar_MEMORY_LIMIT, csbar_MAX_MEMORY_LIMIT, csbar_DEBUG, SCRIPT_DEBUG, csbar_CONTENT_DIR and csbar_CACHE.
csbar_initial_constants();
// Make sure we register the shutdown handler for fatal errors as soon as possible.
csbar_register_fatal_error_handler();
// csbar calculates offsets from UTC.
date_default_timezone_set( 'UTC' );
// Turn register_globals off.
csbar_unregister_GLOBALS();
// Standardize $_SERVER variables across setups.
csbar_fix_server_vars();
// Check if we have received a request due to missing favicon.ico
csbar_favicon_request();
// Check if we're in maintenance mode.
csbar_maintenance();
// Start loading timer.
timer_start();
// Check if we're in csbar_DEBUG mode.
csbar_debug_mode();
/**
 * Filters whether to enable loading of the advanced-cache.php drop-in.
 *
 * This filter runs before it can be used by plugins. It is designed for non-web
 * run-times. If false is returned, advanced-cache.php will never be loaded.
 *
 * @since 4.6.0
 *
 * @param bool $enable_advanced_cache Whether to enable loading advanced-cache.php (if present).
 *                                    Default true.
 */
if ( csbar_CACHE && apply_filters( 'enable_loading_advanced_cache_dropin', true ) && file_exists( csbar_CONTENT_DIR . '/advanced-cache.php' ) ) {
	// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
	include( csbar_CONTENT_DIR . '/advanced-cache.php' );
	// Re-initialize any hooks added manually by advanced-cache.php
	if ( $csbar_filter ) {
		$csbar_filter = csbar_Hook::build_preinitialized_hooks( $csbar_filter );
	}
}
// Define csbar_LANG_DIR if not set.
csbar_set_lang_dir();
// Load early csbar files.
require( ABSPATH . csbarINC . '/compat.php' );
require( ABSPATH . csbarINC . '/class-csbar-list-util.php' );
require( ABSPATH . csbarINC . '/formatting.php' );
require( ABSPATH . csbarINC . '/meta.php' );
require( ABSPATH . csbarINC . '/functions.php' );
require( ABSPATH . csbarINC . '/class-csbar-meta-query.php' );
require( ABSPATH . csbarINC . '/class-csbar-matchesmapregex.php' );
require( ABSPATH . csbarINC . '/class-csbar.php' );
require( ABSPATH . csbarINC . '/class-csbar-error.php' );
require( ABSPATH . csbarINC . '/pomo/mo.php' );
// Include the csbardb class and, if present, a db.php database drop-in.
global $csbardb;
require_csbar_db();
// Set the database table prefix and the format specifiers for database table columns.
$GLOBALS['table_prefix'] = $table_prefix;
csbar_set_csbardb_vars();
// Start the csbar object cache, or an external object cache if the drop-in is present.
csbar_start_object_cache();
// Attach the default filters.
require( ABSPATH . csbarINC . '/default-filters.php' );
// Initialize multisite if enabled.
if ( is_multisite() ) {
	require( ABSPATH . csbarINC . '/class-csbar-site-query.php' );
	require( ABSPATH . csbarINC . '/class-csbar-network-query.php' );
	require( ABSPATH . csbarINC . '/ms-blogs.php' );
	require( ABSPATH . csbarINC . '/ms-settings.php' );
} elseif ( ! defined( 'MULTISITE' ) ) {
	define( 'MULTISITE', false );
}
register_shutdown_function( 'shutdown_action_hook' );
// Stop most of csbar from being loaded if we just want the basics.
if ( SHORTINIT ) {
	return false;
}
// Load the L10n library.
require_once( ABSPATH . csbarINC . '/l10n.php' );
require_once( ABSPATH . csbarINC . '/class-csbar-locale.php' );
require_once( ABSPATH . csbarINC . '/class-csbar-locale-switcher.php' );
// Run the installer if csbar is not installed.
csbar_not_installed();
// Load most of csbar.
require( ABSPATH . csbarINC . '/class-csbar-walker.php' );
require( ABSPATH . csbarINC . '/class-csbar-ajax-response.php' );
require( ABSPATH . csbarINC . '/capabilities.php' );
require( ABSPATH . csbarINC . '/class-csbar-roles.php' );
require( ABSPATH . csbarINC . '/class-csbar-role.php' );
require( ABSPATH . csbarINC . '/class-csbar-user.php' );
require( ABSPATH . csbarINC . '/class-csbar-query.php' );
require( ABSPATH . csbarINC . '/query.php' );
require( ABSPATH . csbarINC . '/class-csbar-date-query.php' );
require( ABSPATH . csbarINC . '/theme.php' );
require( ABSPATH . csbarINC . '/class-csbar-theme.php' );
require( ABSPATH . csbarINC . '/template.php' );
require( ABSPATH . csbarINC . '/class-csbar-user-request.php' );
require( ABSPATH . csbarINC . '/user.php' );
require( ABSPATH . csbarINC . '/class-csbar-user-query.php' );
require( ABSPATH . csbarINC . '/class-csbar-session-tokens.php' );
require( ABSPATH . csbarINC . '/class-csbar-user-meta-session-tokens.php' );
require( ABSPATH . csbarINC . '/class-csbar-metadata-lazyloader.php' );
require( ABSPATH . csbarINC . '/general-template.php' );
require( ABSPATH . csbarINC . '/link-template.php' );
require( ABSPATH . csbarINC . '/author-template.php' );
require( ABSPATH . csbarINC . '/post.php' );
require( ABSPATH . csbarINC . '/class-walker-page.php' );
require( ABSPATH . csbarINC . '/class-walker-page-dropdown.php' );
require( ABSPATH . csbarINC . '/class-csbar-post-type.php' );
require( ABSPATH . csbarINC . '/class-csbar-post.php' );
require( ABSPATH . csbarINC . '/post-template.php' );
require( ABSPATH . csbarINC . '/revision.php' );
require( ABSPATH . csbarINC . '/post-formats.php' );
require( ABSPATH . csbarINC . '/post-thumbnail-template.php' );
require( ABSPATH . csbarINC . '/category.php' );
require( ABSPATH . csbarINC . '/class-walker-category.php' );
require( ABSPATH . csbarINC . '/class-walker-category-dropdown.php' );
require( ABSPATH . csbarINC . '/category-template.php' );
require( ABSPATH . csbarINC . '/comment.php' );
require( ABSPATH . csbarINC . '/class-csbar-comment.php' );
require( ABSPATH . csbarINC . '/class-csbar-comment-query.php' );
require( ABSPATH . csbarINC . '/class-walker-comment.php' );
require( ABSPATH . csbarINC . '/comment-template.php' );
require( ABSPATH . csbarINC . '/rewrite.php' );
require( ABSPATH . csbarINC . '/class-csbar-rewrite.php' );
require( ABSPATH . csbarINC . '/feed.php' );
require( ABSPATH . csbarINC . '/bookmark.php' );
require( ABSPATH . csbarINC . '/bookmark-template.php' );
require( ABSPATH . csbarINC . '/kses.php' );
require( ABSPATH . csbarINC . '/cron.php' );
require( ABSPATH . csbarINC . '/deprecated.php' );
require( ABSPATH . csbarINC . '/script-loader.php' );
require( ABSPATH . csbarINC . '/taxonomy.php' );
require( ABSPATH . csbarINC . '/class-csbar-taxonomy.php' );
require( ABSPATH . csbarINC . '/class-csbar-term.php' );
require( ABSPATH . csbarINC . '/class-csbar-term-query.php' );
require( ABSPATH . csbarINC . '/class-csbar-tax-query.php' );
require( ABSPATH . csbarINC . '/update.php' );
require( ABSPATH . csbarINC . '/canonical.php' );
require( ABSPATH . csbarINC . '/shortcodes.php' );
require( ABSPATH . csbarINC . '/embed.php' );
require( ABSPATH . csbarINC . '/class-csbar-embed.php' );
require( ABSPATH . csbarINC . '/class-csbar-oembed.php' );
require( ABSPATH . csbarINC . '/class-csbar-oembed-controller.php' );
require( ABSPATH . csbarINC . '/media.php' );
require( ABSPATH . csbarINC . '/http.php' );
require( ABSPATH . csbarINC . '/class-http.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-streams.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-curl.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-proxy.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-cookie.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-encoding.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-response.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-requests-response.php' );
require( ABSPATH . csbarINC . '/class-csbar-http-requests-hooks.php' );
require( ABSPATH . csbarINC . '/widgets.php' );
require( ABSPATH . csbarINC . '/class-csbar-widget.php' );
require( ABSPATH . csbarINC . '/class-csbar-widget-factory.php' );
require( ABSPATH . csbarINC . '/nav-menu.php' );
require( ABSPATH . csbarINC . '/nav-menu-template.php' );
require( ABSPATH . csbarINC . '/admin-bar.php' );
require( ABSPATH . csbarINC . '/rest-api.php' );
require( ABSPATH . csbarINC . '/rest-api/class-csbar-rest-server.php' );
require( ABSPATH . csbarINC . '/rest-api/class-csbar-rest-response.php' );
require( ABSPATH . csbarINC . '/rest-api/class-csbar-rest-request.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-posts-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-attachments-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-post-types-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-post-statuses-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-revisions-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-autosaves-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-taxonomies-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-terms-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-users-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-comments-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-search-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-blocks-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-block-renderer-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-settings-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/endpoints/class-csbar-rest-themes-controller.php' );
require( ABSPATH . csbarINC . '/rest-api/fields/class-csbar-rest-meta-fields.php' );
require( ABSPATH . csbarINC . '/rest-api/fields/class-csbar-rest-comment-meta-fields.php' );
require( ABSPATH . csbarINC . '/rest-api/fields/class-csbar-rest-post-meta-fields.php' );
require( ABSPATH . csbarINC . '/rest-api/fields/class-csbar-rest-term-meta-fields.php' );
require( ABSPATH . csbarINC . '/rest-api/fields/class-csbar-rest-user-meta-fields.php' );
require( ABSPATH . csbarINC . '/rest-api/search/class-csbar-rest-search-handler.php' );
require( ABSPATH . csbarINC . '/rest-api/search/class-csbar-rest-post-search-handler.php' );
require( ABSPATH . csbarINC . '/class-csbar-block-type.php' );
require( ABSPATH . csbarINC . '/class-csbar-block-styles-registry.php' );
require( ABSPATH . csbarINC . '/class-csbar-block-type-registry.php' );
require( ABSPATH . csbarINC . '/class-csbar-block-parser.php' );
require( ABSPATH . csbarINC . '/blocks.php' );
require( ABSPATH . csbarINC . '/blocks/archives.php' );
require( ABSPATH . csbarINC . '/blocks/block.php' );
require( ABSPATH . csbarINC . '/blocks/calendar.php' );
require( ABSPATH . csbarINC . '/blocks/categories.php' );
require( ABSPATH . csbarINC . '/blocks/latest-comments.php' );
require( ABSPATH . csbarINC . '/blocks/latest-posts.php' );
require( ABSPATH . csbarINC . '/blocks/rss.php' );
require( ABSPATH . csbarINC . '/blocks/search.php' );
require( ABSPATH . csbarINC . '/blocks/shortcode.php' );
require( ABSPATH . csbarINC . '/blocks/tag-cloud.php' );
$GLOBALS['csbar_embed'] = new csbar_Embed();
// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . csbarINC . '/ms-functions.php' );
	require( ABSPATH . csbarINC . '/ms-default-filters.php' );
	require( ABSPATH . csbarINC . '/ms-deprecated.php' );
}
// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
csbar_plugin_directory_constants();
$GLOBALS['csbar_plugin_paths'] = array();
// Load must-use plugins.
foreach ( csbar_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
	/**
	 * Fires once a single must-use plugin has loaded.
	 *
	 * @since 5.1.0
	 *
	 * @param string $mu_plugin Full path to the plugin's main file.
	 */
	do_action( 'mu_plugin_loaded', $mu_plugin );
}
unset( $mu_plugin );
// Load network activated plugins.
if ( is_multisite() ) {
	foreach ( csbar_get_active_network_plugins() as $network_plugin ) {
		csbar_register_plugin_realpath( $network_plugin );
		include_once( $network_plugin );
		/**
		 * Fires once a single network-activated plugin has loaded.
		 *
		 * @since 5.1.0
		 *
		 * @param string $network_plugin Full path to the plugin's main file.
		 */
		do_action( 'network_plugin_loaded', $network_plugin );
	}
	unset( $network_plugin );
}
/**
 * Fires once all must-use and network-activated plugins have loaded.
 *
 * @since 2.8.0
 */
do_action( 'muplugins_loaded' );
if ( is_multisite() ) {
	ms_cookie_constants();
}
// Define constants after multisite is loaded.
csbar_cookie_constants();
// Define and enforce our SSL constants
csbar_ssl_constants();
// Create common globals.
require( ABSPATH . csbarINC . '/vars.php' );
// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
create_initial_taxonomies();
create_initial_post_types();
csbar_start_scraping_edited_file_errors();
// Register the default theme directory root
register_theme_directory( get_theme_root() );
if ( ! is_multisite() ) {
	// Handle users requesting a recovery mode link and initiating recovery mode.
	csbar_recovery_mode()->initialize();
}
// Load active plugins.
foreach ( csbar_get_active_and_valid_plugins() as $plugin ) {
	csbar_register_plugin_realpath( $plugin );
	include_once( $plugin );
	/**
	 * Fires once a single activated plugin has loaded.
	 *
	 * @since 5.1.0
	 *
	 * @param string $plugin Full path to the plugin's main file.
	 */
	do_action( 'plugin_loaded', $plugin );
}
unset( $plugin );
// Load pluggable functions.
require( ABSPATH . csbarINC . '/pluggable.php' );
require( ABSPATH . csbarINC . '/pluggable-deprecated.php' );
// Set internal encoding.
csbar_set_internal_encoding();
// Run csbar_cache_postload() if object cache is enabled and the function exists.
if ( csbar_CACHE && function_exists( 'csbar_cache_postload' ) ) {
	csbar_cache_postload();
}
/**
 * Fires once activated plugins have loaded.
 *
 * Pluggable functions are also available at this point in the loading order.
 *
 * @since 1.5.0
 */
do_action( 'plugins_loaded' );
// Define constants which affect functionality if not already defined.
csbar_functionality_constants();
// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
csbar_magic_quotes();
/**
 * Fires when comment cookies are sanitized.
 *
 * @since 2.0.11
 */
do_action( 'sanitize_comment_cookies' );
/**
 * csbar Query object
 *
 * @global csbar_Query $csbar_the_query csbar Query object.
 * @since 2.0.0
 */
$GLOBALS['csbar_the_query'] = new csbar_Query();
/**
 * Holds the reference to @see $csbar_the_query
 * Use this global for csbar queries
 *
 * @global csbar_Query $csbar_query csbar Query object.
 * @since 1.5.0
 */
$GLOBALS['csbar_query'] = $GLOBALS['csbar_the_query'];
/**
 * Holds the csbar Rewrite object for creating pretty URLs
 *
 * @global csbar_Rewrite $csbar_rewrite csbar rewrite component.
 * @since 1.5.0
 */
$GLOBALS['csbar_rewrite'] = new csbar_Rewrite();
/**
 * csbar Object
 *
 * @global csbar $csbar Current csbar environment instance.
 * @since 2.0.0
 */
$GLOBALS['csbar'] = new csbar();
/**
 * csbar Widget Factory Object
 *
 * @global csbar_Widget_Factory $csbar_widget_factory
 * @since 2.8.0
 */
$GLOBALS['csbar_widget_factory'] = new csbar_Widget_Factory();
/**
 * csbar User Roles
 *
 * @global csbar_Roles $csbar_roles csbar role management object.
 * @since 2.0.0
 */
$GLOBALS['csbar_roles'] = new csbar_Roles();
/**
 * Fires before the theme is loaded.
 *
 * @since 2.6.0
 */
do_action( 'setup_theme' );
// Define the template related constants.
csbar_templating_constants();
// Load the default text localization domain.
load_default_textdomain();
$locale      = get_locale();
$locale_file = csbar_LANG_DIR . "/$locale.php";
if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) ) {
	require( $locale_file );
}
unset( $locale_file );
/**
 * csbar Locale object for loading locale domain date and various strings.
 *
 * @global csbar_Locale $csbar_locale csbar date and time locale object.
 * @since 2.1.0
 */
$GLOBALS['csbar_locale'] = new csbar_Locale();
/**
 *  csbar Locale Switcher object for switching locales.
 *
 * @since 4.7.0
 *
 * @global csbar_Locale_Switcher $csbar_locale_switcher csbar locale switcher object.
 */
$GLOBALS['csbar_locale_switcher'] = new csbar_Locale_Switcher();
$GLOBALS['csbar_locale_switcher']->init();
// Load the functions for the active theme, for both parent and child theme if applicable.
foreach ( csbar_get_active_and_valid_themes() as $theme ) {
	if ( file_exists( $theme . '/functions.php' ) ) {
		include $theme . '/functions.php';
	}
}
unset( $theme );
/**
 * Fires after the theme is loaded.
 *
 * @since 3.0.0
 */
do_action( 'after_setup_theme' );
// Set up current user.
$GLOBALS['csbar']->init();
/**
 * Fires after csbar has finished loading but before any headers are sent.
 *
 * Most of csbar is loaded at this stage, and the user is authenticated. csbar continues
 * to load on the {@see 'init'} hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once csbar is loaded, use the {@see 'csbar_loaded'} hook below.
 *
 * @since 1.5.0
 */
do_action( 'init' );
// Check site status
if ( is_multisite() ) {
	$file = ms_site_check();
	if ( true !== $file ) {
		require( $file );
		die();
	}
	unset( $file );
}
/**
 * This hook is fired once csbar, all plugins, and the theme are fully loaded and instantiated.
 *
 * Ajax requests should use csbar-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link https://codex.csbar.org/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action( 'csbar_loaded' );
