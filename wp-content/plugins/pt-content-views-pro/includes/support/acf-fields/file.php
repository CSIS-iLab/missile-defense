<?php
/*
 * Show selected file
 * Return value = URL
 */

if ( is_array( $value ) ) {
	?>
	<a href="<?php echo esc_url( $value[ 'url' ] ); ?>"><?php printf( '%s %s', __( 'Download', 'content-views-pro' ), $value[ 'title' ] ); ?></a>
	<?php
}