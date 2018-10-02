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
		<div class="col-xs-12 col-sm-8 site-desc">
			<a href="https://csis.org" target="_blank" class="csis-logo"><img src="/wp-content/themes/missile-defense/img/csis-mt-logo-white-2.svg" alt="Center for Strategic and International Studies" title="Center for Strategic and International Studies" /></a>
			<p><em>Missile Threat</em> brings together a wide range of information and analyses relating to the proliferation of cruise and ballistic missiles around the world and the air and missile defense systems designed to defeat them. <em>Missile Threat</em> is a product of the <a href="https://www.csis.org/programs/international-security-program/missile-defense-project" target="_blank">Missile Defense Project</a> at the Center for Strategic and International Studies.</p>
			<div class="contact">
				<a href="https://www.facebook.com/missiledefenseproject/?fref=nf#" alt="#"> <img class="smIcon" src="/wp-content/themes/missile-defense/img/facebook-icon.svg" alt="Facebook Icon" height="30px" width="30px"> </a>
				<a href="https://twitter.com/missile_defense?lang=en" alt="Missile Threat Twitter"><img class="smIcon" src="/wp-content/themes/missile-defense/img/twitter-icon.svg" alt="Facebook Icon" height="30px" width="30px"></a>
				<address>1616 Rhode Island Avenue, NW 
			<br>Washington, DC 20036
			</address>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 newsletter">
			<h5>NEWSLETTER</h5>
			<p>Sign up for the CSIS Missile Defense Project’s monthly newsletter for info on the project’s latest publications, upcoming events, and analysis on recent missile defense news.</p>
			<a href="/newsletter" class="link-btn">Sign up</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 copyright">
			<p>&copy; <?php echo date("Y"); ?> by the Center for Strategic and International Studies. All rights reserved. | <a href="https://www.csis.org/privacy-policy" target="_blank" rel="nofollow">Privacy Policy</a></p>
		</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
