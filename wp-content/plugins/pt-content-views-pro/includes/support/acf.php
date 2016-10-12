<?php

/**
 * ACF custom actions/filters
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_ACF' ) ) {

	/**
	 * @name PT_CV_ACF
	 * @todo Utility functions
	 */
	class PT_CV_ACF {
		/**
		 * Generate final output for ACF field
		 *
		 * @param array $field_object
		 *
		 * @return string
		 */
		public static function display_output( $field_object ) {
			if ( !$field_object ) {
				return '';
			}

			$value	 = $field_object[ 'value' ];
			$type	 = $field_object[ 'type' ];

			// If value is empty, return
			if ( $type != 'true_false' && empty( $value ) ) {
				return '';
			}

			switch ( $type ) {

				// Custom function
				case 'select':
				case 'checkbox':
				case 'radio':
					$result = array();
					foreach ( (array) $value as $key ) {
						$result[] = isset( $field_object[ 'choices' ][ $key ] ) ? $field_object[ 'choices' ][ $key ] : '';
					}
					$value = implode( ', ', $result );

					break;

				case 'true_false':
					$value = $value ? __( 'Yes', 'content-views-query-and-display-post-page' ) : __( 'No', 'content-views-query-and-display-post-page' );

					break;

				case 'date_picker':
					// Create date with 'date_format'
					$date = DateTime::createFromFormat( self::date_js_to_php( $field_object[ 'date_format' ] ), $value );
					// Show date with 'display_format'
					if ( $date ) {
						$value = $date->format( self::date_js_to_php( $field_object[ 'display_format' ] ) );
					}

					break;

				case 'color_picker':
					$value = sprintf( '<div class="%1$s" style="height:%2$s;width:%2$s;background:%3$s;"></div>', PT_CV_PREFIX . 'ctf-color', '25px', $value );

					break;

				case 'page_link':
					$value = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( $value ), __( 'Click here', 'content-views-pro' ) );

					break;

				// Custom output from file
				case 'image':
				case 'file':
				case 'relationship':
				case 'taxonomy':
				case 'gallery':
					$file_path = PT_CV_PATH_PRO . sprintf( 'includes/support/acf-fields/%s.php', $field_object[ 'type' ] );

					if ( file_exists( $file_path ) ) {
						ob_start();
						include $file_path;
						$value = ob_get_clean();
					}

					break;
			}

			return $value;
		}

		/**
		 * Convert date format from JS to PHP
		 *
		 * @param string $date
		 *
		 * @return string
		 */
		static function date_js_to_php( $date ) {
			$cyear	 = str_replace( 'yy', 'Y', $date );
			$cmonth	 = str_replace( 'mm', 'm', $cyear );
			$cday	 = str_replace( 'dd', 'd', $cmonth );

			return $cday;
		}

	}

}