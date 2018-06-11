<?php
/**
 * Template Name: Page with Sidebar
 * Template Post Type: actors
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 */

get_header();

?>
	<div id="primary" class="container">
		<div class="row">
			<header class="entry-header col-xs-12">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<main id="main" class="entry-content col-xs-12" role="main">
				<div class="tableOfContents">
					<h2><?php esc_html_e( 'Table of Contents', 'missiledefense' ); ?></h2>
					<?php missiledefense_actors_secondary_content($post->ID); ?>
				</div>
				<div class="tableOfContents-mainContent">
					<?php the_content(); ?>
				</div>
			</main>
		</div>
		<?php get_template_part( 'template-parts/post-footer' ); ?>
	</div><!-- #primary -->
<?php
get_footer();
