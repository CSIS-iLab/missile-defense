<?php
/**
 * The template for displaying Island Tracker country pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

get_header();

if(get_archive_thumbnail_src()) {
	$feat_image = 'style="background-image:url('.get_archive_thumbnail_src("full").');"';
?>

	<header class="entry-header full-width" <?php echo $feat_image; ?>>
		<div class="container title">
			<h1 class="page-title"><?php echo str_replace('Country: ','Missiles of ', get_the_archive_title()); ?></h1>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
<?
} else {
	?>
	<div id="primary" class="container">
		<header class="entry-header">
			<h1 class="page-title"><?php echo str_replace('Country: ','Missiles of ', get_the_archive_title()); ?></h1>
		</header>
	<?
}
?>
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<?php
					the_archive_description( '<div class="archive-description">', '</div>' );
				
				if ( have_posts() ) : ?>

					<div class="missiletable">
					<h2>Missile Types</h2>
					<table id="missileTable">
						<thead>
							<th>Missile</th>
							<th class="hidden-xs">Class</th>
							<th class="hidden-xs">Range</th>
							<th class="hidden-xs">Status</th>
							<th>Menu Order</th>
						</thead>
						<tbody>


						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-missile', get_post_format() );

						endwhile;

						?>
						</tbody>
					</table>
					</div>

					<?php
						else :

					endif; ?>
			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>

	<script>
		jQuery(document).ready(function($) {
		    $('#missileTable').DataTable( {
		        "order": [[ 4, "asc" ]],
		        "paging": false,
		        "info": false,
		        "columnDefs": [
		            {
		                "targets": [ 4 ],
		                "visible": false,
		                "searchable": false
		            }
		        ]
		    } );
		    $('#missileTable_filter input').removeClass('input-sm');
		} );
	</script>

<?php
get_footer();
