<?php
/**
 * Custom shortcodes for the theme
 *
 * @package missiledefense
 */

/**
 * Shortcode for displaying enclosed content at the full width of the browser
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_fullWidth( $atts , $content = null ) {
	return "<div class='fullWidthFeatureContent'>".do_shortcode($content)."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Shortcode for displaying sticky table of contents
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_tableOfContentsSidebar( $atts , $content = null ) {
	return "<div class='tableOfContents'>".do_shortcode($content)."</div>";
}
add_shortcode( 'tocSidebar', 'shortcode_tableOfContentsSidebar' );

/**
 * Shortcode for displaying content next to a table of contents
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_tableOfContentsMain( $atts , $content = null ) {
	return "<div class='tableOfContents-mainContent'>".do_shortcode($content)."</div>";
}
add_shortcode( 'tocMain', 'shortcode_tableOfContentsMain' );

/**
 * Shortcode for displaying definition/jargon
 */

function shortcode_definition($atts, $content = null) {
	$atts = shortcode_atts (
		array(
			'definition' => null,
		),
		$atts,
		'define'
	);
	$definition = $atts['definition'];
	return '<span class="term-definition tooltipped tooltipped-multiline tooltipped-n" aria-label="'.esc_attr($definition).'"><span>'.$content.'</span><i class="icon-asset-2-01"></i></span>';
}
add_shortcode( 'define', 'shortcode_definition' );

/**
 * Shortcode for displaying system elements table.
 * @param  array $atts    Modifying arguments
 * @param  string $content 
 * @return string          System elements table.
 */
function shortcode_systemElements( $atts , $content = null ) {
	return missiledefense_display_system_elements();
}
add_shortcode( 'systemElements', 'shortcode_systemElements' );
