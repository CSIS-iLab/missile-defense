
<?php
/**
 * Key Takeaways Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */

?>

<div class="key-takeaways">

  <h2 class="key-takeaways__title">Key Takeaways</h2>
  
  <ul class="key-takeaways__list">
  <?php 
    $bullet_points = get_lzb_meta('bullet-points');
    $pdf = get_lzb_meta('download-pdf');
    $pdf_url = $pdf['url'];

    foreach ($bullet_points as $bullet) {
      $item = $bullet['point']; ?>
      <li class="key-takeaways__list-item"><?php echo $item; ?></li>
    <?php } ?>    
  </ul>

  <?php if( isset( $pdf ) && !empty( $pdf ) ) { ?>
    <button class="key-takeaways__download-btn btn btn--short btn--dark" type="submit" onclick="window.open('<?php echo $pdf_url; ?>')">Download PDF</button>
  <?php } ?>
</div>