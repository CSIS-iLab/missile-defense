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
if( is_single() && 'defsys' === get_post_type() || is_single() && 'missile' === get_post_type() ) { 
	
	$missile_short_name = get_field('missile_name');

	?>
	<header <?php post_class('single__header'); ?>>

	<div class="single__header-wrapper">
		<?php
		get_template_part( 'template-parts/breadcrumbs' );

		if ( $missile_short_name ) { ?>
			<h1 class="single__header-title"><?php echo $missile_short_name; ?></h1>
			<?php the_title( '<div class="single__header-excerpt">', '</div>' );
		} 
		
		else {
			the_title( '<h1 class="single__header-title">', '</h1>' );
		} ?>

		<div class="page__header-divider page__header-divider--thicc"></div>
		
		<div class="single__header-meta">
			Last Updated <?php missilethreat_last_updated(); ?>
		</div>

		<?php missiledefense_system_terms(); ?>

		</div><!-- .entry-header-inner -->
	<?php } 

	elseif ( 'systems' === get_post_type() || 'actors' === get_post_type() ) {
		$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
		<header class="page__header entry-header"  style="background-image: url('<?php echo $feat_image; ?>')">
			<div class="overlay"></div>
			<div class="page__header-inner--narrow">
				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
				<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
				<div class="page__header-divider"></div>
				<div class="page__header-meta">
					Last Updated <?php missilethreat_last_updated(); ?>
				</div>
			</div>

	<?php }
	
	elseif ( is_post_type_archive() ) { 
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
		<header <?php post_class('single__header'); ?>>

			<div class="single__header-wrapper">
				<div class="single__header-inner">
					<?php
					missilethreat_display_categories();
					the_title( '<h1 class="single__header-title">', '</h1>' );
					
					if ( has_excerpt() && is_singular() ) { ?>
						<div class="single__header-excerpt"><?php the_excerpt(); ?></div>
					<?php } ?>
					<div class="page__header-divider page__header-divider--thicc"></div>
					<div class="single__header-meta">
					<?php
					missilethreat_posted_on();
					missilethreat_authors(); ?>
					</div>
				</div><!-- .single__header-inner -->
				<?php
				if ( has_post_thumbnail() ) { ?>
				<div class="single__header-image-wrapper alignwide">
					<?php dynamic_sidebar( 'social-share' );
					the_post_thumbnail(); ?>
				</div><!-- single__header-image-wrapper -->
				<div class="image-caption"><?php the_post_thumbnail_caption(); ?></div>
				<?php }
				?>
			</div><!-- .single__header-wrapper -->

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
