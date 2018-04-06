<?php
/**
 * Custom Post Types: Missiles
 *
 * @package Missile_Defense
 */

/**
 * Create Missile custom post type.
 * @return array Custom post type.
 */
function missiledefense_cpt_missile() {
	register_post_type( 'missile',
	    array(
			'labels' => array(
				'name' => __( 'World Missiles' ),
				'singular_name' => __( 'World Missile' )
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'publicize', 'thumbnail' ),
			'public' => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-layout',
    	)
  	);
}
add_action( 'init', 'missiledefense_cpt_missile' );

/**
 * Create Countries taxonomy for Missile post type.
 * @return array Custom taxonomy.
 */
function missiledefense_taxonomy_countries() {
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
add_action( 'init', 'missiledefense_taxonomy_countries', 0 );

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function missile_add_meta_boxes( $post ) {
	add_meta_box( 'missile_meta_box', __( 'Additional Missile Information', 'missiledefense' ), 'missile_build_meta_box', 'missile', 'normal', 'high' );

	add_meta_box( 'missile_meta_box_countries', __( 'Countries', 'missiledefense' ), 'missile_build_meta_box_countries', 'missile', 'side' );
}
add_action( 'add_meta_boxes', 'missile_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function missile_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'missile_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_missile_name = get_post_meta( $post->ID, 'missile_name', true );
	$current_missile_class = get_post_meta( $post->ID, 'missile_class', true );
	$current_missile_range = get_post_meta( $post->ID, 'missile_range', true );
	$current_missile_status = get_post_meta( $post->ID, 'missile_status', true );
	$current_missile_url = get_post_meta( $post->ID, 'missile_url', true );
	?>
	<div class='inside'>
		<p>
			<label for="missile_name"><?php esc_html_e( 'Missile Shorthand Name', 'missiledefense' ); ?></label>
			<input type="text" class="regular-text" id="missile_name" name="missile_name" value="<?php echo esc_textarea( $current_missile_name ); ?>" />
			<span class="howto"><?php esc_html_e( 'Only used on the missile tables. If left blank, the full name will be used.', 'missiledefense' ); ?></span>
		</p>
		<p>
			<label for="missile_class"><?php esc_html_e( 'Missile Class', 'missiledefense' ); ?></label>
			<input type="text" class="regular-text" id="missile_class" name="missile_class" value="<?php echo esc_textarea( $current_missile_class ); ?>" />
		</p>
		<p>
			<label for="missile_range"><?php esc_html_e( 'Missile Range', 'missiledefense' ); ?></label>
			<input type="text" class="regular-text" id="missile_range" name="missile_range" value="<?php echo esc_textarea( $current_missile_range ); ?>" />
		</p>
		<p>
			<label for="missile_status"><?php esc_html_e( 'Missile Status', 'missiledefense' ); ?></label>
			<input type="text" class="regular-text" id="missile_status" name="missile_status" value="<?php echo esc_textarea( $current_missile_status ); ?>" />
		</p>
		<p>
			<label for="missile_url"><?php esc_html_e( 'Redirect To', 'missiledefense' ); ?></label>
			<select id="missile_url" name="missile_url">
				<option>---</option>
			<?php
				$missiles = get_posts(
					array(
						'post_type' => 'missile',
						'numberposts' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
					)
				);
				$options = '';
				foreach($missiles as $missile) {
					$selected = '';
					if ( $missile->ID == $current_missile_url ) {
						$selected = ' selected';
					}
					$options .= '<option value="' . esc_attr( $missile->ID ) . '"' . $selected . '>' . esc_html( $missile->post_title ) . '</option>';
				}
				echo $options;
			?>
			</select>
			<span class="howto"><?php esc_html_e( 'Only required if this missile should redirect to another missile\'s post.', 'missiledefense' ); ?></span>
		</p>
	</div>
	<?php
}

/**
 * Custom Meta Box for Country selection.
 * @param  array $post Post array.
 * @return string       Meta box HTML.
 */
function missile_build_meta_box_countries( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'missile_meta_box_nonce' );

	$current_missile_countries = get_post_meta( $post->ID, 'missile_countries' );
	if ( !is_array( $current_missile_countries ) ) {
		$current_missile_countries = array();
	}

	$current_missile_countries_primary = get_post_meta( $post->ID, 'missile_countries_primary', true );

	$countries = get_posts(
		array(
			'post_type' => 'countries',
			'numberposts' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		)
	);
	$options = '';
	foreach($countries as $country) {
		$checked = '';
		if ( in_array( $country->ID, $current_missile_countries ) ) {
			$checked = ' checked';
		}
		$primary_class = 'wpseo-make-primary-term';
		$primary_text = 'Make Primary';
		if ( $country->ID == $current_missile_countries_primary ) {
			$primary_class = 'wpseo-is-primary-term';
			$primary_text = 'Primary';
		}

		$options .= '<li style="clear: both;">
			<label for="country_' . esc_attr( $country->ID ) . '">
			<input type="checkbox" id="country_' . esc_attr( $country->ID ) . '" name="missile_countries[]" value="' . esc_attr( $country->ID ) . '"' . $checked . ' /> ' . esc_html( $country->post_title ) . '
			</label>
			<span class="country-make-primary ' . $primary_class . '" data-country="' . esc_attr( $country->ID ) . '">' . $primary_text . '</span>
		</li>';
	}
	?>
	<div class="taxonomydiv">
		<div class="tabs-panel">
			<input type="hidden" name="missile_countries_primary" value="<?php esc_attr( $current_missile_countries_primary ); ?>" />
			<ul class="categorychecklist form-noclear">
				<?php echo $options; ?>
			</ul>
		</div>
	</div>

	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function missile_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['missile_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['missile_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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

	if ( isset( $_REQUEST['missile_name'] ) ) { // Input var okay.
		update_post_meta( $post_id, 'missile_name', sanitize_text_field( $_POST['missile_name'] ) ); // Input var okay.
	}

	if ( isset( $_REQUEST['missile_class'] ) ) { // Input var okay.
		update_post_meta( $post_id, 'missile_class', sanitize_text_field( $_POST['missile_class'] ) ); // Input var okay.
	}

	if ( isset( $_REQUEST['missile_range'] ) ) { // Input var okay.
		update_post_meta( $post_id, 'missile_range', sanitize_text_field( $_POST['missile_range'] ) ); // Input var okay.
	}

	if ( isset( $_REQUEST['missile_status'] ) ) { // Input var okay.
		update_post_meta( $post_id, 'missile_status', sanitize_text_field( $_POST['missile_status'] ) ); // Input var okay.
	}

	if ( isset( $_REQUEST['missile_url'] ) && $_REQUEST['missile_url'] != 0 ) { // Input var okay.
		update_post_meta( $post_id, 'missile_url', intval(  wp_unslash( $_POST['missile_url'] ) ) ); // Input var okay.
	} else {
		delete_post_meta( $post_id, 'missile_url' );
	}

	if ( isset( $_REQUEST['missile_countries'] ) ) { // Input var okay.
		delete_post_meta( $post_id, 'missile_countries' );

		foreach( $_POST['missile_countries'] as $country ) {
			add_post_meta( $post_id, 'missile_countries', intval( wp_unslash( $country ) ) ); // Input var okay.
		}

	} else {
		delete_post_meta( $post_id, 'missile_countries' );
	}

	if ( isset( $_REQUEST['missile_countries_primary'] ) ) {
		update_post_meta( $post_id, 'missile_countries_primary', intval( $_POST['missile_countries_primary'] ) );
	} else {
		update_post_meta( $post_id, 'missile_countries_primary', '' );
	}
}
add_action( 'save_post', 'missile_save_meta_box_data' );

add_action( 'admin_enqueue_scripts', function() {
    if ( 'post' !== get_current_screen()->id ) {
        return;
    }
    // Enqueue code editor and settings for manipulating HTML.
    wp_add_inline_script(
        'code-editor',
        sprintf(
            'jQuery( function() { wp.codeEditor.initialize( "custom_css", %s ); } );',
            wp_json_encode( $settings )
        )
    );
} );
