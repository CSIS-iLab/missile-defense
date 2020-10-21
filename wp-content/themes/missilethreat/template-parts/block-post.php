<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

?>

<article <?php post_class('post-block post-block--post'); ?> id="post-<?php the_ID(); ?>">

	<div class="post-block__category">
<?php
	missilethreat_display_categories();
?>
	</div>

	<?php

	the_title( '<h2 class="post-block__title text--semibold"><a href="' . esc_url( get_permalink() ) . '" class="post-title--hover">', '</a></h2>' );

	missilethreat_posted_on();

	missilethreat_authors();
	
	if (!is_front_page()) {
	?>
		
	<p class="post-block__excerpt"> <?php echo get_the_excerpt(); ?></p>	

	<?php
	}
	if ( has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>" class="thumbnail-link">
        <?php the_post_thumbnail(array(400, 304)); ?>
    </a>
	<?php endif; ?>

</article><!-- .post -->
