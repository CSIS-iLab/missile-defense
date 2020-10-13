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
	
	<div class="home__hero">
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
	<h2 class="home__news-heading">News</h2>

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

			the_title( '<a href="' . esc_url( get_permalink() ) . '"><h3 class="home__news-title link--hover">', '</h3></a>' );

			missilethreat_posted_on();
		}
		wp_reset_postdata();
	}
	?>

	</section>
	
	<div class="home__all-analysis"><a href="<?php echo site_url('/analysis') ?>">All Analysis <?php echo missilethreat_get_svg('chevron-right') ?></a></div>

<section class="home__cards">
		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
			<a href="<?php echo site_url('/defsys') ?>" class="home__card-link">
				<h2 class="home__card-title link--hover">Defense Systems <?php echo missilethreat_get_svg('chevron-right') ?></h2>
			</a>
			<p class="home__card-desc">Explore the components that go into making missile defense effective, including sensors, interceptors, command and control.</p>
		</div>

		<div class="home__card">
			<img src="https://placekitten.com/64/64" alt="" class="home__card-icon">
			<a href="<?php echo site_url('/missile') ?>" class="home__card-link">
				<h2 class="home__card-title link--hover">Missiles of the World <?php echo missilethreat_get_svg('chevron-right') ?></h2>
			</a>
			<p class="home__card-desc">A growing collection of information on various countries’ missile systems, with illustrations and information on their capabilities and history.</p>
		</div>

	</section>

	<section class="home__projects">

		<h2 class="home__projects-title">Ongoing Projects</h2>
		<div class="home__projects-info">
			<p class="home__projects-desc">Missile Threat features numerous interactive projects and data sets, regularly updated by our team as events unfold. Check back for the latest.</p>
			<?php 
				$cat_link = site_url('/category/ongoing-projects');
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

		<section class="home__newsletter">
			<h2>Newsletter Placeholder</h2>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut congue nisi quis erat ullamcorper malesuada. Fusce dapibus ligula sit amet eros lobortis, quis iaculis dui molestie. Curabitur tortor libero, imperdiet quis justo eu, pellentesque sagittis augue. Ut maximus tincidunt nibh quis laoreet. Suspendisse potenti. Etiam vulputate in dui at tempor. Vivamus commodo iaculis massa, vel ultricies elit euismod eu. Mauris a sapien suscipit, venenatis ligula in, iaculis lacus. Cras at ex cursus, placerat turpis nec, lacinia purus. Praesent sagittis mattis enim a vulputate. Vestibulum maximus, metus sed gravida tincidunt, augue tortor dignissim tortor, mattis lobortis sapien lorem nec mi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis eu luctus quam. Etiam eget lobortis metus, in luctus sapien. Fusce finibus bibendum augue nec ultrices.
			</p>

			</section>
		<section class="home__events">
			<h2 class="home__events-heading">Events</h2>
			<?php
				$eventsDescription = get_field('events_description');
				$event1 = get_field('event_1');
				$event2 = get_field('event_2');
				$event3 = get_field('event_3');

				$formatIn = 'm/d/Y';
				$formatOut = 'M j';

				$date1 = DateTime::createFromFormat($formatIn, get_field('event_1_date'));
				$date2 = DateTime::createFromFormat($formatIn, get_field('event_2_date'));
				$date3 = DateTime::createFromFormat($formatIn, get_field('event_3_date'));

				if($eventsDescription) : ?>
				<p class="home__events-desc"><?php echo $eventsDescription; ?></p>
				<?php  endif;
				
				if($event1) : ?>
				<div class="event">
					<p class="event__date text--semibold"><?php echo $date1->format($formatOut); ?></p>
					<a href="<?php echo esc_url($event1['link']); ?>"  class="event__link link--hover"><?php echo $event1['title']; ?></a>
				</div>

				<?php endif; 
				
				if($event2) : ?>
					<div class="event">
						<p class="event__date text--semibold"><?php echo $date2->format($formatOut); ?></p>
						<a href="<?php echo esc_url($event2['link']); ?>"  class="event__link link--hover"><?php echo $event2['title']; ?></a>
					</div>
	
					<?php endif;
					
					if($event3) : ?>
						<div class="event">
							<p class="event__date text--semibold"><?php echo $date3->format($formatOut); ?></p>
							<a href="<?php echo esc_url($event3['link']); ?>"  class="event__link link--hover"><?php echo $event3['title']; ?></a>
						</div>
		
						<?php endif; ?>
		</section>
		<section class="home__twitter">
			<h2 class="home__twitter-heading">Twitter</h2>
			<?php 	dynamic_sidebar( 'twitter-feed' ); ?>
		</section>

</main><!-- #site-content -->

<?php get_footer(); ?>
