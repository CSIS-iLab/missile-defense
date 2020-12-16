
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


<?php get_template_part( 'template-parts/entry-header', get_post_type() ); ?>


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

      $total_posts = $wp_the_query->found_posts;
      $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $pages = $wp_the_query->max_num_pages;
      echo '<h2 class="archive__results">' . $total_posts . ' items, Page ' . $page . ' of ' . $pages . '</h2>';

      if ( have_posts() ) {

        $i = 0;

        while ( have_posts() ) {
          the_post();

          get_template_part( 'template-parts/block-post' );


        }
      } 

      get_template_part( 'template-parts/pagination' );
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