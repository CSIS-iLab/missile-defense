
<?php
/**
 *Template Name: Archive Page Custom
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
**/

get_header();

?>


<main id="site-content" role="main">


<?php get_template_part( 'template-parts/entry-header', get_post_type() ); ?>

<div class='archive__content'>

  <section class="archive__posts">
    
  <?php

  if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/block-post' );

		}
	} 
	?>
  </section>
  
  <aside class="archive__sidebar">
    <?php
    get_template_part( 'template-parts/sidebar' )

    ?>
  </aside>
</div>

</main>

<?php get_footer(); ?>