<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'girlish_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'girlish' ),
		'priority'   			=> 900,
		'panel'      			=> 'girlish_theme_options_panel',
	)
);

// scroll top visible
$wp_customize->add_setting( 'girlish_theme_options[footer_enable]',
	array(
		'default'       		=> $options['footer_enable'],
		'sanitize_callback' => 'girlish_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[footer_enable]',
    array(
		'label'      			=> esc_html__( 'Foote section Enable', 'girlish' ),
		'section'    			=> 'girlish_section_footer',
		'on_off_label' 		=> girlish_switch_options(),
    )
) );


// footer copyright text
$wp_customize->add_setting( 'girlish_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'girlish_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'girlish_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'girlish' ),
		'section'    			=> 'girlish_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[copyright_text]', array(
		'selector'            => '#colophon .site-info span.copyright',
		'settings'            => 'girlish_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'girlish_copyright_text_partial',
    ) );
}

// Contact Background image setting
$wp_customize->add_setting('girlish_theme_options[footer_logo]',
    array(
        'sanitize_callback' => 'girlish_sanitize_image',
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,
    'girlish_theme_options[footer_logo]',
        array(
            'section'           => 'girlish_section_footer',
            'label'             => esc_html__( 'Footer Logo:', 'girlish' ),
        )
    )
);

// scroll top visible
$wp_customize->add_setting( 'girlish_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback' => 'girlish_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize, 'girlish_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'girlish' ),
		'section'    			=> 'girlish_section_footer',
		'on_off_label' 		=> girlish_switch_options(),
    )
) );