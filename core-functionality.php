<?php
 /**
 *
 * @package   [SITE NAME] Core Functionality
 * @author    Your Name <your_email@email.com>
 * @license   GPL-2.0+
 * @copyright 2014 Your Name or Company
 *
 * @wordpress-plugin
 * Plugin Name: Website Core Functionality
 * Description: This very important plugin contains all of the core functionality for this website so that it remains theme-independent.
 * Version:     1.0.0
 * Author:      Your Name
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define plugin directory
 *
 * @since 1.0.0
 */
define( 'CF_DIR', dirname( __FILE__ ) );

/**
 * General housekeeping and plugin activation tasks
 *
 * @since 1.0.0
 */
include_once( CF_DIR . '/lib/functions/general.php' );
register_activation_hook( __FILE__, array( 'CF_General', 'plugin_activation' ) );

/**
 * Post types
 *
 * @since 1.0.0
 */
//include_once( CF_DIR . '/lib/functions/post-types.php' );

/**
 * Taxonomies
 *
 * @since 1.0.0
 */
//include_once( CF_DIR . '/lib/functions/taxonomies.php' );

/**
 * Editor style refresh
 *
 * @since 1.0.0
 */
include_once( CF_DIR . '/lib/functions/editor-style-refresh.php' );

/**
 * Metaboxes
 *
 * @since 1.0.0
 */
//include_once( CF_DIR . '/lib/functions/metaboxes.php' );

/**
 * Widgets
 *
 * @since 1.0.0
 */
//include_once( CF_DIR . '/lib/widgets/widget-social.php' );
