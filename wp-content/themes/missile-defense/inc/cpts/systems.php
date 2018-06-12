<?php
/**
 * Custom Post Types: Actors
 *
 * @package Missile_Defense
 */

/**
 * Create Actors custom post type.
 * @return array Custom post type.
 */
function missiledefense_cpt_systems() {
	$labels = array(
		'name'                  => _x( 'Systems', 'Post Type General Name', 'missiledefense' ),
		'singular_name'         => _x( 'System', 'Post Type Singular Name', 'missiledefense' ),
		'menu_name'             => __( 'Systems', 'missiledefense' ),
		'name_admin_bar'        => __( 'Systems', 'missiledefense' ),
		'archives'              => __( 'System Archives', 'missiledefense' ),
		'attributes'            => __( 'System Attributes', 'missiledefense' ),
		'parent_item_colon'     => __( 'Parent System:', 'missiledefense' ),
		'all_items'             => __( 'All Systems', 'missiledefense' ),
		'add_new_item'          => __( 'Add New System', 'missiledefense' ),
		'add_new'               => __( 'Add System', 'missiledefense' ),
		'new_item'              => __( 'New System', 'missiledefense' ),
		'edit_item'             => __( 'Edit System', 'missiledefense' ),
		'update_item'           => __( 'Update System', 'missiledefense' ),
		'view_item'             => __( 'View System', 'missiledefense' ),
		'view_items'            => __( 'View Systems', 'missiledefense' ),
		'search_items'          => __( 'Search System', 'missiledefense' ),
		'not_found'             => __( 'Not found', 'missiledefense' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'missiledefense' ),
		'featured_image'        => __( 'Featured Image', 'missiledefense' ),
		'set_featured_image'    => __( 'Set featured image', 'missiledefense' ),
		'remove_featured_image' => __( 'Remove featured image', 'missiledefense' ),
		'use_featured_image'    => __( 'Use as featured image', 'missiledefense' ),
		'insert_into_item'      => __( 'Insert into system', 'missiledefense' ),
		'uploaded_to_this_item' => __( 'Uploaded to this system', 'missiledefense' ),
		'items_list'            => __( 'Systems list', 'missiledefense' ),
		'items_list_navigation' => __( 'Systems list navigation', 'missiledefense' ),
		'filter_items_list'     => __( 'Filter systems list', 'missiledefense' ),
	);
	$args = array(
		'label'                 => __( 'System', 'missiledefense' ),
		'description'           => __( 'Defense Systems', 'missiledefense' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-admin-site',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'rewrite'				=> array('slug' => 'system'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'systems', $args );

}
add_action( 'init', 'missiledefense_cpt_systems', 0 );

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function systems_add_meta_boxes( $post ) {
	add_meta_box( 'systems_meta_box', __( 'Additional Page Information', 'missiledefense' ), 'systems_build_meta_box', 'systems', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'systems_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function systems_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'systems_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_elements_list_title = get_post_meta( $post->ID, '_systems_elements_list_title', true );
	if ( !$current_elements_list_title ) {
		$current_elements_list_title = esc_html__( 'System Elements', 'missiledefense' );
	}
	?>
	<div class='inside'>
		<p>
			<label for="elements_list_title"><strong><?php esc_html_e( 'Elements List Title', 'missiledefense' ); ?></strong></label>
			<input type="text" class="regular-text" id="elements_list_title" name="elements_list_title" value="<?php echo esc_textarea( $current_elements_list_title ); ?>" />
			<span class="howto"><?php esc_html_e( 'The title for the elements list section.', 'missiledefense' ); ?></span>
		</p>
	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function systems_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['systems_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['systems_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
		return;
	}
	// Return if autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_REQUEST['elements_list_title'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_systems_elements_list_title', wp_kses_post( wp_unslash( $_POST['elements_list_title'] ) ) ); // Input var okay.
	}
}
add_action( 'save_post', 'systems_save_meta_box_data' );
