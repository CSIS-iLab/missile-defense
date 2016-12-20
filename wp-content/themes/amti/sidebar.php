<?php
/**
 * The widget area at the bottom of the home page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Transparency
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="col-xs-12 col-sm-4 widget-container">
	<div class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<section id="text-3" class="widget widget_text">
			<h2 class="widget-title">Newsletter</h2>
			<div class="textwidget"><iframe frameborder="0" style="width: 100%;min-height:650px;overflow:hidden;" src="/newsletter.html" scrolling="no"></iframe></div>
		</section>
	</div>
</div>
