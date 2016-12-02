<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_time('m.d.Y'); // Display the time published ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	<div class='meta-container'>
		<?php transparency_entry_categories(); ?>
	</div>

</article><!-- #post-## -->
