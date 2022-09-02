<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage Girlish
* @since Girlish 1.0.0
*/



// hero banner Section

if ( ! function_exists( 'girlish_hero_banner_section_sub_title_partial' ) ) :

    function girlish_hero_banner_section_sub_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['hero_banner_sub_title'] );
    }
endif;

if ( ! function_exists( 'girlish_hero_banner_section_btn_text_partial' ) ) :

    function girlish_hero_banner_section_btn_text_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['hero_banner_btn_text'] );
    }
endif;

if ( ! function_exists( 'girlish_hero_banner_section_alt_btn_text_partial' ) ) :

    function girlish_hero_banner_section_alt_btn_text_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['hero_banner_alt_btn_text'] );
    }
endif;

// Footer 

if ( ! function_exists( 'girlish_copyright_text_partial' ) ) :
    // copyright_text
    function girlish_copyright_text_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

if ( ! function_exists( 'girlish_menu_btn_label_partial' ) ) :
    // menu_btn_label
    function girlish_menu_btn_label_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['menu_btn_label'] );
    }
endif;

if ( ! function_exists( 'girlish_featured_shop_section_title_partial' ) ) :
    // featured_shop_title
    function girlish_featured_shop_section_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['featured_shop_title'] );
    }
endif;

if ( ! function_exists( 'girlish_collection_title_partial' ) ) :
    // collection_title
    function girlish_collection_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['collection_title'] );
    }
endif;

if ( ! function_exists( 'girlish_collection_description_partial' ) ) :
    // collection_description
    function girlish_collection_description_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['collection_description'] );
    }
endif;

if ( ! function_exists( 'girlish_testimonial_title_partial' ) ) :
    // testimonial_title
    function girlish_testimonial_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['testimonial_title'] );
    }
endif;

if ( ! function_exists( 'girlish_latest_posts_section_title_partial' ) ) :
    // latest_posts_title
    function girlish_latest_posts_section_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['latest_posts_title'] );
    }
endif;

if ( ! function_exists( 'girlish_latest_posts_section_btn_text_partial' ) ) :
    // latest_posts_btn_text
    function girlish_latest_posts_section_btn_text_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['latest_posts_btn_text'] );
    }
endif;

if ( ! function_exists( 'girlish_subscribe_now_section_sub_title_partial' ) ) :
    // subscribe_now_sub_title
    function girlish_subscribe_now_section_sub_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['subscribe_now_sub_title'] );
    }
endif;

if ( ! function_exists( 'girlish_subscribe_now_section_title_partial' ) ) :
    // subscribe_now_title
    function girlish_subscribe_now_section_title_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['subscribe_now_title'] );
    }
endif;

if ( ! function_exists( 'girlish_subscribe_now_section_btn_text_partial' ) ) :
    // subscribe_now_btn_text
    function girlish_subscribe_now_section_btn_text_partial() {
        $options = girlish_get_theme_options();
        return esc_html( $options['subscribe_now_btn_text'] );
    }
endif;
