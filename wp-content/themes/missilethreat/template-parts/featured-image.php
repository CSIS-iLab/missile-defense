<?php
/**
 * Displays the featured image
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


if ( is_singular( array( 'systems', 'actors' ) ) || is_single() && has_post_thumbnail() || is_page() ) {
	$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
<?php }

elseif ( is_post_type_archive() ) { 
	$feat_image = get_archive_thumbnail_src( 'missilethreat-fullscreen' ); ?>
<?php }

elseif ( $page_for_posts ) { 
	$feat_image = get_the_post_thumbnail_url( $page_for_posts );
}?>

		<?php the_post_thumbnail(); ?>

		<figcaption class="image-caption"><?php the_post_thumbnail_caption(); ?></figcaption>

	</figure><!-- .featured-media -->


	<?php
}
