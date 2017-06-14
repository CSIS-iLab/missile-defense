<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Transparency
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function transparency_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'transparency_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'transparency_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function transparency_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Displays Share Icons on Archive Pages
 * @return [type] [description]
 */
function transparency_shareOnArchives() {
	if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
		echo '<div class="addtoany_share_save_container addtoany_content_bottom">';
		echo '<div class="addtoany_header">Share this:</div>'; 
	    ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) );
	    echo '</div>';
	}
}
