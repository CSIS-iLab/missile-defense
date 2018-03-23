<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 * Template Name: Home Page
 */

get_header(); ?>
<div id="primary" class="homepage">
<main id="main" role="main">
<div id="mission" class="container-fluid">
	<div class="row">
	<div class="container">
		<div class="row-eq-height mission-container">

			<div class="col-sm-4">
				<div class="mission-header">
					<div><h5>ABOUT</h5></div>
				</div>
			</div>

			<div class="col-sm-8 mission-statement">
				<div class=""><?php the_content(); ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>

<section class="hpsection">
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="analysis-block">

						<div class='hpsection-header'>
							<h1 class='home'>FEATURED<span>ITEMS</span></h1>
							<a class='link-btn ltblue moreposts' href='/analysis/'>Read All</a>
							</div>
							<?php
							$optionsFeatures = get_option( 'missiledefense_hpFeaturesPosts_options' );
							$featuresLimit = $optionsFeatures['post_limit'];

							if(!$featuresLimit) {
								$featuresLimit = 3;
							}

							$argsAnalysis = array(
								'posts_per_page' => $featuresLimit,
								'cat' => '34',
							);
							$analysis_posts = new WP_Query( $argsAnalysis );


							while ( $analysis_posts->have_posts() ) : $analysis_posts->the_post();
						    	get_template_part( 'template-parts/content', 'hp-text');
							endwhile; // end of the loop.
							wp_reset_postdata();

							echo "<a href='/analysis/' class='link-btn ltblue moreposts-bottom'>Read All Articles</a>";
					?>
			</div>
		</div>
	</div>
</div>
</section>

<!-- Ongoing Projects -->
<div id="ongoing" class="container-fluid">
	<div class="row">
	<div class="container">
		<div class="row-eq-height ongoing-container">

			<div class="col-sm-4 ongoing-header-container">
				<div class="ongoing-header">
					<div><h1>ONGOING<span>PROJECTS</span></h1></div>
					<?php
						$transparency_desc = get_option( 'transparency_homepage_ongoing_projects_desc' );
						echo '<p>' . $transparency_desc . '</p>';
				  ?>
					<a href='/analysis/' class="link-btn blue gray">See All</a>

				</div>
			</div>

			<div class="col-sm-8">
				<div class="ongoing-statement">
					<?php
						$ongoing_project1 = get_option( 'transparency_homepage_ongoing_projects_1' );
						$ongoing_project2 = get_option( 'transparency_homepage_ongoing_projects_2' );
						$ongoing_project3 = get_option( 'transparency_homepage_ongoing_projects_3' );

						if( $ongoing_project1 || $ongoing_project2 || $ongoing_project3 ) {
							$ongoing_projectsArgs = array(
								'post__in' => array(
									$ongoing_project1,
									$ongoing_project2,
									$ongoing_project3
								),
								'orderby' => 'post__in'
							);
							$ongoing_projects = get_posts($ongoing_projectsArgs);
							foreach ($ongoing_projects as $post) : setup_postdata($post);
								get_template_part( 'template-parts/content', 'hp-ongoing' );
						  endforeach;
							wp_reset_postdata();
						}
					?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>



<!-- Missile Systems -->

<section class="hpsection missiles">
	<div class="missileSys container-fluid">
		<div class="missileimg">
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				<div class="missiletext">
					<div class="row missile-intro">

							<h1 class='home'>MISSILE<span>SYSTEMS</span></h1>
							<p>Explore <em>Missile Threat’s</em> dynamic database of information on offensive and defensive missile systems from across the globe.</p>
						</div>



					<div class="missile-subsection">
						<div class="row">
							<div class="col-sm-offset-3 col-xs-9">
								<h5>MISSILES OF THE WORLD</h5>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3 missile-icon">
								<img class="img-responsive missile-icon" src="wp-content/themes/amti/img/missiles-of-the-world-icon.svg" alt="Missile Defense">
							</div>

							<div class="col-sm-9">
								<p>A growing collection of information on various countries’ missile systems, with illustrations and up-to-date information on their capabilities and history.</p>

								<a href='/missile/' class="link-btn blue gray">LEARN MORE</a>

						</div>
					</div>

					<div class="missile-subsection">
						<div class="row">
							<div class="col-sm-offset-3 col-xs-9">
								<h5>DEFENSE SYSTEMS</h5>
							</div>
						</div>



						<div class="row">
							<div class="col-sm-3 missile-icon">
								<img class="img-responsive missile-icon" src="/wp-content/themes/amti/img/defense-systems-icon.svg" alt="Missile Defense">
							</div>


							<div class="col-sm-9">
								<p>Explore the components that go into making missile defense effective, including sensors, interceptors, command and  control.</p>

								<a href='/defsys/' class="link-btn blue gray">LEARN MORE</a>

						</div>
					</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>


<section class="hpsection">
<div class="container">
	<div class="row">
	<div class="news-block">
			<div class="col-sm-12">
				<div class='hpsection-header'>
				<h1 class='home'>LATEST<span>NEWS</span></h1>
				<a class='link-btn ltblue moreposts' href='/category/news/'>Read All</a>
				</div>
				</div>
				<div class="col-sm-8">

							<?php
							$options = get_option( 'missiledefense_hpNewsPosts_options' );
							$newsLimit = $options['post_limit'];

							if(!$newsLimit) {
								$newsLimit = 3;
							}

							$argsNews = array(
								'posts_per_page' => $newsLimit,
								'cat' => '42',
							);
							$news_posts = new WP_Query( $argsNews );

							while ( $news_posts->have_posts() ) : $news_posts->the_post();
						    	get_template_part( 'template-parts/content', 'hp-news');
							endwhile; // end of the loop.
							wp_reset_postdata();

						?>
				<button class='ltblue moreposts-bottom'><a href='/category/news/'>Read All News</a></button>
					<div class="row">
						<div class="col-sm-6 hp-widget">
						<div class="events-widget">
							<h5>EVENTS</h5>
							<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar-2' ); ?>

							<?php endif; ?>
							</div>
						</div>

						<div class="col-sm-6 hp-widget">
						<div class="newsletter-widget">
							<h5> NEWSLETTER </h5>
							<p>Sign up for the CSIS Missile Defense Project’s monthly newsletter for info on the project’s latest publications, upcoming events, and analysis on recent missile defense news.</p>
							<a href="/newsletter" class="link-btn blue">Sign up</a>
						</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 twitter-sidebar">
					<div class="twitter-sidebar">
					<?php get_sidebar(); ?>
					</div>
				</div>
</div>

		</div>
	</div>

</section>




<?php
get_footer();
