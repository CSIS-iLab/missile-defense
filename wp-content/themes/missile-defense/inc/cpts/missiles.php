<?php
/**
 * Custom Post Types: Missiles
 *
 * @package Missile_Defense
 */

/**
 * Create Missile custom post type.
 * @return array Custom post type.
 */
function missiledefense_cpt_missile() {
	register_post_type( 'missile',
	    array(
			'labels' => array(
				'name' => __( 'World Missiles' ),
				'singular_name' => __( 'World Missile' )
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'publicize', 'thumbnail' ),
			'public' => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-layout',
    	)
  	);
}
add_action( 'init', 'missiledefense_cpt_missile' );

/**
 * Create Countries taxonomy for Missile post type.
 * @return array Custom taxonomy.
 */
function missiledefense_taxonomy_countries() {
	$labels = array(
		'name'              => _x( 'Countries', 'taxonomy general name' ),
		'singular_name'     => _x( 'Country', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Countries' ),
		'all_items'         => __( 'All Countries' ),
		'parent_item'       => __( 'Parent Country' ),
		'parent_item_colon' => __( 'Parent Country:' ),
		'edit_item'         => __( 'Edit Country' ),
		'update_item'       => __( 'Update Country' ),
		'add_new_item'      => __( 'Add New Country' ),
		'new_item_name'     => __( 'New Country Name' ),
		'menu_name'         => __( 'Countries' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country' ),
		'with_front'        => false,
	);
	register_taxonomy( 'countries', array( 'missile' ), $args );
}
add_action( 'init', 'missiledefense_taxonomy_countries', 0 );
