<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'girlish_pagination', array(
	'title'               => esc_html__('Pagination','girlish'),
	'description'         => esc_html__( 'Pagination section options.', 'girlish' ),
	'panel'               => 'girlish_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'girlish_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'girlish' ),
	'section'             => 'girlish_pagination',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'girlish_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'girlish_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'girlish_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'girlish' ),
	'section'             => 'girlish_pagination',
	'type'                => 'select',
	'choices'			  => girlish_pagination_options(),
	'active_callback'	  => 'girlish_is_pagination_enable',
) );
