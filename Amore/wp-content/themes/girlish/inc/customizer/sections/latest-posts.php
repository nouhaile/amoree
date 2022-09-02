<?php
/**
 * Latest Posts options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add Latest Posts
$wp_customize->add_section( 'girlish_latest_posts_section', array(
	'title'             => esc_html__( 'Latest Posts','girlish' ),
	'description'       => esc_html__( 'Latest Posts options.', 'girlish' ),
	'panel'             => 'girlish_front_page_panel',
	) );

// latest post enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[latest_posts_section_enable]', array(
	'default'			=> 	$options['latest_posts_section_enable'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[latest_posts_section_enable]', array(
	'label'             => esc_html__( 'Latest Posts Enable', 'girlish' ),
	'section'           => 'girlish_latest_posts_section',
	'on_off_label' 		=> girlish_switch_options(),
	) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[latest_posts_section_enable]', array(
		'selector'      => '#girlish_latest_posts_section .tooltiptext',
		'settings'      => 'girlish_theme_options[latest_posts_section_enable]',
    ) );
}

// latest posts title setting and control
$wp_customize->add_setting( 'girlish_theme_options[latest_posts_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['latest_posts_title'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[latest_posts_title]', array(
    'label'             => esc_html__( 'Section Title', 'girlish' ),
    'section'           => 'girlish_latest_posts_section',
    'type'              => 'text',
	'active_callback'   => function( $control ) {
		return (
			 girlish_is_latest_posts_section_enable( $control )
		);
	},
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[latest_posts_title]', array(
        'selector'            => '#girlish_latest_posts_section .section-title',
        'settings'            => 'girlish_theme_options[latest_posts_title]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'girlish_latest_posts_section_title_partial',
    ) );
}

// long Excerpt length setting and control.
$wp_customize->add_setting( 'girlish_theme_options[latest_posts_excerpt_length]', array(
	'sanitize_callback' => 'girlish_sanitize_number_range',
	'validate_callback' => 'girlish_validate_long_excerpt',
	'default'			=> $options['latest_posts_excerpt_length'],
) );

$wp_customize->add_control( 'girlish_theme_options[latest_posts_excerpt_length]', array(
	'label'       		=> esc_html__( 'Excerpt Length', 'girlish' ),
	'description' 		=> esc_html__( 'Total description words to be displayed in latest posts.', 'girlish' ),
	'section'     		=> 'girlish_latest_posts_section',
	'active_callback' 	=> 'girlish_is_latest_posts_section_enable',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 1,
	),
) );

for ( $i = 1; $i <= 3; $i++ ) :

// hero posts drop down chooser control and setting
$wp_customize->add_setting( 'girlish_theme_options[latest_posts_content_post_' . $i . ']', array(
	'sanitize_callback' => 'girlish_sanitize_page',
	) );

$wp_customize->add_control( new Girlish_Dropdown_Chooser( $wp_customize, 'girlish_theme_options[latest_posts_content_post_' . $i . ']', array(
	'label'             => sprintf( esc_html__( 'Select Post %d', 'girlish' ), $i ),
	'section'           => 'girlish_latest_posts_section',
	'choices'			=> girlish_post_choices(),
	'active_callback'	=> 'girlish_is_latest_posts_section_enable',
	) ) );
endfor;


// Hero Banner title setting and control
$wp_customize->add_setting( 'girlish_theme_options[latest_posts_btn_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_btn_text'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[latest_posts_btn_text]', array(
	'label'           	=> esc_html__( 'Button Label', 'girlish' ),
	'section'        	=> 'girlish_latest_posts_section',
	'type'				=> 'text',
	'active_callback'   => function( $control ) {
		return (
			 girlish_is_latest_posts_section_enable( $control )
		);
	},
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[latest_posts_btn_text]', array(
		'selector'            => '#girlish_latest_posts_section .read-more .btn',
		'settings'            => 'girlish_theme_options[latest_posts_btn_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_latest_posts_section_btn_text_partial',
    ) );
}

$wp_customize->add_setting( 'girlish_theme_options[latest_posts_btn_url]',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control( 'girlish_theme_options[latest_posts_btn_url]',
	array(
		'label'           	=>  esc_html__( 'Button Link ', 'girlish' ),
		'section'        	=> 'girlish_latest_posts_section',
		'type'				=> 'url',
		'active_callback'   => function( $control ) {
			return (
				girlish_is_latest_posts_section_enable( $control )
			);
		},
	)
);