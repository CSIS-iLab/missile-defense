<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Transparency
 */

get_header();

// Begin the post loop so we can get the post title and featured image to display in the header
while ( have_posts() ) : the_post();
?>
	<div id="primary" class="container">
		<div class="row">
			<main id="main" class="col-xs-12" role="main">

			<!-- START: Post Content -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php
						the_title( '<h1 class="entry-title">', '</h1>' );
						if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php transparency_posted_on(); ?><br />
							<?php transparency_entry_footer(); ?>
						</div><!-- .entry-meta -->
						<?php
						endif; ?>
						<?php the_post_thumbnail(); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content( sprintf(
								/* translators: %s: Name of current post. */
								wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'transparency' ), array( 'span' => array( 'class' => array() ) ) ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'transparency' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
					<div class='meta-container'>
						<?php transparency_entry_categories(); ?>
					</div>
				</article>
				<!-- END: Post Content -->

				<?php
				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #primary -->

<?php
get_footer();
