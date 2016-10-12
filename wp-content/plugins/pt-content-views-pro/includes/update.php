<?php

/**
 * Check update, do update
 *
 * @package   PT_Content_Views_Pro
 * @author    PT Guy <http://www.contentviewspro.com/>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
// Compare stored version and current version
$stored_version = get_option( PT_CV_OPTION_VERSION_PRO );
if ( $stored_version && version_compare( $stored_version, PT_CV_VERSION_PRO, '<' ) ) {
	// Do update
	// Update version
	update_option( PT_CV_OPTION_VERSION_PRO, PT_CV_VERSION_PRO );
}