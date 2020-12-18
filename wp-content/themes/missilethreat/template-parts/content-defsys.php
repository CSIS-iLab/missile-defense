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

	<?php

	// get_template_part( 'template-parts/entry-header' );
	// missiledefense_system_terms()
	?>

	<div class="single__content">
		<?php
			the_content( __( 'Continue reading', 'missilethreat' ) );
		?>
	</div><!-- .post-inner -->

	<footer class="single__footer">
	<?php missiledefense_display_footnotes(); ?>
		<?php missiledefense_share(); ?>
		<hr class="divider divider--gray"/>
		<?php echo missiledefense_citation(); ?>
	</footer>

</article><!-- .post -->