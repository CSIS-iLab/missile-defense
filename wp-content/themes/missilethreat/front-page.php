<?php
/**
 * The template for displaying the home page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
	<section class="home__recent">
	<?php

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5
  );

  $featuredPosts = new WP_Query( $args );

	if ( $featuredPosts->have_posts() ) {

		while ( $featuredPosts->have_posts() ) {
			$featuredPosts->the_post();

			// If you need to have the first featured post look different, you can use this code to use a different template-part for it.
			// if ($featuredPosts->current_post === 0) {
			// 	get_template_part( 'template-parts/block-posts-featured' );
			// } else {
			// 	get_template_part( 'template-parts/block', get_post_type() );
			// }

			get_template_part( 'template-parts/block', get_post_type() );

		}

		wp_reset_postdata();
	}

	?>
	</section>

</main><!-- #site-content -->

<?php get_footer(); ?>