<?php
/**
 * Blossom Magazine Custom functions and definitions
 *
 * @package Blossom_Magazine
 */

if ( ! function_exists( 'blossom_magazine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blossom_magazine_setup() {
    
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blossom Magazine, use a find and replace
	 * to change 'blossom-magazine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blossom-magazine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary', 'blossom-magazine' ),
        'secondary' => esc_html__( 'Secondary', 'blossom-magazine' ),
        'footer'    => esc_html__( 'Footer', 'blossom-magazine' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blossom_magazine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        apply_filters( 
            'blossom_magazine_custom_logo_args', 
            array( 
                'height'      => 70, /** change height as per theme requirement */
                'width'       => 70, /** change width as per theme requirement */
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => array( 'site-title', 'site-description' ) 
            )
        )

    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 
        'custom-header', 
        apply_filters( 
            'blossom_magazine_custom_header_args', 
            array(
                'default-image' => '',
                'video'         => true,
                'width'         => 1920, /** change width as per theme requirement */
                'height'        => 650, /** change height as per theme requirement */
                'header-text'   => false
            ) 
        ) 
    );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'blossom-magazine-slider-one', 350, 427, true );
    add_image_size( 'blossom-magazine-slider-one-a', 350, 274, true );
    add_image_size( 'blossom-magazine-single-full', 1920, 650, true );
    add_image_size( 'blossom-magazine-with-sidebar', 760, 570, true );
    add_image_size( 'blossom-magazine-blog-home-first', 760, 427, true );
    add_image_size( 'blossom-magazine-related', 365, 274, true );
    add_image_size( 'blossom-magazine-pop-cat', 320, 241, true );
    add_image_size( 'blossom-magazine-featured-cat-two', 360, 207, true );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add excerpt support for pages
    add_post_type_support( 'page', 'excerpt' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    /*
    * This theme styles the visual editor to resemble the theme style,
    * specifically font, colors, and column width.
    *
    */
    add_editor_style( array(
        'css' . $build . '/editor-style' . $suffix . '.css',
        blossom_magazine_fonts_url()
        )
    );

    // Add support for block editor styles.
    add_theme_support( 'wp-block-styles' );

    //Remove block widgets
    remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'blossom_magazine_setup' );

if( ! function_exists( 'blossom_magazine_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blossom_magazine_content_width() {
	
    $GLOBALS['content_width'] = apply_filters( 'blossom_magazine_content_width', 775 );
}
endif;
add_action( 'after_setup_theme', 'blossom_magazine_content_width', 0 );

if( ! function_exists( 'blossom_magazine_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function blossom_magazine_template_redirect_content_width(){
	$sidebar = blossom_magazine_sidebar();
    if( $sidebar ){	   
    
        $GLOBALS['content_width'] = 775;       
	}else{
    
        if( is_singular() ){
            if( blossom_magazine_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 775;
            }else{
                $GLOBALS['content_width'] = 1170;                
            }                
        }else{
            $GLOBALS['content_width'] = 1170;
        }
	}
}
endif;
add_action( 'template_redirect', 'blossom_magazine_template_redirect_content_width' );

if( ! function_exists( 'blossom_magazine_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function blossom_magazine_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    if( blossom_magazine_is_woocommerce_activated() )
    wp_enqueue_style( 'blossom-magazine-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), BLOSSOM_MAGAZINE_THEME_VERSION );
    
    if ( get_theme_mod( 'ed_localgoogle_fonts', false ) && ! is_customize_preview() && ! is_admin() && get_theme_mod( 'ed_preload_local_fonts', false ) ) {
        blossom_magazine_preload_local_fonts( blossom_magazine_fonts_url() );
    }

    wp_enqueue_style( 'blossom-magazine-google-fonts', blossom_magazine_fonts_url(), array(), null );
    wp_enqueue_style( 'all', get_template_directory_uri(). '/css/all.min.css', array(), '5.15.4' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.3.4' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), '3.5.2' );
    
    if ( blossom_magazine_is_elementor_activated() )
    wp_enqueue_style( 'blossom-magazine-elementor', get_template_directory_uri(). '/css' . $build . '/elementor' . $suffix . '.css', array(), BLOSSOM_MAGAZINE_THEME_VERSION );

    if ( is_singular() )
    wp_enqueue_style( 'blossom-magazine-gutenberg', get_template_directory_uri(). '/css' . $build . '/gutenberg' . $suffix . '.css', array(), BLOSSOM_MAGAZINE_THEME_VERSION );

    wp_enqueue_style( 'blossom-magazine', get_stylesheet_uri(), array(), BLOSSOM_MAGAZINE_THEME_VERSION );

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery', 'all' ), '6.1.1', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
    wp_enqueue_script( 'blossom-magazine', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );
	wp_enqueue_script( 'blossom-magazine-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );

    $array = array( 
        'url'           => admin_url( 'admin-ajax.php' ),
        'rtl'           => is_rtl(),
        'auto'          => (bool) get_theme_mod( 'slider_auto', false ),
        'loop'          => (bool) get_theme_mod( 'slider_loop', true ),
        'animation'     => esc_attr( get_theme_mod( 'slider_animation' ) ),
        'speed'         => absint( get_theme_mod( 'slider_speed', 5000 ) ),
        'sticky'        => (bool) get_theme_mod( 'ed_sticky_header', false ),
    );
    
    wp_localize_script( 'blossom-magazine', 'blossom_magazine_data', $array );
    
    if ( blossom_magazine_is_jetpack_activated( true ) ) {
        wp_enqueue_style( 'tiled-gallery', plugins_url() . '/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.css' );            
    }
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'blossom_magazine_scripts' );

if( ! function_exists( 'blossom_magazine_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function blossom_magazine_admin_scripts(){
    wp_enqueue_style( 'blossom-magazine-admin', get_template_directory_uri() . '/inc/css/admin.css', '', BLOSSOM_MAGAZINE_THEME_VERSION );  
}
endif; 
add_action( 'admin_enqueue_scripts', 'blossom_magazine_admin_scripts' );

if( ! function_exists( 'blossom_magazine_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function blossom_magazine_block_editor_styles() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    // Block styles.
    wp_enqueue_style( 'blossom-magazine-block-editor-style', get_template_directory_uri() . '/css' . $build . '/editor-block' . $suffix . '.css' );

    wp_add_inline_style( 'blossom-magazine-block-editor-style', blossom_magazine_gutenberg_inline_style() );

    // Add custom fonts.
    wp_enqueue_style( 'blossom-magazine-google-fonts', blossom_magazine_fonts_url(), array(), null );

}
endif;
add_action( 'enqueue_block_editor_assets', 'blossom_magazine_block_editor_styles' );
    

if( ! function_exists( 'blossom_magazine_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blossom_magazine_body_classes( $classes ) {
	
	$editor_options      = get_option( 'classic-editor-replace' );
	$allow_users_options = get_option( 'classic-editor-allow-users' );

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
    
    // Adds a class for blog list layout.
    if ( is_home() || ( is_archive() && !( blossom_magazine_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) || is_search() ) ) {
        $classes[] = 'list grid-layout';
    }

    if ( !blossom_magazine_is_classic_editor_activated() || ( blossom_magazine_is_classic_editor_activated() && $editor_options == 'block' ) || ( blossom_magazine_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'blossom-magazine-has-blocks';
    }

    $classes[] = blossom_magazine_sidebar( true );
    
	return $classes;
}
endif;
add_filter( 'body_class', 'blossom_magazine_body_classes' );

if( ! function_exists( 'blossom_magazine_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function blossom_magazine_post_classes( $classes ){
 
    if( is_single() && comments_open() ){
        $classes[] = 'has-meta';
    }
    
    return $classes;
}
endif;
add_filter( 'post_class', 'blossom_magazine_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blossom_magazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blossom_magazine_pingback_header' );

if( ! function_exists( 'blossom_magazine_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_magazine_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'blossom-magazine' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'blossom-magazine' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'blossom-magazine' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'blossom-magazine' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'blossom-magazine' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'blossom-magazine' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'blossom_magazine_change_comment_form_default_fields' );

if( ! function_exists( 'blossom_magazine_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_magazine_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'blossom-magazine' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'blossom-magazine' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'blossom_magazine_change_comment_form_defaults' );

if ( ! function_exists( 'blossom_magazine_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function blossom_magazine_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'blossom_magazine_excerpt_more' );

if ( ! function_exists( 'blossom_magazine_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function blossom_magazine_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 15 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'blossom_magazine_excerpt_length', 999 );

if( ! function_exists( 'blossom_magazine_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function blossom_magazine_exclude_cat( $query ){

    $ed_banner        = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_type      = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat       = get_theme_mod( 'slider_cat' );
    $posts_per_page   = get_theme_mod( 'no_of_slides', 5 );
    $repetitive_posts = get_theme_mod( 'include_repetitive_posts', true );
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() && ( $ed_banner == 'slider_banner' ) && ! $repetitive_posts ){
        if( $slider_type === 'cat' && $slider_cat  ){            
 			$query->set( 'category__not_in', array( $slider_cat ) );    		
        }elseif( $slider_type == 'latest_posts' ){
            $args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => $posts_per_page,
                'ignore_sticky_posts' => true
            );
            $latest = get_posts( $args );
            $excludes = array();
            foreach( $latest as $l ){
                array_push( $excludes, $l->ID );
            }
            $query->set( 'post__not_in', $excludes );
        }  
    }    
}
endif;
add_filter( 'pre_get_posts', 'blossom_magazine_exclude_cat' );

if( ! function_exists( 'blossom_magazine_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function blossom_magazine_get_the_archive_title( $title ){
   
    $ed_prefix = get_theme_mod( 'ed_prefix_archive', true );

    if( is_post_type_archive( 'product' ) ){
        $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
    }else{
        if( is_category() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Browse Category For', 'blossom-magazine' ) . '</span><h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }
        }
        elseif( is_tag() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Browse Tag For', 'blossom-magazine' ) . '</span><h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }
        }elseif( is_year() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-magazine' ) ) . '</h1>';                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Year', 'blossom-magazine' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-magazine' ) ) . '</h1>';
            }
        }elseif( is_month() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-magazine' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Month', 'blossom-magazine' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-magazine' ) ) . '</h1>';
            }
        }elseif( is_day() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-magazine' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Day', 'blossom-magazine' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-magazine' ) ) .  '</h1>';
            }
        }elseif( is_post_type_archive() ) {
            if( $ed_prefix ){
                $title = '<h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';                            
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Archives', 'blossom-magazine' ) . '</span><h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';
            }
        }elseif( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . single_term_title( '', false ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">' . $tax->labels->singular_name . '</span><h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
            }
        }
    }  
    
    return $title;
    
}
endif;
add_filter( 'get_the_archive_title', 'blossom_magazine_get_the_archive_title' );

if( ! function_exists( 'blossom_magazine_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function blossom_magazine_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'blossom_magazine_get_comment_author_link', 10, 3 );

if( ! function_exists( 'blossom_magazine_admin_notice' ) ) :
/**
 * Admin notice for getting started page.
*/
function blossom_magazine_admin_notice() {
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'blossom_magazine_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'blossom-magazine' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'blossom-magazine' ), esc_html( $name ) ); ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=blossom-magazine-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'blossom-magazine' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?blossom_magazine_admin_notice=1"><?php esc_html_e( 'Dismiss', 'blossom-magazine' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'blossom_magazine_admin_notice' );

if( ! function_exists( 'blossom_magazine_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function blossom_magazine_update_admin_notice(){
    if ( isset( $_GET['blossom_magazine_admin_notice'] ) && $_GET['blossom_magazine_admin_notice'] = '1' ) {
        update_option( 'blossom_magazine_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'blossom_magazine_update_admin_notice' );
    
if ( ! function_exists( 'blossom_magazine_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function blossom_magazine_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['blossom_magazine_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['blossom_magazine_customize_nonce'] ), 'blossom_magazine_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'blossom_magazine_customize_nonce', 'blossom_magazine_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = blossom_magazine_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_blossom_magazine_get_fontawesome_ajax', 'blossom_magazine_get_fontawesome_ajax' );

if ( ! function_exists( 'blossom_magazine_dynamic_mce_css' ) ) :
/**
 * Add Editor Style 
 * Add Link Color Option in Editor Style (MCE CSS)
 */
function blossom_magazine_dynamic_mce_css( $mce_css ){
    $mce_css .= ', ' . add_query_arg( array( 'action' => 'blossom_magazine_dynamic_mce_css', '_nonce' => wp_create_nonce( 'blossom_magazine_dynamic_mce_nonce', __FILE__ ) ), admin_url( 'admin-ajax.php' ) );
    return $mce_css;
}
endif;
add_filter( 'mce_css', 'blossom_magazine_dynamic_mce_css' );
     
if ( ! function_exists( 'blossom_magazine_dynamic_mce_css_ajax_callback' ) ) : 
/**
 * Ajax Callback
 */
function blossom_magazine_dynamic_mce_css_ajax_callback(){
    
    /* Check nonce for security */
    $nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
    if( ! wp_verify_nonce( $nonce, 'blossom_magazine_dynamic_mce_nonce' ) ){
        die(); // don't print anything
    }

    $primary_font    = get_theme_mod( 'primary_font', 'Questrial' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Source Serif Pro' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $primary_color   = get_theme_mod( 'primary_color', '#A60505' );
    $secondary_color = get_theme_mod( 'secondary_color', '#1A0101' );
   
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
    }

    
    blockquote.wp-block-quote::before {
        background-image: url(\'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="127.432" height="110.665" viewBox="0 0 127.432 110.665"%3E%3Cg id="Group_1443" data-name="Group 1443" transform="translate(0 0)" opacity="0.3"%3E%3Cpath id="Path_5841" data-name="Path 5841" d="M194.147,345.773c-3.28,2.743-6.38,5.4-9.538,7.955-2.133,1.724-4.343,3.3-6.522,4.934-6.576,4.932-13.3,5.586-20.243,1.173-2.939-1.868-4.314-5.268-5.477-8.714a68.381,68.381,0,0,1-2.375-9.783c-.994-5.555-2.209-11.138-1.557-16.906.577-5.112,1.16-10.251,2.163-15.248a23.117,23.117,0,0,1,3.01-7.026c2.8-4.7,5.735-9.276,8.779-13.732a23.928,23.928,0,0,1,4.793-5.371c2.207-1.72,3.608-4.17,5.148-6.6,3.216-5.068,6.556-10.013,9.8-15.052a28.681,28.681,0,0,0,1.475-3.084c.163-.338.31-.795.563-.943,2.775-1.632,5.518-3.377,8.376-4.752,2.016-.97,3.528,1.238,5.25,2.057a3.4,3.4,0,0,1-.148,1.769c-1.535,3.621-3.138,7.2-4.71,10.8-3.534,8.085-7.357,16-10.514,24.308-3.248,8.542-6.275,17.324-6.5,27.026-.065,2.869.266,5.75.374,8.627.065,1.753,1.017,1.914,2.044,1.753a11.21,11.21,0,0,0,7.146-4.324c1.41-1.752,2.246-1.821,3.817-.239,2.013,2.029,3.923,4.218,5.856,6.367a1.677,1.677,0,0,1,.429,1.023c-.151,3.187-.352,6.379-2.323,8.826C191.077,343.331,191.107,343.7,194.147,345.773Z" transform="translate(-70.424 -252.194)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3Cpath id="Path_5842" data-name="Path 5842" d="M259.193,344.341c-4.6,5.231-8.984,10.521-15.185,12.561a11.207,11.207,0,0,0-3.233,2.286c-5.3,4.46-11.216,4.268-17.085,2.977-4.218-.928-6.7-5.277-7.252-10.588-.948-9.07.893-17.566,3.187-26,.1-.381.287-.73.373-1.114,1.88-8.435,5.937-15.587,9.2-23.164,2.257-5.249,5.674-9.732,8.694-14.758.6,1.231.936,2.1,1.4,2.854.947,1.552,2.144,1.065,2.942-.529a12.559,12.559,0,0,0,.69-2.028c.39-1.313,1.017-1.885,2.24-.981-.207-2.706-.034-5.343,2.121-6.4.81-.4,2.093.691,3.288,1.15.659-1.414,1.61-3.271,2.38-5.236a4.422,4.422,0,0,0-.234-2.1c-.3-1.353-.733-2.666-.974-4.032a11.511,11.511,0,0,1,1.917-8.21c1.1-1.825,2.033-3.8,3.059-5.687,2.014-3.709,4.517-4.035,7.155-.948a17.668,17.668,0,0,0,2.386,2.7,5.03,5.03,0,0,0,2.526.767,7.3,7.3,0,0,0,2.09-.458c-.477,1.277-.81,2.261-1.2,3.2-4.945,11.79-10.1,23.454-14.784,35.4-3.468,8.844-6.331,18.054-9.458,27.1a6.573,6.573,0,0,0-.226.964c-.649,3.651.393,4.769,3.4,4.056,2.592-.618,4.313-3.327,6.743-4.071a16.177,16.177,0,0,1,5.847-.563c1.236.087,2.6,3.97,2.248,6.047-.7,4.12-1.9,8.009-4.311,11.09C258.068,341.977,257.566,343.062,259.193,344.341Z" transform="translate(-216.183 -252.301)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3C/g%3E%3C/svg%3E%0A\');
    }';
    die(); // end ajax process.
}
endif;
add_action( 'wp_ajax_blossom_magazine_dynamic_mce_css', 'blossom_magazine_dynamic_mce_css_ajax_callback' );
add_action( 'wp_ajax_no_priv_blossom_magazine_dynamic_mce_css', 'blossom_magazine_dynamic_mce_css_ajax_callback' );