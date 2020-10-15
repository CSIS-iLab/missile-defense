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

				<a href="<?php echo get_home_url(); ?>" class="header__logo" title="Go home">
				<?php 
					include( get_template_directory() . '/assets/static/missilethreat-logo.svg'); 
				?>
				</a>

				<?php
				if ( has_nav_menu( 'primary' ) ) {
					?>
						<button class="hamburger"><i class="fas fa-bars"></i></button>
						<button class='nav-close'><?php echo missilethreat_get_svg( 'close' ); ?></button>
						<nav class="site-nav" aria-label="<?php esc_attr_e( 'Site Navigation', 'missilethreat' ); ?>" role="navigation">
							<ul class="primary-menu text--semibold">

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

				<button for="navSearchInput" class="header__search-icon"><?php echo missilethreat_get_svg('search') ?></button>
				<div class="header__search">
					<form method="get" id="searchform" action="/">
						<!-- <div class="input-group"> -->
							<label class="screen-reader-text" for="navSearchInput">Search for:</label>
							<input type="text" class="form-control header__search-field" name="s" id="navSearchInput" placeholder="Search" />
							<label for="navSearchInput" id="navSearchLabel" class="header__search-label">Search</label>
							<button class='header__search-submit'><?php echo missilethreat_get_svg( 'arrow-right' ); ?></button>
						<!-- </div> -->
					</form>
					<button class='header__search-close'><?php echo missilethreat_get_svg( 'close' ); ?></button>
				</div>
			</header><!-- #site-header -->
