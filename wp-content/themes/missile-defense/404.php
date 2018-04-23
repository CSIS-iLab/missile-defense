<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Missile_Defense
 */

get_header(); ?>

	<div id="primary" class="container">
		<div class="row">
			<main id="main" class="col-xs-12" role="main">
				<header>
					<h1>Welcome to <em>Missile Threat</em></h1>
				</header><!-- .entry-header -->

				<section class="error-404 not-found">
					<div class="page-content">
						<p><?php esc_html_e( 'We recently redesigned our site, and some URLs may have changed.', 'missiledefense' ); ?></p>
						<hr />

						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="widget widget_recent_entries">
									<h2 class="widgettitle">Information on</h2>		
									<?php 
										wp_nav_menu( array('menu' => '404 Info Menu') );
									?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<?php 
									$instance['title'] = "Recent Analysis";
									the_widget( 'WP_Widget_Recent_Posts', $instance );
								?>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="widget widget_recent_entries">
									<h2 class="widgettitle">Visit</h2>		
									<?php 
										wp_nav_menu( array('menu' => '404 Visit Menu') );
									?>
								</div>
							</div>
						</div>


					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

<?php
get_footer();
