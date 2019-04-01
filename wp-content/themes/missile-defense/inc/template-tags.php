<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Missile_Defense
 */

if ( ! function_exists( 'missiledefense_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

/* Rewrote/simplified get_the_coauthor function -PF */

function missiledefense_posted_on() {
	echo 'Published: ' . get_the_date();
	echo ' | By ';
 	if ( function_exists( 'coauthors_posts_links' ) ) {
 		coauthors_posts_links();
 	}
 	else {
 		the_author();
 	}
}
endif;

if ( ! function_exists( 'missiledefense_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function missiledefense_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'missiledefense' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span>',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'missiledefense_entry_categories' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function missiledefense_entry_categories() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'missiledefense' ) );
		if ( $categories_list && missiledefense_categorized_blog() ) {
			printf( '<div class="cat-links">' . esc_html__( '%1$s', 'missiledefense' ) . '</div>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'missiledefense' ) );
		if ( $tags_list ) {
			printf( '<div class="tags-links">Associated Tags: ' . esc_html__( '%1$s', 'missiledefense' ) . '</div>', $tags_list );
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function missiledefense_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'missiledefense_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'missiledefense_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so missiledefense_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so missiledefense_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in missiledefense_categorized_blog.
 */
function missiledefense_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'missiledefense_categories' );
}
add_action( 'edit_category', 'missiledefense_category_transient_flusher' );
add_action( 'save_post',     'missiledefense_category_transient_flusher' );

if ( ! function_exists( 'missiledefense_actors_secondary_content' ) ) :
	/**
	 * Returns HTML for the secondary content for country posts.
	 *
	 * @param  int $id Post ID.
	 */
	function missiledefense_actors_secondary_content( $id ) {
		if ( 'actors' === get_post_type() ) {
			$secondary_content = get_post_meta( $id, '_actors_secondary_content', true );
			if ( '' !== $secondary_content ) {
				$secondary_content = apply_filters( 'meta_content', $secondary_content );
				printf( '%1$s', $secondary_content); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'missiledefense_citation' ) ) :
	/**
	 * Returns HTML with post citation.
	 *
	 * @param int $id Post ID.
	 */
	function missiledefense_citation() {
		$authors = coauthors( ', ', null, null, null, false );

		$modified_date = null;
		if ( get_the_modified_date() ) {
			$modified_date = 'last modified ' . get_the_modified_date() . ', ';
		}

		$title = get_the_title();
		if ( is_tax() ) {
			$title = get_the_archive_title();
		}

		printf( '<h4 class="post-footer-heading">Cite this Page</h4><p class="citation-container"><span class="citation">' . esc_html( '%1$s, "%2$s,"', 'missiledefense' ) . ' <em>%3$s</em>' . esc_html( ', Center for Strategic and International Studies, published %4$s, %5$s%6$s.', 'missiledefense') . '</span><button id="btn-copy" class="btn btn-square btn-small btn-gray" data-clipboard-target=".citation" aria-label="Copied!">Copy</button></p>', $authors, $title, get_bloginfo( 'name' ), get_the_date(), $modified_date, get_the_permalink() ); // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'missiledefense_related_posts' ) ) :
	/**
	 * Returns HTML with related posts if related tag was provided.
	 *
	 * @param int $id Post ID.
	 */
	function missiledefense_related_posts() {
		global $post;
		$current_related_tags = get_post_meta( $post->ID, '_post_related_tags', true );

		if ( is_tax() ) {
			$term = get_queried_object_id();
			$current_related_tags = get_term_meta( $term, 'archive_related_tags', true );
		}

		echo '<div class="relatedposts"><h4 class="post-footer-heading">Related Posts</h4>';
		echo do_shortcode( '[catlist pagination=no tags="' . $current_related_tags . '" numberposts=3 date=yes date_class="relatedDates"]' );

		if ( $current_related_tags ) {
			echo '<a class="moreposts" href="' . esc_url( '/tag/' . $current_related_tags) . '">Read all related posts</a></div>';
		}
	}
endif;

if ( ! function_exists( 'missiledefense_display_system_elements' ) ) :
	/**
	 * Returns HTML with system elements for system taxonomy terms.
	 *
	 * @param int $id Post ID.
	 */
	function missiledefense_display_system_elements() {
		global $post;
		$terms = wp_get_post_terms( $post->ID, 'system', array('fields' => 'ids')  );
		$elements = null;
		if ( !empty( $terms ) ) {
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'defsys',
				'orderby' => 'post_title',
				'order' => 'ASC',
			    'tax_query' => array(
		            array(
		                'taxonomy' => 'system',
		                'field' => 'term_id',
		                'terms' => $terms[0],
		            )
		        )
			);
			$elements = get_posts( $args );
		}

		if ( $elements ) {
			$archiveTitle = get_post_meta( $post->ID, '_systems_elements_list_title', true );
			if(!$archiveTitle) {
				$archiveTitle = esc_html__( 'System Elements', 'missiledefense' );
			}

			$html = '<div class="system-elements">
					<h1>' . $archiveTitle . '</h1>
					<ul>';

			foreach ( $elements as $element ) {
				$html .= '<li id="post-' . $element->ID . '"><a href="' . esc_url( get_permalink( $element->ID )) . '" rel="bookmark">' . $element->post_title . '</a></li>';
			}
			wp_reset_postdata();
			$html .= '</ul></div>';

			return $html;
		}
		return;
	}
endif;

if ( ! function_exists( 'missiledefense_display_footnotes' ) ) :
	/**
	 * Returns HTML with easy footnotes.
	 *
	 */
	function missiledefense_display_footnotes() {
		if ( class_exists( 'easyFootnotes' ) ) {
			global $easyFootnotes;

			$footnotes = $easyFootnotes->easy_footnote_after_content('');

			if ( $footnotes != '' ) {
				printf( '<div class="entry-footnotes col-xs-12 collapsible-content-container"><h4 class="post-footer-heading collapsible-title">' . esc_html( 'Footnotes', 'missiledefense') . '</h4><ol class="easy-footnotes-wrapper collapsible-content">%1$s</ol></div>', $footnotes ); // WPCS: XSS OK.
				}
		}
	}
endif;

if ( ! function_exists( 'missiledefense_system_terms' ) ) :
	/**
	 * Returns HTML with breadcrumbs for system terms.
	 *
	 */
	function missiledefense_system_terms() {
		global $post;
		$terms = wp_get_post_terms( $post->ID, 'system', array('fields' => 'ids')  );
		$systems = null;
		if ( !empty( $terms ) ) {
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'systems',
				'orderby' => 'post_title',
				'order' => 'ASC',
			    'tax_query' => array(
		            array(
		                'taxonomy' => 'system',
		                'field' => 'term_id',
		                'terms' => $terms,
		            )
		        )
			);
			$systems = get_posts( $args );
		}

		if ( $systems ) {
			$html = 'Systems: ';
			$i = 0;
			foreach ( $systems as $system ) {
				$prefix = ', ';
				if ( $i == 0 ) {
					$prefix = '';
				}
				$html .= $prefix . '<a href="' . esc_url( get_permalink( $system->ID )) . '" rel="tag">' . $system->post_title . '</a>';
				$i++;
			}
			wp_reset_postdata();

			printf( '%1$s', $html);
		}
	}
endif;
