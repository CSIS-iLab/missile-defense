<?php
/*==============================================
=            TinyMCE Custom Buttons            =
==============================================*/

add_action( 'after_setup_theme', 'missiledefense_theme_setup' );

if ( ! function_exists( 'missiledefense_theme_setup' ) ) {
    function missiledefense_theme_setup() {

        add_action( 'init', 'missiledefense_buttons' );

    }
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'missiledefense_buttons' ) ) {
    function missiledefense_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', 'missiledefense_add_buttons' );
        add_filter( 'mce_buttons', 'missiledefense_register_buttons' );
    }
}

if ( ! function_exists( 'missiledefense_add_buttons' ) ) {
    function missiledefense_add_buttons( $plugin_array ) {
        $plugin_array['missilethreat'] = get_template_directory_uri().'/js/tinymce.js';
        return $plugin_array;
    }
}

if ( ! function_exists( 'missiledefense_register_buttons' ) ) {
    function missiledefense_register_buttons( $buttons ) {
        array_push( $buttons, 'tableOfContents', 'definition', 'systemElements', 'note');
        return $buttons;
    }
}
add_action ( 'after_wp_tiny_mce', 'missiledefense_tinymce_extra_vars' );

if ( !function_exists( 'missiledefense_tinymce_extra_vars' ) ) {
	function missiledefense_tinymce_extra_vars() { ?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('ToC','missiledefense','systemElements','note'),
					'button_title' => esc_html__('Table of Contents', 'missiledefense','systemElements','note')
				)
				);
			?>;
		</script><?php
	}
}
