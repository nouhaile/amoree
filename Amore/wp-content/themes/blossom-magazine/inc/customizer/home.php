<?php
/**
 * Frontpage Settings
 *
 * @package Blossom_Magazine
 */

function blossom_magazine_customize_frontpage( $wp_customize ) {
    
    /** Banner Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Frontpage Settings', 'blossom-magazine' ),
        ) 
    );

    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'blossom-magazine' );
    $wp_customize->get_section( 'header_image' )->priority                 = 20;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'blossom_magazine_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'blossom_magazine_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'blossom_magazine_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'slider_banner',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'blossom-magazine' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'blossom-magazine' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'blossom-magazine' ),
                    'static_banner'    => __( 'Static/Video CTA Banner', 'blossom-magazine' ),
                    'slider_banner'    => __( 'Banner as Slider', 'blossom-magazine' ),
                ),
                'priority' => 5	
     		)            
		)
    );
    
    /** SubTitle */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Subtitle', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector'        => '.static-cta .banner-caption h5.subtitle',
        'render_callback' => 'blossom_magazine_get_banner_subtitle',
    ) );

    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.static-cta .banner-caption h2',
        'render_callback' => 'blossom_magazine_get_banner_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'banner_content',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_content',
        array(
            'label'           => __( 'Description', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_content', array(
        'selector' => '.static-cta .banner-caption .banner-desc',
        'render_callback' => 'blossom_magazine_get_banner_content',
    ) );
    
    /** Banner Label */
    $wp_customize->add_setting( 
        'banner_btn_label',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_label',
        array(
            'label'           => __( 'Button One Label', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_btn_label', array(
        'selector' => '.static-cta .banner-caption .btn-wrap .btn-cta.btn-1',
        'render_callback' => 'blossom_magazine_get_banner_btn_label',
    ) );

    /** Banner Link */
    $wp_customize->add_setting(
        'banner_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link',
        array(
            'label'           => __( 'Button One Link', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );

    $wp_customize->add_setting(
        'btn_one_new_tab',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'btn_one_new_tab',
			array(
				'section'         => 'header_image',
				'label'           => __( 'Open in a new tab', 'blossom-magazine' ),
				'description'     => __( 'Enable to open button one in a new tab.', 'blossom-magazine' ),
				'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
    );

     /** Banner Button Two Label */
     $wp_customize->add_setting( 
        'banner_btn_label_two',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_label_two',
        array(
            'label'           => __( 'Button Two Label', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_btn_label_two', array(
        'selector' => '.static-cta .banner-caption .btn-wrap .btn-cta.btn-2',
        'render_callback' => 'blossom_magazine_get_banner_btn_label_two',
    ) );

    /** Banner Button Two Link */
    $wp_customize->add_setting(
        'banner_link_two',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link_two',
        array(
            'label'           => __( 'Button Two Link', 'blossom-magazine' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'blossom_magazine_banner_ac'
        )
    );

    $wp_customize->add_setting(
        'btn_two_new_tab',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'btn_two_new_tab',
			array(
				'section'         => 'header_image',
				'label'           => __( 'Open in a new tab', 'blossom-magazine' ),
				'description'     => __( 'Enable to open button two in a new tab.', 'blossom-magazine' ),
				'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
    );

    $wp_customize->add_setting( 
        'banner_caption_layout', 
        array(
            'default'           => 'left',
            'sanitize_callback' => 'blossom_magazine_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Radio_Buttonset_Control(
            $wp_customize,
            'banner_caption_layout',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Banner Caption Alignment', 'blossom-magazine' ),
                'description' => __( 'Choose alignment for banner caption.', 'blossom-magazine' ),
                'choices'     => array(
                    'left'      => __( 'Left', 'blossom-magazine' ),
                    'center'    => __( 'Center', 'blossom-magazine' ),
                    'right'     => __( 'Right', 'blossom-magazine' ),
                ),
                'active_callback' => 'blossom_magazine_banner_ac' 
            )
        )
    );
    
    /** Slider Content Style */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	  => __( 'Slider Content Style', 'blossom-magazine' ),
    			'section' => 'header_image',
    			'choices' => array(
                    'latest_posts' => __( 'Latest Posts', 'blossom-magazine' ),
                    'cat'          => __( 'Category', 'blossom-magazine' )
                ),
                'active_callback' => 'blossom_magazine_banner_ac'	
     		)
		)
	);
    
    /** Slider Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	          => __( 'Slider Category', 'blossom-magazine' ),
    			'section'         => 'header_image',
    			'choices'         => blossom_magazine_get_categories(),
                'active_callback' => 'blossom_magazine_banner_ac'	
     		)
		)
	);
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 5,
            'sanitize_callback' => 'blossom_magazine_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Slider_Control( 
			$wp_customize,
			'no_of_slides',
			array(
				'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'blossom-magazine' ),
                'description' => __( 'Choose the number of slides you want to display', 'blossom-magazine' ),
                'choices'	  => array(
					'min' 	=> 1,
					'max' 	=> 21,
					'step'	=> 1,
				),
                'active_callback' => 'blossom_magazine_banner_ac'                 
			)
		)
	);
        
    /** HR */
    $wp_customize->add_setting(
        'banner_hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Note_Control( 
			$wp_customize,
			'banner_hr',
			array(
				'section'	  => 'header_image',
				'description' => '<hr/>',
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
    );
    
    /** Include Repetitive Posts */
    $wp_customize->add_setting(
        'include_repetitive_posts',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'include_repetitive_posts',
			array(
				'section'         => 'header_image',
				'label'           => __( 'Include Repetitive Posts', 'blossom-magazine' ),
				'description'     => __( 'Enable to add posts included in slider in blog page too.', 'blossom-magazine' ),
				'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
    );
    
    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'slider_auto',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Auto', 'blossom-magazine' ),
                'description' => __( 'Enable slider auto transition.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
	);
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'blossom-magazine' ),
                'description' => __( 'Enable slider loop.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
	);
    
    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'slider_caption',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Caption', 'blossom-magazine' ),
                'description' => __( 'Enable slider caption.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
	);
    
    /** Full Image */
    $wp_customize->add_setting(
        'slider_full_image',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'slider_full_image',
			array(
				'section'         => 'header_image',
				'label'           => __( 'Full Image', 'blossom-magazine' ),
                'description'     => __( 'Enable to use full size image in slider.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
	);
    
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_magazine_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Magazine_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'blossom-magazine' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'bounceOut'      => __( 'Bounce Out', 'blossom-magazine' ),
                    'bounceOutLeft'  => __( 'Bounce Out Left', 'blossom-magazine' ),
                    'bounceOutRight' => __( 'Bounce Out Right', 'blossom-magazine' ),
                    'bounceOutUp'    => __( 'Bounce Out Up', 'blossom-magazine' ),
                    'bounceOutDown'  => __( 'Bounce Out Down', 'blossom-magazine' ),
                    'fadeOut'        => __( 'Fade Out', 'blossom-magazine' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'blossom-magazine' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'blossom-magazine' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'blossom-magazine' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'blossom-magazine' ),
                    'flipOutX'       => __( 'Flip OutX', 'blossom-magazine' ),
                    'flipOutY'       => __( 'Flip OutY', 'blossom-magazine' ),
                    'hinge'          => __( 'Hinge', 'blossom-magazine' ),
                    'pulse'          => __( 'Pulse', 'blossom-magazine' ),
                    'rollOut'        => __( 'Roll Out', 'blossom-magazine' ),
                    'rotateOut'      => __( 'Rotate Out', 'blossom-magazine' ),
                    'rubberBand'     => __( 'Rubber Band', 'blossom-magazine' ),
                    'shake'          => __( 'Shake', 'blossom-magazine' ),
                    ''               => __( 'Slide', 'blossom-magazine' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'blossom-magazine' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'blossom-magazine' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'blossom-magazine' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'blossom-magazine' ),
                    'swing'          => __( 'Swing', 'blossom-magazine' ),
                    'tada'           => __( 'Tada', 'blossom-magazine' ),
                    'zoomOut'        => __( 'Zoom Out', 'blossom-magazine' ),
                    'zoomOutLeft'    => __( 'Zoom Out Left', 'blossom-magazine' ),
                    'zoomOutRight'   => __( 'Zoom Out Right', 'blossom-magazine' ),
                    'zoomOutUp'      => __( 'Zoom Out Up', 'blossom-magazine' ),
                    'zoomOutDown'    => __( 'Zoom Out Down', 'blossom-magazine' ),                    
                ),
                'active_callback' => 'blossom_magazine_banner_ac'                                	
     		)
		)
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default'           => 5000,
            'sanitize_callback' => 'blossom_magazine_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Slider_Control( 
            $wp_customize,
            'slider_speed',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Speed', 'blossom-magazine' ),
                'description' => __( 'Controls the speed of slider in miliseconds.', 'blossom-magazine' ),
                'choices'     => array(
                    'min'  => 1000,
                    'max'  => 20000,
                    'step' => 500,
                ),
                'active_callback' => 'blossom_magazine_banner_ac'
            )
        )
    );

    /** Banner Settings End */

    /** CTA Section */
    $wp_customize->add_section(
        'cta_section',
        array(
            'title'    => __( 'CTA Section', 'blossom-magazine' ),
            'priority' => 30,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting( 
        'ed_cta_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_cta_section',
            array(
                'section'     => 'cta_section',
                'label'	      => __( 'Enable CTA Section', 'blossom-magazine' ),	                 
            )
        )
    );

    $wp_customize->add_setting( 
        'icon_type', 
        array(
            'default'           => 'icon',
            'sanitize_callback' => 'blossom_magazine_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Radio_Buttonset_Control(
            $wp_customize,
            'icon_type',
            array(
                'section'	  => 'cta_section',
                'label'       => __( 'Choose an icon type', 'blossom-magazine' ),
                'description' => __( 'Upload an icon/image to be displayed before the text.', 'blossom-magazine' ),
                'choices'	  => array(
                    'image' => __( 'Image', 'blossom-magazine' ),
                    'icon'  => __( 'FontAwesome Icon', 'blossom-magazine' ),
                ),
                'active_callback' => 'blossom_magazine_cta_ac'
            )
        )
    );

    $wp_customize->add_setting(       
        'cta_image', 
        array(
            'default' => '',
            'sanitize_callback' => 'blossom_magazine_sanitize_image',
        )       
    );
    
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cta_image',
			array(
				'section'         => 'cta_section',
				'label'           => __( 'Upload Image/Icon', 'blossom-magazine' ),
				'active_callback' => 'blossom_magazine_cta_ac'
			)
		)
	);

    $wp_customize->add_setting(
        'cta_icon',
        array(
            'default'           => 'fas fa-location-arrow',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'cta_icon',
        array(
            'section'         => 'cta_section',
            'label'           => __( 'FontAwesome Icon Code', 'blossom-magazine' ),
            'description'     => __( 'Example: fas fa-location-arrow', 'blossom-magazine' ),
            'type'            => 'text',
            'active_callback' => 'blossom_magazine_cta_ac'
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'cta_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Note_Control( 
			$wp_customize,
			'cta_text',
			array(
				'section'         => 'cta_section',
				'description'     => sprintf( __( 'You can see the list of FontAwesome Icons %1$shere%2$s.', 'blossom-magazine' ), '<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free" target="_blank">', '</a>' ),
				'active_callback' => 'blossom_magazine_cta_ac'
			)
		)
    );

    $wp_customize->add_setting(
        'cta_section_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cta_section_title',
        array(
            'section' => 'cta_section',
            'label'   => __( 'Section Title', 'blossom-magazine' ),
            'type'    => 'text',
            'active_callback' => 'blossom_magazine_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_section_title', array(
        'selector'        => '.cta-section .cta-section-wrapper h2.section-titl',
        'render_callback' => 'blossom_magazine_get_cta_section_title',
    ) );
    
    $wp_customize->add_setting(
        'cta_btn_lbl',
        array(
            'default'           => __( 'Subscribe Now', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cta_btn_lbl',
        array(
            'section' => 'cta_section',
            'label'   => __( 'Button Label', 'blossom-magazine' ),
            'type'    => 'text',
            'active_callback' => 'blossom_magazine_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_btn_lbl', array(
        'selector'        => '.cta-section .cta-section-wrapper a.btn-cta',
        'render_callback' => 'blossom_magazine_get_cta_button',
    ) );

    $wp_customize->add_setting(
        'cta_btn_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control( 
        'cta_btn_link',
        array(
            'section'     => 'cta_section',
            'label'       => __( 'Button Link', 'blossom-magazine' ),
            'type'        => 'url',
            'active_callback' => 'blossom_magazine_cta_ac'
        )
    );

    $wp_customize->add_setting(
        'cta_link_new_tab',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'cta_link_new_tab',
            array(
                'section'         => 'cta_section',
                'label'           => __( 'Open Link in New Tab ', 'blossom-magazine' ),
                'description'     => __( 'Enable to open the link in a new tab.', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_cta_ac'
            )
        )
    );

    $wp_customize->add_setting( 'cta_bg_color' , [
		'default'           => '#fff9f9', // Use any HEX or RGBA value.
		'sanitize_callback' => 'sanitize_hex_color'
	] );

	$wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'cta_bg_color', 
            array(
                'label'           => __( 'CTA Background Color', 'blossom-magazine' ),
                'section'         => 'cta_section',
                'active_callback' => 'blossom_magazine_cta_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'cta_font_color', 
        array(
            'default'           => '#1A0101',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'cta_font_color', 
            array(
                'label'           => __( 'CTA Text Color', 'blossom-magazine' ),
                'section'         => 'cta_section',
                'active_callback' => 'blossom_magazine_cta_ac'
            )
        )
    );

    /** CTA Section Ends*/

    /** Popular Category Settings */

    $wp_customize->add_section(
        'popular_cat_section',
        array(
            'title'    => __( 'Popular Category Settings', 'blossom-magazine' ),
            'priority' => 50,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting( 
        'ed_category_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_category_section',
            array(
                'section'     => 'popular_cat_section',
                'label'	      => __( 'Enable Popular Category Section', 'blossom-magazine' ),	                 
            )
        )
    );

    $wp_customize->add_setting(
        'pop_cat_one',
        array(
            'default'			=> '',
            'sanitize_callback' => 'blossom_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Select_Control(
            $wp_customize,
            'pop_cat_one',
            array(
                'label'	          => esc_html__( 'Select Category', 'blossom-magazine' ),
                'section'         => 'popular_cat_section',
                'choices'         => blossom_magazine_get_categories( true, 'category', false ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'                 
            )
        )
    );

    $wp_customize->add_setting(
        'popular_cat_section_select_two',
        array(
            'default'			=> '',
            'sanitize_callback' => 'blossom_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Select_Control(
            $wp_customize,
            'popular_cat_section_select_two',
            array(
                'label'	          => esc_html__( 'Select Category', 'blossom-magazine' ),
                'section'         => 'popular_cat_section',
                'choices'         => blossom_magazine_get_categories( true, 'category', false ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
            )
        )
    );

    $wp_customize->add_setting(
        'pop_cat_three',
        array(
            'default'			=> '',
            'sanitize_callback' => 'blossom_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Select_Control(
            $wp_customize,
            'pop_cat_three',
            array(
                'label'	          => esc_html__( 'Select Category', 'blossom-magazine' ),
                'section'         => 'popular_cat_section',
                'choices'         => blossom_magazine_get_categories( true, 'category', false ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'ed_show_author_popular_cat_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_show_author_popular_cat_section',
            array(
                'section'         => 'popular_cat_section',
                'label'           => __( 'Show Author', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'ed_show_date_popular_cat_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_show_date_popular_cat_section',
            array(
                'section'         => 'popular_cat_section',
                'label'           => __( 'Show Posted Date', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'ed_image_crop_popular_cat_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_image_crop_popular_cat_section',
            array(
                'section'     => 'popular_cat_section',
                'label'	      => __( 'Automatic Image Crop', 'blossom-magazine' ),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
            )
        )
    );

    $wp_customize->add_setting(
        'popular_cat_section_viewall_lbl',
        array(
            'default'           => __( 'View All', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_cat_section_viewall_lbl',
        array(
            'type'            => 'text',
            'section'         => 'popular_cat_section',
            'label'           => __( 'View all button label', 'blossom-magazine' ),
            'active_callback' => 'blossom_magazine_pop_cat_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_cat_section_viewall_lbl', array(
        'selector'            => '#popular_cat_section .btn-wrapper a.btn-readmore',
        'render_callback'     => 'blossom_magazine_get_popular_cat_section_viewall_lbl',
    ) );

    $wp_customize->add_setting( 
        'pop_cat_posts_no_l4', 
        array(
            'default'           => 4,
            'sanitize_callback' => 'blossom_magazine_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Slider_Control( 
			$wp_customize,
			'pop_cat_posts_no_l4',
			array(
				'section'	  => 'popular_cat_section',
				'label'		  => __( 'Number of posts to be shown in this section', 'blossom-magazine' ),
                'choices'	  => array(
					'min' 	=> 2,
					'max' 	=> 8,
					'step'	=> 1,
				),
                'active_callback' => 'blossom_magazine_pop_cat_ac'
			)
		)
	);

    /** Popular Category Settings End */

}
add_action( 'customize_register', 'blossom_magazine_customize_frontpage' );