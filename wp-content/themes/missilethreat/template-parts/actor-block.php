<?php
/**
 * The template for displaying actor blocks
 *
 * Used for Missile of the World.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


$actor_icon = get_field('country_icon', $post->ID);
$archive_name = get_the_title();
$replacement_archive_name = get_post_meta( $post->ID, '_actors_archive_name', true );

if ( $replacement_archive_name ) {
  $archive_name = $replacement_archive_name;
}

?>

<li class="actors__container">
  <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" class="actors__link">
    <img src="<?php echo esc_url($actor_icon['url']); ?>" alt="<?php echo esc_attr($actor_icon['alt']); ?>" class="actors__icon">
    <?php echo $archive_name; ?>
  </a>
</li>
