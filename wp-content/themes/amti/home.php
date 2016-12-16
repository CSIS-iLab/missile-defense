<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 * Template Name: Home Page
 */

get_header(); ?>

<div id="primary" class="container homepage">
	<div class="row">
		<main id="main" class="col-xs-12" role="main">
			<?php the_content(); ?> <!-- Returns the content of the Home page -->

		</main><!-- #main -->
	</div><!-- .row -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
get_footer();
