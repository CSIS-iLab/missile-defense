<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 class="entry-title">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h1>
	<div class="entry-meta">
		<?php the_time('m.d.Y'); // Display the time published ?>
	</div><!-- .entry-meta -->
	<div class='meta-container'>
		<?php transparency_entry_categories(); ?>
	</div>
				
		
</article><!-- #post-## -->