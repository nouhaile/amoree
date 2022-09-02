<?php
/**
 * This file contains functions and hooks for styling Hootkit plugin
 *   Hootkit is a free plugin released under GPL license and hosted on wordpress.org.
 *   It is recommended to the user via wp-admin using TGMPA class
 *
 * This file is loaded at 'after_setup_theme' action @priority 10 ONLY IF hootkit plugin is active
 *
 * @package    Hoot Porto
 * @subpackage HootKit
 */

// Register HootKit
add_filter( 'hootkit_register', 'hoot_porto_register_hootkit', 5 );

// Set data for theme scripts localization. hootData is actually localized at priority 11, so populate data before that at priority 9
// The theme's main script is loaded @11
add_action( 'wp_enqueue_scripts', 'hoot_porto_localize_hootkit', 9 );

// Hootkit plugin loads its styles at default @10 (we skip this using config 'theme_css')
// The theme's main style is loaded @12
// The child's main style is loaded @18
add_action( 'wp_enqueue_scripts', 'hoot_porto_enqueue_hootkit', 14 );
add_action( 'wp_enqueue_scripts', 'hoot_porto_enqueue_childhootkit', 20 );

// Add dynamic CSS for hootkit
add_action( 'hoot_dynamic_cssrules', 'hoot_porto_hootkit_dynamic_cssrules', 6 );
// Set dynamic css handle to hootkit
// Set dynamic css handle to child hootkit inside `hoot_porto_dynamic_css_hootkit_handle` using `hoot_porto_dynamic_css_childhootkit_handle` 
add_filter( 'hoot_style_builder_inline_style_handle', 'hoot_porto_dynamic_css_hootkit_handle', 2 );

/**
 * Register Hootkit
 *
 * @since 1.0
 * @param array $config
 * @return string
 */
if ( !function_exists( 'hoot_porto_register_hootkit' ) ) :
function hoot_porto_register_hootkit( $config ) {
	// Array of configuration settings.
	$config = array(
		'nohoot'    => false,
		'theme_css' => true,
		'modules'   => array(
			'sliders'     => array( 'image', 'postimage' ),
			'widgets'     => array( 'announce', 'content-blocks', 'content-posts-blocks', 'cta', 'icon', 'post-grid', 'post-list', 'social-icons', 'ticker', 'content-grid', 'cover-image', 'profile', 'ticker-posts', ),
			'woocommerce' => array( 'content-products-blocks', 'product-list', 'products-ticker', 'products-search', 'products-carticon', ),
			'misc'        => array( 'top-banner', 'shortcode-timer', 'fly-cart', ),
		),
		'settings'  => array( 'cta-styles' ),
		'supports'  => array( 'cta-styles', 'content-blocks-style5', 'content-blocks-style6', 'slider-styles', 'post-grid-firstpost-slider', 'announce-headline', 'grid-widget', 'list-widget', 'widget-subtitle', 'content-blocks-iconoptions', 'social-icons-altcolor', 'slider-style3', 'slider-subtitles', ),
		'premium'   => array( 'carousel', 'postcarousel', 'postlistcarousel', 'productcarousel', 'productlistcarousel', 'contact-info', 'number-blocks', 'vcards', 'buttons', 'icon-list', 'notice', 'toggle', 'tabs', ),
	);
	if ( version_compare( hootkit()->version, '1.1.1', '<' ) ) {
		unset( $config['modules']['woocommerce'] );
		unset( $config['modules']['misc'] );
	}
	if ( version_compare( hootkit()->version, '1.2.0', '>' ) ) {
		$addsupport = array( 'product-list', 'products-ticker', 'products-search', 'products-carticon' );
		$config['modules']['woocommerce'] = array_merge( $config['modules']['woocommerce'], $addsupport );
	}
	return $config;
}
endif;

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hoot_porto_localize_hootkit' ) ) :
function hoot_porto_localize_hootkit() {
	$scriptdata = hoot_data( 'scriptdata' );
	if ( empty( $scriptdata ) )
		$scriptdata = array();
	$scriptdata['contentblockhover'] = 'enable'; // This needs to be explicitly enabled by supporting themes
	$scriptdata['contentblockhovertext'] = 'disable'; // Disabling needed for proper positioning of animation in latest themes (jquery animation is now redundant) (may be deleted later once all hootkit themes ported)
	hoot_set_data( 'scriptdata', $scriptdata );
}
endif;

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hoot_porto_enqueue_hootkit' ) ) :
function hoot_porto_enqueue_hootkit() {

	$loadminified = ( defined( 'HOOT_DEBUG' ) ) ?
					( ( HOOT_DEBUG ) ? false : true ) :
					hoot_get_mod( 'load_minified', 0 );

	/* Load Hootkit Style */
	if ( $loadminified && file_exists( hoot_data()->template_dir . 'hootkit/hootkit.min.css' ) )
		$style_uri =  hoot_data()->template_uri . 'hootkit/hootkit.min.css';
	elseif ( file_exists( hoot_data()->template_dir . 'hootkit/hootkit.css' ) )
		$style_uri =  hoot_data()->template_uri . 'hootkit/hootkit.css';
	if ( !empty( $style_uri ) )
		wp_enqueue_style( 'hoot-porto-hootkit', $style_uri, array(), hoot_data()->template_version );

}
endif;
if ( !function_exists( 'hoot_porto_enqueue_childhootkit' ) ) :
function hoot_porto_enqueue_childhootkit() {
	if ( is_child_theme() ) :

	$loadminified = ( defined( 'HOOT_DEBUG' ) ) ?
					( ( HOOT_DEBUG ) ? false : true ) :
					hoot_get_mod( 'load_minified', 0 );

	/* Load Hootkit Style */
	if ( $loadminified && file_exists( hoot_data()->child_dir . 'hootkit/hootkit.min.css' ) )
		$style_uri =  hoot_data()->child_uri . 'hootkit/hootkit.min.css';
	elseif ( file_exists( hoot_data()->child_dir . 'hootkit/hootkit.css' ) )
		$style_uri =  hoot_data()->child_uri . 'hootkit/hootkit.css';
	if ( !empty( $style_uri ) ) {
		wp_enqueue_style( 'hoot-porto-child-hootkit', $style_uri, array(), hoot_data()->childtheme_version );
		add_filter( 'hoot_style_builder_inline_style_handle', 'hoot_porto_dynamic_css_childhootkit_handle', 10 );
	}

	endif;
}
endif;

/**
 * Set dynamic css handle to hootkit
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hoot_porto_dynamic_css_hootkit_handle' ) ) :
function hoot_porto_dynamic_css_hootkit_handle( $handle ) {
	return 'hoot-porto-hootkit';
}
endif;
if ( !function_exists( 'hoot_porto_dynamic_css_childhootkit_handle' ) ) :
function hoot_porto_dynamic_css_childhootkit_handle( $handle ) {
	return 'hoot-porto-child-hootkit';
}
endif;

/**
 * Custom CSS built from user theme options for hootkit features
 * For proper sanitization, always use functions from library/sanitization.php
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'hoot_porto_hootkit_dynamic_cssrules' ) ) :
function hoot_porto_hootkit_dynamic_cssrules() {

	// Get user based style values
	$styles = hoot_porto_user_style();
	extract( $styles );

	/*** Add Dynamic CSS ***/

	hoot_add_css_rule( array(
						'selector'  => '.flycart-toggle, .flycart-panel',
						'property'  => 'background',
						'value'     => $content_bg_color,
				) );

	hoot_add_css_rule( array(
						'selector'  => '.topbanner-content mark',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Light Slider */

	hoot_add_css_rule( array(
						'selector'  => '.lSSlideOuter ul.lSPager.lSpg > li:hover a, .lSSlideOuter ul.lSPager.lSpg > li.active a',
						'property'  => 'background-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.lSSlideOuter ul.lSPager.lSpg > li a',
						'property'  => 'border-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.lightSlider .wrap-light-on-dark .hootkitslide-head, .lightSlider .wrap-dark-on-light .hootkitslide-head',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.slider-style2 .lSAction > a',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
						'media'     => 'only screen and (min-width: 970px)',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.slider-style2 .lSAction > a:hover',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
						'media'     => 'only screen and (min-width: 970px)',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button',
						'property'  => array(
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
						'media'     => 'only screen and (min-width: 970px)',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button:hover, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button:hover',
						'property'  => array(
							'color'        => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_font, 'accent_font' ),
							),
						'media'     => 'only screen and (min-width: 970px)',
					) );


	/* Sidebars and Widgets */

	hoot_add_css_rule( array(
						'selector'  => '.widget .viewall a',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );
	hoot_add_css_rule( array(
						'selector'  => '.widget .viewall a:hover',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.widget .view-all a:hover',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.sidebar .view-all-top.view-all-withtitle a, .sub-footer .view-all-top.view-all-withtitle a, .footer .view-all-top.view-all-withtitle a, .sidebar .view-all-top.view-all-withtitle a:hover, .sub-footer .view-all-top.view-all-withtitle a:hover, .footer .view-all-top.view-all-withtitle a:hover',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font',
					) );

	if ( !empty( $widgetmargin ) ) :
		hoot_add_css_rule( array(
						'selector'  => '.bottomborder-line:after' . ',' . '.bottomborder-shadow:after',
						'property'  => 'margin-top',
						'value'     => $widgetmargin,
						'idtag'     => 'widgetmargin',
					) );
		hoot_add_css_rule( array(
						'selector'  => '.topborder-line:before' . ',' . '.topborder-shadow:before',
						'property'  => 'margin-bottom',
						'value'     => $widgetmargin,
						'idtag'     => 'widgetmargin',
					) );
	endif;

	hoot_add_css_rule( array(
						'selector'  => '.hootkitslide-caption .hootkitslide-subtitle' . ',' . '.cta-subtitle',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.ticker-product-price .amount' . ',' . '.wordpress .ticker-addtocart a.button:hover' . ',' . '.wordpress .ticker-addtocart a.button:focus',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector' => '.content-block-icon i',
						'property' => 'color',
						'value'    => $accent_color,
						'idtag'    => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.content-block:hover .content-block-icon:not(.icon-custom-color)',
						'property'  => 'background',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );
	hoot_add_css_rule( array(
						'selector'  => '.content-block:hover .content-block-icon:not(.icon-custom-color) i',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font'
					) );

	hoot_add_css_rule( array(
						'selector' => '.icon-style-circle' .',' . '.icon-style-square',
						'property' => 'border-color',
						'value'    => $accent_color,
						'idtag'    => 'accent_color',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.content-block-style3 .content-block-icon',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.wordpress .button-widget.preset-accent',
						'property'  => array(
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.wordpress .button-widget.preset-accent:hover',
						'property'  => array(
							'color'      => array( $accent_color, 'accent_color' ),
							'background' => array( $accent_font, 'accent_font' ),
							),
					) );

}
endif;

/**
 * Modify Customizer Settings defaults
 *
 * @since 1.0
 * @param array $options
 * @return array
 */
function hoot_porto_hootkit_customizer_options( $options ) {
	if ( isset( $options['settings']['hktb_content_bg']['default'] ) )
		$options['settings']['hktb_content_bg']['default'] = 'dark';
	return $options;
}
add_filter( 'hootkit_customizer_options', 'hoot_porto_hootkit_customizer_options', 12 );

/**
 * Modify Content Box default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function hoot_porto_content_blocks_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['boxes']['fields']['icon_style'] ) )
		$settings['form_options']['boxes']['fields']['icon_style']['std'] = 'none';
	return $settings;
}
add_filter( 'hootkit_content_blocks_widget_settings', 'hoot_porto_content_blocks_widget_settings', 5 );

/**
 * Modify Border Style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function hoot_porto_hootkit_widget_settings_border( $settings ) {
	if ( isset( $settings['form_options']['border']['options'] ) )
		$settings['form_options']['border']['options'] = array(
			'line line'		=> __( 'Top - Line || Bottom - Line', 'hoot-porto' ),
			'line shadow'	=> __( 'Top - Line || Bottom - Shadow', 'hoot-porto' ),
			'line none'		=> __( 'Top - Line || Bottom - None', 'hoot-porto' ),
			'shadow line'	=> __( 'Top - Shadow || Bottom - Line', 'hoot-porto' ),
			'shadow shadow'	=> __( 'Top - Shadow || Bottom - Shadow', 'hoot-porto' ),
			'shadow none'	=> __( 'Top - Shadow || Bottom - None', 'hoot-porto' ),
			'none line'		=> __( 'Top - None || Bottom - Line', 'hoot-porto' ),
			'none shadow'	=> __( 'Top - None || Bottom - Shadow', 'hoot-porto' ),
			'none none'		=> __( 'Top - None || Bottom - None', 'hoot-porto' ),
		);
	return $settings;
}
add_filter( 'hootkit_buttons_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_content_blocks_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_content_posts_blocks_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_content_products_blocks_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_cta_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_number_blocks_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_profile_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );
add_filter( 'hootkit_vcards_widget_settings', 'hoot_porto_hootkit_widget_settings_border', 5 );

/**
 * Modify Ticker default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function hoot_porto_ticker_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['background'] ) )
		$settings['form_options']['background']['std'] = '#f1f1f1';
	if ( isset( $settings['form_options']['fontcolor'] ) )
		$settings['form_options']['fontcolor']['std'] = '#666666';
	return $settings;
}
function hoot_porto_ticker_products_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['background'] ) )
		$settings['form_options']['background']['std'] = '#f1f1f1';
	if ( isset( $settings['form_options']['fontcolor'] ) )
		$settings['form_options']['fontcolor']['std'] = '#333333';
	return $settings;
}
add_filter( 'hootkit_ticker_widget_settings', 'hoot_porto_ticker_widget_settings', 5 );
add_filter( 'hootkit_ticker_posts_widget_settings', 'hoot_porto_ticker_widget_settings', 5 );
add_filter( 'hootkit_products_ticker_widget_settings', 'hoot_porto_ticker_products_widget_settings', 5 );

/**
 * Filter Ticker and Ticker Posts display Title markup
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function hoot_porto_hootkit_widget_title( $display, $title, $context, $icon = '' ) {
	$display = '<div class="ticker-title accent-typo">' . $icon . $title . '</div>';
	return $display;
}
add_filter( 'hootkit_widget_ticker_title', 'hoot_porto_hootkit_widget_title', 5, 4 );

/**
 * Set button styling (for user defined colors) in cover image widget
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
add_filter( 'hootkit_coverimage_inverthoverbuttons', '__return_true' );

/**
 * Set Read More button location for Content Block
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function hoot_porto_hootkit_content_block_styles_inboxlink( $styles ) {
	$styles = array( 'style4', 'style5', 'style6' );
	return $styles;
}
add_filter( 'hootkit_content_block_styles_inboxlink', 'hoot_porto_hootkit_content_block_styles_inboxlink', 5 );