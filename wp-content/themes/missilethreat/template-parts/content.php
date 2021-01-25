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

$related_posts = get_post_meta( $post->ID, '_post_related_tags', true );

if ( is_tax() ) {
	$term = get_queried_object_id();
	$related_posts = get_term_meta( $term, 'archive_related_tags', true );
}

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="single__content">

		<?php

			echo missiledefense_display_system_elements();

			the_content( __( 'Continue reading', 'missilethreat' ) );
		?>
	<?php missiledefense_display_footnotes(); ?>
	</div><!-- .single__content -->

	<footer class="single__footer">
		<?php missiledefense_share(); ?>
		<hr class="divider divider--gray"></hr>
		<?php 
		if ( 'post' == get_post_type() ) {
		echo missilethreat_authors_list_extended();
		echo missilethreat_post_attribution(); 
		}?>

		<?php echo missiledefense_citation(); ?>

		<?php echo missiledefense_related_posts(); ?>



	</footer>

</article><!-- .post -->
