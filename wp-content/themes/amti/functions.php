<?php
/**
 * Transparency functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Transparency
 */

if ( ! function_exists( 'transparency_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function transparency_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Transparency, use a find and replace
	 * to change 'transparency' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'transparency', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	unregister_nav_menu( 'home-page-slider' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'transparency' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'transparency_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/* Allow shortcodes in widget areas */
	add_filter('widget_text', 'do_shortcode');
}
endif;
add_action( 'after_setup_theme', 'transparency_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function transparency_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'transparency_content_width', 1200 );
}
add_action( 'after_setup_theme', 'transparency_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function transparency_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page', 'transparency' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'transparency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title twitter-widget">',
		'after_title'   => '</h5>',
	) );

	register_sidebar(array(
		'name' => __( 'Footer', 'transparency' ),
		'id' => 'footer',
		'description' => __( 'Widgets in this area will be shown in the Footer.' , 'transparency'),
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => ''
	  )
	);

	register_sidebar(array(
		'name' => __( 'Events', 'transparency' ),
		'id' => 'sidebar-2',
		'description' => __( 'Widgets in this area will show in the Events Section' , 'transparency'),
		'before_title' => '<div class="event-title">',
		'after_title' => '</div>',
		'before_widget' => '<div class="event">',
		'after_widget' => '</div>'
	  )
	);
}
add_action( 'widgets_init', 'transparency_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function transparency_scripts() {
	wp_enqueue_style( 'transparency-style', get_stylesheet_uri() );

	wp_enqueue_script( 'transparency-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'transparency-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'transparency-topbutton', get_template_directory_uri() . '/js/topbutton.js', array(), '20151215', true );

	// Font Awesome
	wp_enqueue_script('transparency-font-awesome', 'https://use.fontawesome.com/08b1a76eab.js');

	// jQuery
	wp_enqueue_script('jquery');

	// Bootstrap
	wp_enqueue_script('transparency-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'transparency_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/custom-posttypes.php';

/**
* Custom Post Type Formats
**/

add_theme_support( 'post-formats', array( 'standard', 'image' ) );

function rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Image' )
        return 'Feature';

    return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

//rename image in posts list table
function live_rename_formats() {
    global $current_screen;

    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {

            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Image" )
                    jQuery(this).text("Feature");
            });

        });
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');

/*-----------------------------------------------------------------------------------*/
/* Change Posts to Analysis in admin
/*-----------------------------------------------------------------------------------*/
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Analysis';
    $submenu['edit.php'][5][0] = 'Analysis';
    $submenu['edit.php'][10][0] = 'Add Analysis';
    $submenu['edit.php'][16][0] = 'Analysis Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Analysis';
    $labels->singular_name = 'Analysis';
    $labels->add_new = 'Add Analysis';
    $labels->add_new_item = 'Add Analysis';
    $labels->edit_item = 'Edit Analysis';
    $labels->new_item = 'Analysis';
    $labels->view_item = 'View Analysis';
    $labels->search_items = 'Search Analysis';
    $labels->not_found = 'No Analysis found';
    $labels->not_found_in_trash = 'No Analysis found in Trash';
    $labels->all_items = 'All Analysis';
    $labels->menu_name = 'Analysis';
    $labels->name_admin_bar = 'Analysis';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

/*-----------------------------------------------------------------------------------*/
/* Add Staff Editor Role
/*-----------------------------------------------------------------------------------*/

$staffed = add_role( 'staff_editor', __( 'Staff Editor' ),

array(

	'delete_others_posts' => true,
	'delete_pages' => false,
	'delete_posts' => true,
	'delete_private_pages' => false,
	'delete_private_posts' => true,
	'delete_published_pages' => false,
	'delete_published_posts' => true,
	'edit_others_pages' => true,
	'edit_others_posts' => true,
	'edit_pages' => false,
	'edit_posts' => true,
	'edit_private_pages' => false,
	'edit_private_posts' => true,
	'edit_published_pages' => false,
	'edit_published_posts' => true,
	'manage_categories' => true,
	'manage_links' => false,
  	'manage_options' => true,
	'publish_pages' => true,
	'publish_posts' => true,
	'read' => true,
	'read_private_pages' => true,
	'read_private_posts' => true,
	'unfiltered_html' => true,
	'upload_files' => true,
	'list_users' => true,
	'create_users' => true,
	'edit_users' => true,
	'delete_users' => true,
	'promote_users' => true,
	'add_users' => true,
	'remove_users' => true,
	'edit_theme_options' => true,
)

);
/*-----------------------------------------------------------------------------------*/
/* Register Custom Navigation Walker - Adds Bootstrap styling to menu
/*-----------------------------------------------------------------------------------*/
require_once('wp_bootstrap_navwalker.php');

/*-----------------------------------------------------------------------------------*/
/* Add Search Bar to Menu
/*-----------------------------------------------------------------------------------*/
add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
	if($args->theme_location == 'primary') {
	    $search = '<li class="search">';
	    $search .= '<form method="get" id="searchform" action="/"><div class="input-group">';
	    $search .= '<label class="screen-reader-text" for="navSearchInput">Search for:</label>';
	    $search .= '<input type="text" class="form-control" name="s" id="navSearchInput" placeholder="Search" />';
	    $search .= '<label for="navSearchInput" id="navSearchLabel"><i class="fa fa-search" aria-hidden="true"></i></label>';
	    $search .= '</div></form>';
	    $search .= '</li>';
	    return $items.$search;
	}
	return $items;
}

// Remove comments from media attachments, specifically the comments on the JetPack Carousel Slides
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );
// ------------------------------------

// Full Width Shortcode
// Add Shortcode
function shortcode_fullWidth( $atts , $content = null ) {
	return "<div class='fullWidthFeatureContent'>".$content."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Homepage image size
 */
add_image_size ( 'homeImage', 600, 300, TRUE );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
