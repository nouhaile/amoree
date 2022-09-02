<?php
/**
 * Register sidebar widget areas for the theme
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot Porto
 * @subpackage Theme
 */

/* Register sidebars. */
add_action( 'widgets_init', 'hoot_porto_base_register_sidebars', 5 );
add_action( 'widgets_init', 'hoot_porto_frontpage_register_sidebars' );

/**
 * Registers sidebars.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hoot_porto_base_register_sidebars() {

	global $wp_version;
	if ( version_compare( $wp_version, '4.9.7', '>=' ) ) {
		$emstart = '<strong><em>'; $emend = '</strong></em>';
	} else $emstart = $emend = '';

	// Primary Sidebar
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-primary-sidebar',
			'name'         => _x( 'Primary Sidebar', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'The main sidebar used throughout the site.', 'hoot-porto' ),
		)
	);

	// Secondary Sidebar
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-secondary-sidebar',
			'name'         => _x( 'Secondary Sidebar', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'The secondary sidebar used throughout the site (if you are using a 3 column layout with 2 sidebars).', 'hoot-porto' ),
		)
	);

	// Topbar Left Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-topbar-left',
			'name'         => _x( 'Topbar Left', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'hoot-porto' ),
		)
	);

	// Topbar Right Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-topbar-right',
			'name'         => _x( 'Topbar Right', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'hoot-porto' ),
		)
	);

	// Header Side Widget Area
	$extramsg = ( hoot_get_mod( 'menu_location' ) != 'side' && hoot_get_mod( 'logo_side' ) == 'widget-area' ) ? '' : ' ' . $emstart . __( "This widget area is currently NOT VISIBLE on your site. To activate it, go to Appearance &gt; Customize &gt; Header &gt; 'Header Side' option", 'hoot-porto' ) . $emend;
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-header',
			'name'         => _x( 'Header Side', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'Appears in Header on right of logo', 'hoot-porto' ) . $extramsg,
		)
	);

	// Menu Side Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-menu-side',
			'name'         => _x( 'Menu Side', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'This is the tiny area next to menu (often used for displaying search, social icons or breadcrumbs)', 'hoot-porto' ),
		)
	);

	// Below Header Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-below-header-left',
			'name'         => _x( 'Below Header Left', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'This area is often used for displaying context specific menus, advertisements, and third party breadcrumb plugins.', 'hoot-porto' ),
		)
	);

	// Below Header Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-below-header-right',
			'name'         => _x( 'Below Header Right', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'This area is often used for displaying context specific menus, advertisements, and third party breadcrumb plugins.', 'hoot-porto' ),
		)
	);

	// Subfooter Widget Area
	hoot_register_sidebar(
		array(
			'id'           => 'hoot-sub-footer',
			'name'         => _x( 'Sub Footer', 'sidebar', 'hoot-porto' ),
			'description'  => __( 'Leave empty if you dont want to show subfooter.', 'hoot-porto' ),
		)
	);

	// Footer Columns
	$footercols = hoot_porto_get_footer_columns();

	if( $footercols ) :
		$alphas = range('a', 'z');
		for ( $i=0; $i < 4; $i++ ) :
			if ( isset( $alphas[ $i ] ) ) :
				hoot_register_sidebar(
					array(
						'id'           => 'hoot-footer-' . $alphas[ $i ],
						/* Translators: %s is the Footer ID */
						'name'         => sprintf( _x( 'Footer %s Column', 'sidebar', 'hoot-porto' ), strtoupper( $alphas[ $i ] ) ),
						/* Translators: %s is the Number of footer columns active */
						'description'  => ( $i < $footercols ) ? '' : ' ' . $emstart . sprintf( __( 'This column is currently NOT VISIBLE on your site. To activate it, go to Appearance &gt; Customize &gt; Footer &gt; Select a layout with more than %1$s columns', 'hoot-porto' ), $i ) . $emend,
					)
				);
			endif;
		endfor;
	endif;

}

/**
 * Registers frontpage widget areas.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hoot_porto_frontpage_register_sidebars() {

	$areas = array();
	global $wp_version;
	if ( version_compare( $wp_version, '4.9.7', '>=' ) ) {
		$emstart = '<strong><em>'; $emend = '</strong></em>';
	} else $emstart = $emend = '';

	/* Set up defaults */
	$defaults = apply_filters( 'hoot_porto_frontpage_widgetarea_ids', array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l' ) );
	$locations = apply_filters( 'hoot_porto_frontpage_widgetarea_names', array(
		__( 'Left', 'hoot-porto' ),
		__( 'Center Left', 'hoot-porto' ),
		__( 'Center', 'hoot-porto' ),
		__( 'Center Right', 'hoot-porto' ),
		__( 'Right', 'hoot-porto' ),
	) );

	// Get user settings
	$sections = hoot_sortlist( hoot_get_mod( 'frontpage_sections' ) );

	foreach ( $defaults as $key ) {
		$id = "area_{$key}";
		if ( empty( $sections[$id]['sortitem_hide'] ) ) {

			$columns = ( isset( $sections[$id]['columns'] ) ) ? $sections[$id]['columns'] : '';
			$count = count( explode( '-', $columns ) ); // empty $columns still returns array of length 1
			$location = '';

			for ( $c = 1; $c <= $count ; $c++ ) {
				switch ( $count ) {
					case 2: $location = ($c == 1) ? $locations[0] : $locations[4];
							break;
					case 3: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[2] : $locations[4]
							);
							break;
					case 4: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[1] : (
									($c == 3) ? $locations[3] : $locations[4]
								)
							);
				}
				/* Translators: 1 is the Area ID, 2 is its location */
				$areas[ $id . '_' . $c ] = sprintf( __( 'Frontpage - Widget Area %1$s %2$s', 'hoot-porto' ), strtoupper( $key ), $location );
			}

		}
	}

	foreach ( $areas as $key => $name ) {
		hoot_register_sidebar(
			array(
				'id'           => 'hoot-frontpage-' . $key,
				'name'         => $name,
				'description'  => __( 'You can reorder and change the number of columns in Appearance &gt; Customize &gt; Frontpage Modules', 'hoot-porto' ),
			)
		);
	}

}