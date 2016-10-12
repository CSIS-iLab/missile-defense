<?php
/**
 * Contain main functions to work with plugin, post, custom fields...
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Functions_Pro' ) ) {

	/**
	 * @name PT_CV_Functions_Pro
	 * @todo Utility functions
	 */
	class PT_CV_Functions_Pro {
		/**
		 * Check if current user has role to manage Views
		 */
		static function user_can_manage_view() {
			return current_user_can( 'administrator' ) || current_user_can( PT_CV_Functions::get_option_value( 'access_role' ) );
		}

		/**
		 * Get thumbnail dimensions
		 *
		 * @param array $fargs The settings of thumbnail
		 *
		 * @return array
		 */
		static function field_thumbnail_dimensions( $fargs ) {
			$dimensions = array( 0, 0 );

			switch ( $fargs[ 'size' ] ) {
				case PT_CV_PREFIX . 'custom':
					$dimensions = array( (int) $fargs[ 'size-custom-width' ], (int) $fargs[ 'size-custom-height' ] );
					break;
			}

			return $dimensions;
		}

		/**
		 * Convert $options array to array with: key as 'name' of each parameter, value as settings of that parameters
		 *
		 * @param string $prefix  The prefix in name of settings
		 * @param array  $options The options array (contain full paramaters of settings)
		 */
		static function settings_pre_sort( $options ) {
			$result = array();
			foreach ( $options as $option ) {
				if ( $option[ 'params' ] ) {
					foreach ( $option[ 'params' ] as $params ) {
						// If name of setting match with prefix string, add new value is $option with key is that name
						if ( isset( $params[ 'name' ] ) ) {
							$result[ PT_CV_PREFIX . $params[ 'name' ] ] = $option;
						}
					}
				}
			}

			return $result;
		}

		/**
		 * Sort $options array by the order of key in $settings_key array
		 *
		 * @param string $prefix       The prefix in name of settings
		 * @param array  $options      The options array (contain full paramaters of settings)
		 * @param array  $settings_key The array of settings key
		 */
		static function settings_sort( $prefix, $options, $settings_key ) {
			if ( !$settings_key ) {
				return $options;
			}

			$result = array();

			$options = self::settings_pre_sort( $options );

			foreach ( $settings_key as $setting ) {
				// If name of setting match with prefix string, got it name
				if ( isset( $options[ $setting ] ) && substr( $setting, 0, strlen( $prefix ) ) === $prefix ) {
					$result[ $setting ] = $options[ $setting ];
					unset( $options[ $setting ] );
				}
			}

			// Append key which is not in $settings_key to beginning of $result
			$result = array_merge( $options, $result );

			return $result;
		}

		/**
		 * Read top Google fonts
		 *
		 * @return array
		 */
		static function get_google_fonts() {
			$font_data = get_option( PT_CV_PREFIX . 'google-fonts', array() );
			if ( $font_data ) {
				return $font_data;
			}

			// Limit top 50 fonts
			$limit = 50;

			// Google fonts data file
			$file_path = PT_CV_PATH_PRO . 'admin/includes/google-fonts.data';

			if ( file_exists( $file_path ) ) {
				$fp = @fopen( $file_path, 'r' );

				// Read all fonts data
				$contents = '';
				while ( !feof( $fp ) ) {
					$contents .= fread( $fp, 8192 );
				}

				$data	 = json_decode( $contents, true );
				$items	 = isset( $data[ 'items' ] ) ? $data[ 'items' ] : array();

				// Get top fonts
				$top_fonts = array_slice( (array) $items, 0, $limit );

				// Get font family, variants
				foreach ( $top_fonts as $font ) {
					$font_data[ $font[ 'family' ] ] = $font[ 'variants' ];
				}

				add_option( PT_CV_PREFIX . 'google-fonts', $font_data );

				fclose( $fp );
			}

			return $font_data;
		}

		/**
		 * Generate background position for each Google font
		 */
		static function get_google_fonts_background_position() {

			$css = array();

			// Get font list
			$fonts_list	 = PT_CV_Values_Pro::font_families();
			$fonts_name	 = array_keys( $fonts_list );

			// Set background for each font by font name
			foreach ( $fonts_name as $idx => $name ) {
				$css[] = sprintf( '.select2-results li.%s { background-position: 0 -%spx }', PT_CV_PREFIX . 'font-' . sanitize_title( $name ), ( 40 * $idx + 10 ) );
			}

			return implode( "\n", $css );
		}

		/**
		 * Get selected terms or all terms of selected taxonomies
		 *
		 * @global array $query_args
		 *
		 * @param array  $taxonomies_to_get Array of taxonomies
		 *
		 * @return array
		 */
		public static function get_selected_terms( $taxonomies_to_get ) {

			if ( empty( $taxonomies_to_get ) ) {
				return array();
			}

			// Check if term as_heading
			$view_settings	 = PT_CV_Functions::get_global_variable( 'view_settings' );
			$term_as_heading = PT_CV_Functions_Pro::taxonomy_custom_setting_enable( $view_settings, 'taxonomy-term-info', 'as_heading' );

			// Get query args
			$query_args	 = PT_CV_Functions::get_global_variable( 'args' );
			$terms_info	 = isset( $query_args[ 'tax_query' ] ) ? $query_args[ 'tax_query' ] : array();

			// Don't need relation in this case
			if ( isset( $terms_info[ 'relation' ] ) ) {
				unset( $terms_info[ 'relation' ] );
			}

			// Get all terms of selected taxonomy
			$terms_of_taxonomies = array();
			foreach ( (array) $taxonomies_to_get as $taxonomy ) {
				PT_CV_Values::term_of_taxonomy( $taxonomy, $terms_of_taxonomies );
			}

			// If select some terms in one/some taxonomy
			if ( $terms_info ) {
				foreach ( $terms_info as $term_info ) {
					// Current taxonomy
					$taxonomy = $term_info[ 'taxonomy' ];

					if ( is_array( $term_info[ 'terms' ] ) ) {
						// If "NOT IN" this list
						if ( $term_info[ 'operator' ] == 'NOT IN' ) {
							foreach ( $term_info[ 'terms' ] as $term_slug ) {
								unset( $terms_of_taxonomies[ $taxonomy ][ $term_slug ] );
							}
						} else {
							$all_terms_of_taxo = $terms_of_taxonomies[ $taxonomy ];
							unset( $terms_of_taxonomies[ $taxonomy ] );
							foreach ( $term_info[ 'terms' ] as $idx => $term_slug ) {
								// If term as_heading: get term slug if field = id for the first term only
								if ( $term_as_heading && $term_info[ 'field' ] == 'id' && $idx == 0 ) {
									$term		 = get_term( (int) $term_slug, $taxonomy );
									$term_slug	 = $term->slug;
								}

								$terms_of_taxonomies[ $taxonomy ][ $term_slug ] = $all_terms_of_taxo[ $term_slug ];
							}
						}
					}
				}
			}

			// Reorder by order of taxonomies in $taxonomies_to_get
			return PT_CV_Functions_Pro::_array_replace( array_flip( $taxonomies_to_get ), $terms_of_taxonomies );
		}

		/**
		 * array_replace is a php 5.3+ function, this is needed to support the oldies
		 *
		 * @param array $base_order		Order to sort
		 * @param array $reorder_arr	Array to sort by order
		 * @param string $action
		 * @return array
		 */
		static function _array_replace( $base_order, $reorder_arr, $action = 'append' ) {
			$result = array();
			foreach ( array_keys( $base_order ) as $key ) {
				if ( isset( $reorder_arr[ $key ] ) ) {
					$result[ $key ] = $reorder_arr[ $key ];
					unset( $reorder_arr[ $key ] );
				}
			}

			// Append remain elements in $reorder_arr to $result
			if ( $action === 'append' ) {
				$result += $reorder_arr;
			} else {
				$result = $reorder_arr + $result;
			}

			return $result;
		}

		/**
		 * Shuffle array but reserver keys
		 *
		 * @param array $array The array to shuffle
		 *
		 * @return array
		 */
		static function shuffle_assoc( $array ) {
			// Initialize
			$shuffled_array = array();


			// Get array's keys and shuffle them.
			$shuffled_keys = array_keys( $array );
			shuffle( $shuffled_keys );


			// Create same array, but in shuffled order.
			foreach ( $shuffled_keys AS $shuffled_key ) {

				$shuffled_array[ $shuffled_key ] = $array[ $shuffled_key ];
			} // foreach
			// Return
			return $shuffled_array;
		}

		/**
		 * Overwrite WordPress layout by CVPro layout
		 * http://docs.contentviewspro.com/completely-replace-wordpress-layout-by-content-views-pro-layout/
		 *
		 * @global object $pt_cv_glb
		 * @global string $pt_cv_id
		 * @global object $wp_query
		 * @global object $post
		 * @return string
		 */
		static function view_overwrite_tpl() {

			define( 'PT_CV_VIEW_OVERWRITE', true );

			/* Backward compatible */
			$args_count	 = func_num_args();
			$args_list	 = func_get_args();

			// Default value
			$id			 = 0;
			$posts		 = array();
			$query_obj	 = NULL;
			$pagination	 = false; // Use theme pagination by default
			$rebuild	 = false; // Use theme limit value by default

			$existed_params = array( 'id', 'posts', 'query_obj', 'pagination' );

			switch ( $args_count ) {
				case 1:
					$param = $args_list[ 0 ];
					if ( is_string( $param ) ) {
						$id = $param;
					} elseif ( is_array( $param ) ) {
						extract( $param );
					}
					break;

				case 2:
				case 3:
				case 4:
					foreach ( $existed_params as $index => $name ) {
						if ( isset( $args_list[ $index ] ) ) {
							$$name = $args_list[ $index ];
						}
					}

					break;
			}
			/* End Backward compatible */

			// View settings
			$view_settings = PT_CV_Functions::view_get_settings( $id );

			if ( !$rebuild ) {
				global $pt_cv_glb, $pt_cv_id;

				if ( !isset( $pt_cv_glb ) ) {
					$pt_cv_glb = array();
				}

				// Get content type & view type
				$content_type	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'content-type', $view_settings );
				$view_type		 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'view-type', $view_settings );

				// Set global variable
				$pt_cv_id									 = $id;
				$pt_cv_glb[ $pt_cv_id ][ 'view_settings' ]	 = $view_settings;
				$pt_cv_glb[ $pt_cv_id ][ 'content_type' ]	 = $content_type;
				$pt_cv_glb[ $pt_cv_id ][ 'view_type' ]		 = $view_type;

				$dargs	 = $args	 = array();
				$dargs	 = apply_filters( PT_CV_PREFIX_ . 'all_display_settings', PT_CV_Functions::view_display_settings( $view_type, $dargs ) );

				PT_CV_Functions::view_get_pagination_settings( $dargs, $args, array() );
				$pt_cv_glb[ $pt_cv_id ][ 'dargs' ] = $dargs;

				do_action( PT_CV_PREFIX_ . 'before_process_item' );
				$content_items = array();
				if ( $posts ) {
					foreach ( $posts as $post ) {
						if ( is_object( $post ) ) {
							setup_postdata( $post );
							// Output HTML for this item
							$content_items[ $post->ID ] = PT_CV_Html::view_type_output( $view_type, $post );
						}
					}
				} else {
					// The Loop
					while ( $query_obj ? $query_obj->have_posts() : have_posts() ) : $query_obj ? $query_obj->the_post() : the_post();
						global $post;

						// Output HTML for this item
						$content_items[ $post->ID ] = PT_CV_Html::view_type_output( $view_type, $post );
					endwhile;
				}

				do_action( PT_CV_PREFIX_ . 'after_process_item' );

				// Filter array of items
				$content_items = apply_filters( PT_CV_PREFIX_ . 'content_items', $content_items, $view_type );

				// Wrap items to a wrapper
				$view_html = PT_CV_Html::content_items_wrap( $content_items, 1, count( $content_items ), $id );

				// Clear to prevent the element to shift up in the remaining space
				$view_html .= '<div style="clear: both;"></div>';

				// Show pagination
				$view_html .= $pagination ? self::paginate_links() : '';
			} else {
				// Rebuild whole output with custom pagination in View
				global $wp_query;
				$wp_query->query_vars[ 'post_status' ]		 = 'publish';
				$view_settings[ PT_CV_PREFIX . 'rebuild' ]	 = $wp_query->query_vars;
				$view_settings[ PT_CV_PREFIX . 'limit' ]	 = '-1';

				// Show View output
				$view_html = PT_CV_Functions::view_process_settings( $id, $view_settings );
			}

			return PT_CV_Functions::view_final_output( $view_html );
		}

		/**
		 * Show pagination
		 */
		static function paginate_links() {
			ob_start();
			?>
			<div class="text-center <?php echo PT_CV_PREFIX; ?>pagination-wrapper">
				<?php
				global $wp_query;
				$pagination = paginate_links( array(
					'base'		 => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format'	 => '?paged=%#%',
					'current'	 => max( 1, absint( get_query_var( 'paged' ) ) ),
					'total'		 => $wp_query->max_num_pages,
					'type'		 => 'array',
					'prev_text'	 => '&laquo;',
					'next_text'	 => '&raquo;',
					'prev_next'	 => false,
					) );
				?>
				<?php if ( !empty( $pagination ) ) : ?>
					<ul class="<?php echo PT_CV_PREFIX; ?>pagination pagination" style="background-color: transparent !important;">
						<?php
						foreach ( $pagination as $page_link ) :
							$class = (strpos( $page_link, 'current' ) !== false) ? 'active' : '';
							?>
							<li class="<?php echo $class; ?>">
								<?php echo str_replace( array( 'span', 'page-numbers' ), array( 'a', '' ), $page_link ) ?>
							</li>
						<?php endforeach ?>
					</ul>
				<?php endif ?>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Get width, height of a size name (thumbnail, full, custom-size...)
		 *
		 * @global type  $_wp_additional_image_sizes
		 *
		 * @param string $size_name The size name
		 *
		 * @return array
		 */
		static function get_dimensions_of_size( $size_name ) {
			// All available thumbnail sizes
			global $_wp_additional_image_sizes;

			$this_size = array();
			if ( in_array( $size_name, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$this_size[] = get_option( $size_name . '_size_w' );
				$this_size[] = get_option( $size_name . '_size_h' );
			} else {
				if ( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $size_name ] ) ) {
					$this_size[ 'width' ]	 = $_wp_additional_image_sizes[ $size_name ][ 'width' ];
					$this_size[ 'height' ]	 = $_wp_additional_image_sizes[ $size_name ][ 'height' ];
				} else {
					$this_size = array( 0, 0 );
				}
			}

			return $this_size;
		}

		/**
		 * Filter by date
		 *
		 * @param array $args
		 */
		static function filter_by_date( &$args ) {

			$advanced_settings = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings' );

			if ( in_array( 'date', $advanced_settings ) ) {
				$date_fields = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'post_date_' );
				if ( $date_fields ) {
					// Get filter value
					$date_value = isset( $date_fields[ 'value' ] ) ? $date_fields[ 'value' ] : '';
					if ( $date_value ) {
						$date_query = array();

						switch ( $date_value ) {
							case 'today':
								$date		 = getdate();
								$date_query	 = array(
									'year'	 => $date[ 'year' ],
									'month'	 => $date[ 'mon' ],
									'day'	 => $date[ 'mday' ],
								);
								break;

							case 'from_today':
								$date		 = getdate();
								$date_query	 = array(
									'year'		 => $date[ 'year' ],
									'month'		 => $date[ 'mon' ],
									'day'		 => $date[ 'mday' ],
									'compare'	 => '>=',
								);
								break;

							case 'yesterday':
								$today		 = date( 'm/d/Y' );
								$yesterday	 = date( 'm/d/Y', strtotime( '-1 day', strtotime( $today ) ) );
								$date		 = date_parse( $yesterday );

								$date_query = array(
									'year'	 => $date[ 'year' ],
									'month'	 => $date[ 'month' ],
									'day'	 => $date[ 'day' ],
								);
								break;

							case 'this_week':
								$date_query = array(
									'year'	 => date( 'Y' ),
									'week'	 => date( 'W' ),
								);
								break;

							case 'this_month':
								$date_query = array(
									'year'	 => date( 'Y' ),
									'month'	 => date( 'n' ),
								);
								break;

							case 'this_year':
								$date_query = array(
									'year' => date( 'Y' ),
								);
								break;

							// Time Ago
							case 'week_ago':
							case 'month_ago':
							case 'year_ago':
								$date_query = array(
									'column' => 'post_date',
									'after'	 => sprintf( '1 %s ago', str_replace( '_ago', '', $date_value ) ),
								);
								break;

							// Custom date
							case 'custom_date':
								if ( trim( $date_fields[ 'custom_date' ] ) != '' ) {
									$date = date_parse( $date_fields[ 'custom_date' ] );
									if ( $date ) {
										$date_query = array(
											'year'	 => $date[ 'year' ],
											'month'	 => $date[ 'month' ],
											'day'	 => $date[ 'day' ],
										);
									}
								}
								break;

							// Custom From - To
							case 'custom_time':
								$today = date( 'm/d/Y' );
								if ( trim( $date_fields[ 'from' ] ) == '' ) {
									$date_fields[ 'from' ] = $today;
								}
								if ( trim( $date_fields[ 'to' ] ) == '' ) {
									$date_fields[ 'to' ] = $today;
								}

								$from	 = date_parse( $date_fields[ 'from' ] );
								$to		 = date_parse( $date_fields[ 'to' ] );

								if ( $from && $to ) {
									$date_query = array(
										'after'		 => array(
											'year'	 => $from[ 'year' ],
											'month'	 => $from[ 'month' ],
											'day'	 => $from[ 'day' ],
										),
										'before'	 => array(
											'year'	 => $to[ 'year' ],
											'month'	 => $to[ 'month' ],
											'day'	 => $to[ 'day' ],
										),
										'inclusive'	 => true,
									);
								}
								break;
						}

						if ( $date_query ) {
							$args[ 'date_query' ] = array( $date_query );
						}
					}
				}
			}
		}

		/**
		 * Check dependences before do action
		 *
		 * @param string $key Key of feature
		 */
		static function check_dependences( $key ) {
			if ( !$key ) {
				return true;
			}

			$dargs		 = PT_CV_Functions::get_global_variable( 'dargs' );
			$view_type	 = PT_CV_Functions::get_global_variable( 'view_type' );

			// Shuffle filter
			if ( $key == 'taxonomy-filter' ) {
				$view_settings		 = PT_CV_Functions::get_global_variable( 'view_settings' );
				$advanced_settings	 = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings', $view_settings );
				if ( in_array( 'taxonomy', $advanced_settings ) && !empty( $view_settings[ PT_CV_PREFIX . 'taxonomy' ] ) ) {
					return true;
				} else {
					return false;
				}
			}

			// Animation - content hover
			if ( $key == 'content-hover' ) {
				return true;
			}

			// Same height
			if ( $key == 'same-height' && $view_type == 'grid' ) {
				return true;
			}

			// Read more - text link
			if ( $key == 'text-link' && isset( $dargs[ 'field-settings' ][ 'content' ][ 'readmore' ] ) && isset( $dargs[ 'field-settings' ][ 'content' ][ 'readmore-textlink' ] ) && $dargs[ 'field-settings' ][ 'content' ][ 'readmore-textlink' ] === 'yes' ) {
				return true;
			}

			// special-field
			if ( $key === 'special-field' && in_array( $view_type, array( 'grid', 'pinterest', 'masonry', 'one_others' ) ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Check if animation - show Content on hover is activated and ready to use
		 */
		static function animate_activated_content_hover() {
			// Return if processed
			$hover_enable = PT_CV_Functions::get_global_variable( 'content_hover_enable' );
			if ( isset( $hover_enable ) ) {
				return $hover_enable;
			}

			// Get Animation settings
			$animation = PT_CV_Functions::get_global_variable( 'animation' );
			if ( !isset( $animation ) ) {
				$animation = PT_CV_Functions::settings_values_by_prefix( PT_CV_PREFIX . 'anm-' );
				PT_CV_Functions::set_global_variable( 'animation', $animation );
			}

			$hover_enable = isset( $animation[ 'content-hover' ] ) && PT_CV_Functions_Pro::check_dependences( 'content-hover' );

			if ( $hover_enable ) {
				// Show ERROR
				$dargs = PT_CV_Functions::get_global_variable( 'dargs' );
				if ( !in_array( 'thumbnail', $dargs[ 'fields' ] ) ) {
					die( PT_CV_Functions::debug_output( 'thumbnail_not_selected', __( 'Please enable showing thumbnail', 'content-views-pro' ) ) );
				}

				// Disable on mobile devices
				$disable_onmobile = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'anm-disable-onmobile' );
				if ( $disable_onmobile && PT_CV_Functions_Pro::is_mobile() ) {
					$hover_enable = false;
				}
			}

			PT_CV_Functions::set_global_variable( 'content_hover_enable', $hover_enable );

			return $hover_enable;
		}

		/**
		 * Return human readable date
		 *
		 * @param string $date
		 * @return string
		 */
		static function date_human( $date ) {
			return sprintf( __( '%s ago', 'content-views-pro' ), human_time_diff( $date, current_time( 'timestamp' ) ) );
		}

		/**
		 * Try to convert an attachment URL into a post ID.
		 *
		 * @global wpdb $wpdb WordPress database access abstraction object.
		 *
		 * @param string $url The URL to resolve.
		 * @return int The found post ID.
		 */
		static function attachment_url_to_postid( $url ) {
			global $wpdb;

			$dir	 = wp_upload_dir();
			$path	 = ltrim( $url, $dir[ 'baseurl' ] . '/' );

			$sql	 = $wpdb->prepare(
				"SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s", $path
			);
			$post_id = $wpdb->get_var( $sql );
			if ( !empty( $post_id ) ) {
				return (int) $post_id;
			}
		}

		/**
		 * Get attachment ID from attachment URL
		 *
		 * @param string $url
		 * @return int
		 */
		static function get_attachment_id_by_url( $url ) {
			$dir = wp_upload_dir();

			// Strip baseurl
			if ( 0 === strpos( $url, $dir[ 'baseurl' ] . '/' ) ) {
				$url = substr( $url, strlen( $dir[ 'baseurl' ] . '/' ) );
			}

			// Get original url (without width, height)
			$matches = array();
			if ( preg_match( '/^(.*)(\-\d*x\d*)(\.\w{1,})/i', $url, $matches ) ) {
				$url = $dir[ 'baseurl' ] . '/' . $matches[ 1 ] . $matches[ 3 ];
			}
			$post_id = self::attachment_url_to_postid( $url );

			return (int) $post_id;
		}

		/**
		 * Resize image on the fly
		 *
		 * @param  int     $attachment_id Attachment ID
		 * @param  int     $width         Width
		 * @param  int     $height        Height
		 * @param  boolean $crop          Crop or not
		 *
		 * @return string|bool            URL of resized image, false if error
		 */
		static function resize_image( $attachment_id, $width, $height, $crop = true ) {
			// Get upload directory info
			$upload_info = wp_upload_dir();
			$upload_dir	 = $upload_info[ 'basedir' ];
			$upload_url	 = $upload_info[ 'baseurl' ];

			// Get file path info
			$path = get_attached_file( $attachment_id );

			// Regenerate image
			$force_regenerate = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-thumbnail-regenerate' );
			if ( !$force_regenerate ) {
				$path_info	 = pathinfo( $path );
				$ext		 = $path_info[ 'extension' ];
				$rel_path	 = str_replace( array( $upload_dir, ".$ext" ), '', $path );
				$suffix		 = "{$width}x{$height}";

				// If custom image exists => do nothing
				if ( file_exists( "{$upload_dir}{$rel_path}-{$suffix}.{$ext}" ) ) {
					return "{$upload_url}{$rel_path}-{$suffix}.{$ext}";
				}
			}

			// Generate image with custom width x height & crop
			$generated_image = self::image_make_intermediate_size( $path, $width, $height, $crop );
			if ( isset( $generated_image[ 'path' ] ) ) {
				return str_replace( $upload_dir, $upload_url, $generated_image[ 'path' ] );
			}

			// Get full size (crazy but need to check if full image exists, because sometimes it doesn't)
			if ( file_exists( $path ) )
				return str_replace( $upload_dir, $upload_url, $path );

			return null;
		}

		/**
		 * Clone WP image_make_intermediate_size(), but do not "unset( $resized_file['path'] );"
		 *
		 * @param string $file File path.
		 * @param int $width Image width.
		 * @param int $height Image height.
		 * @param bool $crop Optional, default is false. Whether to crop image to specified height and width or resize.
		 * @return bool|array False, if no image was created. Metadata array on success.
		 */
		static function image_make_intermediate_size( $file, $width, $height, $crop = false ) {
			if ( $width || $height ) {
				$editor = wp_get_image_editor( $file );

				if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
					return false;

				$resized_file = $editor->save();

				if ( !is_wp_error( $resized_file ) && $resized_file ) {
					return $resized_file;
				}
			}
			return false;
		}

		/**
		 * Check if remote file exists
		 *
		 * @param string $file File url
		 * @return boolean
		 */
		static function check_remote_file_exist( $file ) {
			$file_headers = @get_headers( $file );
			if ( $file_headers[ 0 ] == 'HTTP/1.1 404 Not Found' ) {
				$exists = false;
			} else {
				$exists = true;
			}

			return $exists;
		}

		/**
		 * Get heading word for Shuffle filter list
		 *
		 * @return type
		 */
		static function shuffle_filter_group_setting( $idx = 0, $setting = 'heading-word' ) {
			$heading_word	 = PT_CV_Functions::setting_value( PT_CV_PREFIX . 'taxonomy-filter-' . $setting );
			$words			 = explode( ',', $heading_word );
			$all_text		 = !empty( $words[ $idx ] ) ? trim( $words[ $idx ] ) : ($setting === 'heading-word' ? __( 'All', 'content-views-pro' ) : 'and');

			return $all_text;
		}

		/**
		 * Check if this is mobile (exclude tablets)
		 * @return type
		 */
		static function is_mobile() {
			$detect = new Mobile_Detect_CV();
			return $detect->isMobile() && !$detect->isTablet();
		}

		static function is_mobile_tablet() {
			$detect = new Mobile_Detect_CV();
			return $detect->isMobile() || $detect->isTablet();
		}

		/**
		 * Show Edit Post button
		 * @param object $post
		 * @return string
		 */
		static function show_edit_button( $post ) {
			$args = '';

			$show_edit_post = PT_CV_Functions::get_option_value( 'show_edit_post' );
			if ( PT_CV_Functions_Pro::user_can_manage_view() && !empty( $show_edit_post ) ) {
				$args = sprintf( '<a href="%s" class="%s" target="_blank">%s</a>', get_edit_post_link( is_object( $post ) ? $post->ID : $post  ), PT_CV_PREFIX . 'edit-post', __( 'Edit Post' ) );
			}

			return $args;
		}

		/**
		 * Check if filter by Taxonomy is checked & custom setting is selected
		 * @param array $view_settings
		 * @param string $field
		 * @param string $value
		 * @return boolean
		 */
		static function taxonomy_custom_setting_enable( $view_settings, $field, $value = '' ) {
			$advanced_settings	 = (array) PT_CV_Functions::setting_value( PT_CV_PREFIX . 'advanced-settings', $view_settings );
			$enable				 = false;
			if ( in_array( 'taxonomy', $advanced_settings ) ) {
				$enable = isset( $view_settings[ PT_CV_PREFIX . $field ] );
				if ( $value != '' ) {
					$enable = $enable && $view_settings[ PT_CV_PREFIX . $field ] == $value;
				}
			}

			return $enable;
		}

		/**
		 * Callback function for ajax Search by title
		 */
		static function ajax_callback_search_by_title() {
			// Validate request
			check_ajax_referer( PT_CV_PREFIX_ . 'ajax_nonce', 'ajax_nonce' );

			// Extract post data
			parse_str( $_POST[ 'data' ] );

			// Show View output
			$posts = self::search_by_title( $search_title, $post_type );
			echo json_encode( $posts );

			// Must exit
			die;
		}

		/**
		 * Search posts by title
		 *
		 * @param string $search_title
		 * @param string $post_type
		 * @return object
		 */
		static function search_by_title( $search_title, $post_type ) {
			$args = array(
				'post_type'			 => $post_type,
				'posts_per_page'	 => -1,
				'cvp_search_title'	 => $search_title,
				'post_status'		 => ($post_type === 'attachment') ? 'any' : 'publish',
			);

			// Add filter to search posts by Title
			add_filter( 'posts_where', array( __CLASS__, 'search_post_by_title_filter' ), 10, 2 );

			$the_query = new WP_Query( $args );

			// The Loop
			$posts = array();
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$posts[] = array( 'id' => get_the_ID(), 'title' => get_the_title() );
				}
			}

			// Restore original Post Data
			PT_CV_Functions::reset_query();

			// Remove filter to search posts by Title
			remove_filter( 'posts_where', array( __CLASS__, 'search_post_by_title_filter' ), 10, 2 );

			return $posts;
		}

		// Modify WP query by adding "title LIKE" sub query
		static function search_post_by_title_filter( $where, &$wp_query ) {
			global $wpdb;

			$search_term = $wp_query->get( 'cvp_search_title' );
			if ( $search_term ) {
				$where .= ' AND LOWER(' . $wpdb->posts . '.post_title) LIKE LOWER(\'%' . esc_sql( $wpdb->esc_like( $search_term ) ) . '%\')';
			}

			return $where;
		}

		/**
		 * Delete a cookie
		 * @param string $cookie_name Cookie name
		 */
		static function delete_cookie( $cookie_name ) {
			if ( !headers_sent() ) {
				unset( $_COOKIE[ $cookie_name ] );
				setcookie( $cookie_name, '', time() - 1, '/' );
			}
		}

		/**
		 * Get terms ID from slug
		 *
		 * @param array $terms
		 * @param string $taxonomy
		 * @return array
		 */
		static function get_terms_id( $terms, $taxonomy ) {
			$ids = array();

			foreach ( $terms as $slug ) {
				$term	 = get_term_by( 'slug', $slug, $taxonomy );
				$ids[]	 = $term->term_id;
			}

			return $ids;
		}

		/**
		 * Try to regenerate image inside post content
		 *
		 * @param string $img Image src
		 * @return string
		 */
		static function resize_image_by_url( $img, $dimensions ) {
			// If select "Custom size" for thumbnail
			if ( PT_CV_Functions::setting_value( PT_CV_PREFIX . 'field-thumbnail-size' ) === PT_CV_PREFIX . 'custom' ) {
				// Get $attachment_id
				$original_img	 = preg_replace( '/-\d+x\d+/', '', $img ); // Remove widthxheight in image URL
				$attachment_id	 = self::get_image_id_by_url( $original_img );

				if ( $attachment_id && count( $dimensions ) == 2 ) {
					$resized_img = PT_CV_Functions_Pro::resize_image( $attachment_id, $dimensions[ 0 ], $dimensions[ 1 ] );

					if ( $resized_img ) {
						$img = $resized_img;
					}
				}
			}

			return $img;
		}

		/**
		 * Get image ID from URL
		 *
		 * @global wpdb $wpdb
		 * @param string $image_url Image URL (without widthxheight)
		 * @return int
		 */
		static function get_image_id_by_url( $image_url ) {
			global $wpdb;
			$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
			return !empty( $attachment[ 0 ] ) ? $attachment[ 0 ] : 0;
		}

		/**
		 * @return string|boolean
		 */
		static function has_access_restriction_plugin() {
			if ( class_exists( 'UM_API' ) ) {
				return 'Ultimate Member';
			}
			if ( function_exists( 'members_can_current_user_view_post' ) ) {
				return 'Members';
			}
			if ( function_exists( 'pmpro_has_membership_access' ) ) {
				return 'Paid Memberships Pro';
			}

			return false;
		}

		/**
		 * @return string|boolean
		 */
		static function has_translation_plugin() {
			if ( function_exists( 'pll_current_language' ) ) {
				return 'Polylang';
			}
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				return 'WPML';
			}
			if ( function_exists( 'qtranxf_use' ) ) {
				return 'qTranslate';
			}

			return false;
		}

		/**
		 * WPML return ID in current language of selected object
		 *
		 * @param int $id
		 * @param string $type
		 * @return type
		 */
		static function wpml_translate_object( $id, $type ) {
			$wpml_gt_32 = defined( 'ICL_SITEPRESS_VERSION' ) && version_compare( ICL_SITEPRESS_VERSION, '3.2' ) >= 0;

			return $wpml_gt_32 ? apply_filters( 'wpml_object_id', $id, $type ) : icl_object_id( $id, $type, false );
		}

		/**
		 * Get share count for posts
		 * [ post1: [service1:'count1', service2:'count2'],... ]
		 */
		static function ajax_callback_share_count() {
			if ( !isset( $_POST[ 'posts' ] ) || !isset( $_POST[ 'services' ] ) ) {
				die;
			}

			$result		 = array();
			$services	 = (array) $_POST[ 'services' ];

			foreach ( (array) $_POST[ 'posts' ] as $id ) {
				$result[ $id ]	 = array();
				$buttons		 = array( 'url' => get_permalink( $id ), ) + array_flip( $services );
				$social_counts	 = new PT_CV_Social_Share_Count( $buttons );

				if ( $social_counts ) {
					foreach ( $services as $button ) {
						if ( !isset( $social_counts->socialCounts[ $button ] ) ) {
							continue;
						}
						$result[ $id ][ $button ] = sprintf( '<span class="%s">%s</span>', PT_CV_PREFIX . 'social-badge', $social_counts->socialCounts[ $button ] );
					}
				}
			}

			// Show output
			echo json_encode( $result );

			// Must exit
			die;
		}

		/**
		 * Insert partial array to specific position in another array
		 *
		 * @param array $args
		 * @param int $position
		 * @param array $insert
		 * @return array
		 */
		static function array_insert( $args, $position, $insert ) {
			if ( $position >= 0 ) {
				return array_slice( $args, 0, $position, true ) + $insert + array_slice( $args, $position, null, true );
			}
			return $args;
		}

		/**
		 * Trim $content_items and update offset modification
		 *
		 * @global string $pt_cv_id
		 * @param array $args
		 * @param int $limit_this_page
		 * @param bool $has_pagination
		 * @param string $transient
		 * @param int $removed_posts_count
		 * @return array
		 */
		static function fre_content_items_slice_to_limit( $args, $limit_this_page, $has_pagination, $transient, $removed_posts_count ) {
			// Slice $content_items to limit
			$args = array_slice( $args, 0, $limit_this_page, true );

			// Add transient to decrease offset in next pages
			if ( $has_pagination && $removed_posts_count ) {
				global $pt_cv_id;
				set_transient( PT_CV_PREFIX . $pt_cv_id . $transient, $removed_posts_count, 12 * HOUR_IN_SECONDS );
			}

			return $args;
		}

		static function is_pin_mas() {
			$view_type = PT_CV_Functions::get_global_variable( 'view_type' );
			return ( $view_type === 'pinterest' || $view_type === 'masonry' ) ? $view_type : false;
		}

	}

}