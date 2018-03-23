<?php
/**
 *
 * Custom settings page for the theme
 *
 * @package Transparency
 */

add_action( 'admin_menu', 'transparency_add_options_page' );


function transparency_add_options_page() {
  add_options_page(
    'Missile Threat Settings',
    'Missile Threat Settings',
    'manage_options',
    'transparency-options-page',
    'transparency_display_options_page'
  );
}

function transparency_display_options_page() {
  echo '<h1>Missile Threat Settings</h1>';
  echo '<form method="post" action="options.php">';
  do_settings_sections( 'transparency-options-page' );
  settings_fields ( 'transparency_settings' );
  submit_button();
  echo '</form>';
}

add_action( 'admin_init', 'transparency_admin_init_section_homepage' );
/**
 * Create the "Homepage" settings section.
 */
 function transparency_admin_init_section_homepage() {
   $post_types = array( 'post' );
   $post_selection = array();
   foreach ($post_types as $type) {
     $post_selection[$type] = get_posts(
         array(
           'post_type' => $type,
           'numberposts' => -1
         )
       );
   }

   add_settings_section(
     'transparency_settings_section_homepage',
     'Homepage',
     'transparency_display_section_homepage_message',
     'transparency-options-page'
   );

   add_settings_field(
      'transparency_homepage_ongoing_projects_desc',
      'Ongoing Projects Description',
      'transparency_textarea_callback',
      'transparency-options-page',
      'transparency_settings_section_homepage',
      array( 'transparency_homepage_ongoing_projects_desc' )
   );

   add_settings_field(
      'transparency_homepage_ongoing_projects_1',
      'Ongoing Projects #1',
      'transparency_posts_callback',
      'transparency-options-page',
      'transparency_settings_section_homepage',
      array( 'transparency_homepage_ongoing_projects_1',
      $post_selection['post'] )
   );

   add_settings_field(
      'transparency_homepage_ongoing_projects_2',
      'Ongoing Projects #2',
      'transparency_posts_callback',
      'transparency-options-page',
      'transparency_settings_section_homepage',
      array( 'transparency_homepage_ongoing_projects_2',
      $post_selection['post'] )
   );

   add_settings_field(
      'transparency_homepage_ongoing_projects_3',
      'Ongoing Projects #3',
      'transparency_posts_callback',
      'transparency-options-page',
      'transparency_settings_section_homepage',
      array( 'transparency_homepage_ongoing_projects_3',
      $post_selection['post'] )
   );

   register_setting(
      'transparency_settings',
      'transparency_homepage_ongoing_projects_desc',
      'wp_filter_post_kses'
   );

   register_setting(
      'transparency_settings',
      'transparency_homepage_ongoing_projects_1',
      'sanitize_text_field'
   );

   register_setting(
      'transparency_settings',
      'transparency_homepage_ongoing_projects_2',
      'sanitize_text_field'
   );

   register_setting(
      'transparency_settings',
      'transparency_homepage_ongoing_projects_3',
      'sanitize_text_field'
   );
 }

function transparency_display_section_homepage_message() {
	echo 'The ongoing projects post shown on the home page.';
}

/**
 * Renders the textarea fields.
 *
 * @param Array $args Array of arguments passed by callback function.
 */
function transparency_textarea_callback( $args ) {
  $option = get_option( $args[0] );
  echo '<textarea class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" rows="5">' . esc_attr( $option ) . '</textarea>';
}

/**
 * Renders the post dropdown fields.
 *
 * @param Array $args Array of arguments passed by callback function.
 */
function transparency_posts_callback( $args ) {
  $option = get_option( $args[0] );
  echo '<select name="' . esc_attr( $args[0] ) . '" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '">';
  foreach ( $args[1] as $post ) {
    if ( $post->ID == esc_attr( $option ) ) {
      $selected = "selected";
    } else {
      $selected = '';
    }

    echo '<option value="' . esc_attr( $post->ID ) . '" ' . $selected . '>' . esc_attr( $post->post_title ) . '</option>';
  }
  echo '</select>';
}
 ?>
