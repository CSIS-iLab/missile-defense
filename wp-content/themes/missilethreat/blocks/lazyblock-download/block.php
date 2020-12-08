<?php
/**
 * Download PDF Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */

$button_text = get_lzb_meta('button-text');
$pdf = get_lzb_meta('file');
$pdf_url = $pdf['url'];
$cover = get_lzb_meta('report-cover');



if ( isset( $cover['link'] ) && !empty( $cover['link'] ) ) { ?>
  <img src="<?php echo esc_url($cover['link']); ?>" alt="<?php echo $cover['alt']; ?>" class="report_cover">
<?php }

if( isset( $pdf_url ) && !empty( $pdf_url ) ) { ?>
    <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="nofollow"><button type="button" class="btn btn--short btn--dark"><?php echo $button_text ?></button></a>
    <?php 
} 
?>