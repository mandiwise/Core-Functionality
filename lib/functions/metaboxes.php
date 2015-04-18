<?php
/**
 * METABOXES
 *
 */

/**
 * Include CMB2 Library
 * See `/lib/CMB2/example-functions.php` for extended usage details
 *
 * @since 1.0.0
 */
if ( file_exists( CF_DIR . '/lib/CMB2/init.php' ) ) {
	require_once( CF_DIR . '/lib/CMB2/init.php' );
}

class CF_Metaboxes {

	/**
	 * Add actions and filters
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'cmb2_init', array( $this, 'some_metaboxes' ) );
		add_action( 'cmb2_init', array( $this, 'repeatable_group' ) );

		// CMB2 customizations
		add_filter( 'cmb2_show_on', array( $this, 'show_metabox_on_front_page' ), 10, 2 );
		add_filter( 'cmb2_show_on', array( $this, 'show_metabox_for_taxonomy_term' ), 10, 2 );

	}

	/**
	 * Create metaboxes
	 *
	 * @since  1.0.0
	 * @link   https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/
	 */

	public function some_metaboxes() {

		// Set global metabox prefix
		$prefix = '_cf_';

		$some_metaboxes = new_cmb2_box( array(
			'id'            => 'some_metaboxes',
			'title'         => 'The Metabox Title',
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$some_metaboxes->add_field( array(
			'name' => 'The Field Title',
			'desc' => '',
			'id'   => $prefix . 'the_id',
			'type' => 'text',
		) );

   }

	public function repeatable_group() {

		// Set global metabox prefix
		$prefix = '_cf_';

		$repeatable_group = new_cmb2_box( array(
			'id'            => 'repeatable_group',
			'title'         => 'Repeatable Group Slider Sample',
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'show_on'       => array(
				'key'   => 'front-page',
				'value' => ''
			),
		) );

		$repeatable_group_items = $repeatable_group->add_field( array(
			'id'      => $prefix . 'slider_repeatable_group',
			'type'    => 'group',
			'desc'    => 'Add or remove slides to page slider below:',
			'options' => array(
				'group_title'   => 'Slide {#}', // {#} gets replaced by row number
				'add_button'    => 'Add Another Slide',
				'remove_button' => 'Remove Slide',
				'sortable'      => true, // This is still a beta feature
			),
		) );

		$repeatable_group->add_group_field( $repeatable_group_items, array(
			'name'    => 'Slide Image',
			'desc'    => 'Upload an image or enter an external image URL.',
			'id'      => 'slide_image',
			'type'    => 'file',
			'options' => array( 'url' => false, ),
		) );

		$repeatable_group->add_group_field( $repeatable_group_items, array(
			'name' => 'Slide Text/Caption',
			'desc' => 'Add the text to appear with the image.',
			'id'   => 'slide_caption',
			'type' => 'text',
		) );

		$repeatable_group->add_group_field( $repeatable_group_items, array(
			'name' => 'Slide Link',
			'desc' => 'Add a link to direct visitors to when they click on the image.',
			'id'   => 'slider_link',
			'type' => 'text_url',
		) );

   }

	/**
	 * Create show_on() filter to INCLUDE metaboxes with front-page.php
	 *
	 * @since 1.0.0
	 * @param  bool  $display
	 * @param  array $meta_box
	 * @return bool  display metabox
	 */
	public function show_metabox_on_front_page( $display, $meta_box ) {

		// Make sure "front-page" has been set as the show_on key
		if ( ! isset( $meta_box['show_on']['key'] ) || 'front-page' !== $meta_box['show_on']['key'] ) {
			return $display;
		}

		// Get the current ID
		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
		} elseif ( isset( $_POST['post_ID'] ) ) {
			$post_id = $_POST['post_ID'];
		}

		// Return false early if there is no ID
		if ( !isset( $post_id ) ) {
			return false;
		}

		// Get ID of page set as front page, 0 if there isn't one
		$front_page = get_option( 'page_on_front' );

		// Display metaboxes if it's the front page
		if ( $post_id == $front_page ) {
			return $display;
		}
	}

	/**
	 * Create show_on filter to INCLUDE metaboxes for taxonomy terms
	 *
	 * @since 1.0.0
	 * @param  bool  $display
	 * @param  array $meta_box
	 * @return bool  display metabox
	 */
	public function show_metabox_for_taxonomy_term( $display, $meta_box ) {

		// Make sure "taxonomy" has been set as the show_on key
		if ( ! isset( $meta_box['show_on']['key'] ) || 'taxonomy' !== $meta_box['show_on']['key'] ) {
			return $display;
		}

		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
		} elseif ( isset( $_POST['post_ID'] ) ) {
			$post_id = $_POST['post_ID'];
		}

		if ( !isset( $post_id ) ) {
			return $display;
		}

		foreach ( $meta_box['show_on']['value'] as $taxonomy => $slugs ) {
			if ( !is_array( $slugs ) ) {
				$slugs = array( $slugs );
			}
			$display = false;
			$terms = wp_get_object_terms( $post_id, $taxonomy );
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $slugs ) ) {
					$display = true;
				}
			}
		}
		return $display;

	}

}

new CF_Metaboxes();
