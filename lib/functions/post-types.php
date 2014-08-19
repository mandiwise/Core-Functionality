<?php
/**
 * POST TYPES
 *
 * @link  http://codex.wordpress.org/Function_Reference/register_post_type
 */

class CF_Post_Types {

	/**
	 * Add actions and filters
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Register the sample "Books" post type
		add_action( 'init', array( $this, 'register_book_post_type' ), 0 );

	}

	/**
	 * Create "Books" post type
	 *
	 * @since 1.0.0
	 */
	public static function register_book_post_type() {

		$slug = 'book';
		$name = 'Books';
		$singular_name = 'Book';

		$labels = array(
			'name'                => $name, 'Post Type General Name',
			'singular_name'       => $singular_name, 'Post Type Singular Name',
			'menu_name'           => $name,
			'parent_item_colon'   => sprintf( 'Parent %s:', $singular_name ),
			'all_items'           => 'All ' . $name,
			'view_item'           => 'View ' . $singular_name,
			'add_new_item'        => 'Add New ' . $singular_name,
			'add_new'             => 'New ' . $singular_name,
			'edit_item'           => 'Edit ' . $singular_name,
			'update_item'         => 'Update ' . $singular_name,
			'search_items'        => 'Search ' . strtolower( $name ),
			'not_found'           => sprintf( 'No %s found', strtolower( $name ) ),
			'not_found_in_trash'  => sprintf( 'No %s found in Trash', strtolower( $name ) ),
		);

		$args = array(
			'description'         => 'Book post type description',
			'labels'              => $labels,
			'supports'            => array( 'title', 'author' ),
			'taxonomies'          => array( 'genre' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			//'menu_icon'           => '',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);

		register_post_type( $slug, $args );
	}

}

new CF_Post_Types;
