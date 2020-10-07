
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
  <h2 style="font-weight: 600;">Chapters</h2>
  <ul class="resources"></ul>

  <?php 

  $chapters = get_lzb_meta('table-of-contents');
  $i = 1;
  foreach( $chapters as $chapter ) {
    $chapter_url = esc_url($chapter['link-to-post']);
    $chapter_id = url_to_postid($chapter_url);
    if( $chapter_id > 0 ){
      $chapter_title = get_the_title( $chapter_id );
    }

    if( get_page_link() === $chapter_url ) {
      echo "<p class='tableOfContents__current'>You are reading</p>";
      ?>
      <li><a href="<?php echo esc_url($chapter_url); ?>" target="_blank" rel="nofollow" style="font-weight:600;"><span>Chapter <?php echo $i; ?> | </span><?php echo $chapter_title; ?></a></li>
      <?php
    } else {
  ?>
    <li><a href="<?php echo esc_url($chapter_url); ?>" target="_blank" rel="nofollow"><span>Chapter <?php echo $i; ?> | </span><?php echo $chapter_title; ?></a></li>

<?php
    }
  $i++;
  }
  ?>
</div>