<?php

/**
 * Disable any lazy load script if View is shown
 * To prevent bug with Pinterest/Masonry layout
 *
 * @package Content Views Pro
 * @author PT Guy
 * @since CVP 3.6
 */
#Solution 1: only works with plugin which only handles by JS
#add_action( 'wp_footer', 'cvp_anti_lazy_load_remove_scripts', 1 );
function cvp_anti_lazy_load_remove_scripts() {
	// Text to search
	$pattern = 'lazy-load';

	$has_lazy_load	 = $found_lazy_load = false;

	$actived_plugins = wp_get_active_and_valid_plugins();
	foreach ( $actived_plugins as $plugin_path ) {
		if ( strpos( $plugin_path, $pattern ) !== false ) {
			$has_lazy_load = true;
			break;
		}
	}

	if ( $has_lazy_load ) {
		global $pt_cv_id;

		// If has View on this page
		if ( $pt_cv_id ) {
			global $wp_scripts;

			// Check in queue list first
			foreach ( $wp_scripts->queue as $script ) {
				if ( strpos( $script, $pattern ) !== false ) {
					wp_dequeue_script( $script );

					$found_lazy_load = true;
				}
			}

			// Check in registered list, if can't find lazy-load script (in cases its name doesn't contain $pattern)
			if ( !$found_lazy_load ) {
				foreach ( $wp_scripts->registered as $script_data ) {
					if ( strpos( $script_data->src, $pattern ) !== false ) {
						wp_dequeue_script( $script_data->handle );
					}
				}
			}
		}
	}
}

#Solution 2: (strongger) Deactivate any lazy-load plugin
add_action( 'current_screen', 'cvp_anti_lazy_load_for_backend' );
add_action( 'plugins_loaded', 'cvp_anti_lazy_load_for_frontend', 40 );
function cvp_anti_lazy_load_for_backend( $current_screen ) {
	// On CV add/edit View page
	if ( $current_screen->id === 'content-views_page_content-views-add' ) {
		cvp_anti_lazy_load_deactivate_plugins();
	}
}

function cvp_anti_lazy_load_for_frontend() {
	if ( is_admin() ) {
		return;
	}

	cvp_anti_lazy_load_deactivate_plugins();
}

function cvp_anti_lazy_load_deactivate_plugins() {
	$updated		 = false;
	$active_plugins	 = (array) get_option( 'active_plugins' );
	foreach ( $active_plugins as $idx => $plugin ) {
		if ( strpos( $plugin, 'lazy-load' ) !== false ) {
			$updated = true;
			unset( $active_plugins[ $idx ] );
		}
	}

	if ( $updated ) {
		update_option( 'active_plugins', $active_plugins );
	}
}
