
<?php
/**
 * Table of Contents Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */



$toc_title = get_lzb_meta('toc_title');
$chapters = get_lzb_meta('table-of-contents');

?>

<div class="tableOfContents">
  <div class="tableOfContents__details">
  <h2 class="tableOfContents__heading"><?php echo $toc_title ?></h2>
  <ul class="tableOfContents__resources" role="list">


  <?php 

    if ( !$chapters ) { ?>
    <div class="tableOfContents__excerpt"><?php the_excerpt(); ?></div>
      <?php
    } 
    
    else { ?>
      <ul class="tableOfContents__chapters" role="list">
        <?php
      foreach( $chapters as $chapter ) {
        $chapter_url = esc_url($chapter['link-to-post']);
        $chapter_title = $chapter['chapter-title'];
        $chapter_id = url_to_postid($chapter_url);

        if( isset( $chapter_title ) && !empty( $chapter_title ) ) {
          $chapter_title = $chapter_title;
        }

        else {
          $chapter_title = get_the_title( $chapter_id );
        }

          ?>
          <li><a href="<?php echo esc_url($chapter_url); ?>" target="_self" rel="nofollow" class="chapter"><?php echo $chapter_title; echo missilethreat_get_svg( 'chevron-right' ); ?></a></li>
          <?php
      } ?>
        
      </ul>
      
      <?php
    } ?>


  </ul>
  </div>
</div>