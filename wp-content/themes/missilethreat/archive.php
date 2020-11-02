
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

// if ( is_post_type_archive() ) {
//   // $feat_image = get_the_post_thumbnail( $post );
// 	// $feat_image = get_the_post_thumbnail("full");
// 	$feat_image = 'style="background-image:url('.get_archive_thumbnail_src("full").');"';
// 	// $feat_image = get_archive_thumbnail_src("full");
// } elseif ( $page_for_posts ) {
//   // $feat_image = get_the_post_thumbnail( $page_for_posts );
//   $feat_image = 'style="background-image:url('.get_the_post_thumbnail_url( $page_for_posts ).');"';
//   // $feat_image = get_the_post_thumbnail_url( $page_for_posts );
// }
?>


<main id="site-content" role="main">

  <?php 
  if ( is_post_type_archive() ) { 
    $feat_image = 'style="background-image:url('.get_archive_thumbnail_src("full").');"';?>
    <header class="page__header-header" <?php echo $feat_image; ?>>
    <h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
    <div class="page__header-divider"></div>
    <div class="page__header-desc"><?php the_archive_top_content(); ?> </div>
  
  <?php } elseif ( is_archive() ) { ?>
    <header class="page__header page__header--short" style='background:linear-gradient(180deg, rgba(7, 52, 74, 0) 0%, rgba(6, 43, 61, 0.9) 75.52%), linear-gradient(90deg, #2A5565 0%, #5F7981 100%);'>
    <div class="overlay"></div>
    <h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
    <div class="page__header-divider page__header-divider--short"></div>
    <div class="page__header-desc page__header-desc--short"><?php the_archive_top_content(); ?> </div>
    
  <?php } elseif ( $page_for_posts ) { 
    $feat_image = 'style="background-image:url('.get_the_post_thumbnail_url( $page_for_posts ).');"';?>
    <header class="archive__header" <?php echo $feat_image; ?>>
    <?php
    $post = get_page($page_for_posts);
    setup_postdata($post); ?>
    <h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
    <div class="page__header-divider"></div>
    <div class="page__header-desc"><?php the_content(); ?> </div>

  <?php }

wp_reset_postdata();

?>

</header>

<div class='archive__content'>

  <section class="archive__posts">
    
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