<?php
/**
 * Appearance Settings
 *
 * @package Blossom Magazine
 */

function blossom_magazine_customize_register_appearance( $wp_customize ) {
    
    $wp_customize->add_panel( 
        'appearance_settings', 
        array(
            'title'       => __( 'Appearance Settings', 'blossom-magazine' ),
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Change color and body background.', 'blossom-magazine' ),
        ) 
    );
    
    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#A60505',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'blossom-magazine' ),
                'description' => __( 'Primary color of the theme.', 'blossom-magazine' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#1A0101',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'blossom-magazine' ),
                'description' => __( 'Secondary color of the theme.', 'blossom-magazine' ),
                'section'     => 'colors',
                'priority'    => 6,
            )
        )
    );
    
    /** Footer Color*/
    $wp_customize->add_setting( 
        'footer_font_color', 
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'footer_font_color', 
            array(
                'label'   => __( 'Footer Text Color', 'blossom-magazine' ),
                'section' => 'colors',
            )
        )
    );

    /** Footer Background Color*/
    $wp_customize->add_setting( 
        'footer_bg_color', 
        array(
            'default'           => '#483434',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'footer_bg_color', 
            array(
                'label'   => __( 'Footer Background Color', 'blossom-magazine' ),
                'section' => 'colors',
            )
        )
    );

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'blossom-magazine' ),
            'priority' => 40,
            'panel'    => 'appearance_settings',
        )
    );

    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Questrial',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'blossom-magazine' ),
                'description' => __( 'Primary font of the site.', 'blossom-magazine' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_magazine_get_all_fonts(),	
     		)
		)
	);
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Source Serif Pro',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'blossom-magazine' ),
                'description' => __( 'Secondary font of the site.', 'blossom-magazine' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_magazine_get_all_fonts(),	
     		)
		)
	);  
        
    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'blossom_magazine_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Slider_Control( 
			$wp_customize,
			'font_size',
			array(
				'section'	  => 'typography_settings',
				'label'		  => __( 'Font Size', 'blossom-magazine' ),
				'description' => __( 'Change the font size of your site.', 'blossom-magazine' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 50,
					'step'	=> 1,
				)                 
			)
		)
	);

    /** Note */
    $wp_customize->add_setting(
        'typography_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Note_Control( 
			$wp_customize,
			'typography_text',
			array(
				'section'	  => 'typography_settings',
                'description' => sprintf( __( 'You can access the Google Fonts Library %1$sHere%2$s.', 'blossom-magazine' ), '<a href="' . esc_url("https://fonts.google.com/") . '" target="_blank">', '</a>' ),
			)
		)
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_localgoogle_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Load Google Fonts Locally', 'blossom-magazine' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'blossom-magazine' )
            )
        )
    );   

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_preload_local_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Preload Local Fonts', 'blossom-magazine' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'blossom-magazine' ); ?></span>
        
        <input type="button" class="button button-primary blossom-magazine-flush-local-fonts-button" name="blossom-magazine-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'blossom-magazine' ); ?>" />
    <?php
    $blossom_magazine_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'blossom-magazine' ),
            'section'       => 'typography_settings',
            'description'   => $blossom_magazine_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'blossom_magazine_ed_localgoogle_fonts'
        )
    );

    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel                          = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority                       = 20;
    $wp_customize->get_section( 'background_image' )->panel                = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority             = 30;
    
}
add_action( 'customize_register', 'blossom_magazine_customize_register_appearance' );