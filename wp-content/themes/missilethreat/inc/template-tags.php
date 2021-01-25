<?php
/**
 * Custom template tags for this theme.
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

/**
 * Table of Contents:
 * Logo & Description
 * Post Meta
 * Menus
 * Classes
 * Archives
 * Miscellaneous
 */

/**
 * Logo & Description
 */
/**
 * Displays the site logo, either text or image.
 *
 * @param array   $args Arguments for displaying the site logo either as an image or text.
 * @param boolean $echo Echo or return the HTML.
 *
 * @return string $html Compiled HTML based on our arguments.
 */
function missilethreat_site_logo( $args = array(), $echo = true ) {
	$logo       = get_custom_logo();
	$site_title = get_bloginfo( 'name' );
	$contents   = '';
	$classname  = '';

	$defaults = array(
		'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
		'logo_class'  => 'site-logo',
		'title'       => '<a href="%1$s">%2$s</a>',
		'title_class' => 'site-title',
		'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
		'wrap' => '<div class="%1$s faux-heading">%2$s</div>',
		'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
	);

	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments for `missilethreat_site_logo()`.
	 *
	 * @param array  $args     Parsed arguments.
	 * @param array  $defaults Function's default arguments.
	 */
	$args = apply_filters( 'missilethreat_site_logo_args', $args, $defaults );

	if ( has_custom_logo() ) {
		$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
		$classname = $args['logo_class'];
	} else {
		$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
		$classname = $args['title_class'];
	}

	$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

	$html = sprintf( $args[ $wrap ], $classname, $contents );

	/**
	 * Filters the arguments for `missilethreat_site_logo()`.
	 *
	 * @param string $html      Compiled html based on our arguments.
	 * @param array  $args      Parsed arguments.
	 * @param string $classname Class name based on current view, home or single.
	 * @param string $contents  HTML for site title or logo.
	 */
	$html = apply_filters( 'missilethreat_site_logo', $html, $args, $classname, $contents );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Displays the site description.
 *
 * @param boolean $echo Echo or return the html.
 *
 * @return string $html The HTML to display.
 */
function missilethreat_site_description( $echo = true ) {
	$description = get_bloginfo( 'description' );

	if ( ! $description ) {
		return;
	}

	$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

	$html = sprintf( $wrapper, esc_html( $description ) );

	/**
	 * Filters the html for the site description.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html         The HTML to display.
	 * @param string $description  Site description via `bloginfo()`.
	 * @param string $wrapper      The format used in case you want to reuse it in a `sprintf()`.
	 */
	$html = apply_filters( 'missilethreat_site_description', $html, $description, $wrapper );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Post Meta
 */

/**
 * Displays the post's publish date.
 *
 *
 * @return string $html The post date.
 */
function missilethreat_posted_on() {

	// Require post ID.
	if ( ! get_the_ID() ) {
		return;
	}

	echo '<div class="post-meta post-meta__date">' . get_the_time( get_option( 'date_format' ) ) . '</div>';
}

/**
 * Displays the post's publish date.
 *
 *
 * @return string $html The post date.
 */
function missilethreat_last_updated() {

	// Require post ID.
	if ( ! get_the_ID() ) {
		return;
	}

	echo '<div class="post-meta post-meta__date">' . get_the_modified_time( get_option( 'date_format' ) ) . '</div>';
}

/**
 * Displays the post authors. Uses CoAuthors Plus plugin to display guest authors in place of standard WP authors.
 *
 */
function missilethreat_authors() {
	if ( function_exists( 'coauthors_posts_links' ) ) {
    $authors = coauthors_posts_links( ', ', ' and ', null, null, false );
	} else {
		$authors = the_author_posts_link();
	}

	if ( !$authors ) {
		return;
	}

	echo '<div class="post-meta post-meta__authors">' . $authors . '</div>';
}

if (! function_exists('missilethreat_authors_list_extended')) :
	/**
	 * Prints HTML with short author list.
	 */
	function missilethreat_authors_list_extended()
	{
		global $post;

		if (function_exists('coauthors_posts_links')) {

			foreach (get_coauthors() as $coauthor) {
				$name = $coauthor->display_name;

				if ( $coauthor->website ) {
					$name = '<a href="' . $coauthor->website . '">' . $coauthor->display_name . '</a>';
				}

				$authors .= '<p class="post__authors-author"><span class="text--bold">' . $name . '</span> ' . $coauthor->description . '</p>';
			}
		} else {
			$authors = the_author_posts_link();
		}
		return '<div class="post__authors">' . $authors . '</div>';
	}
endif;

/**
 * Displays the post's categories.
 *
 *
 * @return string $html The categories.
 */
if (! function_exists('missilethreat_display_categories')) :
	function missilethreat_display_categories() {

		foreach (get_the_category() as $category) {
			if ( $category->name !== 'Featured' ) {
				echo '<a class="featured-post__category" href="' . get_category_link($category->term_id) . '">' .$category->name . '</a>'; //Markup as you see fit
			}
		}
	}
endif;

/**
 * Displays the post's tags.
 *
 *
 * @return string $html The categories.
 */
if (! function_exists('missilethreat_display_tags')) :
	function missilethreat_display_tags() {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('<ul class="related__tags-list" role="list"><li class="text--semibold">', '</li><li class="text--semibold">', '</li></ul>');
					
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="related__tags"><h2 class="related__tags-heading">More on</h2>' . esc_html__( '%1$s', 'missilethreat' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

/* Legacy Tags from `missile-defense` theme */
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

		printf( '<h2 class="cite__heading text--bold">Cite this Page</h2><p class="cite__container"><span class="cite__citation">' . esc_html( '%1$s, "%2$s,"', 'missiledefense' ) . ' <em>%3$s</em>' . esc_html( ', Center for Strategic and International Studies, %4$s, %5$s%6$s.', 'missiledefense') . '</span><button id="btn-copy" class="btn btn--dark btn--icon btn--short" data-clipboard-target=".cite__citation" aria-label="Copied!">Copy' . missilethreat_get_svg( 'copy' ) . '</button></p>', $authors, $title, get_bloginfo( 'name' ), get_the_date(), $modified_date, get_the_permalink() ); // WPCS: XSS OK.
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

		$args = array(
			'tag' => $current_related_tags, // Here is where is being filtered by the tag you want
			'orderby' => 'date',
			'order' => 'DSC',
			'posts_per_page' => '2'

		);
		
		$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) { ?>
			<div class="related__wrapper alignwide">
			<div class="related">
				<h2 class="related__heading">Related</h2>
				<?php echo missilethreat_display_tags(); ?>

			<?php	$i = 0;
			
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				get_template_part( 'template-parts/block-post' );
				
				
			}

		}

		if ( $current_related_tags && $the_query->found_posts > 2 ) {
			echo '<div class="related__more"><a href="' . esc_url( '/tag/' . $current_related_tags) . '">All related posts' . missilethreat_get_svg( 'chevron-right' ) . '</a></div>';
		} ?>
		</div>
		</div>
		<?php wp_reset_query();
	} 
endif;

if ( ! function_exists( 'missiledefense_display_system_elements' ) ) :
	/**
	 * Returns HTML with system elements for system taxonomy terms.
	 *
	 * @param int $id Post ID.
	 */
	function missiledefense_display_system_elements() {
		if ( 'systems' == get_post_type() ) {
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

				$html = '<div class="system-elements alignright">
				<h2 class="system-elements__header text--semibold">' . $archiveTitle . '</h2>
				<hr class="system-elements__divider">
				<ul role="list" class="system-elements__list">';

				foreach ( $elements as $element ) {
					$html .= '<li id="post-' . $element->ID . '" class="system-elements__item"><a href="' . esc_url( get_permalink( $element->ID )) . '" rel="bookmark">' . $element->post_title . '</a></li>';
				}
				wp_reset_postdata();
				$html .= '</ul></div>';

				return $html;
			}
			return;
		}
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
				printf( '<div class="footnotes collapsible-content-container"><h2 class="footnotes__heading collapsible-title text--semibold">' . esc_html( 'Footnotes', 'missiledefense') . '</h2><ol class="footnotes__list collapsible-content">%1$s</ol></div>', $footnotes ); // WPCS: XSS OK.
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
			$html = '<h3 class="parent-system__label">Associated Systems: </h3>';
			foreach ( $systems as $system ) {
				$prefix = '<br/>';
				if ( $i == 0 ) {
					$prefix = '';
				}
				$html .= $prefix . '<a class="parent-system__link" href="' . esc_url( get_permalink( $system->ID )) . '" rel="tag">' . $system->post_title . missilethreat_get_svg('chevron-right') . '</a>';
			}
			wp_reset_postdata();

			printf( '%1$s', $html);
		}
	}
endif;

if ( ! function_exists( 'missiledefense_actors' ) ) :
	/**
	 * Returns group of links to Actors and their icons by category.
	 *
	 */
	function missiledefense_actors( $group ) {
		$object = get_queried_object();
		$actors_group = get_field( $group, $object->name );

		$args = array(
			'post_type' => 'actors',
			'numberposts' => -1,
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_key' => '_actors_archive_name',
			'include' => $actors_group
		);

		$actors = get_posts( $args ); ?>

		<?php
		foreach ( $actors as $post) {
			setup_postdata( $post );
			include( locate_template( 'template-parts/actor-block.php' ) );
		}
	}
endif;

if ( ! function_exists( 'missiledefense_defsys' ) ) :
	/**
	 * Returns group of links to Defense Systems and their icons by category.
	 *
	 */
	function missiledefense_defsys($group) {
		$object = get_queried_object();
		$systems_group = get_field( $group, $object->name );

		$args = array(
			'post_type' => 'systems',
			'numberposts' => -1,
			'orderby' => 'post_title',
			'order' => 'ASC',
			'include' => $systems_group
		);

		$systems = get_posts( $args );

		foreach ( $systems as $post) {
		setup_postdata( $post );
		include( locate_template( 'template-parts/system-block.php' ) );
	}
	}
endif;

/**
 * Displays the AddToAny Share Links.
 *
 *
 * @return string $html The share links.
 */
if (! function_exists('missiledefense_share')) :
	function missiledefense_share() {
		if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
			ADDTOANY_SHARE_SAVE_KIT();
		}
	}
endif;

/**
 * Displays the post attribution.
 *
 *
 * @return string $html The share links.
 */
if (! function_exists('missilethreat_post_attribution')) :
	function missilethreat_post_attribution() {
		$object = get_queried_object();

		$post_attribution = get_field( 'post_attribution', $object->name );

		if ( !empty ( $post_attribution ) ) {
			echo '<p class="single__footer-attribution">' .  $post_attribution . '</p>';
		}
	}
endif;



/**
 * Displays the number of items and pages on archive & search pages.
 *
 *
 * @return string $html The share links.
 */
if (! function_exists('missilethreat_number_of_posts')) :
	function missilethreat_number_of_posts() {
		global $wp_query;
		$total_posts = $wp_query->found_posts;
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$pages = $wp_query->max_num_pages;
		echo '<h2 class="archive__results">' . $total_posts . ' items, Page ' . $page . ' of ' . $pages . '</h2>';
	}
endif;