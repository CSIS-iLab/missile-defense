<?php
/**
 * Custom Post Meta for Related Posts
 * Available on posts, actors, and defense systems.
 * 
 * @package Missile_Defense
 */


/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function related_tags_add_meta_boxes( $post ) {
	add_meta_box( 'related_tags_meta_box', __( 'Related Posts', 'missiledefense' ), 'related_tags_build_meta_box', array( 'post','actors','defsys', 'systems' ), 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'related_tags_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function related_tags_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'related_tags_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_related_tags = get_post_meta( $post->ID, '_post_related_tags', true );
	?>
	<div class='inside'>
		<p>
			<label for="related_tags"><strong><?php esc_html_e( 'Related Tags', 'missiledefense' ); ?></strong></label>
			<input type="text" class="regular-text" id="related_tags" name="related_tags" value="<?php echo esc_textarea( $current_related_tags ); ?>" />
			<span class="howto"><?php esc_html_e( '', 'missiledefense' ); ?></span>
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
function related_tags_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['related_tags_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['related_tags_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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

	if ( isset( $_REQUEST['related_tags'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_post_related_tags', sanitize_text_field( wp_unslash( $_POST['related_tags'] ) ) ); // Input var okay.
	}
}
add_action( 'save_post', 'related_tags_save_meta_box_data' );
