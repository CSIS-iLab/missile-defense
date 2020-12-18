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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	// get_template_part( 'template-parts/entry-header' );
	?>

	<div class="single__content">

		<?php
			the_content( __( 'Continue reading', 'missilethreat' ) );
		?>
	</div><!-- .post-inner -->

	<footer class="single__footer">
		<?php missiledefense_share(); ?>
		<hr class="divider divider--gray"></hr>
		<?php 
		if ( 'post' == get_post_type() ) {
		echo missilethreat_authors_list_extended();
		echo missilethreat_post_attribution(); 
		}?>

		<?php echo missiledefense_citation(); ?>

		<div class="related__wrapper alignwide">
			<div class="related">
				<h2 class="related__heading">Related</h2>
				<?php echo missilethreat_display_tags(); ?>
				
				<?php echo missiledefense_related_posts(); ?>
				
			</div>
		</div>

	</footer>

</article><!-- .post -->
