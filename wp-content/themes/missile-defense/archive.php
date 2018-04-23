<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 * Template Name: Archive Page
 */

get_header(); ?>

	<div id="primary" class="container archives-index">
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<header class="page-header">
					<h1 class="page-title">Related Results:</h1>
				</header><!-- .page-header -->

			<?php
			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'archive' );

				endwhile;

				the_posts_navigation(array('prev_text' => 'Previous', 'next_text' => 'Next'));

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #primary -->

<?php
get_footer();
