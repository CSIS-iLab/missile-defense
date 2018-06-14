<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Missile_Defense
 */

?>
	<a href="#" class="topbutton"><span class="hidden-xs">Back to Top </span><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
	<div class="row">
		<div class="col-sm-6">
		<?php if ( is_active_sidebar( 'footer' ) ) : ?>
			<div class="container">
				<div id="footer-widgets" class="widget-area row" role="complementary">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div><!-- #footer-widgets -->
			</div>
		<?php endif; ?>
		</div>
		<div class="col-sm-6 text-right icons">
		<a href="https://www.facebook.com/missiledefenseproject/?fref=nf#" alt="#"> <img class="smIcon" src="/wp-content/themes/missile-defense/img/facebook-icon.svg" alt="Facebook Icon" height="30px" width="30px"> </a>
		<a href="https://twitter.com/missile_defense?lang=en" alt="Missile Threat Twitter"><img class="smIcon" src="/wp-content/themes/missile-defense/img/twitter-icon.svg" alt="Facebook Icon" height="30px" width="30px"></a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<p>1616 Rhode Island Avenue, NW 
			<br>Washington, DC 20036
			</p>
		</div>
		<div class="col-sm-6 text-right">
<<<<<<< HEAD
<p>&copy; <?php echo date("Y"); ?> by the Center for Strategic and International Studies. <br>All rights reserved. | <a href="https://www.csis.org/privacy-policy" target="_blank" rel="nofollow">Privacy Policy</a></p>
=======
			<p>&copy; <?php echo date("Y"); ?> by the Center for Strategic and International Studies. <br>All rights reserved. | <a href="https://www.csis.org/privacy-policy" target="_blank">Privacy Policy</a></p>
>>>>>>> redesign
		</div>
	</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
