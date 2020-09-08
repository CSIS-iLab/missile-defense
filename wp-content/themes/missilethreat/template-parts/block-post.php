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

<p>

<?php
	foreach (get_the_category() as $category) {
		if ( $category->name !== 'Featured' ) {
				echo '<a class="post-block__category" href="' . get_category_link($category->term_id) . '">' .$category->name . '</a>'; //Markup as you see fit
		}
	}
?>

</p>

	<?php

	the_title( '<h3 class="post-block__title text--semibold"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );

	missilethreat_posted_on();

	missilethreat_authors();
	
	the_excerpt();

	the_post_thumbnail(array(200, 160));
?>

</article><!-- .post -->
