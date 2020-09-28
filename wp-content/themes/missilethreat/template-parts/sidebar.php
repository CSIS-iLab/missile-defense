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
		'post_type' => 'defsys',
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC',
		'posts_per_page' => -1
) )
	?>

	<label for="system-select" class="component-select__label">SEARCH</label>
	<select name="componentSelect" id="system-select" class="component-select"><option value="">Choose a component...</option>

	<?php
	while( $query->have_posts() ) {
		$query->the_post();
		echo '<option value="' . esc_url( get_permalink() ) . '" class="component-select__option">' . get_the_title() . '</option>';
	}

	echo '</select><button type="submit" form="system-select" class="component-select__submit" id="system-select-go">Go</button>';

	wp_reset_postdata();

} elseif ( is_post_type_archive( 'missile' ) ) {
	$query = new WP_Query( array(
		'post_type' => 'missile',
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC',
		'posts_per_page' => -1
) )
	?>

	<label for="missile-select" class="component-select__label">SEARCH</label>
	<select name="missileSelect" id="missile-select" class="component-select"><option value="">Choose a missile...</option>

	<?php
	while( $query->have_posts() ) {
		$query->the_post();
		echo '<option value="' . esc_url( get_permalink() ) . '" class="component-select__option">' . get_the_title() . '</option>';
	}

	echo '</select><button type="submit" form="missile-select" class="component-select__submit" id="missile-select-go">Go</button>';

	wp_reset_postdata();

} else {
	dynamic_sidebar( 'sidebar' );
}
?>