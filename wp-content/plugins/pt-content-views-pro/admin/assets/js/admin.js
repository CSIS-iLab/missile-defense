/**
 * Common scripts for Admin
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */

( function ( $ ) {
	"use strict";

	$.PT_CV_Admin_Pro = $.PT_CV_Admin_Pro || { };
	PT_CV_ADMIN_PRO = PT_CV_ADMIN_PRO || { };
	PT_CV_PUBLIC = PT_CV_PUBLIC || { };
	ajaxurl = ajaxurl || { };

	$.PT_CV_Admin_Pro = function ( options ) {
		this.options = options;

		var _prefix = this.options._prefix;

		this._search_by_title();
		this._colorpicker();
		this._public_trigger();
		this._custom_field();
		this._datepicker();
		this._custom_text_bg_color();
		this._duplicate_view();
		this._custom_trigger();
		this._popover();
		this._select2_for_font_families();
		this._toggle_font_styles();
		this._sortable_params();
		this._toggle_select_terms();
		this._pagination_disable();
		this._shuffle_filter_constraint();
		this._toggle_field_settings();

		// View type select2 with icons
		if ( $( '[name="' + _prefix + 'view-type"]' ).is( 'select' ) ) {
			var formatLayout = function ( layout ) {
				if ( !layout.id ) {
					return layout.text;
				}
				return '<span><img src="' + PT_CV_ADMIN_PRO.layout_image_dir + layout.id.toLowerCase() + '.png" class="cvp-layout-flag" /> ' + layout.text + '</span>';
			};

			$( '[name="' + _prefix + 'view-type"]' ).select2( {
				dropdownCssClass: 'cvp-layouts',
				formatResult: formatLayout,
				formatSelection: formatLayout
			} );
		}


		// Prevent clicking in filter options
		$( '.pt-params .' + _prefix + 'filter-bar a' ).click( function ( e ) {
			e.preventDefault();
		} );

		// Select 2 - Sortable
		$( '.' + _prefix + 'select2-sortable' ).select2Sortable( { bindOrder: 'sortableStop' } );
	};

	$.PT_CV_Admin_Pro.prototype = {
		/**
		 * Search post by title
		 * @returns {undefined}
		 */
		_search_by_title: function () {
			var _prefix = this.options._prefix;
			var _nonce = PT_CV_ADMIN_PRO._nonce;
			var content_type = '[name="' + _prefix + 'content-type' + '"]';

			// Send ajax request to search posts by Title
			var fn_search_by_title = function ( _title, callback ) {
				var _post_type;
				if ( $( content_type ).is( 'input:radio' ) ) {
					_post_type = $( content_type + ':checked' ).val();
				} else {
					_post_type = $( content_type ).val();
				}

				// Data to query
				var data = {
					ajax_nonce: _nonce,
					action: 'search_by_title',
					data: 'search_title=' + _title + '&post_type=' + _post_type
				};

				// Sent POST request
				$.ajax( {
					type: "POST",
					url: ajaxurl,
					data: data,
					dataType: 'json'
				} ).done( function ( response ) {
					if ( response === -1 ) {
						location.reload();
					}

					// Show options by callback of selectize
					callback( response );
				} );
			};

			// Use "selectize" to search, select, remove, drag & drop
			var fn_selectize = function ( $this ) {
				$this.selectize( {
					plugins: [ 'remove_button', 'drag_drop', 'restore_on_backspace' ],
					delimiter: ',',
					persist: false,
					valueField: 'id',
					labelField: 'title',
					searchField: 'title',
					createFilter: function ( input ) {
						var match, regex;
						regex = new RegExp( '\\d+' );
						match = input.match( regex );
						if ( match )
							return !this.options.hasOwnProperty( match[0] );

						return false;
					},
					create: true,
					hideSelected: true,
					closeAfterSelect: true,
					render: {
						item: function ( item, escape ) {
							return '<div>' +
								'<span class="title">' + escape( item.title ) + '</span>' +
								'</div>';
						},
						option: function ( item, escape ) {
							return '<div>' +
								'<span class="title">' + escape( item.title ) + '</span>' +
								'</div>';
						}
					},
					load: function ( query, callback ) {
						if ( !query.length )
							return callback();

						// Call ajax request to search posts by Title
						fn_search_by_title( query, callback );
					}
				} );
			};

			// Apply above functions for Post_in, Post_not_in fields
			var post_fields = new Array( $( '[name="' + _prefix + 'post__in"]' ), $( '[name="' + _prefix + 'post__not_in"]' ) );
			$.each( post_fields, function ( idx, value ) {
				value.attr( 'placeholder', PT_CV_ADMIN_PRO.message.placeholder_post_search );
				fn_selectize( value );
			} );
		},
		/**
		 * WP Color picker
		 */
		_colorpicker: function () {
			var _prefix = this.options._prefix;
			if ( PT_CV_ADMIN_PRO.supported_version ) {
				$( '.' + _prefix + 'color' ).pt_cv_wpColorPicker();
			}
		},
		/**
		 * Trigger for Preview
		 */
		_public_trigger: function () {
			var _prefix = this.options._prefix;
			var $self = this;

			var $pt_cv_public_js_pro = new cvp_js( { _autoload: 0 } );
			$( 'body' ).bind( _prefix + 'admin-preview', function () {
				$pt_cv_public_js_pro.reset_after();
				$self._exclude_posts();
				$self._dragdrop_posts();

				$( window ).trigger( 'load' );
			} );
		},
		_dragdrop_posts: function () {
			var _prefix = this.options._prefix;
			var fn_sortable_posts_admin = function () {
				if ( !( $( '[name="' + _prefix + 'advanced-settings[]"][value="order"]' ).is( ':checked' ) && $( '[name="' + _prefix + 'orderby"]' ).first().val() === 'dragdrop' ) ) {
					return;
				}

				$( '.' + _prefix + 'page' ).not( ':hidden' ).sortable( { items: '.' + _prefix + 'content-item', update: function ( event, ui ) {
						var $page = $( ui.item ).closest( '.' + _prefix + 'page' );
						var cur_page = $page.attr( 'id' ).replace( _prefix + 'page-', '' );
						var $fieldorderdd = $( '[name="' + _prefix + 'order-dragdrop-pids"]' ).first(),
							sindex = $fieldorderdd.val(),
							obj = sindex ? JSON.parse( sindex ) : { },
							cur_index = $page.sortable( 'toArray', { attribute: 'data-pid' } );

						obj[cur_page] = cur_index;
						$fieldorderdd.val( JSON.stringify( obj ) );
						$fieldorderdd.attr( 'value', JSON.stringify( obj ) );
					}, sort: function ( event, ui ) {
						/* Manually correct position of dragging item */
						//var $offset = $( ui.placeholder ).position();
						//$( ui.item ).css( 'left', $offset.left );

						$( ui.placeholder ).css( 'height', $( ui.item ).css( 'height' ) );
					} } );
			};
			$( 'body' ).bind( _prefix + 'pagination-finished', function () {
				fn_sortable_posts_admin();
			} );

			fn_sortable_posts_admin();
		},
		/**
		 * Custom field management
		 * @returns {undefined}
		 */
		_custom_field: function () {
			var _prefix = this.options._prefix;
			var this_prefix = _prefix + 'ctf-filter-';

			var ctf_table = $( '#' + _prefix + 'ctf-list' );

			// Template HTML of Setting for a field
			var tpl = $( '.ctf-tpl' );
			$( '.ctf-tpl' ).remove();

			// Enable select2 for existed key
			ctf_table.find( 'select.' + this_prefix + 'key' ).select2();

			// Add field
			$( '#' + this_prefix + 'add' ).click( function ( e ) {
				e.preventDefault();

				// Append new row of setting to table
				ctf_table.append( tpl.clone().attr( 'class', '' ) );

				// Enable select2 for Field Name
				ctf_table.find( 'select.' + this_prefix + 'key' ).last().select2();

				// Trigger change for 'Field type' to display valid Operator
				ctf_table.find( '[name^="' + this_prefix + 'type"]' ).last().trigger( 'change' );

				// Toggle Relation option
				toggle_relation();

				// Toggle Preview button
				$( 'body' ).trigger( _prefix + 'preview-btn-toggle' );
			} );

			// Delete field
			$( '.pt-wrap' ).on( 'click', '.' + this_prefix + 'delete', function ( e ) {
				e.preventDefault();

				if ( confirm( PT_CV_ADMIN_PRO.message.delete ) ) {
					$( this ).closest( 'tr' ).remove();
				}

				// Toggle Relation option
				toggle_relation();

				// Toggle Preview button
				$( 'body' ).trigger( _prefix + 'preview-btn-toggle' );
			} );

			// Toggle placeholder of Value field
			var arr_comma_value_ope = new Array( 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN' );
			var arr_date_no_val = new Array( 'NOW_FUTURE', 'IN_PAST', 'EXISTS', 'NOT EXISTS' );
			var toggle_placeholder = function ( $this, operator_val ) {
				// Value field
				var $value = $this.closest( 'tr' ).find( '[name^="' + this_prefix + 'value"]' );
				// Reset placeholder
				$value.attr( 'placeholder', '' );

				if ( $.inArray( operator_val, arr_comma_value_ope ) >= 0 ) {
					$value.attr( 'placeholder', 'Enter comma separated values' );
				} else if ( $.inArray( operator_val, arr_date_no_val ) >= 0 ) {
					$value.attr( 'placeholder', '' );
				} else {
					// Type field
					var $type = $this.closest( 'tr' ).find( '[name^="' + this_prefix + 'type"]' );
					var type = $type.val();

					if ( type === 'DATE' ) {
						$value.attr( 'placeholder', "Field value must be in 'YYYY-MM-DD' format" );
					}
					if ( type === 'BINARY' ) {
						$value.attr( 'placeholder', 'Enter 1 for True, 0 for False' );
					}
				}
			};

			// Toggle Operator base on Type
			$( '.pt-wrap' ).on( 'change', '[name^="' + this_prefix + 'type"]', function ( e ) {
				var type = $( this ).val();

				// Value field
				var $value = $( this ).closest( 'tr' ).find( '[name^="' + this_prefix + 'value"]' );

				if ( type === 'DATE' ) {
					$value.datepicker( { changeMonth: true, changeYear: true, dateFormat: "yy/mm/dd" } );

					$( '#' + _prefix + 'date-guide' ).removeClass( 'hidden' );
				} else {
					$value.datepicker( 'destroy' );

					$( '#' + _prefix + 'date-guide' ).addClass( 'hidden' );
				}

				// Get operator selectbox
				var $operator = $( this ).closest( 'tr' ).find( '[name^="' + this_prefix + 'operator"]' );
				var operator_val = $operator.val();

				toggle_placeholder( $( this ), operator_val );

				var $options = $operator.find( 'option' );
				// Hide all options
				$options.hide();

				// Show options for this type
				var $matched = $options.filter( function () {
					return $.inArray( $( this ).attr( 'value' ), PT_CV_ADMIN_PRO.custom_field.type_operator[type] ) >= 0;
				} );
				$matched.show();

				// If selected value is hidden => Set first option as new value
				if ( operator_val === '' || $operator.find( 'option[value="' + operator_val + '"]' ).css( 'display' ) === 'none' ) {
					$operator.val( $matched.first().attr( 'value' ) );
				}
			} );
			$( '[name^="' + this_prefix + 'type"]' ).trigger( 'change' );

			$( '.pt-wrap' ).on( 'change', '[name^="' + this_prefix + 'operator"]', function ( e ) {
				var operator_val = $( this ).val();
				toggle_placeholder( $( this ), operator_val );
			} );

			// Show/Hide the relation option
			var toggle_relation = function () {
				// Table of custom fields
				var ctf_list = $( '#' + _prefix + 'ctf-list' );
				// Number of custom fields
				var ctf_count = ctf_list.find( 'tr' ).length - 1;
				// Relation group
				var ctf_relation = $( '.' + _prefix + 'ctf-relation' ).closest( '.pt-form-group' );

				if ( ctf_count > 1 ) {
					ctf_relation.show();
				} else {
					ctf_relation.hide();
				}
			};
			toggle_relation();
		},
		/**
		 * Show datepicker
		 * @returns {undefined}
		 */
		_datepicker: function () {
			var _prefix = this.options._prefix;

			$( '.' + _prefix + 'datepicker' ).datepicker( { changeMonth: true, changeYear: true } );
		},
		/**
		 * Custom text for background color
		 * @returns {undefined}
		 */
		_custom_text_bg_color: function () {
			var _prefix = this.options._prefix;

			setTimeout( function () {
				$( '.wp-color-result', '.' + _prefix + 'bg-color' ).attr( 'title', PT_CV_ADMIN_PRO.message.bgcolor );
			}, 500 );
		},
		/**
		 * Duplicate a View
		 * @returns {undefined}
		 */
		_duplicate_view: function () {
			var _prefix = this.options._prefix;

			// If this is 'duplicate' action
			var patt = /action=duplicate/g;
			if ( patt.test( window.location ) ) {

				$( 'body' ).css( { opacity: '0.1', cursor: 'progress' } );

				// Empty IDs
				$( '[name="' + _prefix + 'post-id' + '"]' ).val( 0 );
				$( '[name="' + _prefix + 'view-id' + '"]' ).val( 0 );

				// Append 'Copy' to View Title
				var $view_title = $( '[name="' + _prefix + 'view-title' + '"]' ).get( 0 );
				var view_title = $( $view_title ).val();
				if ( view_title !== '' ) {
					$( $view_title ).val( view_title + ' - Copy' );
				}

				// Trigger submit form
				$( '#' + _prefix + 'form-view' ).submit();
			}
		},
		/**
		 * Add custom trigger for functions
		 * @returns {undefined}
		 */
		_custom_trigger: function () {
			var $self = this;
			var _prefix = $self.options._prefix;

			// Toggle Order Advanced Settings box
			var $order_advance_settings = $( '#' + _prefix + 'group-order #' + _prefix + 'group-advanced' );
			$( '.pt-wrap' ).on( 'content-type-change', function ( e, content_type ) {
				if ( content_type === 'product' ) {
					$order_advance_settings.removeClass( 'hidden' );
				} else {
					// Hide Order Advanced Settings box
					$order_advance_settings.addClass( 'hidden' );
				}
			} );

			// Toggle "Layout format" option
			$( '.pt-wrap' ).on( 'toggle-layout-format', function ( e, formats ) {
				formats.push( 'timeline' );
				formats.push( 'glossary' );
			} );
		},
		/**
		 * Show popover
		 *
		 * @returns {undefined}
		 */
		_popover: function () {
			$( '.pop-over-trigger' ).popover( { html: true, trigger: 'hover' } );
		},
		/**
		 * Enable select2 for font family
		 *
		 * @returns {undefined}
		 */
		_select2_for_font_families: function () {
			var _prefix = this.options._prefix;
			$( 'select[name*="' + _prefix + 'font-family"]' ).select2( { dropdownCssClass: _prefix + 'font-family' } );
		},
		/**
		 * Toggle font styles when change font family
		 *
		 * @returns {undefined}
		 */
		_toggle_font_styles: function () {
			var _prefix = this.options._prefix;

			// Get json data { name : styles } of fonts
			var $fonts = PT_CV_ADMIN_PRO.fonts.google;
			var $fonts_obj = $.parseJSON( $fonts );

			// Toggle font styles when know font name
			var _fn_this_toggle = function ( selected_font, this_object, manual_changed ) {

				// Get font styles of selected font
				var font_styles = [ ];
				$.each( $fonts_obj, function ( name, styles ) {
					if ( name === selected_font ) {
						font_styles = styles;
						return false;
					}
				} );

				// Reset font styles if select Default font
				if ( selected_font === '' ) {
					font_styles = [ 'regular', 'italic', '600' ];
				}

				// Add default style to every font families
				font_styles[font_styles.length] = '';

				// Get font styles select box object
				var $font_styles_obj = $( this_object ).closest( '.pt-form-group' ).next( '.pt-form-group' ).find( 'select' );

				$font_styles_obj.find( 'option' ).each( function () {
					// Show style which the selected font has
					if ( $.inArray( $( this ).val(), font_styles ) >= 0 ) {
						$( this ).show();
					} else {
						$( this ).hide();
					}
				} );

				// Trigger select default option
				if ( manual_changed ) {
					$font_styles_obj.val( '' );
				}

			};

			// Run on page load
			$( 'select[name*="' + _prefix + 'font-family"]' ).each( function ( e ) {
				_fn_this_toggle( $( this ).val(), this );
			} );

			// Run on change
			$( 'select[name*="' + _prefix + 'font-family"]' ).on( 'change', function ( e ) {
				_fn_this_toggle( e.val, this, 'changed' );
			} );
		},
		/**
		 * Allow to sort Fields display, Meta fields
		 *
		 * @returns {undefined}
		 */
		_sortable_params: function () {
			var _prefix = this.options._prefix;

			$( '.' + _prefix + 'field-display' ).sortable( { items: '.form-group:not(.' + _prefix + 'thumb-position)', update: function ( event, ui ) {
					$( 'body' ).trigger( _prefix + 'preview-btn-toggle' );
				} } );
			$( '.' + _prefix + 'meta-fields-settings' ).sortable( { items: '.form-group', update: function ( event, ui ) {
					$( 'body' ).trigger( _prefix + 'preview-btn-toggle' );
				} } );
			$( '#' + _prefix + 'content-ads' ).sortable( { items: '.form-group:gt(1)', update: function ( event, ui ) {
				} } );
		},
		/**
		 * Show/hide Group of select terms quickly
		 * @returns {undefined}
		 */
		_toggle_select_terms: function () {
			var _prefix = this.options._prefix;
			$( '.' + _prefix + 'term-quick-filter' ).click( function () {
				$( this ).toggleClass( 'show' );
			} );
		},
		/**
		 * Disable pagination in some cases
		 *
		 * @returns {undefined}
		 */
		_pagination_disable: function () {
			var _prefix = this.options._prefix;
			var pagination_style = '[name="' + _prefix + 'pagination-style' + '"]';
			var pagination_enable = '[name="' + _prefix + 'enable-pagination' + '"]';

			// Disable Numbered pagination
			var _do_disable = function () {
				$( pagination_style + '[value="regular"]' ).attr( 'disabled', true );

				if ( $( pagination_style + '[value="regular"]' ).is( ':checked' ) ) {
					// Uncheck it
					$( pagination_style + '[value="regular"]' ).attr( 'checked', false );

					// Select another option
					$( pagination_style + '[value="loadmore"]' ).attr( 'checked', true );
				}
			};

			var current_values = { viewtype: 'grid', shuffle: 0 };
			var should_disable = { viewtype: 'timeline', shuffle: 'yes' };
			var _check_disable = function ( type, value ) {
				current_values[type] = value;

				if ( current_values[type] === should_disable[type] ) {
					_do_disable();
				} else {
					if ( current_values.viewtype !== should_disable.viewtype && current_values.shuffle !== should_disable.shuffle ) {
						$( pagination_style ).removeAttr( 'disabled' );
					}
				}
			};

			// Constraint with View type
			var _with_view_type = function () {
				var view_type = '[name="' + _prefix + 'view-type' + '"]';
				var fn_selector = function () {
					var this_val;
					if ( $( view_type ).is( 'input:radio' ) ) {
						this_val = $( view_type + ':checked' ).val();
					} else {
						this_val = $( view_type ).val();
					}

					// Timeline
					_check_disable( 'viewtype', this_val );

					// Glossary
					if ( this_val === 'glossary' ) {
						if ( $( pagination_enable ).is( ':checked' ) ) {
							$( pagination_enable ).trigger( 'click' );
						}
						$( pagination_enable ).attr( 'checked', false );
						$( pagination_enable ).attr( 'disabled', true );
					} else {
						// Enable pagination
						$( pagination_enable ).removeAttr( 'disabled' );
					}
				};

				fn_selector();
				$( view_type ).change( function () {
					fn_selector();
				} );
			};
			_with_view_type();

			// Constraint with Shuffle Filter
			var _with_shuffle_filter = function () {
				var fn_selector = function ( this_val ) {
					_check_disable( 'shuffle', this_val );
				};

				var selector = '[name="' + _prefix + 'enable-taxonomy-filter' + '"]';
				// Run on page load
				fn_selector( $( selector + ':checked' ).val() );
				// Run on change
				$( selector ).change( function () {
					fn_selector( $( selector + ':checked' ).val() );
				} );
			};
			_with_shuffle_filter();

		},
		/**
		 * Show alert/disable option has constraint with "Shuffle Filter" feature
		 * @returns {undefined}
		 */
		_shuffle_filter_constraint: function () {
			var _prefix = this.options._prefix;

			var $enable_shuffle = $( '[name="' + _prefix + 'enable-taxonomy-filter' + '"]' );
			var fn_enable_disable = function ( valid ) {
				if ( valid ) {
					$enable_shuffle.removeAttr( 'checked' );
					$enable_shuffle.attr( 'disabled', true );
					$enable_shuffle.trigger( 'change' );
				} else {
					// Enable
					$enable_shuffle.attr( 'disabled', false );
				}
			};

			var view_type = '[name="' + _prefix + 'view-type' + '"]';
			var fn_view_type = function () {
				var this_val;
				if ( $( view_type ).is( 'input:radio' ) ) {
					this_val = $( view_type + ':checked' ).val();
				} else {
					this_val = $( view_type ).val();
				}

				if ( typeof this_val === 'undefined' ) {
					return;
				}

				// Only works with Grid
				var expect_val = [ 'grid', 'pinterest', 'masonry' ];
				fn_enable_disable( $.inArray( this_val, expect_val ) < 0 );
			};

			// Run on page load
			fn_view_type();
			// Run on change
			$( view_type ).change( function () {
				fn_view_type();
			} );
		},
		/* Toggle settings under Field Settings */
		_toggle_field_settings: function () {
			if ( !PT_CV_ADMIN_PRO.enable_toggle_settings ) {
				return;
			}

			var _prefix = this.options._prefix;

			// Field settings
			var $field_settings = $( '.' + _prefix + 'field-setting > .control-label' ).not( ':empty' );

			// Add + sign to label
			$field_settings.each( function () {
				$( this ).append( '<span class="setting-toggle-sign dashicons dashicons-plus"></span>' );
			} );

			// Show/Hide settings
			$( '.' + _prefix + 'field-setting > .control-label' ).on( 'toggle-setting', function ( e, status ) {
				$( this ).children( 'span' ).toggle( !status );

				// Related settings of this label
				var $related_settings = $( this ).next( '.pt-params' ).first();

				// Content settings
				if ( $( this ).parent( '.' + _prefix + 'content-setting' ).length > 0 ) {
					$related_settings = $related_settings.add( $( '.' + _prefix + 'excerpt-setting' ) );
				}

				// Meta-field settings
				if ( $( this ).parent( '.' + _prefix + 'metafield-setting' ).length > 0 ) {
					$related_settings = $related_settings.add( $( '.' + _prefix + 'metafield-extra' ) );
				}

				$related_settings.toggle( status );
			} );

			// Hide settings on page load
			$field_settings.each( function () {
				$( this ).trigger( 'toggle-setting', [ false ] );
			} );

			// Do action on click
			$( '.' + _prefix + 'field-setting > .control-label' ).on( 'click', function () {
				// Show settings of this
				$( this ).trigger( 'toggle-setting', [ true ] );

				// Select other settings (not this and not empty)
				$( '.' + _prefix + 'field-setting > .control-label' ).not( this ).not( ':empty' ).trigger( 'toggle-setting', [ false ] );
			} );
		},
		/**
		 * Show delete button to exclude posts
		 * @returns {undefined}
		 */
		_exclude_posts: function () {
			var _prefix = this.options._prefix;

			// Show button
			$( '.' + _prefix + 'content-item' ).each( function () {
				$( this ).prepend( '<span class="glyphicon glyphicon-eye-close" title="Hide this post"></span>' );
			} );

			// Click button
			$( '.glyphicon-eye-close', '.preview-wrapper' ).on( 'click', function ( e ) {
				e.preventDefault();

				var $not_in_field = $( '[name="' + _prefix + 'post__not_in"]' );
				var $selectize = $not_in_field.next( '.selectize-control' );

				// Trigger type ID to exclude field
				var post_id = $( this ).parent().attr( 'data-pid' );
				$selectize.find( 'input' ).attr( 'value', post_id );
				$selectize.find( 'input' ).trigger( 'keyup' );

				// Trigger click Add button
				$selectize.find( '.create' ).first().trigger( 'click' );

				// Highlight new added post
				$selectize.find( '.items' ).first().find( 'div' ).last().fadeOut( 100 ).fadeIn( 100 ).fadeOut( 100 ).fadeIn( 100, function () {
					// Refresh preview
					$( '#' + _prefix + 'show-preview' ).trigger( 'click' );
				} );
			} );
		}
	};

	$( function () {
		var _prefix = PT_CV_PUBLIC._prefix;

		// Run at page load
		new $.PT_CV_Admin_Pro( { _prefix: _prefix } );
	} );
}( jQuery ) );