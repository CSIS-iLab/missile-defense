<?php
/**
 * The template for displaying country pages..
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */

get_header();

$header_class = 'entry-header';
if ( has_post_thumbnail() ) {
	$header_class .= ' full-width';
	$featured_img_url = get_the_post_thumbnail_url();
	$featured_img_html = ' style="background-image:url(' . esc_url( $featured_img_url ) . ');"'; 
}

?>

	<header class="<?php echo $header_class; ?>" <?php echo $featured_img_html; ?>>
		<div class="container title">
			<?php the_title( '<h1 class="page-title">Missiles of ', '</h1>' ); ?>
		</div>
		<div class="overlay"></div>
	</header>
	<div id="primary" class="container">
		<div class="row">
			<main id="main" class="entry-content col-xs-12" role="main">
				<?php
					the_content();

					$args = array(
						'post_type' => 'missile',
					    'meta_key'   => 'missile_countries',
					    'meta_value' => $post->ID,
					    'meta_compare' => '='
					);
					$missiles = get_posts( $args );

				if ( $missiles ) : ?>

					<div class="missiletable">
					<h2 class="text-center"><?php esc_html_e( 'Missile Types', 'missiledefense' ); ?></h2>
					<table id="missileTable">
						<thead>
							<th><?php esc_html_e( 'Missile', 'missiledefense' ); ?></th>
							<th class="hidden-xs"><?php esc_html_e( 'Class', 'missiledefense' ); ?></th>
							<th class="hidden-xs"><?php esc_html_e( 'Range', 'missiledefense' ); ?></th>
							<th class="hidden-xs"><?php esc_html_e( 'Status', 'missiledefense' ); ?></th>
						</thead>
						<tbody>
						<?php
						/* Start the Loop */
						foreach( $missiles as $post ) {
							setup_postdata( $post );
							get_template_part( 'template-parts/content-missile', get_post_format() );
						}
						?>
						</tbody>
					</table>
					</div>

					<?php
					endif;

					missiledefense_countries_secondary_content($post->ID);
					missiledefense_shareOnArchives();
				?>
			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>

	<script>
		jQuery(document).ready(function($) {
		    $('#missileTable').DataTable( {
		        "paging": false,
		        "info": false,
		        "order": []
		    } );
		    $('#missileTable_filter input').removeClass('input-sm');
		} );
	</script>

<?php
get_footer();
