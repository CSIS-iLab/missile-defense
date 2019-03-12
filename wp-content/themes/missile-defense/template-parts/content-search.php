<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */

?>

<article id="post-<?php the_ID(); ?>" class="post archive-article" <?php post_class(); ?>>
		<div class="entry-meta archive">
			<?php the_date(); // Display the time published ?>
		</div><!-- .entry-meta -->

	<?php the_title( sprintf( '<h2 class="entry-title archive"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	<?php if ( 'post' === get_post_type() ) : ?>

		
		
	<?php endif; ?>
	<div class='excerpt-container'>
	<?php the_excerpt(); ?>
	</div>
<div class='meta-container'>
		<?php missiledefense_entry_categories(); ?>
	</div>

</article><!-- #post-## -->
