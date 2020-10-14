<?php
/**
 * Header file for the CSIS Missile Threat WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<?php missilethreat_get_svg_icons(); ?>

		<div class="container">

			<header id="site-header" class="header" role="banner">

				<!-- TODO: Add MT Logo -->
				<a href="<?php echo get_home_url(); ?>" class="header__logo" title="Go home">
				<?php 
					include( get_template_directory() . '/assets/static/missilethreat-logo.svg'); 
				?>
				</a>

				<?php
				if ( has_nav_menu( 'primary' ) ) {
					?>

						<nav class="site-nav" aria-label="<?php esc_attr_e( 'Site Navigation', 'missilethreat' ); ?>" role="navigation">

							<ul class="primary-menu">

							<?php
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'primary',
									)
								);
							}
							?>
							</ul>

						</nav><!-- .site-nav -->

					<?php
				} ?>

			</header><!-- #site-header -->
