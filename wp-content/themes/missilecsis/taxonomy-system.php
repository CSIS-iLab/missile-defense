<?php
/**
 * The template for displaying the Defense System systems pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<header class="entry-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<div class="main-fluid"><!-- start the page containter -->
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span12">
				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content-island-tracker', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content-island-tracker', 'none' );

				endif; ?>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>

<?php
get_footer();
