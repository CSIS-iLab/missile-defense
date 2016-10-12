<?php

/**
 * HTML output, class, id generating
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Html_Pro' ) ) {

	/**
	 * @name PT_CV_Html_Pro
	 * @todo related HTML functions: Define HTML layout, Set class name...
	 */
	class PT_CV_Html_Pro {
		/**
		 * Scripts for Preview & WP frontend
		 */
		static function frontend_scripts() {
			PT_CV_Asset::enqueue(
				'public-pro', 'script', array(
				'src'	 => plugins_url( 'public/assets/js/cvpro.min.js', PT_CV_FILE_PRO ),
				'deps'	 => array( 'jquery' ),
				'ver'	 => PT_CV_VERSION_PRO,
				)
			);
		}

		/**
		 * Styles for Preview & WP frontend
		 */
		static function frontend_styles() {
			// Public style (some small line of codes are printed directly below)
			PT_CV_Asset::enqueue(
				'public-pro', 'style', array(
				'src'	 => plugins_url( 'public/assets/css/cvpro.min.css', PT_CV_FILE_PRO ),
				'ver'	 => PT_CV_VERSION_PRO,
				)
			);
		}

		/**
		 * Generate style for view with view id and font settings
		 *
		 * @param string $view_id     The unique id of view
		 * @param array  $view_styles The style settings of this view
		 *
		 * @return string The css of this view
		 */
		static function view_styles( $view_styles ) {
			if ( !isset( $view_styles[ 'font' ] ) ) {
				return '';
			}

			// Output Css
			global $pt_cv_glb, $pt_cv_id;
			$prefix	 = PT_CV_PREFIX;
			$view_id = $prefix . 'view-' . $pt_cv_id;

			$css = !empty( $pt_cv_glb[ 'view_styles' ] ) ? $pt_cv_glb[ 'view_styles' ] : array();

			// Store link to google fonts
			$font_links = array();

			// Generate CSS of margin, padding settings
			self::_style_margin( $view_id, $view_styles[ 'margin' ], $css );
			self::_style_margin( $view_id, $view_styles[ 'item-margin' ], $css, ".{$prefix}content-item" );
			self::_style_margin( $view_id, $view_styles[ 'item-padding' ], $css, PT_CV_Functions_Pro::is_pin_mas() ? ".{$prefix}pinmas" : ".{$prefix}content-item", 'padding' );

			/**
			 * @since 3.8.1
			 */
			$view_type = PT_CV_Functions_Pro::is_pin_mas();
			if ( $view_type ) {
				$is_pinterest	 = ($view_type === 'pinterest');
				$padding		 = array_merge( array( 'left' => '', 'right' => '' ), $view_styles[ 'item-padding' ] );
				$default		 = $is_pinterest ? 10 : 4;

				$margin_left	 = -((trim( $padding[ 'left' ] ) !== '') ? intval( $padding[ 'left' ] ) : $default);
				$margin_right	 = -((trim( $padding[ 'right' ] ) !== '') ? intval( $padding[ 'right' ] ) : $default);

				$pin_no_shadow = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pinterest-box-style' );
				if ( $is_pinterest && empty( $pin_no_shadow ) ) {
					$margin_left += 5;
					$margin_right += 5;
				}

				$css[] = sprintf( '#%s { margin-left: %spx !important; margin-right: %spx !important; }', $view_id, $margin_left, $margin_right );
			}

			// Generate CSS of font settings
			$style_settings = apply_filters( PT_CV_PREFIX_ . 'style_settings_data', $view_styles[ 'font' ] );
			self::_style_font( $view_id, $style_settings, $css, $font_links );

			// Border radius
			if ( !empty( $view_styles[ 'border-radius' ] ) ) {
				$border_radius	 = $view_styles[ 'border-radius' ];
				$css[]			 = sprintf( '#%1$s .img-rounded, #%1$s .' . PT_CV_PREFIX . 'mask { -webkit-border-radius: %2$spx %3$s; -moz-border-radius: %2$spx %3$s; border-radius: %2$spx %3$s; }', $view_id, (int) $border_radius, '!important' );
			}

			/**
			 * Image custom size
			 * Disable on Mobile - 1.8.9
			 * Able to resize to same width, height - 1.8.9
			 * Enable force same width, height if size = custom - 2.4.2
			 * Disable force same width, height (allow to enable/disable) if size = custom - 3.1
			 */
			$force_dimensions = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'field-thumbnail-same-' );

			if ( !PT_CV_Functions_Pro::is_mobile() ) {
				$dimensions	 = PT_CV_Functions::get_global_variable( 'image_sizes' );
				$item_class	 = ".{$prefix}href-thumbnail";
				$selector	 = "#$view_id $item_class img, #$view_id $item_class iframe";
				$media_css	 = "@media (min-width: 992px) { %s }";

				if ( !empty( $force_dimensions[ 'width' ] ) && !empty( $dimensions[ 0 ] ) ) {
					$css[] = sprintf( $media_css, "$selector { width: {$dimensions [ 0 ]}px !important; }" );
				}

				if ( !empty( $force_dimensions[ 'height' ] ) && !empty( $dimensions[ 1 ] ) ) {
					$css[] = sprintf( $media_css, "$selector { height: {$dimensions [ 1 ]}px !important; }" );
				}

				// For One and others layout
				$dimensions_others = PT_CV_Functions::get_global_variable( 'image_sizes_others' );
				if ( isset( $dimensions_others ) ) {
					// Update item_class & selector
					$item_class	 = ".{$prefix}ooc:nth-child(2) " . $item_class;
					$selector	 = "#$view_id $item_class img, #$view_id $item_class iframe";

					$css[] = sprintf( $media_css, "$selector { width: {$dimensions_others [ 0 ]}px !important; }" );

					# Maybe disable set height to prevent distort image
					if ( apply_filters( PT_CV_PREFIX_ . 'force_height_other_posts', true ) ) {
						$css[] = sprintf( $media_css, "$selector { height: {$dimensions_others [ 1 ]}px !important; }" );
					}
				}
			}

			// Other styles
			if ( isset( $view_styles[ 'others' ] ) ) {
				$other_styles = $view_styles[ 'others' ];

				if ( !empty( $other_styles[ 'text-align' ] ) ) {
					$css[] = sprintf( '#%s { text-align: %s; }', $view_id, $other_styles[ 'text-align' ] );
				}
			}

			// Hover: margin-top for first field
			$animation		 = PT_CV_Functions::get_global_variable( 'animation' );
			$hover_enable	 = isset( $animation[ 'content-hover' ] ) && PT_CV_Functions_Pro::check_dependences( 'content-hover' );
			if ( $hover_enable ) {
				$field_margin_top = isset( $animation[ 'ff-margin-top' ] ) ? $animation[ 'ff-margin-top' ] : '';
				if ( !empty( $field_margin_top ) ) {
					$first_field = "#$view_id .{$prefix}mask [class^='{$prefix}animation']:first-child";
					$css[]		 = sprintf( '%s { margin-top: %spx !important; }', $first_field, $field_margin_top );
				}
			}

			return array(
				'css'	 => implode( "\n", $css ),
				'links'	 => $font_links,
			);
		}

		/**
		 * Generate CSS of margin settings
		 *
		 * @param string $view_id The unique id of view
		 * @param array  $margin  The margin settings of this view
		 * @param type   $css     Store generated CSS
		 * @param type   $item_selector     No thing or each content item
		 * @param type   $css_property      Padding or Margin
		 */
		static function _style_margin( $view_id, $margin, &$css, $item_selector = '', $css_property = 'margin' ) {

			$options = array( 'top', 'left', 'bottom', 'right' );

			$margin_css = array();

			foreach ( $options as $option ) {
				if ( isset( $margin[ $option ] ) && trim( $margin[ $option ] ) !== '' ) {
					$margin_css[] = sprintf( '%s-%s: %spx !important;', $css_property, $option, $margin[ $option ] );
				}
			}

			if ( $margin_css ) {
				$css[] = sprintf( '#%s %s { %s }', $view_id, $item_selector, implode( ' ', $margin_css ) );
			}
		}

		/**
		 * Generate CSS for font settings
		 *
		 * @param string $view_id    The unique id of view
		 * @param array  $fonts_data The font settings of this view
		 * @param type   $css        Store generated CSS
		 * @param type   $font_links Store generated font link to including
		 */
		static function _style_font( $view_id, $fonts_data, &$css, &$font_links ) {

			$properties = array( 'family', 'style', 'size', 'color', 'bgcolor', 'decoration' );

			// CSS selector for each field
			$prefix					 = PT_CV_PREFIX;
			$view_related_selector	 = "#$view_id ";
			$pagination_wrapper		 = "$view_related_selector + .{$prefix}pagination-wrapper";
			$fields_selectors		 = array(
				'content-item'		 => '',
				'pinmas'			 => '',
				'title'				 => "a, $view_related_selector .panel-title",
				'title-hover'		 => array( '_EMPTY_', "$view_related_selector .{$prefix}title a:hover, $view_related_selector .panel-title:hover" ),
				'content'			 => '',
				'mask'				 => '',
				'carousel-caption'	 => '',
				'meta-fields'		 => '*',
				'specialp'			 => '*',
				'pficon'			 => '',
				'custom-fields'		 => '*',
				'price'				 => array( '_EMPTY_', "$view_related_selector .add_to_cart_button, $view_related_selector .add_to_cart_button *" ),
				'woosale'			 => array( '_EMPTY_', "$view_related_selector .woocommerce-onsale" ),
				'readmore'			 => '',
				'more'				 => array( ", $pagination_wrapper .pagination .active a", $pagination_wrapper ),
				'filter-bar'		 => array( "*, .{$prefix}filter-title, .{$prefix}filter-bar.breadcrumb .active a", '', 'append_selector' => ":not( .{$prefix}filter-group ):not( .breadcrumb )" ),
				'gls-header'		 => '',
				'tao'				 => '',
			);
			$fields					 = array_keys( $fields_selectors );

			// Unset keys if features are not enabled
			if ( !PT_CV_Functions::get_global_variable( 'enable_shuffle_filter' ) ) {
				unset( $fields[ array_search( 'filter-bar', $fields ) ] );
			}

			// Css properties of fields
			$fields_css	 = array();
			$font_css	 = array();

			// Get properties of fields from settings array
			foreach ( $fields as $field ) {
				foreach ( $properties as $property ) {
					if ( !empty( $fonts_data[ "$property-$field" ] ) ) {
						$fields_css[ $field ][ $property ] = $fonts_data[ "$property-$field" ];
					}
				}
			}

			// Backward compatibility
			if ( !empty( $fields_css[ 'content' ][ 'bgcolor' ] ) ) {
				$tfields = array();

				// Scrollable Caption
				if ( PT_CV_Functions::get_global_variable( 'view_type' ) === 'scrollable' ) {
					$tfields[] = 'carousel-caption';
				}

				// Hover animation
				if ( PT_CV_Functions::get_global_variable( 'content_hover_enable' ) ) {
					$tfields[] = 'mask';
				}

				// Apply content bgcolor of these fields
				foreach ( $tfields as $tfield ) {
					if ( empty( $fields_css[ $tfield ][ 'bgcolor' ] ) ) {
						$fields_css[ $tfield ][ 'bgcolor' ] = $fields_css[ 'content' ][ 'bgcolor' ];
					}
				}

				if ( $tfields ) {
					unset( $fields_css[ 'content' ][ 'bgcolor' ] );
				}
			}

			// New Pinterest: use bg color for pinmas element
			if ( PT_CV_Functions_Pro::is_pin_mas() && isset( $fields_css[ 'content-item' ][ 'bgcolor' ] ) ) {
				$fields_css[ 'pinmas' ] = array( 'bgcolor' => $fields_css[ 'content-item' ][ 'bgcolor' ] );
				unset( $fields_css[ 'content-item' ][ 'bgcolor' ] );
			}

			// Generate output font Css for fields
			foreach ( $fields as $field ) {
				$field_css = array();
				foreach ( $properties as $property ) {
					if ( !empty( $fields_css[ $field ][ $property ] ) ) {
						$property_val = $fields_css[ $field ][ $property ];

						switch ( $property ) {
							// Font family
							case 'family':
								$field_css[] = sprintf( "font-family: '%s', Arial, serif", $property_val );

								break;

							// Font style
							case 'style':
								$style = $property_val;
								if ( $style !== '' ) {
									$font_weight = $font_style	 = '';

									// Get font style, weight
									if ( $style === 'regular' ) {
										$font_weight = '400';
										$font_style	 = 'normal';
									} else {
										if ( $style === 'italic' ) {
											$font_style = 'italic';
										} else {
											$font_style_ = substr( $style, - 6 );

											if ( $font_style_ === 'italic' ) {
												$font_weight = substr( $style, 0, strlen( $style ) - 6 );
												$font_style	 = 'italic';
											} else {
												$font_weight = $style;
											}
										}
									}

									// Apply font style, weight
									if ( $font_style ) {
										$field_css[] = sprintf( 'font-style: %s', $font_style );
									}
									if ( $font_weight ) {
										$field_css[] = sprintf( 'font-weight: %s', $font_weight );
									}
								}

								break;

							// Font size
							case 'size':
								$font_size	 = (int) $property_val;
								$field_css[] = sprintf( 'font-size: %spx', $font_size );

								// Auto add line-height if font-size >= 40
								if ( $font_size >= 40 ) {
									$field_css[] = sprintf( 'line-height: %spx', $font_size );
								}

								break;

							// Font color
							case 'color':
								if ( $field === 'readmore' && PT_CV_Functions_Pro::check_dependences( 'text-link' ) && $property_val === '#ffffff' ) {
									break;
								}

								$field_css[] = sprintf( 'color: %s', $property_val );

								break;

							// Background color
							case 'bgcolor':
								if ( $field === 'readmore' && PT_CV_Functions_Pro::check_dependences( 'text-link' ) ) {
									break;
								}

								$field_css[] = sprintf( 'background: %s', $property_val );

								break;

							// Decoration
							case 'decoration':
								$field_css[] = sprintf( 'text-decoration: %s', strtolower( $property_val ) );

								break;
						}
					}
				}

				// Force important to preventing overwritten by other styles
				foreach ( $field_css as $idx => $value ) {
					$field_css[ $idx ] = $value . ' !important;';
				}

				// Only include if CSS property is not null
				if ( $field_css ) {
					$field_selector	 = (array) $fields_selectors[ $field ];
					$append_selector = !empty( $field_selector[ 'append_selector' ] ) ? $field_selector[ 'append_selector' ] : '';

					$p_selector	 = '.' . PT_CV_PREFIX . $field . $append_selector;
					$c_selector	 = $field_selector[ 0 ];
					if ( $field_selector[ 0 ] == '_EMPTY_' ) {
						$p_selector	 = $c_selector	 = '';
					}

					$font_css[ $field ] = sprintf( '%s %s { %s }', $p_selector, $c_selector, implode( ' ', $field_css ) );
				}
			}

			// Prepend view id to each css property
			foreach ( $font_css as $field => $value ) {
				$field_selector		 = (array) $fields_selectors[ $field ];
				$_selector			 = $view_related_selector;
				$prepend_selector	 = isset( $field_selector[ 1 ] ) ? $field_selector[ 1 ] . ' ' : $_selector;

				$css[] = $prepend_selector . $value;
			}

			// Generate font links
			foreach ( $fields as $field ) {
				$font_link = '';

				if ( !empty( $fields_css[ $field ][ 'family' ] ) ) {
					$font_link .= $fields_css[ $field ][ 'family' ];
				}
				if ( !empty( $font_link ) && !empty( $fields_css[ $field ][ 'style' ] ) ) {
					$font_link .= ':' . $fields_css[ $field ][ 'style' ];
				}

				if ( !empty( $font_link ) ) {
					$font_links[] = $font_link;
				}
			}
		}

		/**
		 * Filter output: buttons group
		 *
		 * @param string $class The wrapper class of group
		 * @param array  $items The content of buttons
		 * @param string $id    The ID of filter group
		 *
		 * @return string
		 */
		static function filter_html_btn_group( $class, $items, $id = 'sample', $idx_tax = 0, $btn_style = 'btn-primary' ) {
			$items_html = array();

			$all_text	 = PT_CV_Functions_Pro::shuffle_filter_group_setting( $idx_tax );
			$items		 = array( 'all' => $all_text ) + $items;

			$idx = 0;
			foreach ( $items as $key => $text ) {
				$item_class		 = implode( ' ', array( 'btn', $btn_style, PT_CV_PREFIX . 'filter-option', ( $idx == 0 ) ? 'active' : '' ) );
				$items_html[]	 = sprintf( '<button type="button" class="%s" data-value="%s" data-sftype="button">%s</button>', $item_class, $key, $text );
				$idx ++;
			}
			$output = sprintf( '<div class="btn-group %s" id="%s">%s</div>', esc_attr( $class ), esc_attr( $id ), implode( '', $items_html ) );

			return $output;
		}

		/**
		 * Generate HTML output for array of items
		 *
		 * @return array
		 */
		static function _filter_list( $type, $items, $idx_tax = 0 ) {
			$items_html = array();

			$all_text	 = PT_CV_Functions_Pro::shuffle_filter_group_setting( $idx_tax );
			$items		 = array( 'all' => $all_text ) + $items;

			$idx = 0;
			foreach ( $items as $key => $text ) {
				$items_html[] = sprintf( '<li class="%s"><a href="#" class="%s" data-value="%s" data-sftype="%s">%s</a></li>', ( $idx == 0 ) ? 'active' : '', PT_CV_PREFIX . 'filter-option', esc_attr( $key ), $type, $text );
				$idx ++;
			}

			return $items_html;
		}

		/**
		 * Filter output: Breadcrumb
		 *
		 * @param string $class The wrapper class of group
		 * @param array  $items The content of buttons
		 *
		 * @return string
		 */
		static function filter_html_breadcrumb( $class, $items, $id = 'sample', $idx_tax = 0 ) {
			$items_html	 = self::_filter_list( 'breadcrumb', $items, $idx_tax );
			$output		 = sprintf( '<ol class="breadcrumb %s" id="%s">%s</ol>', esc_attr( $class ), esc_attr( $id ), implode( '', $items_html ) );

			return $output;
		}

		/**
		 * Filter output: Vertical dropdown
		 *
		 * @param string $class The wrapper class of group
		 * @param array  $items The content of buttons
		 * @param type   $id    The ID of filter bar
		 *
		 * @return string
		 */
		static function filter_html_vertical_dropdown( $class, $items, $id = 'dropdownMenu1', $idx_tax = 0, $btn_style = 'btn-primary' ) {
			$all_text = PT_CV_Functions_Pro::shuffle_filter_group_setting( $idx_tax );

			$items_html	 = self::_filter_list( 'dropdown', $items, $idx_tax );
			$output		 = sprintf(
				'<div class="dropdown btn-group %s" id="%s">
				<button class="btn %s dropdown-toggle" type="button" data-toggle="dropdown">%s<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
				%s
				</ul>
			</div>', esc_attr( $class ), esc_attr( $id ), $btn_style, $all_text, implode( '', $items_html )
			);

			return $output;
		}

		/**
		 * Display menu of Glossary list
		 *
		 * @param array $characters
		 */
		static function glossary_menu( $characters ) {
			$lis = array();

			// Sort A-Z by Heading
			asort( $characters );

			// Prepend "All"
			if ( $characters ) {
				array_unshift( $characters, __( 'All', 'content-views-pro' ) );
			}

			foreach ( $characters as $idx => $character ) {
				$href	 = PT_CV_PREFIX . 'gls-' . esc_attr( $character );
				$class	 = $idx == 0 ? 'class="pt-active"' : '';
				$text	 = esc_html( $character );
				$lis[]	 = sprintf( '<li><a href="#%s" %s>%s</a></li>', $href, $class, $text );
			}

			return sprintf( '<ul class="%s">%s</ul>', PT_CV_PREFIX . 'gls-menu', implode( '', $lis ) );
		}

		static function custom_readmore( $href ) {
			$dargs	 = PT_CV_Functions::get_global_variable( 'dargs' );
			$fargs	 = isset( $dargs[ 'field-settings' ] ) ? $dargs[ 'field-settings' ] : array();

			$btn_class			 = apply_filters( PT_CV_PREFIX_ . 'field_content_readmore_class', 'btn btn-success', $fargs );
			$default_readmore	 = ucwords( rtrim( __( 'Read more...' ), '.' ) );
			$text				 = apply_filters( PT_CV_PREFIX_ . 'field_content_readmore_text', $default_readmore, $fargs[ 'content' ] );

			return sprintf(
				'<a href="%s" class="%s" target="%s" %s>%s</a>', $href, PT_CV_PREFIX . 'readmore ' . $btn_class, '_blank', null, $text
			);
		}

	}

}