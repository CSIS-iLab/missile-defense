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

$object = get_queried_object();

$post_attribution = get_field( 'post_attribution', $object->name );

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
		<?php echo missilethreat_authors_list_extended(); ?>
		<p class="single__footer-attribution">
			<?php echo $post_attribution; ?>
		</p>
		<?php echo missiledefense_citation(); ?>

	</footer>

</article><!-- .post -->
