<?php
/**
 * Active Callback
 * 
 * @package Blossom_Magazine
*/

if ( ! function_exists( 'blossom_magazine_banner_ac' ) ) :
/**
 * Active Callback for Banner Slider
*/
function blossom_magazine_banner_ac( $control ){
    $banner        = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type   = $control->manager->get_setting( 'slider_type' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_content' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'btn_one_new_tab' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_label_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'btn_two_new_tab' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_caption_layout' && $banner == 'static_banner' ) return true;

    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'include_repetitive_posts' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;              
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_speed' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'banner_hr' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    
    return false;
}
endif;

if ( ! function_exists( 'blossom_magazine_post_page_ac' ) ) :
/**
 * Active Callback for post/page
*/
function blossom_magazine_post_page_ac( $control ){
    
    $ed_related    = $control->manager->get_setting( 'ed_related' )->value();
    $ed_comment    = $control->manager->get_setting( 'ed_comments' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    if ( $control_id == 'toggle_comments' && $ed_comment == true ) return true;
    
    return false;
}
endif;

if ( ! function_exists( 'blossom_magazine_cta_ac' ) ) :
/**
 * Active callback for CTA Section
 */
function blossom_magazine_cta_ac( $control ){
    $icon_type      = $control->manager->get_setting( 'icon_type' )->value();
    $ed_cta         = $control->manager->get_setting( 'ed_cta_section' )->value();
    $control_id     = $control->id;

    if( $control_id == 'icon_type' && $ed_cta ) return true;
    if( $control_id == 'cta_font_color' && $ed_cta ) return true;
    if( $control_id == 'cta_bg_color' && $ed_cta ) return true;
    if( $control_id == 'cta_section_title' && $ed_cta ) return true;
    if( $control_id == 'cta_btn_lbl' && $ed_cta ) return true;
    if( $control_id == 'cta_btn_link' && $ed_cta ) return true;
    if( $control_id == 'cta_link_new_tab' && $ed_cta ) return true;
    if( $control_id == 'cta_image' && $icon_type == 'image' && $ed_cta ) return true;
    if( $control_id == 'cta_icon' && $icon_type == 'icon' && $ed_cta ) return true;
    if( $control_id == 'cta_text' && $icon_type == 'icon' && $ed_cta ) return true;

    return false;
    
}
endif;

if ( ! function_exists( 'blossom_magazine_pop_cat_ac' ) ) :
/**
 * Active callback for Popular Category Section
 */
function blossom_magazine_pop_cat_ac( $control ){
    $ed_category      = $control->manager->get_setting( 'ed_category_section' )->value();
    $control_id     = $control->id;

    if( $control_id == 'pop_cat_one' && $ed_category ) return true;
    if( $control_id == 'popular_cat_section_select_two' && $ed_category ) return true;
    if( $control_id == 'pop_cat_three' && $ed_category ) return true;
    if( $control_id == 'ed_show_author_popular_cat_section' && $ed_category ) return true;
    if( $control_id == 'ed_show_date_popular_cat_section' && $ed_category ) return true;
    if( $control_id == 'ed_image_crop_popular_cat_section' && $ed_category ) return true;
    if( $control_id == 'popular_cat_section_viewall_lbl' && $ed_category ) return true;
    if( $control_id == 'pop_cat_posts_no_l4' && $ed_category ) return true;

    return false;
}
endif;

/**
 * Active Callback for local fonts
*/
function blossom_magazine_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}