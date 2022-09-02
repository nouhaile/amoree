<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

$wp_customize->add_section( 'girlish_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','girlish' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'girlish' ),
	'panel'             => 'girlish_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'girlish_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'girlish' ),
	'section'          	=> 'girlish_breadcrumb',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'girlish_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'girlish_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'girlish' ),
	'active_callback' 	=> 'girlish_is_breadcrumb_enable',
	'section'          	=> 'girlish_breadcrumb',
) );
