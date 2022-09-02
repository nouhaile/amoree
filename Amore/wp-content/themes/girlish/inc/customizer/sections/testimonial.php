<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add About section
$wp_customize->add_section( 'girlish_testimonial_section', array(
	'title'             => esc_html__( 'Testimonial','girlish' ),
	'description'       => esc_html__( 'Testimonial Section options.', 'girlish' ),
	'panel'             => 'girlish_front_page_panel',
) );

// About content enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[testimonial_section_enable]', array(
	'default'			=> 	$options['testimonial_section_enable'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[testimonial_section_enable]', array(
	'label'             => esc_html__( 'Testimonial Section Enable', 'girlish' ),
	'section'           => 'girlish_testimonial_section',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[testimonial_section_enable]', array(
		'selector'      => '#girlish_testimonial_section .tooltiptext',
		'settings'      => 'girlish_theme_options[testimonial_section_enable]',
    ) );
}

// Featured shop title setting and control
$wp_customize->add_setting( 'girlish_theme_options[testimonial_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['testimonial_title'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[testimonial_title]', array(
    'label'             => esc_html__( 'Section Title', 'girlish' ),
    'section'           => 'girlish_testimonial_section',
    'active_callback'   => 'girlish_is_testimonial_section_enable',
    'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[testimonial_title]', array(
        'selector'            => '#girlish_testimonial_section .section-title',
        'settings'            => 'girlish_theme_options[testimonial_title]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'girlish_testimonial_title_partial',
    ) );
}

// long Excerpt length setting and control.
$wp_customize->add_setting( 'girlish_theme_options[testimonial_excerpt_length]', array(
	'sanitize_callback' => 'girlish_sanitize_number_range',
	'validate_callback' => 'girlish_validate_long_excerpt',
	'default'			=> $options['testimonial_excerpt_length'],
	) );

$wp_customize->add_control( 'girlish_theme_options[testimonial_excerpt_length]', array(
	'label'       		=> esc_html__( 'Testimonial Excerpt Length', 'girlish' ),
	'description' 		=> esc_html__( 'Total description words to be displayed in about posts.', 'girlish' ),
	'section'     		=> 'girlish_testimonial_section',
	'active_callback' 	=> 'girlish_is_testimonial_section_enable',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
		),
	) );


// about pages drop down chooser control and setting
$wp_customize->add_setting( 'girlish_theme_options[testimonial_content_page]', array(
	'sanitize_callback' => 'girlish_sanitize_page',
) );

$wp_customize->add_control( new Girlish_Dropdown_Chooser( $wp_customize, 'girlish_theme_options[testimonial_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'girlish' ),
	'section'           => 'girlish_testimonial_section',
	'choices'			=> girlish_page_choices(),
	'active_callback'	=> 'girlish_is_testimonial_section_enable',
) ) );

// testimonial position
$wp_customize->add_setting( 'girlish_theme_options[testimonial_position]', array(
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'girlish_theme_options[testimonial_position]', array(
	'label'             =>  esc_html__( 'Position', 'girlish' ),
	'section'           => 'girlish_testimonial_section',
	'active_callback'	=> 'girlish_is_testimonial_section_enable',
) );