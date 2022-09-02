<?php
/**
 * Featured Shops Section options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
if ( !class_exists('WooCommerce') ) {
    return;
}

// Add featured_shop section
$wp_customize->add_section( 'girlish_featured_shop_section',
    array(
        'title'             => esc_html__( 'Featured Shop','girlish' ),
        'description'       => esc_html__( 'Note: To activate this section you need to install WooCommerce Plugin.', 'girlish' ),
        'panel'             => 'girlish_front_page_panel',
    )
);

// featured_shop content enable control and setting
$wp_customize->add_setting( 'girlish_theme_options[featured_shop_section_enable]',
    array(
        'default'           =>  $options['featured_shop_section_enable'],
        'sanitize_callback' => 'girlish_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Girlish_Switch_Control( $wp_customize,
    'girlish_theme_options[featured_shop_section_enable]',
        array(
            'label'             => esc_html__( 'Featured Shop Section Enable', 'girlish' ),
            'section'           => 'girlish_featured_shop_section',
            'on_off_label'      => girlish_switch_options(),
        )
    )
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[featured_shop_section_enable]', array(
        'selector'      => '#girlish_featured_shop_section .tooltiptext',
        'settings'      => 'girlish_theme_options[featured_shop_section_enable]',
    ) );
}

// Featured shop title setting and control
$wp_customize->add_setting( 'girlish_theme_options[featured_shop_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['featured_shop_title'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[featured_shop_title]', array(
    'label'             => esc_html__( 'Section Title', 'girlish' ),
    'section'           => 'girlish_featured_shop_section',
    'active_callback'   => 'girlish_is_featured_shop_section_enable',
    'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'girlish_theme_options[featured_shop_title]', array(
        'selector'            => '#girlish_featured_shop_section .section-title',
        'settings'            => 'girlish_theme_options[featured_shop_title]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'girlish_featured_shop_section_title_partial',
    ) );
}


for( $i = 1 ; $i <= 3; $i++ ){

    $wp_customize->add_setting( 'girlish_theme_options[featured_shop_content_product_' . $i . ']',
        array(
            'sanitize_callback' => 'girlish_sanitize_page',
        )
    );

    $wp_customize->add_control( new Girlish_Dropdown_Chooser( $wp_customize,
        'girlish_theme_options[featured_shop_content_product_' . $i . ']',
            array(
                'label'             => sprintf( esc_html__( 'Select Product %d', 'girlish' ), $i ),
                'section'           => 'girlish_featured_shop_section',
                'choices'           => girlish_product_choices(),
                'active_callback'   => 'girlish_is_featured_shop_section_enable',
            )
        )
    );

	$wp_customize->add_setting( 'girlish_theme_options[featured_shop_hr_'. $i .']',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control( new Girlish_Customize_Horizontal_Line( $wp_customize,
        'girlish_theme_options[featured_shop_hr_'. $i .']',
            array(
                'section'         => 'girlish_featured_shop_section',
                'active_callback' => 'girlish_is_featured_shop_section_enable',
                'type'			  => 'hr'
            )
        )
    );

}