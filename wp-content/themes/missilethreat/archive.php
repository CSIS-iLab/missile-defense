
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

<header class="archive__header">

Heeeadeeeeeerrrrrrrrrrrrrr

</header>

<div class='archive'>

  <section class="archive__content">
    
  <?php
  
  // $catPosts = new WP_Query( array(
	// 	'post_type' => 'post',
  //   'post_status' => 'publish',
	// 	// 'posts_per_page' => 5,
	// 	'category_name' => 'analysis'
	// ) );

	// if ( $catPosts->have_posts() ) {

	// 	while ( $catPosts->have_posts() ) {
	// 		$catPosts->the_post();

	// 		get_template_part( 'template-parts/block-post' );
	// 	}
	// }

  if ( have_posts() ) {

		$i = 0;

		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				// echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/block-post' );

		}
	} 
	?>
  </section>
  
  
  
  <aside class="archive__sidebar">
    <?php
    // get_template_part( 'template-parts/filter' )
    dynamic_sidebar( 'sidebar' )
    ?>
  </aside>
</div>

</main>

<?php get_footer(); ?>