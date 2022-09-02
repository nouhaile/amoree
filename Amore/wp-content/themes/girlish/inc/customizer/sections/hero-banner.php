<?php
/**
 * Hero Banner Section options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add Hero Banner section
$wp_customize->add_section( 'girlish_hero_banner_section', array(
	'title'             => esc_html__( 'Hero Banner','girlish' ),
	'description'       => esc_html__( 'Hero Banner Section options.', 'girlish' ),
	'panel'             => 'girlish_front_page_panel',
) );

// Hero Banner content enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[hero_banner_section_enable]', array(
	'default'			=> 	$options['hero_banner_section_enable'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hero_banner_section_enable]', array(
	'label'             => esc_html__( 'Hero Banner Section Enable', 'girlish' ),
	'section'           => 'girlish_hero_banner_section',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[hero_banner_section_enable]', array(
		'selector'      => '#girlish_hero_banner_section .tooltiptext',
		'settings'      => 'girlish_theme_options[hero_banner_section_enable]',
    ) );
}


// Hero Banner title setting and control
$wp_customize->add_setting( 'girlish_theme_options[hero_banner_btn_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['hero_banner_btn_text'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[hero_banner_btn_text]', array(
	'label'           	=> esc_html__( 'Button Label', 'girlish' ),
	'section'        	=> 'girlish_hero_banner_section',
	'active_callback' 	=> 'girlish_is_hero_banner_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[hero_banner_btn_text]', array(
		'selector'            => '#girlish_hero_banner_section .read-more .regular',
		'settings'            => 'girlish_theme_options[hero_banner_btn_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_hero_banner_section_btn_text_partial',
    ) );
}

$wp_customize->add_setting( 'girlish_theme_options[hero_banner_alt_btn_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['hero_banner_alt_btn_text'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[hero_banner_alt_btn_text]', array(
	'label'           	=> esc_html__( 'Alt Button Label', 'girlish' ),
	'section'        	=> 'girlish_hero_banner_section',
	'active_callback' 	=> 'girlish_is_hero_banner_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[hero_banner_alt_btn_text]', array(
		'selector'            => '#girlish_hero_banner_section .read-more .alt',
		'settings'            => 'girlish_theme_options[hero_banner_alt_btn_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_hero_banner_section_alt_btn_text_partial',
    ) );
}

$wp_customize->add_setting( 'girlish_theme_options[hero_banner_alt_btn_url]', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'girlish_theme_options[hero_banner_alt_btn_url]', array(
		'label'           	=> esc_html__( 'Alt Btn Url', 'girlish' ),
		'section'        	=> 'girlish_hero_banner_section',
		'active_callback' 	=> 'girlish_is_hero_banner_section_enable',
		'type'				=> 'url',
	) );

// long Excerpt length setting and control.
$wp_customize->add_setting( 'girlish_theme_options[hero_banner_excerpt_length]', array(
	'sanitize_callback' => 'girlish_sanitize_number_range',
	'validate_callback' => 'girlish_validate_long_excerpt',
	'default'			=> $options['hero_banner_excerpt_length'],
	) );

$wp_customize->add_control( 'girlish_theme_options[hero_banner_excerpt_length]', array(
	'label'       		=> esc_html__( 'Hero Banner Excerpt Length', 'girlish' ),
	'description' 		=> esc_html__( 'Total description words to be displayed in hero banner posts.', 'girlish' ),
	'section'     		=> 'girlish_hero_banner_section',
	'active_callback' 	=> 'girlish_is_hero_banner_section_enable',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
		),
	) );


// Hero Banner pages drop down chooser control and setting
$wp_customize->add_setting( 'girlish_theme_options[hero_banner_content_page]', array(
	'sanitize_callback' => 'girlish_sanitize_page',
) );

$wp_customize->add_control( new Girlish_Dropdown_Chooser( $wp_customize, 'girlish_theme_options[hero_banner_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'girlish' ),
	'section'           => 'girlish_hero_banner_section',
	'choices'			=> girlish_page_choices(),
	'active_callback'	=> 'girlish_is_hero_banner_section_enable',
) ) );
