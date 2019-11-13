<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * csbar-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package csbar
 */
/**
 * Tells csbar to load the csbar theme and output it.
 *
 * @var bool
 */
define( 'csbar_USE_THEMES', true );
/** Loads the csbar Environment and Template */
require( dirname( __FILE__ ) . '/csbar-blog-header.php' );
