<?php
/**
 * The template for displaying single systems posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */

get_header();

$featured_img_html = null;
$feat_image_caption = '';

if( has_post_thumbnail() ) {
	$featured_img_url = get_the_post_thumbnail_url();
	$featured_img_html = ' style="background-image:url(' . esc_url( $featured_img_url ) . ');"'; 
	// $feat_image_caption = wp_get_attachment_caption($feat_image_id);
?>

	<header class="entry-header full-width" <?php echo $featured_img_html; ?>>
		<div class="container title">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
<?php } else {
	?>
	<div id="primary" class="container">
		<header class="entry-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header>
	<?php } ?>
		<div class="row">
			<main id="main" class="entry-content col-xs-12" role="main">
				<?php
					the_content();
					if ( $feat_image_caption ) {
						echo '<div class="post-featured-caption">' . esc_html_x( 'Photo Credit: ', 'missiledefense' ) . $feat_image_caption . '</div>';
					}
				?>
			</main><!-- #main -->
		</div>
		<?php get_template_part( 'template-parts/post-footer' ); ?>
	</div><!-- #primary -->

<?php
get_footer();
