<?php
/**
 * Sidebar for archive pages
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

function get_archive_post_type() {
	return is_archive() ? get_queried_object()->name : false;
}

$post_type = get_archive_post_type();

if( is_post_type_archive( array( 'defsys', 'missile' ) ) ) {
	$query = new WP_Query( array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
			'posts_per_page' => -1
	) );

	if( $post_type === 'defsys') {
		$archive_type = 'component';
	} elseif( $post_type === 'missile' ) {
		$archive_type = 'missile';
	}
		?>
	
		<label for="item-select" class="component-select__label">Search</label>
		<div class="component-select">
		<select name="componentSelect" id="item-select" class="component-select__dropdown"><option value="">Choose a <?php echo $archive_type; ?>...</option>
	
		<?php
		while( $query->have_posts() ) {
			$query->the_post();
			echo '<option value="' . esc_url( get_permalink() ) . '" class="component-select__option">' . get_the_title() . '</option>';
		}
	
		echo '</select><button type="submit" form="item-select" class="btn btn--dark component-select__submit" id="item-select-go">Go</button></div>';
	
		wp_reset_postdata();

} else {
	dynamic_sidebar( 'sidebar' );
}
?>