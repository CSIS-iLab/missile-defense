<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card row'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="col-xs-12 col-sm-4 article-image">
		<div class="img-thumbs" >
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><img class="img-responsive" src="<?php the_post_thumbnail_url( 'homeImage' ); ?>"  alt="<?php the_title(); ?>" width="" height=""></a>
		</div>
	</div>
	<?php } ?>
	<div class="col-xs-12 col-sm-8">
		<span class="post-meta"><?php the_time('F j, Y'); ?></span>
		<?php the_title('<h2 class="entry-title archive"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
		<div class="post-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article><!-- #post-## -->