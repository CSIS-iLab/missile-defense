<?php
/**
 * The template for displaying Defense Systems archive page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */

get_header();

if ( get_archive_thumbnail_src() ) {
	$feat_image = 'style="background-image:url('.get_archive_thumbnail_src("full").');"';
?>

	<header class="entry-header full-width" <?php echo $feat_image; ?>>
		<div class="container">
			<h1 class="page-title"><?php the_archive_title(); ?></h1>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
<?php } else { ?>
	<div id="primary" class="container">
		<header class="entry-header">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header>
	<?php } ?>
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<?php the_archive_top_content(); ?>
				<div class="row">
					<?php 
						$args=array(
						  'name' => 'system'
						);
						$output = 'objects'; // or names
						$taxonomies = get_taxonomies($args,$output); 
						if  ($taxonomies) {
						  foreach ($taxonomies  as $taxonomy ) {
						  	$terms = get_terms(array(
						  		'taxonomy' => $taxonomy->name,
						  		'hide_empty' => false
						  		));
		        			foreach ( $terms as $term) {
		        				$feature_image = get_archive_thumbnail_src("full", null, $term->term_id);
		        			?>

		        			<div class="col-xs-12 col-sm-4 col-md-3 wide-grid">
		        				<div class="grid_container">
			        				<a href="/system/<?php echo $term->slug; ?>">
				        				<div class="grid_card" style="background-image:url('<?php echo $feature_image; ?>');">
				        					<div class="title"><?php echo $term->name; ?></div>
				        					<div class="overlay"></div>
				        				</div>
				        			</a>
				        		</div>
		        			</div>

		        			<?php
		        			}
						  }
						}  
					?>
				</div>
			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

<?php
get_footer();
