<?php
/**
 * Add dynamic css to frontend.
 *
 * This file is loaded at 'after_setup_theme' hook with 10 priority.
 *
 * @package    Hoot Porto
 * @subpackage Theme
 */

/* Add CSS built from options to the dynamic CSS array */
add_action( 'hoot_dynamic_cssrules', 'hoot_porto_dynamic_cssrules', 2 );

/**
 * Create user based style values
 *
 * @since 1.0
 * @access public
 * @param string $key return a specific key value, else the entire styles array
 * @return array|string
 */
if ( !function_exists( 'hoot_porto_user_style' ) ) :
function hoot_porto_user_style( $key = false ){
	static $styles;
	// Caution with using static variable for cache: Calling this function at 'after_setup_theme' hook with 10 priority
	// (after this file is loaded obviously) will prevent further applying of filter hook (by child-theme/plugin/premium)
	// which may also be declared at 'after_setup_theme' hook with 10+ priority. It is safe to call this function thereafter.
	if ( empty( $styles ) ) {
		$styles = array();
		$styles['accent_color']         = hoot_get_mod( 'accent_color' );
		$styles['accent_color_dark']    = hoot_color_darken( $styles['accent_color'], 25, 25 );
		$styles['accent_font']          = hoot_get_mod( 'accent_font' );
		$styles['logo_fontface']        = hoot_get_mod( 'logo_fontface' );
		$styles['logo_fontface_style']  = hoot_get_mod( 'logo_fontface_style' );
		$styles['headings_fontface']    = hoot_get_mod( 'headings_fontface' );
		$styles['headings_fontface_style'] = hoot_get_mod( 'headings_fontface_style' );
		$styles['subheadings_fontface']       = hoot_get_mod( 'subheadings_fontface' );
		$styles['subheadings_fontface_style'] = hoot_get_mod( 'subheadings_fontface_style' );
		$styles['body_fontface']              = hoot_get_mod( 'body_fontface' );
		$styles['box_background_color'] = hoot_get_mod( 'box_background_color' );
		$styles['content_bg_color']     = $styles['box_background_color'];
		$styles['site_title_icon_size'] = hoot_get_mod( 'site_title_icon_size' );
		$styles['logo_image_width']     = hoot_get_mod( 'logo_image_width' );
		$styles['logo_image_width']     = ( intval( $styles['logo_image_width'] ) ) ?
		                                    intval( $styles['logo_image_width'] ) . 'px' :
		                                    '150px';
		$styles['logo']                 = hoot_get_mod( 'logo' );
		$styles['logo_custom']          = apply_filters( 'hoot_porto_logo_custom_text', hoot_sortlist( hoot_get_mod( 'logo_custom' ) ) );
		$styles['widgetmargin']         = hoot_get_mod( 'widgetmargin' );
		$styles['widgetmargin']         = ( intval( $styles['widgetmargin'] ) ) ?
		                                    intval( $styles['widgetmargin'] ) . 'px' :
		                                    false;
		$styles['smallwidgetmargin']    = ( intval( $styles['widgetmargin'] ) ) ?
		                                    ( intval( $styles['widgetmargin'] ) - 15 ) . 'px' :
		                                    false;
		$styles['halfwidgetmargin']     = ( intval( $styles['widgetmargin'] ) ) ?
		                                    ( ( intval( $styles['widgetmargin'] ) / 2 > 25 ) ? ( intval( $styles['widgetmargin'] ) / 2 ) . 'px' : '25px' ) :
		                                    false;
		$styles = apply_filters( 'hoot_porto_user_style', $styles );
	}
	if ( $key )
		return ( isset( $styles[ $key ] ) ) ? $styles[ $key ] : false;
	else
		return $styles;
}
endif;

/**
 * Custom CSS built from user theme options
 * For proper sanitization, always use functions from library/sanitization.php
 *
 * @since 1.0
 * @access public
 */
function hoot_porto_dynamic_cssrules() {

	// Get user based style values
	$styles = hoot_porto_user_style();
	extract( $styles );

	/*** Add Dynamic CSS ***/

	/* Base Typography and HTML */

	hoot_add_css_rule( array(
						'selector'  => 'a',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector'  => 'a:hover',
						'property'  => 'color',
						'value'     => $accent_color_dark,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.accent-typo',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.invert-accent-typo',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.invert-typo',
						'property'  => 'color',
						'value'     => $content_bg_color,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.enforce-typo',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	hoot_add_css_rule( array(
						'selector'  => 'body.wordpress input[type="submit"], body.wordpress #submit, body.wordpress .button',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => 'body.wordpress input[type="submit"]:hover, body.wordpress #submit:hover, body.wordpress .button:hover, body.wordpress input[type="submit"]:focus, body.wordpress #submit:focus, body.wordpress .button:focus',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'color'      => array( $accent_color, 'accent_color' ),
							'background' => array( $accent_font, 'accent_font' ),
							),
					) );

	$headingproperty = array();
	if ( 'fontpo' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Poppins", sans-serif' );
	elseif ( 'fontos' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontno' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $headings_fontface )
		$headingproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $headings_fontface_style || 'uppercasei' == $headings_fontface_style )
		$headingproperty['text-transform'] = array( 'uppercase' );
	else
		$headingproperty['text-transform'] = array( 'none' );
	if ( 'standardi' == $headings_fontface_style || 'uppercasei' == $headings_fontface_style )
		$headingproperty['font-style'] = array( 'italic' );
	else
		$headingproperty['font-style'] = array( 'normal' );

	if ( !empty( $headingproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => 'h1, h2, h3, h4, h5, h6, .title, .titlefont',
						'property'  => $headingproperty,
					) );
		hoot_add_css_rule( array(
						'selector'  => '.sidebar .widget-title, .sub-footer .widget-title, .footer .widget-title',
						'property'  => $headingproperty,
					) );
	}

	$subheadingproperty = array();
	if ( 'fontpo' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Poppins", sans-serif' );
	elseif ( 'fontos' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontno' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $subheadings_fontface_style || 'uppercasei' == $subheadings_fontface_style )
		$subheadingproperty['text-transform'] = array( 'uppercase' );
	else
		$subheadingproperty['text-transform'] = array( 'none' );
	if ( 'standardi' == $subheadings_fontface_style || 'uppercasei' == $subheadings_fontface_style )
		$subheadingproperty['font-style'] = array( 'italic' );
	else
		$subheadingproperty['font-style'] = array( 'normal' );
	if ( !empty( $subheadingproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => '.hoot-subtitle, .entry-byline, .hk-gridunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline',
						'property'  => $subheadingproperty,
					) );
	}

	$bodyfontface = '';
	if ( 'fontpo' == $body_fontface )
		$bodyfontface = '"Poppins", sans-serif';
	elseif ( 'fontos' == $body_fontface )
		$bodyfontface = '"Open Sans", sans-serif';
	elseif ( 'fontcf' == $body_fontface )
		$bodyfontface = '"Comfortaa", sans-serif';
	elseif ( 'fontow' == $body_fontface )
		$bodyfontface = '"Oswald", sans-serif';
	elseif ( 'fontno' == $body_fontface )
		$bodyfontface = '"Noto Serif", serif';
	elseif ( 'fontsl' == $body_fontface )
		$bodyfontface = '"Slabo 27px", serif';
	elseif ( 'fontgr' == $body_fontface )
		$bodyfontface = 'Georgia, serif';
	hoot_add_css_rule( array(
						'selector'  => 'body' . ',' . '.enforce-body-font' . ',' . '.site-title-body-font',
						'property'  => 'font-family',
						'value'     => $bodyfontface,
					) );

	/* Layout */
	hoot_add_css_rule( array(
						'selector'  => '#main.main' . ',' . '.below-header',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Topbar

	hoot_add_css_rule( array(
						'selector'  => '#topbar',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( 'none' ),
							'color'      => array( 'inherit' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '#topbar.js-search .searchform.expand .searchtext',
						'property'  => 'background',
						'value'     => '#f7f7f7',
					) );
	hoot_add_css_rule( array(
						'selector'  => '#topbar.js-search .searchform.expand .searchtext' . ',' . '#topbar .js-search-placeholder',
						'property'  => 'color',
						'value'     => 'inherit',
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Header Layout - Search

	hoot_add_css_rule( array(
						'selector'  => '.header-aside-search.js-search .searchform i.fa-search',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Logo

	hoot_add_css_rule( array(
						'selector'  => '#site-logo.logo-border',
						'property'  => 'border-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Text Logo

	$logoproperty = array();
	if ( 'fontpo' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Poppins", sans-serif' );
	elseif ( 'fontos' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontno' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $logo_fontface )
		$logoproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $logo_fontface_style )
		$logoproperty['text-transform'] = array( 'uppercase' );
	else
		$logoproperty['text-transform'] = array( 'none' );
	if ( !empty( $logoproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => '#site-title',
						'property'  => $logoproperty,
					) );
	}

	$sitetitleheadingfont = '';
	if ( 'fontpo' == $headings_fontface )
		$sitetitleheadingfont = '"Poppins", sans-serif';
	elseif ( 'fontos' == $headings_fontface )
		$sitetitleheadingfont = '"Open Sans", sans-serif';
	elseif ( 'fontcf' == $headings_fontface )
		$sitetitleheadingfont = '"Comfortaa", sans-serif';
	elseif ( 'fontow' == $headings_fontface )
		$sitetitleheadingfont = '"Oswald", sans-serif';
	elseif ( 'fontno' == $headings_fontface )
		$sitetitleheadingfont = '"Noto Serif", serif';
	elseif ( 'fontsl' == $headings_fontface )
		$sitetitleheadingfont = '"Slabo 27px", serif';
	elseif ( 'fontgr' == $headings_fontface )
		$sitetitleheadingfont = 'Georgia, serif';
	hoot_add_css_rule( array(
						'selector'  => '.site-title-heading-font',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );
	hoot_add_css_rule( array(
						'selector'  => '.entry-grid .more-link',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Logo (with icon)

	if ( intval( $site_title_icon_size ) ) {
		hoot_add_css_rule( array(
						'selector'  => '.site-logo-with-icon #site-title i',
						'property'  => 'font-size',
						'value'     => $site_title_icon_size,
						'idtag'     => 'site_title_icon_size',
					) );
	}

	/* Header (Topbar, Header, Main Nav Menu) */
	// Mixed/Mixedcustom Logo (with image)

	if ( !empty( $logo_image_width ) ) :
	hoot_add_css_rule( array(
						'selector'  => '.site-logo-mixed-image img',
						'property'  => 'max-width',
						'value'     => $logo_image_width,
						'idtag'     => 'logo_image_width',
					) );
	endif;

	/* Header (Topbar, Header, Main Nav Menu) */
	// Custom Logo

	if ( 'custom' == $logo || 'mixedcustom' == $logo ) {
		if ( is_array( $logo_custom ) && !empty( $logo_custom ) ) {
			$lcount = 1;
			foreach ( $logo_custom as $logo_custom_line ) {
				if ( !$logo_custom_line['sortitem_hide'] && !empty( $logo_custom_line['size'] ) ) {
					hoot_add_css_rule( array(
						'selector'  => '#site-logo-custom .site-title-line' . $lcount . ',#site-logo-mixedcustom .site-title-line' . $lcount,
						'property'  => 'font-size',
						'value'     => $logo_custom_line['size'],
					) );
				}
				if ( !function_exists('hoot_lib_premium_core') && !$logo_custom_line['sortitem_hide'] && !empty( $logo_custom_line['font'] ) ) {
					$logo_custom_line_tt = 'none';
					$logo_custom_line_tt = ( $logo_custom_line['font'] == 'heading' && 'uppercase' == $logo_fontface_style ) ? 'uppercase' : $logo_custom_line_tt;
					$logo_custom_line_tt = ( $logo_custom_line['font'] == 'heading2' && ( 'uppercase' == $headings_fontface_style || 'uppercasei' == $headings_fontface_style ) ) ? 'uppercase' : $logo_custom_line_tt;
					hoot_add_css_rule( array(
						'selector'  => '#site-logo-custom .site-title-line' . $lcount . ',#site-logo-mixedcustom .site-title-line' . $lcount,
						'property'  => 'text-transform',
						'value'     => $logo_custom_line_tt,
					) );
					if ( $logo_custom_line['font'] == 'heading2' && ( 'standardi' == $headings_fontface_style || 'uppercasei' == $headings_fontface_style ) ) {
					hoot_add_css_rule( array(
						'selector'  => '#site-logo-custom .site-title-line' . $lcount . ',#site-logo-mixedcustom .site-title-line' . $lcount,
						'property'  => 'font-style',
						'value'     => 'italic',
					) );
					}
				}
				$lcount++;
			}
		}
	}

	hoot_add_css_rule( array(
						'selector'  => '.site-title-line em',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.site-title-line mark',
						'property'  => array(
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	$sitetitleheadingfont = '';
	if ( 'fontos' == $headings_fontface )
		$sitetitleheadingfont = '"Open Sans", sans-serif';
	elseif ( 'fontcf' == $headings_fontface )
		$sitetitleheadingfont = '"Comfortaa", sans-serif';
	elseif ( 'fontow' == $headings_fontface )
		$sitetitleheadingfont = '"Oswald", sans-serif';
	elseif ( 'fontlo' == $headings_fontface )
		$sitetitleheadingfont = '"Lora", serif';
	elseif ( 'fontsl' == $headings_fontface )
		$sitetitleheadingfont = '"Slabo 27px", serif';
	elseif ( 'fontgr' == $headings_fontface )
		$sitetitleheadingfont = 'Georgia, serif';
	hoot_add_css_rule( array(
						'selector'  => '.site-title-heading-font',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );
	hoot_add_css_rule( array(
						'selector'  => '.entry-grid .more-link',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Nav Menu

	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.mobilemenu-fixed .menu-toggle, .mobilemenu-fixed .menu-items',
						'property'  => 'background',
						'value'     => $content_bg_color,
						'media'     => 'only screen and (max-width: 969px)',
				) );
	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul li.current-menu-item:not(.nohighlight), .menu-items ul li.current-menu-ancestor, .menu-items ul li:hover',
						'property'  => 'background',
						'value'     => $accent_font,
						'idtag'     => 'accent_font'
					) );
	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul li.current-menu-item:not(.nohighlight) > a, .menu-items ul li.current-menu-ancestor > a, .menu-items ul li:hover > a',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );

	hoot_add_css_rule( array(
						'selector'  => '.menu-tag',
						'property'  => 'border-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );
	if ( apply_filters( 'hoot_porto_menutag_inverthover', true ) ) :
	hoot_add_css_rule( array(
						'selector'  => '#header .menu-items li.current-menu-item:not(.nohighlight) > a .menu-tag, #header .menu-items li.current-menu-ancestor > a .menu-tag, #header .menu-items li:hover > a .menu-tag',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							'border-color' => array( $accent_font, 'accent_font' ),
							),
					) );
	endif;

	/* Main #Content */

	/* Main #Content for Index (Archive / Blog List) */

	hoot_add_css_rule( array(
						'selector'  => '.more-link, .more-link a',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.more-link:hover, .more-link:hover a',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'color'      => array( $accent_color_dark, 'accent_color_dark' ),
							),
					) );

	/* Frontpage */

	if ( !is_customize_preview() ) {
	$sections = hoot_sortlist( hoot_get_mod( 'frontpage_sections' ) );
	if ( is_array( $sections ) && !empty( $sections ) ) { foreach ( $sections as $key => $section ) {
		$id = ( $key == 'content' ) ? 'frontpage-page-content' : sanitize_html_class( 'frontpage-' . $key );
		$type = hoot_get_mod( "frontpage_sectionbg_{$key}-font" );
		switch ($type) {
			case 'color': $selector = '.'.$id.' *, .'.$id.' .more-link, .'.$id.' .more-link a'; break;
			case 'force': $selector = '#'.$id.' *, #'.$id.' .more-link, #'.$id.' .more-link a'; break;
			default: $selector = ''; break;
		}
		if ( $selector ) {
			hoot_add_css_rule( array(
						'selector'  => $selector,
						'property'  => 'color',
						'value'     => hoot_get_mod( "frontpage_sectionbg_{$key}-fontcolor" ),
					) );
		}
	} }
	}

	/* Sidebars and Widgets */

	if ( apply_filters( 'hoot_porto_sidebarwidgettitle_accenttypo', true ) ) :
	hoot_add_css_rule( array(
						'selector'  => '.sidebar .widget-title' . ',' . '.sub-footer .widget-title, .footer .widget-title',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							'border'     => array( 'solid 1px' ),
							'border-color' => array( $accent_color, 'accent_color' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.sidebar .widget:hover .widget-title' . ',' . '.sub-footer .widget:hover .widget-title, .footer .widget:hover .widget-title',
						'property'  => array(
							'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
					) );
	endif;

	if ( !empty( $widgetmargin ) ) :
		hoot_add_css_rule( array(
						'selector'  => '.main-content-grid' . ',' . '.widget' . ',' . '.frontpage-area',
						'property'  => 'margin-top',
						'value'     => $widgetmargin,
						'idtag'     => 'widgetmargin',
					) );
		hoot_add_css_rule( array(
						'selector'  => '.widget' . ',' . '.frontpage-area',
						'property'  => 'margin-bottom',
						'value'     => $widgetmargin,
						'idtag'     => 'widgetmargin',
					) );
		hoot_add_css_rule( array(
						'selector'  => '.frontpage-area.module-bg-highlight, .frontpage-area.module-bg-color, .frontpage-area.module-bg-image',
						'property'  => 'padding',
						'value'     => $widgetmargin . ' 0',
					) );
		hoot_add_css_rule( array(
						'selector'  => '.altthemedividers #loop-meta:not(.loop-meta-withbg) .loop-meta',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'padding-top'    => array( $widgetmargin, 'widgetmargin' ),
							'padding-bottom' => array( $widgetmargin, 'widgetmargin' ),
							),
					) );
		hoot_add_css_rule( array(
						'selector'  => '.sidebar',
						'property'  => 'margin-top',
						'value'     => $widgetmargin,
						'media'     => 'only screen and (max-width: 969px)',
					) );
		hoot_add_css_rule( array(
						'selector'  => '.frontpage-widgetarea > div.hgrid > [class*="hgrid-span-"]',
						'property'  => 'margin-bottom',
						'value'     => $widgetmargin,
						'media'     => 'only screen and (max-width: 969px)',
					) );
	endif;
	if ( !empty( $smallwidgetmargin ) ) :
		hoot_add_css_rule( array(
						'selector'  => '.footer .widget',
						'property'  => 'margin',
						'value'     => $smallwidgetmargin . ' 0',
					) );
	endif;
	if ( !empty( $halfwidgetmargin ) )
		hoot_add_css_rule( array(
						'selector'  => '.main > .main-content-grid:first-child' . ',' . '.content-frontpage > .frontpage-area-boxed:first-child',
						'property'  => 'margin-top',
						'value'     => $halfwidgetmargin,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.js-search .searchform.expand .searchtext',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	/* Plugins */

	hoot_add_css_rule( array(
						'selector'  => '#infinite-handle span' . ',' .
										'.lrm-form a.button, .lrm-form button, .lrm-form button[type=submit], .lrm-form #buddypress input[type=submit], .lrm-form input[type=submit]',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover',
						'property'  => 'color',
						'value'     => $accent_color_dark,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover' . ',' . '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
						'property'  => 'background',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );

	hoot_add_css_rule( array(
						'selector'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover a:hover' . ',' . '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font'
					) );

	hoot_add_css_rule( array(
						'selector'  => '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background'   => array( $accent_font, 'accent_font' ),
							'color'        => array( $accent_color, 'accent_color' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.widget_breadcrumb_navxt .breadcrumbs > .hoot-bcn-pretext:after',
						'property'  => 'border-left-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

}