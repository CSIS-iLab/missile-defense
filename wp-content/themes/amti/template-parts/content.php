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
	<div class="grid_container">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="grid_card" style="background-image:url('<?php the_post_thumbnail_url( 'large' ); ?>');">
				<div class="title">
					<?php echo get_the_title(); ?>
				</div>
				<div class="overlay"></div>
			</div>
		</a>
	</div>
		
</article><!-- #post-## -->