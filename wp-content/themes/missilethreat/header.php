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

		if( is_singular( array( 'post', 'defsys', 'missile' ) ) ) {
			$solidBg = 'header--solid-bg';
		}
		?>

		<?php missilethreat_get_svg_icons(); ?>

		<div class="container">

			<header id="site-header" class="header <?php echo $solidBg; ?>" role="banner">

				<a href="<?php echo get_home_url(); ?>" class="header__logo" title="Go home">
				<?php 

					include( get_template_directory() . '/assets/static/missilethreat-logo.svg'); 
				?>
				</a>

				<?php
				if ( has_nav_menu( 'primary' ) ) {
					?>
						<nav class="site-nav" aria-label="<?php esc_attr_e( 'Site Navigation', 'missilethreat' ); ?>" role="navigation">
							<button class="hamburger" aria-label="Open the navigation menu"><i class="fas fa-bars"></i></button>
							<button class='nav-close' aria-label="Close the navigation menu"><?php echo missilethreat_get_svg( 'close' ); ?></button>
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

			<div class="header__search-group">
				<button for="navSearchInput" class="header__search-icon" aria-expanded="false" aria-label="Open search form"><?php echo missilethreat_get_svg('search') ?></button>
					<form method="get" id="searchform" class='header__search' role='search' action="/">
						<label class="screen-reader-text" for="navSearchInput">Search for:</label>
						<input type="text" class="form-control header__search-field" name="s" id="navSearchInput" placeholder="Search" />
						<label for="navSearchInput" id="navSearchLabel" class="header__search-label">Search</label>
						<button class='header__search-submit' type='submit' aria-label="Submit search"><?php echo missilethreat_get_svg( 'arrow-right' ); ?></button>
						<button class='header__search-close' type='reset' aria-label='Close Search Form'><?php echo missilethreat_get_svg( 'close' ); ?></button>
					</form>
				</div>
			</header><!-- #site-header -->
