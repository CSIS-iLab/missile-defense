
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
      <div class="archive__desc">Ballistic missiles, cruise missiles, rockets, artillery, and mortars (RAM), and even maneuvering hypersonic boost glide delivery systems now form the complicated 21st century strike complex with which U.S., allied, and partner nations must contend. Organized by country, the following represents a growing collection of information on global missile systems, with illustrations and up-to-date information on their capabilities and history.</div>

      <?php
      $args = array(
        'post_type' => 'actors',
        'numberposts' => -1,
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_key' => '_actors_archive_name'
      );
      $actors = get_posts( $args ); ?>

      <h2 class="actors__header">Countries</h2>
        <div class="actors__group actors__group-countries">

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

            <div class="actors__container">
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="actors__link">
                <img src="<?php echo esc_url($actor_icon['url']); ?>" alt="<?php echo esc_attr($actor_icon['alt']); ?>" class="actors__icon">
                <?php echo $archive_name; ?>
              </a>
            </div>
          <?php }  ?>
      </div><!-- .actors__countries -->


      <h2 class="actors__header">Sub-state Actors</h2>
        <div class="actors__group actors__group-sub-state">

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

            <div class="actors__container">
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="actors__link">
                <img src="<?php echo esc_url($actor_icon['url']); ?>" alt="<?php echo esc_attr($actor_icon['alt']); ?>" class="actors__icon">
                <?php echo $archive_name; ?>
              </a>
            </div>
          <?php }  ?>

      </div><!-- .actors__sub-state -->
    </section>
    <?php }

  elseif ( is_post_type_archive('defsys') ) { ?>
    <section class="defsys">

      <h2 class="actors__header">U.S. Defense Systems</h2>
      <div class="archive__desc">The United States is a world leader in air and missile defense, with a variety of capabilities on land, sea, air and space.</div>

      <?php missiledefense_defsys_us(); ?>

      <h2 class="actors__header">Defense System Elements</h2>
      <div class="archive__desc">A wide variety of these systems go into making missile defense effective.</div>

      <?php missiledefense_defsys_elements() ?>

      <h2 class="actors__header">Non U.S. Systems</h2>
      <div class="archive__desc">Learn about air and missile defense systems from around the world.</div>

      <?php missiledefense_defsys_nonUS() ?>

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