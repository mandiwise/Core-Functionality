<?php
/**
 * TAXONOMIES
 *
 * @link  http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

class CF_Taxonomies {

	/**
	 * Add actions and filters
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Register the sample "Genres" taxonomy
		add_action( 'init', array( $this, 'register_genre_taxonomy' ), 0 );

	}

	/**
	 * Create "Genres" Taxonomy
	 *
	 * @since 1.0.0
	 */
	public function register_genre_taxonomy() {

		$slug = 'genre';
		$name = 'Genres';
		$singular_name = 'Genre';

		$labels = array(
			'name'                       => $name, 'Taxonomy General Name',
			'singular_name'              => $singular_name, 'Taxonomy Singular Name',
			'menu_name'                  => $name,
			'all_items'                  => 'All ' . $name,
			'parent_item'                => 'Parent ' . $singular_name,
			'parent_item_colon'          => sprintf( 'Parent %s:', $singular_name ),
			'new_item_name'              => sprintf( 'New %s Name', $singular_name ),
			'add_new_item'               => 'Add New ' . $singular_name,
			'edit_item'                  => 'Edit ' . $singular_name,
			'update_item'                => 'Update ' . $singular_name,
			'separate_items_with_commas' => sprintf( 'Separate %s with commas', strtolower( $name ) ),
			'search_items'               => 'Search ' . strtolower( $name ),
			'add_or_remove_items'        => 'Add or remove ' . strtolower( $name ),
			'choose_from_most_used'      => 'Choose from the most used ' . strtolower( $name ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'query_var'                  => true,
			'rewrite'                    => array( 'slug' => 'book-genre' ),
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy( 'genre', 'book', $args );
	}

}

new CF_taxonomies();
