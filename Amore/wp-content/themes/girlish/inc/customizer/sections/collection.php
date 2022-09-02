<?php
/**
 * Collections Section options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
if ( !class_exists('WooCommerce') ) {
    return;
}

// Add collection section
$wp_customize->add_section( 'girlish_collection_section',
    array(
        'title'             => esc_html__( 'Collection','girlish' ),
        'description'       => esc_html__( 'Note: To activate this section you need to install WooCommerce Plugin.', 'girlish' ),
        'panel'             => 'girlish_front_page_panel',
    )
);

// collection content enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[collection_section_enable]',
    array(
        'default'           =>  $options['collection_section_enable'],
        'sanitize_callback' => 'girlish_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize,
    'girlish_theme_options[collection_section_enable]',
        array(
            'label'             => esc_html__( 'Collection Section Enable', 'girlish' ),
            'section'           => 'girlish_collection_section',
            'on_off_label'      => girlish_switch_options(),
        )
    )
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[collection_section_enable]', array(
        'selector'      => '#girlish_collection_section .tooltiptext',
        'settings'      => 'girlish_theme_options[collection_section_enable]',
    ) );
}

// Collection title setting and control
$wp_customize->add_setting( 'girlish_theme_options[collection_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['collection_title'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[collection_title]', array(
    'label'             => esc_html__( 'Section Title', 'girlish' ),
    'section'           => 'girlish_collection_section',
    'active_callback'   => 'girlish_is_collection_section_enable',
    'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[collection_title]', array(
        'selector'            => '#girlish_collection_section .section-title',
        'settings'            => 'girlish_theme_options[collection_title]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'girlish_collection_title_partial',
    ) );
}

// Collection description setting and control
$wp_customize->add_setting( 'girlish_theme_options[collection_description]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['collection_description'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[collection_description]', array(
    'label'             => esc_html__( 'Section Description', 'girlish' ),
    'section'           => 'girlish_collection_section',
    'active_callback'   => 'girlish_is_collection_section_enable',
    'type'              => 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[collection_description]', array(
        'selector'            => '#girlish_collection_section .header-content',
        'settings'            => 'girlish_theme_options[collection_description]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'girlish_collection_title_partial',
    ) );
}

for( $i = 1 ; $i <= 5 ; $i++ ){

    $wp_customize->add_setting( 'girlish_theme_options[collection_content_product_' . $i . ']',
        array(
            'sanitize_callback' => 'girlish_sanitize_page',
        )
    );

    $wp_customize->add_control( new Girlish_Dropdown_Chooser( $wp_customize,
        'girlish_theme_options[collection_content_product_' . $i . ']',
            array(
                'label'             => sprintf( esc_html__( 'Select Product %d', 'girlish' ), $i ),
                'section'           => 'girlish_collection_section',
                'choices'           => girlish_product_choices(),
                'active_callback'   => 'girlish_is_collection_section_enable',
            )
        )
    );

	$wp_customize->add_setting( 'girlish_theme_options[collection_hr_'. $i .']',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control( new Girlish_Customize_Horizontal_Line( $wp_customize,
        'girlish_theme_options[collection_hr_'. $i .']',
            array(
                'section'         => 'girlish_collection_section',
                'active_callback' => 'girlish_is_collection_section_enable',
                'type'			  => 'hr'
            )
        )
    );

}
