/**
 * Custom JS for Custom Post Types.
 */

( function( $ ) {
	$('.country-make-primary.wpseo-make-primary-term').on('click', function() {
		var country = $(this).data('country');
		$('.country-make-primary.wpseo-is-primary-term').removeClass('wpseo-is-primary-term').addClass('wpseo-make-primary-term').text('Make Primary');
		$(this).removeClass('wpseo-make-primary-term').addClass('wpseo-is-primary-term').text('Primary');
		$('input[name="missile_countries_primary"]').val(country);
	})
} )( jQuery );