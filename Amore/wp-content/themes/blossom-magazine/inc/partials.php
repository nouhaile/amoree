<?php
/**
 * Blossom Magazine Customizer Partials
 *
 * @package Blossom_Magazine
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blossom_magazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blossom_magazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'blossom_magazine_get_banner_subtitle' ) ) :
/**
 * Slider Read More
*/
function blossom_magazine_get_banner_subtitle(){
    return esc_html( get_theme_mod( 'banner_subtitle' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_banner_title' ) ) :
/**
 * Slider Read More
*/
function blossom_magazine_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_banner_content' ) ) :
/**
 * Slider Read More
*/
function blossom_magazine_get_banner_content(){
    return wp_kses_post( get_theme_mod( 'banner_content' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_banner_btn_label' ) ) :
/**
 * Slider Read More
*/
function blossom_magazine_get_banner_btn_label(){
    return esc_html( get_theme_mod( 'banner_btn_label' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_banner_btn_label_two' ) ) :
/**
 * Slider Read More
*/
function blossom_magazine_get_banner_btn_label_two(){
    return esc_html( get_theme_mod( 'banner_btn_label_two' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_blog_text' ) ) :
/**
 * Display Blog title
*/
function blossom_magazine_get_blog_text(){
    return esc_html( get_theme_mod( 'blog_text', __( 'Latest Articles', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_author_title' ) ) :
/**
 * Display blog readmore button
*/
function blossom_magazine_get_author_title(){
    return esc_html( get_theme_mod( 'author_title', __( 'About Author', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function blossom_magazine_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like...', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_related_portfolio_title' ) ) :
/**
 * Portfolio Related Projects Title
*/
function blossom_magazine_get_related_portfolio_title(){
    return esc_html( get_theme_mod( 'related_portfolio_title', __( 'Related Projects', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_cta_section_title' ) ) :
/**
 * CTA section title
*/
function blossom_magazine_get_cta_section_title(){
    return esc_html( get_theme_mod( 'cta_section_title' ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_cta_button' ) ) :
/**
 * CTA button label
*/
function blossom_magazine_get_cta_button(){
    return esc_html( get_theme_mod( 'cta_btn_lbl', __( 'Subscribe Now', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function blossom_magazine_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'blossom-magazine' );
        echo date_i18n( esc_html__( 'Y', 'blossom-magazine' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'blossom-magazine' );
    }
    echo '</span>'; 
}
endif;

if( ! function_exists( 'blossom_magazine_get_search_title' ) ) :
/**
 * Search Page Title
*/
function blossom_magazine_get_search_title(){
    return esc_html( get_theme_mod( 'search_title', __( 'Search Result For', 'blossom-magazine' ) ) );
}
endif;

if( ! function_exists( 'blossom_magazine_get_popular_cat_section_viewall_lbl' ) ) :
/**
 * Popular Category View all label
*/
function blossom_magazine_get_popular_cat_section_viewall_lbl(){
    return esc_html( get_theme_mod( 'popular_cat_section_viewall_lbl', __( 'View All', 'blossom-magazine' ) ) );
}
endif;