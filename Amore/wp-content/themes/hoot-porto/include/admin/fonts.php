<?php
/**
 * Functions for sending list of fonts available
 * 
 * Also add them to sanitization array (list of allowed options)
 *
 * @package    Hoot Porto
 * @subpackage Theme
 */

/**
 * Build URL for loading Google Fonts
 * @credit http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since 1.0
 * @updated 2.9
 * @access public
 * @return void
 */
function hoot_porto_google_fonts_enqueue_url() {
	$query_args = apply_filters( 'hoot_porto_google_fonts_enqueue_url_args', array(), true );
	if ( is_array( $query_args ) && !empty( $query_args ) && !empty( $query_args['family'] ) ):
		return add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	else:

	$fonts_url = '';
	$fonts = apply_filters( 'hoot_porto_google_fonts_preparearray', array() );
	$args = array();

	if ( empty( $fonts ) ) {
		$modsfont = array( hoot_get_mod( 'body_fontface' ), hoot_get_mod( 'logo_fontface' ), hoot_get_mod( 'headings_fontface' ), hoot_get_mod( 'subheadings_fontface' ) );

		if ( in_array( 'fontpo', $modsfont ) ) {
			$fonts[ 'Poppins' ] = array(
				'normal' => array( '400','500','700' ),
				'italic' => array( '400','500','700' ),
			);
		}
		if ( in_array( 'fontos', $modsfont ) ) {
			$fonts[ 'Open Sans' ] = array(
				'normal' => array( '300','400','500','600','700','800' ),
				'italic' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontcf', $modsfont ) ) {
			$fonts[ 'Comfortaa' ] = array(
				'normal' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontow', $modsfont ) ) {
			$fonts[ 'Oswald' ] = array(
				'normal' => array( '400' ),
			);
		}
		if ( in_array( 'fontno', $modsfont ) ) {
			$fonts[ 'Noto Serif' ] = array(
				'normal' => array( '400','700' ),
				'italic' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontsl', $modsfont ) ) {
			$fonts[ 'Slabo 27px' ] = array(
				'normal' => array( '400' ),
			);
		}
	}
	$fonts = apply_filters( 'hoot_porto_google_fonts_array', $fonts );

	// Cant use 'add_query_arg()' directly as new google font api url will have multiple key 'family' when adding multiple fonts
	// Hence use 'add_query_arg' on each argument separately and then combine them.
	foreach ( $fonts as $key => $value ) {
		if ( is_array( $value ) && ( !empty( $value['normal'] ) || !empty( $value['italic'] ) ) && ( is_array( $value['normal'] ) || is_array( $value['italic'] ) ) ) {
			$arg = array( 'family' => $key . ':ital,wght@' );
			if ( !empty( $value['normal'] ) && is_array( $value['normal'] ) ) foreach ( $value['normal'] as $wght ) $arg['family'] .= "0,{$wght};";
			if ( !empty( $value['italic'] ) && is_array( $value['italic'] ) ) foreach ( $value['italic'] as $wght ) $arg['family'] .= "1,{$wght};";
			$arg['family'] = substr( $arg['family'], 0, -1 );
			$args[] = substr( add_query_arg( $arg, '' ), 1 );
		}
	}

	if ( !empty( $args ) ) {
		$fonts_url = '//fonts.googleapis.com/css2?' . implode( '&', $args );
		$fonts_url .= ( apply_filters( 'hoot_porto_google_fonts_displayswap', false ) ) ? '&display=swap' : '';
	}

	return $fonts_url;

	endif;
}

/**
 * Modify the font (websafe) list
 * Font list should always have the form:
 * {css style} => {font name}
 * 
 * Even though this list isn't currently used in customizer options (no typography options)
 * this is still needed so that sanitization functions recognize the font.
 *
 * @since 1.0
 * @access public
 * @return array
 */
function hoot_porto_fonts_list( $fonts ) {
	$fonts['"Poppins", sans-serif']   = 'Poppins';
	$fonts['"Open Sans", sans-serif'] = 'Open Sans';
	$fonts['"Comfortaa", sans-serif'] = 'Comfortaa';
	$fonts['"Oswald", sans-serif']    = 'Oswald';
	$fonts['"Noto Serif", serif']     = 'Noto Serif';
	$fonts['"Slabo 27px", serif']     = 'Slabo 27px';
	return $fonts;
}
add_filter( 'hoot_fonts_list', 'hoot_porto_fonts_list' );