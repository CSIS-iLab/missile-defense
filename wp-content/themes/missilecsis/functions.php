<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'MISSILE_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/*  Set the maximum allowed width for any content in the theme
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 900;

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Featured post/page images
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );

add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size

/*-----------------------------------------------------------------------------------*/
/* Register custom 'defense system' type/taxonomies
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'defsys',
    array(
      'labels' => array(
        'name' => __( 'Defense Systems' ),
        'singular_name' => __( 'Defense System' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action( 'init', 'create_defsys_taxonomies', 0 );

function create_defsys_taxonomies() {
	$labels = array(
		'name'              => _x( 'Systems', 'taxonomy general name' ),
		'singular_name'     => _x( 'System', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Systems' ),
		'all_items'         => __( 'All Systems' ),
		'parent_item'       => __( 'Parent System' ),
		'parent_item_colon' => __( 'Parent System:' ),
		'edit_item'         => __( 'Edit System' ),
		'update_item'       => __( 'Update System' ),
		'add_new_item'      => __( 'Add New System' ),
		'new_item_name'     => __( 'New System Name' ),
		'menu_name'         => __( 'System' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
'rewrite'           => array( 'slug' => 'system' ),
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'system', array( 'defsys' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Elements', 'taxonomy general name' ),
		'singular_name'              => _x( 'Element', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Elements' ),
		'popular_items'              => __( 'Popular Elements' ),
		'all_items'                  => __( 'All Elements' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Element' ),
		'update_item'                => __( 'Update Element' ),
		'add_new_item'               => __( 'Add New Element' ),
		'new_item_name'              => __( 'New Element Name' ),
		'separate_items_with_commas' => __( 'Separate elements with commas' ),
		'add_or_remove_items'        => __( 'Add or remove elements' ),
		'choose_from_most_used'      => __( 'Choose from the most used elements' ),
		'not_found'                  => __( 'No elements found.' ),
		'menu_name'                  => __( 'Elements' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'element' ),
	);

	register_taxonomy( 'element', 'defsys', $args );
}
/*-----------------------------------------------------------------------------------*/
/* Register custom 'missile/country' type/taxonomy
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'create_post_type2' );
function create_post_type2() {
  register_post_type( 'missile',
    array(
      'labels' => array(
        'name' => __( 'World Missiles' ),
        'singular_name' => __( 'World Missile' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action( 'init', 'create_mdb_taxonomy', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_mdb_taxonomy() {
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
		'menu_name'         => __( 'Country' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'missiledb' ),
	);

	register_taxonomy( 'missiledb', array( 'missile' ), $args );
}

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus(
	array(
		'primary'	=>	__( 'Primary Menu', 'naked' ), // Register the Primary menu
		// Copy and paste the line above right here if you want to make another menu,
		// just change the 'primary' to another name
	)
);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function naked_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar,
		// just change the values of id and name to another word/name
	));
}
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'naked_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function naked_scripts()  {

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');

	// add fitvid
	wp_enqueue_script( 'naked-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), MISSILE_VERSION, true );

	// add theme scripts
	wp_enqueue_script( 'naked', get_template_directory_uri() . '/js/theme.min.js', array(), MISSILE_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'naked_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header

