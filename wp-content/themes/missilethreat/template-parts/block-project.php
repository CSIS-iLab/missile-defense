<?php
/**
 * The template for displaying ongoing project blocks
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

?>

<article <?php post_class('post-block post-block--post'); ?> id="post-<?php the_ID(); ?>">



<a href=" <?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>	

<?php
	the_title( '<h3 class="post-block__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
	
	missilethreat_posted_on();

	?>

</article><!-- .post -->
