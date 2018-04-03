<?php
/**
 * Modify the existing post formats to use different labels.
 *
 * @package Missile_Defense
 */

add_theme_support( 'post-formats', array( 'standard', 'image', 'status' ) );

function rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Image' )
        return 'Feature';
	elseif ( $safe_text == 'Status' )
        return 'News';

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
                else if ( jQuery(this).text() == "Status" )
                    jQuery(this).text("News");
            });

        });
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');
