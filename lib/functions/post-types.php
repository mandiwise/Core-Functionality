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
		'singular_name'       => 'Product'
		'menu_name'           => 'Product'
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