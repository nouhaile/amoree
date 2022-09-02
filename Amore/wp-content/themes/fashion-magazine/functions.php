<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * After setup theme hook
 */
function fashion_magazine_theme_setup(){

    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'fashion-magazine', get_stylesheet_directory() . '/languages' );

    /**
     * Add Custom Images sizes.
    */ 
    add_image_size( 'fashion-magazine-single-lay-two', 1140, 650, true );
}
add_action( 'after_setup_theme', 'fashion_magazine_theme_setup', 100 );

/**
 * Load assets.
 */
function fashion_magazine_enqueue_styles() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];
    
    wp_enqueue_style( 'blossom-magazine', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fashion-magazine', get_stylesheet_directory_uri() . '/style.css', array( 'blossom-magazine' ), $version );
    wp_enqueue_script( 'fashion-magazine', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), $version, true );
    
    $array = array( 
        'rtl'       => is_rtl(),
        'auto'      => (bool) get_theme_mod( 'slider_auto', false ),
        'loop'      => (bool) get_theme_mod( 'slider_loop', true ),
        'animation' => esc_attr( get_theme_mod( 'slider_animation' ) ),
        'speed'     => absint( get_theme_mod( 'slider_speed', 5000 ) ),
        'sticky'    => (bool) get_theme_mod( 'ed_sticky_header', false ),
    );
    
    wp_localize_script( 'fashion-magazine', 'fashion_magazine_data', $array );
}
add_action( 'wp_enqueue_scripts', 'fashion_magazine_enqueue_styles', 10 );

function fashion_magazine_remove_parent_filters(){
    remove_action( 'customize_register', 'blossom_magazine_customize_register_appearance' );
    remove_action( 'customize_register', 'blossom_magazine_customizer_theme_info' );
}
add_action( 'init', 'fashion_magazine_remove_parent_filters' );

/**
 * Layout Settings
 */
function fashion_magazine_customizer_register($wp_customize){

    $wp_customize->add_section( 'theme_info', 
        array(
            'title'    => __( 'Information Links', 'fashion-magazine' ),
            'priority' => 6,
        )
    );

    /** Important Links */
    $wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
    $theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'fashion-magazine' ),  '<a href="' . esc_url( 'https://blossomthemes.com/theme-demo/?theme=fashion-magazine' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'fashion-magazine' ),  '<a href="' . esc_url( 'https://docs.blossomthemes.com/fashion-magazine/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

    $wp_customize->add_control( new Blossom_Magazine_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );

    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
            array(
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'fashion-magazine' ),
            'description' => __( 'Customize Typography, Header Image & Background Image', 'fashion-magazine' ),
            ) 
    );

    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 20;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 30;

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'fashion-magazine' ),
            'priority' => 20,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
        'primary_font',
        array(
            'default'           => 'Inter',
            'sanitize_callback' => 'blossom_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Select_Control(
            $wp_customize,
            'primary_font',
            array(
                'label'       => __( 'Primary Font', 'fashion-magazine' ),
                'description' => __( 'Primary font of the site.', 'fashion-magazine' ),
                'section'     => 'typography_settings',
                'choices'     => blossom_magazine_get_all_fonts(), 
            )
        )
    );

    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font',
        array(
            'default'           => 'EB Garamond',
            'sanitize_callback' => 'blossom_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Magazine_Select_Control(
            $wp_customize,
            'secondary_font',
            array(
                'label'       => __( 'Secondary Font', 'fashion-magazine' ),
                'description' => __( 'Secondary font of the site.', 'fashion-magazine' ),
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
                'section'     => 'typography_settings',
                'label'       => __( 'Font Size', 'fashion-magazine' ),
                'description' => __( 'Change the font size of your site.', 'fashion-magazine' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 50,
                    'step'  => 1,
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
                'description' => sprintf( __( 'You can access the Google Fonts Library %1$sHere%2$s.', 'fashion-magazine' ), '<a href="' . esc_url("https://fonts.google.com/") . '" target="_blank">', '</a>' ),
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
                'label'         => __( 'Load Google Fonts Locally', 'fashion-magazine' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'fashion-magazine' )
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
                'label'         => __( 'Preload Local Fonts', 'fashion-magazine' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'fashion-magazine' ),
                'active_callback' => 'blossom_magazine_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'fashion-magazine' ); ?></span>
        
        <input type="button" class="button button-primary blossom-magazine-flush-local-fonts-button" name="blossom-magazine-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'fashion-magazine' ); ?>" />
    <?php
    $fashion_magazine_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'fashion-magazine' ),
            'section'       => 'typography_settings',
            'description'   => $fashion_magazine_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'blossom_magazine_ed_localgoogle_fonts'
        )
    );

    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#ea5f76',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'fashion-magazine' ),
                'description' => __( 'Primary color of the theme.', 'fashion-magazine' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#5bc7a9',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'fashion-magazine' ),
                'description' => __( 'Secondary color of the theme.', 'fashion-magazine' ),
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
                'label'   => __( 'Footer Text Color', 'fashion-magazine' ),
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
                'label'   => __( 'Footer Background Color', 'fashion-magazine' ),
                'section' => 'colors',
            )
        )
    );

    /** Layout Settings */
    $wp_customize->add_panel( 
        'layout_settings',
         array(
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Layout Settings', 'fashion-magazine' ),
            'description' => __( 'Change different page layout from here.', 'fashion-magazine' ),
        ) 
    );
    
    /** Header Layout Settings */
    $wp_customize->add_section(
        'header_layout_settings',
        array(
            'title'    => __( 'Header Layout', 'fashion-magazine' ),
            'priority' => 10,
            'panel'    => 'layout_settings',
        )
    );

    /** Header layout */
    $wp_customize->add_setting( 
        'header_layout', 
        array(
            'default'           => 'two',
            'sanitize_callback' => 'blossom_magazine_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Radio_Image_Control(
			$wp_customize,
			'header_layout',
			array(
				'section'	  => 'header_layout_settings',
				'label'		  => __( 'Header Layout', 'fashion-magazine' ),
				'description' => __( 'Choose the layout of the header for your site.', 'fashion-magazine' ),
				'choices'	  => array(
					'one'   => get_stylesheet_directory_uri() . '/images/header/one.jpg',
					'two'   => get_stylesheet_directory_uri() . '/images/header/two.jpg'
				)
			)
		)
	);

    /** Slider Layout Settings */
    $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'fashion-magazine' ),
            'priority' => 20,
            'panel'    => 'layout_settings',
        )
    );

    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'slider_layout', 
        array(
            'default'           => 'five',
            'sanitize_callback' => 'blossom_magazine_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Radio_Image_Control(
			$wp_customize,
			'slider_layout',
			array(
				'section'	  => 'slider_layout_settings',
				'label'		  => __( 'Slider Layout', 'fashion-magazine' ),
				'description' => __( 'Choose the layout of the slider for your site.', 'fashion-magazine' ),
				'choices'	  => array(
					'one'   => get_stylesheet_directory_uri() . '/images/slider/one.png',
                    'five'  => get_stylesheet_directory_uri() . '/images/slider/five.png'
				)
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
				'label'           => __( 'Full Image', 'fashion-magazine' ),
                'description'     => __( 'Enable to use full size image in slider.', 'fashion-magazine' ),
                'active_callback' => 'blossom_magazine_banner_ac'
			)
		)
	);

    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'home_layout_settings',
        array(
            'title'    => __( 'Home Page Layout', 'fashion-magazine' ),
            'priority' => 30,
            'panel'    => 'layout_settings',
        )
    );

    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'home_layout', 
        array(
            'default'           => 'three',
            'sanitize_callback' => 'blossom_magazine_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Magazine_Radio_Image_Control(
			$wp_customize,
			'home_layout',
			array(
				'section'	  => 'home_layout_settings',
				'label'		  => __( 'Home Page Layout', 'fashion-magazine' ),
				'description' => __( 'Choose the home page layout for your site.', 'fashion-magazine' ),
				'choices'	  => array(
                    'three'      => get_stylesheet_directory_uri() . '/images/home/three.png',
                    'five'       => get_stylesheet_directory_uri() . '/images/home/five.png'
				)
			)
		)
	);
    
    /** Move General sidebar layout section to Layout panel */
    $wp_customize->get_section( 'general_layout_settings' )->panel    = 'layout_settings';
    $wp_customize->get_section( 'general_layout_settings' )->title    = __( 'General Sidebar Layout', 'fashion-magazine');
    $wp_customize->get_section( 'general_layout_settings' )->priority = 40;

}
add_action( 'customize_register', 'fashion_magazine_customizer_register', 100 );

/**
 * Active Callback for Banner Slider
*/
function blossom_magazine_banner_ac( $control ){
    $banner        = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type   = $control->manager->get_setting( 'slider_type' )->value();
    $slider_layout = $control->manager->get_setting( 'slider_layout' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_content' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'btn_one_new_tab' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_label_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'btn_two_new_tab' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_caption_layout' && $banner == 'static_banner' ) return true;

    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'include_repetitive_posts' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;              
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_speed' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'banner_hr' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_full_image' && $slider_layout == 'five' ) return true;
    
    return false;
}

/**
 * Header Start
*/
function blossom_magazine_header(){ 
   
    $header_layout = get_theme_mod( 'header_layout', 'two' );
    $ed_random     = get_theme_mod( 'ed_random_posts', false ); ?>
    
    <header id="masthead" class="site-header style-<?php echo esc_attr( $header_layout ); ?>" itemscope itemtype="http://schema.org/WPHeader">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php
                    if ( $header_layout == 'two' ){
                        blossom_magazine_secondary_navigation();
                        blossom_magazine_random_posts_icon();
                    }else{
                        blossom_magazine_site_branding();
                    }
                    ?>
                </div>
                <?php if ( $header_layout == 'two' ) blossom_magazine_site_branding(); ?>
                <div class="header-right">
                    <?php
                    blossom_magazine_social_links();
                    blossom_magazine_search(); ?>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <?php 
                if ( $header_layout == 'one' ){
                    if( $ed_random ) echo '<div class="header-left-inner">';			
                        blossom_magazine_secondary_navigation();
                        blossom_magazine_random_posts_icon();
                    if( $ed_random) echo '</div>';
                }
                blossom_magazine_primary_navigation(); ?>
            </div>
        </div>
        <?php
        blossom_magazine_mobile_navigation();
        blossom_magazine_sticky_header();
        ?>
    </header>
    <?php
}

/**
 * Banner Section
 * 
*/
function blossom_magazine_get_banner(){
    $ed_banner      = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_layout  = get_theme_mod( 'slider_layout', 'five' );
    $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat     = get_theme_mod( 'slider_cat' );
    $posts_per_page = get_theme_mod( 'no_of_slides', 5 );
    $ed_caption     = get_theme_mod( 'slider_caption', true );
    $ed_full_image  = get_theme_mod( 'slider_full_image', false );

    $banner_title          = get_theme_mod( 'banner_title');
    $banner_subtitle       = get_theme_mod( 'banner_subtitle' );
    $banner_content        = get_theme_mod( 'banner_content');
    $banner_btn_one        = get_theme_mod( 'banner_btn_label' );
    $banner_link           = get_theme_mod( 'banner_link' );
    $btn_one_new_tab       = get_theme_mod( 'btn_one_new_tab', false );
    $banner_btn_two        = get_theme_mod( 'banner_btn_label_two' );
    $banner_link_two       = get_theme_mod( 'banner_link_two' );
    $btn_two_new_tab       = get_theme_mod( 'btn_two_new_tab', false );
    $banner_caption_layout = get_theme_mod( 'banner_caption_layout', 'left' );


    $target_one = $btn_one_new_tab ? 'target=_blank' : '';
    $target_two = $btn_two_new_tab ? 'target=_blank' : '';

    if( $slider_layout == 'five' ){
        $image_size = $ed_full_image ? 'full' : 'fashion-magazine-single-lay-two';
    }

    if( $ed_banner == 'static_banner' && has_custom_header() ){ ?>
        <div id="banner_section" class="site-banner banner<?php if( has_header_video() ) echo esc_attr( ' video-banner' ); ?><?php if( $ed_banner == 'static_banner' ) echo ' static-cta'; ?>">
            <div class="item <?php echo esc_attr( $banner_caption_layout ); ?>">
                <?php the_custom_header_markup(); ?>
                <div class="container"> 
                    <?php if( $ed_banner == 'static_banner' && ( $banner_title || $banner_subtitle || $banner_content || ( $banner_btn_one && $banner_link ) || ( $banner_btn_two && $banner_link_two ) ) ){ 
                        echo '<div class="banner-caption">';                       
                        if( $banner_subtitle ) echo '<h5 class="subtitle">' . esc_html( $banner_subtitle ) . '</h5>';
                        if( $banner_title ) echo '<h2>' . esc_html( $banner_title ) . '</h2>';
                        if( $banner_content ) echo '<div class="banner-desc">' . wp_kses_post( wpautop( $banner_content ) ) . '</div>'; 
                        if ( ( $banner_btn_one && $banner_link ) || ( $banner_btn_two && $banner_link_two )){ 
                            echo '<div class="btn-wrap">';         
                            if( $banner_btn_one && $banner_link ) echo '<a class="btn-cta btn-1" href="' . esc_url( $banner_link ) . '"'. esc_attr( $target_one ) . '>' . esc_html( $banner_btn_one ) . '</a>';
                            if( $banner_btn_two && $banner_link_two ) echo '<a class="btn-cta btn-2" href="' . esc_url( $banner_link_two ) . '"'. esc_attr( $target_two ) . '>' . esc_html( $banner_btn_two ) . '</a>';                  
                            echo '</div>';
                        }
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
    <?php
    }elseif( $ed_banner == 'slider_banner' ){
        if( $slider_type == 'latest_posts' || $slider_type == 'cat' ){
            
            $args = array(
                'post_status'         => 'publish',            
                'ignore_sticky_posts' => true
            );
            
            if( $slider_type === 'cat' && $slider_cat ){
                $args['post_type']      = 'post';
                $args['cat']            = $slider_cat; 
                $args['posts_per_page'] = -1;  
            }else{
                $args['post_type']      = 'post';
                $args['posts_per_page'] = $posts_per_page;
            }
                
            $qry = new WP_Query( $args );
            
            if( $qry->have_posts() ){ ?>
                <div id="banner_section" class="site-banner slider-<?php echo esc_attr( $slider_layout ); ?>">
                    <div class="container">            
                        <div id="banner-slider" class="banner-wrapper owl-carousel">                                                       
                            <?php 
                            if( $slider_layout == 'five' ){
                                while( $qry->have_posts() ){ $qry->the_post(); ?>
                                    <div class="item">
                                    <?php 
                                        echo '<div class="banner-img-wrap"><a href="' . esc_url( get_permalink() ) . '">';
                                        if( has_post_thumbnail() ){                                                      
                                            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );                                            
                                        }else{
                                            blossom_magazine_get_fallback_svg( $image_size );//fallback
                                        }  
                                        echo '</a></div>';
                                        
                                        if( $ed_caption ){ ?>                        
                                        <div class="banner-caption">                                      
                                            <div class="entry-meta">
                                                <?php blossom_magazine_category(); ?>
                                            </div>
                                            <?php the_title( '<h2 class="banner-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                                            <div class="entry-footer">
                                            <?php 
                                                blossom_magazine_posted_by();
                                                blossom_magazine_posted_on(); ?>
                                            </div>                        
                                        </div>
                                        <?php } ?>
                                    </div>
                                <?php } wp_reset_postdata();
                            }else{
                                blossom_magazine_banner_slider_layouts( $qry, $ed_caption );
                            }?>     
                        </div>                   
                    </div>  
                </div>
            <?php
            }
        }
    }
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blossom_magazine_body_classes( $classes ) {
	
	$editor_options      = get_option( 'classic-editor-replace' );
	$allow_users_options = get_option( 'classic-editor-allow-users' );
	$home_layout         = get_theme_mod( 'home_layout', 'three' );

    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if( get_background_image() ){
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    // Adds a class for single post layout.
    if( is_single() ) {
        $classes[] = 'style-one';
    }
    if ( is_home() && $home_layout == 'three'  ) {
        $classes[] = 'list list-layout';
    }
    // Adds a class for blog list layout.
    if ( ( is_home() && $home_layout == 'five' ) || ( is_archive() && !( blossom_magazine_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) || is_search() ) ) {
        $classes[] = 'list grid-layout';
    }

    if ( !blossom_magazine_is_classic_editor_activated() || ( blossom_magazine_is_classic_editor_activated() && $editor_options == 'block' ) || ( blossom_magazine_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'blossom-magazine-has-blocks';
    }

    $classes[] = blossom_magazine_sidebar( true );
    
	return $classes;
}

/**
 * Footer Bottom
*/
function blossom_magazine_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                blossom_magazine_get_footer_copyright();
                esc_html_e( ' Fashion Magazine | Developed By ', 'fashion-magazine' );
                echo '<span class="author-link"><a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'fashion-magazine' ) . '</a></span>.';
                printf( esc_html__( '%1$s Powered by %2$s%3$s.', 'fashion-magazine' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'fashion-magazine' ) ) .'" target="_blank">WordPress</a>', '</span>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <div class="footer-bottom-right">
                <?php 
                    blossom_magazine_footer_navigation();
                ?>
            </div>
		</div>
	</div>
    <?php
}

/**
 * Ajax Callback
 */
function blossom_magazine_dynamic_mce_css_ajax_callback(){
    
    /* Check nonce for security */
    $nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
    if( ! wp_verify_nonce( $nonce, 'blossom_magazine_dynamic_mce_nonce' ) ){
        die(); // don't print anything
    }

    $primary_font    = get_theme_mod( 'primary_font', 'Inter' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'EB Garamond' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $primary_color   = get_theme_mod( 'primary_color', '#ea5f76' );
    $secondary_color = get_theme_mod( 'secondary_color', '#5bc7a9' );
   
    $rgb  = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $primary_color ) );
    $rgb2 = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $secondary_color ) );
    
    /* Set File Type and Print the CSS Declaration */
    header( 'Content-type: text/css' );
    echo ':root .mce-content-body {
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
        --primary-color: ' . blossom_magazine_sanitize_hex_color( $primary_color ) . ';
        --primary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ) . ';
        --secondary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ) . ';
        --background-color: ' . sprintf( '%1$s, %2$s, %3$s', $rgb3[0], $rgb3[1], $rgb3[2] ) . ';
    }

    blockquote.wp-block-quote::before {
        background-image: url(\'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="127.432" height="110.665" viewBox="0 0 127.432 110.665"%3E%3Cg id="Group_1443" data-name="Group 1443" transform="translate(0 0)" opacity="0.3"%3E%3Cpath id="Path_5841" data-name="Path 5841" d="M194.147,345.773c-3.28,2.743-6.38,5.4-9.538,7.955-2.133,1.724-4.343,3.3-6.522,4.934-6.576,4.932-13.3,5.586-20.243,1.173-2.939-1.868-4.314-5.268-5.477-8.714a68.381,68.381,0,0,1-2.375-9.783c-.994-5.555-2.209-11.138-1.557-16.906.577-5.112,1.16-10.251,2.163-15.248a23.117,23.117,0,0,1,3.01-7.026c2.8-4.7,5.735-9.276,8.779-13.732a23.928,23.928,0,0,1,4.793-5.371c2.207-1.72,3.608-4.17,5.148-6.6,3.216-5.068,6.556-10.013,9.8-15.052a28.681,28.681,0,0,0,1.475-3.084c.163-.338.31-.795.563-.943,2.775-1.632,5.518-3.377,8.376-4.752,2.016-.97,3.528,1.238,5.25,2.057a3.4,3.4,0,0,1-.148,1.769c-1.535,3.621-3.138,7.2-4.71,10.8-3.534,8.085-7.357,16-10.514,24.308-3.248,8.542-6.275,17.324-6.5,27.026-.065,2.869.266,5.75.374,8.627.065,1.753,1.017,1.914,2.044,1.753a11.21,11.21,0,0,0,7.146-4.324c1.41-1.752,2.246-1.821,3.817-.239,2.013,2.029,3.923,4.218,5.856,6.367a1.677,1.677,0,0,1,.429,1.023c-.151,3.187-.352,6.379-2.323,8.826C191.077,343.331,191.107,343.7,194.147,345.773Z" transform="translate(-70.424 -252.194)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3Cpath id="Path_5842" data-name="Path 5842" d="M259.193,344.341c-4.6,5.231-8.984,10.521-15.185,12.561a11.207,11.207,0,0,0-3.233,2.286c-5.3,4.46-11.216,4.268-17.085,2.977-4.218-.928-6.7-5.277-7.252-10.588-.948-9.07.893-17.566,3.187-26,.1-.381.287-.73.373-1.114,1.88-8.435,5.937-15.587,9.2-23.164,2.257-5.249,5.674-9.732,8.694-14.758.6,1.231.936,2.1,1.4,2.854.947,1.552,2.144,1.065,2.942-.529a12.559,12.559,0,0,0,.69-2.028c.39-1.313,1.017-1.885,2.24-.981-.207-2.706-.034-5.343,2.121-6.4.81-.4,2.093.691,3.288,1.15.659-1.414,1.61-3.271,2.38-5.236a4.422,4.422,0,0,0-.234-2.1c-.3-1.353-.733-2.666-.974-4.032a11.511,11.511,0,0,1,1.917-8.21c1.1-1.825,2.033-3.8,3.059-5.687,2.014-3.709,4.517-4.035,7.155-.948a17.668,17.668,0,0,0,2.386,2.7,5.03,5.03,0,0,0,2.526.767,7.3,7.3,0,0,0,2.09-.458c-.477,1.277-.81,2.261-1.2,3.2-4.945,11.79-10.1,23.454-14.784,35.4-3.468,8.844-6.331,18.054-9.458,27.1a6.573,6.573,0,0,0-.226.964c-.649,3.651.393,4.769,3.4,4.056,2.592-.618,4.313-3.327,6.743-4.071a16.177,16.177,0,0,1,5.847-.563c1.236.087,2.6,3.97,2.248,6.047-.7,4.12-1.9,8.009-4.311,11.09C258.068,341.977,257.566,343.062,259.193,344.341Z" transform="translate(-216.183 -252.301)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3C/g%3E%3C/svg%3E%0A\');
    }';
    die(); // end ajax process.
}

/**
 * Gutenberg Dynamic Style
 */
function blossom_magazine_gutenberg_inline_style(){

    $primary_font    = get_theme_mod( 'primary_font', 'Inter' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'EB Garamond' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $primary_color    = get_theme_mod( 'primary_color', '#ea5f76' );
    $secondary_color  = get_theme_mod( 'secondary_color', '#5bc7a9' );

    $rgb  = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $primary_color ) );
    $rgb2 = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $secondary_color ) );
        
    $custom_css = ':root .block-editor-page {
        --primary-font: ' . esc_html($primary_fonts['font']) . ';
        --secondary-font: ' . esc_html($secondary_fonts['font']) . ';
        --primary-color: ' . blossom_magazine_sanitize_hex_color($primary_color) . ';
        --primary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2]) . ';
        --secondary-color: ' . blossom_magazine_sanitize_hex_color($secondary_color) . ';
        --secondary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2]) . ';
    }

    blockquote.wp-block-quote::before {
        background-image: url(\'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="127.432" height="110.665" viewBox="0 0 127.432 110.665"%3E%3Cg id="Group_1443" data-name="Group 1443" transform="translate(0 0)" opacity="0.3"%3E%3Cpath id="Path_5841" data-name="Path 5841" d="M194.147,345.773c-3.28,2.743-6.38,5.4-9.538,7.955-2.133,1.724-4.343,3.3-6.522,4.934-6.576,4.932-13.3,5.586-20.243,1.173-2.939-1.868-4.314-5.268-5.477-8.714a68.381,68.381,0,0,1-2.375-9.783c-.994-5.555-2.209-11.138-1.557-16.906.577-5.112,1.16-10.251,2.163-15.248a23.117,23.117,0,0,1,3.01-7.026c2.8-4.7,5.735-9.276,8.779-13.732a23.928,23.928,0,0,1,4.793-5.371c2.207-1.72,3.608-4.17,5.148-6.6,3.216-5.068,6.556-10.013,9.8-15.052a28.681,28.681,0,0,0,1.475-3.084c.163-.338.31-.795.563-.943,2.775-1.632,5.518-3.377,8.376-4.752,2.016-.97,3.528,1.238,5.25,2.057a3.4,3.4,0,0,1-.148,1.769c-1.535,3.621-3.138,7.2-4.71,10.8-3.534,8.085-7.357,16-10.514,24.308-3.248,8.542-6.275,17.324-6.5,27.026-.065,2.869.266,5.75.374,8.627.065,1.753,1.017,1.914,2.044,1.753a11.21,11.21,0,0,0,7.146-4.324c1.41-1.752,2.246-1.821,3.817-.239,2.013,2.029,3.923,4.218,5.856,6.367a1.677,1.677,0,0,1,.429,1.023c-.151,3.187-.352,6.379-2.323,8.826C191.077,343.331,191.107,343.7,194.147,345.773Z" transform="translate(-70.424 -252.194)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3Cpath id="Path_5842" data-name="Path 5842" d="M259.193,344.341c-4.6,5.231-8.984,10.521-15.185,12.561a11.207,11.207,0,0,0-3.233,2.286c-5.3,4.46-11.216,4.268-17.085,2.977-4.218-.928-6.7-5.277-7.252-10.588-.948-9.07.893-17.566,3.187-26,.1-.381.287-.73.373-1.114,1.88-8.435,5.937-15.587,9.2-23.164,2.257-5.249,5.674-9.732,8.694-14.758.6,1.231.936,2.1,1.4,2.854.947,1.552,2.144,1.065,2.942-.529a12.559,12.559,0,0,0,.69-2.028c.39-1.313,1.017-1.885,2.24-.981-.207-2.706-.034-5.343,2.121-6.4.81-.4,2.093.691,3.288,1.15.659-1.414,1.61-3.271,2.38-5.236a4.422,4.422,0,0,0-.234-2.1c-.3-1.353-.733-2.666-.974-4.032a11.511,11.511,0,0,1,1.917-8.21c1.1-1.825,2.033-3.8,3.059-5.687,2.014-3.709,4.517-4.035,7.155-.948a17.668,17.668,0,0,0,2.386,2.7,5.03,5.03,0,0,0,2.526.767,7.3,7.3,0,0,0,2.09-.458c-.477,1.277-.81,2.261-1.2,3.2-4.945,11.79-10.1,23.454-14.784,35.4-3.468,8.844-6.331,18.054-9.458,27.1a6.573,6.573,0,0,0-.226.964c-.649,3.651.393,4.769,3.4,4.056,2.592-.618,4.313-3.327,6.743-4.071a16.177,16.177,0,0,1,5.847-.563c1.236.087,2.6,3.97,2.248,6.047-.7,4.12-1.9,8.009-4.311,11.09C258.068,341.977,257.566,343.062,259.193,344.341Z" transform="translate(-216.183 -252.301)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3C/g%3E%3C/svg%3E%0A\');
    }';

    return $custom_css;
}

function blossom_magazine_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'Inter' );
    $ig_primary_font    = blossom_magazine_is_google_font( $primary_font );    
    $secondary_font     = get_theme_mod( 'secondary_font', ' EB Garamond' );
    $ig_secondary_font  = blossom_magazine_is_google_font( $secondary_font );    
    $site_title_font    = get_theme_mod( 'site_title_font', array( 'font-family'=>'EB Garamond', 'variant'=>'regular' ) );
    $ig_site_title_font = blossom_magazine_is_google_font( $site_title_font['font-family'] );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'fashion-magazine' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'fashion-magazine' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'fashion-magazine' );
    
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = blossom_magazine_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
         
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = blossom_magazine_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            
            if( ! empty( $site_title_font['variant'] ) ){
                $site_title_var = ':' . blossom_magazine_check_varient( $site_title_font['font-family'], $site_title_font['variant'] );    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font['font-family'] . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
    
    if( get_theme_mod( 'ed_localgoogle_fonts', false ) ) {
        $fonts_url = blossom_magazine_get_webfont_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
    }
     
    return esc_url( $fonts_url );
}

function blossom_magazine_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Inter' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'EB Garamond' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'EB Garamond', 'variant'=>'regular' ) );
    $site_title_fonts     = blossom_magazine_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
     
    $primary_color    = get_theme_mod( 'primary_color', '#ea5f76' );
	$secondary_color  = get_theme_mod( 'secondary_color', '#5bc7a9' );
    $site_title_color = get_theme_mod( 'site_title_color', '#111111' );
	$logo_width       = get_theme_mod( 'logo_width', 350 );
    
    $rgb = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $primary_color ) );
    $rgb2 = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $secondary_color ) );

    $cta_bg_color      = get_theme_mod( 'cta_bg_color', '#fff9f9' );
    $cta_font_color    = get_theme_mod( 'cta_font_color', '#1A0101' );
    
    $foot_bg_color   = get_theme_mod( 'footer_bg_color', '#483434' );
    $foot_font_color = get_theme_mod( 'footer_font_color', '#ffffff' );
    $rgb3            = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $foot_font_color ) );

    echo "<style type='text/css' media='all'>"; ?>
     
	:root {
		--primary-color: <?php echo blossom_magazine_sanitize_hex_color( $primary_color ); ?>;
		--primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
		--secondary-color: <?php echo blossom_magazine_sanitize_hex_color( $secondary_color ); ?>;
		--secondary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ); ?>;
        --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
        --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
        --footer-text-color: <?php echo blossom_magazine_sanitize_hex_color( $foot_font_color ); ?>;
        --footer-text-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb3[0], $rgb3[1], $rgb3[2] ); ?>;
	}
    
    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-title a{
		color: <?php echo blossom_magazine_sanitize_hex_color( $site_title_color ); ?>;
	}

	.custom-logo-link img{
        width    : <?php echo absint( $logo_width ); ?>px;
        max-width: 100%;
    }

    .cta-section .cta-section-wrapper {
        background: <?php echo blossom_magazine_sanitize_hex_color( $cta_bg_color ); ?>;
        color: <?php echo blossom_magazine_sanitize_hex_color( $cta_font_color ); ?>;
	}
    
    /*Typography*/
	
	body {
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }
    
    .btn-readmore::before, 
    .btn-link::before{
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='6.106' height='9.573' viewBox='0 0 6.106 9.573'%3E%3Cpath id='Path_29322' data-name='Path 29322' d='M0,0,4.9,4.083,0,8.165' transform='translate(0.704 0.704)' fill='none' stroke='<?php echo blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ); ?>' stroke-linecap='round' stroke-linejoin='round' stroke-width='1'/%3E%3C/svg%3E%0A");
    }

    .comments-area .comment-list .comment .comment-body .reply .comment-reply-link::before, 
    .comments-area ol .comment .comment-body .reply .comment-reply-link::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='6.106' height='9.573' viewBox='0 0 6.106 9.573'%3E%3Cpath id='Path_29322' data-name='Path 29322' d='M4.9,0,0,4.083,4.9,8.165' transform='translate(0.5 0.704)' fill='none' stroke='<?php echo blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ); ?>' stroke-linecap='round' stroke-linejoin='round' stroke-width='1'/%3E%3C/svg%3E%0A");
    }

    .footer-t .widget_bttk_image_text_widget .bttk-itw-holder li .btn-readmore ,
    .footer-t .widget_bttk_popular_post .style-three li .entry-header, 
    .footer-t .widget_bttk_pro_recent_post .style-three li .entry-header,
    .site-footer {
        background-color: <?php echo blossom_magazine_sanitize_hex_color( $foot_bg_color ); ?>;
    }

    <?php echo "</style>";
}