<?php
/**
 * Sidebar for archive pages
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


if( is_post_type_archive( 'defsys' ) ) {
$query = new WP_Query( array(
		'post_type' => 'defsys', // to make it simple I use default categories
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC',
		'posts_per_page' => -1
) )
	// if categories exist, display the dropdown
	?>
	<select name="componentSelect" id="component-select"><option value="">Choose a component...</option>
	<?php
	while( $query->have_posts() ) {
		$query->the_post();
		// echo '<option value="' . get_the_ID() . '"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></option>';
		echo '<option value="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</option>';
	}
	echo '</select>';

	wp_reset_postdata();

} elseif ( is_post_type_archive( 'missile' ) ) {
	echo "Hey";
} else {
	dynamic_sidebar( 'sidebar' );
}
?>