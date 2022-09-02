<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function girlish_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'girlish' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function girlish_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'girlish' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

 function girlish_featured_shop_section_content_type() {
        $girlish_featured_shop_section_content_type = array(
            'post'      => esc_html__( 'Post', 'girlish' ),
        );

        if(class_exists('WooCommerce')){
            $girlish_featured_shop_section_content_type = array_merge($girlish_featured_shop_section_content_type, 
                array(
                    'product'            => esc_html__( 'Product', 'girlish' ),
                    'product-category'   => esc_html__( 'Product Category', 'girlish' ),
                )
            );
        }

        $output = apply_filters( 'girlish_featured_shop_section_content_type', $girlish_featured_shop_section_content_type );

        return $output;
    }

    function girlish_collection_section_content_type() {
        if(class_exists('WooCommerce')){
            $girlish_collection_section_content_type = 
            array(
                'product'            => esc_html__( 'Product', 'girlish' ),
                'product-category'   => esc_html__( 'Product Category', 'girlish' ),
            );
        }

        $output = apply_filters( 'girlish_collection_section_content_type', $girlish_collection_section_content_type );

        return $output;
    }

/**
 * List of products for post choices.
 * @return Array Array of post ids and name.
 */
function girlish_product_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'product' ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'girlish' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}


function girlish_product_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'product_cat',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'girlish' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function girlish_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'girlish' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}


if ( ! function_exists( 'girlish_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function girlish_selected_sidebar() {
        $girlish_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'girlish' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'girlish' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'girlish' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'girlish' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'girlish' ),
        );

        $output = apply_filters( 'girlish_selected_sidebar', $girlish_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'girlish_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function girlish_site_layout() {
        $girlish_site_layout = array(
            'wide-layout'  => get_template_directory_uri() . '/assets/images/full.png',
            'boxed-layout' => get_template_directory_uri() . '/assets/images/boxed.png',
        );

        $output = apply_filters( 'girlish_site_layout', $girlish_site_layout );
        return $output;
    }
endif;


if ( ! function_exists( 'girlish_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function girlish_global_sidebar_position() {
        $girlish_global_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'girlish_global_sidebar_position', $girlish_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'girlish_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function girlish_sidebar_position() {
        $girlish_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'girlish_sidebar_position', $girlish_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'girlish_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function girlish_pagination_options() {
        $girlish_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'girlish' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'girlish' ),
        );

        $output = apply_filters( 'girlish_pagination_options', $girlish_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'girlish_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function girlish_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'girlish' ),
            'off'       => esc_html__( 'Disable', 'girlish' )
        );
        return apply_filters( 'girlish_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'girlish_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function girlish_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'girlish' ),
            'off'       => esc_html__( 'No', 'girlish' )
        );
        return apply_filters( 'girlish_hide_options', $arr );
    }
endif;

