<?php
/**
 * Breadcrumbs for missiles and defense systems
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


$post_type = get_post_type();


if( $post_type === 'defsys') {
?>
<ul class="breadcrumbs" role="list">
  <li><a href="/defsys">Defense Systems</a></li>
  <li>System Component: <span class="text--semibold"><?php the_title(); ?></span></li>
</ul><br style="clear:left;" />

<?php 

} elseif ($post_type === 'systems') {
  ?>
<ul class="breadcrumbs breadcrumbs--light" role="list">
  <li><a href="/defsys">Defense Systems</a></li>
  <li>System: <span class="text--semibold"><?php the_title(); ?></span></li>
</ul><br style="clear:left;" />

  <?php

} elseif ($post_type === 'missile') {
  ?>
<ul class="breadcrumbs" role="list">
  <li><a href="/missile">Missiles of the World</a></li>
  <?php
    $terms = get_the_terms($post->id, 'countries');
    echo "<li><a href='/country/" . $terms[0]->slug . "'>" . $terms[0]->name . "</a></li>";
  ?>
  <li class="text--semibold"><?php the_title(); ?></li>
</ul>
<div style="clear:left;"></div>

  <?php

} elseif ($post_type === 'actors') {
  ?>
<ul class="breadcrumbs breadcrumbs--light" role="list">
  <li><a href="/missile">Missiles of the World</a></li>
  <?php
    $terms = get_the_terms($post->id, 'countries');
    echo "<li class='text--semibold'>" . $terms[0]->name . "</li>";
  ?>
</ul>
<div style="clear:left;"></div>

  <?php
} 
?>