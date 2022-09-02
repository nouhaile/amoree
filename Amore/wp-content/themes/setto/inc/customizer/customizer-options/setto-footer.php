<?php
function setto_footer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer', 'setto'),
		) 
	);
	
	/*=========================================
	Footer Copyright
	=========================================*/	
	$wp_customize->add_section(
        'footer_copyright',
        array(
            'title' 		=> __('Footer Copyright','setto'),
			'panel'  		=> 'footer_section',
			'priority'      => 6,
		)
    );
	
	// Footer Copyright Head
	$wp_customize->add_setting(
		'footer_btm_copy_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text'
		)
	);

	$wp_customize->add_control(
	'footer_btm_copy_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','setto'),
			'section' => 'footer_copyright',
			'priority'  => 1,
		)
	);
	
	// Footer Copyright 
	$setto_foo_copy = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'setto' );
	$wp_customize->add_setting(
    	'footer_copyright',
    	array(
			'default' => $setto_foo_copy,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);	

	$wp_customize->add_control( 
		'footer_copyright',
		array(
		    'label'   		=> __('Copytight','setto'),
		    'section'		=> 'footer_copyright',
			'type' 			=> 'textarea',
			'transport'         => $selective_refresh,
			'priority'  => 1,
		)  
	);	
	
	
	// Footer Social Head
	$wp_customize->add_setting(
		'footer_payment_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_text',
			'priority'  => 11,
		)
	);

	$wp_customize->add_control(
	'footer_payment_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icon','setto'),
			'section' => 'footer_copyright',
		)
	);
	
	$wp_customize->add_setting( 
		'hs_footer_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'setto_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_footer_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'setto' ),
			'section'     => 'footer_copyright',
			'type'        => 'checkbox',
			'priority'  => 12,
		) 
	);	
	
}
add_action( 'customize_register', 'setto_footer' );
// Footer selective refresh
function setto_footer_partials( $wp_customize ){
	
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.copy-right-section .copy-right p',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'setto_footer_copyright_render_callback',
	) );	
	}
add_action( 'customize_register', 'setto_footer_partials' );

// copyright_content
function setto_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}