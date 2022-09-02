<?php
/**
 * Describe child theme functions
 *
 * @package SparkleStore
 * @subpackage Sparkle Mart
 * 
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'sparkle_mart_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sparkle_mart_setup() {
    add_theme_support( "title-tag" );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( "wp-block-styles" );
    add_theme_support( "responsive-embeds" );
    add_theme_support( "align-wide" );
    
    $sparkle_mart_theme_info = wp_get_theme();
    $GLOBALS['sparkle_mart_version'] = $sparkle_mart_theme_info->get( 'Version' );

    /** set primary & secondary color */
    if(get_theme_mod('sparkle_mart_set_primary_color', '0') == '0'){
        set_theme_mod('sparklestore_primary_theme_color_options', '#ca9e7b');
        set_theme_mod('sparklestore_secondary_theme_color_options', '#c99870');
        set_theme_mod('sparkle_mart_set_primary_color', '1');
    }
}
endif;

add_action( 'after_setup_theme', 'sparkle_mart_setup' );


/**
 * Register Google fonts for News Portal Lite.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'sparkle_mart_fonts_url' ) ) :
    function sparkle_mart_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Open+Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Open+Sans font: on or off', 'sparkle-mart' ) ) {
            $font_families[] = 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
        } 

        /*
         * Translators: If there are characters in your language that are not supported
         * by Raleway, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'sparkle-mart' ) ) {
            $font_families[] = 'Raleway:100,200,200i,300,400,500,600,700,800';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue child theme styles and scripts
*/
add_action( 'wp_enqueue_scripts', 'sparkle_mart_scripts', 20 );

function sparkle_mart_scripts() {
    
    global $sparkle_mart_version;

    wp_enqueue_style( 'sparkle-mart-google-font', sparkle_mart_fonts_url(), array(), null );
    
    wp_dequeue_style( 'sparklestore-style' );
    wp_dequeue_style( 'sparklestore-style-responsive');
    
	wp_enqueue_style( 'sparklestore-parent-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/style.css', array(), esc_attr( $sparkle_mart_version ) );

    wp_enqueue_script('sparkle-mart', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), esc_attr( $sparkle_mart_version ), true);

    wp_enqueue_style( 'sparkle-mart-style', get_stylesheet_uri(), array(), esc_attr( $sparkle_mart_version ) );
    wp_enqueue_style( 'sparklestore-style-responsive');
}

require_once (get_stylesheet_directory(  ). '/inc/init.php');

/**
 * Numbered Pagination
 *
 * @since	1.0.0
 * @link	https://codex.wordpress.org/Function_Reference/paginate_links
 */
function sparkle_mart_pagination($query = '', $echo = true) {

    // Arrows with RTL support
    $prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
    $next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';

    // Get global $query
    if (!$query) {
        global $wp_query;
        $query = $wp_query;
    }

    // Set vars
    $total = $query->max_num_pages;
    $big = 999999999;

    // Display pagination if total var is greater then 1 (current query is paginated)
    if ($total > 1) {

        // Get current page
        if ($current_page = get_query_var('paged')) {
            $current_page = $current_page;
        } elseif ($current_page = get_query_var('page')) {
            $current_page = $current_page;
        } else {
            $current_page = 1;
        }

        // Get permalink structure
        if (get_option('permalink_structure')) {
            if (is_page()) {
                $format = 'page/%#%/';
            } else {
                $format = '/%#%/';
            }
        } else {
            $format = '&paged=%#%';
        }

        $args = apply_filters('sparkle_mart_pagination_args', array(
            'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
            'format' => $format,
            'current' => max(1, $current_page),
            'total' => $total,
            'mid_size' => 3,
            'type' => 'list',
            'prev_text' => '<i class="' . $prev_arrow . '"></i>',
            'next_text' => '<i class="' . $next_arrow . '"></i>',
        ));

        // Output pagination
        if ($echo) {
            echo '<nav class="woocommerce-pagination">' . wp_kses_post(paginate_links($args)) . '</nav>';
        } else {
            return '<nav class="woocommerce-pagination">' . wp_kses_post(paginate_links($args)) . '</nav>';
        }
    }
}

/** 
 * Category Widgets - Category Collection extends
 */
// The filter callback function.
function sparkle_mart_cat_widget_title_layout_options( $layout ) {
    $layout['layout_three'] = esc_html__('Layout 3', 'sparkle-mart');
    return $layout;
}
add_filter( 'sparklestore_cat_widget_area_title_layout', 'sparkle_mart_cat_widget_title_layout_options', 10, 1 );

function sparkle_mart_cat_widget_display_layout_options( $layout ) {
    $layout['category-style-3'] = esc_html__('Layout 3', 'sparkle-mart');
    $layout['category-style-4'] = esc_html__('Layout 4', 'sparkle-mart');
    return $layout;
}
add_filter( 'sparklestore_cat_widget_area_display_layout', 'sparkle_mart_cat_widget_display_layout_options', 10, 1 );

// The filter callback function.
function sparkle_mart_cat_widget_area_field_extends( $fields ) {
    $fields['sparklestore_column'] = array(
        'sparklestore_widgets_name'     => 'sparklestore_column',
        'sparklestore_widgets_title'    => esc_html__('Columns', 'sparkle-mart'),
        'sparklestore_widgets_field_type' => 'number',
        'sparklestore_widgets_default' => 4,
        'sparklestore_widgets_min_max' => array(
            'min' => 1,
            'max' => 6
        )
    );

    return $fields;
}
add_filter( 'sparklestore_cat_widget_area_fields', 'sparkle_mart_cat_widget_area_field_extends', 10, 1 );

// The filter callback function.
function sparkle_mart_cat_widget_area_attributes( $attr, $instance ) {
    $attr = " data-column=". $instance['sparklestore_column'];
    $attr .= " data-layout=". $instance['block_display_layout'];
    return $attr;
}
add_filter( 'sparklestore_cat_widget_area_column_attr', 'sparkle_mart_cat_widget_area_attributes', 10, 2 );


add_action( 'wp_head', 'sparkle_mart_remove_action' );
function sparkle_mart_remove_action() {
    remove_action( 'sparklestore_services_area', 'sparklestore_services_area', 10 );
    remove_action( 'sparklestore_top_footer', 'sparklestore_top_footer_before', 15 );
}

/**
 * Remove Service Section and add new layout
 */
if ( ! function_exists( 'sparkle_mart_services_area' ) ){
  
    function sparkle_mart_services_area(){

        $servicesarea = get_theme_mod('sparklestore_quick_services_settings_options');
        $column = get_theme_mod('sparklestore_service_column', 3);
        $layout = get_theme_mod('sparklestore_service_layout', 'layout_one');
        $title = get_theme_mod('sparklestore_service_title');
        $shot_desc = get_theme_mod('sparklestore_service_description');

        if(!empty( $servicesarea )) { ?>
            <?php do_action('service_wrapper_start'); ?>
            <div class="services_wrapper <?php  echo apply_filters('sparklestore_services_layout', $layout ); ?>">
                <div class="container">
                    <div class="service-title-items-wrapper">
                        <div class="blocktitlewrap">
                            <div class="blocktitle">
                                <?php if(!empty( $title )) { ?><h2><?php echo esc_html( $title ); ?></h2><?php } ?>
                                <?php if(!empty( $shot_desc )) { ?><p><?php echo esc_html( $shot_desc ); ?></p><?php } ?>
                            </div>
                        </div>

                        <div class="gallery gallery-columns-<?php echo esc_attr($column); ?>">
                        <?php
                            $servicesarea = json_decode( $servicesarea );
                            foreach($servicesarea as $services){ ?>
                            <div class="services_item">

                                <?php if( !empty( $services->services_icon ) ){ ?>
                                    <div class="services_icon">
                                        <span class="<?php echo esc_attr( $services->services_icon ); ?>"></span>
                                    </div>
                                <?php } ?>

                                <div class="services_content">

                                    <?php if( !empty( $services->services_title ) ){ ?>

                                        <h3><?php echo esc_html( $services->services_title ); ?></h3>

                                    <?php } if( !empty( $services->services_subtitle ) ){ ?>

                                        <p><?php echo esc_html( $services->services_subtitle ); ?></p>

                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action('service_wrapper_end'); ?>

        <?php
        }
    }
}
add_action( 'sparklestore_services_area', 'sparkle_mart_services_area', 10 );

/**
 * Top Footer Area
*/
if ( ! function_exists( 'sparkle_mart_top_footer_before' ) ) {

	function sparkle_mart_top_footer_before(){ 
        $subscription = get_theme_mod( 'sparkle_mart_footer_subscription','off' );
        if( $subscription == 'on'):
            $sub_title = get_theme_mod('sparkle_mart_footer_subscription_title', __("SUBSCRIBE FOR OUR OFFER NEWS", 'sparkle-mart'));
            $sub_shortcode = get_theme_mod('sparkle_mart_footer_subscription_shortcode');
        ?>
        <div class="services_wrapper layout_two footer-subscription">
            <div class="container">
                <div class="service-title-items-wrapper">
                    <?php if( $sub_title ): ?>
                    <div class="blocktitlewrap">
                        <div class="blocktitle">
                            <h2><?php echo esc_html( $sub_title ); ?></h2>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($sub_shortcode): ?>
                    <div class="gallery gallery-columns-1">
                        <div class="services_item">
                            <?php echo do_shortcode( $sub_shortcode ); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        endif;

        $topfooter = get_theme_mod( 'sparklestore_footer_social_icon_payment_logo_option','off' );
		
		if( !empty( $topfooter ) && $topfooter == 'on'){ ?>

			<div class="sub-top-footer">
				<div class="container">
					<div class="sub-top-inner">
						<div class="sociallink text-center">
                            <?php if( $social_title = get_theme_mod('sparkle_mart_social_title', __('Social Media', 'sparkle-mart'))): ?>
                            <h4><?php echo esc_html( $social_title ) ?></h4>
                            <?php endif; ?>
							<?php apply_filters( 'sparklestore_social_links', 5 ); ?>	            
						</div>

                        <?php $img = get_theme_mod('sparkle_mart_center_media'); ?>
                        <div class="applinks text-center">
                            <?php if( $social_title = get_theme_mod('sparkle_mart_media_title') ): ?>
                            <h4><?php echo esc_html( $social_title ) ?></h4>
                            <?php endif; ?>
                            <?php
                                if( $img ){
                                    echo '<div class="center-media">';
                                        echo "<img src='". $img ."' />";	            
                                    echo "</div>";
                                }
                            ?>
							
						</div>


						<div class="paymentlogo text-center">
                            <?php if( $social_title = get_theme_mod('sparkle_mart_payment_title', __('Payment Option', 'sparkle-mart'))): ?>
                            <h4><?php echo esc_html( $social_title ) ?></h4>
                            <?php endif; ?>
							<?php apply_filters( 'sparklestore_payment_logo', 10 ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php }
	}
}
add_action( 'sparklestore_top_footer', 'sparkle_mart_top_footer_before', 15 );