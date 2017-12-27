<?php
/**
 * Main RTL stylesheet generator
 *
 * This file is used only when the theme supports `stylesheet-generator`.
 *
 * @uses  `wmhook_reykjavik_esc_css` global hook
 * @uses  `wmhook_reykjavik_generate_css_replacements` global hook
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





/**
 * Helper variables
 */

	$output = '';
	$scope  = 'rtl';

	$reykjavik_theme_css_files = array(
		10 => 'assets/css/main-rtl.css',
	);



	/**
	 * Allow filtering
	 */
	$reykjavik_theme_css_files = apply_filters( 'wmhook_reykjavik_css_files', $reykjavik_theme_css_files, $scope );

	ksort( $reykjavik_theme_css_files );





/**
 * Preparing output
 */

	// Buffer

		ob_start();

		// Start including files and editing output

			foreach ( $reykjavik_theme_css_files as $css_file_name ) {
				if ( file_exists( REYKJAVIK_PATH . $css_file_name ) ) {
					require REYKJAVIK_PATH . $css_file_name;
				}
			}

		$output = ob_get_clean();





/**
 * Customized styles
 */

	$output .= "\r\n\r\n\r\n/**\r\n * Customize styles\r\n */\r\n\r\n";
	$output .= Reykjavik_Customize_Styles::get_css();





/**
 * Replace variables
 */

	$replacements = (array) apply_filters( 'wmhook_reykjavik_generate_css_replacements', array() );

	if ( ! empty( $replacements ) ) {
		$output = strtr( $output, $replacements );
	}





/**
 * Output
 */

	echo apply_filters( 'wmhook_reykjavik_esc_css', $output );
