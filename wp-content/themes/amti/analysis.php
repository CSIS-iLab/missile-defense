<?php
/**
 * The template for displaying the analysis post listing page.
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 * Template Name: Analysis Listing
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
		<div class="container">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<hr>
		</div>
	</header>
	<?
}
?>
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<?php the_content(); ?>
				<div class="row">

				<?php 
					$args = array( 'posts_per_page' => -1, 'cat' => 17);
					$recent_posts = new WP_Query( $args );

					while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
						echo "<div class='col-xs-12 col-sm-4 col-md-3 wide-grid'>";
				    	get_template_part( 'template-parts/content', get_post_format() );
				    	echo "</div>";
					endwhile; // end of the loop.
					wp_reset_postdata();
				?>
			</div>

		</main><!-- #main -->
	</div><!-- .row -->
</div><!-- #primary -->

<?php
get_footer();