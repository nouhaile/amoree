<?php
/**
 * Blossom Magazine Theme Customizer
 *
 * @package Blossom_Magazine
 */

/**
 * Requiring customizer sections
*/

$blossom_magazine_sections     = array( 'info', 'site', 'footer', 'layout', 'appearance', 'general', 'home' );

foreach( $blossom_magazine_sections as $s ){
    require get_template_directory() . '/inc/customizer/' . $s . '.php';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blossom_magazine_customize_preview_js() {
	wp_enqueue_script( 'blossom-magazine-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'blossom_magazine_customize_preview_js' );

function blossom_magazine_customize_script(){
    $array = array(
        'home'    => get_permalink( get_option( 'page_on_front' ) ),
        'flushFonts'        => wp_create_nonce( 'blossom-magazine-local-fonts-flush' ),
    );
    
    wp_enqueue_style( 'blossom-magazine-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), BLOSSOM_MAGAZINE_THEME_VERSION );
    wp_enqueue_script( 'blossom-magazine-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );
    wp_localize_script( 'blossom-magazine-customize', 'blossom_magazine_cdata', $array );

    wp_localize_script( 'blossom-magazine-repeater', 'blossom_magazine_customize',
		array(
			'nonce' => wp_create_nonce( 'blossom_magazine_customize_nonce' )
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'blossom_magazine_customize_script' );

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

/**
 * Reset font folder
 *
 * @access public
 * @return void
 */
function blossom_magazine_ajax_delete_fonts_folder() {
    // Check request.
    if ( ! check_ajax_referer( 'blossom-magazine-local-fonts-flush', 'nonce', false ) ) {
        wp_send_json_error( 'invalid_nonce' );
    }
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_send_json_error( 'invalid_permissions' );
    }
    if ( class_exists( '\Blossom_Magazine_WebFont_Loader' ) ) {
        $font_loader = new \Blossom_Magazine_WebFont_Loader( '' );
        $removed = $font_loader->delete_fonts_folder();
        if ( ! $removed ) {
            wp_send_json_error( 'failed_to_flush' );
        }
        wp_send_json_success();
    }
    wp_send_json_error( 'no_font_loader' );
}
add_action( 'wp_ajax_blossom_magazine_flush_fonts_folder', 'blossom_magazine_ajax_delete_fonts_folder' );