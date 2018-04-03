<?php
/*
	Custom Post Types & associated Taxonomies for Missile Threat
	CPTS: Defense Systems, Missiles of the World
 */

/*-----------------------------------------------------------------------------------*/
/* Register custom 'defense system' type/taxonomies
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'defsys',
	    array(
			'labels' => array(
				'name' => __( 'Defense Systems' ),
				'singular_name' => __( 'Defense System' )
			),
			'public' => true,
			'has_archive' => true,
	    )
  	);
}

add_action( 'init', 'create_defsys_taxonomies', 0 );

function create_defsys_taxonomies() {
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
		'show_ui'           => true,
		'rewrite'           => array( 'slug' => 'system' ),
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'system', array( 'defsys' ), $args );
}

/*-----------------------------------------------------------------------------------*/
/* Register Missiles of the World
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'create_missile_type' );
function create_missile_type() {
	register_post_type( 'missile',
	    array(
			'labels' => array(
				'name' => __( 'World Missiles' ),
				'singular_name' => __( 'World Missile' )
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'publicize', 'thumbnail' ),
			'public' => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-layout',
    	)
  	);
}
add_action( 'init', 'create_countries_taxonomy', 0 );

function create_countries_taxonomy() {
	$labels = array(
		'name'              => _x( 'Countries', 'taxonomy general name' ),
		'singular_name'     => _x( 'Country', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Countries' ),
		'all_items'         => __( 'All Countries' ),
		'parent_item'       => __( 'Parent Country' ),
		'parent_item_colon' => __( 'Parent Country:' ),
		'edit_item'         => __( 'Edit Country' ),
		'update_item'       => __( 'Update Country' ),
		'add_new_item'      => __( 'Add New Country' ),
		'new_item_name'     => __( 'New Country Name' ),
		'menu_name'         => __( 'Countries' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country' ),
		'with_front'        => false,
	);
	register_taxonomy( 'countries', array( 'missile' ), $args );
}

/*-----------------------------------------------------------------------------------*/
/* Add Custom Term Meta to Defense Systems
/*-----------------------------------------------------------------------------------*/

// Register Meta
add_action( 'init', 'js_register_meta' );
function js_register_meta() {
    register_meta( 'term', 'archive_list_title', 'js_sanitize_input' );
}

// Sanitize Meta
function js_sanitize_input( $input ) {
    return $input;
}

// Add input box to edit form for system taxonomy
add_action( 'system_edit_form_fields', 'js_edit_term_archive_list_title_field' );
function js_edit_term_archive_list_title_field( $term ) {

    $default = 'System Elements';
    $archive_list_title = get_term_meta( $term->term_id, 'archive_list_title', true );

    if ( ! $archive_list_title )
        $archive_list_title = $default; ?>

    <tr class="form-field js-term-archive_list_title-wrap">
        <th scope="row"><label for="js-term-archive_list_title"><?php _e( 'Archive List Title:', 'js' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'js_term_archive_list_title_nonce' ); ?>
            <input type="text" name="js_term_archive_list_title" id="js-term-archive_list_title" value="<?php echo esc_attr( $archive_list_title ); ?>" />
        </td>
    </tr>
<?php }

// Save Custom Meta
add_action( 'edit_system',   'js_save_term_archive_list_title' );
function js_save_term_archive_list_title( $term_id ) {

    if ( ! isset( $_POST['js_term_archive_list_title_nonce'] ) || ! wp_verify_nonce( $_POST['js_term_archive_list_title_nonce'], basename( __FILE__ ) ) )
        return;

    $old_archive_list_title = get_term_meta( $term_id, 'archive_list_title', true );
    $new_archive_list_title = isset( $_POST['js_term_archive_list_title'] ) ? js_sanitize_input( $_POST['js_term_archive_list_title'] ) : '';

    if ( $old_archive_list_title && '' === $new_archive_list_title )
        delete_term_meta( $term_id, 'archive_list_title' );

    else if ( $old_archive_list_title !== $new_archive_list_title )
        update_term_meta( $term_id, 'archive_list_title', $new_archive_list_title );
}
