<?php

/**
 * Custom handles for custom fields
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_CustomField' ) ) {

	/**
	 * @name PT_CV_CustomField
	 * @todo Utility functions
	 */
	class PT_CV_CustomField {
		/**
		 * Generate final output for csutom field
		 *
		 * @param array $field_values
		 * @param bool $use_oembed
		 *
		 * @return string
		 */
		public static function display_output( $field_values, $use_oembed ) {
			$result		 = array();
			$separator	 = apply_filters( PT_CV_PREFIX_ . 'ctf_multi_val_separator', ', ' );

			foreach ( $field_values as $value ) {
				$output = $use_oembed ? wp_oembed_get( $value ) : maybe_serialize( $value );

				if ( !$use_oembed || !$output ) {
					$pathinfo	 = pathinfo( $value );
					$extension	 = isset( $pathinfo[ 'extension' ] ) ? strtolower( $pathinfo[ 'extension' ] ) : '';

					if ( is_email( $value ) ) {
						$output = sprintf( '<a target="_blank" href="mailto:%1$s">%1$s</a>', antispambot( $value ) );
					} else if ( preg_match( '/(gif|png|jp(e|g|eg)|bmp|ico|webp|jxr|svg)/i', $extension ) ) {
						$output = self::image( $value, $pathinfo[ 'filename' ] );
					} else if ( $extension == 'mp3' ) {
						$output = self::embed_audio( $value );
					} else if ( $extension == 'mp4' ) {
						$output = self::embed_video( $value );
					} else if ( !filter_var( $value, FILTER_VALIDATE_URL ) === false ) {
						$output = sprintf( '<a target="_blank" href="%s">%s</a>', esc_attr( $value ), esc_html( $value ) );
					}
					// Support serialized data (such as: wp-types checkbox)
					else if ( is_serialized( $value ) ) {
						$output = self::handle_serialized_value( $value, $separator );
					}
				}

				$result[] = $output;
			}

			return array_filter( $result ) ? implode( $separator, $result ) : '';
		}

		public static function handle_serialized_value( $value, $separator ) {
			$result = unserialize( $value );
			if ( is_array( $result ) ) {
				$result = implode( $separator, array_map( 'reset', $result ) );
			}

			return apply_filters( PT_CV_PREFIX_ . 'serialized_custom_field', $result, $value );
		}

		public static function image( $value, $name ) {
			return sprintf( '<img class="%s" src="%s" title="%s" style="width: 100%%">', PT_CV_PREFIX . 'ctf-image', esc_url( $value ), esc_attr( $name ) );
		}

		public static function embed_audio( $value ) {
			return '<audio controls>
					<source src="' . esc_url( $value ) . '" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>';
		}

		public static function embed_video( $value ) {
			return '<video controls>
					<source src="' . esc_url( $value ) . '" type="video/mp4">
					Your browser does not support HTML5 video.
					</video>';
		}

	}

}