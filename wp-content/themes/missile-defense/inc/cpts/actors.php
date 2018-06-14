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
function missiledefense_cpt_actors() {
	$labels = array(
		'name'                  => _x( 'Countries', 'Post Type General Name', 'missiledefense' ),
		'singular_name'         => _x( 'Country', 'Post Type Singular Name', 'missiledefense' ),
		'menu_name'             => __( 'Countries', 'missiledefense' ),
		'name_admin_bar'        => __( 'Countries', 'missiledefense' ),
		'archives'              => __( 'Country Archives', 'missiledefense' ),
		'attributes'            => __( 'Country Attributes', 'missiledefense' ),
		'parent_item_colon'     => __( 'Parent Country:', 'missiledefense' ),
		'all_items'             => __( 'All Countries', 'missiledefense' ),
		'add_new_item'          => __( 'Add New Country', 'missiledefense' ),
		'add_new'               => __( 'Add Country', 'missiledefense' ),
		'new_item'              => __( 'New Country', 'missiledefense' ),
		'edit_item'             => __( 'Edit Country', 'missiledefense' ),
		'update_item'           => __( 'Update Country', 'missiledefense' ),
		'view_item'             => __( 'View Country', 'missiledefense' ),
		'view_items'            => __( 'View Countries', 'missiledefense' ),
		'search_items'          => __( 'Search Country', 'missiledefense' ),
		'not_found'             => __( 'Not found', 'missiledefense' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'missiledefense' ),
		'featured_image'        => __( 'Featured Image', 'missiledefense' ),
		'set_featured_image'    => __( 'Set featured image', 'missiledefense' ),
		'remove_featured_image' => __( 'Remove featured image', 'missiledefense' ),
		'use_featured_image'    => __( 'Use as featured image', 'missiledefense' ),
		'insert_into_item'      => __( 'Insert into country', 'missiledefense' ),
		'uploaded_to_this_item' => __( 'Uploaded to this country', 'missiledefense' ),
		'items_list'            => __( 'Countries list', 'missiledefense' ),
		'items_list_navigation' => __( 'Countries list navigation', 'missiledefense' ),
		'filter_items_list'     => __( 'Filter actors list', 'missiledefense' ),
	);
	$args = array(
		'label'                 => __( 'Country', 'missiledefense' ),
		'description'           => __( 'Countries and non-state actors for the missiles of the world section.', 'missiledefense' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'author' ),
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
		'rewrite'				=> array('slug' => 'country'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'actors', $args );

}
add_action( 'init', 'missiledefense_cpt_actors', 0 );

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function actors_add_meta_boxes( $post ) {
	add_meta_box( 'actors_meta_box', __( 'Additional Page Information', 'missiledefense' ), 'actors_build_meta_box', 'actors', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'actors_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function actors_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'actors_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_secondary_content = get_post_meta( $post->ID, '_actors_secondary_content', true );
	$current_archive_name = get_post_meta( $post->ID, '_actors_archive_name', true );
	?>
	<div class='inside'>
		<h3><?php esc_html_e( 'Secondary Content', 'missiledefense' ); ?></h3>
		<p>
			<?php
				wp_editor(
					$current_secondary_content,
					'actors_secondary_content'
				);
			?>
		</p>
		<p class="howto"><?php esc_html_e( 'On the default page template, this content will appear below the missile table. On the page with the sidebar template, this content will appear in the sidebar.', 'missiledefense' ); ?></p>
		<p>
			<label for="archive_name"><strong><?php esc_html_e( 'Archive Name', 'missiledefense' ); ?></strong></label>
			<input type="text" class="regular-text" id="archive_name" name="archive_name" value="<?php echo esc_textarea( $current_archive_name ); ?>" />
			<span class="howto"><?php esc_html_e( 'If you want to use different text for this post on the Missiles of the World page, fill this field out.', 'missiledefense' ); ?></span>
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
function actors_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['actors_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['actors_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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

	if ( isset( $_REQUEST['actors_secondary_content'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_actors_secondary_content', wp_kses_post( wp_unslash( $_POST['actors_secondary_content'] ) ) ); // Input var okay.
	}

	if ( isset( $_REQUEST['archive_name'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_actors_archive_name', wp_kses_post( wp_unslash( $_POST['archive_name'] ) ) ); // Input var okay.
	}
}
add_action( 'save_post', 'actors_save_meta_box_data' );
