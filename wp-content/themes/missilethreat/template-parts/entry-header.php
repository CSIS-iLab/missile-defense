<?php
/**
 * Displays the post header
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


$page_for_posts = get_option( 'page_for_posts' );
?>

<?php 
  if ( is_post_type_archive() ) { 
    $feat_image = 'style="background-image:url('.get_archive_thumbnail_src( 'missilethreat-fullscreen' ).');"';?>
		<header class="page__header entry-header" <?php echo $feat_image; ?>>
			<div class="overlay"></div>
			<h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
			<div class="page__header-divider"></div>
			<div class="page__header-desc"><?php the_archive_top_content(); ?> </div>
  
	<?php } 
	
	elseif ( is_archive() ) { ?>
    <header class="page__header page__header--short entry-header" style='background:linear-gradient(180deg, rgba(7, 52, 74, 0) 0%, rgba(6, 43, 61, 0.9) 75.52%), linear-gradient(90deg, #2A5565 0%, #5F7981 100%);'>
			<div class="overlay"></div>
			<h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
			<div class="page__header-divider page__header-divider--short"></div>
			<div class="page__header-desc page__header-desc--short"><?php the_archive_top_content(); ?> </div>
    
	<?php } 
	
	elseif ( is_page() ) { 
		$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
		<header class="page__header entry-header"  style="background-image: url('<?php echo $feat_image; ?>')">
			<div class="overlay"></div>
			<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
			<div class="page__header-divider"></div>

	<?php } 
	
	elseif ( is_single() ) { ?>
		<header class="single__header">

			<div class="single__header-wrapper">
				<?php
				missilethreat_display_categories();
				the_title( '<h1 class="single__title">', '</h1>' );
				
				if ( has_excerpt() && is_singular() ) {
					the_excerpt();
				} ?>
				<div class="single__meta">
				<?php
				missilethreat_posted_on();
				missilethreat_authors(); ?>
				</div>
				<?php
				if ( has_post_thumbnail() ) {
					dynamic_sidebar( 'social-share' );
					the_post_thumbnail();
				}
				?>
			</div><!-- .entry-header-inner -->

	<?php } 
	
	elseif ( $page_for_posts ) { 
    $feat_image = 'style="background-image:url('.get_the_post_thumbnail_url( $page_for_posts ).');"';?>
		<header class="page__header entry-header" <?php echo $feat_image; ?>>
			<div class="overlay"></div>
			<?php
			$post = get_page($page_for_posts);
			setup_postdata($post); ?>
			<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
			<div class="page__header-divider"></div>
			<div class="page__header-desc"><?php the_content(); ?> </div>

  <?php }

wp_reset_postdata();

?>

</header>
