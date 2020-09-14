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

	<h1 class="title text--bold">Hello, World!</h1>

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

	<section class="home__news">
	<h2 class="home__news-heading">News</h2>

	<?php 
	$newsPosts = new WP_Query( array(
		'post_type' => 'post',
    'post_status' => 'publish',
		'posts_per_page' => 5,
		'category_name' => 'news'
	) );

	if ( $newsPosts->have_posts() ) {
		while ( $newsPosts->have_posts() ) {
			$newsPosts->the_post();

			the_title( '<h3 class="home__news-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );

			missilethreat_posted_on();
		}
	}
	?>
	</section>

</main><!-- #site-content -->

<?php get_footer(); ?>
