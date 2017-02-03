<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

?>

<article id="post-<?php the_ID(); ?>" class="post" <?php post_class(); ?>>
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_time('m.d.Y'); // Display the time published ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	<div class='excerpt-container'>
	<?php the_excerpt(); ?>
	</div>
	<div class='meta-container'>
		<?php transparency_entry_categories(); ?>
	</div>
		

</article><!-- #post-## -->
