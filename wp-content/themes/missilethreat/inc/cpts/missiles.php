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
			'supports' => array( 'title', 'editor', 'excerpt', 'publicize', 'thumbnail', 'author' ),
			'hierarchical'      => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-layouts',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
    	)
  	);
}
add_action( 'init', 'missiledefense_cpt_missile' );

