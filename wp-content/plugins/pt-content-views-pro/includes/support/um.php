<?php

/**
 * Custom handles for Ultimate Member (1.3.15)
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_UltimateMember' ) ) {

	/**
	 * @name PT_CV_UltimateMember
	 * @todo Utility functions
	 */
	class PT_CV_UltimateMember {
		/**
		 * Generate all roles
		 *
		 * @return array
		 */
		public static function get_um_roles() {
			if ( class_exists( 'UM_Query' ) ) {
				$um_query = new UM_Query();
				return $um_query->get_roles();
			}
			return 0;
		}

		/**
		 * Check access setting of post
		 *
		 * @global type $post
		 * @global type $ultimatemember
		 * @return type
		 */
		public static function um_access_post_settings() {
			global $post, $ultimatemember;

			if ( !$ultimatemember ) {
				return;
			}

			# cvpadded - reset redirect value
			$ultimatemember->access->redirect_handler = false;

			// woo commerce shop ID
			if ( function_exists( 'is_shop' ) && is_shop() ) {

				$post_id = get_option( 'woocommerce_shop_page_id' );
			} /* else if ( is_archive() || is_front_page() || is_search() || in_the_loop() ) {

			  return;
			  }  else {

			  if ( !get_post_type() || !isset( $post->ID ) )
			  return;
			  } */

			if ( !isset( $post_id ) )
				$post_id = $post->ID;

			$args = $ultimatemember->access->get_meta( $post_id );
			extract( $args );

			/* if ( !isset( $args[ 'custom_access_settings' ] ) || $args[ '  custom_access_settings' ] == 0 ) {

			  $post_id = apply_filters( 'um_access_control_for_parent_posts', $post_id );

			  $args = $ultimatemember->access->get_meta( $post_id );
			  extract( $args );

			  if ( !isset( $args[ 'custom_access_settings' ] ) || $args[ 'custom_access_settings' ] == 0 ) {
			  return;
			  }
			  } */

			$redirect_to = null;

			if ( !isset( $accessible ) )
				return;

			switch ( $accessible ) {

				case 0:
					$ultimatemember->access->allow_access		 = true;
					$ultimatemember->access->redirect_handler	 = false; // open to everyone
					break;

				case 1:

					if ( is_user_logged_in() )
						$redirect_to = $access_redirect2;

					if ( !is_user_logged_in() )
						$ultimatemember->access->allow_access = true;
					else {
						$ultimatemember->access->allow_access		 = false;
						$ultimatemember->access->redirect_handler	 = true;
					}

					break;

				case 2:

					if ( !is_user_logged_in() ) {
						if ( !$access_redirect )
							$access_redirect = um_get_core_page( 'login' );
						$redirect_to	 = $access_redirect;
					}

					if ( is_user_logged_in() && isset( $access_roles ) && !empty( $access_roles ) ) {
						if ( !in_array( um_user( 'role' ), unserialize( $access_roles ) ) ) {
							if ( !$access_redirect ) {
								if ( is_user_logged_in() ) {
									$access_redirect = home_url();
								} else {
									$access_redirect = um_get_core_page( 'login ' );
								}
							}
							$redirect_to = $access_redirect;
						}
					}

					break;
			}

			if ( $redirect_to ) {
				if ( is_feed() ) {

				} else {
					$ultimatemember->access->redirect_handler = $redirect_to;
				}
			}
		}

	}

}