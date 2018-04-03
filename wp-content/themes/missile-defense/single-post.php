<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Missile_Defense
 */

get_header();

// Begin the post loop so we can get the post title and featured image to display in the header
while ( have_posts() ) : the_post();
?>
	<div id="primary" class="container">
		<div class="row">
			<main id="main" class="col-xs-12" role="main">

			<!-- START: Post Content -->
				<?php
					get_template_part( 'template-parts/content-post', get_post_format() );
				?>
				<!-- END: Post Content -->

				<?php
				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #primary -->

<?php
get_footer();
