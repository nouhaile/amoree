<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'girlish_menu', array(
	'title'             => esc_html__('Header Menu','girlish'),
	'description'       => esc_html__( 'Header Menu options.', 'girlish' ),
	'panel'             => 'nav_menus',
) );

// Menu sticky setting and control.
$wp_customize->add_setting( 'girlish_theme_options[menu_sticky]', array(
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	'default'           => $options['menu_sticky'],
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[menu_sticky]', array(
	'label'             => esc_html__( 'Make Menu Sticky', 'girlish' ),
	'section'           => 'girlish_menu',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

// Social Menu setting and control.
$wp_customize->add_setting( 'girlish_theme_options[social_menu]', array(
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	'default'           => $options['social_menu'],
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[social_menu]', array(
	'label'             => esc_html__( 'Social Menu Enable', 'girlish' ),
	'section'           => 'girlish_menu',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

// Popular deatination btn label setting and control
$wp_customize->add_setting( 'girlish_theme_options[menu_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['menu_btn_label'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[menu_btn_label]', array(
	'label'           	=> esc_html__( 'Button Label', 'girlish' ),
	'section'        	=> 'girlish_menu',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[menu_btn_label]', array(
		'selector'            => '#site-navigation .custom-button',
		'settings'            => 'girlish_theme_options[menu_btn_label]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_menu_btn_label_partial',
    ) );
}

$wp_customize->add_setting( 'girlish_theme_options[menu_btn_url]', array(
'sanitize_callback' => 'esc_url_raw',
	) );

$wp_customize->add_control( 'girlish_theme_options[menu_btn_url]', array(
	'label'           	=> esc_html__( 'Button URL', 'girlish' ),
	'section'        	=> 'girlish_menu',
	'type'				=> 'url',
) );