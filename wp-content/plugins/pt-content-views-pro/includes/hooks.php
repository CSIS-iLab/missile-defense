<?php

/**
 * Custom filters/actions
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Hooks_Pro' ) ) {

	/**
	 * @name PT_CV_Hooks_Pro
	 */
	class PT_CV_Hooks_Pro {
		/**
		 * Add custom filters/actions
		 */
		static function init() {
			// Filter Output
			add_filter( PT_CV_PREFIX_ . 'view_settings', array( __CLASS__, 'filter_view_settings' ) );
			add_filter( PT_CV_PREFIX_ . 'regular_orderby', array( __CLASS__, 'filter_regular_orderby' ) );
			add_filter( PT_CV_PREFIX_ . 'found_posts', array( __CLASS__, 'filter_found_posts' ) );
			add_filter( PT_CV_PREFIX_ . 'post_type', array( __CLASS__, 'filter_post_type' ) );
			add_filter( PT_CV_PREFIX_ . 'post_status', array( __CLASS__, 'filter_post_status' ) );
			add_filter( PT_CV_PREFIX_ . 'settings_args_offset', array( __CLASS__, 'filter_settings_args_offset' ) );
			add_filter( PT_CV_PREFIX_ . 'field_thumbnail_dimension_output', array( __CLASS__, 'filter_field_thumbnail_dimensions' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_thumbnail_image', array( __CLASS__, 'filter_field_thumbnail_image' ), 10, 4 );
			add_filter( PT_CV_PREFIX_ . 'force_replace_thumbnail', array( __CLASS__, 'filter_force_replace_thumbnail' ) );
			add_filter( PT_CV_PREFIX_ . 'field_thumbnail_not_found', array( __CLASS__, 'filter_field_thumbnail_not_found' ), 10, 4 );
			add_filter( PT_CV_PREFIX_ . 'btn_more_html', array( __CLASS__, 'filter_btn_more_html' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'pagination_class', array( __CLASS__, 'filter_pagination_class' ) );
			add_filter( PT_CV_PREFIX_ . 'field_href_attrs', array( __CLASS__, 'filter_field_href_attrs' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'field_href_no_link', array( __CLASS__, 'filter_field_href_no_link' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_href', array( __CLASS__, 'filter_field_href' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_meta_author_html', array( __CLASS__, 'filter_field_meta_author_html' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_meta_merge_fields', array( __CLASS__, 'filter_field_meta_merge_fields' ) );
			add_filter( PT_CV_PREFIX_ . 'field_meta_seperator', array( __CLASS__, 'filter_field_meta_seperator' ) );
			add_filter( PT_CV_PREFIX_ . 'meta_field_html', array( __CLASS__, 'filter_meta_field_html' ) );
			add_filter( PT_CV_PREFIX_ . 'field_meta_prefix_text', array( __CLASS__, 'filter_field_meta_prefix_text' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_meta_date_final', array( __CLASS__, 'filter_field_meta_date_final' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_item_html', array( __CLASS__, 'filter_field_item_html' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'field_content_readmore_enable', array( __CLASS__, 'filter_field_content_readmore_enable' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_content_readmore_text', array( __CLASS__, 'filter_field_content_readmore_text' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_content_readmore_class', array( __CLASS__, 'filter_field_content_readmore_class' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_content_readmore_seperated', array( __CLASS__, 'filter_field_content_readmore_seperated' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_title_result', array( __CLASS__, 'filter_field_title_result' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'field_content_excerpt', array( __CLASS__, 'filter_field_content_excerpt' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'trim_length_excerpt', array( __CLASS__, 'filter_trim_length_excerpt' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'field_excerpt_dots', array( __CLASS__, 'filter_field_excerpt_dots' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'field_thumbnail_setting_values', array( __CLASS__, 'filter_field_thumbnail_setting_values' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'view_type_asset', array( __CLASS__, 'filter_view_type_asset' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'dargs_others', array( __CLASS__, 'filter_dargs_others' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'view_type_dir', array( __CLASS__, 'filter_view_type_dir' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'view_type_dir_special', array( __CLASS__, 'filter_view_type_dir_special' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'scrollable_toggle_icon', array( __CLASS__, 'filter_scrollable_toggle_icon' ) );
			add_filter( PT_CV_PREFIX_ . 'scrollable_interval', array( __CLASS__, 'filter_scrollable_interval' ) );
			add_filter( PT_CV_PREFIX_ . 'scrollable_fields_enable', array( __CLASS__, 'filter_scrollable_fields_enable' ) );
			add_filter( PT_CV_PREFIX_ . 'page_attr', array( __CLASS__, 'filter_page_attr' ), 10, 3 );
			add_filter( PT_CV_PREFIX_ . 'wrap_in_page', array( __CLASS__, 'filter_wrap_in_page' ) );
			add_filter( PT_CV_PREFIX_ . 'content_items_wrap', array( __CLASS__, 'filter_content_items_wrap' ), 10, 4 );
			add_filter( PT_CV_PREFIX_ . 'all_display_settings', array( __CLASS__, 'filter_all_display_settings' ) );
			add_filter( PT_CV_PREFIX_ . 'order_setting', array( __CLASS__, 'filter_order_setting' ) );
			add_filter( PT_CV_PREFIX_ . 'validate_settings', array( __CLASS__, 'filter_validate_settings' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'query_parameters', array( __CLASS__, 'filter_query_parameters' ) );
			add_filter( PT_CV_PREFIX_ . 'include_children', array( __CLASS__, 'filter_include_children' ) );
			add_filter( PT_CV_PREFIX_ . 'taxonomy_setting', array( __CLASS__, 'filter_taxonomy_setting' ) );
			add_filter( PT_CV_PREFIX_ . 'display_what', array( __CLASS__, 'filter_display_what' ) );
			add_filter( PT_CV_PREFIX_ . 'view_content', array( __CLASS__, 'filter_view_content' ) );
			add_filter( PT_CV_PREFIX_ . 'taxonomies_to_show', array( __CLASS__, 'filter_taxonomies_to_show' ) );
			add_filter( PT_CV_PREFIX_ . 'taxonomy_query_args', array( __CLASS__, 'filter_taxonomy_query_args' ) );
			add_filter( PT_CV_PREFIX_ . 'shortcode_params', array( __CLASS__, 'filter_shortcode_params' ) );
			add_filter( PT_CV_PREFIX_ . 'view_class', array( __CLASS__, 'filter_view_class' ) );
			add_filter( PT_CV_PREFIX_ . 'assets_files', array( __CLASS__, 'filter_assets_files' ) );
			add_filter( PT_CV_PREFIX_ . 'before_output_html', array( __CLASS__, 'filter_before_output_html' ) );
			add_filter( PT_CV_PREFIX_ . 'content_item_filter_value', array( __CLASS__, 'filter_content_item_filter_value' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'content_no_post_found_text', array( __CLASS__, 'filter_content_no_post_found_text' ) );
			add_filter( PT_CV_PREFIX_ . 'content_items', array( __CLASS__, 'filter_content_items' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'item_col_class', array( __CLASS__, 'filter_item_col_class' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'post__not_in', array( __CLASS__, 'filter_post__not_in' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'post_parent_id', array( __CLASS__, 'filter_post_parent_id' ) );
			add_filter( PT_CV_PREFIX_ . 'show_this_post', array( __CLASS__, 'filter_show_this_post' ) );
			add_filter( PT_CV_PREFIX_ . 'style_settings_data', array( __CLASS__, 'filter_style_settings_data' ) );
			add_filter( PT_CV_PREFIX_ . 'ignore_sticky_posts', array( __CLASS__, 'filter_ignore_sticky_posts' ) );
			add_filter( PT_CV_PREFIX_ . 'fields_html', array( __CLASS__, 'filter_fields_html' ), 10, 2 );
			add_filter( PT_CV_PREFIX_ . 'terms_to_filter', array( __CLASS__, 'filter_terms_to_filter' ) );
			add_filter( PT_CV_PREFIX_ . 'is_mobile', array( __CLASS__, 'filter_is_mobile' ) );
			add_filter( PT_CV_PREFIX_ . 'public_localize_script_extra', array( __CLASS__, 'filter_public_localize_script_extra' ) );

			// Filter WP
			add_filter( 'posts_where_request', array( __CLASS__, 'filter_posts_where_request' ), 10, 2 );
			add_filter( 'posts_request', array( __CLASS__, 'filter_posts_request' ), 10, 2 );

			// Do action
			add_action( PT_CV_PREFIX_ . 'print_view_style', array( __CLASS__, 'action_print_view_style' ) );
			add_action( PT_CV_PREFIX_ . 'before_query', array( __CLASS__, 'action_before_query' ) );
			add_action( PT_CV_PREFIX_ . 'after_query', array( __CLASS__, 'action_after_query' ) );
			add_action( PT_CV_PREFIX_ . 'add_global_variables', array( __CLASS__, 'action_add_global_variables' ) );
			add_action( PT_CV_PREFIX_ . 'handle_teaser', array( __CLASS__, 'action_handle_teaser' ) );
			add_action( PT_CV_PREFIX_ . 'enqueue_assets', array( __CLASS__, 'action_enqueue_assets' ) );
			add_action( PT_CV_PREFIX_ . 'item_extra_html', array( __CLASS__, 'action_item_extra_html' ) );
		}

		/**
		 * Get offset setting value
		 *
		 * @return int
		 */
		static function get_offset_setting() {
			$offset = (int) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'offset', null, 0 );

			return ( $offset < 0 ) ? 0 : $offset;
		}

		/**
		 * Filter View settings, for compatible with older versions
		 *
		 * @param array $args
		 * @return array
		 */
		static function filter_view_settings( $args ) {
			$view_version = !isset( $args[ PT_CV_PREFIX . 'version' ] ) ? 0 : ltrim( $args[ PT_CV_PREFIX . 'version' ], 'pro-' );

			if ( version_compare( $view_version, PT_CV_VERSION_PRO ) === -1 && apply_filters( PT_CV_PREFIX_ . 'backward_360', true ) ) {
				/**
				 * @since 3.6.0
				 */
				if ( !isset( $args[ PT_CV_PREFIX . 'advanced-settings' ] ) ) {
					$args[ PT_CV_PREFIX . 'advanced-settings' ] = array();
				}

				$args[ PT_CV_PREFIX . 'advanced-settings' ][]	 = 'check_access_restriction';
				$args[ PT_CV_PREFIX . 'advanced-settings' ][]	 = 'hide_different_language';

				/**
				 * @since 3.6.3
				 */
				if ( !empty( $args[ PT_CV_PREFIX . 'author-include-current' ] ) ) {
					$args[ PT_CV_PREFIX . 'author-current-user' ] = 'include';
				}
				if ( !empty( $args[ PT_CV_PREFIX . 'author-not-include-current' ] ) ) {
					$args[ PT_CV_PREFIX . 'author-current-user' ] = 'exclude';
				}

				/**
				 * @since 3.7.1
				 */
				$args[ PT_CV_PREFIX . 'custom-fields-enable-oembed' ]		 = 'yes';
				$args[ PT_CV_PREFIX . 'taxonomy-filter-trigger-pagination' ] = 'yes';
			}

			return $args;
		}

		/**
		 * Filter regular orderby: Add meta key option
		 *
		 * @param array $args Array to filter
		 *
		 * @return array
		 */
		static function filter_regular_orderby( $args ) {

			$args = array_merge(
				$args, array(
				'dragdrop'		 => __( 'Drag & Drop', 'content-views-pro' ),
				'name'			 => __( 'Post slug', 'content-views-pro' ),
				'rand'			 => __( 'Random', 'content-views-pro' ),
				'view_count'	 => __( 'View count', 'content-views-pro' ),
				'comment_count'	 => __( 'Comment count', 'content-views-pro' ),
				'menu_order'	 => __( 'Menu order', 'content-views-pro' ),
				)
			);

			return $args;
		}

		/**
		 * Filter total founds post
		 *
		 * @param int $found_posts Total found posts $wp_query->found_posts
		 */
		public static function filter_found_posts( $found_posts ) {
			$view_settings = PT_CV_Functions::get_global_variable( 'view_settings' );

			// Get offset
			$offset = self::get_offset_setting( $view_settings );

			// deduct the custom offset from $wp_query->found_posts
			$found_posts -= $offset;

			return $found_posts;
		}

		/**
		 * Filter post type
		 *
		 * @param string $args
		 * @return string
		 */
		public static function filter_post_type( $args ) {
			/* Fix bug: 'In list' for 'Any post types' does not work
			 * Reason: post_type = any => post_type IN (post types which exclude_from_search = false)
			 * => some wanted post types do not be included, such as event (of Event Managers plugin)
			 */
			if ( $args === 'any' ) {
				$multi_post_types	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'multi-post-types' );
				$args				 = is_array( $multi_post_types ) ? $multi_post_types : get_post_types( array( 'public' => true ) );
			}

			return $args;
		}

		/**
		 * Filter post status to acquire
		 *
		 * @param string $args
		 * @return string
		 */
		public static function filter_post_status( $args ) {

			$date_value = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'post_date_value' );

			// Append 'future' status if querying by date 'Today and future'
			if ( $date_value === 'from_today' ) {
				if ( !in_array( 'future', $args ) ) {
					$args[] = 'future';
				}
			}

			// Query Media, attachment
			if ( PT_CV_Functions::get_global_variable( 'content_type' ) === 'attachment' ) {
				$args = 'any';
			}

			return $args;
		}

		/**
		 * Filter offset for pagination
		 *
		 * @param int $offset The offset value
		 */
		public static function filter_settings_args_offset( $offset ) {
			$view_settings = PT_CV_Functions::get_global_variable( 'view_settings' );

			// Get offset
			$offset_option = self::get_offset_setting( $view_settings );

			$offset += $offset_option;

			// Modify offset
			global $pt_cv_id;
			$has_pagination	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' );
			$current_page	 = PT_CV_Functions::get_global_variable( 'current_page' );
			$apply			 = $has_pagination && $current_page > 1;

			/**
			 * [stickypostlimit]
			 * Decrease offset (when prepend-all sticky posts)
			 */
			$sticky_post = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'sticky-posts' );
			if ( $sticky_post === 'prepend-all' && $apply ) {
				$offset_minus = (int) get_transient( PT_CV_PREFIX . $pt_cv_id . 'offset_decrease_stickyposts' );
				if ( $offset_minus > 0 ) {
					$offset -= $offset_minus;
				}
			}

			/**
			 * Display Content Ads
			 */
			$ads_settings = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'ads-' );
			if ( !empty( $ads_settings[ 'enable' ] ) && $apply ) {
				$per_page		 = (int) $ads_settings[ 'per-page' ];
				$offset_minus	 = ($current_page - 1) * $per_page;

				if ( $offset_minus > 0 ) {
					$offset -= $offset_minus;
				}
			}

			return $offset;
		}

		/**
		 * Filter thumbnail output
		 *
		 * @param string $args  The dimensions (sizes) of thumbnail
		 * @param array  $fargs The settings of this field
		 *
		 * @return array
		 */
		public static function filter_field_thumbnail_dimensions( $args, $fargs ) {
			switch ( $fargs[ 'size' ] ) {
				case PT_CV_PREFIX . 'custom':
					$args = PT_CV_Functions_Pro::field_thumbnail_dimensions( $fargs );

					break;
			}

			// Get exact value of width, height
			global $pt_cv_glb, $pt_cv_id;
			if ( isset( $pt_cv_glb ) && isset( $pt_cv_id ) && !isset( $pt_cv_glb[ $pt_cv_id ][ 'image_sizes' ] ) ) {
				// Get size from name: thumbnail, medium, large ...
				$exact_size = $args;
				if ( count( $args ) == 1 ) {
					$exact_size	 = PT_CV_Functions_Pro::get_dimensions_of_size( $args[ 0 ] );
					$exact_size	 = array_values( $exact_size );
				}

				$pt_cv_glb[ $pt_cv_id ][ 'image_sizes' ] = $exact_size;
			}

			return $args;
		}

		/**
		 * Get image with custom sizes
		 *
		 * @param type $args
		 * @param type $post_id
		 * @param type $dimensions
		 * @return type
		 */
		public static function filter_field_thumbnail_image( $args, $post, $dimensions, $fargs ) {
			// Custom size thumbnail
			$enable_custom_img = apply_filters( PT_CV_PREFIX_ . 'custom_img_generator', true );

			if ( $fargs[ 'size' ] === PT_CV_PREFIX . 'custom' && $enable_custom_img ) {
				$attachment_id = get_post_thumbnail_id( $post->ID );

				// If found attachment & both width and height is available
				if ( $attachment_id && count( $dimensions ) == 2 ) {
					$resized_img = PT_CV_Functions_Pro::resize_image( $attachment_id, $dimensions[ 0 ], $dimensions[ 1 ] );

					if ( $resized_img ) {
						$args	 = preg_replace( '/width="[0-9]+"/', sprintf( 'width="%s"', $dimensions[ 0 ] ), $args );
						$args	 = preg_replace( '/height="[0-9]+"/', sprintf( 'height="%s"', $dimensions[ 1 ] ), $args );
						$args	 = preg_replace( '/http[^\"]+/', $resized_img, $args );
					}
				}
			}

			return $args;
		}

		/**
		 * Force replace featured image by image/audio/video in post content
		 * @param boolean $args
		 * @return boolean
		 */
		public static function filter_force_replace_thumbnail( $args ) {
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-thumbnail-role' ) ) {
				$args = true;
			}

			return $args;
		}

		/**
		 * Filter thumbnail output when no thumbnail found
		 *
		 * @param string $args       HTML output of thumbnail field
		 * @param object $post       The post object
		 * @param array  $dimensions The dimensions of thumbnail
		 * @param array  $gargs      The settings of get_the_post_thumbnail function
		 *
		 * @return array
		 */
		public static function filter_field_thumbnail_not_found( $args, $post, $dimensions, $gargs ) {
			$content_type	 = PT_CV_Functions::get_global_variable( 'content_type' );
			$image_sizes	 = PT_CV_Functions::get_global_variable( 'image_sizes' );
			$dimensions		 = $image_sizes;
			$dimension_ready = $dimensions && !empty( $dimensions[ 0 ] ) && !empty( $dimensions[ 1 ] );

			// Post type = Attachment
			if ( self::_is_attachment( $content_type, $post ) ) {
				$attachment = wp_get_attachment_image( $post->ID, $dimension_ready ? $dimensions : 'medium', true, array( 'class' => $gargs[ 'class' ] ) );
				if ( $attachment ) {
					$args = $attachment;
					return $args;
				}
			}

			// Get image/audio/video from post content
			$original_html	 = $args;
			$found_image	 = $found_video	 = '';
			$display_what	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-thumbnail-auto', null, 'image' );

			if ( $display_what === 'none' ) {
				$args = '';
				return $args;
			}

			// Get image
			$first_img = self::get_inside_image( $post, $dimensions );
			if ( !empty( $first_img ) ) {
				$width_height	 = $dimension_ready ? sprintf( 'width="%1$s" style="width: %1$spx;"', $dimensions[ 0 ] ) : '';
				$found_image	 = sprintf( '<img src="%s" class="%s" %s/>', esc_attr( $first_img ), esc_attr( $gargs[ 'class' ] ), $width_height );
			}

			// Get video
			$found_video = self::get_embed_video( $post, $dimensions, $dimension_ready );

			switch ( $display_what ) {
				case 'video-audio':
					$args	 = $found_video ? $found_video : $found_image;
					break;
				case 'image':
					$args	 = $found_image ? $found_image : $found_video;
					break;
			}

			if ( empty( $args ) ) {
				if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-thumbnail-role' ) && $original_html ) {
					// Use featured image
					$args = $original_html;
				} else {
					// Use default image
					$default_image	 = apply_filters( PT_CV_PREFIX_ . 'default_image', plugins_url( 'public/assets/images/default_image.png', PT_CV_FILE_PRO ) );
					$di_class		 = $gargs[ 'class' ] . ' not-found';
					$width_height	 = $dimension_ready ? "width='{$dimensions[ 0 ]}' height='{$dimensions[ 1 ]}' style='max-height: {$dimensions[ 1 ]}px;'" : '';
					$args			 = "<img $width_height src='$default_image' class='{$di_class}' alt='{$post->post_title}'>";
				}
			}

			return $args;
		}

		/**
		 * Get first image in post content
		 * @param object $post
		 * @param array $dimensions
		 * @return string
		 */
		public static function get_inside_image( $post, $dimensions ) {
			$content = $post->post_content;

			// If contains gallery => execute shortcode
			if ( preg_match( '/\[gallery[^\]]+\]/', $content ) ) {
				ob_start();
				the_content();
				$content = ob_get_clean();
			}

			/**
			 * Update regex since 2.6 to match:
			 * <img src="">
			 * [shortcode_for_image src=""]
			 */
			$matches = array();
			$content = apply_filters( PT_CV_PREFIX_ . 'field_content_excerpt', $content, array(), $post );

			// Formal image
			preg_match_all( '/src=[\'"]([^\'"]+(\.(gif|png|jp(e|g|eg)|bmp|ico|webp|jxr|svg))[^\'"]*)[\'"]/i', $content, $matches );

			// Informal image
			if ( empty( $matches[ 1 ][ 0 ] ) ) {
				preg_match_all( '/(?:<img[^>]*)src=[\'"]([^\'"]+)[\'"]/i', $content, $matches );
			}

			$img = isset( $matches[ 1 ][ 0 ] ) ? $matches[ 1 ][ 0 ] : '';

			// Resize it if requires
			if ( $img ) {
				$img = PT_CV_Functions_Pro::resize_image_by_url( $img, $dimensions );
			}

			return apply_filters( PT_CV_PREFIX_ . 'field_inside_image', $img, $matches, $content );
		}

		/**
		 * Get embed video from post content
		 *
		 * @param object $post
		 * @param string $dimensions
		 * @param bool $dimension_ready
		 * @return string
		 */
		public static function get_embed_video( $post, $dimensions, $dimension_ready = true ) {
			// Get Media URL: Youtube, Vimeo, Dailymotion, Soundcloud
			$media_url = self::extract_video_url( $post->post_content, $post );

			return self::embed_video( $media_url, $dimensions );
		}

		/**
		 * Extract Video URL from content
		 *
		 * @param string $content
		 * @param object $post
		 * @return string
		 */
		public static function extract_video_url( $content, $post ) {
			$media_url = PT_CV_Functions::get_global_variable( 'video_in_content_' . $post->ID );

			if ( $media_url === null ) {
				$matches = array();
				$content = apply_filters( PT_CV_PREFIX_ . 'field_content_excerpt', $content, array(), $post );

				preg_match_all( '|https?://[^\s"\']+|im', $content, $matches );

				// Add custom filter, to deal with URL, like httpv://...
				$matches = apply_filters( PT_CV_PREFIX_ . 'custom_media_thumbnail', $matches, $content );

				// Get URL to embed
				if ( isset( $matches[ 0 ] ) ) {
					foreach ( $matches[ 0 ] as $url ) {
						// If is one of: Youtube, Vimeo, Dailymotion, Soundcloud
						if ( preg_match( '(youtube\.com|youtu\.be|vimeo\.com|dailymotion\.com|soundcloud\.com)', $url ) ) {
							$media_url = $url;
							break;
						}
					}
				}

				PT_CV_Functions::set_global_variable( 'video_in_content_' . $post->ID, $media_url );
			}

			return $media_url;
		}

		/**
		 * Return embed output from video url
		 *
		 * @param string $media_url
		 * @param array $dimensions
		 * @return string
		 */
		public static function embed_video( $media_url, $dimensions ) {
			$args = '';

			// Embed url
			if ( !empty( $media_url ) ) {
				$media_url = esc_url( trim( $media_url, '.' ) );

				// Custom handle for Youtube
				if ( strpos( $media_url, 'youtube' ) !== false ) {
					// Convert to "/watch?v=" format
					if ( strpos( $media_url, 'watch?v=' ) === false ) {
						$media_url = str_replace( 'embed/', 'watch?v=', $media_url );
					}

					// Remove /embed in url & Trim trailing slash
					$media_url = str_replace( '/embed', '', rtrim( $media_url, "/" ) );
				}

				$args = wp_oembed_get( $media_url, !empty( $dimensions[ 0 ] ) ? array( 'width' => $dimensions[ 0 ] ) : array()  );
			}

			return $args;
		}

		/**
		 * Remove Video URL (used as thumbnail) from excerpt
		 *
		 * @param string $content
		 * @param object $post
		 * @return string
		 */
		public static function remove_video_url( $content, $post ) {
			$video_url = self::extract_video_url( $content, $post );

			if ( !empty( $video_url ) ) {
				$content = str_replace( $video_url, '', $content );
			}

			return $content;
		}

		/**
		 * Filter class of pagination button
		 *
		 * @param string $args          HTML output of thumbnail field
		 * @param string $max_num_pages The total of pages
		 * @param string $session_id    The session id of current view
		 *
		 * @return string
		 */
		public static function filter_btn_more_html( $args, $max_num_pages, $session_id ) {

			$dargs				 = PT_CV_Functions::get_global_variable( 'dargs' );
			$dargs_pagination	 = $dargs[ 'pagination-settings' ];

			// Get class of more button
			$more_class = apply_filters( PT_CV_PREFIX_ . 'btn_more_class', PT_CV_PREFIX . 'more' . ' ' . 'btn btn-primary btn-sm' );

			// Get text of more button
			$more_text	 = !empty( $dargs_pagination[ 'loadmore-text' ] ) ? trim( $dargs_pagination[ 'loadmore-text' ] ) : __( 'More', 'content-views-pro' );
			$args		 = sprintf(
				'<button class="%s" data-totalpages="%s" data-nextpages="%s" data-sid="%s">%s <span class="caret"></span></button>', esc_attr( $more_class ), esc_attr( $max_num_pages ), 2, esc_attr( $session_id ), esc_html( $more_text )
			);

			return $args;
		}

		/**
		 * Filter class for pagination
		 *
		 * @param string $args The HTML output of pagination
		 */
		public static function filter_pagination_class( $args ) {

			$dargs				 = PT_CV_Functions::get_global_variable( 'dargs' );
			$dargs_pagination	 = $dargs[ 'pagination-settings' ];

			$alignment = isset( $dargs_pagination[ 'alignment' ] ) ? $dargs_pagination[ 'alignment' ] : 'left';

			$args = sprintf( 'text-%s', $alignment );

			return $args;
		}

		/**
		 * Filter class for <a> tag
		 *
		 * @param array  $custom_attr Custom attributes
		 * @param string $open_in     Open in attribute
		 * @param array  $oargs       The array of Other settings
		 */
		public static function filter_field_href_attrs( $custom_attr, $open_in, $oargs = array() ) {
			// Open in
			$arr = array( PT_CV_PREFIX . 'window' => array( '600', '400' ), PT_CV_PREFIX . 'lightbox' => array( '75', '75' ) );

			if ( in_array( $open_in, array_keys( $arr ) ) ) {
				$open_type = str_replace( PT_CV_PREFIX, '', $open_in );

				$width			 = !empty( $oargs[ "$open_type-size-width" ] ) ? $oargs[ "$open_type-size-width" ] : $arr[ $open_in ][ 0 ];
				$height			 = !empty( $oargs[ "$open_type-size-height" ] ) ? $oargs[ "$open_type-size-height" ] : $arr[ $open_in ][ 1 ];
				$custom_attr []	 = sprintf( 'data-width="%s"', esc_attr( $width ) );
				$custom_attr []	 = sprintf( 'data-height="%s"', esc_attr( $height ) );

				if ( isset( $oargs[ "$open_type-content-selector" ] ) ) {
					$custom_attr[] = sprintf( 'data-content-selector="%s"', esc_attr( $oargs[ "$open_type-content-selector" ] ) );
				}
			}

			// Nofollow
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'link-follow' ) ) {
				$custom_attr[] = 'rel="nofollow"';
			}

			return $custom_attr;
		}

		/**
		 * Whether or not wrap a link, depends on $open_in value
		 *
		 * @param boolean $args    Whether or not wrap a link
		 * @param string  $open_in Open in attribute
		 *
		 * @return string
		 */
		public static function filter_field_href_no_link( $args, $open_in ) {
			if ( $open_in == PT_CV_PREFIX . 'none' ) {
				$args = 1;
			}

			return $args;
		}

		/**
		 * Filter link of post
		 * @param string $args
		 * @param object $post
		 * @return string
		 */
		public static function filter_field_href( $args, $post ) {
			$dargs			 = PT_CV_Functions::get_global_variable( 'dargs' );
			$other_settings	 = $dargs[ 'other-settings' ];

			if ( isset( $other_settings[ 'open-in' ] ) && $other_settings[ 'open-in' ] === PT_CV_PREFIX . 'lightbox-image' ) {
				$content_type	 = PT_CV_Functions::get_global_variable( 'content_type' );
				$new_url		 = '';
				$size			 = apply_filters( PT_CV_PREFIX_ . 'media_file_size', array( 840, 560 ) );

				if ( !self::_is_attachment( $content_type, $post ) ) {
					if ( !has_post_thumbnail( $post->ID ) ) {
						return $args;
					}

					// Get full thumbnail
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
					if ( $large_image_url ) {
						$new_url = $large_image_url[ 0 ];
					}
				} else {
					// Get full size of current attachment
					$image_attributes = wp_get_attachment_image_src( $post->ID, $size );
					if ( $image_attributes ) {
						$new_url = $image_attributes[ 0 ];
					}
				}

				if ( $new_url ) {
					$args = $new_url;
				}
			}

			return $args;
		}

		/**
		 * Filter HTML output of author
		 *
		 * @param string $args The HTML output of author
		 * @param object $post The post object
		 */
		public static function filter_field_meta_author_html( $args, $post ) {
			// Do only if content-hover is not enable
			if ( PT_CV_Functions_Pro::animate_activated_content_hover() ) {
				return $args;
			}

			if ( PT_CV_Functions::get_global_variable( 'view_type' ) === 'timeline' || PT_CV_Functions::setting_value( PT_CV_PREFIX . 'meta-fields-author-settings' ) === 'author_avatar' ) {
				// Sets up global post data
				setup_postdata( $post );

				$author_id	 = get_the_author_meta( 'ID' );
				$args		 = sprintf( '<a href="%s" title="%s %s">%s</a>', esc_url( get_author_posts_url( $author_id ) ), __( 'Posted by', 'content-views-pro' ), get_the_author(), get_avatar( $author_id, 40 ) );
			}

			return $args;
		}

		/**
		 * Merge fields, or let them as seperate items in array
		 *
		 * @param bool $args Whether or not to merge
		 */
		public static function filter_field_meta_merge_fields( $args ) {
			if ( PT_CV_Functions::get_global_variable( 'view_type' ) === 'timeline' ) {
				$args = false;
			}

			return $args;
		}

		/**
		 * Remove seperator between meta fields
		 *
		 * @param string $args The seperator between meta fields
		 */
		public static function filter_field_meta_seperator( $args ) {
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			if ( isset( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'taxonomy-use-icons' ] ) || isset( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'hide-slash' ] ) ) {
				$args = '';
			}

			return $args;
		}

		/**
		 * Modify html output of meta fields
		 * @param array $args
		 * @return array
		 */
		public static function filter_meta_field_html( $args ) {
			$special_field = PT_CV_Functions::get_global_variable( 'special-field' );
			if ( $special_field && isset( $args[ $special_field ] ) ) {
				PT_CV_Functions::set_global_variable( 'special-field-html', $args[ $special_field ] );

				// Remove special field from this list, to display it in another place
				unset( $args[ $special_field ] );
			}

			return $args;
		}

		/**
		 * Remove prefix text of meta fields
		 *
		 * @param string $args       The current prefix text of meta fields
		 * @param string $meta_field The meta field name
		 *
		 * @return string
		 */
		public static function filter_field_meta_prefix_text( $args, $meta_field ) {
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			// Hide prefix
			if ( isset( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'hide-prefix' ] ) ) {
				$args = '';
			}

			// Use Icon
			if ( !empty( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'taxonomy-use-icons' ] ) ) {
				$class = '';

				switch ( $meta_field ) {
					case 'author':
						$class	 = 'user';
						break;
					case 'date':
						$class	 = 'calendar';
						break;
					case 'terms':
						$class	 = 'folder-open';
						break;
					case 'comment':
						$class	 = 'comment';
						break;
				}

				$args = sprintf( '<span class="glyphicon glyphicon-%s"></span>', $class );
			}

			return $args;
		}

		/**
		 * Filter datetime output
		 *
		 * @param string $args
		 * @return string
		 */
		public static function filter_field_meta_date_final( $args, $unix_time ) {

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			if ( isset( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'date-human' ] ) ) {
				$args = PT_CV_Functions_Pro::date_human( $unix_time );
			}

			return $args;
		}

		/**
		 * Filter HTML output of a field (thumbnail, title, content, meta fields, Price)
		 *
		 * @param string $html   The output HTML
		 * @param string $field_ The type of field
		 * @param object $post   The post object
		 */
		public static function filter_field_item_html( $html, $field_, $post ) {
			$post_type = get_post_type( $post );

			// Special field
			$special_html	 = PT_CV_Functions::get_global_variable( 'special-field-html' );
			$do_special		 = $special_html && PT_CV_Functions_Pro::check_dependences( 'special-field' );

			switch ( $field_ ) {
				/**
				 * Show special field
				 * @since 3.4 : special field is Term
				 */
				case 'special-field':
					if ( $do_special ) {
						$special_position	 = apply_filters( PT_CV_PREFIX_ . 'meta_field_special_position', true );
						$_class				 = PT_CV_PREFIX . ( $special_position ? 'specialp' : 'anotherp');
						$html				 = apply_filters( PT_CV_PREFIX_ . 'meta_field_special_html', sprintf( '<div class="%s">%s</div>', $_class, $special_html ) );
						PT_CV_Functions::set_global_variable( 'special-field-html', null );
					}

					break;

				// Show Format Icon
				case 'format-icon':
					if ( $post_type === 'post' ) {
						$format = get_post_format( $post->ID );
						if ( !$format ) {
							$format = 'standard';
						}

						$class	 = PT_CV_PREFIX . 'pficon';
						$class .= $do_special ? ' ' . PT_CV_PREFIX . 'wspecialp' : '';
						$html	 = sprintf( '<span class="dashicons dashicons-format-%s %s"></span>', esc_attr( $format ), $class );
					}

					break;

				// Show Price
				case 'price':
					if ( $post_type === 'product' ) {
						$html = do_shortcode( sprintf( '[add_to_cart id="%s"]', $post->ID ) );
					}

					break;

				// Show Sale badge
				case 'woosale':
					if ( $post_type === 'product' ) {
						$product = wc_get_product( $post->ID );
						if ( $product->is_on_sale() ) {
							$html = '<span class="woocommerce-onsale">' . __( 'Sale', 'content-views-pro' ) . '</span>';
						}
					}

					break;

				// Show EDD Purchase Link
				case 'edd-purchase':
					if ( shortcode_exists( 'purchase_link' ) ) {
						ob_start();
						echo do_shortcode( '[purchase_link]' );
						$html = ob_get_clean();
					}

					break;

				// Show Custom Fields
				case 'custom-fields':
					$custom_fields_st = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'custom-fields-' );
					if ( $custom_fields_st && !empty( $custom_fields_st[ 'list' ] ) ) {
						$list				 = (array) $custom_fields_st[ 'list' ];
						$show_name			 = !empty( $custom_fields_st[ 'show-name' ] );
						$show_colon			 = !empty( $custom_fields_st[ 'show-colon' ] );
						$use_oembed			 = !empty( $custom_fields_st[ 'enable-oembed' ] );
						$custom_name_list	 = !empty( $custom_fields_st[ 'enable-custom-name' ] ) ? explode( ',', trim( $custom_fields_st[ 'custom-name-list' ] ) ) : '';
						$result				 = array();

						// Get all meta data of this post
						$metadata = get_metadata( 'post', $post->ID );

						$wanted_keys = array_intersect( $list, array_keys( $metadata ) );

						// Custom date format
						$ctf_date_format = '';
						if ( !empty( $custom_fields_st[ 'date-custom-format' ] ) ) {
							$ctf_date_format = !empty( $custom_fields_st[ 'date-format' ] ) ? $custom_fields_st[ 'date-format' ] : apply_filters( PT_CV_PREFIX_ . 'custom_field_date_format', get_option( 'date_format' ) );
						}

						// Get (name) vaue of custom fields
						foreach ( $wanted_keys as $idx => $key ) {
							$field_object	 = $field_value	 = $field_name		 = '';
							$field_type		 = 'text';

							// ACF support
							if ( function_exists( 'get_field_object' ) ) {
								$field_object = get_field_object( $key, $post->ID );
								if ( $field_object ) {
									$field_value = PT_CV_ACF::display_output( $field_object );
									$field_type	 = $field_object[ 'type' ];
									$field_name	 = $field_object[ 'label' ];
								}
							}

							// Handle custom fields
							if ( $field_type == 'text' ) {
								$field_value = PT_CV_CustomField::display_output( $metadata[ $key ], $use_oembed );
							}

							// If value of field is empty, extract it from Metadata
							if ( empty( $field_value ) ) {
								$field_value = implode( apply_filters( PT_CV_PREFIX_ . 'ctf_multi_val_separator', ', ' ), $metadata[ $key ] );
							}

							// Set key of field as field name
							if ( empty( $field_name ) ) {
								$field_name = esc_html( $key );
							}

							// Hide empty field
							if ( empty( $field_value ) && !empty( $custom_fields_st[ 'hide-empty' ] ) ) {
								continue;
							}

							// Name of field
							$name = '';
							if ( $show_name ) {
								$field_label = !empty( $custom_name_list[ $idx ] ) ? $custom_name_list[ $idx ] : PT_CV_Functions::string_slug_to_text( $field_name );
								$name_text	 = $field_label . ( $show_colon ? ':' : '');
								$name		 = sprintf( '<span class="%s">%s</span>', PT_CV_PREFIX . 'ctf-name', $name_text );
							}

							// Date value
							if ( !empty( $ctf_date_format ) ) {
								$date_valid = false;

								// Supports some date format
								if ( DateTime::createFromFormat( 'Y-m-d', $field_value ) || DateTime::createFromFormat( 'Y/m/d', $field_value ) || DateTime::createFromFormat( 'Y-m-d H:i:s', $field_value ) || DateTime::createFromFormat( 'Y/m/d H:i:s', $field_value ) ) {
									$date_valid = true;
								}

								if ( $date_valid ) {
									$field_value = mysql2date( $ctf_date_format, $field_value );
								}
							}

							$value = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'ctf-value', apply_filters( PT_CV_PREFIX_ . 'ctf_value', $field_value, $key, $post ) );

							$result[] = sprintf( '<div class="%s">%s%s</div>', PT_CV_PREFIX . 'custom-fields' . ' ' . PT_CV_PREFIX . 'ctf-' . sanitize_html_class( $key ), $name, $value );
						}

						// Generate Grid layout for custom-fields
						$ctf_columns = !empty( $custom_fields_st[ 'number-columns' ] ) ? abs( $custom_fields_st[ 'number-columns' ] ) : 0;
						if ( $ctf_columns ) {
							$grid = PT_CV_Html_ViewType_Pro::grid_wrapper_simple( $result, $ctf_columns, PT_CV_PREFIX . 'ctf-column' );
							if ( !empty( $grid ) ) {
								$result = $grid;
							}
						}

						$html = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'ctf-list', implode( '', $result ) );
					}
					break;
			}

			return $html;
		}

		/**
		 * Enable/Disable Read more button
		 *
		 * @param string $args  The readmore text
		 * @param array  $fargs The settings of Content
		 */
		public static function filter_field_content_readmore_enable( $args, $fargs ) {
			// not empty => true => show
			$args = !empty( $fargs[ 'readmore' ] );

			return $args;
		}

		/**
		 * Filter Read more button
		 *
		 * @param string $args  The readmore text
		 * @param array  $fargs The settings of Content
		 */
		public static function filter_field_content_readmore_text( $args, $fargs ) {
			if ( !empty( $fargs[ 'readmore' ] ) && !empty( $fargs[ 'readmore-text' ] ) ) {
				$args = stripslashes( trim( $fargs[ 'readmore-text' ] ) );
			}

			return $args;
		}

		/**
		 * Filter Read more class
		 *
		 * @param string $args  Current class
		 * @param array  $fargs The settings of Content
		 */
		public static function filter_field_content_readmore_class( $args, $fargs ) {
			if ( !empty( $fargs[ 'content' ][ 'readmore-textlink' ] ) ) {
				$args = PT_CV_PREFIX . 'textlink';
			}

			return $args;
		}

		/**
		 * Filter Read more seperate tag
		 *
		 * @param string $args  Current class
		 * @param array  $fargs The settings of Content
		 */
		public static function filter_field_content_readmore_seperated( $args, $fargs ) {
			if ( !empty( $fargs[ 'content' ][ 'readmore-textlink' ] ) ) {
				$args = ' ';
			}

			return $args;
		}

		/**
		 * Filter post title
		 *
		 * @param string $args  The excerpt output
		 * @param array  $fargs The field display settings
		 * @param int   $post_id Post ID
		 *
		 * @return string
		 */
		public static function filter_field_title_result( $args, $fargs, $post_id ) {
			// Strip Title
			if ( isset( $fargs[ 'title' ] ) ) {
				if ( !empty( $fargs[ 'title' ][ 'length' ] ) ) {
					$desired_length = intval( $fargs[ 'title' ][ 'length' ] );
					if ( $desired_length < strlen( $args ) ) {
						$args = substr( $args, 0, $desired_length ) . '...';
					}
				}
			}

			return $args;
		}

		/**
		 * Filter post excerpt
		 *
		 * @param string $args  The excerpt output
		 * @param type   $fargs The field display settings
		 * @param type   $post  The post object
		 *
		 * @return string
		 */
		public static function filter_field_content_excerpt( $args, $fargs, $post ) {
			// Prevent recursive call
			if ( empty( $fargs ) ) {
				return $args;
			}

			// Get manual excerpt
			if ( !empty( $fargs[ 'content' ][ 'manual' ] ) && !empty( $post->post_excerpt ) ) {
				$args = $post->post_excerpt;
				if ( $fargs[ 'content' ][ 'manual' ] === 'origin' ) {
					$GLOBALS[ 'cv_excerpt_type' ] = 'manual';
				}
			} else {
				// Apply filters, allow shortcodes in excerpt
				$enable_filter = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-excerpt-' . 'enable_filter' );
				if ( $enable_filter ) {
					$args = apply_filters( 'the_content', $args );
				}
			}

			// Final filter
			$args = apply_filters( PT_CV_PREFIX_ . 'field_manual_excerpt', $args, $fargs, $post );

			// Remove Video URL (used as thumbnail) from excerpt
			$args = self::remove_video_url( $args, $post );

			return $args;
		}

		/**
		 * Another solution to trim excerpt length
		 *
		 * @param string $args
		 * @param string $full_excerpt
		 * @param int $length
		 * @return string
		 */
		public static function filter_trim_length_excerpt( $args, $full_excerpt, $length ) {
			// For Chinese, Japenese...
			$site_lang = strtolower( get_locale() );
			if ( strpos( $site_lang, 'zh-' ) !== false || strpos( $site_lang, 'zh_' ) !== false ) {
				$args = mb_substr( $args, 0, (int) $length + 1, 'UTF-8' );
			}

			return $args;
		}

		/**
		 * Append ... to Excerpt or not
		 *
		 * @param array $args
		 */
		public static function filter_field_excerpt_dots( $args, $fargs ) {
			$args = empty( $fargs[ 'content' ][ 'hide_dots' ] );
			return $args;
		}

		/**
		 * Filter thumbnail settings: Add custom size info
		 *
		 * @param array  $args   Array of parameters
		 * @param string $prefix The prefix in name of setting
		 */
		public static function filter_field_thumbnail_setting_values( $args, $prefix ) {

			$view_settings = PT_CV_Functions::get_global_variable( 'view_settings' );

			// Get custom size if need
			if ( $args[ 'size' ] == PT_CV_PREFIX . 'custom' ) {
				$fields = array( 'size-custom-width', 'size-custom-height' );
				PT_CV_Functions::settings_values( $fields, $args, $view_settings, $prefix );
			}

			return $args;
		}

		/**
		 * Modify assets folder of View type
		 *
		 * @param string $args      The path to assets folder of view type
		 * @param string $view_type The view type
		 */
		public static function filter_view_type_asset( $args, $view_type ) {
			$path = PT_CV_VIEW_TYPE_OUTPUT_PRO . $view_type;

			if ( is_dir( $path ) ) {
				$args = $path;
			}

			return $args;
		}

		/**
		 * Modify the list of fields to get
		 *
		 * @param string $args      Array of fields
		 * @param string $post_idx  Index of current post
		 */
		public static function filter_dargs_others( $args, $post_idx ) {
			$view_type = PT_CV_Functions::get_global_variable( 'view_type' );

			// Show special field
			if ( !empty( $args[ 'field-settings' ][ 'meta-fields' ][ 'taxonomy-special-place' ] ) ) {
				$args[ 'fields' ][] = 'special-field';
				PT_CV_Functions::set_global_variable( 'special-field', 'taxonomy' );
			}

			// Simplify fields for other posts of "One and others" layout
			if ( $view_type === 'one_others' && $post_idx > 0 ) {
				// Layout format: 2 columns
				$args[ 'layout-format' ] = '2-col';

				// Show fields
				$show_fields	 = $fields_to_show	 = isset( $args[ 'view-type-settings' ][ 'show-fields' ] ) ? $args[ 'view-type-settings' ][ 'show-fields' ] : array( 'thumbnail', 'title', 'meta-fields' );
				foreach ( $show_fields as $idx => $value ) {
					if ( $value === 'full-content' ) {
						$show_fields[ $idx ] = 'content';
					}
				}
				$args[ 'fields' ] = apply_filters( PT_CV_PREFIX_ . 'one_others_fields', $show_fields );

				// Thumbnail size
				if ( in_array( 'thumbnail', $fields_to_show ) ) {
					$thumbnail_width	 = !empty( $args[ 'view-type-settings' ][ 'thumbnail-width-others' ] ) ? (int) $args[ 'view-type-settings' ][ 'thumbnail-width-others' ] : 150;
					$thumbnail_height	 = !empty( $args[ 'view-type-settings' ][ 'thumbnail-height-others' ] ) ? (int) $args[ 'view-type-settings' ][ 'thumbnail-height-others' ] : 100;

					$args[ 'field-settings' ][ 'thumbnail' ][ 'size' ]				 = apply_filters( PT_CV_PREFIX_ . 'one_others_thumbnail_size', PT_CV_PREFIX . 'custom' );
					$args[ 'field-settings' ][ 'thumbnail' ][ 'size-custom-width' ]	 = apply_filters( PT_CV_PREFIX_ . 'one_others_thumbnail_size_width', $thumbnail_width );
					$args[ 'field-settings' ][ 'thumbnail' ][ 'size-custom-height' ] = apply_filters( PT_CV_PREFIX_ . 'one_others_thumbnail_size_height', $thumbnail_height );

					// Store this custom size
					PT_CV_Functions::set_global_variable( 'image_sizes_others', array( $thumbnail_width, $thumbnail_height ) );

					// Thumbnail position
					$args[ 'field-settings' ][ 'thumbnail' ][ 'position' ] = 'left';
				}

				// Excerpt
				if ( in_array( 'content', $fields_to_show ) ) {
					$args[ 'field-settings' ][ 'content' ][ 'show' ]	 = 'excerpt';
					$args[ 'field-settings' ][ 'content' ][ 'length' ]	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-excerpt-length' );
					unset( $args[ 'field-settings' ][ 'content' ][ 'readmore' ] );
				}

				// Full Content
				if ( in_array( 'full-content', $fields_to_show ) ) {
					$args[ 'field-settings' ][ 'content' ][ 'show' ] = 'full';
					unset( $args[ 'field-settings' ][ 'content' ][ 'readmore' ] );
				}

				// Read more button
				if ( in_array( 'readmore', $fields_to_show ) ) {
					$args[ 'field-settings' ][ 'content' ][ 'readmore' ] = 'yes';
					if ( !in_array( 'content', $fields_to_show ) ) {
						$args[ 'fields' ][]									 = 'content';
						$args[ 'field-settings' ][ 'content' ][ 'show' ]	 = 'excerpt';
						$args[ 'field-settings' ][ 'content' ][ 'length' ]	 = '0';
					}
				}

				// Show meta fields
				if ( in_array( 'meta-fields', $fields_to_show ) ) {
					$args[ 'field-settings' ][ 'meta-fields' ] = apply_filters( PT_CV_PREFIX_ . 'one_others_meta_fields', array( 'date' => 'yes' ) );
				}
			}

			return $args;
		}

		/**
		 * Filter directory of Pro View type
		 *
		 * @param string $args      The path to main folder of view type
		 * @param string $view_type The view type
		 *
		 * @return string
		 */
		public static function filter_view_type_dir( $args, $view_type ) {

			$view_types_pro = array_keys( PT_CV_Values_Pro::view_type_pro() );
			if ( in_array( $view_type, $view_types_pro ) ) {
				$args = PT_CV_VIEW_TYPE_OUTPUT_PRO;
			}

			return $args;
		}

		/**
		 * Filter directory of Pro View type
		 *
		 * @param string $args      The path to main folder of view type
		 * @param string $view_type The view type
		 *
		 * @return string
		 */
		public static function filter_view_type_dir_special( $args, $view_type ) {
			if ( ($view_type == 'masonry' ) ) {
				$args = PT_CV_VIEW_TYPE_OUTPUT_PRO . 'pinterest';
			}

			return $args;
		}

		/**
		 * Add toggle icon to Scrollable item
		 *
		 * @param string $args HTML of toggle icon
		 *
		 * @return string
		 */
		public static function filter_scrollable_toggle_icon( $args ) {

			$args = '<span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-plus"></i></span>';

			return $args;
		}

		/**
		 * Filter interval for Scrollable List
		 *
		 * @param string $args The interval value
		 */
		public static function filter_scrollable_interval( $args ) {

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			$carousel_settings	 = !empty( $dargs[ 'view-type-settings' ] ) ? $dargs[ 'view-type-settings' ] : array();
			$interval			 = isset( $carousel_settings[ 'interval' ] ) ? (int) $carousel_settings[ 'interval' ] : 5;
			$args				 = !isset( $carousel_settings[ 'auto-cycle' ] ) ? 'false' : $interval * 1000;

			return $args;
		}

		/**
		 * Filter default value of setting options for Scrollable List
		 *
		 * @param string $args The default value
		 */
		public static function filter_scrollable_fields_enable( $args ) {
			$args = 0;
			return $args;
		}

		/**
		 * Filter custom data attributes for a page
		 *
		 * @param string $view_type     The view type
		 * @param array  $content_items The items array
		 */
		public static function filter_page_attr( $args, $view_type, $content_items ) {
			# Shuffle filter: Show all posts of term on pagination
			if ( PT_CV_Functions::get_global_variable( 'enable_shuffle_filter' ) && PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' ) ) {
				if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-filter-show-all' ) ) {
					$args .= ' data-sfshowall="1"';
				}
				if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-filter-trigger-pagination' ) ) {
					$args .= ' data-sftp="1"';
				}

				$args .= sprintf( ' data-sfpp="%s"', PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pagination-items-per-page' ) );
			}

			return $args;
		}

		/**
		 * Whether or not to wrap items in a page
		 *
		 * @param bool $args Wrap or not
		 */
		public static function filter_wrap_in_page( $args ) {
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' ) ) {
				if ( $dargs[ 'pagination-settings' ][ 'type' ] === 'ajax' ) {
					if ( in_array( $dargs[ 'pagination-settings' ][ 'style' ], array( 'loadmore', 'infinite' ) ) ) {
						/**
						 * @since 3.0
						 * Change false to true to make shuffle filter works with pagination (it requires a container under pt-cv-view to fix offset top,left issue when do animation)
						 */
						if ( PT_CV_Functions::get_global_variable( 'current_page' ) === 1 ) {
							$args = true;
						} else {
							$args = false;
						}
					}
				}
			}

			if ( $dargs[ 'view-type' ] === 'timeline' ) {
				$args = false;
			}

			return $args;
		}

		/**
		 * Filter wrapper HTML of list of items by view type
		 *
		 * @param array $content       The output array
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 * @param int   $current_page  The current page
		 * @param int   $post_per_page The number of posts per page
		 */
		public static function filter_content_items_wrap( $content, $content_items, $current_page, $post_per_page ) {

			$view_type = PT_CV_Functions::get_global_variable( 'view_type' );

			// Timeline
			if ( $view_type === 'pinterest' ) {
				$content = PT_CV_Html_ViewType_Pro::pinterest_wrapper( $content_items );
			} elseif ( $view_type === 'masonry' ) {
				$content = PT_CV_Html_ViewType_Pro::masonry_wrapper( $content_items );
			} elseif ( $view_type === 'timeline' ) {
				$content = PT_CV_Html_ViewType_Pro::timeline_wrapper( $content_items, $current_page, $post_per_page );
			} elseif ( $view_type === 'glossary' ) {
				$content = PT_CV_Html_ViewType_Pro::glossary_wrapper( $content_items, $current_page, $post_per_page );
			} elseif ( $view_type === 'one_others' ) {
				$content = PT_CV_Html_ViewType_Pro::one_others_wrapper( $content_items, $current_page, $post_per_page );
			}

			return $content;
		}

		/**
		 * Filter display settings value
		 *
		 * @param array $args The settings array of Fields
		 */
		public static function filter_all_display_settings( $args ) {

			$dargs			 = PT_CV_Functions::get_global_variable( 'dargs' );
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );

			$args[ 'view-style' ]					 = array();
			$args[ 'view-style' ][ 'font' ]			 = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'font-' );
			$args[ 'view-style' ][ 'margin' ]		 = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'margin-value-' );
			$args[ 'view-style' ][ 'item-margin' ]	 = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'item-margin-value-' );
			$args[ 'view-style' ][ 'item-padding' ]	 = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'item-padding-value-' );
			$args[ 'view-style' ][ 'others' ]		 = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'style-' );

			// Border radius
			$thumbnail_settings = isset( $dargs[ 'field-settings' ][ 'thumbnail' ] ) ? $dargs[ 'field-settings' ][ 'thumbnail' ] : array();
			if ( isset( $thumbnail_settings[ 'style' ] ) && $thumbnail_settings[ 'style' ] == 'img-rounded' ) {
				$args[ 'view-style' ][ 'border-radius' ] = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'thumbnail-border-radius', $view_settings );
			}

			$args[ 'taxonomy-filter' ] = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy', $view_settings );

			return $args;
		}

		/**
		 * Order settings args
		 *
		 * @param array $args
		 */
		public static function filter_order_setting( $args ) {
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$content_type	 = PT_CV_Functions::get_global_variable( 'content_type' );

			// Extract $args to get: $orderby, $order
			$orderby = $args[ 'orderby' ];
			$order	 = $args[ 'order' ];

			// Order by "View count"
			if ( $args[ 'orderby' ] == 'view_count' ) {
				$key	 = PT_CV_META_VIEW_COUNT;
				$orderby = 'meta_value_num';
			}

			// Custom order for specified post type, for example: Price for Woocommerce Product
			$meta_key = PT_CV_Functions::setting_value( PT_CV_PREFIX . $content_type . '-orderby', $view_settings );
			if ( $meta_key ) {
				$keys_postypes	 = array( 'product' => array( '_price' => 'meta_value_num' ) );
				$keys_to_sort	 = isset( $keys_postypes[ $content_type ] ) ? (array) $keys_postypes[ $content_type ] : array();
				$orderby		 = array_key_exists( $meta_key, $keys_to_sort ) ? $keys_to_sort[ $meta_key ] : 'meta_value';
				$key			 = $meta_key;
				$order			 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-order', $view_settings );
			}

			// Update params
			if ( isset( $key ) ) {
				$args = array(
					'meta_key'	 => $key,
					'orderby'	 => $orderby,
					'order'		 => $order,
				);
			}

			// Order by "Custom field"
			$metadata_order = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'order-custom-field-' );
			if ( $metadata_order ) {
				// If key is not empty
				if ( !empty( $metadata_order[ 'key' ] ) ) {
					$order_meta = array(
						'orderby'	 => 'meta_value',
						'meta_key'	 => $metadata_order[ 'key' ],
						'meta_type'	 => $metadata_order[ 'type' ],
						'order'		 => $metadata_order[ 'order' ],
					);

					// Mulitiple orderby
					if ( array_filter( $args ) ) {
						$args = array(
							'orderby'	 => array( 'meta_value' => $order_meta[ 'order' ], $args[ 'orderby' ] => $args[ 'order' ] ),
							'meta_key'	 => $metadata_order[ 'key' ],
							'meta_type'	 => $metadata_order[ 'type' ],
						);
					} else {
						$args = $order_meta;
					}
				}
			}

			if ( $args[ 'orderby' ] === 'dragdrop' ) {
				// Reset to use default WordPress order
				$args[ 'orderby' ]	 = '';
				$args[ 'order' ]	 = '';
			}

			return $args;
		}

		/**
		 * Validate settings filter
		 *
		 * @param string $errors The error message
		 * @param array  $args  The Query parameters array
		 */
		public static function filter_validate_settings( $errors, $args ) {

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			// Prefix string for error message
			$messages = array(
				'field'	 => array(
					'select' => __( 'Please select an option in', 'content-views-query-and-display-post-page' ) . ' : ',
					'text'	 => __( 'Please set value in', 'content-views-query-and-display-post-page' ) . ' : ',
				),
				'tab'	 => array(
					'filter'	 => __( 'Filter Settings', 'content-views-query-and-display-post-page' ),
					'display'	 => __( 'Display Settings', 'content-views-query-and-display-post-page' ),
				),
			);

			// View type
			if ( !empty( $dargs[ 'view-type' ] ) ) {
				switch ( $dargs[ 'view-type' ] ) {
					case 'scrollable':
						if ( empty( $dargs[ 'number-columns' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'View type (Layout)', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Items per row', 'content-views-query-and-display-post-page' );
						}
						if ( empty( $dargs[ 'number-rows' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'View type (Layout)', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Rows per slide', 'content-views-pro' );
						}
						break;

					case 'pinterest':
						if ( empty( $dargs[ 'number-columns' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'View type (Layout)', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Items per row', 'content-views-query-and-display-post-page' );
						}
						break;
				}
			}

			// Thumbnail custom dimensions
			if ( !empty( $dargs[ 'field-settings' ][ 'thumbnail' ] ) ) {
				$thumbnail_settings = $dargs[ 'field-settings' ][ 'thumbnail' ];
				if ( isset( $thumbnail_settings[ 'size' ] ) ) {
					if ( $thumbnail_settings[ 'size' ] === PT_CV_PREFIX . 'custom' ) {
						if ( empty( $thumbnail_settings[ 'size-custom-width' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'Fields settings', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Thumbnail', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Custom size', 'content-views-pro' ) . ' > ' . __( 'Width' );
						}
						if ( empty( $thumbnail_settings[ 'size-custom-height' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'Fields settings', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Thumbnail', 'content-views-query-and-display-post-page' ) . ' > ' . __( 'Custom size', 'content-views-pro' ) . ' > ' . __( 'Height' );
						}
					}
				}
			}

			return array_filter( $errors );
		}

		/**
		 * Filter array of parameters for Wp_Query
		 *
		 * @param type $args The Query parameters array
		 *
		 * @return array $args
		 */
		public static function filter_query_parameters( $args ) {
			$view_settings = PT_CV_Functions::get_global_variable( 'view_settings' );

			// Filter by Date
			PT_CV_Functions_Pro::filter_by_date( $args );

			// Quick filter WooCommerce Product (featured/best seller/... products)
			$content_type = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'content-type', $view_settings );
			if ( $content_type == 'product' ) {
				$products_list	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'products-list', $view_settings );
				// Append query parameters
				$args			 = array_merge( $args, PT_CV_WooCommerce::query_parameters( $products_list ) );
			}

			// Filter parameters (reuse View)
			$args = self::reuse_view( $args );

			// Custom Field filter
			$args = self::filter_by_custom_field( $args );

			// Include current posts
			if ( isset( $view_settings[ PT_CV_PREFIX . 'include-current' ] ) ) {
				global $post;
				if ( !empty( $post->ID ) ) {
					if ( !isset( $args[ 'post__in' ] ) ) {
						$args[ 'post__in' ] = array();
					}

					$args[ 'post__in' ][] = $post->ID;
				}
			}

			// Exclude current posts
			if ( isset( $view_settings[ PT_CV_PREFIX . 'exclude-current' ] ) ) {
				global $post;
				if ( !empty( $post->ID ) ) {
					if ( !isset( $args[ 'post__not_in' ] ) ) {
						$args[ 'post__not_in' ] = array();
					}

					$args[ 'post__not_in' ][] = $post->ID;
				}
			}

			// Random posts from "In list"
			if ( !empty( $args[ 'orderby' ] ) && $args[ 'orderby' ] == 'rand' && !empty( $args[ 'post__in' ] ) ) {
				$limit	 = $args[ 'limit' ];
				$count	 = count( $args[ 'post__in' ] );
				if ( $count > $limit ) {
					$args[ 'post__in' ] = array_rand( array_flip( $args[ 'post__in' ] ), min( $limit, $count ) );
				} else {
					shuffle( $args[ 'post__in' ] );
				}
			}

			// Post of current user
			if ( PT_CV_Functions::wp_version_compare( '3.7' ) ) {
				$author_current_user = !empty( $view_settings[ PT_CV_PREFIX . 'author-current-user' ] ) ? $view_settings[ PT_CV_PREFIX . 'author-current-user' ] : null;
				if ( $author_current_user === 'include' || isset( $view_settings[ PT_CV_PREFIX . 'author-include-current' ] ) ) {
					if ( get_current_user_id() ) {
						$args[ 'author__in' ] = array( get_current_user_id() );
					}
				} else if ( $author_current_user === 'exclude' || isset( $view_settings[ PT_CV_PREFIX . 'author-not-include-current' ] ) ) {
					if ( get_current_user_id() ) {
						$args[ 'author__not_in' ] = array( get_current_user_id() );
					}
				}
			}

			// Order by In list
			$post_in = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'post__in', $view_settings );
			if ( empty( $args[ 'orderby' ] ) && !empty( $post_in ) ) {
				$args[ 'orderby' ] = 'post__in';
			}

			// Disable suppress_filters when order randomly & enable pagination
			$pagination_enable = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination', $view_settings );
			if ( !empty( $args[ 'orderby' ] ) && $args[ 'orderby' ] === 'rand' && !empty( $pagination_enable ) ) {
				$args[ 'suppress_filters' ]		 = false;
				// Bug: duplicated posts when order randonly & pagination
				$args[ PT_CV_PREFIX . 'orp' ]	 = 1;
			}

			// Disable suppress_filters when enable Search
			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );
			if ( in_array( 'search', $advanced_settings ) ) {
				$args[ 'suppress_filters' ] = false;
			}

			// Modify tax_query
			$sf_custom_data = !empty( $_POST[ 'custom_data' ] ) ? $_POST[ 'custom_data' ] : '';
			if ( defined( 'PT_CV_DOING_PAGINATION' ) && isset( $sf_custom_data[ 'sf_taxo' ] ) && isset( $sf_custom_data[ 'sf_pids' ] ) ) {
				// Use escape functions (esc_sql) later to prevent added double quotations
				$sf_pid		 = $sf_custom_data[ 'sf_pids' ];
				$taxo_terms	 = json_decode( wp_unslash( $sf_custom_data[ 'sf_taxo' ] ), true );
				$view_id	 = esc_sql( $_POST[ 'sid' ] );

				$view_tt = isset( $taxo_terms[ $view_id ] ) ? $taxo_terms[ $view_id ] : '';
				if ( is_array( $view_tt ) ) {
					$subtax = array();
					foreach ( $view_tt as $taxo => $terms ) {
						if ( $terms !== 'all' && $terms !== '' ) {
							$subtax[ $taxo ] = array(
								'taxonomy'			 => $taxo,
								'field'				 => 'slug',
								'terms'				 => array_map( 'esc_sql', str_replace( '@', '%', $terms ) ),
								'include_children'	 => false,
								'operator'			 => count( $terms ) > 1 ? 'AND' : 'IN',
							);
						}
					}
					if ( $subtax ) {
						$args[ 'tax_query' ] = $subtax;

						if ( count( $subtax ) > 1 ) {
							$args[ 'tax_query' ][ 'relation' ] = 'AND';
						}

						// Show all remain posts of term
						$args[ 'posts_per_page' ] = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-filter-show-all' ) ? 1000 : (int) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pagination-items-per-page' ); // -1 will ignore offset value
					}
				}

				// Exclude shown posts of this View
				$pids = isset( $sf_pid[ $view_id ] ) ? json_decode( $sf_pid[ $view_id ], true ) : array();
				if ( !empty( $pids ) ) {
					$args[ 'post__not_in' ] = array_map( 'intval', $pids );
				}

				// Always reset offset
				$args[ 'offset' ] = 0;

				$args = apply_filters( PT_CV_PREFIX_ . 'query_args_sf_pagination', $args );
			}

			return $args;
		}

		/**
		 * Whether or not to include posts of children taxonomies
		 *
		 * @param boolean $args
		 * @return boolean
		 */
		public static function filter_include_children( $args ) {
			// Only process if $args = true (default value)
			if ( $args === true ) {
				$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
				$exclude		 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-' . 'exclude-children', $view_settings );
				$args			 = !empty( $exclude ) ? false : true;

				/**
				 * @since 3.3
				 * If it is still true, make it false if shuffle-filter is enable
				 * to prevent posts of child terms from being retrieved
				 */
				if ( $args === true ) {
					$shuffle_filter = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-taxonomy-filter', $view_settings );
					if ( $shuffle_filter === 'yes' ) {
						$args = false;
					}
				}
			}

			return $args;
		}

		/**
		 * Fitler taxonomy settings
		 *
		 * @param array $args
		 * @return array
		 */
		public static function filter_taxonomy_setting( $args ) {

			// WPML: Get terms in current language
			global $sitepress;
			if ( $sitepress ) {
				$new_args = array();

				foreach ( $args as $tax ) {
					if ( !is_array( $tax ) ) {
						continue;
					}

					$type				 = $tax[ 'taxonomy' ];
					$term_ids			 = PT_CV_Functions_Pro::get_terms_id( $tax[ 'terms' ], $type );
					$translated_terms	 = array();

					foreach ( $term_ids as $id ) {
						$tid = PT_CV_Functions_Pro::wpml_translate_object( $id, $type );
						if ( !is_null( $tid ) ) {
							$translated_terms[] = $tid;
						}
					}

					if ( $translated_terms ) {
						$tax[ 'field' ]	 = 'id';
						$tax[ 'terms' ]	 = $translated_terms;
					}

					$new_args[] = $tax;
				}

				$args = $new_args;
			}

			return $args;
		}

		/**
		 * Filter kind of content of View
		 *
		 * @param string $args
		 * @return string
		 */
		public static function filter_display_what( $args ) {
			$view_type		 = PT_CV_Functions::get_global_variable( 'view_type' );
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );

			// Show terms as output
			if ( PT_CV_Functions_Pro::taxonomy_custom_setting_enable( $view_settings, 'taxonomy-term-info', 'as_output' ) ) {
				$args = 'term_as_output';
			}

			// Get one post of each term
			else if ( PT_CV_Functions_Pro::taxonomy_custom_setting_enable( $view_settings, 'taxonomy-one-per-term' ) ) {
				$args = 'post_per_term';
			}

			return $args;
		}

		/**
		 * Filter content of View
		 *
		 * @param string $args
		 * @return string
		 */
		public static function filter_view_content( $args ) {
			$display_what	 = PT_CV_Functions::get_global_variable( 'display_what' );
			$query_args		 = PT_CV_Functions::get_global_variable( 'args' );
			$view_type		 = PT_CV_Functions::get_global_variable( 'view_type' );

			if ( empty( $query_args[ 'tax_query' ] ) ) {
				echo PT_CV_Functions::debug_output( 'empty no_term_selected', 'Please select terms in "Advanced filters" > "Taxonomy Settings"!' ) . '<br>';
				return $args;
			}

			// If display term as output
			if ( $display_what === 'term_as_output' ) {
				$taxonomies	 = $slugs		 = array();
				foreach ( $query_args[ 'tax_query' ] as $key => $tax_query ) {
					if ( $key === 'relation' ) {
						continue;
					}
					$taxonomies[]	 = $tax_query[ 'taxonomy' ];
					$slugs			 = array_merge( $slugs, $tax_query[ 'terms' ] );
				}

				// Get terms
				$args	 = array();
				$terms	 = get_terms( $taxonomies, array( 'slug' => $slugs, 'hide_empty' => false, ) );
				if ( $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term, $term->taxonomy );

						if ( function_exists( 'get_term_thumbnail' ) ) {
							$dargs		 = PT_CV_Functions::get_global_variable( 'dargs' );
							$term_data	 = array();

							foreach ( $dargs[ 'fields' ] as $field ) {
								switch ( $field ) {
									case 'thumbnail':
										$thumb_size		 = $dargs[ 'field-settings' ][ 'thumbnail' ][ 'size' ];
										$term_img		 = get_term_thumbnail( $term->term_id, apply_filters( PT_CV_PREFIX_ . 'tao_image_size', $thumb_size ) );
										$term_data[]	 = sprintf( '<a href="%s">%s</a>', esc_url( $term_link ), $term_img );
										break;
									case 'title':
										$term_data[]	 = sprintf( '<a class="%s" href="%s">%s</a>', PT_CV_PREFIX . 'tao', esc_url( $term_link ), esc_html( $term->name ) );
										break;
									case 'content':
										$content_setting = $dargs[ 'field-settings' ][ 'content' ];
										$content		 = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'content', ($content_setting[ 'show' ] === 'full') ? $term->description : wp_trim_words( $term->description, (int) $content_setting[ 'length' ] )  );

										if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-excerpt-readmore' ) ) {
											$content = PT_CV_Html_Pro::custom_readmore( $term_link );
										}

										$term_data[] = $content;

										break;
								}
							}

							$args[ PT_CV_Functions::term_slug_sanitize( $term->slug ) ] = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'taso', implode( '', $term_data ) );
						} else {
							$animation_class											 = 'hvr-grow-shadow cvp-tao-woimg';
							$args[ PT_CV_Functions::term_slug_sanitize( $term->slug ) ]	 = sprintf( '<a class="%s" href="%s">%s</a>', esc_attr( PT_CV_PREFIX . 'tao' . ' ' . $animation_class ), esc_url( $term_link ), esc_html( $term->name ) );
						}
					}

					// Reorder by order of selected terms
					$args = PT_CV_Functions_Pro::_array_replace( array_flip( $slugs ), $args );
				}

				if ( empty( $args ) ) {
					echo PT_CV_Functions::debug_output( 'empty term_as_output', 'No terms found!' ) . '<br>';
				}
			}

			// Get one post of each term
			else if ( $display_what === 'post_per_term' ) {
				// Get terms
				$new_tax_query = array();
				foreach ( (array) $query_args[ 'tax_query' ] as $tax_query ) {
					if ( !$tax_query )
						continue;
					foreach ( (array) $tax_query[ 'terms' ] as $term ) {
						$new_tax_query[] = array(
							'taxonomy'	 => $tax_query[ 'taxonomy' ],
							'field'		 => $tax_query[ 'field' ],
							'terms'		 => $term,
						);
					}
				}

				// Query X posts of each term
				$posts_limit	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-number-per-term' );
				$content_items	 = array();
				foreach ( $new_tax_query as $tax_query ) {
					$_args						 = $query_args;
					$_args[ 'tax_query' ]		 = array( $tax_query );
					$_args[ 'posts_per_page' ]	 = $posts_limit ? (int) $posts_limit : 1;
					$_args[ 'offset' ]			 = 0;
					$_args[ 'post__not_in' ]	 = array_keys( $content_items );

					$pt_query = new WP_Query( $_args );
					if ( $pt_query->have_posts() ) {
						while ( $pt_query->have_posts() ) {
							$pt_query->the_post();
							global $post;

							// Output HTML for this item
							$content_items[ $post->ID ] = PT_CV_Html::view_type_output( $view_type, $post );
						}
					}

					PT_CV_Functions::reset_query();
				}

				$args = $content_items;

				if ( empty( $args ) ) {
					echo PT_CV_Functions::debug_output( 'empty post_per_term', 'No posts found for selected terms!' ) . '<br>';
				}
			}

			return $args;
		}

		/**
		 * Add parameters to filter by Custom Field
		 *
		 * @param array $args
		 *
		 * @return array
		 */
		public static function filter_by_custom_field( $args ) {

			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );

			if ( !in_array( 'custom_field', $advanced_settings ) ) {
				return $args;
			}

			// Get saved settings of Custom fields
			$saved_ctf = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'ctf-filter-', true );

			$number_of_fields = isset( $saved_ctf[ 'key' ] ) ? count( $saved_ctf[ 'key' ] ) : 0;

			$ctf_query = array();

			$operators = array(
				'allow_empty'		 => array( 'EXISTS', 'NOT EXISTS', 'NOW_FUTURE', 'IN_PAST' ),
				'no_value'			 => array( 'EXISTS', 'NOT EXISTS' ),
				'require_2values'	 => array( 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN' ),
			);

			for ( $idx = 0; $idx < $number_of_fields; $idx ++ ) {
				if ( !isset( $saved_ctf[ 'value' ][ $idx ] ) ) {
					continue;
				}

				$value = $saved_ctf[ 'value' ][ $idx ];

				// Comma-separated values
				$arr_val = explode( ',', $value );

				// Prevent duplicate key
				$key = $saved_ctf[ 'key' ][ $idx ];

				// Get operator to compare
				$compare = $saved_ctf[ 'operator' ][ $idx ];

				// Get type of custom field
				$type = $saved_ctf[ 'type' ][ $idx ];

				// Value is not empty Or ...
				$allow_empty_value = in_array( $compare, $operators[ 'allow_empty' ] );
				if ( !empty( $key ) && ( $value || $allow_empty_value ) ) {
					// Check if require array of value
					$require_array = 0;

					// Validate input which requires 2 values
					if ( in_array( $compare, $operators[ 'require_2values' ] ) ) {
						$require_array = 1;
						if ( count( $arr_val ) <= 1 ) {
							die( __( 'You have to give 2 different values for the custom field', 'content-views-pro' ) . ': ' . $key );
						}
					}

					// Validate date value
					if ( $type == 'DATE' ) {
						if ( !in_array( $compare, array( 'NOW_FUTURE', 'IN_PAST' ) ) ) {
							// If all dates are valid, convert to Ymd format
							$arr_dates = array();
							foreach ( $arr_val as $date ) {
								$date = DateTime::createFromFormat( 'Y/m/d', $date );
								// Support old version where datepicker's dateformat is m/d/Y
								if ( !$date ) {
									$date = DateTime::createFromFormat( 'm/d/Y', $date );
								}

								if ( $date ) {
									$arr_dates[] = $date->format( 'Y-m-d' );
								} else if ( !$allow_empty_value ) {
									die( __( '[Filter by Custom field] Value of following date field is invalid', 'content-views-pro' ) . ': ' . $key );
								}
							}
							$arr_val = $arr_dates;
						} else {
							if ( $compare == 'NOW_FUTURE' ) {
								$compare = '>=';
							} else if ( $compare == 'IN_PAST' ) {
								$compare = '<';
							}

							$arr_val = array( date( 'Y-m-d' ) );
						}
					}

					// Create query array for this custom field
					$tmp_arr = array(
						'key'		 => $key,
						'type'		 => $type,
						'compare'	 => $compare,
					);

					# If value is not empty
					if ( !in_array( $compare, $operators[ 'no_value' ] ) && $arr_val && $arr_val[ 0 ] ) {
						$tmp_arr[ 'value' ] = apply_filters( PT_CV_PREFIX_ . 'query_ctf_value', $require_array ? $arr_val : $arr_val[ 0 ], $key );
					}
					if ( $tmp_arr ) {
						$ctf_query[] = $tmp_arr;
					}
				}
			}

			// Get Relation if filtered by more than 1 custom field
			if ( count( $ctf_query ) > 1 ) {
				$ctf_query[ 'relation' ] = $saved_ctf[ 'relation' ];
			}

			$args = array_merge( $args, array( 'meta_query' => $ctf_query ) );

			return $args;
		}

		/**
		 * Filter when get list of taxonomies
		 *
		 * @param array $args The settings array to get taxonomies
		 */
		public static function filter_taxonomies_to_show( $args ) {

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			if ( !empty( $dargs[ 'field-settings' ][ 'meta-fields' ][ 'taxonomy-display-what' ] ) ) {
				$args = (array) $dargs[ 'field-settings' ][ 'meta-fields' ][ 'taxonomy-display-custom' ];
			}

			return $args;
		}

		/**
		 * Filter taxonomy: Get all registered taxonomies
		 *
		 * @param array $args Array to filter
		 *
		 * @return boolean
		 */
		public static function filter_taxonomy_query_args( $args ) {
			if ( isset( $args[ 'show_ui' ] ) ) {
				unset( $args[ 'show_ui' ] );
			}
			if ( isset( $args[ '_builtin' ] ) ) {
				unset( $args[ '_builtin' ] );
			}

			return $args;
		}

		/**
		 * Add parameters for View shortcode, used to reuse View
		 *
		 * @param array $args
		 */
		public static function filter_shortcode_params( $args ) {
			$args[ 'limit' ]	 = 0;
			$args[ 'offset' ]	 = 0;
			$args[ 'field' ]	 = 'slug';
			$args[ 'operator' ]	 = 'IN'; // IN, NOT IN, AND
			$args[ 'relation' ]	 = 'AND'; // AND, OR

			$text_keys = array( 'view_class', 'reuse_tax_query', 'keyword', 'post_type', 'post_parent', 'post_id', 'author', 'cat', 'tag', 'taxonomy', 'taxonomy2', 'terms', 'terms2' );
			$args += array_fill_keys( $text_keys, '' );

			return $args;
		}

		/**
		 * Add wrapper class of View
		 *
		 * @param array $args
		 *
		 * @return int
		 */
		public static function filter_view_class( $args ) {

			$shortcode_params = PT_CV_Functions::get_global_variable( 'shortcode_params' );
			if ( !empty( $shortcode_params[ 'view_class' ] ) ) {
				$args[] = esc_attr( $shortcode_params[ 'view_class' ] );
			}

			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$view_type		 = PT_CV_Functions::get_global_variable( 'view_type' );

			// For Pinterest layout
			if ( $view_type == 'pinterest' ) {
				$style	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pinterest-box-style', $view_settings, 'shadow' );
				$args[]	 = esc_attr( PT_CV_PREFIX . $style );

				// Pinterest no border of fields
				$no_bb = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pinterest-no-bb', $view_settings, 'bb' );
				if ( $no_bb ) {
					$args[] = esc_attr( PT_CV_PREFIX . $no_bb );
				}
			}

			// Masonry layout: inherit most things from Pinterest layout
			if ( $view_type == 'masonry' ) {
				$args[] = PT_CV_PREFIX . 'pinterest' . ' ' . PT_CV_PREFIX . 'shadow';
			}

			// Animation class
			if ( PT_CV_Functions_Pro::animate_activated_content_hover() ) {
				// Get selected effect
				global $pt_cv_glb, $pt_cv_id;
				$class_suffix = !empty( $pt_cv_glb[ $pt_cv_id ][ 'animation' ][ 'content-animation' ] ) ? $pt_cv_glb[ $pt_cv_id ][ 'animation' ][ 'content-animation' ] : 'effect-fi';

				$args[] = esc_attr( PT_CV_PREFIX . 'content-hover' . ' ' . $class_suffix );
			}

			// Line up fields (Title, Content...) across items
			$grid_settings = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'grid' . '-' );
			if ( isset( $grid_settings[ 'same-height' ] ) && PT_CV_Functions_Pro::check_dependences( 'same-height' ) ) {
				$args[] = esc_attr( PT_CV_PREFIX . 'same-height' );
			}

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			// Infinite loading
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' ) ) {
				if ( $dargs[ 'pagination-settings' ][ 'type' ] === 'ajax' ) {
					$class	 = 'pg' . $dargs[ 'pagination-settings' ][ 'style' ];
					$args[]	 = esc_attr( PT_CV_PREFIX . $class );
				}
			}

			// Text align
			if ( isset( $dargs[ 'view-style' ][ 'others' ][ 'text-align' ] ) ) {
				$args[] = esc_attr( PT_CV_PREFIX . $dargs[ 'view-style' ][ 'others' ][ 'text-align' ] );
			}

			// Glossary - only index
			if ( isset( $dargs[ 'view-type-settings' ][ 'index-only' ] ) ) {
				$args[] = PT_CV_PREFIX . 'index-only';
			}

			// Term as output
			$display_what = PT_CV_Functions::get_global_variable( 'display_what' );
			if ( $display_what === 'term_as_output' ) {
				$args[] = PT_CV_PREFIX . 'show-taxonomy';
			}

			// Button border radius
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );
			if ( isset( $dargs[ 'view-style' ][ 'others' ][ 'button-border-radius' ] ) && $dargs[ 'view-style' ][ 'others' ][ 'button-border-radius' ] === '0' ) {
				$args[] = PT_CV_PREFIX . 'sharp-buttons';
			}

			// Is Mobile
			if ( PT_CV_Functions_Pro::is_mobile() ) {
				$args[] = PT_CV_PREFIX . 'mobile';
			}
			if ( PT_CV_Functions_Pro::is_mobile_tablet() ) {
				$args[] = PT_CV_PREFIX . 'mobile-tablet';
			}

			// Social share count
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'other-social-count', $view_settings ) ) {
				$args[] = PT_CV_PREFIX . 'socialsc';
			}

			return $args;
		}

		/**
		 * Filter asset files to include in Preview/Front-end
		 *
		 * @param array $args
		 */
		public static function filter_assets_files( $args ) {

			$text_direction = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'text-direction' );

			if ( $text_direction === 'rtl' ) {
				$args[ 'css' ][] = plugins_url( 'public/assets/css/rtl.css', PT_CV_FILE_PRO );
			}

			return $args;
		}

		/**
		 * Add custom HTML before list of items
		 *
		 * @param string $args
		 */
		public static function filter_before_output_html( $args ) {
			global $pt_cv_glb, $pt_cv_id;
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$view_type		 = PT_CV_Functions::get_global_variable( 'view_type' );

			// Show Title of Parent page
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'post_parent-auto', $view_settings ) ) {
				// Show info of Parent page
				$show_what = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'post_parent-auto-info', $view_settings );
				if ( $show_what ) {
					global $pt_cv_glb;

					if ( !empty( $pt_cv_glb[ 'parent_page' ] ) ) {
						$parent			 = get_post( $pt_cv_glb[ 'parent_page' ] );
						$parent_title	 = $parent->post_title;

						if ( $show_what == 'title' ) {
							// Show Title
							$args = sprintf( '<h3 class="%s">%s</h3>', PT_CV_PREFIX . 'parent-title', $parent_title );
						} else {
							// Show Title & Link
							$args = sprintf( '<h3 class="%s"><a href="%s">%s</a></h3>', PT_CV_PREFIX . 'parent-title', get_permalink( $parent->ID ), $parent_title );
						}
					}
				}
			}

			// Show terms as heading
			if ( PT_CV_Functions_Pro::taxonomy_custom_setting_enable( $view_settings, 'taxonomy-term-info', 'as_heading' ) ) {
				$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

				// Get selected taxonomy
				$taxonomies_to_get = isset( $dargs[ 'taxonomy-filter' ] ) ? $dargs[ 'taxonomy-filter' ] : NULL;

				// Get selected terms or all terms of selected taxonomies
				$selected_terms_of_taxonomies = apply_filters( PT_CV_PREFIX_ . 'terms_to_filter', (array) PT_CV_Functions_Pro::get_selected_terms( $taxonomies_to_get ) );

				if ( $selected_terms_of_taxonomies ) {
					$first_taxonomy			 = current( array_keys( $selected_terms_of_taxonomies ) );
					$terms_of_first_taxonomy = array_shift( $selected_terms_of_taxonomies );

					if ( $first_taxonomy && $terms_of_first_taxonomy ) {
						$first_term = array_slice( $terms_of_first_taxonomy, 0, 1, true );
						if ( $first_term ) {
							$term_link = get_term_link( (string) current( array_keys( $first_term ) ), $first_taxonomy );

							if ( !is_wp_error( $term_link ) ) {
								// Get term heading tag
								$tag		 = apply_filters( PT_CV_PREFIX_ . 'field_term_heading_tag', 'h3' );
								$tag_class	 = apply_filters( PT_CV_PREFIX_ . 'field_term_heading_class', PT_CV_PREFIX . 'term-heading' );

								$args = "<$tag class='$tag_class'><a href='" . esc_url( $term_link ) . "'>" . current( $first_term ) . "</a></$tag>";
							}
						}
					}
				}
			}

			// Enable filter
			if ( PT_CV_Functions::get_global_variable( 'enable_shuffle_filter' ) ) {
				self::before_output_html_shuffle_filter( $args );
			}

			// For Glossary list
			if ( $view_type == 'glossary' ) {
				self::before_output_html_glossary_header( $args );
			}

			/**
			 * Add edit button if:
			 * in front-end
			 * & is administrator or allowed role
			 * & want to display this button (have option in Settings page)
			 */
			$hide_edit_view = PT_CV_Functions::get_option_value( 'hide_edit_view' );
			if ( !is_admin() && PT_CV_Functions_Pro::user_can_manage_view() && empty( $hide_edit_view ) ) {
				$edit_link	 = PT_CV_Functions::view_link( $pt_cv_id );
				$edit_html	 = '<a href="' . esc_url( $edit_link ) . '" target="_blank" class="' . PT_CV_PREFIX . 'edit-view' . '">' . __( 'Edit View', 'content-views-query-and-display-post-page' ) . '</a><br>';
				$args		 = $edit_html . $args;
			}

			return $args;
		}

		/**
		 * Display Shuffle Filter Options
		 *
		 * @global array $view_settings
		 * @global array $dargs
		 * @global array $pt_cv_id
		 * @global array $gl_view_styles
		 * @global array $gl_view_styles
		 * @param array $args
		 * @return array
		 */
		public static function before_output_html_shuffle_filter( &$args ) {
			global $pt_cv_glb, $pt_cv_id;
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			if ( !isset( $pt_cv_glb[ 'view_styles' ] ) ) {
				$pt_cv_glb[ 'view_styles' ] = array();
			}

			// Check if Taxonomy is selected in Advanced filters
			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );
			if ( !in_array( 'taxonomy', $advanced_settings ) ) {
				return sprintf( '<div class="alert alert-danger">%s</div>', __( 'Please enable Taxonomy under Advanced filters section', 'content-views-pro' ) );
			}

			// Get selected taxonomy
			$taxonomies_to_get = isset( $dargs[ 'taxonomy-filter' ] ) ? $dargs[ 'taxonomy-filter' ] : NULL;
			if ( !is_array( $taxonomies_to_get ) ) {
				return sprintf( '<div class="alert alert-danger">%s</div>', __( 'Please select at least one taxonomy', 'content-views-pro' ) );
			}

			// Get selected terms or all terms of selected taxonomies
			$selected_terms_of_taxonomies = apply_filters( PT_CV_PREFIX_ . 'terms_to_filter', (array) PT_CV_Functions_Pro::get_selected_terms( $taxonomies_to_get ) );
			if ( !$selected_terms_of_taxonomies ) {
				return sprintf( '<div class="alert alert-info">%s</div>', __( 'There is no terms to filter', 'content-views-pro' ) );
			}

			// Sanitize to solving problem with non-latin term name
			$sanitized_terms = array();
			foreach ( $selected_terms_of_taxonomies as $taxonomy => $terms ) {
				$this_term = array();
				foreach ( $terms as $slug => $name ) {
					$san_slug				 = esc_attr( PT_CV_Functions::term_slug_sanitize( $slug, true ) );
					$this_term[ $san_slug ]	 = $name;
				}
				$sanitized_terms[ $taxonomy ] = $this_term;
			}

			// Get filter settings
			$prefix			 = 'taxonomy-filter';
			$filter_settings = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . $prefix . '-' );

			$filter_class	 = PT_CV_PREFIX . 'filter-bar';
			$class			 = implode( ' ', apply_filters( PT_CV_PREFIX_ . 'shuffle_filter_class', array( $filter_class ) ) );

			// Show Filter bar for each Taxonomy
			$output = array();

			$sfilter_type = apply_filters( PT_CV_PREFIX_ . 'sfilter_type', $filter_settings[ 'type' ] );

			// Single filter
			if ( $sfilter_type != 'group_by_taxonomy' ) {
				// Get position
				$position = $filter_settings[ 'position' ];

				switch ( $position ) {
					case 'left':
						$class .= ' pull-left';
						break;
					case 'center':
						$class .= ' ' . PT_CV_PREFIX . 'center';
						break;
					case 'right':
						$class .= ' pull-right';
						break;
				}

				$idx_tax = 0;
				foreach ( $sanitized_terms as $idx => $selected_terms ) {
					// Generate id for each filter bar
					$filter_id = $filter_class . '-' . $pt_cv_id . '-' . $idx;

					// Margin bottom
					$margin_bottom = $filter_settings[ 'margin-bottom' ];
					if ( !empty( $margin_bottom ) ) {
						$pt_cv_glb[ 'view_styles' ][] = sprintf( '#%s { margin-bottom: %spx !important; }', $filter_id, $margin_bottom );
					}

					switch ( $sfilter_type ) {
						case 'btn-group':
							// Custom css
							$space							 = $filter_settings[ 'space' ];
							$pt_cv_glb[ 'view_styles' ][]	 = sprintf( '#%s .btn { margin-right: %spx !important; }', $filter_id, $space );

							$output[]	 = PT_CV_Html_Pro::filter_html_btn_group( $class, $selected_terms, $filter_id, $idx_tax, false );
							break;
						case 'breadcrumb':
							$output[]	 = PT_CV_Html_Pro::filter_html_breadcrumb( $class, $selected_terms, $filter_id, $idx_tax );
							break;
						case 'vertical-dropdown':
							$output[]	 = PT_CV_Html_Pro::filter_html_vertical_dropdown( $class, $selected_terms, $filter_id, $idx_tax, false );
							break;
					}
					$idx_tax++;
				}
			}
			// Filter by Group of terms
			else {
				$class .= ' ' . PT_CV_PREFIX . 'filter-group';

				// Group options by Taxonomy
				list( $columns, $span_width_last, $span_width, $span_class ) = PT_CV_Html_ViewType::process_column_width( count( $sanitized_terms ), false );

				// Get all current taxonomies
				$all_taxonomies = apply_filters( PT_CV_PREFIX_ . 'all_taxonomies', PT_CV_Values::taxonomy_list() );

				$row_html	 = array();
				$idx_tax	 = 0;
				foreach ( $sanitized_terms as $taxonomy => $terms ) {
					$column_html = array();

					// Heading text
					$filter_title_class	 = apply_filters( PT_CV_PREFIX_ . 'shuffle_title_class', PT_CV_PREFIX . 'filter-title' );
					$heading_text		 = PT_CV_Functions_Pro::shuffle_filter_group_setting( $idx_tax );
					if ( $heading_text == __( 'All', 'content-views-pro' ) || empty( $heading_text ) ) {
						$heading_text = $all_taxonomies[ $taxonomy ];
					}
					$column_html[] = sprintf( '<h2 class="%s" data-taxonomy="%s">%s</h2>', esc_attr( $filter_title_class ), $taxonomy, apply_filters( PT_CV_PREFIX_ . 'shuffle_title_text', esc_html( $heading_text ) ) );

					// Terms list
					$terms_html = array();
					foreach ( $terms as $key => $text ) {
						$terms_html[] = sprintf( '<li><a href="#" class="%s" data-value="%s" data-sftype="group">%s</a></li>', PT_CV_PREFIX . 'filter-option', esc_attr( $key ), esc_html( $text ) );
					}
					$column_html[] = sprintf( '<ul>%s</ul>', implode( "\n", $terms_html ) );

					// Operator
					$sf_taxo_operator	 = PT_CV_Functions_Pro::shuffle_filter_group_setting( $idx_tax, 'operator' );
					$operator_options	 = array();
					foreach ( array( 'and' => __( 'AND', 'content-views-pro' ), 'or' => __( 'OR', 'content-views-pro' ) ) as $option => $text ) {
						$operator_options[] = sprintf( '<label><input type="radio" value="%s" name="%s" %s></input>%s</label>', $option, 'cvp-filter-operator-' . $idx_tax, checked( $sf_taxo_operator, $option, false ), $text );
					}
					$operator_selection	 = sprintf( '<div>%s</div>', implode( '', $operator_options ) );
					$label				 = __( 'Operator', 'content-views-query-and-display-post-page' );
					$extra_class		 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-show-operator' ) ? '' : ' hidden';
					$column_html[]		 = sprintf( '<div class="%s"><label>%s</label>%s</div>', PT_CV_PREFIX . 'filter-operator' . $extra_class, $label, $operator_selection );

					// Get HTML of each column
					$classes	 = array( PT_CV_PREFIX . 'filter-egroup' );
					$classes[]	 = $span_class . $span_width;
					$classes[]	 = 'col-sm-' . ($span_width >= 3 ? $span_width : 6);
					// By default, disable 2 columns for Mobile devices
					if ( apply_filters( PT_CV_PREFIX_ . 'shuffle_2col_mobile', false ) ) {
						$classes[] = 'col-xs-6';
					}

					$row_html[] = sprintf( '<div class="%s">%s</div>', esc_attr( implode( ' ', $classes ) ), implode( "\n", $column_html ) );

					$idx_tax++;
				}

				// Wrap columns of Taxonomies group to a row
				$filter_id	 = $filter_class . '-' . $pt_cv_id;
				$output[]	 = sprintf( '<div class="%s" id="%s">%s</div>', esc_attr( $class ), $filter_id, implode( "\n", $row_html ) );
			}

			$args = implode( '', $output );
		}

		/**
		 * Display Header text for Glossary list
		 *
		 * @global array $content_items
		 * @param array $args
		 */
		public static function before_output_html_glossary_header( &$args ) {
			$glb_content_items = PT_CV_Functions::get_global_variable( 'content_items' );

			// Get list of post objects, title as key
			$all_posts		 = isset( $GLOBALS[ 'cv_posts' ] ) ? $GLOBALS[ 'cv_posts' ] : array();
			$content_items	 = array();
			foreach ( $glb_content_items as $pid => $item ) {
				$post					 = isset( $all_posts[ $pid ] ) ? $all_posts[ $pid ] : null;
				$title					 = isset( $post->post_title ) ? $post->post_title : strip_tags( $item );
				$content_items[ $title ] = $item;
			}

			$glossary_list = array();
			foreach ( $content_items as $title => $item ) {
				$key = apply_filters( PT_CV_PREFIX_ . 'glossary_key', substr( sanitize_title( $title ), 0, 1 ), $title );

				if ( !isset( $glossary_list[ $key ] ) ) {
					$glossary_list[ $key ] = array();
				}
				$glossary_list[ $key ][] = $item;
			}

			// Sort A-Z by Heading
			ksort( $glossary_list );

			PT_CV_Functions::set_global_variable( 'glossary_list', $glossary_list );

			// Get HTML of Glossary menu
			$args = PT_CV_Html_Pro::glossary_menu( array_keys( $glossary_list ) );
		}

		/**
		 * Show data-type of each post
		 *
		 * @param string $args    The output HTML
		 * @param string $post_id The post ID
		 *
		 * @return string
		 */
		public static function filter_content_item_filter_value( $args, $post_id ) {
			// Enable filter
			if ( PT_CV_Functions::get_global_variable( 'enable_shuffle_filter' ) ) {
				global $pt_cv_glb;

				if ( !isset( $pt_cv_glb[ 'item_terms' ] ) ) {
					$pt_cv_glb[ 'item_terms' ] = array();
				}

				// Get terms of post
				if ( !isset( $pt_cv_glb[ 'item_terms' ][ $post_id ] ) ) {
					PT_CV_Functions::post_terms( $post_id );
				}
				$terms_of_post = isset( $pt_cv_glb[ 'item_terms' ][ $post_id ] ) ? $pt_cv_glb[ 'item_terms' ][ $post_id ] : array();

				// Sanitize to solving problem with non-latin term name
				$sanitized_terms = array();
				foreach ( array_keys( $terms_of_post ) as $term_slug ) {
					$sanitized_terms[] = PT_CV_Functions::term_slug_sanitize( $term_slug, true );
				}

				$args = sprintf( 'data-groups="%s"', implode( ' ', apply_filters( PT_CV_PREFIX_ . 'post_groups', $sanitized_terms, $post_id ) ) );

				// [shuffle-pagination]
				if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' ) && PT_CV_Functions::get_global_variable( 'current_page' ) > 1 ) {
					// Hide post before append to output by shuffle animation
					if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pagination-type' ) === 'ajax' ) {
						$args .= ' style="opacity:0"';
					}
				}
			}

			// Show post ID
			$args .= sprintf( ' data-pid="%s"', $post_id );

			return $args;
		}

		public static function filter_content_no_post_found_text( $args ) {
			$query_args = PT_CV_Functions::get_global_variable( 'args' );

			// Parent page
			if ( !empty( $query_args[ 'post_parent' ] ) ) {
				$args .= '<br>' . sprintf( __( 'Please change filter setting of %s Parent page %s', 'content-views-pro' ), '<strong>', '</strong>.' );
			}

			// If enable Sort by custom field
			if ( !empty( $query_args[ 'orderby' ] ) && $query_args[ 'orderby' ] === 'meta_value' && PT_CV_Functions_Pro::user_can_manage_view() ) {
				$args .= '<br>' . sprintf( __( 'Please change %s Sort by %s setting (using custom field %s)', 'content-views-pro' ), '<strong>', '</strong>', " <strong>{$query_args[ 'meta_key' ]}</strong>" );
			}

			return $args;
		}

		/**
		 * Filter $content_items variable before display
		 *
		 * @param type $args
		 */
		public static function filter_content_items( $args, $view_type ) {
			$args	 = self::_content_items_stickyposts( $args, $view_type );
			$args	 = self::_content_items_ads( $args, $view_type );
			$args	 = self::sort_post_dragdrop( $args );

			return $args;
		}

		/**
		 * Filter $content_items variable before display: Sticky posts
		 */
		private static function _content_items_stickyposts( $args, $view_type ) {
			$sticky_post_ids = get_option( 'sticky_posts' );
			if ( $sticky_post_ids ) {
				$sticky_posts = PT_CV_Functions::get_global_variable( 'sticky_posts' );

				if ( $sticky_posts == 'prepend' ) {
					$post_ids	 = array_keys( $args );
					$this_sticky = array();

					// Get sticky posts in result list
					$sticky_ids = array_intersect( $sticky_post_ids, $post_ids );

					foreach ( $sticky_ids as $post_id ) {
						$this_sticky[ $post_id ] = $args[ $post_id ];
						unset( $args[ $post_id ] );
					}

					$this_sticky = apply_filters( PT_CV_PREFIX_ . 'sticky_posts_prepend', $this_sticky );

					$args = $this_sticky + $args;
				}

				// Prepend all sticky posts to top of View
				else if ( $sticky_posts == 'prepend-all' ) {

					$current_page = PT_CV_Functions::get_global_variable( 'current_page' );

					// Only do this for first page
					if ( $current_page === 1 ) {
						$content_items_more = array();

						// Get all sticky posts
						$query1 = new WP_Query( array(
							'post__in'				 => $sticky_post_ids,
							'ignore_sticky_posts'	 => 1
							) );
						if ( $query1->have_posts() ) {
							while ( $query1->have_posts() ) {
								$query1->the_post();
								global $post;

								// Output HTML for this item
								$content_items_more[ $post->ID ] = PT_CV_Html::view_type_output( $view_type, $post );
							}
						}

						// Reset query
						PT_CV_Functions::reset_query();

						if ( $content_items_more ) {
							$args = $content_items_more + $args;

							// [stickypostlimit]
							$has_pagination	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' );
							$limit_this_page = (int) ($has_pagination ? PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pagination-items-per-page' ) : PT_CV_Functions::setting_value( PT_CV_PREFIX . 'limit' ));
							if ( $limit_this_page ) {
								$removed_posts_count = count( $args ) - $limit_this_page; // don't use count($content_items_more) because it can contains (sticky) posts which existed in $args

								if ( $removed_posts_count ) {
									$args = PT_CV_Functions_Pro::fre_content_items_slice_to_limit( $args, $limit_this_page, $has_pagination, 'offset_decrease_stickyposts', $removed_posts_count );
								}
							}
						}
					}
				}
			}

			return $args;
		}

		/**
		 * Filter $content_items variable before display: Content Ads
		 */
		private static function _content_items_ads( $args, $view_type ) {
			if ( defined( 'PT_CV_VIEW_REUSE' ) || apply_filters( PT_CV_PREFIX_ . 'no_ads_when_replacing', defined( 'PT_CV_VIEW_OVERWRITE' ) ) || !PT_CV_Functions::get_option_value( 'show_content_ads' ) ) {
				return $args;
			}

			$ads_settings = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'ads-' );
			if ( !empty( $ads_settings[ 'enable' ] ) ) {
				$offset		 = 0;
				$ads_content = (array) PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'ads-content' );
				$all_ads	 = array_filter( $ads_content );

				// What ads to show
				$possible_ads = $all_ads;

				$has_pagination = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-pagination' );
				if ( $has_pagination ) {
					$per_page		 = (int) $ads_settings[ 'per-page' ];
					$current_page	 = PT_CV_Functions::get_global_variable( 'current_page' );

					if ( $current_page > 1 ) {
						$offset = ($current_page - 1) * $per_page;
					}
					if ( $per_page && $all_ads ) {
						$possible_ads = array_slice( $all_ads, $offset, $per_page );
					}
				}

				// What positions to show
				$ads_here = count( $possible_ads );
				if ( $ads_here ) {
					$random_positions	 = range( 0, count( $args ) - 1 );
					$positions_to_insert = (array) array_rand( $random_positions, min( count( $random_positions ), $ads_here ) );
					if ( $positions_to_insert ) {
						foreach ( $possible_ads as $key => $value ) {
							$value	 = str_replace( '\r\n', PHP_EOL, $value );
							$value	 = wp_unslash( $value );

							$args = PT_CV_Functions_Pro::array_insert( (array) $args, current( $positions_to_insert ), array( $key => $value ) );
							next( $positions_to_insert );
						}

						// Slice $content_items to limit
						$limit_this_page = (int) ($has_pagination ? PT_CV_Functions::setting_value( PT_CV_PREFIX . 'pagination-items-per-page' ) : PT_CV_Functions::setting_value( PT_CV_PREFIX . 'limit' ));
						if ( $limit_this_page && $args ) {
							$args = array_slice( $args, 0, $limit_this_page, true );
						}
					}
				}
			}

			return $args;
		}

		private static function sort_post_dragdrop( $args ) {
			if ( defined( 'PT_CV_VIEW_REUSE' ) || defined( 'PT_CV_VIEW_OVERWRITE' ) ) {
				return $args;
			}

			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );
			if ( in_array( 'order', $advanced_settings ) ) {
				$orderby = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'orderby' );
				if ( $orderby[ 0 ] === 'dragdrop' ) {
					$tpids			 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'order-dragdrop-pids' );
					$apids			 = json_decode( wp_unslash( $tpids ), true );
					// Posts order for current page
					$current_page	 = PT_CV_Functions::get_global_variable( 'current_page' );
					if ( !empty( $apids[ "$current_page" ] ) ) {
						$pids_here = array_map( 'intval', $apids[ "$current_page" ] );

						// Reorder posts by drag&drop order
						$args = PT_CV_Functions_Pro::_array_replace( array_flip( $pids_here ), $args, 'prepend' );
					}
				}
			}

			return $args;
		}

		/**
		 * Filter span with
		 *
		 * @param array $args
		 * @param int $span_width
		 *
		 * @return array
		 */
		public static function filter_item_col_class( $args, $span_width ) {
			$allow_xs	 = $allow_sm	 = 1;

			// Custom field
			if ( in_array( PT_CV_PREFIX . 'ctf-column', $args ) ) {
				$allow_xs	 = $allow_sm	 = 0;
			}

			// One ABOVE others columns
			if ( in_array( PT_CV_PREFIX . 'ooc', $args ) && PT_CV_Functions::get_global_variable( 'other_above' ) ) {
				$allow_xs	 = $allow_sm	 = 0;
			}

			// 1 others posts per row
			if ( in_array( PT_CV_PREFIX . 'oop', $args ) && PT_CV_Functions::get_global_variable( 'other_columns' ) <= 1 ) {
				$allow_xs	 = $allow_sm	 = 0;
			}

			if ( $allow_sm ) {
				$tablet_col	 = (int) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'resp-tablet-number-columns' );
				$args[]		 = 'col-sm-' . (int) ( 12 / ($tablet_col ? $tablet_col : 2) );
			}

			if ( $allow_xs ) {
				$mobile_col	 = (int) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'resp-number-columns' );
				$args[]		 = 'col-xs-' . (int) ( 12 / ($mobile_col ? $mobile_col : 1) );
			}

			return $args;
		}

		/**
		 * Exclude sticky posts completely
		 *
		 * @param int   $args
		 * @param array $settings The settings array of View
		 *
		 * @return int
		 */
		public static function filter_post__not_in( $args, $settings ) {
			$sticky_posts = PT_CV_Functions::get_global_variable( 'sticky_posts' );
			if ( $sticky_posts === 'exclude' ) {
				$args = array_merge( (array) $args, get_option( 'sticky_posts' ) );
			}

			return $args;
		}

		/**
		 * Filter parent page ID
		 *
		 * @param array $args
		 */
		public static function filter_post_parent_id( $args ) {
			global $post, $pt_cv_glb;

			// Current page of WP front-end
			$pt_cv_glb[ 'current_post' ] = 0;
			$parent_page_opt			 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'post_parent-auto' );
			if ( $post && !empty( $parent_page_opt ) ) {
				switch ( $parent_page_opt ) {
					case 'all':
					case 'yes':
						$args	 = !empty( $post->post_parent ) ? $post->post_parent : $post->ID;
						break;
					case 'siblings':
						$args	 = !empty( $post->post_parent ) ? $post->post_parent : $args;
						break;
					case 'children':
						$args	 = $post->ID;
						break;
				}

				$pt_cv_glb[ 'current_post' ] = $post->ID;
			}

			// Parent page ID
			$pt_cv_glb[ 'parent_page' ] = $args;

			return $args;
		}

		/**
		 * Show this post or not
		 *
		 * @param array $args
		 *
		 * @return array
		 */
		public static function filter_show_this_post( $args ) {
			global $pt_cv_glb;

			if ( !empty( $pt_cv_glb[ 'current_post' ] ) && $args->ID === $pt_cv_glb[ 'current_post' ] ) {
				$args = 0;
				return $args;
			}

			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );

			/**
			 * Translation plugin
			 */
			$translation_plugin = PT_CV_Functions_Pro::has_translation_plugin();
			if ( $translation_plugin ) {
				$different_language = false;

				if ( $translation_plugin === 'Polylang' ) {
					$language = pll_current_language();

					if ( pll_get_post_language( $args->ID ) !== $language ) {
						$different_language	 = true;
						$translated_id		 = pll_get_post( $args->ID, $language );
					}
				} elseif ( $translation_plugin === 'WPML' ) {
					if ( version_compare( ICL_SITEPRESS_VERSION, '3.2' ) >= 0 ) {
						$post_language = apply_filters( 'wpml_post_language_details', NULL, $args->ID );
					} else {
						$post_language = wpml_get_language_information( $args->ID );
					}

					if ( $post_language[ 'different_language' ] ) {
						$different_language	 = true;
						$translated_id		 = PT_CV_Functions_Pro::wpml_translate_object( $args->ID, $args->post_type );
					}
				} elseif ( $translation_plugin === 'qTranslate' ) {
					global $q_config;
					$translated_content = qtranxf_use( $q_config[ 'language' ], $args->post_content );
					if ( empty( $translated_content ) || strpos( $translated_content, 'qtranxs-available-languages-message' ) !== false ) {
						$different_language	 = true;
						$translated_id		 = 0;
					}
				}

				if ( $different_language ) {
					$hide_different_language = in_array( 'hide_different_language', $advanced_settings );

					if ( $translated_id ) {
						$args	 = $translated_id;
						global $post;
						$post	 = get_post( $translated_id );
					} elseif ( $hide_different_language ) {
						$args = 0;
					}
				}
			}

			/**
			 * 2. Content restriction plugin
			 */
			$membership_plugin = PT_CV_Functions_Pro::has_access_restriction_plugin();
			if ( $args && $membership_plugin && in_array( 'check_access_restriction', $advanced_settings ) ) {

				if ( $membership_plugin === 'Ultimate Member' ) {
					global $post, $ultimatemember;
					$post = $args;
					// Check access setting of this post
					PT_CV_UltimateMember::um_access_post_settings();

					if ( $ultimatemember->access->redirect_handler && !$ultimatemember->access->allow_access ) {
						$args = 0;
					}
				} elseif ( $membership_plugin === 'Members' ) {
					if ( !members_can_current_user_view_post( $args->ID ) ) {
						$args = 0;
					}
				} elseif ( $membership_plugin === 'Paid Memberships Pro' ) {
					$hasaccess = pmpro_has_membership_access( $args->ID, NULL, true );
					if ( is_array( $hasaccess ) ) {
						//returned an array to give us the membership level values
						#$post_membership_levels_ids		 = $hasaccess[ 1 ];
						#$post_membership_levels_names	 = $hasaccess[ 2 ];
						$hasaccess = $hasaccess[ 0 ];
					}

					if ( !$hasaccess ) {
						$args = 0;
					}
				}
			}

			return $args;
		}

		/**
		 * Ignore sticky posts or not
		 *
		 * @param boolean $args
		 */
		public static function filter_ignore_sticky_posts( $args ) {
			$sticky_posts = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'sticky-posts' );

			PT_CV_Functions::set_global_variable( 'sticky_posts', $sticky_posts );

			$args = ( $sticky_posts == 'prepend' ) ? 0 : 1;

			return $args;
		}

		/**
		 * Add more fields to display, such as Social buttons...
		 *
		 * @param array $args
		 * @param object $post Current post object
		 */
		public static function filter_fields_html( $args, $post ) {
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			// Move special field to top
			if ( !empty( $args[ 'special-field' ] ) ) {
				$special_html = $args[ 'special-field' ];
				unset( $args[ 'special-field' ] );
				array_unshift( $args, $special_html );
			}

			// Content on hover: Wrap title, content, meta fields... to a mask
			if ( PT_CV_Functions_Pro::animate_activated_content_hover() ) {
				global $pt_cv_glb, $pt_cv_id;
				$exclude_field = !empty( $pt_cv_glb[ $pt_cv_id ][ 'animation' ][ 'exclude-title' ] ) ? 'title' : apply_filters( PT_CV_PREFIX_ . 'hover_exclude', false );

				$mask_wrapper	 = array();
				$index			 = 0;
				foreach ( $args as $field => $html ) {
					$extra = $exclude_field ? !in_array( $field, (array) $exclude_field ) : true;

					// For Timeline layout: wrap meta fields together
					if ( PT_CV_Functions::get_global_variable( 'view_type' ) === 'timeline' && $field === 'meta-fields' ) {
						$html = PT_CV_Html::_field_meta_wrap( $html );
					}

					if ( $field != 'thumbnail' && $extra ) {
						$index++;
						// Add class to this field
						$class			 = PT_CV_PREFIX . (($index % 2 == 1) ? 'animation-left' : 'animation-right');
						$html			 = preg_replace( '/class="/', 'class="' . $class . ' ', $html, 1 );
						$mask_wrapper[]	 = $html;
						unset( $args[ $field ] );
					}
				}

				$mask_html	 = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'mask', implode( '', $mask_wrapper ) );
				$hover_html	 = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'hover-wrapper', $args[ 'thumbnail' ] . $mask_html );

				$position_order = array_keys( $args );
				unset( $args[ 'thumbnail' ] );

				$args = $args + array( 'thumbnail' => $hover_html );

				// If "Title is always visible without hover" => Display Title in correct position with Thumbnail
				if ( count( $position_order ) > 1 ) {
					$args = PT_CV_Functions_Pro::_array_replace( array_flip( $position_order ), $args );
				}
			}

			// Display social buttons
			$other_settings = $dargs[ 'other-settings' ];
			if ( isset( $other_settings[ 'social-show' ] ) && isset( $other_settings[ 'social-buttons' ] ) ) {
				$buttons_html = array();

				// Get post info
				$url	 = apply_filters( PT_CV_PREFIX_ . 'social_url', get_permalink( $post ) );
				$title	 = urlencode( get_the_title( $post ) );

				// Get thumbnail
				$thumbnail_id	 = get_post_thumbnail_id( $post->ID );
				$media			 = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
				$media_url		 = is_array( $media ) ? $media[ 0 ] : '';
				$media_alt		 = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
				$description	 = $media_alt ? urlencode( $media_alt ) : $title;

				// Display selected buttons
				foreach ( (array) $other_settings[ 'social-buttons' ] as $button ) {
					$social_link = '';

					// Link
					switch ( $button ) {
						case 'facebook':
							$social_link = sprintf( 'https://www.facebook.com/sharer/sharer.php?u=%s', $url );
							break;
						case 'twitter':
							$social_link = sprintf( 'https://twitter.com/intent/tweet?url=%s&text=%s', $url, $title );
							break;
						case 'googleplus':
							$social_link = sprintf( 'https://plus.google.com/share?url=%s', $url );
							break;
						case 'linkedin':
							$social_link = sprintf( 'https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=&source=', $url, $title );
							break;
						case 'pinterest':
							$social_link = sprintf( 'https://pinterest.com/pin/create/bookmarklet/?url=%s&media=%s&description=%s', $url, $media_url, $description );
							break;
					}

					if ( $social_link ) {
						$buttons_html[] = sprintf( '<a href="%s" class="%s" target="_blank"></a>', $social_link, esc_attr( PT_CV_PREFIX . 'social-' . $button ) );
					}
				}

				$args[ 'social-buttons' ] = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'social-buttons', implode( '', $buttons_html ) );
			}

			return $args;
		}

		/**
		 * Filter terms list in output
		 *
		 * @param mixed $args
		 * @return bool
		 */
		public static function filter_terms_to_filter( $args ) {

			// Hide empty terms
			$shufflefilter	 = PT_CV_Functions::get_global_variable( 'enable_shuffle_filter' );
			$hide_empty_term = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-hide-empty' );
			if ( $shufflefilter && !empty( $hide_empty_term ) ) {
				foreach ( $args as $taxonomy => $terms ) {
					foreach ( array_keys( $terms ) as $term ) {
						$term_obj = get_term_by( 'slug', $term, $taxonomy );
						if ( $term_obj->count <= 0 ) {
							unset( $args[ $taxonomy ][ $term ] );
						}
					}
				}
			}

			// WPML & Shuffle filter: fix empty filter text in other languages
			global $sitepress;
			if ( $sitepress ) {
				foreach ( $args as $taxonomy => $terms ) {
					foreach ( array_keys( $terms ) as $term_id ) {
						$term_obj = get_term_by( 'id', $term_id, $taxonomy );
						if ( $term_obj ) {
							// Remove ID data
							unset( $args[ $taxonomy ][ $term_id ] );
							// Add Slug data
							$args[ $taxonomy ][ $term_obj->slug ] = $term_obj->name;
						}
					}
				}
			}

			return $args;
		}

		/**
		 * Detect is mobile
		 * @param bool $args
		 * @return bool
		 */
		public static function filter_is_mobile( $args ) {
			$args = PT_CV_Functions_Pro::is_mobile();
			return $args;
		}

		public static function filter_public_localize_script_extra( $args ) {
			$args[ 'is_mobile_tablet' ] = PT_CV_Functions_Pro::is_mobile_tablet();
			return $args;
		}

		/**
		 * Customize value of Style Settings
		 *
		 * @param array $args
		 */
		public static function filter_style_settings_data( $args ) {
			if ( PT_CV_Functions_Pro::animate_activated_content_hover() ) {
				$args[ 'bgcolor-content' ] = !empty( $args[ 'bgcolor-content' ] ) ? $args[ 'bgcolor-content' ] : '#fcfcfc';
			}

			return $args;
		}

		/**
		 * Filter WordPress core: Allow to search by multiple keywords
		 *
		 * @param array $args
		 *
		 * @return array
		 */
		public static function filter_posts_where_request( $args, $this_ ) {
			global $pt_cv_id;
			if ( !$pt_cv_id ) {
				return $args;
			}

			$query_args = PT_CV_Functions::get_global_variable( 'args' );
			global $wpdb;

			$search_terms = isset( $query_args[ 's' ] ) ? $query_args[ 's' ] : '';
			if ( !$search_terms ) {
				return $args;
			}

			// Split by space, '+'
			$s_terms = preg_split( '/[\s|\+]/', trim( $search_terms ) );

			if ( count( $s_terms ) > 1 ) {
				$query		 = $query_wp4x	 = array();
				$n			 = '%';

				foreach ( $s_terms as $term ) {
					$like			 = "{$n}{$term}{$n}";
					$query[]		 = "(($wpdb->posts.post_title LIKE '$like') OR ($wpdb->posts.post_content LIKE '$like'))";
					$query_wp4x[]	 = "(($wpdb->posts.post_title LIKE '$like') OR ($wpdb->posts.post_excerpt LIKE '$like') OR ($wpdb->posts.post_content LIKE '$like'))";
				}

				// Replace AND by OR
				$args	 = str_replace( implode( ' AND ', $query ), implode( ' OR ', $query ), $args );
				$args	 = str_replace( implode( ' AND ', $query_wp4x ), implode( ' OR ', $query_wp4x ), $args );
			}

			return $args;
		}

		/**
		 * Filter the completed SQL query before sending.
		 *
		 * @param string $args      The complete SQL query.
		 * @param WP_Query $wpquery The WP_Query instance (passed by reference).
		 * @return string
		 */
		public static function filter_posts_request( $args, $wpquery ) {
			$query_args = PT_CV_Functions::get_global_variable( 'args' );

			// Fix: duplicated posts when order randonly & pagination
			if ( isset( $query_args[ PT_CV_PREFIX . 'orp' ] ) ) {
				global $pt_cv_id;
				$transient = PT_CV_PREFIX . 'rseed' . $pt_cv_id;

				// Reset seed on first page
				if ( PT_CV_Functions::get_global_variable( 'current_page' ) === 1 ) {
					delete_transient( $transient );
				}

				// Get seed
				$seed = get_transient( $transient );
				if ( empty( $seed ) ) {
					$seed = rand();
					set_transient( $transient, $seed, 5 * MINUTE_IN_SECONDS );
				}

				$args = str_replace( 'RAND()', "RAND($seed)", $args );
			}

			return $args;
		}

		/**
		 * Reuse a View
		 * operator: IN (default), AND, NOT IN
		 * relation: AND, OR
		 *
		 * [pt_view id="A" author=1]
		 * [pt_view id="A" cat="foo,bar,content"]
		 * [pt_view id="A" tag="foo,bar,content"]
		 * [pt_view id="A" cat="1,2,3" field=id]
		 * [pt_view id="A" tag="1,2,3" field=id]
		 * [pt_view id="A" tag="666" field="slug"] # for numeric value
		 * [pt_view id="A" taxonomy="testimonial" terms="foo,bar"]
		 * [pt_view id="A" taxonomy="testimonial" terms="foo,bar" operator="NOT IN"]
		 * [pt_view id="A" cat="foo,bar" tag="1,2" relation="AND" ] // don't support "operator" of multiple taxonomies
		 * [pt_view id="A" taxonomy="testimonial" terms="foo,bar" taxonomy2="customer" terms2="boo,far"] @since 1.8.9
		 *
		 * @param array $args
		 *
		 * @return int
		 */
		public static function reuse_view( $args ) {
			$shortcode_params = PT_CV_Functions::get_global_variable( 'shortcode_params' );

			if ( !$shortcode_params ) {
				return $args;
			}

			$reuse = 0;

			// Store taxonomy filter query parameters
			$filter_taxonomies	 = $taxonomies			 = $terms				 = array();

			if ( !empty( $shortcode_params[ 'cat' ] ) ) {
				$taxonomies[]	 = 'category';
				$terms[]		 = explode( ',', trim( $shortcode_params[ 'cat' ] ) );
			}

			if ( !empty( $shortcode_params[ 'tag' ] ) ) {
				$taxonomies[]	 = 'post_tag';
				$terms[]		 = explode( ',', trim( $shortcode_params[ 'tag' ] ) );
			}

			if ( !empty( $shortcode_params[ 'taxonomy' ] ) ) {
				$taxonomies[]	 = esc_sql( $shortcode_params[ 'taxonomy' ] );
				$terms[]		 = explode( ',', trim( $shortcode_params[ 'terms' ] ) );
			}

			if ( !empty( $shortcode_params[ 'taxonomy2' ] ) ) {
				$taxonomies[]	 = esc_sql( $shortcode_params[ 'taxonomy2' ] );
				$terms[]		 = explode( ',', trim( $shortcode_params[ 'terms2' ] ) );
			}

			// Only filter if $taxonomy & $terms are configed
			if ( $taxonomies && $terms ) {
				// Get operator
				$operator = strtoupper( !empty( $shortcode_params[ 'operator' ] ) ? $shortcode_params[ 'operator' ] : 'IN'  );
				if ( !in_array( $operator, array( 'IN', 'NOT IN', 'AND' ) ) ) {
					$operator = 'IN';
				}

				$_field = !empty( $shortcode_params[ 'field' ] ) ? $shortcode_params[ 'field' ] : 'slug';

				// Generate array of filter parameters
				foreach ( $taxonomies as $idx => $taxonomy ) {
					// Term of taxonomy
					$term = (array) $terms[ $idx ];

					// Filter by id or slug
					$terms_check = array_map( 'intval', $term );
					$field		 = $_field ? $_field : ( ( $terms_check[ 0 ] != 0 ) ? 'id' : 'slug' );

					$filter_taxonomies[] = array(
						'taxonomy'	 => $taxonomy,
						'field'		 => $field,
						'terms'		 => $term,
						'operator'	 => $operator
					);
				}

				// Multiple taxonomies filter
				if ( count( $taxonomies ) > 1 ) {
					// Get relation
					$relation = strtoupper( !empty( $shortcode_params[ 'relation' ] ) ? $shortcode_params[ 'relation' ] : 'AND'  );

					if ( !in_array( $relation, array( 'OR', 'AND' ) ) ) {
						$relation = 'AND';
					}

					$filter_taxonomies[ 'relation' ] = $relation;
				}

				if ( $filter_taxonomies ) {
					if ( empty( $shortcode_params[ 'reuse_tax_query' ] ) ) {
						// Overwrite tax_query
						$args[ 'tax_query' ] = $filter_taxonomies;
					} else {
						// Reuse tax_query
						$args[ 'tax_query' ] = array_merge( $args[ 'tax_query' ], $filter_taxonomies );
					}

					$reuse++;
				}
			}

			if ( !empty( $shortcode_params[ 'post_id' ] ) ) {
				$values				 = explode( ',', trim( $shortcode_params[ 'post_id' ] ) );
				$args[ 'post__in' ]	 = array_map( 'intval', $values );
				$reuse++;
			}

			if ( !empty( $shortcode_params[ 'author' ] ) ) {
				$values					 = explode( ',', trim( $shortcode_params[ 'author' ] ) );
				$args[ 'author__in' ]	 = array_map( 'intval', $values );
				$reuse++;
			}

			if ( !empty( $shortcode_params[ 'post_type' ] ) ) {
				$args[ 'post_type' ] = $shortcode_params[ 'post_type' ];
				$reuse++;
			}

			if ( !empty( $shortcode_params[ 'post_parent' ] ) ) {
				$args[ 'post_parent' ] = $shortcode_params[ 'post_parent' ];
				$reuse++;
			}

			if ( !empty( $shortcode_params[ 'limit' ] ) ) {
				$args[ 'limit' ]			 = $args[ 'posts_per_page' ]	 = (int) $shortcode_params[ 'limit' ];
				$reuse++;
			}

			if ( !empty( $shortcode_params[ 'keyword' ] ) ) {
				$args[ 's' ] = $shortcode_params[ 'keyword' ];
				$reuse++;
			}

			if ( $reuse ) {
				$args[ 'offset' ] = (int) $shortcode_params[ 'offset' ];
				define( 'PT_CV_VIEW_REUSE', true );
			}

			return $args;
		}

		/**
		 * Print style of views
		 */
		public static function action_print_view_style() {
			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );
			if ( !isset( $dargs ) ) {
				return '';
			}

			ob_start();

			$style_fonts = PT_CV_Html_Pro::view_styles( $dargs[ 'view-style' ] );

			// Print inline style (font family, font style, font size...)
			if ( !empty( $style_fonts[ 'css' ] ) ) {
				printf( PT_CV_Html::inline_style( $style_fonts[ 'css' ] ) );
			}

			// Attach link of google fonts if have
			if ( $style_fonts && is_array( $style_fonts[ 'links' ] ) ) {
				foreach ( $style_fonts[ 'links' ] as $link ) {
					$view_fonts = (array) PT_CV_Functions::get_global_variable( 'included-fonts' );

					if ( !in_array( $link, $view_fonts ) ) {
						printf( "<link href='//fonts.googleapis.com/css?family=%s' rel='stylesheet' type='text/css'>", $link );
						$view_fonts[] = $link;
						PT_CV_Functions::set_global_variable( 'included-fonts', $view_fonts );
					}
				}
			}

			$view_style = ob_get_clean();

			if ( apply_filters( PT_CV_PREFIX_ . 'inline_view_style', 1 ) ) {
				echo $view_style;
			} else {
				if ( !isset( $_SESSION[ PT_CV_PREFIX . 'view-css' ] ) ) {
					$_SESSION[ PT_CV_PREFIX . 'view-css' ] = array();
				}
				$_SESSION[ PT_CV_PREFIX . 'view-css' ][] = $view_style;
			}
		}

		/**
		 * Filter before run query
		 */
		public static function action_before_query() {
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$content_type	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'content-type', $view_settings );

			$action = 'add_filter';
			self::_abq_product( $content_type, $view_settings, $action );
		}

		/**
		 * Filter after run query
		 *
		 */
		public static function action_after_query() {
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$content_type	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'content-type', $view_settings );

			$action = 'remove_filter';
			self::_abq_product( $content_type, $view_settings, $action );
		}

		private static function _abq_product( $content_type, $view_settings, $function ) {
			if ( $content_type === 'product' ) {
				$products_list = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'products-list', $view_settings );
				if ( $products_list === 'top_rated_products' ) {
					$function( 'posts_clauses', array( 'PT_CV_WooCommerce', 'order_by_rating_post_clauses' ) );
				}
			}
		}

		/**
		 * Add custom global variables
		 */
		public static function action_add_global_variables() {
			PT_CV_Functions::set_global_variable( 'enable_shuffle_filter', PT_CV_Functions::setting_value( PT_CV_PREFIX . 'enable-taxonomy-filter' ) && PT_CV_Functions_Pro::check_dependences( 'taxonomy-filter' ) );

			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'show-field-format-icon' ) ) {
				PT_CV_Functions::set_global_variable( 'dashicons', 1 );
			}
		}

		/**
		 * Handle more tag bug (if show Full content, will see more tag in Preview, but not in front-end)
		 */
		public static function action_handle_teaser() {
			global $more;
			$more = 0;
		}

		/**
		 * Enqueue special assets on the fly
		 */
		public static function action_enqueue_assets() {
			if ( PT_CV_Functions::get_global_variable( 'dashicons' ) ) {
				wp_enqueue_style( 'dashicons' );
			}
		}

		/**
		 * Append HTML to post title
		 *
		 * @param string $args  The excerpt output
		 * @param int   $post Post object
		 *
		 * @return string
		 */
		public static function action_item_extra_html( $post ) {
			echo PT_CV_Functions_Pro::show_edit_button( $post );
		}

		private static function _is_attachment( $content_type, $post ) {
			return $content_type === 'attachment' || get_post_type( $post->ID ) === 'attachment';
		}

	}

}
