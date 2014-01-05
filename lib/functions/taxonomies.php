<?php
/**
 * Taxonomies
 *
 */

/**
 * Create Genre Taxonomy
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function cf_register_genre_taxonomy() {

	$labels = array(
		'name'                       => 'Genres', 'Taxonomy General Name',
		'singular_name'              => 'Genre', 'Taxonomy Singular Name',
		'menu_name'                  => 'Genre',
		'all_items'                  => 'All Genres',
		'parent_item'                => 'Parent Genre',
		'parent_item_colon'          => 'Parent Genre:',
		'new_item_name'              => 'New Genre Name',
		'add_new_item'               => 'Add New Genre',
		'edit_item'                  => 'Edit Genre',
		'update_item'                => 'Update Genre',
		'separate_items_with_commas' => 'Separate genres with commas',
		'search_items'               => 'Search genres',
		'add_or_remove_items'        => 'Add or remove genres',
		'choose_from_most_used'      => 'Choose from the most used genres',
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'query_var'                  => true,
		'rewrite'                    => array( 'slug' => 'post-genre' ),
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	
	register_taxonomy( 'genre', 'post', $args );

}

add_action( 'init', 'cf_register_genre_taxonomy', 0 );