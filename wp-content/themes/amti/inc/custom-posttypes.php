<?php
/*
	Custom Post Types & associated Taxonomies for Missile Threat
	CPTS: Defense Systems, Missiles of the World
 */

/*-----------------------------------------------------------------------------------*/
/* Register Missiles of the World
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'create_missile_type' );
function create_missile_type() {
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
add_action( 'init', 'create_countries_taxonomy', 0 );

function create_countries_taxonomy() {
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
		'rewrite'           => array( 'slug' => 'missile' ),
		'with_front'        => false,
	);
	register_taxonomy( 'countries', array( 'missile' ), $args );
}

/*-----------------------------------------------------------------------------------*/
/* Remove 'features' and 'island-tracker' from post slug
/*-----------------------------------------------------------------------------------*/

function remove_feature_slug( $post_link, $post, $leavename ) {
	$post_types = array("missile");

    if ( !in_array($post->post_type,$post_types) || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'remove_feature_slug', 10, 3 );


function parse_request_custom( $query ) {

    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;

    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'page', 'missile' ) );
    }
}
add_action( 'pre_get_posts', 'parse_request_custom' );