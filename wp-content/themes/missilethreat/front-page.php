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

	$featuredPosts = get_field('featured_posts');

	if ( $featuredPosts ) {

		foreach($featuredPosts as $key => $post):
			setup_postdata($post);

			// If you need to have the first featured post look different, you can use this code to use a different template-part for it.
			if ($key === array_key_first($featuredPosts)) {
				get_template_part( 'template-parts/block-post-featured' );
			} else {
				get_template_part( 'template-parts/block', get_post_type() );
			}

			endforeach;

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

<section class="home__cards">
		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
			<a href="<?php echo site_url('/defsys') ?>" class="home__card-link">
				<h2 class="home__card-title">Defense Systems <?php echo missilethreat_get_svg('chevron-right') ?></h2>
			</a>
			<p class="home__card-desc">Explore the components that go into making missile defense effective, including sensors, interceptors, command and control.</p>
		</div>

		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
			<a href="<?php echo site_url('/missile') ?>" class="home__card-link">
				<h2 class="home__card-title">Missiles of the World <?php echo missilethreat_get_svg('chevron-right') ?></h2>
			</a>
			<p class="home__card-desc">A growing collection of information on various countries’ missile systems, with illustrations and information on their capabilities and history.</p>
		</div>

	</section>

</main><!-- #site-content -->

<?php get_footer(); ?>
