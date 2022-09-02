<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'girlish_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','girlish' ),
	'description'       => esc_html__( 'Archive section options.', 'girlish' ),
	'panel'             => 'girlish_theme_options_panel',
) );

// Archive post title setting and controll
$wp_customize->add_setting( 'girlish_theme_options[hide_title]', array(
	'default'			=> $options['hide_title'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hide_title]',
	array(
		'label'			=> esc_html__( 'Hide Title', 'girlish' ),
		'section'		=> 'girlish_archive_section',
		'on_off_label'	=> girlish_hide_options(),
		)
 ) );

 // Archive image setting and control.
$wp_customize->add_setting( 'girlish_theme_options[hide_image]', array(
	'default'				=> $options['hide_image'],
	'sanitize_callback'		=>'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hide_image]', array(
		'label'			=> esc_html__( 'Hide Image', 'girlish' ),
		'section'		=> 'girlish_archive_section',
		'on_off_label'	=> girlish_hide_options(),
	) ) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'girlish_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'girlish_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'girlish' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'girlish' ),
	'section'           => 'girlish_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'girlish_is_latest_posts'
) );



// Archive category setting and control.
$wp_customize->add_setting( 'girlish_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'girlish' ),
	'section'           => 'girlish_archive_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );



// Archive post description setting and controll
$wp_customize->add_setting( 'girlish_theme_options[hide_description]', array(
	'default'			=> $options['hide_description'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
	) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hide_description]',
	array(
		'label'			=> esc_html__( 'Hide Description', 'girlish' ),
		'section'		=> 'girlish_archive_section',
		'on_off_label'	=> girlish_hide_options(),
		)
 ) );

// Archive category setting and control.
$wp_customize->add_setting( 'girlish_theme_options[hide_date]', array(
	'default'           => $options['hide_date'],
	'sanitize_callback' => 'girlish_sanitize_switch_control',
) );

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[hide_date]', array(
	'label'             => esc_html__( 'Hide Post Date', 'girlish' ),
	'section'           => 'girlish_archive_section',
	'on_off_label' 		=> girlish_hide_options(),
) ) );

// read more text setting and control
$wp_customize->add_setting( 'girlish_theme_options[read_more_text]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['read_more_text'],
	)
);

$wp_customize->add_control( 'girlish_theme_options[read_more_text]',
	array(
		'label'           	=> esc_html__( 'Read More Text Label', 'girlish' ),
		'section'        	=> 'girlish_archive_section',
		'type'				=> 'text',
	)
);
