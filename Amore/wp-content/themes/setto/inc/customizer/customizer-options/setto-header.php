<?php
function setto_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_section', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header', 'setto'),
		) 
	);
	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'hdr_navigation',
        array(
        	'priority'      => 2,
            'title' 		=> __('Header Navigation','setto'),
			'panel'  		=> 'header_section',
		)
    );
	
	
	// Search
	$wp_customize->add_setting(
		'abv_hdr_search_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'abv_hdr_search_head',
		array(
			'type' => 'hidden',
			'label' => __('Search','setto'),
			'section' => 'hdr_navigation',
			'priority'  => 9,
		)
	);

	// Hide/Show
	$wp_customize->add_setting( 
		'hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'setto' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority' => 10,
		) 
	);
	
	
			
			
	// My Account
	$wp_customize->add_setting(
		'abv_hdr_acc_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'abv_hdr_acc_head',
		array(
			'type' => 'hidden',
			'label' => __('My Account','setto'),
			'section' => 'hdr_navigation',
			'priority'  => 11,
		)
	);

	// Hide/Show
	$wp_customize->add_setting( 
		'hs_hdr_acc' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_acc', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'setto' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority' => 12,
		) 
	);
	

	// Cart
	$wp_customize->add_setting(
		'abv_hdr_cart_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'abv_hdr_cart_head',
		array(
			'type' => 'hidden',
			'label' => __('Cart','setto'),
			'section' => 'hdr_navigation',
			'priority'  => 15,
		)
	);

	// Hide/Show
	$wp_customize->add_setting( 
		'hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'setto' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority' => 16,
		) 
	);

	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Sticky Header','setto'),
			'panel'  		=> 'header_section',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'sticky_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'sticky_head',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','setto'),
			'section' => 'sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'setto' ),
			'section'     => 'sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'setto_header_settings' );