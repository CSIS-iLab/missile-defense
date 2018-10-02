<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Missile_Defense
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
 * @return array
 */
function missiledefense_body_classes( $classes ) 
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter('body_class', 'missiledefense_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function missiledefense_pingback_header() 
{
    if (is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'missiledefense_pingback_header');

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return text HTML content describing embedded figure
 **/
function missiledefense_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
    . do_shortcode( $content ) . '<figcaption ' . $capid 
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
add_filter('img_caption_shortcode', 'missiledefense_img_caption_shortcode_filter',10,3);

/**
 * Fixes empty <p> and <br> tags showing before and after shortcodes in the
 * output content.
 */
function missiledefense_the_content_shortcode_fix($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']'
    );
    return strtr($content, $array);
}
add_filter('the_content', 'missiledefense_the_content_shortcode_fix');

/**
 * Use relative URLs for images
 */
function missiledefense_switch_to_relative_url($html, $id, $caption, $title, $align, $url, $size, $alt)
{
    $imageurl = wp_get_attachment_image_src($id, $size);
    $relativeurl = wp_make_link_relative($imageurl[0]);   
    $html = str_replace($imageurl[0],$relativeurl,$html);
          
    return $html;
}
add_filter('image_send_to_editor','missiledefense_switch_to_relative_url',10,8);


/**
 * Make links pushed to Algolia relative.
 *
 * @param array   $shared_attributes Attributes to push.
 * @param WP_Post $post Post object.
 * @return array Updated Attributes array.
 */
function missiledefense_algolia_shared_attributes( array $shared_attributes, WP_Post $post ) {

    $shared_attributes['permalink'] = wp_make_link_relative( get_post_permalink( $post ) );
    if ( has_post_thumbnail( $post ) ) {
        $shared_attributes['images']['thumbnail']['url'] = wp_make_link_relative( get_the_post_thumbnail_url( $post ) );
    }
    return $shared_attributes;
}
add_filter( 'algolia_post_shared_attributes', 'missiledefense_algolia_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'missiledefense_algolia_shared_attributes', 10, 2 );


/**
 * Only use Photon for images belonging to our site.
 *
 * @see https://wordpress.org/support/?p=8513006
 *
 * @param bool         $skip      Should Photon ignore that image.
 * @param string       $image_url Image URL.
 * @param array|string $args      Array of Photon arguments.
 * @param string|null  $scheme    Image scheme. Default to null.
 */
function jeherve_photon_only_allow_local( $skip, $image_url, $args, $scheme ) {
    // Get the site URL, without any protocol.
    $site_url = preg_replace( '~^(?:f|ht)tps?://~i', '', get_site_url() );
 
    /**
     * If the image URL is from our site,
     * return default value (false, unless another function overwrites).
     * Otherwise, do not use Photon with it.
     */
    if ( strpos( $image_url, $site_url ) ) {
        return $skip;
    } else {
        return true;
    }
}
add_filter( 'jetpack_photon_skip_for_url', 'jeherve_photon_only_allow_local', 9, 4 );

/**
 * Change "Posts" label in WP Admin to "Analysis"
 * @return array Modified global $menu, $submenu arrays.
 */
function missiledefense_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Analysis';
    $submenu['edit.php'][5][0] = 'Analysis';
    $submenu['edit.php'][10][0] = 'Add Analysis';
    $submenu['edit.php'][16][0] = 'Analysis Tags';
}
add_action( 'admin_menu', 'missiledefense_change_post_label' );

/**
 * Change Post Object Labels
 * @return array Modified post object
 */
function missiledefense_change_post_object() {
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
add_action( 'init', 'missiledefense_change_post_object' );

/**
 * Remove comments from media attachements, specifically the comments on the JetPack Carousel Slides
 * @param  string $open    Content
 * @param  ID $post_id Post ID
 * @return string          Content
 */
function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function missiledefense_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'missiledefense_excerpt_more' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function missiledefense_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'missiledefense_custom_excerpt_length', 999 );

/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param string $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post',
 *
 * @return mixed
 */
function missiledefense_custom_wpkses_post_tags( $tags, $context ) {
    if ( 'post' === $context ) {
        $tags['iframe'] = array(
            'src'             => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
            'allowvr allowfullscreen' => true,
            'mozallowfullscreen' => true,
            'webkitallowfullscreen' => true,
            'onmousewheel' => true
        );
        $tags['style'] = array(
            'type' => true
        );
    }
    return $tags;
}
add_filter( 'wp_kses_allowed_html', 'missiledefense_custom_wpkses_post_tags', 10, 2 );

/**
 * Change the default post query to show private pages on missile pages.
 *
 * @param  array $query Query object.
 */
function missilethreat_custom_sort_posts( $query ) {
    if ( is_tax( 'countries' ) && $query->is_main_query() ) {
        $query->set( 'post_status', array( 'publish', 'private' ) );
    }
}
add_action( 'pre_get_posts', 'missilethreat_custom_sort_posts' );

/**
 * Add search link to the main menu.
 * @param  string $items Menu items content.
 * @param  array $args  Menu.
 * @return string        Modified menu.
 */
function missiledefense_add_search_box( $items, $args ) {
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
add_filter( 'wp_nav_menu_items','missiledefense_add_search_box', 10, 2 );

/**
 * Alter the titles of the archives for categories & tags.
 * @param  string $title Archive title
 * @return string        Modified archive title.
 */
function missiledefense_archive_titles( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '<span class="archive-label">Category:</span> ', false );
    } elseif( is_tag() ) {
        $title = single_tag_title( '<span class="archive-label">Keyword:</span> ', false );
    } elseif( is_author() ) {
        $title = '<span class="archive-label">Author:</span> ' . get_the_author();
    } elseif ( is_tax( 'system' ) ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'missiledefense_archive_titles' );

/**
*
* Recreate the default filters on the_content so we can pull formated content with get_post_meta
*/
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars' );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode' );
add_filter( 'term_description', 'do_shortcode' );

/**
 * Move Yoast SEO meta boxes to bottom of editing screen.
 * @return string Priority level.
 */
function missile_defenseyoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'missile_defenseyoasttobottom');

/**
 * Set default attributes for the accordion shortcode.
 * @param array $atts Shortcode attributes.
 */
function set_accordion_shortcode_defaults($atts) {
    $atts['autoclose'] = false;
    $atts['clicktoclose'] = true;
    return $atts;
}
add_filter('shortcode_atts_accordion', 'set_accordion_shortcode_defaults', 10, 3);

function missiledefense_undo_footnote_reset() {
    if ( in_array( get_post_type(), array( 'actors', 'systems', 'post', 'defsys', 'missile' ) ) && is_single() ) {
        global $easyFootnotes;
        remove_filter( 'the_content', array($easyFootnotes, 'easy_footnote_reset'), 999 );
    }
}
add_action( 'template_redirect', 'missiledefense_undo_footnote_reset' );

if ( class_exists( 'easyFootnotes' ) ) {
    /**
     * Removes the easy footnotes from the content so we can display them separately elsewhere.
     * @param  string $content The post content.
     * @return string          The modified post content.
     */
    function missiledefense_remove_easy_footnotes($content) {
        $content = preg_replace('#<ol[^>]*class="easy-footnotes-wrapper"[^>]*>.*?</ol>#is', '', $content);
        return $content;
    }
    add_filter('the_content', 'missiledefense_remove_easy_footnotes', 20);
}
