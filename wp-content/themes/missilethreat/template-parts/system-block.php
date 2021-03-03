<?php
/**
 * The template for displaying system blocks
 *
 * Used for Defense Systems.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


$archive_name = get_the_title($post->ID);
$system_icon = get_field('defense_system_icon', $post->ID); ?>

<li class="actors__container">
  <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" class="actors__link">
    <img src="<?php echo esc_url($system_icon['url']); ?>" alt="<?php echo esc_attr($system_icon['alt']); ?>" class="actors__icon">
    <?php echo $archive_name; ?>
  </a>
</li>
