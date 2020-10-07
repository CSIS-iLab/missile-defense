
<?php
/**
 * Table of Contents Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */

?>

<div class="tableOfContents">
  <h2 style="font-weight: 600;">In this publication</h2>
  <ul class="resources">
    <ul class="chapters">

  <?php 

    $chapters = get_lzb_meta('table-of-contents');
    $appendix = get_lzb_meta('appendix');
    $download_pdf = get_lzb_meta('download-pdf');
    $report_cover = get_lzb_meta('report-cover-image');
    $graphics_link = get_lzb_meta('link-to-graphics');
    $video_link = get_lzb_meta('video');

    $i = 1;
    foreach( $chapters as $chapter ) {
      $chapter_url = esc_url($chapter['link-to-post']);
      $chapter_id = url_to_postid($chapter_url);

      if( $chapter_id > 0 ){
        $chapter_title = get_the_title( $chapter_id );
      }

      if( get_page_link() === $chapter_url ) {
        echo "<p class='tableOfContents__current'>You are reading</p>"; ?>
        <li><a href="<?php echo esc_url($chapter_url); ?>" target="_blank" rel="nofollow" style="font-weight:600;"><span>Chapter <?php echo $i; ?> | </span><?php echo $chapter_title; ?></a></li>
        <?php 
      }

      else { 
        ?>
        <li><a href="<?php echo esc_url($chapter_url); ?>" target="_blank" rel="nofollow"><span>Chapter <?php echo $i; ?> | </span><?php echo $chapter_title; ?></a></li>
        <?php
      }
      
      $i++;
    }

    if( isset( $appendix ) && !empty( $appendix ) ) {
    ?>
      <li><a href="<?php echo esc_url($appendix); ?>" target="_blank" rel="nofollow">Appendix</a></li>
    <?php } ?>

    </ul>

    <?php
    if( isset( $download_pdf['url'] ) && !empty( $download_pdf['url'] ) ) { ?>
    <a href="<?php echo esc_url($download_pdf['url']); ?>" target="_blank" rel="nofollow"><button type="button" class="btn btn--short btn--dark">Download full report</button></a>
    <?php 
    } 

    if( isset( $graphics_link ) && !empty( $graphics_link ) ) { ?>
    <li><a href="<?php echo esc_url($graphics_link); ?>" target="_blank" rel="nofollow">See all illustrations & graphics</a></li>
    <?php
    } 

    if( isset( $video_link ) && !empty( $video_link ) ) { ?>
    <li><a href="<?php echo esc_url($video_link); ?>" target="_blank" rel="nofollow">Watch the video</a></li>
    <?php } ?>

  </ul>

<?php
  if ( isset( $report_cover['link'] ) && !empty( $report_cover['link'] ) ) { ?>
    <img src="<?php echo esc_url($report_cover['link']); ?>" alt="<?php echo $report_cover['alt']; ?>">
<?php } ?>

</div>