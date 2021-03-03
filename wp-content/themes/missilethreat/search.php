<?php
/* 
Template Name: Search Page Custom 
*/

get_header();
?>

<main id="site-content" role="main">



<?php

global $wp_query;

if ( $wp_query->found_posts ) {
  $archive_subtitle = sprintf(
    /* translators: %s: Number of search results */
    _n(
      'We found %s result for your search.',
      'We found %s results for your search.',
      $wp_query->found_posts,
      'missilethreat'
    ),
    number_format_i18n( $wp_query->found_posts )
  );
}

		?>

	<header class="page__header page__header--short entry-header">
		<div class="page__header-inner">
    	<h1 class="page__header-label">Search results:<br/></h1>
    	<?php get_search_form(); ?>
		</div>
	</header><!-- .archive-header -->
	
	<div class='archive__content'>

		<section class="search-page">
  
			<?php echo missilethreat_number_of_posts(); ?>

				<?php

			if ( have_posts() ) {

				$i = 0;

				while ( have_posts() ) {
					$i++;
					if ( $i > 1 ) {
					}
					the_post();

					get_template_part( 'template-parts/block-post', get_post_type() );

				}
			} else { ?>
				<p class="search__no-results">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
			<?php }
			?>

			<?php get_template_part( 'template-parts/pagination' ); ?>
		</section>

		<aside class="archive__sidebar">
			<?php
			get_template_part( 'template-parts/sidebar' )

			?>
		</aside>
	</div><!-- .archive__content -->

</main><!-- #site-content -->

<?php
get_footer();
