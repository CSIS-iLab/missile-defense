<?php
/**
 * Transparency functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Missile_Defense
 */

if ( ! function_exists( 'missiledefense_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function missiledefense_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Transparency, use a find and replace
	 * to change 'missiledefense' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'missiledefense', get_template_directory() . '/languages' );

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

	/**
	 * Homepage image size
	 */
	add_image_size ( 'homeImage', 600, 300, TRUE );

	unregister_nav_menu( 'home-page-slider' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'missiledefense' )
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
	add_theme_support( 'custom-background', apply_filters( 'missiledefense_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/* Allow shortcodes in widget areas */
	add_filter('widget_text', 'do_shortcode');
}
endif;
add_action( 'after_setup_theme', 'missiledefense_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function missiledefense_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'missiledefense_content_width', 1200 );
}
add_action( 'after_setup_theme', 'missiledefense_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function missiledefense_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page', 'missiledefense' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'missiledefense' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title twitter-widget">',
		'after_title'   => '</h5>',
	) );

	register_sidebar(array(
		'name' => __( 'Footer', 'missiledefense' ),
		'id' => 'footer',
		'description' => __( 'Widgets in this area will be shown in the Footer.' , 'missiledefense'),
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => ''
	  )
	);

	register_sidebar(array(
		'name' => __( 'Events', 'missiledefense' ),
		'id' => 'sidebar-2',
		'description' => __( 'Widgets in this area will show in the Events Section' , 'missiledefense'),
		'before_title' => '<div class="event-title">',
		'after_title' => '</div>',
		'before_widget' => '<div class="event">',
		'after_widget' => '</div>'
	  )
	);
}
add_action( 'widgets_init', 'missiledefense_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function missiledefense_scripts() {
	wp_enqueue_style( 'missiledefense-style', get_stylesheet_uri() );

	wp_enqueue_script( 'missiledefense-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'missiledefense-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'missiledefense-topbutton', get_template_directory_uri() . '/js/topbutton.js', array(), '20151215', true );

	// Font Awesome
	wp_enqueue_script('missiledefense-font-awesome', 'https://use.fontawesome.com/08b1a76eab.js');

	// Bootstrap
	wp_enqueue_script('missiledefense-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'missiledefense_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function missiledefense_enqueue_admin_scripts() {
    $screen = get_current_screen();
    if ( in_array( $screen->id, array( 'missile' ) ) ) {
        wp_enqueue_script('missiledefense-admin-cpts', get_template_directory_uri().'/js/admin-cpts.js', 'jquery', '', true);
    }
}
add_action( 'admin_enqueue_scripts', 'missiledefense_enqueue_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Settings.
 */
require get_template_directory() . '/inc/custom-settings.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION') ) {
    include get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Custom Post Types & Taxonomies.
 */
require get_template_directory() . '/inc/custom-posttypes.php';

/**
 * Load Custom Post Formats.
 */
require get_template_directory() . '/inc/custom-post-formats.php';

/**
 * Add custom navigation walker to main navigation.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Load custom shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load custom TinyMCE toolbar buttons.
 */
require get_template_directory() . '/inc/tinymce.php';
