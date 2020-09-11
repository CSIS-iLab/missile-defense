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








	<div class="home__card">
		<a href="<?php echo site_url('/defsys') ?>" class="home__card-link">
		<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
		<h3 class="home__card-title">Defense Systems</h3>
		<p class="home__card-desc">Explore the components that go into making missile defense effective, including sensors, interceptors, command and control.</p>
		</a>
	</div>

	<div class="home__card">
		<a href="<?php echo site_url('/missile') ?>" class="home__card-link">
		<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
		<h3 class="home__card-title">Missiles of the World</h3>
		<p class="home__card-desc">A growing collection of information on various countries’ missile systems, with illustrations and information on their capabilities and history.</p>
		</a>
	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
