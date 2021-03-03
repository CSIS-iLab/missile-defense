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
function missiledefense_cpt_actors() {
	$labels = array(
		'name'                  => _x( 'Countries', 'Post Type General Name', 'missiledefense' ),
		'singular_name'         => _x( 'Country', 'Post Type Singular Name', 'missiledefense' ),
		'menu_name'             => __( 'Countries', 'missiledefense' ),
		'name_admin_bar'        => __( 'Countries', 'missiledefense' ),
		'archives'              => __( 'Country Archives', 'missiledefense' ),
		'attributes'            => __( 'Country Attributes', 'missiledefense' ),
		'parent_item_colon'     => __( 'Parent Country:', 'missiledefense' ),
		'all_items'             => __( 'All Countries', 'missiledefense' ),
		'add_new_item'          => __( 'Add New Country', 'missiledefense' ),
		'add_new'               => __( 'Add Country', 'missiledefense' ),
		'new_item'              => __( 'New Country', 'missiledefense' ),
		'edit_item'             => __( 'Edit Country', 'missiledefense' ),
		'update_item'           => __( 'Update Country', 'missiledefense' ),
		'view_item'             => __( 'View Country', 'missiledefense' ),
		'view_items'            => __( 'View Countries', 'missiledefense' ),
		'search_items'          => __( 'Search Country', 'missiledefense' ),
		'not_found'             => __( 'Not found', 'missiledefense' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'missiledefense' ),
		'featured_image'        => __( 'Featured Image', 'missiledefense' ),
		'set_featured_image'    => __( 'Set featured image', 'missiledefense' ),
		'remove_featured_image' => __( 'Remove featured image', 'missiledefense' ),
		'use_featured_image'    => __( 'Use as featured image', 'missiledefense' ),
		'insert_into_item'      => __( 'Insert into country', 'missiledefense' ),
		'uploaded_to_this_item' => __( 'Uploaded to this country', 'missiledefense' ),
		'items_list'            => __( 'Countries list', 'missiledefense' ),
		'items_list_navigation' => __( 'Countries list navigation', 'missiledefense' ),
		'filter_items_list'     => __( 'Filter actors list', 'missiledefense' ),
	);
	$args = array(
		'label'                 => __( 'Country', 'missiledefense' ),
		'description'           => __( 'Countries and non-state actors for the missiles of the world section.', 'missiledefense' ),
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
		'rewrite'				=> array('slug' => 'country'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'actors', $args );

}
add_action( 'init', 'missiledefense_cpt_actors', 0 );
