<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

if ( ! function_exists( 'girlish_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Girlish 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function girlish_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'girlish_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'girlish_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Girlish 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function girlish_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'girlish_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'girlish_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Girlish 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function girlish_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'girlish_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'girlish_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Girlish 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function girlish_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

/**
 * Front Page Active Callbacks
 */


/*=======================hero_banner=====================*/
/**
 * Check if hero_banner section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_hero_banner_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[hero_banner_section_enable]' )->value() );
}

/*=======================featured shop=====================*/

/**
 * Check if featured_shop section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_featured_shop_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[featured_shop_section_enable]' )->value() );
}

/*=======================collection=====================*/

/**
 * Check if featured_shop section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_collection_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[collection_section_enable]' )->value() );
}

/*=======================testimonial=====================*/
/**
 * Check if testimonial section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_testimonial_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[testimonial_section_enable]' )->value() );
}

/*=========================latest posts=====================*/

/**
 * Check if magazine_popular_posts section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_latest_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[latest_posts_section_enable]' )->value() );
}


/**
 * Check if subscribe_now section is enabled.
 *
 * @since Girlish 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function girlish_is_subscribe_now_section_enable( $control ) {
	return ( $control->manager->get_setting( 'girlish_theme_options[subscribe_now_section_enable]' )->value() );
}
