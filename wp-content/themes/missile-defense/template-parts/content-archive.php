<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */
?>

<article id="post-<?php the_ID(); ?>" class="archive-article" <?php post_class(); ?>>
	<div class="entry-meta archive">
		<?php the_date(); // Display the time published ?>
	</div><!-- .entry-meta -->
	<h2 class="entry-title archive">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class='excerpt-container'>
	<?php the_excerpt(); ?>
	</div>

	<div class='meta-container'>
		<?php missiledefense_entry_categories(); ?>
	</div>

				

</article><!-- #post-## -->
