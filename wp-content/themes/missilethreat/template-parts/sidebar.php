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
			'orderby' => 'name',
			'order' => 'ASC',
			'posts_per_page' => -1
	) );

	if( $post_type === 'defsys') {
		$archive_type = 'component';
		$side_header = 'Individual Components';
		$sidebar = 'systems-in-the-news';
	} elseif( $post_type === 'missile' ) {
		$archive_type = 'missile';
		$side_header = 'Find a Missile';
		$sidebar = 'missiles-in-the-news';
	}

	$side_desc = 'Know what you are looking for? Use this alphabetized list to find the page you need.';

		?>
		<h2 class="archive__sidebar-header"><?php echo $side_header; ?></h2>
		<p class="archive__sidebar-desc"><?php echo $side_desc; ?></p>
	
		<label for="item-select" class="component-select__label">Search</label>
		<div class="component-select">
		<select name="componentSelect" id="item-select" class="component-select__dropdown"><option value="">Choose a <?php echo $archive_type; ?>...</option>
	
		<?php
		while( $query->have_posts() ) {
			$query->the_post();
			echo '<option value="' . esc_url( get_permalink() ) . '" class="component-select__option">' . get_the_title() . '</option>';
		}
	
		echo '</select><button type="submit" form="item-select" class="btn btn--dark component-select__submit" id="item-select-go">Go</button></div>';
	
		wp_reset_postdata();?>

		<!-- <h4 class="archive__sidebar-news font--bold">In the news</h4>

		<hr class="page__header-divider">

		<?php dynamic_sidebar( $sidebar ) ?> -->

<?php
} else {
	dynamic_sidebar( 'sidebar' );
}
?>