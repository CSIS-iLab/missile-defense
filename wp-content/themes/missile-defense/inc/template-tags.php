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
		$year = get_the_date( 'Y' );
		if ( 'data' === get_post_type() ) {
			$authors = get_bloginfo('name');
		} else {
			$authors = coauthors( ', ', null, null, null, false );
		}
		printf( '<span class="meta-label">Cite this Page</span><p><span class="citation">' . esc_html( '%1$s,', 'missiledefense') . ' <em>%2$s</em> ' . esc_html( '(Washington D.C.: Center for Strategic and International Studies, %3$s), %4$s', 'missiledefense' ) . '</span><button id="btn-copy" class="btn btn-gray" data-clipboard-target=".citation" aria-label="Copied!">Copy</button></p>', $authors, get_the_title(), $year, get_the_permalink() ); // WPCS: XSS OK.
	}
endif;
