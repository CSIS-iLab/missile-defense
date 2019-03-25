<?php
/**
 * Custom Post Types: Missiles
 *
 * @package Missile_Defense
 */

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
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country_tax' ),
		'show_admin_column' => true,
		'show-in-rest'      => true,
		'show_ui'           => true,
		'with_front'        => false,
	);
	register_taxonomy( 'countries', array( 'missile', 'actors' ), $args );
}
add_action( 'init', 'missiledefense_taxonomy_countries', 0 );
