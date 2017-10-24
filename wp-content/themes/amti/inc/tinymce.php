<?php
/*==============================================
=            TinyMCE Custom Buttons            =
==============================================*/

add_action( 'after_setup_theme', 'transparency_theme_setup' );

if ( ! function_exists( 'transparency_theme_setup' ) ) {
    function transparency_theme_setup() {

        add_action( 'init', 'transparency_buttons' );

    }
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'transparency_buttons' ) ) {
    function transparency_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', 'transparency_add_buttons' );
        add_filter( 'mce_buttons', 'transparency_register_buttons' );
    }
}

if ( ! function_exists( 'transparency_add_buttons' ) ) {
    function transparency_add_buttons( $plugin_array ) {
        $plugin_array['missilethreat'] = get_template_directory_uri().'/js/tinymce.js';
        return $plugin_array;
    }
}

if ( ! function_exists( 'transparency_register_buttons' ) ) {
    function transparency_register_buttons( $buttons ) {
        array_push( $buttons, 'tableOfContents', 'definition');
        return $buttons;
    }
}
add_action ( 'after_wp_tiny_mce', 'transparency_tinymce_extra_vars' );

if ( !function_exists( 'transparency_tinymce_extra_vars' ) ) {
	function transparency_tinymce_extra_vars() { ?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('ToC','transparency'),
					'button_title' => esc_html__('Table of Contents', 'transparency')
				)
				);
			?>;
		</script><?php
	}
}
