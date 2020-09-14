<?php
/**
 * The template for displaying the home page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
	<section class="home__recent">

	<h1 class="title text--bold">Hello, World!</h1>

	<?php

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5
  );

  $featuredPosts = new WP_Query( $args );

	if ( $featuredPosts->have_posts() ) {

		while ( $featuredPosts->have_posts() ) {
			$featuredPosts->the_post();

			// If you need to have the first featured post look different, you can use this code to use a different template-part for it.
			// if ($featuredPosts->current_post === 0) {
			// 	get_template_part( 'template-parts/block-posts-featured' );
			// } else {
			// 	get_template_part( 'template-parts/block', get_post_type() );
			// }

			get_template_part( 'template-parts/block', get_post_type() );

		}

		wp_reset_postdata();
	}

	?>
	</section>

	<section class="home__projects">

		<h2 class="home__projects-title">Ongoing Projects</h2>
		<div class="home__projects-info">
			<p class="home__projects-desc">Missile Threat features numerous interactive projects and data sets, regularly updated by our team as events unfold. Check back for the latest.</p>
			<?php 
				$cat_link = home_url('/category/ongoing-projects/');
			?>
			<a href="<?php echo esc_url($cat_link); ?>" class="home__projects-view-all">View All <?php echo missilethreat_get_svg('chevron-right') ?></a>
		</div>
		<div class="home__projects-wrapper">
			<?php

			$ongoingProjects = get_field('ongoing_projects');

			if ( $ongoingProjects ) {

				foreach ( $ongoingProjects as $post ) {
					setup_postdata($post);

					get_template_part( 'template-parts/block-project' );

				}

				wp_reset_postdata();
			}

			?>
		</div>
	</section>

</main><!-- #site-content -->

<?php get_footer(); ?>
