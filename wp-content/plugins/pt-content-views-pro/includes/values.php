<?php

/**
 * Define values for input, select...
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Values_Pro' ) ) {

	/**
	 * @name PT_CV_Values_Pro
	 * @todo Define values for input, select...
	 */
	class PT_CV_Values_Pro {
		/**
		 * Get Bootstrap styles for thumbnail
		 */
		static function field_thumbnail_styles() {
			// All available thumbnail sizes
			$result = array(
				'img-none'		 => __( 'None' ),
				'img-rounded'	 => __( 'Round edge', 'content-views-pro' ),
				'img-thumbnail'	 => __( 'Border', 'content-views-pro' ),
				'img-circle'	 => __( 'Circle', 'content-views-pro' ),
				'img-shadow'	 => __( 'Shadow', 'content-views-pro' ),
			);

			return $result;
		}

		static function auto_thumbnail() {
			$result = array(
				'image'			 => __( 'Image' ),
				'video-audio'	 => __( 'Video / Audio', 'content-views-pro' ),
				'none'			 => __( 'None' ),
			);

			return $result;
		}

		/**
		 * Style color for button
		 *
		 * @param array $text
		 *
		 * @return array
		 */
		static function field_style_options( $text, $unset = array() ) {

			$styles = array( 'primary', 'info', 'success', 'danger', 'default', 'warning', 'link' );

			$result = array();
			foreach ( $styles as $style ) {
				if ( !in_array( $style, (array) $unset ) ) {
					$result[ $style ] = PT_CV_Html::html_button( $style, $text, '', 'btn-sm' );
				}
			}

			return $result;
		}

		/**
		 * Return quick filter options for Woocommerce
		 */
		static function field_product_lists() {
			$result = array(
				'sale_products'			 => __( 'Sale products', 'content-views-pro' ),
				'recent_products'		 => __( 'Recent products', 'content-views-pro' ),
				'best_selling_products'	 => __( 'Best selling products', 'content-views-pro' ),
				'featured_products'		 => __( 'Featured products', 'content-views-pro' ),
				'top_rated_products'	 => __( 'Top rated products', 'content-views-pro' ),
				''						 => __( 'None of above (use other settings below)', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Pro View types
		 *
		 * @return array
		 */
		static function view_type_pro() {
			$result = array(
				'pinterest'	 => __( 'Pinterest', 'content-views-pro' ),
				'masonry'	 => __( 'Masonry', 'content-views-pro' ),
				'timeline'	 => __( 'Timeline', 'content-views-pro' ),
				'glossary'	 => __( 'Glossary', 'content-views-pro' ),
				'one_others' => __( 'One and others', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Pagination alignment options
		 *
		 * @return array
		 */
		static function pagination_alignment() {

			$result = array(
				'left'	 => __( 'Left' ),
				'center' => __( 'Center' ),
				'right'	 => __( 'Right' ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'pagination_alignment', $result );

			return $result;
		}

		/**
		 * Font families
		 *
		 * @return array
		 */
		static function font_families() {
			$fonts_data		 = PT_CV_Functions_Pro::get_google_fonts();
			$font_families	 = array_keys( $fonts_data );

			$result			 = array();
			$result[ '' ]	 = __( '- Default font -', 'content-views-pro' );

			foreach ( $font_families as $font ) {
				$result[ $font ] = $font;
			}

			return $result;
		}

		/**
		 * Font styles
		 *
		 * @return array
		 */
		static function font_styles() {
			$styles = array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' );

			$result			 = array();
			$result[ '' ]	 = __( '- Default weight, style -', 'content-views-pro' );

			foreach ( $styles as $style ) {
				$result[ $style ] = ($style === 'regular') ? 'normal' : $style;
			}

			return $result;
		}

		static function font_decoration() {
			$styles = array(
				'none'		 => __( 'None' ),
				'underline'	 => __( 'Underline', 'content-views-pro' ),
			);

			$result			 = array();
			$result[ '' ]	 = __( '- Default decoration -', 'content-views-pro' );

			foreach ( $styles as $style ) {
				$result[ $style ] = $style;
			}

			return $result;
		}

		/**
		 * Array of a - z characters
		 */
		static function array_a_z() {
			$characters = range( 'a', 'z' );

			$result = array_combine( $characters, $characters );

			return array_merge( array( __( 'Select character', 'content-views-pro' ) ), $result );
		}

		/**
		 * Text direction
		 */
		static function text_direction() {
			$result = array(
				'ltr'	 => __( 'Left to Right', 'content-views-pro' ),
				'rtl'	 => __( 'Right to Left', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Taxonomy filter style
		 */
		static function taxonomy_filter_style( $class = 'filter-bar' ) {
			$items	 = array( 'Lorem', 'Taxo' );
			$class	 = PT_CV_PREFIX . $class;

			$result = array(
				'btn-group'			 => PT_CV_Html_Pro::filter_html_btn_group( $class, $items ),
				'vertical-dropdown'	 => PT_CV_Html_Pro::filter_html_vertical_dropdown( $class, $items ),
				'breadcrumb'		 => PT_CV_Html_Pro::filter_html_breadcrumb( $class, $items ),
				'group_by_taxonomy'	 => __( 'Group by Taxonomy', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Taxonomy filter position
		 */
		static function taxonomy_filter_position() {
			$result = array(
				'left'	 => __( 'Left' ),
				'center' => __( 'Center' ),
				'right'	 => __( 'Right' ),
			);

			return $result;
		}

		/**
		 * List of custom fields
		 */
		static function custom_fields( $include_empty = false ) {
			global $wpdb;

			$keys = $wpdb->get_col(
				"SELECT meta_key
				FROM $wpdb->postmeta
				GROUP BY meta_key
				ORDER BY meta_key"
			);
			if ( $keys ) {
				natcasesort( $keys );
			}

			// Final result
			$result = $include_empty ? array( '' => sprintf( '- %s -', __( 'Select' ) ) ) : array();
			foreach ( $keys as $key ) {
				/**
				 * Don't hide protected meta fields, to able to select data of The Events Calendar...
				 * @since 1.6.5
				 *
				  if ( is_protected_meta( $key, 'post' ) ) {
				  continue;
				  }
				 *
				 */
				$result[ esc_attr( $key ) ] = esc_html( $key );
			}

			// Sort values of param by saved order
			$result = apply_filters( PT_CV_PREFIX_ . 'settings_sort_single', $result, 'custom-fields-list' );

			return $result;
		}

		/**
		 * Post date options
		 */
		static function post_date() {
			$result = array(
				'today'			 => __( 'Today' ),
				'custom_date'	 => __( 'Custom date', 'content-views-pro' ),
				'from_today'	 => __( 'Today and future', 'content-views-pro' ),
				'custom_time'	 => __( 'Custom time (from &rarr; to)', 'content-views-pro' ),
				'yesterday'		 => __( 'Yesterday', 'content-views-pro' ),
				'week_ago'		 => __( '1 week ago (to today)', 'content-views-pro' ),
				'this_week'		 => __( 'This week', 'content-views-pro' ),
				'month_ago'		 => __( '1 month ago (to today)', 'content-views-pro' ),
				'this_month'	 => __( 'This month', 'content-views-pro' ),
				'year_ago'		 => __( '1 year ago (to today)', 'content-views-pro' ),
				'this_year'		 => __( 'This year', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Post align options
		 */
		static function text_align() {
			$result = array(
				'left'		 => __( 'Left' ),
				'right'		 => __( 'Right' ),
				'center'	 => __( 'Center' ),
				'justify'	 => __( 'Justify', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Show what from parent page
		 */
		static function parent_page_options() {
			$result = array(
				''			 => sprintf( '- %s -', __( 'Select' ) ),
				'children'	 => __( 'Show its children', 'content-views-pro' ),
				'siblings'	 => __( 'Show its siblings', 'content-views-pro' ),
				'all'		 => __( 'Show its children & siblings', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Show what from parent page
		 */
		static function parent_page_info() {
			$result = array(
				''			 => __( 'None' ),
				'title'		 => __( 'Title' ),
				'title_link' => __( 'Title & Link', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Custom field types
		 */
		static function custom_field_type() {
			$result = array(
				'CHAR'		 => __( 'Text', 'content-views-pro' ),
				'NUMERIC'	 => __( 'Number', 'content-views-pro' ),
				'DATE'		 => __( 'Date' ),
				'BINARY'	 => __( 'True/False', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * Setting options for Sticky posts
		 */
		static function sticky_posts() {
			$result = array(
				'exclude'		 => __( 'Exclude from output', 'content-views-pro' ),
				'default'		 => __( 'Show in natural position', 'content-views-pro' ),
				'prepend-all'	 => __( 'Place all sticky posts at the top of list', 'content-views-pro' ),
				'prepend'		 => __( 'Place current sticky posts (which match all settings) at the top of list', 'content-views-pro' ),
			);

			return $result;
		}

		/**
		 * List of social buttons
		 */
		static function social_buttons() {
			$result = array(
				'facebook'	 => __( 'Facebook', 'content-views-pro' ),
				'twitter'	 => __( 'Twitter', 'content-views-pro' ),
				'googleplus' => __( 'Google Plus', 'content-views-pro' ),
				'linkedin'	 => __( 'Linkedin', 'content-views-pro' ),
				'pinterest'	 => __( 'Pinterest', 'content-views-pro' ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'social_buttons', $result );

			return $result;
		}

		/**
		 * Animation effects for content
		 * @return type
		 */
		static function content_animation() {
			$result = array(
				''			 => __( 'Fade in', 'content-views-pro' ),
				'effect-lr'	 => __( 'Slide left right', 'content-views-pro' ),
				'effect-ud'	 => __( 'Slide up down', 'content-views-pro' ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'content_animation', $result );

			return $result;
		}

		static function term_filter_custom() {
			$result = array(
				''			 => __( 'None' ),
				'as_output'	 => __( 'Show terms as output', 'content-views-pro' ),
				'as_heading' => __( 'Show (first) term as heading of output', 'content-views-pro' ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'term_filter_custom', $result );

			return $result;
		}

		/**
		 * View format of Layout: One and others
		 * @return type
		 */
		static function view_format_one_and_others() {
			$label	 = __( 'One post %s other posts', 'content-views-pro' );
			$icon	 = '<code><span class="dashicons dashicons-arrow-%s-alt" style="margin-top: 4px;"></span>%s</code>';
			$result	 = array(
				'2'	 => sprintf( $label, sprintf( $icon, 'left', __( 'on left of', 'content-views-pro' ) ) ),
				'1'	 => sprintf( $label, sprintf( $icon, 'up', __( 'above of', 'content-views-pro' ) ) ),
			);

			return $result;
		}

		static function width_prop_one_and_others() {
			$result = array(
				'6-6'	 => '1 : 1',
				'8-4'	 => '2 : 1',
				'4-8'	 => '1 : 2',
			);

			return $result;
		}

		/**
		 * Fields to display of other posts
		 * @return type
		 */
		static function one_others_fields() {
			$result = array(
				'thumbnail'		 => __( 'Thumbnail' ),
				'title'			 => __( 'Title' ),
				'meta-fields'	 => __( 'Date' ),
				'content'		 => __( 'Excerpt' ),
				'readmore'		 => __( 'Read More', 'content-views-query-and-display-post-page' ),
				'custom-fields'	 => __( 'Custom Fields' ),
				'full-content'	 => __( 'Full Content' ),
			);

			return $result;
		}

		/**
		 * Option to display taxonomy
		 * @return type
		 */
		static function meta_field_taxonomy_display_what() {
			$result = array(
				''				 => __( 'All terms of post', 'content-views-pro' ),
				'custom_taxo'	 => __( 'Let me choose', 'content-views-pro' ),
			);

			return $result;
		}

		static function meta_field_author_settings() {
			$result = array(
				''				 => __( 'Show name', 'content-views-pro' ),
				'author_avatar'	 => __( 'Show avatar', 'content-views-pro' ),
			);

			return $result;
		}

		static function manual_excerpt_settings() {
			$result = array(
				'yes'	 => __( 'Show it (but trim its length, format it... like generated excerpt)', 'content-views-pro' ),
				'origin' => __( 'Show its original content', 'content-views-pro' ),
				''		 => __( 'Ignore it', 'content-views-pro' ),
			);

			return $result;
		}

	}

}