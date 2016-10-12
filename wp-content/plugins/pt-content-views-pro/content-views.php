<?php

/**
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 *
 * @wordpress-plugin
 * Plugin Name:       Content Views Pro
 * Plugin URI:        http://www.contentviewspro.com/
 * Description:       Premium addon of plugin "Content Views" (free on wordpress.org)
 * Version:           3.9.2
 * Author:            PT Guy
 * Author URI:        http://www.contentviewspro.com/
 * Text Domain:       content-views-pro
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

// Define Constant
define( 'PT_CV_VERSION_PRO', '3.9.2' );
define( 'PT_CV_REQUIRE_FREE', '1.8.6.1' );
define( 'PT_CV_FILE_PRO', __FILE__ );
define( 'PT_CV_PATH_PRO', plugin_dir_path( __FILE__ ) );
include_once( PT_CV_PATH_PRO . 'includes/defines.php' );
include_once( PT_CV_PATH_PRO . 'includes/plugin.php' );

// Include the TGM_FCVP_Plugin_Activation class.
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_fcvp_register', 'cvp_register_required_plugins' );
function cvp_register_required_plugins() {
	$plugins = array(
		array(
			'name'				 => 'Content Views (free on wordpress.org)',
			'slug'				 => 'content-views-query-and-display-post-page',
			'required'			 => true,
			'force_activation'	 => true,
			'version'			 => PT_CV_REQUIRE_FREE,
		),
	);

	$config = array(
		'id'			 => 'content-views-pro', // Unique ID for hashing notices for multiple instances of TGM_FCVPPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'cvpro-install-plugins', // Menu slug.
		'parent_slug'	 => 'plugins.php', // Parent menu slug.
		'capability'	 => 'manage_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => false, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => true, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
		'strings'		 => array(
			'notice_can_install_required'	 => _n_noop(
				'Content Views Pro requires this plugin: %1$s.', 'Content Views Pro requires the following plugins: %1$s.', 'content-views-pro'
			),
			'notice_ask_to_update'			 => _n_noop(
				'Content Views Pro requires latest version of this plugin: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'content-views-pro'
			),
			'notice_ask_to_update_maybe'	 => _n_noop(
				'Content Views Pro requires latest version of this plugin: %1$s.', 'There are updates available for the following plugins: %1$s.', 'tgmpa_fcvp'
			),
			'nag_type'						 => 'error',
		),
	);

	tgmpa_fcvp( $plugins, $config );
}

// Register hooks when the plugin is activated or deactivated
register_activation_hook( __FILE__, array( 'PT_CV_Plugin_Pro_Actions', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'PT_CV_Plugin_Pro_Actions', 'deactivate' ) );

if ( class_exists( 'PT_Content_Views' ) ) {
	// Include library files
	include_once( PT_CV_PATH_PRO . 'includes/functions.php' );
	include_once( PT_CV_PATH_PRO . 'includes/hooks.php' );
	include_once( PT_CV_PATH_PRO . 'includes/html-viewtype.php' );
	include_once( PT_CV_PATH_PRO . 'includes/html.php' );
	include_once( PT_CV_PATH_PRO . 'includes/settings.php' );
	include_once( PT_CV_PATH_PRO . 'includes/update.php' );
	include_once( PT_CV_PATH_PRO . 'includes/values.php' );
	include_once( PT_CV_PATH_PRO . 'includes/support/woocommerce.php' );
	include_once( PT_CV_PATH_PRO . 'includes/support/acf.php' );
	include_once( PT_CV_PATH_PRO . 'includes/support/custom-field.php' );
	include_once( PT_CV_PATH_PRO . 'includes/support/um.php' );
	include_once( PT_CV_PATH_PRO . 'includes/support/anti-lazy-load.php' );
	include_once( PT_CV_PATH_PRO . 'includes/lib/Mobile_Detect.php' );
	include_once( PT_CV_PATH_PRO . 'includes/lib/Social_Share.php' );

	// Main file
	include_once( PT_CV_PATH_PRO . 'public/content-views.php' );

	// Load plugin
	cvp_load( 'PT_Content_Views_Pro', 'get_instance' );

	// For Admin
	if ( is_admin() ) {
		include_once( PT_CV_PATH_PRO . 'admin/includes/plugin.php' );
		include_once( PT_CV_PATH_PRO . 'admin/content-views-admin.php' );

		cvp_load( 'PT_Content_Views_Pro_Admin', 'get_instance' );

		// Update management
		require_once( 'wp-updates-plugin.php' );
		$plugin_update_path	 = 'http://update.contentviewspro.com/';
		$plugin_path		 = plugin_basename( __FILE__ );
		$license_key		 = PT_CV_Functions::get_option_value( 'license_key' );
		new CVPro_AutoUpdate( $plugin_update_path, $plugin_path, $license_key );
	}
}
// Load CVP when?
function cvp_load( $classname, $function ) {
	if ( get_option( 'cvp_load_after_plugins_loaded' ) ) {
		add_action( 'plugins_loaded', array( $classname, $function ), 20 );
	} else {
		call_user_func( array( $classname, $function ) );
	}
}
