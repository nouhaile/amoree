<?php
/**
 * General Settings
 *
 * @package Blossom_Magazine
 */

function blossom_magazine_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'blossom-magazine' ),
            'description' => __( 'Customize Header, Social, SEO, Post/Page, Newsletter & Instagram, and Miscellaneous settings.', 'blossom-magazine' ),
        ) 
    );

     /** Header Settings */
     $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'blossom-magazine' ),
            'priority' => 5,
            'panel'    => 'general_settings',
        )
    );
    
    /** Header Search */
    $wp_customize->add_setting(
        'ed_header_search',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_header_search',
			array(
				'section'		=> 'header_settings',
				'label'			=> __( 'Header Search', 'blossom-magazine' ),
				'description'	=> __( 'Enable to display search form in header.', 'blossom-magazine' ),
			)
		)
	);

    /** Random Posts */
    $wp_customize->add_setting(
        'ed_random_posts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_random_posts',
            array(
                'section'		=> 'header_settings',
                'label'			=> __( 'Random Posts', 'blossom-magazine' ),
                'description'	=> __( 'Enable to show random posts button.', 'blossom-magazine' ),
            )
        )
    );
    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_sticky_header',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_sticky_header',
			array(
				'section'		=> 'header_settings',
				'label'			=> __( 'Sticky Header', 'blossom-magazine' ),
				'description'	=> __( 'Enable to stick header at top.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Header Settings Ends */ 
    
    /** Instagram Settings */
    $wp_customize->add_section(
        'instagram_settings',
        array(
            'title'    => __( 'Instagram Settings', 'blossom-magazine' ),
            'priority' => 70,
            'panel'    => 'general_settings',
        )
    );
    
    if( blossom_magazine_is_btif_activated() ){
        /** Enable Instagram Section */
        $wp_customize->add_setting( 
            'ed_instagram', 
            array(
                'default'           => false,
                'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Blossom_Magazine_Toggle_Control( 
    			$wp_customize,
    			'ed_instagram',
    			array(
    				'section'     => 'instagram_settings',
    				'label'	      => __( 'Instagram Section', 'blossom-magazine' ),
                    'description' => __( 'Enable to show Instagram Section', 'blossom-magazine' ),
    			)
    		)
    	);
        
        /** Note */
        $wp_customize->add_setting(
            'instagram_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Blossom_Magazine_Note_Control( 
    			$wp_customize,
    			'instagram_text',
    			array(
    				'section'	  => 'instagram_settings',
    				'description' => sprintf( __( 'You can change the setting BlossomThemes Social Feed %1$sfrom here%2$s.', 'blossom-magazine' ), '<a href="' . esc_url( admin_url( 'admin.php?page=class-blossomthemes-instagram-feed-admin.php' ) ) . '" target="_blank">', '</a>' )
    			)
    		)
        );        
    }else{
        $wp_customize->add_setting(
			'instagram_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Blossom_Magazine_Plugin_Recommend_Control(
				$wp_customize,
				'instagram_recommend',
				array(
					'section'     => 'instagram_settings',
					'capability'  => 'install_plugins',
					'plugin_slug' => 'blossomthemes-instagram-feed',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Social Feed%2$s. After that option related with this section will be visible.', 'blossom-magazine' ), '<strong>', '</strong>' ),
				)
			)
		);
    }

    /** Instagram Settings End */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'blossom-magazine' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );
    
    /** Search Page Title  */
    $wp_customize->add_setting(
        'search_title',
        array(
            'default'           => __( 'Search Result For', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'search_title',
        array(
            'label'       => __( 'Search Page Title', 'blossom-magazine' ),
            'description' => __( 'You can change title of your search page from here.', 'blossom-magazine' ),
            'section'     => 'misc_settings',
            'type'        => 'text',                                 
        )
    );

    $wp_customize->selective_refresh->add_partial( 'search_title', array(
        'selector'        => '.search .site-content .page-header__content-wrapper h1.page-title',
        'render_callback' => 'blossom_magazine_get_search_title',
    ) );

      /** Portfolio Related Projects Title  */
      $wp_customize->add_setting(
        'related_portfolio_title',
        array(
            'default'           => __( 'Related Projects', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'related_portfolio_title',
        array(
            'label'       => __( 'Portfolio Related Projects Title', 'blossom-magazine' ),
            'description' => __( 'You can change title of your portfolio related projects from here.', 'blossom-magazine' ),
            'section'     => 'misc_settings',
            'type'        => 'text',                                 
        )
    );

    $wp_customize->selective_refresh->add_partial( 'related_portfolio_title', array(
        'selector'        => '.related-portfolio .related-portfolio-title',
        'render_callback' => 'blossom_magazine_get_related_portfolio_title',
    ) );

    $wp_customize->add_setting( 
        'error_show_image',
        array(
            'default'           => get_template_directory_uri() . '/images/404-image.png',
            'sanitize_callback' => 'blossom_magazine_sanitize_image',
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Image_Control( 
            $wp_customize, 
            'error_show_image',
            array(
                'label'         => esc_html__( 'Add 404 Image', 'blossom-magazine' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 432px by 652px.', 'blossom-magazine' ),
                'section'       => 'misc_settings',
                'type'          => 'image',
            )
        )
    );

    /** Miscellaneous Settings End */

    /** Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => __( 'Newsletter Settings', 'blossom-magazine' ),
            'priority' => 60,
            'panel'    => 'general_settings',
        )
    );
    
    if( blossom_magazine_is_btnw_activated() ){
		
        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Blossom_Magazine_Toggle_Control( 
    			$wp_customize,
    			'ed_newsletter',
    			array(
    				'section'     => 'newsletter_settings',
    				'label'	      => __( 'Newsletter Section', 'blossom-magazine' ),
                    'description' => __( 'Enable to show Newsletter Section', 'blossom-magazine' ),
    			)
    		)
    	);
    
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'blossom-magazine' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'blossom-magazine' ),
            )
        ); 
	} else {
		$wp_customize->add_setting(
			'newsletter_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Blossom_Magazine_Plugin_Recommend_Control(
				$wp_customize,
				'newsletter_recommend',
				array(
					'section'     => 'newsletter_settings',
					'label'       => __( 'Newsletter Shortcode', 'blossom-magazine' ),
					'capability'  => 'install_plugins',
					'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'blossom-magazine' ), '<strong>', '</strong>' ),
				)
			)
		);
	}    
    /** Newsletter Settings Ends*/

    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'blossom-magazine' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_prefix_archive',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Prefix in Archive Page', 'blossom-magazine' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'blossom-magazine' ),
			)
		)
	);
    
    // Blog Title
    $wp_customize->add_setting(
        'blog_text',
        array(
            'default'           => __( 'Latest Articles', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'blog_text',
        array(
            'label'   => __( 'Blog Title', 'blossom-magazine' ),
            'section' => 'post_page_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_text', array(
        'selector'        => '.section-header .blog-title',
        'render_callback' => 'blossom_magazine_get_blog_text',
    ) );

    /** Blog Post Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_blog', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_crop_blog',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Blog Post Image Crop', 'blossom-magazine' ),
                'description' => __( 'Enable to avoid automatic cropping of featured image in home, archive and search posts.', 'blossom-magazine' ),
            )
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'blossom-magazine' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 15,
            'sanitize_callback' => 'blossom_magazine_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'blossom-magazine' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'blossom-magazine' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				)                 
			)
		)
	);
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'blossom-magazine' ), '<hr/>' ),
			)
		)
    );

    /** Single Post Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_single', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Magazine_Toggle_Control( 
            $wp_customize,
            'ed_crop_single',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Single Post Image Crop', 'blossom-magazine' ),
                'description' => __( 'Enable to avoid automatic cropping of featured image in single post.', 'blossom-magazine' ),
            )
        )
    );

    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'blossom-magazine' ),
                'description' => __( 'Enable to hide author section.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Author Section title */
    $wp_customize->add_setting(
        'author_title',
        array(
            'default'           => __( 'About Author', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'author_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Author Section Title', 'blossom-magazine' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'author_title', array(
        'selector' => '.author-section .author-section-title',
        'render_callback' => 'blossom_magazine_get_author_title',
    ) );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'blossom-magazine' ),
                'description' => __( 'Enable to show related posts in single page.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like...', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'blossom-magazine' ),
            'active_callback' => 'blossom_magazine_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .title',
        'render_callback' => 'blossom_magazine_get_related_title',
    ) );
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Comments', 'blossom-magazine' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'blossom-magazine' ),
			)
		)
    );
    
    /** Comments Below Post Content */
    $wp_customize->add_setting(
        'toggle_comments',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'toggle_comments',
			array(
				'section'         => 'post_page_settings',
				'label'           => __( 'Comments Below Post Content', 'blossom-magazine' ),
				'description'     => __( 'Enable to show comment section right after post content. Refresh site for changes.', 'blossom-magazine' ),
				'active_callback' => 'blossom_magazine_post_page_ac'
			)
		)
	);
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'blossom-magazine' ),
                'description' => __( 'Enable to hide category.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_post_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Post Author', 'blossom-magazine' ),
                'description' => __( 'Enable to hide post author.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'blossom-magazine' ),
                'description' => __( 'Enable to hide posted date.', 'blossom-magazine' ),
			)
		)
	);

    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'         => 'post_page_settings',
				'label'	          => __( 'Show Featured Image', 'blossom-magazine' ),
                'description'     => __( 'Enable to show featured image in post detail (single post).', 'blossom-magazine' ),
			)
		)
	);

    /** Posts(Blog) & Pages Settings Ends */

     /** SEO Settings */
     $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'blossom-magazine' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'blossom-magazine' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_breadcrumb',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Breadcrumb', 'blossom-magazine' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'blossom-magazine' ),
			)
		)
	);
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'blossom-magazine' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => __( 'Breadcrumb Home Text', 'blossom-magazine' ),
        )
    );  
    /** SEO Settings Ends */

     /** Social Media Settings */
     $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'blossom-magazine' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_magazine_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_media_settings',
				'label'	      => __( 'Enable Social Links', 'blossom-magazine' ),
                'description' => __( 'Enable to show social links at header.', 'blossom-magazine' ),
			)
		)
	);
    
    $wp_customize->add_setting( 
        new Blossom_Magazine_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Blossom_Magazine_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_media_settings',				
				'label'	  => __( 'Social Links', 'blossom-magazine' ),
				'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'blossom-magazine' ),
                        'description' => __( 'Example: fab fa-facebook-f', 'blossom-magazine' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'blossom-magazine' ),
                        'description' => __( 'Example: https://facebook.com', 'blossom-magazine' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'blossom-magazine' ),
                    'field' => 'link'
                )                        
			)
		)
	);
    /** Social Media Settings Ends */
}
add_action( 'customize_register', 'blossom_magazine_customize_register_general' );