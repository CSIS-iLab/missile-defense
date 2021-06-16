<?php
/**
 * The default template for displaying defense system content
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




<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="single__content">
		<?php
			the_content( __( 'Continue reading', 'missilethreat' ) );
		?>
	<?php missiledefense_display_footnotes(); ?>
	</div><!-- .single__content -->

	<footer class="single__footer">
		<?php missiledefense_share(); ?>
		<hr class="divider divider--gray"/>
		<?php echo missiledefense_citation(); ?>
		<?php echo missiledefense_related_posts(); ?>
	</footer>

</article><!-- .post -->