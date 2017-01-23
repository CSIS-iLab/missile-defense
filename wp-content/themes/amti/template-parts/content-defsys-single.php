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
				// Get the correct category for the breadcrumbs
				$primaryID = null;

				// If Yoast SEO is installed and we have a primary category selected, display that one
				if ( defined('WPSEO_VERSION') ) {
					$primaryID = yoast_get_primary_term_id('system', $post);

					if($primaryID) {
						$term = get_term_by('id', $primaryID, 'system');
						$slug = $term->slug;
						$name = $term->name;
					}
				}

				// Otherwise, get the first category
				if(!$primaryID) {
					$terms = get_the_terms($post->id, 'system');
					$slug = $terms[0]->slug;
					$name = $terms[0]->name;
				}

				if($slug && $name) {
					echo "<li><a href='/system/".$slug."'>".$name."</a></li>";
				}
			?>
			<li><?php the_title(); ?></li>
		</ul><br style="clear:left;" />
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
