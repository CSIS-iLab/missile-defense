<?php
/**
 * Template part for displaying text posts on homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
	<div class="col-sm-12">
	<span class="meta"><?php the_time('F j, Y'); ?></span>
	<h2>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h2>
	<?php the_excerpt(); ?>
	</div>
	</div>
	<div class="clearfix"></div>
</article><!-- #post-## -->