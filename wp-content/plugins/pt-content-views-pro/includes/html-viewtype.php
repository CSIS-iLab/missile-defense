<?php

/**
 * HTML output for specific View types
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Html_ViewType_Pro' ) ) {

	/**
	 * @name PT_CV_Html_ViewType_Pro
	 * @todo List of functions relates to View type output
	 */
	class PT_CV_Html_ViewType_Pro {
		/**
		 * Wrap elements to Grid layout
		 *
		 * @param array $content_items
		 * @param string $column
		 * @param int $class
		 * @param string $defined_span
		 */
		static function grid_wrapper_simple( $content_items, $column = 0, $class = '', $defined_span = '' ) {
			$content = array();

			list( $columns, $span_width_last, $span_width, $span_class ) = PT_CV_Html_ViewType::process_column_width( $column );

			// Split items to rows
			$columns_item = array_chunk( $content_items, $columns, true );

			// Get HTML of each row
			foreach ( $columns_item as $items_per_row ) {
				$row_html = array();

				$idx = 0;
				foreach ( $items_per_row as $content_item ) {
					if ( !empty( $defined_span[ $idx ] ) ) {
						$_span_width = $defined_span[ $idx ];
					} else {
						$count		 = count( $items_per_row );
						$_span_width = ( $count == $columns && $idx + 1 == $count ) ? $span_width_last : $span_width;
					}

					// Wrap content of item
					$item_classes	 = apply_filters( PT_CV_PREFIX_ . 'item_col_class', array( $span_class . $_span_width, $class ), $_span_width );
					$item_class		 = implode( ' ', array_filter( $item_classes ) );
					$row_html[]		 = sprintf( '<div class="%s">%s</div>', esc_attr( $item_class ), $content_item );

					$idx ++;
				}

				$list_item = implode( "\n", $row_html );

				$content[] = $list_item;
			}

			return $content;
		}

		static function pin_mas_item_wrap( $content_item ) {
			$class = PT_CV_PREFIX . 'pinmas';
			return "<div class='$class'>$content_item</div>";
		}

		/**
		 * Wrap content of Pinterest layout
		 *
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 *
		 * @return array Array of HTML of items
		 */
		static function pinterest_wrapper( $content_items ) {
			$content		 = array();
			$content_items	 = array_map( array( __CLASS__, 'pin_mas_item_wrap' ), $content_items );
			PT_CV_Html_ViewType::grid_wrapper( $content_items, $content );
			return $content;
		}

		/**
		 * Wrap content of Masonry layout
		 *
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 *
		 * @return array Array of HTML of items
		 */
		static function masonry_wrapper( $content_items ) {
			$content		 = array();
			$content_items	 = array_map( array( __CLASS__, 'pin_mas_item_wrap' ), $content_items );

			# 2 small items: 3md, 1 big item: 6md
			$column = 4;

			list( $columns, $span_width_last, $span_width, $span_class ) = PT_CV_Html_ViewType::process_column_width( $column, false );

			$count_big		 = $count_seq_small = $prev_width_big	 = 0;

			foreach ( $content_items as $post_id => $content_item ) {
				// Calculate width of this item
				$rand = rand( 0, 1 );
				if ( ( $rand || ( $count_seq_small > 3 && $count_big ) || ( $count_big === 0 && $count_seq_small === 2 ) ) && $count_seq_small > 1 && !$prev_width_big ) {
					$count_big++;
					$count_seq_small = 0;
					$prev_width_big	 = true;
					$_span_width	 = $span_width * 2;
				} else {
					$count_seq_small++;
					$prev_width_big	 = false;
					$_span_width	 = $span_width;
				}

				// Wrap content of item
				$item_classes	 = apply_filters( PT_CV_PREFIX_ . 'item_col_class', array( $span_class . $_span_width ), $_span_width );
				$item_class		 = implode( ' ', array_filter( $item_classes ) );
				$content[]		 = PT_CV_Html::content_item_wrap( $content_item, $item_class, $post_id );
			}

			return $content;
		}

		/**
		 * Wrap content of Timeline type
		 *
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 * @param int   $current_page  The current page
		 * @param int   $post_per_page The number of posts per page
		 *
		 * @return array Array of HTML of items
		 */
		static function timeline_wrapper( $content_items, $current_page, $post_per_page ) {
			$content = array();

			// If normal pagination
			$vpage = !empty( $_GET[ 'vpage' ] );

			// The spine
			if ( $current_page === 1 || $vpage ) {
				$content[] = sprintf( '<div class="%s"><a href="#"></a></div>', 'tl-spine' );
			}

			// Wrap all items (start)
			if ( $current_page === 1 || $vpage ) {
				$content[] = sprintf( '<div class="%s">', 'tl-items' );
			}

			$idx = 1;

			// Get index of item
			if ( $post_per_page % 2 == 1 ) {
				$idx = ( $current_page % 2 == 0 ) ? 2 : 1;
			}

			foreach ( $content_items as $post_id => $content_item ) {
				$item_class = 'tl-item ' . ( ( $idx % 2 == 0 ) ? 'pt-right' : 'pt-left' );

				ob_start();
				do_action( PT_CV_PREFIX_ . 'item_extra_html', $post_id );
				$content_item .= ob_get_clean();

				$item_html	 = sprintf( '<div class="%s"><i class="%s"></i><div class="%s" data-pid="%s">%s</div></div>', 'tl-item-content', 'tl-pointer', PT_CV_PREFIX . 'content-item', $post_id, $content_item );
				$content[]	 = sprintf( '<div class="%s">%s</div>', $item_class, $item_html );
				$idx ++;
			}

			// Wrap all items (close)
			if ( $current_page === 1 ) {
				$content[] = '</div>';
			}

			return $content;
		}

		/**
		 * Wrap content of Glossary layout
		 *
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 * @param int   $current_page  The current page
		 * @param int   $post_per_page The number of posts per page
		 *
		 * @return array Array of HTML of items
		 */
		static function glossary_wrapper( $content_items, $current_page, $post_per_page ) {

			$glossary_list	 = PT_CV_Functions::get_global_variable( 'glossary_list' );
			$content		 = array();

			foreach ( $glossary_list as $index => $items ) {
				// Header text
				$header = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'gls-header', $index );

				// List of items
				$list		 = array();
				PT_CV_Html_ViewType::grid_wrapper( $items, $list );
				$posts_list	 = sprintf( '<div class="%s">%s</div>', PT_CV_PREFIX . 'gls-content', implode( '', $list ) );

				$content[] = sprintf( '<div id="%s" class="%s">%s</div>', PT_CV_PREFIX . 'gls-' . $index, PT_CV_PREFIX . 'gls-group', $header . $posts_list );
			}

			return $content;
		}

		/**
		 * Wrap content of One-and-others layout
		 *
		 * @param array $content_items The array of Raw HTML output (is not wrapped) of each item
		 * @param int   $current_page  The current page
		 * @param int   $post_per_page The number of posts per page
		 *
		 * @return array Array of HTML of items
		 */
		static function one_others_wrapper( $content_items, $current_page, $post_per_page ) {
			$content		 = $posts_group	 = $second_group	 = $all_groups		 = array();
			$dargs			 = PT_CV_Functions::get_global_variable( 'dargs' );

			#1 Add 1st post to 1st group
			$first_post		 = array_slice( $content_items, 0, 1, true );
			$posts_group[]	 = PT_CV_Html::content_item_wrap( current( $first_post ), '', current( array_keys( $first_post ) ) );

			#2 Add other posts to 2nd group
			$other_columns = isset( $dargs[ 'view-type-settings' ][ 'number-columns-others' ] ) ? (int) $dargs[ 'view-type-settings' ][ 'number-columns-others' ] : 1;

			// Wrap other posts to Grid
			PT_CV_Functions::set_global_variable( 'other_columns', $other_columns );
			PT_CV_Html_ViewType::grid_wrapper( array_slice( $content_items, 1, null, true ), $second_group, $other_columns, PT_CV_PREFIX . 'oop' );

			// Force 2 columns for other posts
			$posts_group[] = str_replace( '1-col', '2-col', implode( '', $second_group ) );

			#3 Wrap 2 groups to columns
			$defined_span	 = '';
			$on_left		 = ($dargs[ 'number-columns' ] === '2');

			if ( $on_left ) {
				$width_proportion	 = isset( $dargs[ 'view-type-settings' ][ 'width-prop' ] ) ? $dargs[ 'view-type-settings' ][ 'width-prop' ] : '6-6';
				$defined_span		 = explode( '-', $width_proportion );
			}

			PT_CV_Functions::set_global_variable( 'other_above', !$on_left );
			$content = self::grid_wrapper_simple( $posts_group, 0, PT_CV_PREFIX . 'ooc', $defined_span );

			return $content;
		}

	}

}