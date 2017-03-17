<div class="do-etfw-admin-wrapper">

	<div class="do-etfw-header">
		<div class="do-etfw-header-inside">
			<?php $plugin = do_etfw_plugin_data(); ?>
			<h2><?php printf( '%1$s %2$s', $plugin['Name'], esc_html__( 'Settings', 'do-etfw' ) ); ?></h2>
		</div>
	</div><!-- .do-etfw-header -->

	<div class="do-etfw-info">
		<div class="do-etfw-info-inside">
			<ul>
				<li>
					<a href="https://designorbital.com/premium-wordpress-themes/?utm_source=wporg-etfw&utm_medium=button&utm_campaign=premium-wp-themes" class="button button-primary" target="_blank"><?php echo esc_html__( 'Premium WordPress Themes', 'do-etfw' ); ?></a>
				</li>
				<li>
					<a href="https://designorbital.com/free-wordpress-themes/?utm_source=wporg-etfw&utm_medium=button&utm_campaign=free-wp-themes" class="button" target="_blank"><?php echo esc_html__( 'Free WordPress Themes', 'do-etfw' ); ?></a>
				</li>
				<li>
					<a href="https://www.facebook.com/designorbital" class="button" target="_blank"><?php echo esc_html__( 'Like Us On Facebook', 'do-etfw' ); ?></a>
				</li>
				<li>
					<a href="https://twitter.com/designorbital" class="button" target="_blank"><?php echo esc_html__( 'Follow On Twitter', 'do-etfw' ); ?></a>
				</li>
			</ul>
		</div>
	</div><!-- .do-etfw-info -->

	<div class="do-etfw-header">
		<div class="do-etfw-header-inside">
			<?php $plugin = do_etfw_plugin_data(); ?>
			<h2><?php echo esc_html__( 'Support Us for the Development and Maintenance of Plugin', 'etfw' ); ?></h2>
		</div>
	</div><!-- .do-etfw-header -->

	<div class="do-etfw-info">
		<div class="do-etfw-info-inside">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="Z3LBGSQDYRCWA">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
	</div><!-- .do-etfw-info -->

	<form action="options.php" method="post" class="do-etfw-form-wrapper">

		<?php settings_fields( 'do_etfw_options_group' ); ?>

		<div class="do-etfw-form-header">
			<div class="do-etfw-form-header-inside">
				<input type="submit" class="button button-primary" value="<?php echo esc_html__( 'Save Changes', 'do-etfw' ); ?>">
			</div>
		</div><!-- .do-etfw-form-header -->

		<div id="do-etfw-tabs" class="do-etfw-tabs-container">
			<ul class="tabs">
				<li class="tab" id="tab-1"><a href="#section-config"><?php echo esc_html__( 'Configuration', 'do-etfw' ); ?></a></li>
			</ul>
			<div class="panel-container">
				<div id="section-config" class="panel">
					<?php do_settings_sections( 'do_etfw_section_config_page' ); ?>
				</div>
			</div>
		</div><!-- .do-etfw-tabs-container -->

		<div class="do-etfw-form-footer">
			<div class="do-etfw-form-footer-inside">
				<input type="submit" class="button button-primary" value="<?php echo esc_html__( 'Save Changes', 'do-etfw' ); ?>">
			</div>
		</div><!-- .do-etfw-form-footer -->

	</form><!-- .do-etfw-form-wrapper -->

</div><!-- .do-etfw-admin-wrapper -->
