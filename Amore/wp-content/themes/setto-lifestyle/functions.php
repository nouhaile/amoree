<?php
function setto_lifestyle_css() {
	$parent_style = 'setto-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'setto-lifestyle-style', get_stylesheet_uri(), array( $parent_style ));
	wp_enqueue_script('setto-lifestyle-custom-js',get_stylesheet_directory_uri().'/assets/js/custom.js', array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'setto_lifestyle_css',999);
   	

/**
 * Import Options From Parent Theme
 *
 */
function setto_lifestyle_parent_theme_options() {
	$setto_mods = get_option( 'theme_mods_setto' );
	if ( ! empty( $setto_mods ) ) {
		foreach ( $setto_mods as $setto_mod_k => $setto_mod_v ) {
			set_theme_mod( $setto_mod_k, $setto_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'setto_lifestyle_parent_theme_options' );


require( get_stylesheet_directory() . '/inc/customizer/customizer-pro/class-customize.php');