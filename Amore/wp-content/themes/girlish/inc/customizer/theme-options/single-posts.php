<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'girlish_single_post_section', array(
	'title'             => esc_html__( 'Single Post','girlish' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'girlish' ),
	'panel'             => 'girlish_theme_options_panel',
) );

// Tourableve date meta setting and control.
$wp_customize->add_setting( 'girlish_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'girlish' ),
	'section'           => 'girlish_single_post_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );

// Tourableve author meta setting and control.
$wp_customize->add_setting( 'girlish_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'girlish' ),
	'section'           => 'girlish_single_post_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );

// Tourableve author category setting and control.
$wp_customize->add_setting( 'girlish_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'girlish' ),
	'section'           => 'girlish_single_post_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );

// Tourableve tag category setting and control.
$wp_customize->add_setting( 'girlish_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'girlish' ),
	'section'           => 'girlish_single_post_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );

// single post image setting and controll
$wp_customize->add_setting( 'girlish_theme_options[single_post_hide_image]', array(
	'default'			=> $options['single_post_hide_image'],
	'sanitize_callback'	=> 'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_image]', array(
	'label'		=> esc_html__( 'Hide Image', 'girlish' ),
	'section'	=> 'girlish_single_post_section',
	'on_off_label'	=> girlish_hide_options(),
	) ) );

// single post description setting and control
$wp_customize->add_Setting( 'girlish_theme_options[single_post_hide_description]', array(
	'default'		=> $options['single_post_hide_description'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[single_post_hide_description]', array(
	'label'		=> esc_html__( 'Hide Description', 'girlish' ),
	'section'	=> 'girlish_single_post_section',
	'on_off_label'	=> girlish_hide_options(),
	) ) );