<?php
/**
 * Defines customizer options
 *
 * This file is loaded at 'after_setup_theme' hook with 10 priority.
 *
 * @package    Hoot Porto
 * @subpackage Theme
 */

/**
 * Theme default colors and fonts
 *
 * @since 1.0
 * @access public
 * @param string $key return a specific key value, else the entire defaults array
 * @return array|string
 */
if ( !function_exists( 'hoot_porto_default_style' ) ) :
function hoot_porto_default_style( $key = false ){

	// Do not use static cache variable as any reference to 'hoot_porto_default_style()'
	// (example: get default value during declaring add_theme_support for WP custom background which
	// is also loaded at 'after_setup_theme' hook with 10 priority) will prevent further applying
	// of filter hook (by child-theme/plugin/premium). Ideally, this function should be called only
	// after 'after_setup_theme' hook with 11 priority
	$defaults = apply_filters( 'hoot_porto_default_style', array(
		'accent_color'         => '#0d99e9',
		'accent_font'          => '#ffffff',
		'module_bg_default'    => '#ffffff',
		'module_fontcolor_default' => '#666666',
		'box_background'       => '#f8f8f8',
		'site_background'      => '#f8f8f8', // Used by WP custom-background
		'widgetmargin'         => 50,
		'logo_fontface'        => 'fontpo',
		'headings_fontface'    => 'fontpo',
		'subheadings_fontface' => 'fontno',
		'body_fontface'        => 'fontpo',
	) );

	if ( $key )
		return ( isset( $defaults[ $key ] ) ) ? $defaults[ $key ] : false;
	else
		return $defaults;
}
endif;

/**
 * Build the Customizer options (panels, sections, settings)
 *
 * Always remember to mention specific priority for non-static options like:
 *     - options being added based on a condition (eg: if woocommerce is active)
 *     - options which may get removed (eg: logo_size, headings_fontface)
 *     - options which may get rearranged (eg: logo_background_type)
 *     This will allow other options inserted with priority to be inserted at
 *     their intended place.
 *
 * @since 1.0
 * @access public
 * @return array
 */
if ( !function_exists( 'hoot_porto_customizer_options' ) ) :
function hoot_porto_customizer_options() {

	// Stores all the settings to be added
	$settings = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Theme default colors and fonts
	extract( hoot_porto_default_style() );

	// Directory path for radioimage buttons
	$imagepath =  hoot_data()->incuri . 'admin/images/';

	// Logo Sizes (different range than standard typography range)
	$logosizes = array();
	$logosizerange = range( 14, 110 );
	foreach ( $logosizerange as $isr )
		$logosizes[ $isr . 'px' ] = $isr . 'px';
	$logosizes = apply_filters( 'hoot_porto_options_logosizes', $logosizes);

	// Logo Font Options for Lite version
	$logofont = apply_filters( 'hoot_porto_options_logofont', array(
					'heading'  => esc_html__( "Logo Font (set in 'Typography' section)", 'hoot-porto' ),
					'heading2' => esc_html__( "Heading Font (set in 'Typography' section)", 'hoot-porto' ),
					'standard' => esc_html__( "Standard Body Font", 'hoot-porto' ),
					) );
	$fontfaces = apply_filters( 'hoot_porto_options_fontfaces', array(
					'fontpo' => esc_html__( 'Standard Font 1 (Poppins)', 'hoot-porto'),
					'fontos' => esc_html__( 'Standard Font 2 (Open Sans)', 'hoot-porto'),
					'fontcf' => esc_html__( 'Alternate Font (Comfortaa)', 'hoot-porto'),
					'fontow' => esc_html__( 'Display Font (Oswald)', 'hoot-porto'),
					'fontno' => esc_html__( 'Heading Font 1 (Noto Serif)', 'hoot-porto'),
					'fontsl' => esc_html__( 'Heading Font 2 (Slabo)', 'hoot-porto'),
					'fontgr' => esc_html__( 'Heading Font 3 (Georgia)', 'hoot-porto'),
					) );

	/*** Add Options (Panels, Sections, Settings) ***/

	/** Section **/

	$section = 'links';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Demo Install / Support', 'hoot-porto' ),
		'priority'    => '2',
	);

	$lcontent = array();
	$lcontent['demo'] = '<a class="hoot-cust-link" href="' .
				 'https://demo.wphoot.com/porto/' .
				 '" target="_blank"><span class="hoot-cust-link-head">' .
				 '<i class="fas fa-eye"></i> ' .
				 esc_html__( "Demo", 'hoot-porto') . 
				 '</span><span class="hoot-cust-link-desc">' .
				 esc_html__( "Demo the theme features and options with sample content.", 'hoot-porto') .
				 '</span></a>';
	$ocdilink = ( function_exists( 'hoot_lib_premium_core' ) ) ? ( ( class_exists( 'OCDI_Plugin' ) ) ? admin_url( 'themes.php?page=pt-one-click-demo-import' ) : 'https://wphoot.com/support/hoot-porto/#docs-section-demo-content' ) : 'https://wphoot.com/support/hoot-porto/#docs-section-demo-content-free';
	$lcontent['install'] = '<a class="hoot-cust-link" href="' .
				 esc_url( $ocdilink ) .
				 '" target="_blank"><span class="hoot-cust-link-head">' .
				 '<i class="fas fa-upload"></i> ' .
				 esc_html__( "1 Click Installation", 'hoot-porto') . 
				 '</span><span class="hoot-cust-link-desc">' .
				 esc_html__( "Install demo content to make your site look exactly like the Demo Site. Use it as a starting point instead of starting from scratch.", 'hoot-porto') .
				 '</span></a>';
	$lcontent['support'] = '<a class="hoot-cust-link" href="' .
				 'https://wphoot.com/support/' .
				 '" target="_blank"><span class="hoot-cust-link-head">' .
				 '<i class="far fa-life-ring"></i> ' .
				 esc_html__( "Documentation / Support", 'hoot-porto') . 
				 '</span><span class="hoot-cust-link-desc">' .
				 esc_html__( "Get theme related support for both free and premium users.", 'hoot-porto') .
				 '</span></a>';
	$lcontent['rateus'] = '<a class="hoot-cust-link" href="' .
				 'https://wordpress.org/support/theme/hoot-porto/reviews/#new-post' .
				 '" target="_blank"><span class="hoot-cust-link-head">' .
				 '<i class="fas fa-star"></i> ' .
				 esc_html__( "Rate Us", 'hoot-porto') . 
				 '</span><span class="hoot-cust-link-desc">' .
				 /* translators: five stars */
				 sprintf( esc_html__( 'If you are happy with the theme, please give us a %1$s rating on wordpress.org. Thanks in advance!', 'hoot-porto'), '<span style="color:#0073aa;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>' ) .
				 '</span></a>';

	$settings['linksection'] = array(
		'section'     => $section,
		'type'        => 'content',
		'priority'    => '8', // Non static options must have a priority
		'content'     => implode( ' ', apply_filters( 'hoot_porto_customizer_option_linksection', $lcontent ) ),
	);

	/** Section **/

	$section = 'title_tagline';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Setup &amp; Layout', 'hoot-porto' ),
		'priority'    => '5',
	);

	$settings['site_layout'] = array(
		'label'       => esc_html__( 'Site Layout - Boxed vs Stretched', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'boxed'   => esc_html__( 'Boxed layout', 'hoot-porto' ),
			'stretch' => esc_html__( 'Stretched layout (full width)', 'hoot-porto' ),
		),
		'default'     => 'stretch',
		'priority'    => '10',
		'transport' => 'postMessage',
	);

	$settings['load_minified'] = array(
		'label'       => esc_html__( 'Load Minified Styles and Scripts (when available)', 'hoot-porto' ),
		'sublabel'    => esc_html__( 'Checking this option reduces data size, hence increasing page load speed.', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'priority'    => '20',
	);

	$settings['sidebar'] = array(
		'label'       => esc_html__( 'Sidebar Layout (Site-wide)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
		'description' => esc_html__( 'Set the default sidebar width and position for your site.', 'hoot-porto' ),
		'priority'    => '30',
	);

	$settings['sidebar_fp'] = array(
		'label'       => esc_html__( 'Sidebar Layout (for Front Page)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => ( ( 'page' == get_option('show_on_front' ) ) ? 'full-width' : 'wide-right' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description' => sprintf( esc_html__( 'This is sidebar for the Frontpage Content Module in %1$sFrontpage Modules Settings%2$s', 'hoot-porto' ), '<a href="' . esc_url( admin_url( 'customize.php?autofocus[control]=frontpage_content_desc' ) ) . '" rel="focuslink" data-focustype="control" data-href="frontpage_content_desc">', '</a>' ),
		'priority'    => '35',
	);

	$settings['sidebar_archives'] = array(
		'label'       => esc_html__( 'Sidebar Layout (for Blog/Archives)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
		'priority'    => '35',
	);

	$settings['sidebar_pages'] = array(
		'label'       => esc_html__( 'Sidebar Layout (for Pages)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
		'priority'    => '40',
	);

	$settings['sidebar_posts'] = array(
		'label'       => esc_html__( 'Sidebar Layout (for single Posts)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
		'priority'    => '50',
	);

	if ( current_theme_supports( 'woocommerce' ) ) :

		$settings['sidebar_wooshop'] = array(
			'label'       => esc_html__( 'Sidebar Layout (Woocommerce Shop/Archives)', 'hoot-porto' ),
			'section'     => $section,
			'type'        => 'radioimage',
			'priority'    => '53', // Non static options must have a priority
			'choices'     => array(
				'wide-right'         => $imagepath . 'sidebar-wide-right.png',
				'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
				'wide-left'          => $imagepath . 'sidebar-wide-left.png',
				'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
				'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
				'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
				'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
				'full-width'         => $imagepath . 'sidebar-full.png',
				'none'               => $imagepath . 'sidebar-none.png',
			),
			'default'     => 'wide-right',
			'description' => esc_html__( 'Set the default sidebar width and position for WooCommerce Shop and Archives pages like product categories etc.', 'hoot-porto' ),
		);

		$settings['sidebar_wooproduct'] = array(
			'label'       => esc_html__( 'Sidebar Layout (Woocommerce Single Product Page)', 'hoot-porto' ),
			'section'     => $section,
			'type'        => 'radioimage',
			'priority'    => '53', // Non static options must have a priority
			'choices'     => array(
				'wide-right'         => $imagepath . 'sidebar-wide-right.png',
				'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
				'wide-left'          => $imagepath . 'sidebar-wide-left.png',
				'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
				'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
				'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
				'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
				'full-width'         => $imagepath . 'sidebar-full.png',
				'none'               => $imagepath . 'sidebar-none.png',
			),
			'default'     => 'wide-right',
			'description' => esc_html__( 'Set the default sidebar width and position for WooCommerce product page', 'hoot-porto' ),
		);

	endif;

	$settings['disable_sticky_sidebar'] = array(
		'label'       => esc_html__( 'Disable Sticky Sidebar', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'description' => esc_html__( 'Check this if you do not want to display a fixed Sidebar the user scrolls down the page.', 'hoot-porto' ),
		'priority'    => '60',
	);

	$settings['widgetmargin'] = array(
		'label'       => esc_html__( 'Widget Margin', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'text',
		'default'     => $widgetmargin,
		'description' => esc_html__( '(in pixels) Margin space above and below widgets. Leave empty if you dont want to change the default.', 'hoot-porto' ),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'default: 35', 'hoot-porto' ),
		),
		'priority'    => '70',
		'transport' => 'postMessage',
	);

	/** Section **/

	$section = 'header';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Header', 'hoot-porto' ),
		'priority'    => '10',
	);

	$settings['menu_location'] = array(
		'label'       => esc_html__( 'Menu Location', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'top'        => esc_html__( 'Above Logo', 'hoot-porto' ),
			'side'       => esc_html__( 'Header Side (Right of Logo)', 'hoot-porto' ),
			'bottom'     => esc_html__( 'Below Logo', 'hoot-porto' ),
			'none'       => esc_html__( 'Do not display menu', 'hoot-porto' ),
		),
		'default'     => 'bottom',
		'priority'    => '80',
	);

	$settings['logo_side'] = array(
		'label'       => esc_html__( 'Header Side (right of logo)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'search'      => esc_html__( 'Display Search', 'hoot-porto' ),
			'widget-area' => esc_html__( "'Header Side' widget area", 'hoot-porto' ),
			'none'        => esc_html__( 'None (Logo will get centre aligned)', 'hoot-porto' ),
		),
		'default'     => 'none',
		'priority'    => '90',
		'active_callback' => 'hoot_porto_callback_logo_side', /*** Use JS API (in customize.js) for conditional controls using 'menu_location' setting in their active_callback - for quicker response ***/
		'selective_refresh' => array( 'logo_side_partial', array(
			'selector'            => '#header-aside',
			'settings'            => array( 'logo_side' ),
			'render_callback'     => 'hoot_porto_header_aside',
			'container_inclusive' => true,
			) ),
	);

	$settings['fullwidth_menu_align'] = array(
		'label'       => esc_html__( 'Menu Area (alignment)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'left'      => esc_html__( 'Left', 'hoot-porto' ),
			'right'     => esc_html__( 'Right', 'hoot-porto' ),
			'center'    => esc_html__( 'Center', 'hoot-porto' ),
		),
		'default'     => 'center',
		'priority'    => '100',
		'active_callback' => 'hoot_porto_callback_logo_side', /*** Use JS API (in customize.js) for conditional controls using 'menu_location' setting in their active_callback - for quicker response ***/
		'transport' => 'postMessage',
	);

	$settings['disable_table_menu'] = array(
		'label'       => esc_html__( 'Disable Table Menu', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description' => sprintf( esc_html__( '%1$s%2$sDisable Table Menu if you have a lot of Top Level menu items, %3$sand dont have menu item descriptions.%4$s', 'hoot-porto' ), "<img src='{$imagepath}menu-table.png'>", '<br />', '<strong>', '</strong>' ),
		'priority'    => '110',
		'transport' => 'postMessage',
	);

	$settings['mobile_menu'] = array(
		'label'       => esc_html__( 'Mobile Menu', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'inline' => esc_html__( 'Inline - Menu Slide Downs to open', 'hoot-porto' ),
			'fixed'  => esc_html__( 'Fixed - Menu opens on the left', 'hoot-porto' ),
		),
		'default'     => 'fixed',
		'priority'    => '120',
		'transport' => 'postMessage',
	);

	$settings['mobile_submenu_click'] = array(
		'label'       => esc_html__( "[Mobile Menu] Submenu opens on 'Click'", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'default'     => 1,
		'description' => esc_html__( "Uncheck this option to make all Submenus appear in 'Open' state. By default, submenus open on clicking (i.e. single tap on mobile).", 'hoot-porto' ),
		'priority'    => '130',
		'transport' => 'postMessage',
	);

	$settings['below_header_grid'] = array(
		'label'       => esc_html__( "'Below Header' widget area layout", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'boxed'   => $imagepath . 'fp-widgetarea-boxed.png',
			'stretch' => $imagepath . 'fp-widgetarea-stretch.png',
		),
		'default'     => 'boxed',
		'priority'    => '133',
		'transport' => 'postMessage',
	);

	/** Section **/

	$section = 'logo';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Logo', 'hoot-porto' ),
		'priority'    => '15',
	);

	$settings['logo_background_type'] = array(
		'label'       => esc_html__( 'Logo Background', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'priority'    => '135', // Non static options must have a priority
		'choices'     => array(
			'transparent'   => esc_html__( 'None', 'hoot-porto' ),
			'accent'        => esc_html__( 'Accent Background', 'hoot-porto' ),
			'invert-accent' => esc_html__( 'Invert Accent Background', 'hoot-porto' ), // Implemented for possible child themes;
		),
		'default'     => 'transparent',
		'transport' => 'postMessage',
	);
	if ( !apply_filters( 'logo_background_type_invert_accent', false ) ) unset( $settings['logo_background_type']['choices']['invert-accent'] );

	$settings['logo_border'] = array(
		'label'       => esc_html__( 'Logo Border', 'hoot-porto' ),
		'sublabel'    => esc_html__( 'Display a border around logo.', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'default'     => 'none',
		'priority'    => '135',
		'choices'     => array(
			'none'        => esc_html__( 'None', 'hoot-porto' ),
			'border'      => esc_html__( 'Border (With padding)', 'hoot-porto' ),
			'bordernopad' => esc_html__( 'Border (No padding)', 'hoot-porto' ),
		),
		'transport' => 'postMessage',
	);

	$settings['logo'] = array(
		'label'       => esc_html__( 'Site Logo', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'text'        => esc_html__( 'Default Text (Site Title)', 'hoot-porto' ),
			'custom'      => esc_html__( 'Custom Text', 'hoot-porto' ),
			'image'       => esc_html__( 'Image Logo', 'hoot-porto' ),
			'mixed'       => esc_html__( 'Image &amp; Default Text (Site Title)', 'hoot-porto' ),
			'mixedcustom' => esc_html__( 'Image &amp; Custom Text', 'hoot-porto' ),
		),
		'default'     => 'mixedcustom',
		/* Translators: 1 is the link start markup, 2 is link markup end */
		'description' => sprintf( esc_html__( 'Use %1$sSite Title%2$s as default text logo', 'hoot-porto' ), '<a href="' . esc_url( admin_url('options-general.php') ) . '" target="_blank">', '</a>' ),
		'priority'    => '140',

		/*** Use JS API (in customize.js) for conditional controls using 'logo' setting in their active_callback ***/
		'selective_refresh' => array( 'logo_partial', array(
			'selector'            => '#branding',
			'settings'            => array( 'logo', 'logo_custom', 'custom_logo' ),	// Do not add 'logo_size' to 'settings' array
																					// since it is removed in premium, and hence this
																					// selective_refresh wont work
			'primary_setting'     => 'logo', // Redundant as 'logo' is first ID in settings array
			'render_callback'     => 'hoot_porto_branding',
			'container_inclusive' => true,
			) ),

	);

	$settings['logo_size'] = array(
		'label'       => esc_html__( 'Logo Text Size', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => '145', // Non static options must have a priority
		'choices'     => array(
			'tiny'   => esc_html__( 'Tiny', 'hoot-porto'),
			'small'  => esc_html__( 'Small', 'hoot-porto'),
			'medium' => esc_html__( 'Medium', 'hoot-porto'),
			'large'  => esc_html__( 'Large', 'hoot-porto'),
			'huge'   => esc_html__( 'Huge', 'hoot-porto'),
		),
		'default'     => 'medium',
		'active_callback' => 'hoot_porto_callback_logo_size',
		'transport' => 'postMessage',
	);

	$settings['site_title_icon'] = array(
		'label'           => esc_html__( 'Site Title Icon (Optional)', 'hoot-porto' ),
		'section'         => $section,
		'type'            => 'icon',
		'description'     => esc_html__( 'Leave empty to hide icon.', 'hoot-porto' ),
		'priority'    => '150',
		'active_callback' => 'hoot_porto_callback_site_title_icon',
		'transport' => 'postMessage',
	);

	$settings['site_title_icon_size'] = array(
		'label'           => esc_html__( 'Site Title Icon Size', 'hoot-porto' ),
		'section'         => $section,
		'type'            => 'select',
		'choices'         => $logosizes,
		'default'         => '50px',
		'priority'    => '160',
		'active_callback' => 'hoot_porto_callback_site_title_icon',
		'transport' => 'postMessage',
	);

	$settings['logo_image_width'] = array(
		'label'           => esc_html__( 'Maximum Logo Width', 'hoot-porto' ),
		'section'         => $section,
		'type'            => 'text',
		'priority'        => '166', // Keep it with logo image ( 'custom_logo' )->priority logo
		'default'         => 200,
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description'     => sprintf( esc_html__( '(in pixels)%1$sThe logo width may be automatically adjusted by the browser depending on title length and space available.', 'hoot-porto' ), '<hr>' ),
		'input_attrs'     => array(
			'placeholder' => esc_html__( '(in pixels)', 'hoot-porto' ),
		),
		'active_callback' => 'hoot_porto_callback_logo_image_width',
		'transport' => 'postMessage',
	);

	$logo_custom_line_options = array(
		'text' => array(
			'label'       => esc_html__( 'Line Text', 'hoot-porto' ),
			'type'        => 'text',
		),
		'size' => array(
			'label'       => esc_html__( 'Line Size', 'hoot-porto' ),
			'type'        => 'select',
			'choices'     => $logosizes,
			'default'     => '24px',
		),
		'font' => array(
			'label'       => esc_html__( 'Line Font', 'hoot-porto' ),
			'type'        => 'select',
			'choices'     => $logofont,
			'default'     => 'heading',
		),
	);

	$settings['logo_custom'] = array(
		'label'           => esc_html__( 'Custom Logo Text', 'hoot-porto' ),
		'section'         => $section,
		'type'            => 'sortlist',
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description'     => sprintf( esc_html__( 'Use &lt;b&gt; and &lt;em&gt; tags in "Line Text" fields below to emphasize different words. Example:%1$s%2$s&lt;em&gt;wpHoot&lt;/em&gt; &lt;b&gt;Porto&lt;/b&gt;%3$s', 'hoot-porto' ), '<br />', '<code>', '</code>' ),
		'choices'         => array(
			'line1' => esc_html__( 'Line 1', 'hoot-porto' ),
			'line2' => esc_html__( 'Line 2', 'hoot-porto' ),
			'line3' => esc_html__( 'Line 3', 'hoot-porto' ),
			'line4' => esc_html__( 'Line 4', 'hoot-porto' ),
		),
		'default'     => array(
			'line1'  => array( 'text' => wp_kses_post( __( '<em>wpHoot</em>', 'hoot-porto' ) ), 'size' => '20px', 'font' => 'standard' ),
			'line2'  => array( 'text' => wp_kses_post( __( 'Hoot <b>Porto</b>', 'hoot-porto' ) ), 'size' => '50px' ),
			'line3'  => array( 'sortitem_hide' => 1, 'font' => 'standard' ),
			'line4'  => array( 'sortitem_hide' => 1, ),
		),
		'options'         => array(
			'line1' => $logo_custom_line_options,
			'line2' => $logo_custom_line_options,
			'line3' => $logo_custom_line_options,
			'line4' => $logo_custom_line_options,
		),

		'attributes'      => array(
			'hideable'   => true,
			'sortable'   => false,
		),
		'priority'    => '170',
		'active_callback' => 'hoot_porto_callback_logo_custom',
		'transport' => 'postMessage', // to work with 'selective_refresh' added via 'logo'
	);

	$settings['show_tagline'] = array(
		'label'           => esc_html__( 'Show Tagline', 'hoot-porto' ),
		'sublabel'        => esc_html__( 'Display site description as tagline below logo.', 'hoot-porto' ),
		'section'         => $section,
		'type'            => 'checkbox',
		'default'         => 1,
		'priority'    => '180',
		'transport' => 'postMessage',
	);

	/** Section **/

	$section = 'colors';

	// Redundant as 'colors' section is added by WP. But we still add it for brevity
	$sections[ $section ] = array(
		'title'       => esc_html__( 'Colors / Backgrounds', 'hoot-porto' ),
		'priority'    => '20',
	);

	$settings['box_background_color'] = array(
		'label'       => esc_html__( 'Site Content Background', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'color',
		'priority'    => '185', // Non static options must have a priority
		'default'     => $box_background,
		'transport' => 'postMessage',
	);

	$settings['accent_color'] = array(
		'label'       => esc_html__( 'Accent Color', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'color',
		'default'     => $accent_color,
		'priority'    => '190',
		'transport' => 'postMessage',
	);

	$settings['accent_font'] = array(
		'label'       => esc_html__( 'Font Color on Accent Color', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'color',
		'default'     => $accent_font,
		'priority'    => '200',
		'transport' => 'postMessage',
	);

	/** Section **/

	$section = 'typography';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Typography', 'hoot-porto' ),
		'priority'    => '25',
	);

	$settings['logo_fontface'] = array(
		'label'       => esc_html__( 'Logo Font (Free Version)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => $fontfaces,
		'default'     => $logo_fontface,
	);

	$settings['logo_fontface_style'] = array(
		'label'       => esc_html__( 'Logo Font Style', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array(
			'standard'  => esc_html__( 'Standard', 'hoot-porto'),
			'uppercase' => esc_html__( 'Uppercase', 'hoot-porto'),
		),
		'default'     => 'standard',
		'transport' => 'postMessage',
	);

	$settings['headings_fontface'] = array(
		'label'       => esc_html__( 'Headings Font (Free Version)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => $fontfaces,
		'default'     => $headings_fontface,
	);

	$settings['headings_fontface_style'] = array(
		'label'       => esc_html__( 'Heading Font Style', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array(
			'standard'   => esc_html__( 'Standard', 'hoot-porto'),
			'standardi'  => esc_html__( 'Standard Italics', 'hoot-porto'),
			'uppercase'  => esc_html__( 'Uppercase', 'hoot-porto'),
			'uppercasei' => esc_html__( 'Uppercase Italics', 'hoot-porto'),
		),
		'default'     => 'standard',
		'transport' => 'postMessage',
	);

	$settings['subheadings_fontface'] = array(
		'label'       => esc_html__( 'Sub Headings Font (Free Version)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => $fontfaces,
		'default'     => $subheadings_fontface,
	);

	$settings['subheadings_fontface_style'] = array(
		'label'       => esc_html__( 'Sub Heading Font Style', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array(
			'standard'   => esc_html__( 'Standard', 'hoot-porto'),
			'standardi'  => esc_html__( 'Standard Italics', 'hoot-porto'),
			'uppercase'  => esc_html__( 'Uppercase', 'hoot-porto'),
			'uppercasei' => esc_html__( 'Uppercase Italics', 'hoot-porto'),
		),
		'default'     => 'standardi',
		'transport' => 'postMessage',
	);

	$settings['body_fontface'] = array(
		'label'       => esc_html__( 'Body Font (Free Version)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => $fontfaces,
		'default'     => $body_fontface,
	);

	/** Section **/

	$section = 'frontpage';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Frontpage - Modules', 'hoot-porto' ),
		'priority'    => '30',
	);

	$widget_area_options = array(
		'columns' => array(
			'label'   => esc_html__( 'Columns', 'hoot-porto' ),
			'type'    => 'select',
			'choices' => array(
				'100'         => esc_html__( 'One Column [100]', 'hoot-porto' ),
				'50-50'       => esc_html__( 'Two Columns [50 50]', 'hoot-porto' ),
				'33-66'       => esc_html__( 'Two Columns [33 66]', 'hoot-porto' ),
				'66-33'       => esc_html__( 'Two Columns [66 33]', 'hoot-porto' ),
				'25-75'       => esc_html__( 'Two Columns [25 75]', 'hoot-porto' ),
				'75-25'       => esc_html__( 'Two Columns [75 25]', 'hoot-porto' ),
				'33-33-33'    => esc_html__( 'Three Columns [33 33 33]', 'hoot-porto' ),
				'25-25-50'    => esc_html__( 'Three Columns [25 25 50]', 'hoot-porto' ),
				'25-50-25'    => esc_html__( 'Three Columns [25 50 25]', 'hoot-porto' ),
				'50-25-25'    => esc_html__( 'Three Columns [50 25 25]', 'hoot-porto' ),
				'25-25-25-25' => esc_html__( 'Four Columns [25 25 25 25]', 'hoot-porto' ),
			),
		),
		'grid' => array(
			'label'    => esc_html__( 'Layout', 'hoot-porto' ),
			'sublabel' => esc_html__( 'The fully stretched grid layout is especially useful for displaying full width slider widgets.', 'hoot-porto' ),
			'type'     => 'radioimage',
			'choices'     => array(
				'boxed'   => $imagepath . 'fp-widgetarea-boxed.png',
				'stretch' => $imagepath . 'fp-widgetarea-stretch.png',
			),
			'default'  => 'boxed',
		),
		'modulebg' => array(
			'label'       => '',
			'type'        => 'content',
			'content'     => '<div class="button">' . esc_html__( 'Module Background', 'hoot-porto' ) . '</div>',
		),
	);

	$settings['frontpage_sections'] = array(
		'label'       => esc_html__( 'Frontpage Widget Areas', 'hoot-porto' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'sublabel'    => sprintf( esc_html__( '%1$s%3$sSort different sections of the Frontpage in the order you want them to appear.%4$s%3$sYou can add content to widget areas from the %5$sWidgets Management screen%6$s.%4$s%3$sYou can disable areas by clicking the "eye" icon. (This will hide them on the Widgets screen as well)%4$s%2$s', 'hoot-porto' ), '<ul>', '</ul>', '<li>', '</li>', '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>' ),
		'section'     => $section,
		'type'        => 'sortlist',
		'choices'     => array(
			'area_a'      => esc_html__( 'Widget Area A', 'hoot-porto' ),
			'area_b'      => esc_html__( 'Widget Area B', 'hoot-porto' ),
			'area_c'      => esc_html__( 'Widget Area C', 'hoot-porto' ),
			'area_d'      => esc_html__( 'Widget Area D', 'hoot-porto' ),
			'content'     => esc_html__( 'Frontpage Content', 'hoot-porto' ),
			'area_e'      => esc_html__( 'Widget Area E', 'hoot-porto' ),
			'area_f'      => esc_html__( 'Widget Area F', 'hoot-porto' ),
			'area_g'      => esc_html__( 'Widget Area G', 'hoot-porto' ),
			'area_h'      => esc_html__( 'Widget Area H', 'hoot-porto' ),
			'area_i'      => esc_html__( 'Widget Area I', 'hoot-porto' ),
			'area_j'      => esc_html__( 'Widget Area J', 'hoot-porto' ),
			'area_k'      => esc_html__( 'Widget Area K', 'hoot-porto' ),
			'area_l'      => esc_html__( 'Widget Area L', 'hoot-porto' ),
		),
		'default'     => array(
			// 'content' => array( 'sortitem_hide' => 1, ),
			'area_b'  => array( 'columns' => '50-50' ),
			'area_f'  => array( 'sortitem_hide' => 1, ),
			'area_g'  => array( 'sortitem_hide' => 1, ),
			'area_h'  => array( 'sortitem_hide' => 1, ),
			'area_i'  => array( 'sortitem_hide' => 1, ),
			'area_j'  => array( 'sortitem_hide' => 1, ),
			'area_k'  => array( 'sortitem_hide' => 1, ),
			'area_l'  => array( 'sortitem_hide' => 1, ),
		),
		'options'     => array(
			'area_a'      => $widget_area_options,
			'area_b'      => $widget_area_options,
			'area_c'      => $widget_area_options,
			'area_d'      => $widget_area_options,
			'area_e'      => $widget_area_options,
			'area_f'      => $widget_area_options,
			'area_g'      => $widget_area_options,
			'area_h'      => $widget_area_options,
			'area_i'      => $widget_area_options,
			'area_j'      => $widget_area_options,
			'area_k'      => $widget_area_options,
			'area_l'      => $widget_area_options,
			'content'     => array(
							'title' => array(
								'label'       => esc_html__( 'Title (optional)', 'hoot-porto' ),
								'type'        => 'text',
							),
							'modulebg' => array(
								'label'       => '',
								'type'        => 'content',
								'content'     => '<div class="button">' . esc_html__( 'Module Background', 'hoot-porto' ) . '</div>',
							), ),
		),
		'attributes'  => array(
			'hideable'      => true,
			'sortable'      => true,
			'open-state'    => 'area_a',
		),
		'priority'    => '210',
	);

	$settings['frontpage_content_desc'] = array(
		'label'       => esc_html__( "Frontpage Content", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'content',
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'content'     => sprintf( esc_html__( 'The "Frontpage Content" module in above list will show %1$s%3$sthe %5$s"Blog"%6$s if you have %5$sYour Latest Posts%6$s selectd in %7$sReading Settings%8$s %4$s%3$sthe %5$s"Page Content"%6$s of the page set as Front page if you have %5$sA static page%6$s selected in %7$sReading Settings%8$s %4$s%2$s',
				'hoot-porto' ), "<ul style='list-style:disc;margin:1em 0 0 2em;'>", '</ul>', '<li>', '</li>', '<strong>', '</strong>',
									 '<a href="' . esc_url( admin_url('options-reading.php') ) . '" target="_blank">', '</a>' ),
		'priority'    => '220',
	);

	$frontpagemodule_bg = apply_filters( 'hoot_porto_frontpage_widgetarea_sectionbg_index', array(
		'area_a'      => esc_html__( 'Widget Area A', 'hoot-porto' ),
		'area_b'      => esc_html__( 'Widget Area B', 'hoot-porto' ),
		'area_c'      => esc_html__( 'Widget Area C', 'hoot-porto' ),
		'area_d'      => esc_html__( 'Widget Area D', 'hoot-porto' ),
		'area_e'      => esc_html__( 'Widget Area E', 'hoot-porto' ),
		'area_f'      => esc_html__( 'Widget Area F', 'hoot-porto' ),
		'area_g'      => esc_html__( 'Widget Area G', 'hoot-porto' ),
		'area_h'      => esc_html__( 'Widget Area H', 'hoot-porto' ),
		'area_i'      => esc_html__( 'Widget Area I', 'hoot-porto' ),
		'area_j'      => esc_html__( 'Widget Area J', 'hoot-porto' ),
		'area_k'      => esc_html__( 'Widget Area K', 'hoot-porto' ),
		'area_l'      => esc_html__( 'Widget Area L', 'hoot-porto' ),
		'content'     => esc_html__( 'Frontpage Content', 'hoot-porto' ),
		) );

	foreach ( $frontpagemodule_bg as $fpgmodid => $fpgmodname ) {

		$settings["frontpage_sectionbg_{$fpgmodid}"] = array(
			'label'       => '',
			'section'     => $section,
			'type'        => 'group',
			'startwrap'   => 'fp-section-bg-button',
			'button'      => esc_html__( 'Module Background', 'hoot-porto' ),
			'options'     => array(
				'description' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<span class="hoot-module-bg-title">' . $fpgmodname . '</span>',
				),
				'type' => array(
					'label'   => esc_html__( 'Background Type', 'hoot-porto' ),
					'type'    => 'radio',
					'choices' => array(
						'none'        => esc_html__( 'None', 'hoot-porto' ),
						'color'       => esc_html__( 'Color', 'hoot-porto' ),
						'image'       => esc_html__( 'Image', 'hoot-porto' ),
					),
					'default' => 'none',
					'transport' => 'postMessage',
				),
				'color' => array(
					'label'       => esc_html__( "Background Color (Select 'Color' above)", 'hoot-porto' ),
					'type'        => 'color',
					'default'     => $module_bg_default,
					'transport' => 'postMessage',
				),
				'image' => array(
					'label'       => esc_html__( "Background Image (Select 'Image' above)", 'hoot-porto' ),
					'type'        => 'image',
					'transport' => 'postMessage',
				),
				'parallax' => array(
					'label'   => esc_html__( 'Apply Parallax Effect to Background Image', 'hoot-porto' ),
					'type'    => 'checkbox',
				),
				'font' => array(
					'label'   => esc_html__( 'Font Color', 'hoot-porto' ),
					'type'    => 'radio',
					'choices' => array(
						'theme'       => esc_html__( 'Default Theme Color', 'hoot-porto' ),
						'color'       => esc_html__( 'Custom Font Color', 'hoot-porto' ),
						'force'       => esc_html__( 'Force Custom Font Color', 'hoot-porto' ),
					),
					'default' => 'theme',
					'transport' => 'postMessage',
				),
				'fontcolor' => array(
					'label'       => esc_html__( "Custom Font Color (select 'Custom Font Color' above)", 'hoot-porto' ),
					'type'        => 'color',
					'default'     => $module_fontcolor_default,
					'transport' => 'postMessage',
				),
			),
			'priority'    => '230',
		);

	} // end for

	/** Section **/

	$section = 'archives';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Archives (Blog, Cats, Tags)', 'hoot-porto' ),
		'priority'    => '35',
	);

	$settings['archive_type'] = array(
		'label'       => esc_html__( 'Archive (Blog) Layout', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'big'          => $imagepath . 'archive-big.png',
			'block2'       => $imagepath . 'archive-block2.png',
			'block3'       => $imagepath . 'archive-block3.png',
			'mixed-block2' => $imagepath . 'archive-mixed-block2.png',
			'mixed-block3' => $imagepath . 'archive-mixed-block3.png',
		),
		'default'     => 'mixed-block2',
		'priority'    => '240',
	);

	$settings['archive_post_content'] = array(
		'label'       => esc_html__( 'Post Items Content', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'none' => esc_html__( 'None', 'hoot-porto' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'hoot-porto' ),
			'full-content' => esc_html__( 'Full Post Content', 'hoot-porto' ),
		),
		'default'     => 'excerpt',
		'description' => esc_html__( 'Content to display for each post in the list', 'hoot-porto' ),
		'priority'    => '250',
	);

	$settings['archive_post_meta'] = array(
		'label'       => esc_html__( 'Meta Information for Post List Items', 'hoot-porto' ),
		'sublabel'    => esc_html__( 'Check which meta information to display for each post item in the archive list.', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => esc_html__( 'Author', 'hoot-porto' ),
			'date'     => esc_html__( 'Date', 'hoot-porto' ),
			'cats'     => esc_html__( 'Categories', 'hoot-porto' ),
			'tags'     => esc_html__( 'Tags', 'hoot-porto' ),
			'comments' => esc_html__( 'No. of comments', 'hoot-porto' ),
		),
		'default'     => 'author, date, cats',
		'selective_refresh' => array( 'archive_post_meta_partial', array(
			'selector'            => '.blog .entry-byline, .home .entry-byline, .plural .entry-byline',
			'settings'            => array( 'archive_post_meta' ),
			'render_callback'     => 'hoot_porto_callback_archive_post_meta',
			'container_inclusive' => true,
			'fallback_refresh'    => false, // prevents full refresh on non applicable views
			) ),
		'priority'    => '260',
	);

	$settings['excerpt_length'] = array(
		'label'       => esc_html__( 'Excerpt Length', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'text',
		'description' => esc_html__( 'Number of words in excerpt. Default is 50. Leave empty if you dont want to change it.', 'hoot-porto' ),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'default: 50', 'hoot-porto' ),
		),
		'priority'    => '270',
	);

	$settings['read_more'] = array(
		'label'       => esc_html__( "'Continue Reading' Text", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'text',
		'description' => esc_html__( "Replace the default 'Continue Reading' text. Leave empty if you dont want to change it.", 'hoot-porto' ),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'default: Continue Reading', 'hoot-porto' ),
		),
		'default'     => esc_html__( 'Continue Reading', 'hoot-porto' ),
		'priority'    => '280',
	);

	/** Section **/

	$section = 'singular';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Single (Posts, Pages)', 'hoot-porto' ),
		'priority'    => '40',
	);

	$settings['page_header_full'] = array(
		'label'       => esc_html__( 'Stretch Page Title Area to Full Width', 'hoot-porto' ),
		'sublabel'    => '<img src="' . $imagepath . 'page-header.png">',
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'default'    => esc_html__( 'Default (Archives, Blog, Woocommerce etc.)', 'hoot-porto' ),
			'posts'      => esc_html__( 'For All Posts', 'hoot-porto' ),
			'pages'      => esc_html__( 'For All Pages', 'hoot-porto' ),
			'no-sidebar' => esc_html__( 'Always override for full width pages (any page which has no sidebar)', 'hoot-porto' ),
		),
		'default'     => 'default, pages, no-sidebar',
		'description' => esc_html__( 'This is the Page Header area containing Page/Post Title and Meta details like author, categories etc.', 'hoot-porto' ),
		'priority'    => '290',
	);

	$settings['post_featured_image'] = array(
		'label'       => esc_html__( 'Display Featured Image (Post)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'choices'     => array(
			'none'                => esc_html__( 'Do not display', 'hoot-porto'),
			'staticheader-nocrop' => esc_html__( 'Header Background (No Cropping)', 'hoot-porto'),
			'staticheader'        => esc_html__( 'Header Background (Cropped)', 'hoot-porto'),
			'header'              => esc_html__( 'Header Background (Parallax Effect)', 'hoot-porto'),
			'content'             => esc_html__( 'Beginning of content', 'hoot-porto'),
		),
		'default'     => 'content',
		'description' => esc_html__( 'Display featured image on a Post page.', 'hoot-porto' ),
		'priority'    => '300',
	);

	$settings['post_featured_image_page'] = array(
		'label'       => esc_html__( 'Display Featured Image (Page)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'select',
		'choices'     => array(
			'none'                => esc_html__( 'Do not display', 'hoot-porto'),
			'staticheader-nocrop' => esc_html__( 'Header Background (No Cropping)', 'hoot-porto'),
			'staticheader'        => esc_html__( 'Header Background (Cropped)', 'hoot-porto'),
			'header'              => esc_html__( 'Header Background (Parallax Effect)', 'hoot-porto'),
			'content'             => esc_html__( 'Beginning of content', 'hoot-porto'),
		),
		'default'     => 'header',
		'description' => esc_html__( "Display featured image on a 'Page' page.", 'hoot-porto' ),
		'priority'    => '310',
	);

	$settings['post_meta'] = array(
		'label'       => esc_html__( 'Meta Information on Posts', 'hoot-porto' ),
		'sublabel'    => esc_html__( "Check which meta information to display on an individual 'Post' page", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => esc_html__( 'Author', 'hoot-porto' ),
			'date'     => esc_html__( 'Date', 'hoot-porto' ),
			'cats'     => esc_html__( 'Categories', 'hoot-porto' ),
			'tags'     => esc_html__( 'Tags', 'hoot-porto' ),
			'comments' => esc_html__( 'No. of comments', 'hoot-porto' )
		),
		'default'     => 'author, date, cats, tags, comments',
		'priority'    => '320',
		'selective_refresh' => array( 'post_meta_partial', array(
			'selector'            => '.singular-post .entry-byline',
			'settings'            => array( 'post_meta' ),
			'render_callback'     => 'hoot_porto_callback_post_meta',
			'container_inclusive' => true,
			'fallback_refresh'    => false, // prevents full refresh on non applicable views
			) ),
	);

	$settings['page_meta'] = array(
		'label'       => esc_html__( 'Meta Information on Page', 'hoot-porto' ),
		'sublabel'    => esc_html__( "Check which meta information to display on an individual 'Page' page", 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => esc_html__( 'Author', 'hoot-porto' ),
			'date'     => esc_html__( 'Date', 'hoot-porto' ),
			'comments' => esc_html__( 'No. of comments', 'hoot-porto' ),
		),
		'default'     => 'author, date, comments',
		'priority'    => '330',
		'selective_refresh' => array( 'page_meta_partial', array(
			'selector'            => '.singular-page .entry-byline',
			'settings'            => array( 'page_meta' ),
			'render_callback'     => 'hoot_porto_callback_page_meta',
			'container_inclusive' => true,
			'fallback_refresh'    => false, // prevents full refresh on non applicable views
			) ),
	);

	$settings['post_meta_location'] = array(
		'label'       => esc_html__( 'Meta Information location', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'top'    => esc_html__( 'Top (below title)', 'hoot-porto' ),
			'bottom' => esc_html__( 'Bottom (after content)', 'hoot-porto' ),
		),
		'default'     => 'top',
		'priority'    => '340',
	);

	$settings['post_prev_next_links'] = array(
		'label'       => esc_html__( 'Previous/Next Posts', 'hoot-porto' ),
		'sublabel'    => esc_html__( 'Display links to Prev/Next Post links at the end of post content.', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'default'     => 1,
		'priority'    => '350',
		'selective_refresh' => array( 'post_prev_next_links_partial', array(
			'selector'            => '#loop-nav-wrap',
			'settings'            => array( 'post_prev_next_links' ),
			'render_callback'     => 'hoot_porto_post_prev_next_links',
			'container_inclusive' => true,
			'fallback_refresh'    => false, // prevents full refresh on non applicable views
			) ),
	);

	$settings['contact-form'] = array(
		'label'       => esc_html__( 'Contact Form', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'content',
		'priority'    => '355', // Non static options must have a priority
		/* Translators: 1 is the link start markup, 2 is link markup end */
		'content'     => sprintf( esc_html__( 'This theme comes bundled with CSS required to style %1$sContact-Form-7%2$s forms. Simply install and activate the plugin to add Contact Forms to your pages.', 'hoot-porto' ), '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">', '</a>' ), // @todo update link to docs
	);

	/** Section **/

	$section = 'footer';

	$sections[ $section ] = array(
		'title'       => esc_html__( 'Footer', 'hoot-porto' ),
		'priority'    => '45',
	);

	$settings['footer'] = array(
		'label'       => esc_html__( 'Footer Layout', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'1-1' => $imagepath . '1-1.png',
			'2-1' => $imagepath . '2-1.png',
			'2-2' => $imagepath . '2-2.png',
			'2-3' => $imagepath . '2-3.png',
			'3-1' => $imagepath . '3-1.png',
			'3-2' => $imagepath . '3-2.png',
			'3-3' => $imagepath . '3-3.png',
			'3-4' => $imagepath . '3-4.png',
			'4-1' => $imagepath . '4-1.png',
		),
		'default'     => '4-1',
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description' => sprintf( esc_html__( 'You must first save the changes you make here and refresh this screen for footer columns to appear in the Widgets panel (in customizer).%3$s Once you save the settings here, you can add content to footer columns using the %1$sWidgets Management screen%2$s.', 'hoot-porto' ), '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>', '<hr>' ),
		'priority'    => '360',
		'transport' => 'postMessage',
	);

	$settings['site_info'] = array(
		'label'       => esc_html__( 'Site Info Text (footer)', 'hoot-porto' ),
		'section'     => $section,
		'type'        => 'textarea',
		'default'     => esc_html__( '<!--default-->', 'hoot-porto'),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'description' => sprintf( esc_html__( 'Text shown in footer. Useful for showing copyright info etc.%3$sUse the %4$s&lt;!--default--&gt;%5$s tag to show the default Info Text.%3$sUse the %4$s&lt;!--year--&gt;%5$s tag to insert the current year.%3$sAlways use %1$sHTML codes%2$s for symbols. For example, the HTML for &copy; is %4$s&amp;copy;%5$s', 'hoot-porto' ), '<a href="http://ascii.cl/htmlcodes.htm" target="_blank">', '</a>', '<hr>', '<code>', '</code>' ),
		'priority'    => '370',
		'transport' => 'postMessage',
	);


	/*** Return Options Array ***/
	return apply_filters( 'hoot_porto_customizer_options', array(
		'settings' => $settings,
		'sections' => $sections,
		'panels'   => $panels,
	) );

}
endif;

/**
 * Add Options (settings, sections and panels) to Hoot_Customize class options object
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hoot_porto_add_customizer_options' ) ) :
function hoot_porto_add_customizer_options() {

	$hoot_customize = Hoot_Customize::get_instance();

	// Add Options
	$options = hoot_porto_customizer_options();
	$hoot_customize->add_options( array(
		'settings' => $options['settings'],
		'sections' => $options['sections'],
		'panels' => $options['panels'],
		) );

}
endif;
add_action( 'init', 'hoot_porto_add_customizer_options', 0 ); // cannot hook into 'after_setup_theme' as this hook is already being executed (this file is loaded at after_setup_theme @priority 10) (hooking into same hook from within while hook is being executed leads to undesirable effects as $GLOBALS[$wp_filter]['after_setup_theme'] has already been ksorted)
// Hence, we hook into 'init' @priority 0, so that settings array gets populated before 'widgets_init' action ( which itself is hooked to 'init' at priority 1 ) for creating widget areas ( settings array is needed for creating defaults when user value has not been stored )

/**
 * Enqueue custom scripts to customizer screen
 *
 * @since 1.0
 * @return void
 */
function hoot_porto_customizer_enqueue_scripts() {
	// Enqueue Styles
	$style_uri = ( function_exists( 'hoot_locate_style' ) ) ? hoot_locate_style( hoot_data()->incuri . 'admin/css/customize' ) : hoot_data()->incuri . 'admin/css/customize.css';
	wp_enqueue_style( 'hoot-porto-customize-styles', $style_uri, array(),  hoot_data()->hoot_version );
	// Enqueue Scripts
	$script_uri = ( function_exists( 'hoot_locate_script' ) ) ? hoot_locate_script( hoot_data()->incuri . 'admin/js/customize-controls' ) : hoot_data()->incuri . 'admin/js/customize-controls.js';
	wp_enqueue_script( 'hoot-porto-customize-controls', $script_uri, array( 'jquery', 'wp-color-picker', 'customize-controls', 'hoot-customize' ), hoot_data()->hoot_version, true );
}
// Load scripts at priority 12 so that Hoot Customizer Interface (11) / Custom Controls (10) have loaded their scripts
add_action( 'customize_controls_enqueue_scripts', 'hoot_porto_customizer_enqueue_scripts', 12 );

/**
 * Modify default WordPress Settings Sections and Panels
 *
 * @since 1.0
 * @param object $wp_customize
 * @return void
 */
function hoot_porto_modify_default_customizer_options( $wp_customize ) {

	/**
	 * Defaults: [type] => cropped_image
	 *           [width] => 150
	 *           [height] => 150
	 *           [flex_width] => 1
	 *           [flex_height] => 1
	 *           [button_labels] => array(...)
	 *           [label] => Logo
	 */
	$wp_customize->get_control( 'custom_logo' )->section = 'logo';
	$wp_customize->get_control( 'custom_logo' )->priority = 165;
	$wp_customize->get_control( 'custom_logo' )->width = 300;
	$wp_customize->get_control( 'custom_logo' )->height = 180;
	// $wp_customize->get_control( 'custom_logo' )->type = 'image'; // Stored value becomes url instead of image ID (fns like the_custom_logo() dont work)
	$wp_customize->get_control( 'custom_logo' )->active_callback = 'hoot_porto_callback_logo_image';

	if ( function_exists( 'get_site_icon_url' ) )
		$wp_customize->get_control( 'site_icon' )->priority = 10;

	$wp_customize->get_section( 'static_front_page' )->priority = 3;
	if ( current_theme_supports( 'custom-header' ) ) {
		$wp_customize->get_section( 'header_image' )->priority = 28;
		$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Frontpage - Header Image', 'hoot-porto' );
	}

	// Backgrounds
	if ( current_theme_supports( 'custom-background' ) ) {
		$wp_customize->get_control( 'background_color' )->label =  esc_html__( 'Site Background Color', 'hoot-porto' );
		$wp_customize->get_section( 'background_image' )->priority = 23;
		$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Site Background Image', 'hoot-porto' );
	}

}
add_action( 'customize_register', 'hoot_porto_modify_default_customizer_options', 100 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function hoot_porto_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport = 'postMessage';
}
add_action( 'customize_register', 'hoot_porto_customize_register' );

/**
 * Add style tag to support dynamic css via postMessage script in customizer preview
 *
 * @since 1.0
 * @access public
 */
function hoot_porto_customize_dynamic_cssrules() {
	// Add in Customizer Only
	if ( is_customize_preview() ) {
		$handle = apply_filters( 'hoot_style_builder_inline_style_handle', 'hoot-style' );
		$hootpload = ( function_exists( 'hoot_lib_premium_core' ) ) ? 1 : '';
		$settings = array();
		$settings['widgetmargin'] = array(
			'margin-top'	=> array( '.main-content-grid' . ',' . '.widget' . ',' . '.frontpage-area',
									  '.bottomborder-line:after' . ',' . '.bottomborder-shadow:after',
									  '.footer .widget', // brevity : replaced by newvalintsmall in js
									),
			'margin-bottom'	=> array( '.widget' . ',' . '.frontpage-area',
									  '.topborder-line:before' . ',' . '.topborder-shadow:before',
									  '.footer .widget', // brevity : replaced by newvalintsmall in js
									),
			'padding-top'	=> array( '.frontpage-area.module-bg-highlight, .frontpage-area.module-bg-color, .frontpage-area.module-bg-image',
									  '.altthemedividers #loop-meta:not(.loop-meta-withbg) .loop-meta' ),
			'padding-bottom'=> array( '.frontpage-area.module-bg-highlight, .frontpage-area.module-bg-color, .frontpage-area.module-bg-image',
									  '.altthemedividers #loop-meta:not(.loop-meta-withbg) .loop-meta' ),
			'media'			=> array(
				'@media only screen and (max-width: 969px)' => array(
					'margin-top'	=> array( '.sidebar' ),
					'margin-bottom'	=> array( '.frontpage-widgetarea > div.hgrid > [class*="hgrid-span-"]' ),
				),
			),
		);
		$settings['site_title_icon_size'] = array(
			'font-size'		=> array( '.site-logo-with-icon #site-title i' ),
		);
		$settings['logo_image_width'] = array(
			'max-width'		=> array( '.site-logo-mixed-image img' ),
		);
		$settings['box_background_color'] = array(
			'color'			=> array( '.invert-typo' ),
			'background'	=> array( '.enforce-typo',
									  '#main.main' . ',' . '.below-header',
									  '.js-search .searchform.expand .searchtext',
									  '.content-block-style3 .content-block-icon',
									),
		);
		if ( !$hootpload ) {
			array_push( $settings['box_background_color']['background'], '.menu-items ul' );
			$settings['box_background_color']['media'] = array(
				'@media only screen and (max-width: 969px)' => array(
					'background'	=> array( '.mobilemenu-fixed .menu-toggle, .mobilemenu-fixed .menu-items' ),
				),
			);
		} else {
			$settings['box_background_color']['border-bottom-color'] = array( '.current-tabhead' );
		}
		$settings['accent_color'] = array(
			'color'			=> array( '.invert-accent-typo',
									  'body.wordpress input[type="submit"]:hover, body.wordpress #submit:hover, body.wordpress .button:hover, body.wordpress input[type="submit"]:focus, body.wordpress #submit:focus, body.wordpress .button:focus',
									  '.header-aside-search.js-search .searchform i.fa-search',
									  '.site-title-line em',
									  '.menu-items ul li.current-menu-item > a, .menu-items ul li.current-menu-ancestor > a, .menu-items ul li:hover > a',
									  '.more-link, .more-link a',
									  '.more-link:hover, .more-link:hover a', // brevity : replaced by newvaldark in js
									  '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
									  '.topbanner-content mark',
									  '.slider-style2 .lSAction > a:hover',
									  '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button:hover, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button:hover',
									  '.widget .viewall a:hover',
									  '.hootkitslide-caption .hootkitslide-subtitle' . ',' . '.cta-subtitle',
									  '.content-block-subtitle',
									  '.content-block-icon i',
									),
			'border-color'	=> array( 'body.wordpress input[type="submit"], body.wordpress #submit, body.wordpress .button',
									  '#site-logo.logo-border',
									  '.menu-tag',
									  '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
									  '.lSSlideOuter ul.lSPager.lSpg > li a',
									  '.slider-style2 .lSAction > a',
									  '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button',
									  '.icon-style-circle',
									  '.icon-style-square',
									),
			'border-left-color'	=> array( '.widget_breadcrumb_navxt .breadcrumbs > .hoot-bcn-pretext:after' ),
			'background'	=> array( '.accent-typo',
									  'body.wordpress input[type="submit"], body.wordpress #submit, body.wordpress .button',
									  '.site-title-line mark',
									  '#infinite-handle span',
									  '.lrm-form a.button, .lrm-form button, .lrm-form button[type=submit], .lrm-form #buddypress input[type=submit], .lrm-form input[type=submit]',
									  '.widget_breadcrumb_navxt .breadcrumbs > .hoot-bcn-pretext',
									  '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover' . ',' . '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
									  '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
									  '.lSSlideOuter ul.lSPager.lSpg > li:hover a, .lSSlideOuter ul.lSPager.lSpg > li.active a',
									  '.lightSlider .wrap-light-on-dark .hootkitslide-head, .lightSlider .wrap-dark-on-light .hootkitslide-head',
									  '.slider-style2 .lSAction > a',
									  '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button',
									  '.content-block:hover .content-block-icon:not(.icon-custom-color)',
									),
		);
		if ( !$hootpload ) {
			array_push( $settings['accent_color']['color'], 'a', '.widget .view-all a:hover' );
			array_push( $settings['accent_color']['color'], 'a:hover', '.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover' ); // brevity : replaced by newvaldark in js
		} else {
			array_push( $settings['accent_color']['color'], '.wordpress .button-widget.preset-accent:hover' );
			array_push( $settings['accent_color']['background'], '.wordpress .button-widget.preset-accent', '.notice-widget.preset-accent' );
			array_push( $settings['accent_color']['border-color'], '.wordpress .button-widget.preset-accent' );
		}
		$settings['accent_font'] = array(
			'color'			=> array( '.accent-typo',
									  'body.wordpress input[type="submit"], body.wordpress #submit, body.wordpress .button',
									  '.site-title-line mark',
									  '#infinite-handle span',
									  '.lrm-form a.button, .lrm-form button, .lrm-form button[type=submit], .lrm-form #buddypress input[type=submit], .lrm-form input[type=submit]',
									  '.widget_breadcrumb_navxt .breadcrumbs > .hoot-bcn-pretext',
									  '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover a:hover' . ',' . '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
									  '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
									  '.lightSlider .wrap-light-on-dark .hootkitslide-head, .lightSlider .wrap-dark-on-light .hootkitslide-head',
									  '.slider-style2 .lSAction > a',
									  '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button',
									  '.sidebar .view-all-top.view-all-withtitle a, .sub-footer .view-all-top.view-all-withtitle a, .footer .view-all-top.view-all-withtitle a, .sidebar .view-all-top.view-all-withtitle a:hover, .sub-footer .view-all-top.view-all-withtitle a:hover, .footer .view-all-top.view-all-withtitle a:hover',
									  '.content-block:hover .content-block-icon:not(.icon-custom-color) i',
									),
			'background'	=> array( '.invert-accent-typo',
									  'body.wordpress input[type="submit"]:hover, body.wordpress #submit:hover, body.wordpress .button:hover, body.wordpress input[type="submit"]:focus, body.wordpress #submit:focus, body.wordpress .button:focus',
									  '.menu-items ul li.current-menu-item, .menu-items ul li.current-menu-ancestor, .menu-items ul li:hover',
									  '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
									  '.slider-style2 .lSAction > a:hover',
									  '.slider-style3 .lightSlider .wrap-light-on-dark a.hootkitslide-button:hover, .slider-style3 .lightSlider .wrap-dark-on-light a.hootkitslide-button:hover',
									  '.widget .viewall a:hover',
									),
		);
		if ( apply_filters( 'hoot_porto_menutag_inverthover', true ) ) {
			$settings['accent_color']['color'][] =
			$settings['accent_font']['background'][] =
			$settings['accent_font']['border-color'][] =
			'#header .menu-items li.current-menu-item > a .menu-tag, #header .menu-items li.current-menu-ancestor > a .menu-tag, #header .menu-items li:hover > a .menu-tag';
		}
		if ( apply_filters( 'hoot_porto_sidebarwidgettitle_accenttypo', true ) ) {
			$settings['accent_font']['color'][] =
			$settings['accent_color']['background'][] =
			$settings['accent_color']['border-color'][] =
				'.sidebar .widget-title' . ',' . '.sub-footer .widget-title, .footer .widget-title';
			$settings['accent_font']['background'][] =
			$settings['accent_color']['color'][] =
				'.sidebar .widget:hover .widget-title' . ',' . '.sub-footer .widget:hover .widget-title, .footer .widget:hover .widget-title';
		}
		if ( !$hootpload ) {
		} else {
			array_push( $settings['accent_font']['color'], '.wordpress .button-widget.preset-accent', '.notice-widget.preset-accent' );
			array_push( $settings['accent_font']['background'], '.wordpress .button-widget.preset-accent:hover' );
		}
		if ( !$hootpload ) {
			$settings['headings_fontface_style'] = array(
				'font-style'=> array( 'h1, h2, h3, h4, h5, h6, .title, .titlefont',
										  '.sidebar .widget-title, .sub-footer .widget-title, .footer .widget-title',
									),
			);
			$settings['headings_fontface_style_trans'] = array(
				'text-transform'=> array( 'h1, h2, h3, h4, h5, h6, .title, .titlefont',
										  '.sidebar .widget-title, .sub-footer .widget-title, .footer .widget-title',
									),
			);
			$settings['subheadings_fontface_style'] = array(
				'font-style'=> array( '.hoot-subtitle, .entry-byline, .hk-gridunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline' ),
			);
			$settings['subheadings_fontface_style_trans'] = array(
				'text-transform'=> array( '.hoot-subtitle, .entry-byline, .hk-gridunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline' ),
			);
		}

		$settings = apply_filters( 'hoot_customize_dynamic_selectors', $settings );
		wp_localize_script( 'hoot-customize-preview', 'hootInlineStyles', array( $handle, $settings, $hootpload ) );
	}
}
add_action( 'wp_enqueue_scripts', 'hoot_porto_customize_dynamic_cssrules', 999 );

/**
 * Callback Functions for customizer settings
 */

function hoot_porto_callback_logo_side( $control ) {
	$selector = $control->manager->get_setting('menu_location')->value();
	return ( $selector == 'top' || $selector == 'bottom' || $selector == 'none' ) ? true : false;
}
function hoot_porto_callback_logo_size( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'text' || $selector == 'mixed' ) ? true : false;
}
function hoot_porto_callback_site_title_icon( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'text' || $selector == 'custom' ) ? true : false;
}
function hoot_porto_callback_logo_image( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'image' || $selector == 'mixed' || $selector == 'mixedcustom' ) ? true : false;
}
function hoot_porto_callback_logo_image_width( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'mixed' || $selector == 'mixedcustom' ) ? true : false;
}
function hoot_porto_callback_logo_custom( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'custom' || $selector == 'mixedcustom' ) ? true : false;
}

/**
 * Callback Functions for selective refresh
 */

function hoot_porto_callback_archive_post_meta(){
	$metarray = hoot_get_mod('archive_post_meta');
	hoot_display_meta_info( $metarray, 'customizer' ); // Bug: the_author_posts_link() does not work in selective refresh
}
function hoot_porto_callback_post_meta(){
	$metarray = hoot_get_mod('post_meta');
	hoot_display_meta_info( $metarray, 'customizer' ); // Bug: the_author_posts_link() does not work in selective refresh
}
function hoot_porto_callback_page_meta(){
	$metarray = hoot_get_mod('page_meta');
	hoot_display_meta_info( $metarray, 'customizer' ); // Bug: the_author_posts_link() does not work in selective refresh
}