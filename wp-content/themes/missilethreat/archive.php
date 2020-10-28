
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

<header class="archive__header entry-header">
  <?php 

    $posts_page = get_option( 'page_for_posts' );
    if ( $posts_page ) { // Only target the blog page
      $post = get_queried_object();
      setup_postdata( $post ); 
          // Display the post title
          // the_title();
  
          // Display the post thumbnail
          if ( has_post_thumbnail() ) {
              // featured image URL
              $size = 'my_custom_size';
              $thumbnail_id =  get_post_meta( get_the_ID(), '_thumbnail_id', true );
              $image_src = wp_get_attachment_image_src( $thumbnail_id, $size );

              $url = $image_scr[0]; 
  
              // Display post thumbnail
              the_post_thumbnail( $size );
          }
      wp_reset_postdata(); // Restore the $post global
  }
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