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
			<div class="footer__logo">	
			<a href="https://www.csis.org"><?php include( get_template_directory() . '/assets/static/csis-logo.svg'); ?></a>
			</div>

			<div class="footer_large_container">
				<div class="footer_description">
					<p>
					Missile Threat brings together a wide range of information and analyses relating to the proliferation of cruise and ballistic missiles around the world and the air and missile defense systems designed to defeat them. Missile Threat is a product of the <span class="footer_mdp">Missile Defense Project</span> at the Center for Strategic and International Studies.
					</p>
				

					<div class="footer__contact">
						<div class="footer_social_icons">
							<a href="/" class="facebook_icon"><?php echo missilethreat_get_svg( 'facebook' ); ?></a>
							<a href="/" class="twitter_icon"><?php echo missilethreat_get_svg( 'twitter' ); ?></a>
						</div>

						<div class="footer_address">
							1616 Rhode Island Ave NW<br />
							Washington, DC 20036
						</div>

					<!-- <p class="footer__phone">(202) 887-0200</p> -->

					<?php dynamic_sidebar( 'social-share' ); ?>
				</div>
			</div>

				<div class="placeholder_news_nav">
					<div class="footer_news_letter">
						<?php dynamic_sidebar( 'newsletter' ); ?>
					</div>

					<div class="footer_nav_side">
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
					Center for Strategic and International Studies. All rights reserved. | <a class="footer_pp" href="https://www.csis.org/privacy-policy">Privacy Policy</a>
				</p><!-- .footer-copyright -->
			</div>
			</footer><!-- #site-footer -->

		</div><!-- .container -->

		<?php wp_footer(); ?>

	</body>
</html>
