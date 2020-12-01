
<?php
/**
 * Key Takeaways Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */

$bullet_points = get_lzb_meta('bullet-points');
$pdf = get_lzb_meta('download-pdf');
$pdf_url = $pdf['url'];
$title = get_lzb_meta('list-title');
?>

<div class="key-takeaways">
<?php if( isset( $title ) && !empty( $title ) ) { ?>
  <h2 class="key-takeaways__title"><?php echo $title ?></h2>
<?php } ?>
  <ul class="key-takeaways__list" role="list">
  <?php 

    foreach ($bullet_points as $bullet) {
      $item = $bullet['point']; ?>
      <li class="key-takeaways__list-item"><?php echo $item; ?></li>
    <?php } ?>    
  </ul>

  <?php if( isset( $pdf ) && !empty( $pdf ) ) { ?>
    <a class="key-takeaways__download-btn btn btn--short btn--dark" type="submit" onclick="window.open('<?php echo $pdf_url; ?>')">Download PDF</a>
  <?php } ?>
</div>