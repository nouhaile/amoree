<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'girlish_layout', array(
	'title'               => esc_html__('Layout','girlish'),
	'description'         => esc_html__( 'Layout section options.', 'girlish' ),
	'panel'               => 'girlish_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'girlish_theme_options[site_layout]', array(
	'sanitize_callback'   => 'girlish_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Girlish_Custom_Radio_Image_Control ( $wp_customize, 'girlish_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'girlish' ),
	'section'             => 'girlish_layout',
	'choices'			  => girlish_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'girlish_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'girlish_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Girlish_Custom_Radio_Image_Control ( $wp_customize, 'girlish_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'girlish' ),
	'section'             => 'girlish_layout',
	'choices'			  => girlish_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'girlish_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'girlish_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Girlish_Custom_Radio_Image_Control ( $wp_customize, 'girlish_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'girlish' ),
	'section'             => 'girlish_layout',
	'choices'			  => girlish_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'girlish_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'girlish_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Girlish_Custom_Radio_Image_Control( $wp_customize, 'girlish_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'girlish' ),
	'section'             => 'girlish_layout',
	'choices'			  => girlish_sidebar_position(),
) ) );