<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

?>
	<style>
	@import 'assets/_scss/layout/_footer';
	</style>
	<footer id="site-footer" class="footer" role="contentinfo">
		<div class="footer__logo">	
			<a href="https://www.csis.org"><?php include( get_template_directory() . '/assets/static/csis-mt-logo-white-long.svg'); ?></a>
		</div>

		<div class="footer__container--large">
			<div class="footer__description">
				<p>
					Missile Threat brings together a wide range of information and analyses relating to the proliferation of cruise and ballistic missiles around the world and the air and missile defense systems designed to defeat them. Missile Threat is a product of the <span class="footer__mdp"><a href="https://www.csis.org/programs/international-security-program/missile-defense-project">Missile Defense Project</a></span> at the Center for Strategic and International Studies.
					</p>
				

				<div class="footer__contact">
					<div class="footer__social-icons">
						<a href="https://www.facebook.com/missiledefenseproject/?fref=nf#" class="footer__facebook-icon"><?php echo missilethreat_get_svg( 'facebook' ); ?></a>
						<a href="https://twitter.com/Missile_Defense" class="footer__twitter-icon"><?php echo missilethreat_get_svg( 'twitter' ); ?></a>
					</div>

					<div class="footer__address">
						1616 Rhode Island Ave NW<br />
						Washington, DC 20036
					</div>
				</div>
			</div>

			<div class="footer__news-nav">
				<div class="footer__news-letter">
					<?php dynamic_sidebar( 'newsletter' ); ?>
				</div>

				<div class="footer__nav-side">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			</div>

		</div>
		<p class="footer__copyright">&copy;
			<?php
			echo date_i18n(
				/* translators: Copyright date format, see https://secure.php.net/date */
				_x( 'Y', 'copyright date format', 'missilethreat' )
			);
			?>
			Center for Strategic and International Studies. All rights reserved. | <a class="footer__pp" href="https://www.csis.org/privacy-policy">Privacy Policy</a>
		</p><!-- .footer-copyright -->
	</footer><!-- #site-footer -->
<!-- .container -->
		<?php wp_footer(); ?>
	</body>
</html>
