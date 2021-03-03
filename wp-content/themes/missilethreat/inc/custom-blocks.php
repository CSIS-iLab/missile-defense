<?php
/**
 * Missile Threat Custom Blocks
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

function missilethreat_keep_plugins_blocks( $allowed_block_types, $post ) {

	if ( $post->post_type !== 'post' && $post->post_type !== 'issues' ) {
		return $allowed_block_types;
	}

	// get widget blocks and registered by plugins blocks
	$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

	// in case we do not need widgets
	unset( $registered_blocks[ 'core/latest-comments' ] );
	unset( $registered_blocks[ 'core/archives' ] );
	unset( $registered_blocks[ 'core/categories' ] );
	unset( $registered_blocks[ 'core/latest-posts' ] );
	unset( $registered_blocks[ 'core/calendar' ] );
	unset( $registered_blocks[ 'core/rss' ] );
	unset( $registered_blocks[ 'core/search' ] );
	unset( $registered_blocks[ 'core/tag-cloud' ] );


	// now $registered_blocks contains only blocks registered by plugins, but we need keys only
	$registered_blocks = array_keys( $registered_blocks );

	// merge the whitelist with plugins blocks
	return array_merge( array(
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/gallery',
		'core/table',
		'core/freeform',
		'core/html',
		'core/shortcode'
	), $registered_blocks );

}

add_filter( 'allowed_block_types', 'missilethreat_keep_plugins_blocks', 10, 2 );


//  Enqueue custom styles for Gutenberg blocks
add_action('init', function() {
	wp_register_style('missilethreat_table_styles', get_template_directory_uri() . '/assets/scss/components/tables.scss', false);
	register_block_style('core/table', [
		'name' => 'highlighted-header',
		'label' => __('Highlighted Header Row', 'txtdomain'),
		'style_handle' => 'missilethreat_table_styles'
	]);
});