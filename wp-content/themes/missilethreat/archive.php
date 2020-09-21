
<?php
/**
 *Template Name: Archive Page Custom
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
**/

get_header();
?>

<main id="site-content" role="main">

<header class="tier-1__header">

Heeeadeeeeeerrrrrrrrrrrrrr

</header>

<div class='tier-1'>

  <section class="tier-1__content">
    
  <?php
  
  $catPosts = new WP_Query( array(
		'post_type' => 'post',
    'post_status' => 'publish',
		// 'posts_per_page' => 5,
		'category_name' => 'analysis'
	) );

	if ( $catPosts->have_posts() ) {

		while ( $catPosts->have_posts() ) {
			$catPosts->the_post();

			get_template_part( 'template-parts/block-post' );
		}
	}

	?>
  </section>
  
  
  
  <aside class="tier-1__sidebar">
    <?php
    get_template_part( 'template-parts/filter' )
    ?>
  </aside>
</div>

</main>

<?php get_footer(); ?>