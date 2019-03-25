<?php
/**
 * Custom Post Types: Defense Systems
 *
 * @package Missile_Defense
 */

/**
 * Create Defense System custom post type.
 * @return array Custom post type.
 */
function missiledefense_cpt_defsys() {
	register_post_type( 'defsys',
	    array(
			'labels' => array(
				'name' => __( 'Defense Systems' ),
				'singular_name' => __( 'Defense System' )
			),
            'supports' => array( 'title', 'editor', 'excerpt', 'publicize', 'thumbnail', 'author' ),
			'public' => true,
			'has_archive' => true,
	    )
  	);
}
add_action( 'init', 'missiledefense_cpt_defsys' );

/**
 * Create System Types taxonomy for Defense Systems post type.
 * @return array Custom taxonomy.
 */
function missiledefense_taxonomy_system() {
	$labels = array(
		'name'              => _x( 'System Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'System Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search System Types' ),
		'all_items'         => __( 'All System Types' ),
		'parent_item'       => __( 'Parent System Type' ),
		'parent_item_colon' => __( 'Parent System Type:' ),
		'edit_item'         => __( 'Edit System Type' ),
		'update_item'       => __( 'Update System Type' ),
		'add_new_item'      => __( 'Add New System Type' ),
		'new_item_name'     => __( 'New System Type Name' ),
		'menu_name'         => __( 'System Types' ),
	);

	$args = array(
		'hierarchical'      => true,
        'labels'            => $labels,
        'query_var'         => true,
		'rewrite'           => array( 'slug' => 'system_tax' ),
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
	);
	register_taxonomy( 'system', array( 'defsys', 'systems' ), $args );
}
add_action( 'init', 'missiledefense_taxonomy_system', 0 );

// Register Meta
add_action( 'init', 'missiledefense_register_meta' );
function missiledefense_register_meta() {
    register_meta( 'term', 'archive_list_title', array(
    	'type' => 'string',
    	'description' => 'Title to show in archive page.'
    ) );
    register_meta( 'term', 'archive_related_tags', array(
    	'type' => 'string',
    	'description' => 'Related tags to show on archive page.'
    ) );
}

// Add input box to edit form for system taxonomy
add_action( 'system_edit_form_fields', 'missiledefense_edit_term_archive_list_title_field' );
function missiledefense_edit_term_archive_list_title_field( $term ) {

    $default = 'System Elements';
    $archive_list_title = get_term_meta( $term->term_id, 'archive_list_title', true );
    $archive_related_tags = get_term_meta( $term->term_id, 'archive_related_tags', true );

    if ( ! $archive_list_title )
        $archive_list_title = $default; ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'missiledefense_term_archive_list_title_nonce' ); ?>

    <tr class="form-field missiledefense-term-archive_list_title-wrap">
        <th scope="row"><label for="missiledefense-term-archive_list_title"><?php _e( 'Archive List Title:', 'missiledefense' ); ?></label></th>
        <td>
            <input type="text" name="missiledefense_term_archive_list_title" id="missiledefense-term-archive_list_title" value="<?php echo esc_attr( $archive_list_title ); ?>" />
        </td>
    </tr>
    <tr class="form-field missiledefense-term-archive_related_tags-wrap">
        <th scope="row"><label for="missiledefense-term-archive_related_tags"><?php _e( 'Archive Related Tags:', 'missiledefense' ); ?></label></th>
        <td>
            <input type="text" name="missiledefense_term_archive_related_tags" id="missiledefense-term-archive_related_tags" value="<?php echo esc_attr( $archive_related_tags ); ?>" />
        </td>
    </tr>
<?php }

// Save Custom Meta
add_action( 'edit_system',   'missiledefense_save_term_archive_list_title' );
function missiledefense_save_term_archive_list_title( $term_id ) {

    if ( ! isset( $_POST['missiledefense_term_archive_list_title_nonce'] ) || ! wp_verify_nonce( $_POST['missiledefense_term_archive_list_title_nonce'], basename( __FILE__ ) ) )
        return;

    $old_archive_list_title = get_term_meta( $term_id, 'archive_list_title', true );
    $new_archive_list_title = isset( $_POST['missiledefense_term_archive_list_title'] ) ? sanitize_text_field( $_POST['missiledefense_term_archive_list_title'] ) : '';

    if ( $old_archive_list_title && '' === $new_archive_list_title )
        delete_term_meta( $term_id, 'archive_list_title' );

    else if ( $old_archive_list_title !== $new_archive_list_title )
        update_term_meta( $term_id, 'archive_list_title', $new_archive_list_title );

    $old_archive_related_tags = get_term_meta( $term_id, 'archive_related_tags', true );
    $new_archive_related_tags = isset( $_POST['missiledefense_term_archive_related_tags'] ) ? sanitize_text_field( $_POST['missiledefense_term_archive_related_tags'] ) : '';

    if ( $old_archive_related_tags && '' === $new_archive_related_tags )
        delete_term_meta( $term_id, 'archive_related_tags' );

    else if ( $old_archive_related_tags !== $new_archive_related_tags )
        update_term_meta( $term_id, 'archive_related_tags', $new_archive_related_tags );
}
