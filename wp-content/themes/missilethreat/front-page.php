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

	<div class="home__hero entry-header">
		<div class="home__about">
			<?php the_content(); ?>
		</div>
		<div class="home__credits">
			<p class="home__initiative">an initiative from<br/><a href="https://www.csis.org/programs/international-security-program/missile-defense-project" class="text--semibold">Missile Defense Project</a></p>
			<a href="https://www.csis.org" class="home__logo"><?php include( get_template_directory() . '/assets/static/csis-logo.svg'); ?></a>
		</div>
	</div>
	
<?php

	$featuredPosts = get_field('featured_posts');

	if ( $featuredPosts ) {
		$i = 0;
		foreach($featuredPosts as $key => $post):
			setup_postdata($post);

			// If you need to have the first featured post look different, you can use this code to use a different template-part for it.
			if ($key === array_key_first($featuredPosts)) {
				echo '<section class="home__recent-col1">';
				get_template_part( 'template-parts/block-post-featured' );
			} elseif ($i === 2) {
				get_template_part( 'template-parts/block', get_post_type() );
				echo '</section>';
			} elseif ($i === 3) {
				echo '<section class="home__recent-col2">';
				get_template_part( 'template-parts/block', get_post_type() );
			} elseif ($i === 4) {
				get_template_part( 'template-parts/block', get_post_type() );
				echo '</section>';
			} else {
				get_template_part( 'template-parts/block', get_post_type() );
			}
			$i++;

			endforeach;

		wp_reset_postdata();
	}

	?>

	<section class="home__news">
		<h2 class="home__heading home__news-heading">News</h2>

		<?php 
		$newsPosts = new WP_Query( array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'category_name' => 'news'
		) );

		if ( $newsPosts->have_posts() ) {
			while ( $newsPosts->have_posts() ) {
				$newsPosts->the_post();

				the_title( '<h3 class="home__news-title"><a href="' . esc_url( get_permalink() ) . '" class="post-title--hover">', '</a></h3>' );

				missilethreat_posted_on();
			}
			wp_reset_postdata();
		}
		?>

	</section>
	
	<div class="home__see-all home__all-analysis"><a href="<?php echo site_url('/analysis') ?>">All Analysis <?php echo missilethreat_get_svg('chevron-right') ?></a></div>

	<section class="home__cards">
		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
				<h2 class="home__card-title">
					<a href="<?php echo site_url('/defsys') ?>" class="home__card-link post-title--hover">Defense Systems <?php echo missilethreat_get_svg('chevron-right') ?></a>
				</h2>
			<p class="home__card-desc home__desc">Explore the components that go into making missile defense effective, including sensors, interceptors, command and control.</p>
		</div>

		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
			
				<h2 class="home__card-title">
					<a href="<?php echo site_url('/missile') ?>" class="home__card-link post-title--hover">Missiles of the World <?php echo missilethreat_get_svg('chevron-right') ?></a>
				</h2>
			<p class="home__card-desc home__desc">A growing collection of information on various countries’ missile systems, with illustrations and information on their capabilities and history.</p>
		</div>

	</section>

	<section class="home__projects">

		<h2 class="home__heading home__projects-heading">Ongoing Projects</h2>
		<div class="home__projects-info">
			<p class="home__projects-desc home__desc">Missile Threat features numerous interactive projects and data sets, regularly updated by our team as events unfold. Check back for the latest.</p>
			<?php 
				$cat_link = site_url('/category/ongoing-projects');
			?>
			<a href="<?php echo esc_url($cat_link); ?>" class="home__see-all home__projects-view-all">View all <?php echo missilethreat_get_svg('chevron-right') ?></a>
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

	<section class="home__newsletter">
		<?php dynamic_sidebar( 'newsletter' ); ?>

	</section>

	<section class="home__events">
		<h2 class="home__heading home__events-heading">Events</h2>
		<?php
			$eventsDescription = get_field('events_description');

			if($eventsDescription) : ?>
				<p class="home__events-desc home__desc"><?php echo $eventsDescription; ?></p>
			<?php  endif;
				

			$formatIn = 'm/d/Y';
			$formatOut = 'M j';

			$arr = array(1, 2, 3);
			foreach ($arr as $value) {
				$event = get_field('event_' . $value);
				$date = DateTime::createFromFormat($formatIn, get_field('event_' . $value . '_date'));

				if($event) { ?>
					<div class="event">
						<p class="event__date text--semibold"><?php echo $date->format($formatOut); ?></p>
						<a href="<?php echo esc_url($event['link']); ?>"  class="event__link post-title--hover"><?php echo $event['title']; ?></a>
					</div>
				<?php }
			}
			?>
	</section>

	<section class="home__twitter">
		<h2 class="home__heading home__twitter-heading">Twitter</h2>
		<?php 	dynamic_sidebar( 'twitter-feed' ); ?>
	</section>


</main><!-- #site-content -->

<?php get_footer(); ?>
