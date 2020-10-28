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
			<p><a href="https://www.csis.org"><?php include( get_template_directory() . '/assets/static/csis-logo.svg'); ?></a></p>
			</div>

			<div class="grid-container">
				<div class="description-container">
					<p class="description">
					Missile Threat brings together a wide range of information and analyses relating to the proliferation of cruise and ballistic missiles around the world and the air and missile defense systems designed to defeat them. Missile Threat is a product of the <span class="mdp">Missile Defense Project</span> at the Center for Strategic and International Studies.
					</p>
				

					<div class="footer__contact">
						<address class="footer__address">
						<div class="flex-container">
							<div class="social-icons">
								<span class="social-icon-fb"><a href="/" class="facebook_icon"><?php echo missilethreat_get_svg( 'facebook' ); ?></a></span>
								<span class="social-icon-tw"><a href="/" class="twitter_icon"><?php echo missilethreat_get_svg( 'twitter' ); ?></a></span>
							</div>

							<div class="contact-address">
								<span class="address">
								1616 Rhode Island Ave NW<br />
								Washington, DC 20036
								</span>
							</div>
						</div>
						</address>

					<!-- <p class="footer__phone">(202) 887-0200</p> -->

					<?php dynamic_sidebar( 'social-share' ); ?>
					</div>
				</div>

				<div class="news-nav">
					<div class="news_letter">
						<h4 class="news-title">Newsletter</h4>
						<div class="news-body">
						<?php dynamic_sidebar( 'newsletter' ); ?>
						</div>
						<div class="footer-button">
						<button class="btn btn--light text--semibold">SUBSCRIBE</button>
						</div>
					</div>

					<div class="nav_side">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				</div>

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
			</div>
			</footer><!-- #site-footer -->

		</div><!-- .container -->

		<?php wp_footer(); ?>

	</body>
</html>
