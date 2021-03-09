<?php
/**
 * Template part for displaying islands in the island tracker.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Missile_Defense
 * 
 * 
 */
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="single__content">

<?php

the_content();

$terms = wp_get_post_terms( $post->ID, 'countries', array('fields' => 'ids')  );
$missiles = null;
if ( !empty( $terms ) ) {
  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'missile',
    'post_status' => 'publish,private',
      'tax_query' => array(
            array(
                'taxonomy' => 'countries',
                'field' => 'term_id',
                'terms' => $terms[0],
            )
        )
  );
  $missiles = get_posts( $args );
}

if ( $missiles ) : ?>


	  <div class="missile-table banded alignfull">
      <h2><?php esc_html_e( 'Missiles', 'missiledefense' ); ?></h2>
      <table id="missileTable">
        <thead>
          <th><?php esc_html_e( 'Missile Name', 'missiledefense' ); ?></th>
          <th class="hidden--m"><?php esc_html_e( 'Class', 'missiledefense' ); ?></th>
          <th class="hidden--m"><?php esc_html_e( 'Range', 'missiledefense' ); ?></th>
          <th class="hidden--m"><?php esc_html_e( 'News', 'missiledefense' ); ?></th>
        </thead>
        <tbody>
        <?php
        /* Start the Loop */
        foreach( $missiles as $post ) {
          setup_postdata( $post );
          $custom = get_post_custom();

          $missileURL = get_field('missile_url');

          if(isset($missileURL)) {
            $url = esc_url(get_permalink($missileURL[0]));
          }
          else {
            $url = esc_url( get_permalink());
          }
          
          // Get the first part of the range
          $range = null;
          if(isset($custom['missile_range'])) {
            // Check if we have a hyphenated range
              if (strpos($custom['missile_range'][0], '-') !== false) {
                $range = strtok($custom['missile_range'][0], '-');
            }
            else {
              $range = strtok($custom['missile_range'][0], ' ');
            }
            $range = str_replace(",", "", $range);
          }
          
          ?>
          
          <tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <td class="text--semibold">
              <?php
                if(isset($custom['missile_name']) && $custom['missile_name'][0] != '') {
                  if(get_post_status() != 'publish' && !isset($missileURL)) {
                    echo $custom['missile_name'][0];
                  }
                  else {
                    echo "<a href='".$url."' rel='bookmark'>".$custom['missile_name'][0]."</a>";
                  }
                }
                else {
                  if(get_post_status() != 'publish' && !isset($missileURL)) {
                    the_title();
                  }
                  else {
                    the_title( '<a href="'.$url.'" rel="bookmark">', '</a>');
                  }
                }
              ?>
            </td>
            <td class="hidden--m">
              <?php
                if(isset($custom['missile_class'])) {
                  echo $custom['missile_class'][0];
                }
              ?>
            </td>
            <td class="hidden--m" data-order="<?php echo $range; ?>">
              <?php
                if(isset($custom['missile_range'])) {
                  echo $custom['missile_range'][0];
                }
              ?>
            </td>
            <td class="hidden--m">
              <?php
                if(isset($custom['missile_status'])) {
                  echo $custom['missile_status'][0];
                }
              ?>
            </td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
    </div><!-- .missile-table banded -->
    
    <?php

	endif;
  wp_reset_postdata();
  
  missiledefense_actors_secondary_content($post->ID);
?>

<?php missiledefense_display_footnotes(); ?>
  </div><!-- .single__content -->

	<footer class="single__footer">
		<?php missiledefense_share(); ?>
		<hr class="divider divider--gray"/>
    <?php echo missiledefense_citation(); ?>

		<?php echo missiledefense_related_posts(); ?>

  </footer>

</article><!-- .post -->
  