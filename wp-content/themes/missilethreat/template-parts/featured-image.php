<?php
/**
 * Displays the featured image
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

$is_singular = is_singular();
$is_front_page = is_front_page();
$page_for_posts = get_option( 'page_for_posts' );
$post_type = get_post_type();
$img_caption = get_the_post_thumbnail_caption();

if ( is_singular( array( 'systems', 'actors' ) ) || is_single() && has_post_thumbnail() || is_page() ) {
	$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
<?php }

elseif ( is_post_type_archive() ) { 
	$feat_image = get_archive_thumbnail_src( 'missilethreat-fullscreen' ); ?>
<?php }

elseif ( $page_for_posts ) { 
	$feat_image = get_the_post_thumbnail_url( $page_for_posts );
}?>

	<figure class="featured-media">

		<img src="<?php echo $feat_image ?>" alt="">

		<?php if (!empty( $img_caption ) ) { ?>

			<figcaption class="image-caption"><?php echo $img_caption; ?></figcaption>

			<?php } ?>

	</figure><!-- .featured-media -->

