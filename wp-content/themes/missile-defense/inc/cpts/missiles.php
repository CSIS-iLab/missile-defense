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
			'supports' => array( 'title', 'editor', 'excerpt', 'publicize', 'thumbnail', 'author' ),
			'hierarchical'      => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-layouts',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
    	)
  	);
}
add_action( 'init', 'missiledefense_cpt_missile' );

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function missile_add_meta_boxes( $post ) {
	add_meta_box( 'missile_meta_box', __( 'Additional Missile Information', 'missiledefense' ), 'missile_build_meta_box', 'missile', 'normal', 'high' );
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
}
add_action( 'save_post', 'missile_save_meta_box_data' );
