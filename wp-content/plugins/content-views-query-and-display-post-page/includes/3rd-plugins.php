<?php

/**
 * Resolved conflict with other plugins
 *
 * @package   PT_Content_Views
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2016 PT Guy
 */
# Autoptimize: Disable "Force JavaScript in <head>"
add_filter( 'autoptimize_filter_js_defer', 'cv_filter_js_defer', 10, 1 );
function cv_filter_js_defer( $defer ) {
	$defer = "defer ";
	return $defer;
}

# Page Builder by SiteOrigin: Excerpt is incorrect
add_filter( 'pt_cv_field_content_excerpt', 'cv_field_content_excerpt_siteorigin', 9, 3 );
function cv_field_content_excerpt_siteorigin( $args, $fargs, $this_post ) {
	// Prevent recursive call
	if ( empty( $fargs ) ) {
		return $args;
	}

	if ( function_exists( 'siteorigin_panels_filter_content' ) ) {
		$args = siteorigin_panels_filter_content( $args );
	}

	return $args;
}
