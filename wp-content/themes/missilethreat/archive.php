
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

$cat_1_title = get_field( 'category_1_title', $object->name );
$cat_2_title = get_field( 'category_2_title', $object->name );
$cat_3_title = get_field( 'category_3_title', $object->name );

$cat_1_desc = get_field( 'category_1_description', $object->name );
$cat_2_desc = get_field( 'category_2_description', $object->name );
$cat_3_desc = get_field( 'category_3_description', $object->name );


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

      <?php
      $args = array(
        'post_type' => 'actors',
        'numberposts' => -1,
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_key' => '_actors_archive_name'
      );
      $actors = get_posts( $args ); ?>

      <h2 class="actors__header actors__header--lower">Countries</h2>
        <ul class="actors__group actors__group-countries" role="list">

          <?php
          foreach ( $actors as $post) {
            setup_postdata( $post );
            $actor_icon = get_field('country_icon', $post->ID);
            $archive_name = get_the_title();
            $replacement_archive_name = get_post_meta( $post->ID, '_actors_archive_name', true );

            if ( $replacement_archive_name ) {
              $archive_name = $replacement_archive_name;
            }

            if ( $post->post_name === 'hezbollahs-rocket-arsenal' ) {
              continue;
            }

            ?>

            <li class="actors__container">
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="actors__link">
                <img src="<?php echo esc_url($actor_icon['url']); ?>" alt="<?php echo esc_attr($actor_icon['alt']); ?>" class="actors__icon">
                <?php echo $archive_name; ?>
              </a>
          </li>
          <?php }  ?>
          </ul><!-- .actors__group-countries -->


      <h2 class="actors__header">Sub-state Actors</h2>
        <ul class="actors__group actors__group-sub-state" role="list">

          <?php
          foreach ( $actors as $post) {
            setup_postdata( $post );
            $actor_icon = get_field('country_icon', $post->ID);
            $archive_name = get_the_title();
            $replacement_archive_name = get_post_meta( $post->ID, '_actors_archive_name', true );

            if ( $replacement_archive_name ) {
              $archive_name = $replacement_archive_name;
            }

            if ( $post->post_name !== 'hezbollahs-rocket-arsenal' ) {
              continue;
            }

            ?>

            <li class="actors__container">
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="actors__link">
                <img src="<?php echo esc_url($actor_icon['url']); ?>" alt="<?php echo esc_attr($actor_icon['alt']); ?>" class="actors__icon">
                <?php echo $archive_name; ?>
              </a>
          </li>
          <?php }  ?>

          </ul><!-- .actors__group-sub-state -->
    </section>
    <?php }

  elseif ( is_post_type_archive('defsys') ) { ?>
    <section class="defsys">

      <h2 class="actors__header"><?php echo $cat_1_title; ?></h2>
      <p class="archive__desc"><?php echo $cat_1_desc; ?></p>
      
      <ul role="list" class="actors__group actors__group-1">
        <?php missiledefense_defsys_cat1(); ?>
      </ul>
      
      <h2 class="actors__header"><?php echo $cat_2_title; ?></h2>
      <p class="archive__desc"><?php echo $cat_2_desc; ?></p>
      
      <ul role="list" class="actors__group actors__group-2">
        <?php missiledefense_defsys_cat2() ?>
      </ul>
      
      <h2 class="actors__header"><?php echo $cat_3_title; ?></h2>
      <p class="archive__desc"><?php echo $cat_3_desc; ?></p>

      <ul role="list" class="actors__group actors__group-3">
        <?php missiledefense_defsys_cat3() ?>
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