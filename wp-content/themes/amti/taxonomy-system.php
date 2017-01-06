<?php
/**
 * The template for displaying Defense Systems type of system pages
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
			<h1 class="page-title"><?php echo str_replace('System Type: ','', get_the_archive_title()); ?></h1>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
<?
} else {
	?>
	<div id="primary" class="container">
		<header class="entry-header">
			<h1 class="page-title"><?php echo str_replace('System Type: ','', get_the_archive_title()); ?></h1>
		</header>
	<?
}
?>
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<?php
					echo "<div class='archive-description'>";
					the_archive_top_content();
					echo "</div>";
				
				if ( have_posts() ) : 

					$archiveTitle = get_term_meta( get_queried_object_id(), 'archive_list_title', true );
					if(!$archiveTitle) {
						$archiveTitle = "System Elements";
					}
					?>

				<div class="system-elements">
					<h1><?php echo $archiveTitle; ?></h1>

					<ul>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-defsys', get_post_format() );

						endwhile;

						?>
					</ul>
				</div>

				<?php
					else :

				endif;

					the_archive_bottom_content( '<div class="archive-description-bottom">', '</div>' );

				?>
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
