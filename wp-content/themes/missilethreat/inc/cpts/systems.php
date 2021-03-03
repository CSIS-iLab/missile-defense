<?php
/**
 * Custom Post Types: Actors
 *
 * @package Missile_Defense
 */

/**
 * Create Actors custom post type.
 * @return array Custom post type.
 */
function missiledefense_cpt_systems() {
	$labels = array(
		'name'                  => _x( 'Systems', 'Post Type General Name', 'missiledefense' ),
		'singular_name'         => _x( 'System', 'Post Type Singular Name', 'missiledefense' ),
		'menu_name'             => __( 'Systems', 'missiledefense' ),
		'name_admin_bar'        => __( 'Systems', 'missiledefense' ),
		'archives'              => __( 'System Archives', 'missiledefense' ),
		'attributes'            => __( 'System Attributes', 'missiledefense' ),
		'parent_item_colon'     => __( 'Parent System:', 'missiledefense' ),
		'all_items'             => __( 'All Systems', 'missiledefense' ),
		'add_new_item'          => __( 'Add New System', 'missiledefense' ),
		'add_new'               => __( 'Add System', 'missiledefense' ),
		'new_item'              => __( 'New System', 'missiledefense' ),
		'edit_item'             => __( 'Edit System', 'missiledefense' ),
		'update_item'           => __( 'Update System', 'missiledefense' ),
		'view_item'             => __( 'View System', 'missiledefense' ),
		'view_items'            => __( 'View Systems', 'missiledefense' ),
		'search_items'          => __( 'Search System', 'missiledefense' ),
		'not_found'             => __( 'Not found', 'missiledefense' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'missiledefense' ),
		'featured_image'        => __( 'Featured Image', 'missiledefense' ),
		'set_featured_image'    => __( 'Set featured image', 'missiledefense' ),
		'remove_featured_image' => __( 'Remove featured image', 'missiledefense' ),
		'use_featured_image'    => __( 'Use as featured image', 'missiledefense' ),
		'insert_into_item'      => __( 'Insert into system', 'missiledefense' ),
		'uploaded_to_this_item' => __( 'Uploaded to this system', 'missiledefense' ),
		'items_list'            => __( 'Systems list', 'missiledefense' ),
		'items_list_navigation' => __( 'Systems list navigation', 'missiledefense' ),
		'filter_items_list'     => __( 'Filter systems list', 'missiledefense' ),
	);
	$args = array(
		'label'                 => __( 'System', 'missiledefense' ),
		'description'           => __( 'Defense Systems', 'missiledefense' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'author' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-admin-site',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'rewrite'				=> array('slug' => 'system'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'systems', $args );

}
add_action( 'init', 'missiledefense_cpt_systems', 0 );
