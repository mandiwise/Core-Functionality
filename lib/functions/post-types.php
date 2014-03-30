<?php
/**
 * Post Types
 *
 */

/**
 * Create Product post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function cf_register_product_post_type() {

	$labels = array(
		'name'                => 'Products',
		'singular_name'       => 'Product',
		'menu_name'           => 'Product',
		'parent_item_colon'   => 'Parent Product:',
		'all_items'           => 'All Products',
		'view_item'           => 'View Product',
		'add_new_item'        => 'Add New Product',
		'add_new'             => 'New Product',
		'edit_item'           => 'Edit Product',
		'update_item'         => 'Update Product',
		'search_items'        => 'Search products',
		'not_found'           => 'No products found',
		'not_found_in_trash'  => 'No products found in Trash',
	);
	$args = array(
		'label'               => 'product',
		'description'         => 'Product information pages',
		'labels'              => $labels,
		'supports'            => array( ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'product', $args );

}

add_action( 'init', 'cf_register_product_post_type', 0 );

/**
 * Change post update messages to be post type-specific
 * @since 1.0.0
 *
 */

function cf_set_messages($messages) {
	global $post, $post_ID;
	$post_type = get_post_type( $post_ID );

	$obj = get_post_type_object($post_type);
	$singular = $obj->labels->singular_name;

	$messages[$post_type] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __($singular.' updated. <a href="%s">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __($singular.' updated.'),
		5 => isset($_GET['revision']) ? sprintf( __($singular.' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __($singular.' published. <a href="%s">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __($singular.' saved.'),
		8 => sprintf( __($singular.' submitted. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __($singular.' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.strtolower($singular).'</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __($singular.' draft updated. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'cf_set_messages' );