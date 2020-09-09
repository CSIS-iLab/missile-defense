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

</main><!-- #site-content -->

<?php get_footer(); ?>
