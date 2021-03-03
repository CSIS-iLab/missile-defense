
<?php
/**
 * Related Links Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */

$related = get_lzb_meta('related-links');
$block_title = get_lzb_meta('block-heading');
?>

<div class="related-links">
<?php if( isset( $block_title ) && !empty( $block_title ) ) { ?>
  <h2 class="related-links__title text--semibold"><?php echo $block_title ?></h2>
<?php } ?>
  <ul class="related-links__list" role="list">
  <?php 

    foreach ($related as $link) {
      $link_title = $link['title'];
      $link_url = $link['link-url'];
      $pub = $link['publication']; ?>
      <li class="related-links__item"><a class="related-links__link"onclick="window.open('<?php echo $link_url; ?>')"><?php echo $link_title; ?><?php echo missilethreat_get_svg( 'external-link' ); ?></a>, <?php echo $pub; ?></li>
    <?php } ?>    
  </ul>
</div>