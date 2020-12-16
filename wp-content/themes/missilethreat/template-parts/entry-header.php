<?php
/**
 * Displays the post header
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


$page_for_posts = get_option( 'page_for_posts' );
$post_type = get_post_type();
?>

<?php 
if( is_singular( array( 'defsys', 'missile' ) ) ) { 
	
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

		<hr class="divider divider--thicc page__header-divider"></hr>
		
		<div class="single__header-meta">
			Last Updated <?php missilethreat_last_updated(); ?>
		</div>

		<?php  if( 'defsys' === $post_type ) { ?>
			<div class="share-wrapper">
				<?php missiledefense_system_terms(); ?>
				<?php missiledefense_share(); ?>
			</div>
		<?php } ?>

		</div><!-- .entry-header-inner -->
	<?php } 

	elseif ( is_singular( array( 'systems', 'actors' ) ) ) {
		$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
		<header class="page__header entry-header"  style="background-image: url('<?php echo $feat_image; ?>')">
			<div class="page__header-inner--narrow">
				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
				<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
				<hr class="divider divider--md page__header-divider"></hr>
				<div class="page__header-meta">
					Last Updated <?php missilethreat_last_updated(); ?>
				</div>
			</div>

	<?php }
	
	elseif ( is_post_type_archive() ) { 
    $feat_image = 'style="background-image:url('.get_archive_thumbnail_src( 'missilethreat-fullscreen' ).');"';?>
		<header class="page__header entry-header" <?php echo $feat_image; ?>>
			<div class="page__header-inner">
				<h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
				<div class="divider divider--md page__header-divider"></div>
				<div class="page__header-desc"><?php the_archive_top_content(); ?> </div>
			</div><!-- .page__header-inner -->
  
	<?php } 
	
	elseif ( is_archive() ) { ?>
    <header class="page__header page__header--short entry-header">
			<div class="page__header-inner">
				<h1 class="page__header-title text--semibold"><?php the_archive_title(); ?></h1>
				<!-- <hr class="divider divider--short"></hr> -->
				<div class="page__header-desc page__header-desc--short"><?php the_archive_top_content(); ?> </div>
			</div><!-- .page__header-inner -->
    
	<?php } 
	
	elseif ( is_page() ) { 
		$feat_image = get_the_post_thumbnail_url( $post->ID ); ?>
		<header class="page__header entry-header"  style="background-image: url('<?php echo $feat_image; ?>')">
			<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
			<hr class="divider divider--md page__header-divider"></hr>

	<?php } 
	
	elseif ( is_single() ) { ?>
		<header <?php post_class('single__header'); ?>>

			<div class="single__header-wrapper">
				<div class="single__header-inner">
					<?php
					missilethreat_display_categories();
					the_title( '<h1 class="single__header-title">', '</h1>' );
					
					if ( has_excerpt() ) { ?>
						<div class="single__header-excerpt"><?php the_excerpt(); ?></div>
					<?php } ?>
					<hr class="divider divider--thicc page__header-divider"></hr>
					<div class="single__header-meta">
					<?php
					missilethreat_posted_on();
					missilethreat_authors(); ?>
					</div>
				</div><!-- .single__header-inner -->
				<?php
				if ( has_post_thumbnail() ) { ?>
					<div class="alignwide">
						<div class="single__header-image-wrapper">
							<?php get_template_part( 'template-parts/featured-image' ); ?>
							<?php missiledefense_share(); ?>
						</div><!-- single__header-image-wrapper -->
					</div><!-- alignwide -->
					<?php }
				?>
			</div><!-- .single__header-wrapper -->

	<?php } 
	
	elseif ( $page_for_posts ) { 
    $feat_image = 'style="background-image:url('.get_the_post_thumbnail_url( $page_for_posts ).');"';?>
		<header class="page__header entry-header" <?php echo $feat_image; ?>>
			<?php
			$post = get_page($page_for_posts);
			setup_postdata($post); ?>
			<div class="page__header-inner">
				<h1 class="page__header-title text--semibold"><?php the_title(); ?></h1>
				<hr class="divider divider--md page__header-divider"></hr>
				<div class="page__header-desc"><?php the_content(); ?> </div>
			</div><!-- .page__header-inner -->
			
  <?php }

wp_reset_postdata();

?>

</header>
