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
 * @package Transparency
 * Template Name: Home Page
 */

get_header(); ?>

<div id="primary" class="container homepage">
	<div class="row">
		<main id="main" class="col-xs-12" role="main">
			<?php the_content(); ?> <!-- Returns the content of the Home page -->

			<!-- Featured -->
			<?php 
				$argsFeatured = array( 
					'posts_per_page' => 4,
					'category' => 34,
				);
				$featured_posts = new WP_Query( $argsFeatured );

				echo "<h1 class='home'>Featured</h1>";
				echo "<div class='row' style='margin:0px;'>";

				while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
					echo "<div class='col-xs-12 col-sm-6 wide-grid'>";
			    	get_template_part( 'template-parts/content');
			    	echo "</div>";
				endwhile; // end of the loop.
				wp_reset_postdata();
				echo "</div>";
			?>

			<div class="row">
				<div class="col-xs-12 col-sm-8 content">

					<!-- News -->
					<div class="news-block">
						<?php 
							$argsNews = array( 
								'posts_per_page' => 3,
								'category' => 42,
							);
							$news_posts = new WP_Query( $argsNews );

							echo "<h1 class='home'>News</h1>";

							while ( $news_posts->have_posts() ) : $news_posts->the_post();
						    	get_template_part( 'template-parts/content', 'hp-text');
							endwhile; // end of the loop.
							wp_reset_postdata();
						?>
						<a class="moreposts" href="/category/news/" style="padding:10px;margin:0;">Read All News Posts</a>
					</div>

					<div class="analysis-block">
						<!-- Analysis -->
						<?php 
							$argsAnalysis = array( 
								'posts_per_page' => 3,
								'cat' => '17,33',
							);
							$analysis_posts = new WP_Query( $argsAnalysis );

							echo "<h1 class='home'>Analysis</h1>";

							while ( $analysis_posts->have_posts() ) : $analysis_posts->the_post();
						    	get_template_part( 'template-parts/content', 'hp-text');
							endwhile; // end of the loop.
							wp_reset_postdata();
						?>
						<a class="moreposts" href="/analysis/"  style="padding:10px;margin:0;">Read All Analysis posts</a>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>


		</main><!-- #main -->
	</div><!-- .row -->
</div><!-- #primary -->

<?php
get_footer();
