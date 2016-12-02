<?php
/**
 * Template part for displaying defense systems.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
		// Echo title
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</h2>' );
		endif;
		?>
		<ul class="breadcrumbs">
			<li><a href="/">Home</a></li>
			<li><a href="/defsys">Defense Systems</a></li>
			<?php
				$terms = get_the_terms($post->id, 'system');
				echo "<li><a href='/system/".$terms[0]->slug."'>".$terms[0]->name."</a></li>";
			?>
			<li><?php the_title(); ?></li>
		</ul><br />
		<?php echo get_the_term_list( $post->ID, 'system', 'Systems: ', ', ', '' ); ?>
		<div style="clear:left;"></div>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
	<div class="post-meta">
		<p>Last Updated: <span><?php the_time('m.d.Y'); ?></span></p>
	</div>
</article><!-- #post-## -->
