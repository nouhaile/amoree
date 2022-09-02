<?php
if ( ! function_exists( 'sparkle_mart_customizer_option' ) ) {
	function sparkle_mart_customizer_option($wp_customize){

		$wp_customize->add_setting( 'sparklestore_service_title', array(

			'sanitize_callback' => 'sanitize_text_field',   //done

		));

		$wp_customize->add_control('sparklestore_service_title', array(

			'label'     => esc_html__( 'Title', 'sparkle-mart' ),
			'section'   => 'sparklestore_services_area',
			'type'      => 'text',
			'priority' => 11
		));


		$wp_customize->add_setting( 'sparklestore_service_description', array(

			'sanitize_callback' => 'sanitize_text_field',   //done

		));

		$wp_customize->add_control('sparklestore_service_description', array(

			'label'     => esc_html__( 'Description', 'sparkle-mart' ),
			'section'   => 'sparklestore_services_area',
			'type'      => 'text',
			'priority' => 11
		));

        $wp_customize->add_setting( 
			'sparklestore_service_layout',
			array(
				'default'           => 'layout_two',
				'sanitize_callback' => 'sparklestore_select_type_sanitize'
			) 
		);
		
		$wp_customize->add_control( 
			'sparklestore_service_layout',
			array(
				'type' => 'select',
				'label' => esc_html__( 'Layout', 'sparkle-mart' ),
				'section' => 'sparklestore_services_area',
				'choices' => array(
					'layout_one' => __('Layout One', 'sparkle-mart'),
					'layout_two' => __('Layout Two', 'sparkle-mart'),
				),
				'priority' => 11
			) 
		);


		$wp_customize->add_setting( 
			'sparklestore_service_column',
			array(
				'default'           => '3',
				'sanitize_callback' => 'sparklestore_select_type_sanitize'
			) 
		);
		
		$wp_customize->add_control( 
			'sparklestore_service_column',
			array(
				'type' => 'select',
				'label' => esc_html__( 'Column', 'sparkle-mart' ),
				'section' => 'sparklestore_services_area',
				'choices' => array(
					'1' => __('1', 'sparkle-mart'),
					'2' => __('2', 'sparkle-mart'),
					'3' => __('3', 'sparkle-mart'),
					'4' => __('4', 'sparkle-mart'),
					'5' => __('5', 'sparkle-mart'),
				),
				'priority' => 12
			) 
		);


		/** remove logo image */
		/** add title */
		$wp_customize->add_setting( 'sparkle_mart_social_title', array(
			'sanitize_callback' => 'sanitize_text_field',   //done
			'default' => __('Social Media', 'sparkle-mart')
		));

		$wp_customize->add_control('sparkle_mart_social_title', array(
			'label'     => esc_html__( 'Social Title', 'sparkle-mart' ),
			'section'   => 'sparklestore_footer_settings',
			'type'      => 'text',
			'priority' => 11
		));


		$wp_customize->add_setting( 'sparkle_mart_media_title', array(
			'sanitize_callback' => 'sanitize_text_field',   //done
		));

		$wp_customize->add_control('sparkle_mart_media_title', array(
			'label'     => esc_html__( 'Center Media Title', 'sparkle-mart' ),
			'section'   => 'sparklestore_footer_settings',
			'type'      => 'text',
			'priority' => 11
		));

		$wp_customize->add_setting( 'sparkle_mart_center_media', array(
            'default'       =>      '',
            'sanitize_callback' => 'esc_url_raw'  // done
        ));
       
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sparkle_mart_center_media', array(
            'section'       =>      'sparklestore_footer_settings',
            'label'         =>      esc_html__('Center Media', 'sparkle-mart'),
            'type'          =>      'image',
			'priority' => 11
        )));


		$wp_customize->add_setting( 'sparkle_mart_payment_title', array(
			'sanitize_callback' => 'sanitize_text_field',   //done
			'default' => __('Payment Option', 'sparkle-mart')
		));

		$wp_customize->add_control('sparkle_mart_payment_title', array(
			'label'     => esc_html__( 'Payment Title', 'sparkle-mart' ),
			'section'   => 'sparklestore_footer_settings',
			'type'      => 'text',
			'priority' => 11
		));

		$wp_customize->get_control('paymentlogo_image_one')->priority = 12;
		$wp_customize->get_control('paymentlogo_image_two')->priority = 12;
		$wp_customize->get_control('paymentlogo_image_three')->priority = 12;
		$wp_customize->get_control('paymentlogo_image_four')->priority = 12;
		$wp_customize->get_control('paymentlogo_image_five')->priority = 12;
		$wp_customize->get_control('paymentlogo_image_six')->priority = 12;
		
		$wp_customize->get_setting('sparklestore_footer_social_icon_payment_logo_option')->default="off";

		/** footer subscription form */
		$wp_customize->add_setting( 'sparkle_mart_footer_subscription', 
			array(
			'sanitize_callback' => 'sparklestore_sanitize_on_off',
			'default' => 'off'
		));

		$wp_customize->add_control( new Sparklestore_Switch_Control(  $wp_customize,  'sparkle_mart_footer_subscription', 
  			array(
			  'section'   => 'sparklestore_footer_settings',
			  'label'     => esc_html__( 'Subscription', 'sparkle-mart' ),
			  'on_off_label'  => array(
				'on'  => esc_html__( 'Enable', 'sparkle-mart' ),
				'off' => esc_html__( 'Disable', 'sparkle-mart' )
			  ),
			  'priority' => 13
			)
		));

		$wp_customize->add_setting( 'sparkle_mart_footer_subscription_title', array(
			'sanitize_callback' => 'sanitize_text_field',   //done
			'default' => __('SUBSCRIBE FOR OUR OFFER NEWS', 'sparkle-mart')
		));

		$wp_customize->add_control('sparkle_mart_footer_subscription_title', array(
			'label'     => esc_html__( 'Subscritpion Title', 'sparkle-mart' ),
			'section'   => 'sparklestore_footer_settings',
			'type'      => 'text',
			'priority' => 13
		));

		$wp_customize->add_setting( 'sparkle_mart_footer_subscription_shortcode', array(
			'sanitize_callback' => 'sanitize_text_field',   //done
			'default' => ''
		));

		$wp_customize->add_control('sparkle_mart_footer_subscription_shortcode', array(
			'label'     => esc_html__( 'Subscription ShortCode', 'sparkle-mart' ),
			'section'   => 'sparklestore_footer_settings',
			'type'      => 'text',
			'priority' => 13
		));
	}
}
add_action( 'customize_register' , 'sparkle_mart_customizer_option', 30 );