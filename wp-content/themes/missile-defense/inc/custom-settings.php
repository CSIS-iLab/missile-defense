<?php
/**
 *
 * Custom settings page for the theme
 *
 * @package Missile_Defense
 */

add_action( 'admin_menu', 'missiledefense_add_options_page' );


function missiledefense_add_options_page() {
  add_options_page(
    'Missile Threat Settings',
    'Missile Threat Settings',
    'manage_options',
    'missiledefense-options-page',
    'missiledefense_display_options_page'
  );
}

function missiledefense_display_options_page() {
  echo '<h1>Missile Threat Settings</h1>';
  echo '<form method="post" action="options.php">';
  do_settings_sections( 'missiledefense-options-page' );
  settings_fields ( 'missiledefense_settings' );
  submit_button();
  echo '</form>';
}

add_action( 'admin_init', 'missiledefense_admin_init_section_homepage' );
/**
 * Create the "Homepage" settings section.
 */
 function missiledefense_admin_init_section_homepage() {
  $projects_category = get_option( 'missiledefense_homepage_ongoing_projects_category' );

   $post_types = array( 'post' );
   $post_selection = array();
   foreach ($post_types as $type) {
     $post_selection[$type] = get_posts(
         array(
           'post_type' => $type,
           'numberposts' => -1,
           'category' => $projects_category
         )
       );
   }

   $categories = get_categories(array('hide_empty' => 0));

   add_settings_section(
     'missiledefense_settings_section_homepage',
     'Homepage',
     'missiledefense_display_section_homepage_message',
     'missiledefense-options-page'
   );

   add_settings_field(
      'missiledefense_homepage_ongoing_projects_desc',
      'Ongoing Projects Description',
      'missiledefense_textarea_callback',
      'missiledefense-options-page',
      'missiledefense_settings_section_homepage',
      array( 'missiledefense_homepage_ongoing_projects_desc' )
   );

   add_settings_field(
      'missiledefense_homepage_ongoing_projects_category',
      'Ongoing Projects Category',
      'missiledefense_category_callback',
      'missiledefense-options-page',
      'missiledefense_settings_section_homepage',
      array( 'missiledefense_homepage_ongoing_projects_category', $categories )
   );

   add_settings_field(
      'missiledefense_homepage_ongoing_projects_1',
      'Ongoing Projects #1',
      'missiledefense_posts_callback',
      'missiledefense-options-page',
      'missiledefense_settings_section_homepage',
      array( 'missiledefense_homepage_ongoing_projects_1',
      $post_selection['post'] )
   );

   add_settings_field(
      'missiledefense_homepage_ongoing_projects_2',
      'Ongoing Projects #2',
      'missiledefense_posts_callback',
      'missiledefense-options-page',
      'missiledefense_settings_section_homepage',
      array( 'missiledefense_homepage_ongoing_projects_2',
      $post_selection['post'] )
   );

   add_settings_field(
      'missiledefense_homepage_ongoing_projects_3',
      'Ongoing Projects #3',
      'missiledefense_posts_callback',
      'missiledefense-options-page',
      'missiledefense_settings_section_homepage',
      array( 'missiledefense_homepage_ongoing_projects_3',
      $post_selection['post'] )
   );

   register_setting(
      'missiledefense_settings',
      'missiledefense_homepage_ongoing_projects_desc',
      'wp_filter_post_kses'
   );

   register_setting(
      'missiledefense_settings',
      'missiledefense_homepage_ongoing_projects_category',
      'sanitize_text_field'
   );

   register_setting(
      'missiledefense_settings',
      'missiledefense_homepage_ongoing_projects_1',
      'sanitize_text_field'
   );

   register_setting(
      'missiledefense_settings',
      'missiledefense_homepage_ongoing_projects_2',
      'sanitize_text_field'
   );

   register_setting(
      'missiledefense_settings',
      'missiledefense_homepage_ongoing_projects_3',
      'sanitize_text_field'
   );
 }

function missiledefense_display_section_homepage_message() {
	echo 'The ongoing projects post shown on the home page.';
}

/**
 * Renders the textarea fields.
 *
 * @param Array $args Array of arguments passed by callback function.
 */
function missiledefense_textarea_callback( $args ) {
  $option = get_option( $args[0] );
  echo '<textarea class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" rows="5">' . esc_attr( $option ) . '</textarea>';
}

/**
 * Renders the post dropdown fields.
 *
 * @param Array $args Array of arguments passed by callback function.
 */
function missiledefense_posts_callback( $args ) {
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
/**
 * Renders the category dropdown fields.
 *
 * @param Array $args Array of arguments passed by callback function.
 */
function missiledefense_category_callback( $args ) {
  $option = get_option( $args[0] );
  echo '<select name="' . esc_attr( $args[0] ) . '" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '">';
  foreach ( $args[1] as $category ) {
    if ( $category->term_id == esc_attr( $option ) ) {
      $selected = "selected";
    } else {
      $selected = '';
    }

    echo '<option value="' . esc_attr( $category->term_id ) . '" ' . $selected . '>' . esc_attr( $category->name ) . '</option>';
  }
  echo '</select>';
}
 ?>
