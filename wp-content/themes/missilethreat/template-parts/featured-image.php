<?php
/**
 * Displays the featured image
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */



if ( has_post_thumbnail() && ! post_password_required() ) {

  ?>

  <figure class="featured-media">

    <?php the_post_thumbnail('missilethreat-featured'); ?>

    <figcaption class="image-caption"><?php the_post_thumbnail_caption(); ?></figcaption>

  </figure><!-- .featured-media -->


  <?php
}

