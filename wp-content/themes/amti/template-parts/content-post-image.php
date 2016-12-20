<?php
/**
 * Template part for displaying image (Feature) posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		the_post_thumbnail('full'); ?>
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