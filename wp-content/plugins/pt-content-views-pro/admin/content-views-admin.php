<?php

/**
 * Content Views Admin
 *
 * @package   PT_Content_Views_Pro_Admin
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
class PT_Content_Views_Pro_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		$this->plugin_slug = 'content-views-pro';

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ), 12 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 12 );
		add_action( 'admin_print_styles', array( $this, 'admin_print_styles' ), 12 );

		// Filter Setting options
		add_filter( PT_CV_PREFIX_ . 'view_version', array( $this, 'filter_view_version' ) );
		add_filter( PT_CV_PREFIX_ . 'view_row_actions', array( $this, 'filter_view_row_actions' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'view_actions', array( $this, 'filter_view_actions' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'upgrade_to_pro_text', array( $this, 'filter_upgrade_to_pro_text' ) );
		add_filter( PT_CV_PREFIX_ . 'custom_filters', array( $this, 'filter_custom_filters' ) );
		add_filter( PT_CV_PREFIX_ . 'setting_post_in', array( $this, 'filter_setting_post_in' ) );
		add_filter( PT_CV_PREFIX_ . 'setting_post_not_in', array( $this, 'filter_setting_post_not_in' ) );
		add_filter( PT_CV_PREFIX_ . 'include_extra_settings', array( $this, 'filter_include_extra_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'exclude_extra_settings', array( $this, 'filter_exclude_extra_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'post_parent_settings', array( $this, 'filter_post_parent_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'after_limit_option', array( $this, 'filter_after_limit_option' ) );
		add_filter( PT_CV_PREFIX_ . 'post_types', array( $this, 'filter_post_types' ) );
		add_filter( PT_CV_PREFIX_ . 'post_types_list', array( $this, 'filter_post_types_list' ) );
		add_filter( PT_CV_PREFIX_ . 'orderby', array( $this, 'filter_orderby' ) );
		add_filter( PT_CV_PREFIX_ . 'orders', array( $this, 'filter_orders' ) );
		add_filter( PT_CV_PREFIX_ . 'view_type', array( $this, 'filter_view_type' ) );
		add_filter( PT_CV_PREFIX_ . 'view_type_settings', array( $this, 'filter_view_type_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'view_type_settings_grid', array( $this, 'filter_view_type_settings_grid' ) );
		add_filter( PT_CV_PREFIX_ . 'view_type_settings_collapsible', array( $this, 'filter_view_type_settings_collapsible' ) );
		add_filter( PT_CV_PREFIX_ . 'view_type_settings_scrollable', array( $this, 'filter_view_type_settings_scrollable' ) );
		add_filter( PT_CV_PREFIX_ . 'list_layouts', array( $this, 'filter_list_layouts' ) );
		add_filter( PT_CV_PREFIX_ . 'open_in', array( $this, 'filter_open_in' ) );
		add_filter( PT_CV_PREFIX_ . 'field_display', array( $this, 'filter_field_display' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'field_thumbnail_sizes', array( $this, 'filter_field_thumbnail_sizes' ) );
		add_filter( PT_CV_PREFIX_ . 'field_thumbnail_settings', array( $this, 'filter_field_thumbnail_settings' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'settings_other', array( $this, 'filter_settings_other' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'post_types_taxonomies', array( $this, 'filter_post_types_taxonomies' ) );
		add_filter( PT_CV_PREFIX_ . 'pagination_styles', array( $this, 'filter_pagination_styles' ) );
		add_filter( PT_CV_PREFIX_ . 'settings_sort', array( $this, 'filter_settings_sort' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'settings_sort_single', array( $this, 'filter_settings_sort_single' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'settings_sort_text', array( $this, 'filter_settings_sort_text' ) );
		add_filter( PT_CV_PREFIX_ . 'settings_title_display', array( $this, 'filter_settings_title_display' ), 10, 3 );
		add_filter( PT_CV_PREFIX_ . 'settings_taxonomies_display', array( $this, 'filter_settings_taxonomies_display' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'excerpt_settings', array( $this, 'filter_excerpt_settings' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'settings_pagination', array( $this, 'filter_settings_pagination' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'select_term_class', array( $this, 'filter_select_term_class' ) );
		add_filter( PT_CV_PREFIX_ . 'options_description', array( $this, 'filter_options_description' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'sticky_posts_setting', array( $this, 'filter_sticky_posts_setting' ) );
		add_filter( PT_CV_PREFIX_ . 'field_settings', array( $this, 'filter_field_settings' ), 10, 2 );
		add_filter( PT_CV_PREFIX_ . 'advanced_settings', array( $this, 'filter_advanced_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'advanced_settings_panel', array( $this, 'filter_advanced_settings_panel' ) );
		add_filter( PT_CV_PREFIX_ . 'taxonomies_custom_settings', array( $this, 'filter_taxonomies_custom_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'searchby_keyword_desc', array( $this, 'filter_searchby_keyword_desc' ) );
		add_filter( PT_CV_PREFIX_ . 'author_settings', array( $this, 'filter_author_settings' ) );
		add_filter( PT_CV_PREFIX_ . 'viewtype_setting', array( $this, 'filter_viewtype_setting' ) );
		add_filter( PT_CV_PREFIX_ . 'contenttype_setting', array( $this, 'filter_contenttype_setting' ) );

		// Custom hooks for both preview & frontend
		PT_CV_Hooks_Pro::init();

		// Custom settings page
		PT_CV_Plugin_Pro::init();

		// Print custom CSS to header of Preview
		add_action( PT_CV_PREFIX_ . 'preview_header', array( 'PT_Content_Views_Pro', 'print_custom_css' ) );
		add_action( PT_CV_PREFIX_ . 'preview_footer', array( 'PT_Content_Views_Pro', 'print_custom_js' ) );

		// Add action before edit/trash View
		add_action( 'wp_trash_post', array( $this, 'action_before_delete_view' ) );
		add_action( 'before_delete_post', array( $this, 'action_before_delete_view' ) );

		// Add Tabs to Add/Edit View page
		add_action( PT_CV_PREFIX_ . 'setting_tabs_header', array( $this, 'action_setting_tabs_header' ) );
		add_action( PT_CV_PREFIX_ . 'setting_tabs_content', array( $this, 'action_setting_tabs_content' ) );

		// Add more buttons to View edit page
		add_action( PT_CV_PREFIX_ . 'admin_more_buttons', array( $this, 'action_admin_more_buttons' ) );

		// Ajax action to search posts by title
		$action = 'search_by_title';
		add_action( 'wp_ajax_' . $action, array( 'PT_CV_Functions_Pro', 'ajax_callback_' . $action ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		$screen = get_current_screen();
		if ( strpos( $screen->id, PT_CV_DOMAIN ) !== false ) {

			// Main admin style
			PT_CV_Asset::enqueue(
				'admin', 'style', array(
				'src' => plugins_url( 'assets/css/admin.css', __FILE__ ),
				), PT_CV_PREFIX_PRO
			);

			// Color picker with Opacity
			PT_CV_Asset::enqueue(
				'color-picker', 'style', array(
				'src' => plugins_url( 'assets/css/color-picker.css', __FILE__ ),
				), PT_CV_PREFIX_PRO
			);

			PT_CV_Asset::enqueue(
				'selectize', 'style', array(
				'src' => plugins_url( 'assets/css/selectize.bootstrap3.css', __FILE__ ),
				), PT_CV_PREFIX_PRO
			);

			// For Preview
			PT_CV_Html_Pro::frontend_styles();
		}
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		$screen = get_current_screen();
		if ( strpos( $screen->id, PT_CV_DOMAIN ) !== false ) {

			// Main admin script
			PT_CV_Asset::enqueue(
				'admin', 'script', array(
				'src'	 => plugins_url( 'assets/js/admin.js', __FILE__ ),
				'deps'	 => array( 'jquery' ),
				), PT_CV_PREFIX_PRO
			);

			// Localize strings
			PT_CV_Asset::localize_script(
				'admin', PT_CV_PREFIX_UPPER . 'ADMIN_PRO', array(
				'_nonce'				 => wp_create_nonce( PT_CV_PREFIX_ . 'ajax_nonce' ),
				'supported_version'		 => PT_CV_Functions::wp_version_compare( '3.5' ),
				'fonts'					 => array(
					'google' => json_encode( PT_CV_Functions_Pro::get_google_fonts() ),
				),
				'message'				 => array(
					'bgcolor'					 => __( 'Background Color' ),
					'delete'					 => __( 'Delete' ) . '?',
					'placeholder_post_search'	 => __( 'Enter post ID, or type to search by post Title', 'content-views-pro' ),
				),
				'custom_field'			 => array(
					'type_operator' => array(
						'CHAR'		 => array( '=', 'IN', 'NOT IN', 'LIKE', 'NOT LIKE', 'EXISTS', 'NOT EXISTS' ),
						'NUMERIC'	 => array( '=', '!=', '>', '>=', '<', '<=', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS', 'NOT EXISTS' ),
						'DATE'		 => array( 'NOW_FUTURE', 'IN_PAST', '=', '!=', '>', '>=', '<', '<=', 'BETWEEN', 'NOT BETWEEN', 'EXISTS', 'NOT EXISTS' ),
						'BINARY'	 => array( '=', '!=', 'EXISTS', 'NOT EXISTS' ),
					)
				),
				'enable_toggle_settings' => apply_filters( PT_CV_PREFIX_ . 'enable_toggle_settings', true ),
				'layout_image_dir'		 => plugins_url( 'assets/images/layouts/', __FILE__ )
				), PT_CV_PREFIX_PRO
			);

			// Color picker with Opacity
			PT_CV_Asset::enqueue(
				'color-picker', 'script', array(
				'src' => plugins_url( 'assets/js/color-picker.js', __FILE__ ),
				), PT_CV_PREFIX_PRO
			);

			// Datepicker
			wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );

			// Select2 sortable
			PT_CV_Asset::enqueue(
				'select2.sortable', 'script', array(
				'src'	 => plugins_url( 'assets/js/select2.sortable.js', __FILE__ ),
				'ver'	 => '1.0',
				)
			);

			PT_CV_Asset::enqueue(
				'selectize', 'script', array(
				'src'	 => plugins_url( 'assets/js/selectize.js', __FILE__ ),
				'ver'	 => '1.0',
				)
			);

			// For Preview
			PT_CV_Html_Pro::frontend_scripts();
		}
	}

	/**
	 * Print custom style in Admin
	 *
	 * @since     1.0.0
	 *
	 * @return    null
	 */
	public function admin_print_styles() {

		$screen = get_current_screen();
		if ( is_object( $screen ) && strpos( $screen->id, PT_CV_DOMAIN ) !== false ) {

			// Datepicker
			wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );

			// For Google Font
			echo "<style>\n";
			echo PT_CV_Functions_Pro::get_google_fonts_background_position();
			echo "\n</style>";
		}
	}

	/**
	 * Version of current View (when it created/modified)
	 * @param string $args
	 * @return string
	 */
	public function filter_view_version( $args ) {
		$args = 'pro-' . PT_CV_VERSION_PRO;

		return $args;
	}

	/**
	 * Add more actions to All Views page : Duplicate
	 *
	 * @param array  $args    Array of actions
	 * @param string $view_id The View ID
	 *
	 * @return array
	 */
	public function filter_view_row_actions( $args, $view_id ) {
		$duplicate_link		 = PT_CV_Functions::view_link( $view_id, array( 'action' => 'duplicate' ) );
		$args[ 'duplicate' ] = '<a href="' . esc_url( $duplicate_link ) . '" target="_blank">' . __( 'Duplicate this view', 'content-views-pro' ) . '</a>';

		return $args;
	}

	/**
	 * Add view action buttons: Duplicate
	 *
	 * @param array  $args
	 * @param string $view_id The View ID
	 *
	 * @return string
	 */
	public function filter_view_actions( $args, $view_id ) {
		$args = sprintf( '<a class="btn btn-info" href="%s" style="float: right;">%s</a>', PT_CV_Functions::view_link( $view_id, array( 'action' => 'duplicate' ) ), __( 'Duplicate this view', 'content-views-pro' ) );

		return $args;
	}

	/**
	 * Filter upgrade to Pro text
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	public function filter_upgrade_to_pro_text( $args ) {
		return '';
	}

	/**
	 * Filter common filter: Add select Products
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_custom_filters( $args ) {
		// Select multiple post types
		$_post_types = PT_CV_Values::post_types();
		unset( $_post_types[ 'any' ] );
		$post_types	 = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'		 => 'select',
					'name'		 => 'multi-post-types',
					'options'	 => $_post_types,
					'std'		 => '',
					'class'		 => 'select2',
					'multiple'	 => '1',
					'desc'		 => __( 'Leave it empty to include all post types', 'content-views-pro' )
				),
			),
			'dependence' => array( 'content-type', 'any' ),
		);

		// Products
		$woo = array(
			'label'		 => array(
				'text' => __( 'WooCommerce filters', 'content-views-pro' ),
			),
			'params'	 => array(
				array(
					'type'		 => 'radio',
					'name'		 => 'products-list',
					'options'	 => PT_CV_Values_Pro::field_product_lists(),
					'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values_Pro::field_product_lists() ),
				),
			),
			'dependence' => array( 'content-type', 'product' ),
		);

		$args = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						$post_types,
						$woo,
					),
				),
			),
		);

		return $args;
	}

	// Add more description for Post_in
	public function filter_setting_post_in( $args ) {
		$args = __( 'List of post IDs to show. Drag and drop to change display order of them', 'content-views-pro' );
		return $args;
	}

	// Add more description for Post_not_in
	public function filter_setting_post_not_in( $args ) {
		$args = __( 'List of post IDs to exclude', 'content-views-pro' );
		return $args;
	}

	/**
	 * Add options for Include setting
	 *
	 * @param array $args
	 */
	public function filter_include_extra_settings( $args ) {
		$args = array(
			'label'	 => array(
				'text' => '',
			),
			'params' => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Include current post
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width'		 => 12,
									'wrap-class' => PT_CV_PREFIX . 'append-options',
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => 'include-current',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Include current post', 'content-views-pro' ) ),
									'std'		 => '',
									'desc'		 => __( 'Useful to show more info of current post in its page. Should not be checked in other cases', 'content-views-pro' ),
								),
							),
						),
					),
				),
			),
		);

		return $args;
	}

	/**
	 * Add options for Exclude setting
	 *
	 * @param array $args
	 */
	public function filter_exclude_extra_settings( $args ) {
		$args = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Exclude current post
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width'		 => 12,
									'wrap-class' => PT_CV_PREFIX . 'append-options',
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => 'exclude-current',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Exclude current post', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
						),
					),
				),
			),
			'dependence' => array( 'post__in', '' ),
		);

		return $args;
	}

	/**
	 * Add options for Parent page
	 *
	 * @param array $args
	 */
	public function filter_post_parent_settings( $args ) {

		$args = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Auto get current page
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'html',
									'content'	 => sprintf( '<p style="margin-bottom:0">%s:</p>', __( 'Or use current page, and', 'content-views-pro' ) ),
								),
							),
						),
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'select',
									'name'		 => 'post_parent-auto',
									'options'	 => PT_CV_Values_Pro::parent_page_options(),
									'std'		 => '',
								),
							),
						),
						// Show what from parent page
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'html',
									'content'	 => sprintf( '<p style="margin-bottom:0">%s</p>', __( 'What information of Parent page to show?', 'content-views-pro' ) ),
								),
							),
						),
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'select',
									'name'		 => 'post_parent-auto-info',
									'options'	 => PT_CV_Values_Pro::parent_page_info(),
									'std'		 => '',
								),
							),
						),
					),
				),
			),
			'dependence' => array( 'content-type', 'page' ),
		);

		return $args;
	}

	/**
	 * Filter common filter: Add Offset
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_after_limit_option( $args ) {
		// Offset
		$args = array(
			'label'	 => array(
				'text' => __( 'Offset', 'content-views-pro' ),
			),
			'params' => array(
				array(
					'type'	 => 'number',
					'name'	 => 'offset',
					'std'	 => '',
					'min'	 => '0',
					'desc'	 => __( 'The number of posts to skip. Set empty to start from the first post', 'content-views-pro' ),
				),
			),
		);

		return $args;
	}

	/**
	 * Filter post types: Get all registered post types
	 *
	 * @param array $args Array to filter
	 *
	 * @return boolean
	 */
	public function filter_post_types( $args ) {
		unset( $args[ '_builtin' ] );

		return $args;
	}

	/**
	 * Add option to query any post types
	 *
	 * @return array
	 */
	public function filter_post_types_list( $args ) {
		$args[ 'attachment' ]	 = __( 'Media' );
		$args[ 'any' ]			 = __( 'All / Multi post types', 'content-views-pro' );

		return $args;
	}

	/**
	 * Filter orderby: Add advanced options
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_orderby( $args ) {

		$args[ 'common' ][ 'dragdrop-pids' ]		 = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'	 => 'text',
					'name'	 => 'order-dragdrop-pids',
					'std'	 => '',
				),
			),
			'dependence' => array( 'orderby', 'dragdrop' ),
		);
		$args[ 'common' ][ 'dragdrop-nosupport' ]	 = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'html',
									'content'	 => sprintf( '<p class="text-muted">%s</p>', __( "Only supports (Ajax) Numbered pagination and Normal pagination", 'content-views-pro' ) ),
								),
							),
							'dependence'	 => array( 'enable-pagination', 'yes' ),
						),
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'html',
									'content'	 => sprintf( '<p class="text-danger">%s</p>', __( "We're sorry, you can't drag & drop posts with current View type", 'content-views-pro' ) ),
								),
							),
							'dependence'	 => array( 'view-type', array_slice( array_keys( PT_CV_Values::view_type() ), 3 ) ),
						),
					),
				),
			),
			'dependence' => array( 'orderby', 'dragdrop' ),
		);

		// Advanced order by for Post type
		$args[ 'advanced' ] = array(
			array(
				'label'		 => array(
					'text' => __( 'Sort by', 'content-views-query-and-display-post-page' ),
				),
				'params'	 => array(
					array(
						'type'		 => 'panel_group',
						'settings'	 => array(
							'no_panel'		 => 1,
							'show_only_one'	 => 1,
						),
						'params'	 => PT_CV_Settings_Pro::orderby(),
					),
				),
				'dependence' => array( 'content-type', 'product' ),
			),
			array(
				'label'		 => array(
					'text' => __( 'Order' ),
				),
				'params'	 => array(
					array(
						'type'		 => 'radio',
						'name'		 => 'advanced-order',
						'options'	 => PT_CV_Values::orders(),
						'std'		 => 'asc',
					),
				),
				'dependence' => array( 'content-type', 'product' ),
			),
		);

		// Custom field order by
		$prefix							 = 'order-custom-field-';
		$args[ __( 'Custom Fields' ) ]	 = array(
			// Key
			array(
				'label'	 => array(
					'text' => __( 'Field key', 'content-views-pro' ),
				),
				'params' => array(
					array(
						'type'		 => 'select',
						'name'		 => $prefix . 'key',
						'options'	 => PT_CV_Values_Pro::custom_fields( 'default empty' ),
						'class'		 => 'select2',
					),
				),
			),
			// Type
			array(
				'label'	 => array(
					'text' => __( 'Value type', 'content-views-pro' ),
				),
				'params' => array(
					array(
						'type'		 => 'select',
						'name'		 => $prefix . 'type',
						'options'	 => PT_CV_Values_Pro::custom_field_type(),
						'desc'		 => __( 'Type of value of custom field', 'content-views-pro' ),
					),
				),
			),
			// Order
			array(
				'label'	 => array(
					'text' => __( 'Order' ),
				),
				'params' => array(
					array(
						'type'		 => 'radio',
						'name'		 => $prefix . 'order',
						'options'	 => PT_CV_Values::orders(),
						'std'		 => 'asc',
					),
				),
			),
		);

		return $args;
	}

	/**
	 * Add dependence for Order
	 * @param array $args
	 * @return array
	 */
	public function filter_orders( $args ) {
		$args[ 'dependence' ] = array( 'orderby', array( 'rand', 'dragdrop' ), '!=' );

		return $args;
	}

	/**
	 * Filter view type : Add timeline, calendar ...
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_view_type( $args ) {
		$args = array_merge( $args, PT_CV_Values_Pro::view_type_pro() );

		return $args;
	}

	/**
	 * Filter view type settings : Add Scrollable List, Pinterest, Timeline ... settings
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_view_type_settings( $args ) {

		// Settings of One and others
		$args[ 'one_others' ] = PT_CV_Settings_Pro::view_type_settings_one_and_others();

		// Settings of Pinterest type
		$args[ 'pinterest' ] = PT_CV_Settings_Pro::view_type_settings_pinterest();

		// Settings of Masonry type
		$args[ 'masonry' ] = PT_CV_Settings_Pro::view_type_settings_masonry();

		// Settings of Timeline type
		$args[ 'timeline' ] = PT_CV_Settings_Pro::view_type_settings_timeline();

		// Settings of Glossary type
		$args[ 'glossary' ] = PT_CV_Settings_Pro::view_type_settings_glossary();

		return $args;
	}

	/**
	 * Filter settings for Grid
	 *
	 * @param type $args
	 */
	public function filter_view_type_settings_grid( $args ) {
		$prefix = 'grid-';

		// Line up fields
		$lineup = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'wrap-class' => 'has-popover',
					'width'		 => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'same-height',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Line up fields (Title, Content...) across items', 'content-views-pro' ) ),
					'std'		 => '',
					'popover'	 => sprintf( "<img src='%s'>", plugins_url( 'assets/images/popover/grid-lineup.png', __FILE__ ) ),
				),
			),
		);

		$args[] = array(
			'label'	 => array(
				'text' => __( 'View style', 'content-views-pro' ),
			),
			'params' => array(
				array(
					'type'	 => 'group',
					'params' => array(
						$lineup
					),
				),
			),
		);

		return $args;
	}

	/**
	 * Filter settings for Collapsible List
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public function filter_view_type_settings_collapsible( $args ) {
		#$prefix = 'collapsible-';

		return $args;
	}

	/**
	 * Settings of View type = Scrollable
	 *
	 * @return array
	 */
	public function filter_view_type_settings_scrollable( $args ) {

		$prefix = 'scrollable-';

		$args = array(
			// Number of columns
			array(
				'label'	 => array(
					'text' => __( 'Items per row', 'content-views-query-and-display-post-page' ),
				),
				'params' => array(
					array(
						'type'			 => 'number',
						'name'			 => $prefix . 'number-columns',
						'std'			 => '2',
						'append_text'	 => '1 &rarr; 12',
					),
				),
			),
			// Number of rows
			array(
				'label'			 => array(
					'text' => __( 'Rows per slide', 'content-views-pro' ),
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-class' => PT_CV_PREFIX . 'w200',
					),
				),
				'params'		 => array(
					array(
						'type'			 => 'number',
						'name'			 => $prefix . 'number-rows',
						'std'			 => '2',
						'append_text'	 => '1 &rarr; 12',
					),
				),
			),
			// (Navigation) Controls
			array(
				'label'	 => array(
					'text' => __( 'Navigation' ),
				),
				'params' => array(
					array(
						'type'		 => 'checkbox',
						'name'		 => $prefix . 'navigation',
						'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Enable' ) ),
						'std'		 => 'yes',
					),
				),
			),
			// Indicators
			array(
				'label'	 => array(
					'text' => __( 'Indicator', 'content-views-pro' ),
				),
				'params' => array(
					array(
						'type'		 => 'checkbox',
						'name'		 => $prefix . 'indicator',
						'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Enable' ) ),
						'std'		 => 'yes',
					),
				),
			),
			// Automatical cycle
			array(
				'label'	 => array(
					'text' => __( 'Automatic cycle', 'content-views-pro' ),
				),
				'params' => array(
					array(
						'type'		 => 'checkbox',
						'name'		 => $prefix . 'auto-cycle',
						'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Enable' ) ),
						'std'		 => 'yes',
					),
				),
			),
			// Interval
			array(
				'label'			 => array(
					'text' => __( 'Interval', 'content-views-pro' ),
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-class' => PT_CV_PREFIX . 'w200',
					),
				),
				'params'		 => array(
					array(
						'type'	 => 'number',
						'name'	 => $prefix . 'interval',
						'std'	 => '5',
						'min'	 => '1',
						'desc'	 => __( 'The number of seconds to delay between cycles', 'content-views-pro' ),
					),
				),
				'dependence'	 => array( $prefix . 'auto-cycle', 'yes' ),
			),
		);

		return $args;
	}

	/**
	 * Filter List layouts : Add Pinterest, Portfolio ...
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_list_layouts( $args ) {
		$args = array_merge(
			$args, array(
			'pinterest' => __( 'Pinterest', 'content-views-pro' ),
			)
		);

		return $args;
	}

	/**
	 * Filter Open in: Add Lightbox
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_open_in( $args ) {
		$args = array_merge(
			$args, array(
			PT_CV_PREFIX . 'window'			 => __( 'New window', 'content-views-pro' ),
			PT_CV_PREFIX . 'lightbox'		 => __( 'Light box of Post Content', 'content-views-pro' ),
			PT_CV_PREFIX . 'lightbox-image'	 => __( 'Light box of Post Thumbnail', 'content-views-pro' ),
			PT_CV_PREFIX . 'none'			 => sprintf( '%s (%s)', __( 'None' ), __( 'no link, no action', 'content-views-pro' ) ),
			)
		);

		return $args;
	}

	/**
	 * Filter Field Display options: Add Show Price & Add to cart button
	 *
	 * @param array  $args
	 * @param string $prefix The prefix for name of option
	 *
	 * @return array
	 */
	public function filter_field_display( $args, $prefix ) {
		// Show Custom fields
		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'custom-fields',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show Custom Fields', 'content-views-pro' ) ),
					'std'		 => '',
				),
			),
		);

		// Show Price
		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'price',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show Price & Add To Cart Button', 'content-views-pro' ) ),
					'std'		 => 'yes',
				),
			),
			'dependence'	 => array( 'content-type', 'product' ),
		);

		// Show Sale badge
		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'woosale',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show Sale Badge', 'content-views-pro' ) ),
					'std'		 => 'yes',
				),
			),
			'dependence'	 => array( 'content-type', 'product' ),
		);

		// Show EDD Purchase Link
		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'edd-purchase',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show Purchase Button (EDD)', 'content-views-pro' ) ),
					'std'		 => 'yes',
				),
			),
			'dependence'	 => array( 'content-type', 'download' ),
		);

		// Show Post Format icon
		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'width' => 12,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'format-icon',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show Post Format Icon', 'content-views-pro' ) ),
					'std'		 => '',
				),
			),
			'dependence'	 => array( 'content-type', 'post' ),
		);

		return $args;
	}

	/**
	 * Filter Thumbnail Sizes: Add Custom Size, Auto Fit
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_field_thumbnail_sizes( $args ) {

		$args[ PT_CV_PREFIX . 'custom' ] = __( '- Custom size -', 'content-views-pro' );

		return $args;
	}

	/**
	 * Filter Thumbnail Settings: Add Custom Size Settings, Thumbnail Style
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_field_thumbnail_settings( $args, $prefix ) {

		// Move "disable wp 4.4 responsive image" to below custom widthxheight
		$disable_wp44_resimg = array();
		if ( isset( $args[ 'disable-wp44-resimg' ] ) ) {
			$disable_wp44_resimg = $args[ 'disable-wp44-resimg' ];
			unset( $args[ 'disable-wp44-resimg' ] );
		}

		$args = array_merge(
			$args, array(
			// Custom Size
			array(
				'label'			 => array(
					'text' => '',
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-class' => 'form-inline',
					),
				),
				'params'		 => array(
					array(
						'type'	 => 'group',
						'params' => array(
							// Width
							array(
								'label'	 => array(
									'text' => __( 'Width' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix . 'thumbnail-size-custom-width',
										'std'			 => '',
										'append_text'	 => 'px',
									),
								),
							),
							// Height
							array(
								'label'	 => array(
									'text' => __( 'Height' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix . 'thumbnail-size-custom-height',
										'std'			 => '',
										'append_text'	 => 'px',
									),
								),
							),
						),
					),
				),
				'dependence'	 => array( $prefix . 'thumbnail-size', PT_CV_PREFIX . 'custom' ),
			),
			array(
				'label'		 => array(
					'text' => '',
				),
				'params'	 => array(
					array(
						'type'		 => 'html',
						'content'	 => sprintf( '<p class="text-muted" style="padding-left: 5px;">%s</p>', __( "If output images are not same size, please decrease above size (because it is bigger than full size of smallest image)", 'content-views-pro' ) ),
					),
				),
				'dependence' => array( $prefix . 'thumbnail-size', PT_CV_PREFIX . 'custom' ),
			),
			$disable_wp44_resimg,
			// Force same width, height
			array(
				'label'	 => array(
					'text' => '',
				),
				'params' => array(
					array(
						'type'	 => 'group',
						'params' => array(
							// Force same width
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width'		 => 12,
										'wrap-class' => 'checkbox-inline',
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'checkbox',
										'name'		 => $prefix . 'thumbnail-same-width',
										'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Resize to the same width', 'content-views-pro' ) ),
										'std'		 => '',
									),
								),
							),
							// Force same height
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width'		 => 12,
										'wrap-class' => 'checkbox-inline',
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'checkbox',
										'name'		 => $prefix . 'thumbnail-same-height',
										'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Resize to the same height', 'content-views-pro' ) ),
										'std'		 => '',
										'desc'		 => __( 'Uncheck this option if thumbnail is distorted', 'content-views-pro' ),
									),
								),
							),
							// Regenerate image
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width'		 => 12,
										'wrap-class' => implode( ' ', array( 'checkbox-inline', PT_CV_PREFIX . 'full-fields' ) ),
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'checkbox',
										'name'		 => $prefix . 'thumbnail-regenerate',
										'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Regenerate thumbnail', 'content-views-pro' ) ),
										'std'		 => '',
										'desc'		 => __( 'Check this option if thumbnail is outdated', 'content-views-pro' ),
									),
								),
								'dependence'	 => array( $prefix . 'thumbnail-size', PT_CV_PREFIX . 'custom' ),
							),
						),
					),
				),
			),
			array(
				'label'	 => array(
					'text' => __( 'Style', 'content-views-query-and-display-post-page' ),
				),
				'params' => array(
					array(
						'type'		 => 'select',
						'name'		 => $prefix . 'thumbnail-style',
						'options'	 => PT_CV_Values_Pro::field_thumbnail_styles(),
						'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values_Pro::field_thumbnail_styles() ),
					),
				),
			),
			array(
				'label'			 => array(
					'text' => __( 'Border radius', 'content-views-pro' ),
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-id' => PT_CV_PREFIX . 'thumbnail-border-radius',
					),
				),
				'params'		 => array(
					array(
						'type'			 => 'number',
						'name'			 => 'thumbnail-border-radius',
						'std'			 => '6',
						'append_text'	 => 'px',
					),
				),
				'dependence'	 => array( $prefix . 'thumbnail-style', 'img-rounded' ),
			),
			array(
				'label'	 => array(
					'text' => __( 'Substitute', 'content-views-pro' ),
				),
				'params' => array(
					array(
						'type'	 => 'group',
						'params' => array(
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width' => 12,
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'html',
										'content'	 => sprintf( '<p style="margin-bottom:0;padding-top:5px">%s:</p>', __( 'Show below thing (which will be extracted from post content)', 'content-views-pro' ) ),
									),
								),
							),
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width' => 12,
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'select',
										'name'		 => $prefix . 'thumbnail-auto',
										'options'	 => PT_CV_Values_Pro::auto_thumbnail(),
										'std'		 => 'image',
									),
								),
							),
							array(
								'label'			 => array(
									'text' => '',
								),
								'extra_setting'	 => array(
									'params' => array(
										'width' => 12,
									),
								),
								'params'		 => array(
									array(
										'type'		 => 'radio',
										'name'		 => $prefix . 'thumbnail-role',
										'options'	 => array(
											''				 => __( 'if featured image was not found', 'content-views-pro' ),
											'replacement'	 => __( 'even featured image was found', 'content-views-pro' ),
										),
										'std'		 => '',
									),
								),
							),
						),
					),
				),
			),
			)
		);

		return $args;
	}

	/**
	 * Filter View Type Other settings: Add Lightbox Size option
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_settings_other( $args, $prefix ) {

		/**
		 * Social share buttons
		 */
		$social_links = array(
			'label'	 => array(
				'text' => __( 'Social sharing', 'content-views-pro' ),
			),
			'params' => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'social-show',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Enable' ) ),
					'std'		 => '',
				),
			),
		);

		$social_links_detail = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'wrap-class' => PT_CV_PREFIX . 'w50' . ' ' . PT_CV_PREFIX . 'social-links',
					'width'		 => 9,
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'social-buttons[]',
					'options'	 => PT_CV_Values_Pro::social_buttons(),
					'std'		 => array( 'facebook', 'twitter', 'googleplus' ),
				),
			),
			'dependence'	 => array( $prefix . 'social-show', 'yes' ),
		);

		// Social count
		$social_count = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'social-count',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show share count', 'content-views-pro' ) ),
					'std'		 => '',
				),
			),
			'dependence' => array( $prefix . 'social-show', 'yes' ),
		);

		/**
		 * Link settings: nofollow
		 */
		$link_settings = array(
			'label'	 => array(
				'text' => __( 'Nofollow', 'content-views-pro' ),
			),
			'params' => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => 'link-follow',
					'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( 'Use %s for item links', 'content-views-pro' ), '<code>rel="nofollow"</code>' ) ),
					'std'		 => '',
				),
			),
		);

		array_unshift( $args, $link_settings );
		array_unshift( $args, $social_count );
		array_unshift( $args, $social_links_detail );
		array_unshift( $args, $social_links );

		/**
		 * Window Size
		 */
		$prefix2 = $prefix . 'window-';

		$args = array_merge(
			$args, array(
			array(
				'label'			 => array(
					'text' => __( 'Window size', 'content-views-pro' ),
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-class' => 'form-inline',
					),
				),
				'params'		 => array(
					array(
						'type'	 => 'group',
						'params' => array(
							// Width
							array(
								'label'	 => array(
									'text' => __( 'Width' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix2 . 'size-width',
										'std'			 => '600',
										'placeholder'	 => 'for example: 600',
										'min'			 => '100',
										'append_text'	 => 'px',
									),
								),
							),
							// Height
							array(
								'label'	 => array(
									'text' => __( 'Height' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix2 . 'size-height',
										'std'			 => '400',
										'placeholder'	 => 'for example: 400',
										'min'			 => '100',
										'append_text'	 => 'px',
									),
								),
							),
						),
					),
				),
				'dependence'	 => array( $prefix . 'open-in', PT_CV_PREFIX . 'window' ),
			),
			)
		);

		/**
		 * Lightbox size
		 */
		$prefix2 = $prefix . 'lightbox-';

		$args = array_merge(
			$args, array(
			// Lightbox size
			array(
				'label'			 => array(
					'text' => __( 'Lightbox size', 'content-views-pro' ),
				),
				'extra_setting'	 => array(
					'params' => array(
						'wrap-class' => 'form-inline',
					),
				),
				'params'		 => array(
					array(
						'type'	 => 'group',
						'params' => array(
							// Width
							array(
								'label'	 => array(
									'text' => __( 'Width' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix2 . 'size-width',
										'std'			 => '75',
										'placeholder'	 => 'for example: 75',
										'append_text'	 => '%',
									),
								),
							),
							// Height
							array(
								'label'	 => array(
									'text' => __( 'Height' ),
								),
								'params' => array(
									array(
										'type'			 => 'number',
										'name'			 => $prefix2 . 'size-height',
										'std'			 => '75',
										'placeholder'	 => 'for example: 75',
										'append_text'	 => '%',
									),
								),
							),
						),
					),
				),
				'dependence'	 => array( $prefix . 'open-in', PT_CV_PREFIX . 'lightbox' ),
			),
			// Lightbox content id
			array(
				'label'		 => array(
					'text' => __( 'Content selector', 'content-views-pro' ),
				),
				'params'	 => array(
					array(
						'type'	 => 'text',
						'name'	 => $prefix2 . 'content-selector',
						'std'	 => '',
						'desc'	 => sprintf( __( 'By default, whole page will be loaded in Lightbox (Header, Content, Footer). If you want to load only Content area, please enter selector to idenfity it %s', 'content-views-pro' ), '(for example: <code>#content</code> or <code>.entry-content</code>)' ),
					),
				),
				'dependence' => array( $prefix . 'open-in', PT_CV_PREFIX . 'lightbox' ),
			),
			)
		);

		return $args;
	}

	/**
	 * Add ('any' => all taxonomies) to post types list
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public function filter_post_types_taxonomies( $args ) {
		// Get all taxonomies
		$taxonomies		 = get_taxonomies();
		$args[ 'any' ]	 = array_values( $taxonomies );

		return $args;
	}

	/**
	 * Filter Pagination Style: add Load more option
	 *
	 * @param array $args Array to filter
	 *
	 * @return array
	 */
	public function filter_pagination_styles( $args ) {

		$args[ 'infinite' ]	 = __( 'Infinite scrolling', 'content-views-pro' );
		$args[ 'loadmore' ]	 = __( 'Load more button', 'content-views-pro' );

		return $args;
	}

	/**
	 * Sort array of settings by saved order
	 *
	 * @param array  $args
	 * @param string $prefix
	 */
	public function filter_settings_sort( $args, $prefix ) {

		// Get settings of current View
		global $pt_cv_admin_settings;

		if ( is_array( $pt_cv_admin_settings ) ) {
			$args = PT_CV_Functions_Pro::settings_sort( $prefix, $args, array_keys( $pt_cv_admin_settings ) );
		}

		return $args;
	}

	/**
	 * Sort values inside a single option
	 *
	 * @param array  $args
	 * @param string $option_name Name of parameter
	 *
	 * @return array
	 */
	public function filter_settings_sort_single( $args, $option_name ) {
		// Get settings of current View
		global $pt_cv_admin_settings;

		$saved_data = isset( $pt_cv_admin_settings[ PT_CV_PREFIX . $option_name ] ) ? $pt_cv_admin_settings[ PT_CV_PREFIX . $option_name ] : '';

		if ( !$saved_data ) {
			return $args;
		}

		$result = array();

		// Get value of saved key
		foreach ( (array) $saved_data as $key ) {
			if ( isset( $args[ $key ] ) ) {
				$result[ $key ] = $args[ $key ];
				unset( $args[ $key ] );
			}
		}

		// Append other keys to result
		$result = $result + $args;

		if ( $result ) {
			$args = $result;
		}

		return $args;
	}

	/**
	 * Filter description to sorting fields
	 *
	 * @param string $args
	 *
	 * @return string
	 */
	public function filter_settings_sort_text( $args ) {
		$args = __( 'Drag & drop to change display order of fields', 'content-views-pro' );

		return $args;
	}

	/**
	 * Add custom settings for Title display
	 *
	 * @param array $args
	 */
	public function filter_settings_title_display( $args, $prefix, $prefix2 ) {
		$args = array(
			'label'			 => array(
				'text' => __( 'Title' ),
			),
			'extra_setting'	 => array(
				'params' => array(
					'group-class'	 => PT_CV_PREFIX . 'field-setting',
					'wrap-class'	 => PT_CV_Html::html_group_class() . ' ' . PT_CV_PREFIX . 'title-setting',
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => PT_CV_Settings_Pro::field_title_settings( $prefix ),
				),
			),
			'dependence'	 => array( $prefix2 . 'title', 'yes' ),
		);

		return $args;
	}

	/**
	 * Add custom settings for Taxonomies display
	 *
	 * @param array $args
	 */
	public function filter_settings_taxonomies_display( $args, $prefix ) {
		$prefix_taxonomy = $prefix . 'taxonomy-';

		$args = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'group-class' => PT_CV_PREFIX . 'field-setting' . ' ' . PT_CV_PREFIX . 'metafield-extra',
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Common settings
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										array(
											'label'			 => array(
												'text' => __( 'Common Settings' ),
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'full-fields',
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix . 'hide-prefix',
													'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( 'Remove prefix %s before author, term', 'content-views-pro' ), sprintf( '<code>%s, %s</code>', __( 'by', 'content-views-query-and-display-post-page' ), __( 'in', 'content-views-query-and-display-post-page' ) ) ) ),
													'std'		 => '',
												),
											),
										),
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'width' => 10,
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix . 'hide-slash',
													'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( 'Remove %s between fields', 'content-views-pro' ), '<code>/</code>' ) ),
													'std'		 => '',
												),
											),
										),
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'width' => 10,
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix_taxonomy . 'use-icons',
													'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show icon before each field', 'content-views-pro' ) ),
													'std'		 => '',
												),
											),
										),
									),
								),
							),
							'dependence'	 => array( 'show-field-' . 'meta-fields', 'yes' ),
						),
						// Date settings
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										array(
											'label'			 => array(
												'text' => __( 'Date' ),
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'full-fields',
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix . 'date-' . 'human',
													'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show human readable format', 'content-views-pro' ) ),
													'std'		 => '',
												),
											),
											'dependence'	 => array( $prefix . 'date', 'yes' ),
										),
									),
								),
							),
							'dependence'	 => array( 'show-field-' . 'meta-fields', 'yes' ),
						),
						// Author settings
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										array(
											'label'			 => array(
												'text' => __( 'Author' ),
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'full-fields',
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'radio',
													'name'		 => $prefix . 'author-settings',
													'options'	 => PT_CV_Values_Pro::meta_field_author_settings(),
													'std'		 => '',
												),
											),
											'dependence'	 => array( $prefix . 'author', 'yes' ),
										),
									),
								),
							),
							'dependence'	 => array( 'show-field-' . 'meta-fields', 'yes' ),
						),
						// Taxonomies settings
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										// Display in better place
										array(
											'label'			 => array(
												'text' => __( 'Taxonomy', 'content-views-query-and-display-post-page' ),
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'taxonomy-settings',
												),
											),
											'params'		 => array(
												array(
													'type'	 => 'group',
													'params' => array(
														array(
															'label'			 => array(
																'text' => '',
															),
															'extra_setting'	 => array(
																'params' => array(
																	'wrap-class' => implode( ' ', array( PT_CV_PREFIX . 'full-fields', 'has-popover', PT_CV_PREFIX . 'mb_10' ) ),
																	'width'		 => 12,
																),
															),
															'params'		 => array(
																array(
																	'type'		 => 'checkbox',
																	'name'		 => $prefix_taxonomy . 'special-place',
																	'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show in special place', 'content-views-pro' ) ),
																	'std'		 => '',
																	'popover'	 => sprintf( "<img src='%s'>", plugins_url( 'assets/images/popover/meta-special.png', __FILE__ ) ),
																),
															),
															'dependence'	 => array( 'view-type', array( 'grid', 'pinterest', 'masonry', 'one_others' ) ),
														),
													),
												),
											),
											'dependence'	 => array( $prefix . 'taxonomy', 'yes' ),
										),
										// Terms to display heading
										array(
											'label'		 => array(
												'text' => '',
											),
											'params'	 => array(
												array(
													'type'		 => 'html',
													'content'	 => __( 'Terms to show', 'content-views-pro' ) . ':',
												),
											),
											'dependence' => array( $prefix . 'taxonomy', 'yes' ),
										),
										// Terms to display options
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'full-fields',
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'radio',
													'name'		 => $prefix_taxonomy . 'display-what',
													'options'	 => PT_CV_Values_Pro::meta_field_taxonomy_display_what(),
													'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values_Pro::meta_field_taxonomy_display_what() ),
												),
											),
											'dependence'	 => array( $prefix . 'taxonomy', 'yes' ),
										),
										// Select custom taxonomy to display terms
										array(
											'label'		 => array(
												'text' => '',
											),
											'params'	 => array(
												array(
													'type'	 => 'group',
													'params' => array(
														array(
															'label'			 => array(
																'text' => '',
															),
															'extra_setting'	 => array(
																'params' => array(
																	'wrap-class' => PT_CV_PREFIX . 'w200',
																	'width'		 => 12,
																),
															),
															'params'		 => array(
																array(
																	'type'		 => 'select',
																	'name'		 => $prefix_taxonomy . 'display-custom',
																	'options'	 => PT_CV_Values::taxonomy_list(),
																	'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values::taxonomy_list() ),
																	'class'		 => 'select2',
																	'multiple'	 => '1',
																),
															),
															'dependence'	 => array( $prefix_taxonomy . 'display-what', 'custom_taxo' ),
														),
													),
												),
											),
											'dependence' => array( $prefix . 'taxonomy', 'yes' ),
										),
									),
								),
							),
							'dependence'	 => array( 'show-field-' . 'meta-fields', 'yes' ),
						),
					),
				),
			),
		);

		return $args;
	}

	/**
	 * Filter Exceprt settings
	 *
	 * @param array  $args   The setting options of Exceprt
	 * @param string $prefix The prefix string for option name
	 */
	public function filter_excerpt_settings( $args, $prefix ) {

		// Auto get manual excerpt if it is available
		$args[] = array(
			'label'	 => array(
				'text' => '',
			),
			'params' => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'hide_dots',
					'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( "Do not show %s at the end of excerpt", 'content-views-pro' ), '<code>...</code>' ) ),
					'std'		 => '',
				),
				PT_CV_Functions_Pro::has_translation_plugin() ? array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'enable_filter',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Apply content filters', 'content-views-pro' ) ),
					'std'		 => '',
					'desc'		 => __( 'Check this option if excerpt is not translated', 'content-views-pro' ),
					) : array(),
			),
		);

		$args[] = array(
			'label'	 => array(
				'text' => '',
			),
			'params' => array(
				array(
					'type'	 => 'group',
					'params' => array(
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'html',
									'content'	 => __( 'If manual excerpt existed', 'content-views-pro' ) . ':',
								),
							),
						),
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'select',
									'name'		 => $prefix . 'manual',
									'options'	 => PT_CV_Values_Pro::manual_excerpt_settings(),
									'std'		 => 'yes',
								),
							),
						),
					),
				),
			),
		);

		// Read more button/link
		$args[] = array(
			'label'	 => array(
				'text' => __( 'Read More', 'content-views-query-and-display-post-page' ),
			),
			'params' => array(
				array(
					'type'		 => 'checkbox',
					'name'		 => $prefix . 'readmore',
					'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Enable' ) ),
					'std'		 => 'yes',
				),
			),
		);

		$args[] = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'wrap-class' => PT_CV_PREFIX . 'readmore-settings',
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Read more text
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'text',
									'name'	 => $prefix . 'readmore' . '-text',
									'std'	 => ucwords( rtrim( __( 'Read more...' ), '.' ) ),
									'desc'	 => __( 'Text for Read more', 'content-views-query-and-display-post-page' ),
								),
							),
						),
						// Text link, not button
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . 'readmore' . '-textlink',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show as text link instead of button', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
						),
					),
				),
			),
			'dependence'	 => array( $prefix . 'readmore', 'yes' ),
		);

		return $args;
	}

	/**
	 * Filter Pagination settings
	 *
	 * @param array  $args   The setting options of Exceprt
	 * @param string $prefix The prefix string for option name
	 */
	public function filter_settings_pagination( $args, $prefix ) {

		// Load more text
		$args[] = array(
			'label'		 => array(
				'text' => '',
			),
			'params'	 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										// Load more text
										array(
											'label'			 => array(
												'text' => __( 'Load more text', 'content-views-pro' ),
											),
											'extra_setting'	 => array(
												'params' => array(
													'wrap-class' => PT_CV_PREFIX . 'w200',
												),
											),
											'params'		 => array(
												array(
													'type'			 => 'text',
													'name'			 => $prefix . 'loadmore' . '-text',
													'std'			 => __( 'More', 'content-views-pro' ),
													'placeholder'	 => 'for example: ' . __( 'More', 'content-views-pro' ),
												),
											),
											'dependence'	 => array( $prefix . 'style', 'loadmore' ),
										),
									),
								),
							),
							'dependence'	 => array( $prefix . 'type', 'ajax' ),
						),
					),
				),
			),
			'dependence' => array( 'enable-pagination', 'yes' ),
		);

		// Alignment
		$args[] = array(
			'label'			 => array(
				'text' => __( 'Alignment' ),
			),
			'extra_setting'	 => array(
				'params' => array(
					'wrap-class' => PT_CV_PREFIX . 'w200',
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'select',
					'name'		 => $prefix . 'alignment',
					'options'	 => PT_CV_Values_Pro::pagination_alignment(),
					'std'		 => 'left',
				),
			),
			'dependence'	 => array( 'enable-pagination', 'yes' ),
		);

		return $args;
	}

	/**
	 * Filter class for Select terms option
	 *
	 * @param array $args
	 */
	public function filter_select_term_class( $args ) {
		$args = 'select2-sortable';

		return $args;
	}

	/**
	 * Filter description of each setting option
	 *
	 * @param string $args  The content of description
	 * @param type   $param The setting array of this option
	 */
	public function filter_options_description( $args, $param ) {

		if ( !empty( $param[ 'popover' ] ) ) {
			$place = !empty( $param[ 'popover_place' ] ) ? $param[ 'popover_place' ] : 'bottom';
			$args .= sprintf( ' <span class="glyphicon glyphicon-question-sign pop-over-trigger" rel="popover" data-content="%s" title="" data-original-title="" data-placement="%s"></span>', $param[ 'popover' ], $place );
		}

		return $args;
	}

	/**
	 * Add option to choose whether or not to exclude sticky post
	 *
	 * @param array $args
	 */
	public function filter_sticky_posts_setting( $args ) {

		// Ignore sticky post
		$args = array(
			'label'			 => array(
				'text' => __( 'Sticky Post' ),
			),
			'extra_setting'	 => array(
				'params' => array(
					'wrap-class' => PT_CV_PREFIX . 'full-fields',
				),
			),
			'params'		 => array(
				array(
					'type'		 => 'select',
					'name'		 => 'sticky-posts',
					'options'	 => PT_CV_Values_Pro::sticky_posts(),
					'std'		 => 'exclude',
				),
			),
		);

		if ( apply_filters( PT_CV_PREFIX_ . 'sticky_posts_dependence', true ) ) {
			$args[ 'dependence' ] = array( 'content-type', 'post' );
		}

		return $args;
	}

	/**
	 * Append more settings to Field settings
	 *
	 * @param array  $args
	 * @param string $prefix2
	 */
	public function filter_field_settings( $args, $prefix2 ) {
		$prefix = 'custom-fields';

		// Custom fields settings
		$args[] = array(
			'label'			 => array(
				'text' => __( 'Custom Fields' ),
			),
			'extra_setting'	 => array(
				'params' => array(
					'group-class' => PT_CV_PREFIX . 'field-setting',
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Select fields
						array(
							'label'	 => array(
								'text' => __( 'Select fields', 'content-views-pro' ),
							),
							'params' => array(
								array(
									'type'		 => 'select',
									'name'		 => $prefix . '-list',
									'options'	 => PT_CV_Values_Pro::custom_fields(),
									'std'		 => '',
									'class'		 => 'select2-sortable',
									'multiple'	 => '1',
									'desc'		 => __( 'Drag & drop to change display order of fields', 'content-views-pro' ),
								),
							),
						),
						// Hide empty field
						array(
							'label'	 => array(
								'text' => '',
							),
							'params' => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-hide-empty',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Hide field which has empty value', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
						),
						// Show field name
						array(
							'label'	 => array(
								'text' => '',
							),
							'params' => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-show-name',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show field name', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
						),
						// Display colon after name
						array(
							'label'		 => array(
								'text' => '',
							),
							'params'	 => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-show-colon',
									'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( 'Show %s after field name', 'content-views-pro' ), '<code>:</code>' ) ),
									'std'		 => '',
								),
							),
							'dependence' => array( $prefix . '-show-name', 'yes' ),
						),
						// Enable customize field name
						array(
							'label'		 => array(
								'text' => '',
							),
							'params'	 => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-enable-custom-name',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Customize field name', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
							'dependence' => array( $prefix . '-show-name', 'yes' ),
						),
						// Customized names
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'width' => 12,
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										array(
											'label'		 => array(
												'text' => '',
											),
											'params'	 => array(
												array(
													'type'	 => 'text',
													'name'	 => $prefix . '-custom-name-list',
													'std'	 => '',
													'desc'	 => __( 'Separate names by comma. Don\'t type anything between commas for field not needed to change, for example: <code>Custom name 1,,Custom name 3</code>', 'content-views-pro' ),
												),
											),
											'dependence' => array( $prefix . '-enable-custom-name', 'yes' ),
										),
									),
								),
							),
							'dependence'	 => array( $prefix . '-show-name', 'yes' ),
						),
						array(
							'label'	 => array(
								'text' => '',
							),
							'params' => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-enable-oembed',
									'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Turn the field value (in URL format) into embed content (video, image...)', 'content-views-pro' ) ),
									'std'		 => '',
								),
							),
						),
						// Custom date format
						array(
							'label'	 => array(
								'text' => '',
							),
							'params' => array(
								array(
									'type'		 => 'checkbox',
									'name'		 => $prefix . '-date-custom-format',
									'options'	 => PT_CV_Values::yes_no( 'yes', sprintf( __( 'Show Date in another format (only work if date value is in format %s)', 'content-views-pro' ), '<code>Y-m-d</code>, <code>Y-m-d H:i:s</code>, <code>Y/m/d</code>, <code>Y/m/d H:i:s</code>' ) ),
									'std'		 => '',
								),
							),
						),
						array(
							'label'			 => array(
								'text' => '',
							),
							'extra_setting'	 => array(
								'params' => array(
									'wrap-class' => PT_CV_PREFIX . 'w200',
								),
							),
							'params'		 => array(
								array(
									'type'	 => 'text',
									'name'	 => $prefix . '-date-format',
									'std'	 => get_option( 'date_format' ),
									'desc'	 => __( 'To define your format, please check', 'content-views-pro' ) . ' <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">https://codex.wordpress.org/Formatting_Date_and_Time</a>',
								),
							),
							'dependence'	 => array( $prefix . '-date-custom-format', 'yes' ),
						),
						// Number of columns
						array(
							'label'	 => array(
								'text' => __( 'Fields per row', 'content-views-pro' ),
							),
							'params' => array(
								array(
									'type'			 => 'number',
									'name'			 => $prefix . '-number-columns',
									'std'			 => '1',
									'append_text'	 => '1 &rarr; 4',
								),
							),
						),
					),
				),
			),
			'dependence'	 => array( $prefix2 . $prefix, 'yes' ),
		);

		return $args;
	}

	/**
	 * Add Filter by Time
	 *
	 * @param type $args
	 */
	public function filter_advanced_settings( $args ) {
		$args[ 'date' ]			 = __( 'Date' );
		$args[ 'custom_field' ]	 = __( 'Custom Fields' );

		$membership_plugin = PT_CV_Functions_Pro::has_access_restriction_plugin();
		if ( $membership_plugin ) {
			$args[ 'check_access_restriction' ] = sprintf( __( 'Plugin %s: use access restriction for all posts in this View', 'content-views-pro' ), "<code>$membership_plugin</code>" );
		}

		$translation_plugin = PT_CV_Functions_Pro::has_translation_plugin();
		if ( $translation_plugin ) {
			$args[ 'hide_different_language' ] = sprintf( __( 'Plugin %s: hide posts which not in current language', 'content-views-pro' ), "<code>$translation_plugin</code>" );
		}

		return $args;
	}

	/**
	 * Add settings panel for Date
	 *
	 * @param array $args
	 */
	public function filter_advanced_settings_panel( $args ) {

		// Filter by Date
		$date = PT_CV_Settings_Pro::filter_date_settings();

		// Filter by Custom Fields
		$custom_field = PT_CV_Settings_Pro::filter_custom_field_settings();

		// Move settings of Date, Custom Fields to 2nd, 3rd position, right after Taxonomy settings
		$args = array_slice( $args, 0, 1, true ) + $date + $custom_field + array_slice( $args, 1, count( $args ) - 1, true );

		return $args;
	}

	/**
	 * Taxonomy custom settings
	 *
	 * @param array $args
	 * @return array
	 */
	public function filter_taxonomies_custom_settings( $args ) {
		$prefix = 'taxonomy-';

		$args = array(
			'label'			 => array(
				'text' => '',
			),
			'extra_setting'	 => array(
				'params' => array(
					'group-class'	 => PT_CV_PREFIX . 'taxonomy-extra',
					'wrap-class'	 => PT_CV_PREFIX . $prefix . 'custom-query',
					'width'			 => 12,
				),
			),
			'params'		 => array(
				array(
					'type'	 => 'group',
					'params' => array(
						// Taxonomy as output or as heading
						array(
							'label'	 => array(
								'text' => __( 'Output modification', 'content-views-pro' ),
							),
							'params' => array(
								array(
									'type'		 => 'select',
									'name'		 => $prefix . 'term-info',
									'options'	 => PT_CV_Values_Pro::term_filter_custom(),
									'std'		 => '',
								),
							),
						),
						array(
							'label'		 => array(
								'text' => __( 'Custom settings', 'content-views-pro' ),
							),
							'params'	 => array(
								array(
									'type'	 => 'group',
									'params' => array(
										// One post per category
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'width' => 12,
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix . 'one-per-term',
													'options'	 => PT_CV_Values::yes_no( 'yes', __( 'For each term, show this number of posts', 'content-views-pro' ) ),
													'std'		 => '',
													'class'		 => 'ignore',
												),
											),
										),
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'width'			 => 12,
													'wrap-class'	 => PT_CV_PREFIX . 'w200',
													'group-class'	 => PT_CV_PREFIX . 'postperterm',
												),
											),
											'params'		 => array(
												array(
													'type'	 => 'number',
													'name'	 => $prefix . 'number-per-term',
													'std'	 => 1,
												),
											),
											'dependence'	 => array( $prefix . 'one-per-term', 'yes' ),
										),
										// Include children categories
										array(
											'label'			 => array(
												'text' => '',
											),
											'extra_setting'	 => array(
												'params' => array(
													'width' => 12,
												),
											),
											'params'		 => array(
												array(
													'type'		 => 'checkbox',
													'name'		 => $prefix . 'exclude-children',
													'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Exclude children terms', 'content-views-pro' ) ),
													'std'		 => '',
													'desc'		 => __( 'By default, children terms are included automatically (to get posts) when parent term is selected', 'content-views-pro' ),
													'class'		 => 'ignore',
												),
											),
										),
									),
								),
							),
							'dependence' => array( $prefix . 'term-info', 'as_output', '!=' ),
						),
					),
				),
			),
			'dependence'	 => array( 'taxonomy[]', array_keys( PT_CV_Values::taxonomy_list() ) ),
		);

		return $args;
	}

	/**
	 * Filter search by keyword description
	 *
	 * @param string $args
	 */
	public function filter_searchby_keyword_desc( $args ) {
		$args = '<br>' . sprintf( __( 'Separate multiple keywords by space or %s', 'content-views-pro' ), '<code>+</code>' ) . ', for example: <code>content+views+plugin</code> or <code>content views plugin</code>';

		return $args;
	}

	/**
	 * Filter Author settings
	 *
	 * @param array $args
	 */
	public function filter_author_settings( $args ) {
		$prefix = 'author-';

		$args[] = array(
			'label'	 => array(
				'text' => __( 'For logged in user', 'content-views-pro' ),
			),
			'params' => array(
				array(
					'type'		 => 'select',
					'name'		 => $prefix . 'current-user',
					'options'	 => array(
						''			 => __( 'Default' ),
						'include'	 => __( 'Include his/her posts', 'content-views-query-and-display-post-page' ),
						'exclude'	 => __( 'Exclude his/her posts', 'content-views-query-and-display-post-page' ),
					),
					'std'		 => '',
				),
			),
		);

		return $args;
	}

	public function filter_viewtype_setting( $args ) {
		$args[ 'type' ] = 'select';

		return $args;
	}

	public function filter_contenttype_setting( $args ) {
		if ( count( PT_CV_Values::post_types() ) > 5 ) {
			$args[ 'type' ] = 'select';
		}

		return $args;
	}

	/**
	 * Do action before delete/trash View
	 */
	public function action_before_delete_view( $post_id ) {
		global $post_type;

		if ( $post_type == PT_CV_POST_TYPE ) {
			$user_can = PT_CV_Functions_Pro::user_can_manage_view();
			if ( !$user_can ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'content-views-pro' ) );
			}
		}
	}

	/**
	 * Add settings tab header
	 */
	public function action_setting_tabs_header() {
		$tabs = array(
			array(
				'id'	 => 'style-settings',
				'icon'	 => 'pencil',
				'text'	 => __( 'Style Settings', PT_CV_DOMAIN_PRO ),
			),
			array(
				'id'	 => 'taxonomy-filter',
				'icon'	 => 'random',
				'text'	 => __( 'Shuffle Filter', PT_CV_DOMAIN_PRO ),
			),
			array(
				'id'	 => 'animation-settings',
				'icon'	 => 'flash',
				'text'	 => __( 'Animation', PT_CV_DOMAIN_PRO ),
			),
		);

		if ( PT_CV_Functions::get_option_value( 'show_content_ads' ) ) {
			$tabs[] = array(
				'id'	 => 'content-ads',
				'icon'	 => 'usd',
				'text'	 => __( 'Content Ads', PT_CV_DOMAIN_PRO ),
			);
		}

		foreach ( $tabs as $tab ) {
			printf( '<li><a href="#%s" data-toggle="tab"><span class="glyphicon glyphicon-%s"></span>%s</a></li>', PT_CV_PREFIX . $tab[ 'id' ], $tab[ 'icon' ], $tab[ 'text' ] );
		}
	}

	/**
	 * Add settings tab content
	 *
	 * @param array $settings
	 */
	public function action_setting_tabs_content( $settings ) {
		echo self::_tab_style_settings( $settings );
		echo self::_tab_shuffle_filter( $settings );
		echo self::_tab_animation_settings( $settings );

		if ( PT_CV_Functions::get_option_value( 'show_content_ads' ) ) {
			echo self::_tab_content_ads( $settings );
		}
	}

	/**
	 * Add Report bug buttons
	 */
	public function action_admin_more_buttons() {
		?>
		<a href="http://www.contentviewspro.com/contact/" target="_blank" class="btn btn-default pull-right pt-cv-report-bug" style="margin-right: 10px; background-color: #ebebeb;">Report bug</a>
		<?php
	}

	/**
	 * Setting HTML of "Shuffle Filter" tab
	 *
	 * @return string
	 */
	static function _tab_shuffle_filter( $settings ) {
		ob_start();
		?>
		<div class="tab-pane" id="<?php echo esc_attr( PT_CV_PREFIX ); ?>taxonomy-filter">
			<?php
			$prefix	 = 'taxonomy-filter';
			$options = array(
				array(
					'label'			 => array(
						'text' => '',
					),
					'extra_setting'	 => array(
						'params' => array(
							'width' => 12,
						),
					),
					'params'		 => array(
						array(
							'type'		 => 'checkbox',
							'name'		 => 'enable-' . $prefix,
							'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Filter posts by taxonomy terms with animation', 'content-views-pro' ) ),
							'std'		 => '',
							'desc'		 => sprintf( __( 'Work with %s layout', 'content-views-pro' ), '<code>' . __( 'Grid', 'content-views-query-and-display-post-page' ) . ', ' . __( 'Pinterest', 'content-views-pro' ) . ', ' . __( 'Masonry', 'content-views-pro' ) . '</code>' ),
						),
					),
				),
				array(
					'label'			 => array(
						'text' => __( 'Type' ),
					),
					'extra_setting'	 => array(
						'params' => array(
							'wrap-class' => PT_CV_PREFIX . 'shuffle-filter-type',
						),
					),
					'params'		 => array(
						array(
							'type'		 => 'radio',
							'name'		 => $prefix . '-type',
							'options'	 => PT_CV_Values_Pro::taxonomy_filter_style( 'filter-bar-sample' ),
							'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values_Pro::taxonomy_filter_style() ),
						),
					),
					'dependence'	 => array( 'enable-' . $prefix, 'yes' ),
				),
				array(
					'label'			 => array(
						'text' => '',
					),
					'extra_setting'	 => array(
						'params' => array(
							'width' => 12,
						),
					),
					'params'		 => array(
						array(
							'type'	 => 'group',
							'params' => array(
								array(
									'label'			 => array(
										'text' => __( 'Operator', 'content-views-query-and-display-post-page' ),
									),
									'extra_setting'	 => array(
										'params' => array(
											'wrap-class' => PT_CV_PREFIX . 'w200',
										),
									),
									'params'		 => array(
										array(
											'type'	 => 'text',
											'name'	 => $prefix . '-operator',
											'std'	 => 'and',
											'desc'	 => sprintf( '<code>and</code> (%s), <code>or</code> (%s). %s', __( 'to show posts which have all selected terms of each taxonomy', 'content-views-pro' ), __( 'to show posts which have one or more selected terms of each taxonomy', 'content-views-pro' ), sprintf( __( 'Separate value for each taxonomy by comma, for example: %s', 'content-views-pro' ), '<code>or, or</code>' ) ),
										),
									),
									'dependence'	 => array( $prefix . '-type', 'group_by_taxonomy' ),
								),
							),
						),
					),
					'dependence'	 => array( 'enable-' . $prefix, 'yes' ),
				),
				array(
					'label'			 => array(
						'text' => __( 'Heading word', 'content-views-pro' ),
					),
					'extra_setting'	 => array(
						'params' => array(
							'wrap-class' => PT_CV_PREFIX . 'w200',
						),
					),
					'params'		 => array(
						array(
							'type'	 => 'text',
							'name'	 => $prefix . '-heading-word',
							'std'	 => __( 'All' ),
							'desc'	 => sprintf( __( 'Separate value for each taxonomy by comma, for example: %s', 'content-views-pro' ), '<code>Heading 1, Heading 2</code>' ),
						),
					),
					'dependence'	 => array( 'enable-' . $prefix, 'yes' ),
				),
				array(
					'label'		 => array(
						'text' => __( 'Output', 'content-views-pro' ),
					),
					'params'	 => array(
						array(
							'type'	 => 'group',
							'params' => array(
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'		 => 'checkbox',
											'name'		 => 'taxonomy-hide-empty',
											'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Hide empty terms (which have no posts)', 'content-views-pro' ) ),
											'std'		 => '',
										),
									),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'		 => 'checkbox',
											'name'		 => $prefix . '-trigger-pagination',
											'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Load more posts automatically when click on term', 'content-views-pro' ) ),
											'std'		 => '',
											'desc'		 => __( 'Check this option if you see no post when click on term. The reason is when pagination enabled, it will show limit posts at the beginning (so it can not guarantee that there is at least 1 post of every term)', 'content-views-pro' ),
										),
									),
									'dependence'	 => array( 'enable-pagination', 'yes' ),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'		 => 'checkbox',
											'name'		 => $prefix . '-show-all',
											'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Show all remain posts of term on pagination', 'content-views-pro' ) ),
											'std'		 => '',
											'desc'		 => sprintf( __( 'By default, it only shows limit posts on pagination (configured at %s)', 'content-views-pro' ), __( 'Pagination', 'content-views-query-and-display-post-page' ) . ' >> ' . __( 'Items per page', 'content-views-query-and-display-post-page' ) ),
										),
									),
									'dependence'	 => array( 'enable-pagination', 'yes' ),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'		 => 'checkbox',
											'name'		 => 'taxonomy-show-operator',
											'options'	 => PT_CV_Values::yes_no( 'yes', __( 'Allow visitors to select operator (and/or) in View output', 'content-views-pro' ) ),
											'std'		 => '',
										),
									),
									'dependence'	 => array( $prefix . '-type', 'group_by_taxonomy' ),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'			 => 'number',
											'name'			 => $prefix . '-space',
											'std'			 => '10',
											'append_text'	 => 'px',
											'desc'			 => __( 'Space between buttons', 'content-views-pro' ),
										),
									),
									'dependence'	 => array( $prefix . '-type', 'btn-group' ),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width'		 => 12,
											'wrap-class' => PT_CV_PREFIX . 'w200',
										),
									),
									'params'		 => array(
										array(
											'type'		 => 'select',
											'name'		 => $prefix . '-position',
											'options'	 => PT_CV_Values_Pro::taxonomy_filter_position(),
											'std'		 => PT_CV_Functions::array_get_first_key( PT_CV_Values_Pro::taxonomy_filter_position() ),
											'desc'		 => __( 'Position of filter bar', 'content-views-pro' ),
										),
									),
									'dependence'	 => array( $prefix . '-type', 'group_by_taxonomy', '!=' ),
								),
								array(
									'label'			 => array(
										'text' => '',
									),
									'extra_setting'	 => array(
										'params' => array(
											'width' => 12,
										),
									),
									'params'		 => array(
										array(
											'type'			 => 'number',
											'name'			 => $prefix . '-margin-bottom',
											'std'			 => '20',
											'append_text'	 => 'px',
											'min'			 => '-100',
											'desc'			 => __( 'Bottom margin of filter bar', 'content-views-pro' ),
										),
									),
								),
							),
						),
					),
					'dependence' => array( 'enable-' . $prefix, 'yes' ),
				),
			);
			$options = apply_filters( PT_CV_PREFIX_ . 'taxonomy_filter_settings', $options );
			echo PT_Options_Framework::do_settings( $options, $settings );
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Setting HTML of "Style Setttings" tab
	 *
	 * @return string
	 */
	static function _tab_style_settings( $settings ) {
		ob_start();
		?>
		<div class="tab-pane" id="<?php echo esc_attr( PT_CV_PREFIX ); ?>style-settings">
			<?php
			#$prefix = 'style-settings';
			$options = array();

			// Font settings
			$options[] = PT_CV_Settings_Pro::field_font_settings_group( 'show-field-' );

			// View, Item, Button style
			$options[]	 = PT_CV_Settings_Pro::view_style_settings( 'view' );
			$options[]	 = PT_CV_Settings_Pro::view_style_settings( 'item' );
			$options[]	 = PT_CV_Settings_Pro::view_style_settings( 'button' );

			$options = apply_filters( PT_CV_PREFIX_ . 'style_settings', $options );
			echo PT_Options_Framework::do_settings( $options, $settings );
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Setting HTML of "Animation & Effect" tab
	 *
	 * @return string
	 */
	static function _tab_animation_settings( $settings ) {
		ob_start();
		?>
		<div class="tab-pane" id="<?php echo esc_attr( PT_CV_PREFIX ); ?>animation-settings">
			<?php
			#$prefix = 'animation-settings';
			$options = apply_filters( PT_CV_PREFIX_ . 'animation_settings', PT_CV_Settings_Pro::animation_settings() );
			echo PT_Options_Framework::do_settings( $options, $settings );
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Setting HTML of "Content Ads" tab
	 *
	 * @return string
	 */
	static function _tab_content_ads( $settings ) {
		ob_start();
		?>
		<div class="tab-pane" id="<?php echo esc_attr( PT_CV_PREFIX ); ?>content-ads">
			<?php
			$prefix	 = 'ads-';
			$options = apply_filters( PT_CV_PREFIX_ . 'content_ads', PT_CV_Settings_Pro::content_ads_settings( $prefix ) );
			echo PT_Options_Framework::do_settings( $options, $settings );
			?>
		</div>
		<?php
		return ob_get_clean();
	}

}
