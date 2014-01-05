<?php
/**
 * General
 *
 */
 
/**
 * Don't Update Plugin
 * @since 1.0.0
 * 
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
 
function cf_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'cf_core_functionality_hidden', 5, 2 );

// * Use shortcodes in widgets *
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Remove Menu Items
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */
function cf_remove_menus () {
	global $menu;
	$restricted = array();
	// Example:
	//$restricted = array( __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins') );
	end ($menu);
	while ( prev( $menu ) ){
		$value = explode( ' ',$menu[key($menu)][0] );
		if( in_array( $value[0] != NULL?$value[0]:"" , $restricted ) ){ unset($menu[key($menu)] ); }
	}
}
add_action( 'admin_menu', 'cf_remove_menus' );
