
<?php
/**
 *Template Name: Archive Page Custom
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
**/

get_header();

$page_for_posts = get_option( 'page_for_posts' );

if ( get_archive_thumbnail_src() ) {
  // $feat_image = get_the_post_thumbnail( $post );
	// $feat_image = get_the_post_thumbnail("full");
	$feat_image = 'style="background-image:url('.get_archive_thumbnail_src("full").');"';
	// $feat_image = get_archive_thumbnail_src("full");
} elseif ( $page_for_posts ) {
  // $feat_image = get_the_post_thumbnail( $page_for_posts );
  $feat_image = 'style="background-image:url('.get_the_post_thumbnail_url( $page_for_posts ).');"';
  // $feat_image = get_the_post_thumbnail_url( $page_for_posts );
}
?>


<main id="site-content" role="main">
  
  <header class="archive__header" <?php echo $feat_image; ?>>
    <h1 class="archive__title"><?php the_archive_title(); ?></h1>
<?php 


?>

</header>

<div class='archive'>

  <section class="archive__content">
    
  <?php

  if ( have_posts() ) {

		$i = 0;

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