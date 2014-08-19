<?php
/**
 * METABOXES
 *
 */

class CF_Metaboxes {

	/**
	 * Add actions and filters
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_filter( 'cmb_meta_boxes', array( $this, 'metabox_arrays' ) );
		add_action( 'init', array( $this, 'initialize_cmb_metaboxes' ), 9999 );

	}

	/**
	* Create metaboxes
	*
	* @since  1.0.0
	* @link   https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/
	* @param  array $meta_boxes
	* @return array
	*/
	public function metabox_arrays( array $meta_boxes ) {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_cmb_';

		$meta_boxes['test_metabox'] = array(
			'id'         => 'test_metabox',
			'title'      => __( 'Test Metabox', 'cmb' ),
			'pages'      => array( 'page', ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
			'fields'     => array(
				array(
					'name' => __( 'Test Text', 'cmb' ),
					'desc' => __( 'field description (optional)', 'cmb' ),
					'id'   => $prefix . 'test_text',
					'type' => 'text',
					// 'repeatable' => true,
					// 'on_front' => false, // Optionally designate a field to wp-admin only
				),
			),
		);

		$meta_boxes['about_page_metabox'] = array(
			'id'         => 'about_page_metabox',
			'title'      => __( 'About Page Metabox', 'cmb' ),
			'pages'      => array( 'page', ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
			'fields' => array(
				array(
					'name' => __( 'Test Text', 'cmb' ),
					'desc' => __( 'field description (optional)', 'cmb' ),
					'id'   => $prefix . 'test_text',
					'type' => 'text',
				),
			)
		);

		/**
		* Metabox for the user profile screen
		*/
		$meta_boxes['user_edit'] = array(
			'id'         => 'user_edit',
			'title'      => __( 'User Profile Metabox', 'cmb' ),
			'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
			'show_names' => true,
			// 'cmb_styles' => true, // Show cmb bundled styles.. not needed on user profile page
			'fields'     => array(
				array(
					'name' => __( 'Extra Info', 'cmb' ),
					'desc' => __( 'field description (optional)', 'cmb' ),
					'id'   => $prefix . 'exta_info',
					'type' => 'title',
					'on_front' => false,
				),
				array(
					'name' => __( 'Avatar', 'cmb' ),
					'desc' => __( 'field description (optional)', 'cmb' ),
					'id'   => $prefix . 'avatar',
					'type' => 'file',
					'save_id' => true,
				),
				array(
					'name' => __( 'Twitter URL', 'cmb' ),
					'desc' => __( 'field description (optional)', 'cmb' ),
					'id'   => $prefix . 'twitterurl',
					'type' => 'text_url',
				),
			)
		);

		// Add other metaboxes as needed...

		return $meta_boxes;
	}

	/**
	* Initialize Metabox Class
	*
	* @since 1.0.0
	* See /lib/metabox/example-functions.php for more information
	*/

	public function initialize_cmb_metaboxes() {

		if ( ! class_exists( 'cmb_Meta_Box' ) ) {
			require_once( CF_DIR . '/lib/cmb-metabox/init.php' );
		}
	}

}

new CF_Metaboxes;
