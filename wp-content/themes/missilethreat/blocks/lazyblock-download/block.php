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
?>

<div class="download-pdf">
<?php
if ( isset( $cover['link'] ) && !empty( $cover['link'] ) ) { ?>
  <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="nofollow" class="download-pdf__cover"><img src="<?php echo esc_url($cover['link']); ?>" alt="<?php echo $cover['alt']; ?>"></a>
<?php }

if( isset( $pdf_url ) && !empty( $pdf_url ) ) { ?>
    <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="nofollow" class="btn btn--short btn--dark download-pdf__link"><?php echo $button_text ?></a>
    <?php 
} 
?>
</div>
