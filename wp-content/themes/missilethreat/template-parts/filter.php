<?php
/**
 * Checkboxes to filter posts by category
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

 if( $terms = get_terms( array(
   'taxonomy' => 'category',
   'orderby' => 'name'
 ))) :

 foreach ( $terms as $term ) :
  echo '<input type="checkbox" id=$term name=$term value=$term class="filter__checkbox>';
 endforeach;

 endif;