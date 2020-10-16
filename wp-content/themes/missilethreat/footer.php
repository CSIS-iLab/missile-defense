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
		<div class="footer-container">
			<footer id="site-footer" class="footer" role="contentinfo">
				<a href="https://www.csis.org" class="footer__logo"><?php include( get_template_directory() . '/assets/static/csis-logo.svg'); ?></a>

				<div class="description-container">
					<p class="description">
					Missile Threat brings together a wide range of information and analyses relating to the proliferation of cruise and ballistic missiles around the world and the air and missile defense systems designed to defeat them. Missile Threat is a product of the <span class="mdp">Missile Defense Project</span> at the Center for Strategic and International Studies.
					</p>
				</div>

				<div class="footer__contact">
					<address class="footer__address">
					<div class="social-icons">
					<a href="/" class="facebook-icon"><?php echo missilethreat_get_svg( 'facebook' ); ?></a>
					<a href="/" class="twitter-icon"><?php echo missilethreat_get_svg( 'twitter' ); ?></a>
					</div>
						1616 Rhode Island Ave NW<br />
						Washington, DC 20036
					</address>

					<p class="footer__phone">(202) 887-0200</p>

					<?php dynamic_sidebar( 'social-share' ); ?>
				</div>

				<div class="news_letter">
					<h4 class="news-title">Newsletter</h4>
					<p class="news-body">"PLACEHOLDER" The CSIS Missile Defense Project’s monthly newsletter has info on the project’s latest publications, events, and missile defense news.</p>
					<button class="btn btn--light text--semibold">SUBSCRIBE</button>
				</div>

				<div class="nav_side">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>

				<p class="footer__copyright">Copyright &copy;
					<?php
					echo date_i18n(
						/* translators: Copyright date format, see https://secure.php.net/date */
						_x( 'Y', 'copyright date format', 'missilethreat' )
					);
					?>
					Center for Strategic and International Studies.<br />All rights reserved. | <a class="pp" href="https://www.csis.org/privacy-policy">Privacy Policy</a>
				</p><!-- .footer-copyright -->

			</footer><!-- #site-footer -->

		</div><!-- .container -->

		<?php wp_footer(); ?>

	</body>
</html>
