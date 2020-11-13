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

	<header class="page__header page__header--short">

    <h1 class="page__header-label">Search results:<br/></h1>
    <?php get_search_form(); ?>

  </header><!-- .archive-header -->
  
  <div class="search-total"><?php echo $archive_subtitle; ?></div>

		<?php

	if ( have_posts() ) {

		$i = 0;

		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/block-post', get_post_type() );

		}
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php
get_footer();
