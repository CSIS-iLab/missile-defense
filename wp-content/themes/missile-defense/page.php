<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#pages
 *
 * @package Missile_Defense
 */

get_header();

if(get_post_thumbnail_id($post->ID)) {
	$feat_image = 'style="background-image:url('.wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).');"';
?>

	<header class="entry-header full-width" <?php echo $feat_image; ?>>
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
<?
} else {
	?>
	<div id="primary" class="container">
		<header class="entry-header">
			<?php the_title( '<h1>', '</h1>' ); ?>
		</header>
	<?
}
?>

		<div class="row">
			<main id="main" class="col-xs-12" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #primary -->

<?php
get_footer();
