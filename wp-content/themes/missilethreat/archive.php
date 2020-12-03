
<?php
/**
 *Template Name: Archive Page Custom
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
**/

get_header();

$posts_page = get_option( 'page_for_posts' );

$object = get_queried_object();

$missile_page_desc = get_field( 'description', $object->name );

$actor_cat_1_title = get_field( 'category_1_actors_title', $object->name );
$actor_cat_2_title = get_field( 'category_2_actors_title', $object->name );

$defsys_cat_1_title = get_field( 'category_1_title', $object->name );
$defsys_cat_2_title = get_field( 'category_2_title', $object->name );
$cat_3_title = get_field( 'category_3_title', $object->name );

$defsys_cat_1_desc = get_field( 'category_1_description', $object->name );
$defsys_cat_2_desc = get_field( 'category_2_description', $object->name );
$defsys_cat_3_desc = get_field( 'category_3_description', $object->name );


?>

<main id="site-content" role="main">

<header class="archive__header entry-header">
<?php


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

<div class='archive__content'>

  <?php
  
  if ( is_post_type_archive('missile') ) { ?>

    <section class="actors">
      <p class="archive__desc"><?php echo $missile_page_desc; ?></p>


      <h2 class="actors__header actors__header--lower"><?php echo $actor_cat_1_title; ?></h2>
        <ul class="actors__group actors__group-1" role="list">
          <?php missiledefense_actors( 'category_1_actors' ); ?>
        </ul><!-- .actors__group-1 -->


      <h2 class="actors__header"><?php echo $actor_cat_2_title; ?></h2>
        <ul class="actors__group actors__group-2" role="list">
          <?php missiledefense_actors( 'category_2_actors' ); ?>
        </ul><!-- .actors__group-2 -->
    </section>
    <?php }

  elseif ( is_post_type_archive('defsys') ) { ?>
    <section class="defsys">

      <h2 class="actors__header"><?php echo $defsys_cat_1_title; ?></h2>
      <p class="archive__desc"><?php echo $defsys_cat_1_desc; ?></p>
      
      <ul role="list" class="actors__group actors__group-1">
        <?php missiledefense_defsys( 'category_1_systems' ); ?>
      </ul>
      
      <h2 class="actors__header"><?php echo $defsys_cat_2_title; ?></h2>
      <p class="archive__desc"><?php echo $defsys_cat_2_desc; ?></p>
      
      <ul role="list" class="actors__group actors__group-2">
      <?php missiledefense_defsys( 'category_2_systems' ); ?>
      </ul>
      
      <h2 class="actors__header"><?php echo $defsys_cat_3_title; ?></h2>
      <p class="archive__desc"><?php echo $defsys_cat_3_desc; ?></p>

      <ul role="list" class="actors__group actors__group-3">
      <?php missiledefense_defsys( 'category_3_systems' ); ?>
      </ul>

    </section>
  <?php }
    
    elseif( $posts_page ) {
    ?>

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

<?php } ?>
  
  <aside class="archive__sidebar">
    <?php
    get_template_part( 'template-parts/sidebar' )

    ?>
  </aside>
</div> 

</main>

<?php get_footer(); ?>