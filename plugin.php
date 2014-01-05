<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: https://github.com/billerickson/Core-Functionality
 * Description: This plugin contains all of this site's core functionality so that it is theme independent. Don't delete!
 *
 */

// * Plugin Directory *
define( 'CF_DIR', dirname( __FILE__ ) );
 
// * Post Types *
//include_once( CF_DIR . '/lib/functions/post-types.php' );

// * Taxonomies *
//include_once( CF_DIR . '/lib/functions/taxonomies.php' );

// * Metaboxes *
//include_once( CF_DIR . '/lib/functions/metaboxes.php' );
 
// * Widgets *
//include_once( CF_DIR . '/lib/widgets/widget-social.php' );

// * Editor Style Refresh *
include_once( CF_DIR . '/lib/functions/editor-style-refresh.php' );

// * General *
include_once( CF_DIR . '/lib/functions/general.php' );