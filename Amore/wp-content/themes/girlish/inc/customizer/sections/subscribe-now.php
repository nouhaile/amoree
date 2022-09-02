<?php
/**
 * Subscription Section options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add Subscription section
$wp_customize->add_section( 'girlish_subscribe_now_section', array(
	'title'             => esc_html__( 'Subscription','girlish' ),
	'description'       => esc_html__( 'Note: To activate this section you need to install Jetpack Plugin and activate subscription module.', 'girlish' ),
	'panel'             => 'girlish_front_page_panel',
) );

// Subscription content enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[subscribe_now_section_enable]', array(
	'default'			=> 	$options['subscribe_now_section_enable'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[subscribe_now_section_enable]', array(
	'label'             => esc_html__( 'Subscription Section Enable', 'girlish' ),
	'section'           => 'girlish_subscribe_now_section',
	'on_off_label' 		=> girlish_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'girlish_theme_options[subscribe_now_section_enable]', array(
		'selector'            => '#girlish_subscribe_now_section .tooltiptext',
		'settings'            => 'girlish_theme_options[subscribe_now_section_enable]',
    ) );
}

// Subscribe Background image setting
$wp_customize->add_setting('girlish_theme_options[subscribe_now_bg_image]',
    array(
        'sanitize_callback' => 'girlish_sanitize_image',
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,
    'girlish_theme_options[subscribe_now_bg_image]',
        array(
            'section'			=> 'girlish_subscribe_now_section',
            'label'				=> esc_html__( 'Background Image:', 'girlish' ),
            'active_callback' 	=> 'girlish_is_subscribe_now_section_enable',
        )
    )
);


// subscription description setting and control
$wp_customize->add_setting( 'girlish_theme_options[subscribe_now_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['subscribe_now_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[subscribe_now_sub_title]', array(
	'label'           	=> esc_html__( 'Description', 'girlish' ),
	'section'        	=> 'girlish_subscribe_now_section',
	'active_callback' 	=> 'girlish_is_subscribe_now_section_enable',
	'type'				=> 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[subscribe_now_sub_title]', array(
		'selector'            => '#subscribe-now .section-header .section-header p',
		'settings'            => 'girlish_theme_options[subscribe_now_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_subscribe_now_section_sub_title_partial',
    ) );
}

// subscription title setting and control
$wp_customize->add_setting( 'girlish_theme_options[subscribe_now_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['subscribe_now_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[subscribe_now_title]', array(
	'label'           	=> esc_html__( 'Title', 'girlish' ),
	'section'        	=> 'girlish_subscribe_now_section',
	'active_callback' 	=> 'girlish_is_subscribe_now_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[subscribe_now_title]', array(
		'selector'            => '#subscribe-now .section-header h2.section-title',
		'settings'            => 'girlish_theme_options[subscribe_now_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_subscribe_now_section_title_partial',
    ) );
}

// Hero Banner title setting and control
$wp_customize->add_setting( 'girlish_theme_options[subscribe_now_btn_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['subscribe_now_btn_text'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[subscribe_now_btn_text]', array(
	'label'           	=> esc_html__( 'Button Label', 'girlish' ),
	'section'        	=> 'girlish_subscribe_now_section',
	'active_callback' 	=> 'girlish_is_subscribe_now_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[subscribe_now_btn_text]', array(
		'selector'            => '#girlish_subscribe_now_section .read-more .btn',
		'settings'            => 'girlish_theme_options[subscribe_now_btn_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_subscribe_now_section_btn_text_partial',
    ) );
}