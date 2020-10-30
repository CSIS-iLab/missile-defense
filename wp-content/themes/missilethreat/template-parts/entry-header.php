<?php
/**
 * Displays the post header
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

$entry_header_classes = '';
?>

<header class="single__header<?php echo esc_attr( $entry_header_classes ); ?>">

	<div class="single__header-wrapper">

		<?php

			missilethreat_posted_on();

			the_title( '<h1 class="single__title">', '</h1>' );

			if ( has_excerpt() && is_singular() ) {
				the_excerpt();
			}

			missilethreat_authors();

			get_template_part( 'template-parts/featured-image' );
		?>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
